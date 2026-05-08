<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentMethod;

class CheckoutController extends Controller
{
    public function showShipping()
    {
        // Logika košíka
        if (Auth::check()) {
            $cartItems = CartItem::whereHas('cart', function($q) {
                $q->where('user_id', Auth::id());
            })->with('product')->get();
            
            $total = $cartItems->sum(fn($item) => $item->quantity * ($item->product->price ?? 0));
        } else {
            $cartItems = session()->get('cart', []);
            $total = collect($cartItems)->sum(fn($item) => $item['quantity'] * $item['price']);
        }

        // Načítanie dopravy z DB
        $shippingMethods = ShippingMethod::all();

        return view('cart2', compact('cartItems', 'total', 'shippingMethods'));
    }

    public function storeShipping(Request $request)
    {
        $request->validate([
            'shipping_id' => 'required|exists:shipping_methods,shipping_id',
            'branch_location' => 'nullable|string'
        ]);

        $method = ShippingMethod::find($request->shipping_id);

        session(['shipping_selection' => [
            'id' => $method->shipping_id,
            'name' => $method->name,
            'branch' => $request->branch_location,
            'price' => $method->price
        ]]);

        return redirect()->route('checkout.payment');
    }

    public function showPayment()
    {
        // Kontrola či si používateľ vybral dopravu v predošlom kroku
        if (!session()->has('shipping_selection')) {
            return redirect()->route('checkout.shipping');
        }

        $paymentMethods = PaymentMethod::all();
        $shipping = session('shipping_selection');

        // Načítanie košíka
        if (auth()->check()) {
            $cartItems = \App\Models\CartItem::whereHas('cart', function($q) {
                $q->where('user_id', auth()->id());
            })->with('product')->get();
            $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
        } else {
            $cartItems = session()->get('cart', []);
            $total = collect($cartItems)->sum(fn($item) => $item['quantity'] * $item['price']);
        }

        return view('cart3', compact('paymentMethods', 'cartItems', 'total', 'shipping'));
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|exists:payment_methods,payment_id',
        ]);

        $payment = PaymentMethod::find($request->payment_id);

        session(['payment_selection' => [
            'id' => $payment->payment_id,
            'name' => $payment->name
        ]]);

        return redirect()->route('checkout.details'); // Smer na cart4
    }

public function showDetails()
{
    if (!session()->has('payment_selection')) return redirect()->route('checkout.payment');

    $shipping = session('shipping_selection');
    $payment = session('payment_selection');
    
    // Načítanie košíka
    if (auth()->check()) {
        $cartItems = \App\Models\CartItem::whereHas('cart', function($q) {
            $q->where('user_id', auth()->id());
        })->get();
        $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
    } else {
        $cartItems = session()->get('cart', []);
        $total = collect($cartItems)->sum(fn($item) => $item['quantity'] * $item['price']);
    }

    return view('cart4', compact('cartItems', 'total', 'shipping', 'payment'));
}

    public function placeOrder(Request $request)
    {
        $request->validate([
            'first_name' => 'required', 'last_name' => 'required',
            'email' => 'required|email', 'phone' => 'required',
            'address' => 'required', 'city' => 'required', 'zip' => 'required',
        ]);

        $shipping = session('shipping_selection');
        $payment = session('payment_selection');
        
        // Vytvorenie objednávky
        $order = new \App\Models\Order();
        $order->fill($request->all());
        $order->user_id = auth()->id();
        $order->shipping_method = $shipping['name'];
        $order->shipping_price = $shipping['price'];
        $order->payment_method = $payment['name'];
        $order->total_price = $request->total_val;
        $order->save();

        // Vymazať košík a session
        if (auth()->check()) {
            \App\Models\Cart::where('user_id', auth()->id())->delete();
        }
        session()->forget(['cart', 'shipping_selection', 'payment_selection']);

        return view('confirmation', ['order_id' => $order->id]);
    }

}