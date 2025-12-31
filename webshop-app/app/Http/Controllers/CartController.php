<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display the shopping cart
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();
        $formattedTotal = $this->cartService->getFormattedTotal();

        return view('cart.index', compact('cart', 'total', 'formattedTotal'));
    }

    /**
     * Add product to cart
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, Product $product)
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
     *
     * @param Request $request
     * @param int $productId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $productId)
    {
        $quantity = $request->input('quantity', 1);
        $this->cartService->update($productId, $quantity);

        return back()->with('success', 'Cart updated!');
    }

    /**
     * Remove item from cart
     *
     * @param int $productId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(int $productId)
    {
        $this->cartService->remove($productId);

        return back()->with('success', 'Item removed from cart!');
    }

    /**
     * Clear entire cart
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear()
    {
        $this->cartService->clear();

        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}
