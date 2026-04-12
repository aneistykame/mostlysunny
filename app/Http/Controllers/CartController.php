<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            //prihlaseny
            $cart = Cart::where('user_id', Auth::id())->with('items.product')->first();
            $cartItems = $cart ? $cart->items : collect();
        } else {
            //neprihlaseny
            $cartItems = Session::get('cart', collect());
        }

        $total = 0;
        foreach($cartItems as $item) {
            $total += $item['quantity'] * ($item['product']->price ?? $item['price']);
        }

        return view('cart', compact('cartItems', 'total'));
    }

    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if (Auth::check()) {
            //prihlaseny
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            $cartItem = CartItem::where('cart_id', $cart->cart_id)->where('product_id', $productId)->first();

            if ($cartItem) {
                $cartItem->increment('quantity');
            } else {
                CartItem::create([
                    'cart_id' => $cart->cart_id,
                    'product_id' => $productId,
                    'quantity' => 1
                ]);
            }
        } else {
            //neprihlaseny
            $cart = Session::get('cart', collect());

            if ($cart->has($productId)) {
                //zvysenie množstva, ak už existuje v košíku
                $item = $cart->get($productId);
                $item['quantity']++;
                $cart->put($productId, $item);
            } else {
                //pridanie nového produktu do košíka
                $cart->put($productId, [
                    'product_id' => $product->product_id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'product' => $product
                ]);
            }

            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produkt pridaný do košíka!');
    }

    public function update(Request $request, $id)
{
    $item = \App\Models\CartItem::find($id);
    
    if (!$item) {
        // Ak ti vypíše toto, tak Controller nevie nájsť ten riadok v DB!
        return "Položka s ID $id neexistuje v databáze.";
    }

    $item->quantity = $request->quantity;
    $item->save();

    return redirect()->back();
}

public function remove($id)
{
    //prihlaseny mazanie z DB
    if (auth()->check()) {
        $cartItem = \App\Models\CartItem::where('cart_item_id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
        }
    } else {
        //mazanie zo session
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
    }

    return redirect()->back()->with('success', 'Produkt bol odstránený z košíka.');
}
public function checkout()
{
    //nacitanie položiek z DB alebo session
    if (auth()->check()) {
        $cartItems = \App\Models\CartItem::with('product')
            ->whereHas('cart', function($q) {
                $q->where('user_id', auth()->id());
            })->get();
    } else {
        $cartItems = session()->get('cart', []);
    }

    //celková cena
    $total = 0;
    foreach ($cartItems as $item) {
        if (auth()->check()) {
            $total += $item->product->price * $item->quantity;
        } else {
            $total += $item['price'] * $item['quantity'];
        }
    }

    return view('cart2', compact('cartItems', 'total'));
}

}