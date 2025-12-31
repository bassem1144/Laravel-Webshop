<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class CartService
{
    /**
     * Get cart items from session
     *
     * @return Collection
     */
    public function getCart(): Collection
    {
        return collect(session()->get('cart', []));
    }

    /**
     * Add product to cart
     *
     * @param Product $product
     * @param int $quantity
     * @return void
     */
    public function add(Product $product, int $quantity = 1): void
    {
        $cart = $this->getCart();
        $productId = $product->id;

        if ($cart->has($productId)) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart->toArray());
    }

    /**
     * Update cart item quantity
     *
     * @param int $productId
     * @param int $quantity
     * @return void
     */
    public function update(int $productId, int $quantity): void
    {
        $cart = $this->getCart();

        if ($cart->has($productId)) {
            if ($quantity <= 0) {
                $this->remove($productId);
            } else {
                $cart[$productId]['quantity'] = $quantity;
                session()->put('cart', $cart->toArray());
            }
        }
    }

    /**
     * Remove product from cart
     *
     * @param int $productId
     * @return void
     */
    public function remove(int $productId): void
    {
        $cart = $this->getCart();
        $cart->forget($productId);
        session()->put('cart', $cart->toArray());
    }

    /**
     * Clear entire cart
     *
     * @return void
     */
    public function clear(): void
    {
        session()->forget('cart');
    }

    /**
     * Get cart total
     *
     * @return int
     */
    public function getTotal(): int
    {
        return $this->getCart()->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    /**
     * Get formatted cart total
     *
     * @return string
     */
    public function getFormattedTotal(): string
    {
        return '€' . number_format($this->getTotal() / 100, 2);
    }

    /**
     * Get cart item count
     *
     * @return int
     */
    public function getCount(): int
    {
        return $this->getCart()->sum('quantity');
    }

    /**
     * Check if cart is empty
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->getCart()->isEmpty();
    }
}
