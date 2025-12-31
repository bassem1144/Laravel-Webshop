<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->middleware('auth');
        $this->cartService = $cartService;
    }

    /**
     * Show checkout form
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if ($this->cartService->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();
        $formattedTotal = $this->cartService->getFormattedTotal();

        return view('checkout.index', compact('cart', 'total', 'formattedTotal'));
    }

    /**
     * Process checkout and create order
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'required|in:credit_card,paypal,bank_transfer',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($this->cartService->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cart = $this->cartService->getCart();
        
        // Check stock availability
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if (!$product || $product->stock < $item['quantity']) {
                return back()->with('error', "Insufficient stock for {$item['name']}.");
            }
        }

        DB::beginTransaction();

        try {
            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => $this->cartService->getTotal(),
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'shipping_address' => $validated['shipping_address'],
                'notes' => $validated['notes'] ?? null,
            ]);

            // Create order items and reduce stock
            foreach ($cart as $item) {
                $product = Product::find($item['id']);
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);

                // Reduce stock
                $product->decrement('stock', $item['quantity']);
            }

            // Clear cart
            $this->cartService->clear();

            DB::commit();

            // Simulate payment processing
            return redirect()->route('checkout.payment', $order)->with('success', 'Order created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to process order. Please try again.');
        }
    }

    /**
     * Show payment simulation page
     *
     * @param Order $order
     * @return \Illuminate\View\View
     */
    public function payment(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('checkout.payment', compact('order'));
    }

    /**
     * Process simulated payment
     *
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processPayment(Request $request, Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'action' => 'required|in:success,fail',
        ]);

        if ($request->input('action') === 'success') {
            $order->update([
                'payment_status' => 'paid',
                'status' => 'processing',
            ]);

            return redirect()->route('orders.show', $order)->with('success', 'Payment successful! Your order is being processed.');
        } else {
            $order->update([
                'payment_status' => 'failed',
                'status' => 'cancelled',
            ]);

            // Restore stock
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }

            return redirect()->route('orders.show', $order)->with('error', 'Payment failed. Order has been cancelled and stock restored.');
        }
    }
}
