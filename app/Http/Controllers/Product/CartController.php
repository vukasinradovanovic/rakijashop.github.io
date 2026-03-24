<?php

namespace App\Http\Controllers\Product;

use App\Models\Product\Cart;
use App\Models\Product\Product;
use App\Models\User\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController
{
    private const SESSION_CART_KEY = 'cart.items';

    public function index($locale)
    {
        if (Auth::check()) {
            $cart = $this->getOrCreateUserCart();
            $items = $cart->items()->with('product.images')->get();

            $totalQuantity = (int) $items->sum('quantity');
            $totalPrice = (float) $items->sum(function ($item) {
                return $item->quantity * ($item->product->price ?? 0);
            });

            return view('cart.indexCartPage', compact('items', 'totalQuantity', 'totalPrice'));
        }

        $sessionItems = session(self::SESSION_CART_KEY, []);

        $products = Product::with('images')
            ->whereIn('id', array_keys($sessionItems))
            ->get()
            ->keyBy('id');

        $items = collect($sessionItems)
            ->map(function (int $quantity, int $productId) use ($products) {
                $product = $products->get($productId);

                if (!$product) {
                    return null;
                }

                return (object) [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
            })
            ->filter()
            ->values();

        $totalQuantity = (int) $items->sum('quantity');
        $totalPrice = (float) $items->sum(function ($item) {
            return $item->quantity * ($item->product->price ?? 0);
        });

        return view('cart.indexCartPage', compact('items', 'totalQuantity', 'totalPrice'));
    }

    public function store(Request $request, $locale, Product $product): RedirectResponse
    {
        $quantity = max(1, (int) $request->input('quantity', 1));

        if (Auth::check()) {
            $cart = $this->getOrCreateUserCart();
            $item = $cart->items()->where('product_id', $product->id)->first();

            if ($item) {
                $item->increment('quantity', $quantity);
            } else {
                $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                ]);
            }
        } else {
            $sessionCart = session(self::SESSION_CART_KEY, []);
            $existingQuantity = (int) ($sessionCart[$product->id] ?? 0);
            $sessionCart[$product->id] = $existingQuantity + $quantity;

            session([self::SESSION_CART_KEY => $sessionCart]);
        }

        return back()->with('success', __('cart.flash.added'));
    }

    public function update(Request $request, $locale, Product $product): RedirectResponse
    {
        $quantity = max(1, (int) $request->input('quantity', 1));

        if (Auth::check()) {
            $cart = $this->getOrCreateUserCart();
            $item = $cart->items()->where('product_id', $product->id)->first();

            if ($item) {
                $item->update(['quantity' => $quantity]);
            }
        } else {
            $sessionCart = session(self::SESSION_CART_KEY, []);

            if (array_key_exists($product->id, $sessionCart)) {
                $sessionCart[$product->id] = $quantity;
                session([self::SESSION_CART_KEY => $sessionCart]);
            }
        }

        return back()->with('success', __('cart.flash.updated'));
    }

    public function destroy($locale, Product $product): RedirectResponse
    {
        if (Auth::check()) {
            $cart = $this->getOrCreateUserCart();
            $cart->items()->where('product_id', $product->id)->delete();
        } else {
            $sessionCart = session(self::SESSION_CART_KEY, []);

            if (array_key_exists($product->id, $sessionCart)) {
                unset($sessionCart[$product->id]);
                session([self::SESSION_CART_KEY => $sessionCart]);
            }
        }

        return back()->with('success', __('cart.flash.removed'));
    }

    public static function getCartQuantity(): int
    {
        if (Auth::check()) {
            /** @var User|null $user */
            $user = Auth::user();

            if (!$user) {
                return 0;
            }

            $cart = $user->cart;

            if (!$cart) {
                return 0;
            }

            return (int) $cart->items()->sum('quantity');
        }

        return (int) collect(session(self::SESSION_CART_KEY, []))->sum();
    }

    private function getOrCreateUserCart(): Cart
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        return $user->cart()->firstOrCreate();
    }
}
