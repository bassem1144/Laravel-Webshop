<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    /**
     * Display the shopping cart
     */
    public function index(): View
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();
        $formattedTotal = $this->cartService->getFormattedTotal();

        return view('cart.index', compact('cart', 'total', 'formattedTotal'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request, Product $product): RedirectResponse
    {
        $quantity = $request->input('quantity', 1);

        if ($product->stock < $quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $this->cartService->add($product, $quantity);

        return back()->with('success', 'Product added to cart!');
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, int $productId): RedirectResponse
    {
        $quantity = $request->input('quantity', 1);
        $this->cartService->update($productId, $quantity);

        return back()->with('success', 'Cart updated!');
    }

    /**
     * Remove item from cart
     */
    public function remove(int $productId): RedirectResponse
    {
        $this->cartService->remove($productId);

        return back()->with('success', 'Item removed from cart!');
    }

    /**
     * Clear entire cart
     */
    public function clear(): RedirectResponse
    {
        $this->cartService->clear();

        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}
