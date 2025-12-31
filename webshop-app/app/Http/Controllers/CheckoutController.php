<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    /**
     * Show checkout form
     */
    public function index(): View|RedirectResponse
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
     */
    public function store(Request $request): RedirectResponse
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
     */
    public function payment(Order $order): View
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('checkout.payment', compact('order'));
    }

    /**
     * Process simulated payment
     */
    public function processPayment(Request $request, Order $order): RedirectResponse
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
