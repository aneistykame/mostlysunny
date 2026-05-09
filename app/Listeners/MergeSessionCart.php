<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Session;

class MergeSessionCart
{
    public function handle(Login $event)
    {
        $sessionCart = Session::get('cart', []);

        if (empty($sessionCart)) return;

        $cart = Cart::firstOrCreate([
            'user_id' => $event->user->id
        ]);

        foreach ($sessionCart as $productId => $item) {

            $existing = CartItem::where('cart_id', $cart->cart_id)
                ->where('product_id', $productId)
                ->first();

            if ($existing) {
                $existing->quantity += $item['quantity'];
                $existing->save();
            } else {
                CartItem::create([
                    'cart_id' => $cart->cart_id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity']
                ]);
            }
        }

        Session::forget('cart');
    }
}