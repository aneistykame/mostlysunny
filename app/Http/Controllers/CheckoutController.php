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
    
    // 1. Vytvorenie objednávky
    // 1. Vytvoríme inštanciu, ale neukladáme hneď cez fill všetko z requestu
$order = new \App\Models\Order();

// Použijeme fill iba na tie polia, ktoré existujú v migrácii (meno, adresa, atď.)
// total_val z requestu sa odignoruje, ak nie je v $fillable v modeli
$order->fill($request->except('total_val')); 

$order->user_id = auth()->id();
$order->shipping_method = $shipping['name'];
$order->shipping_price = $shipping['price'];
$order->payment_method = $payment['name'];

// Tu priradíme hodnotu z inputu "total_val" do stĺpca "total_price"
$order->total_price = $request->total_val; 

$order->save();

    // 2. Uloženie položiek objednávky (OrderItem)
    if (auth()->check()) {
        $cartItems = \App\Models\CartItem::whereHas('cart', function($q) {
            $q->where('user_id', auth()->id());
        })->get();

        foreach ($cartItems as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }
        // Vymazať košík v DB
        \App\Models\Cart::where('user_id', auth()->id())->delete();
    } else {
        $cartItems = session()->get('cart', []);
        foreach ($cartItems as $id => $details) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'product_name' => $details['name'],
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }
    }

    // 3. Vymazať session
    session()->forget(['cart', 'shipping_selection', 'payment_selection']);

    // 4. Presmerovanie na samostatnú routu (aby F5 na stránke nezopakovalo objednávku)
    return redirect()->route('checkout.confirmation', $order->id);
}

public function confirmation(\App\Models\Order $order)
{
    // Načítame položky, aby sme ich mohli vypísať v zhrnutí
    $order->load('items');
    
    return view('confirmation', compact('order'));
}

}