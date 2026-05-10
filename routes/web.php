<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;

// main
Route::get('/', [ProductController::class, 'home'])->name('index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Stránka Login
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();
        if ($user && $user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('index');
    }

    return back()->withErrors([
        'email' => 'Nesprávne prihlasovacie údaje.',
    ])->onlyInput('email');
});

// Register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

//Spracovanie ODHLÁSENIA
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('index');
})->name('logout');

// Profile
Route::get('/profile', function () {
    $orders = \App\Models\Order::where('user_id', Auth::id())
        ->with('items')
        ->orderBy('created_at', 'desc')
        ->get();
    return view('profile', compact('orders'));
})->middleware(['auth'])->name('dashboard');

// Category, Search
Route::get('/category', [ProductController::class, 'index'])->name('products.index');
Route::get('/category/{category}', [ProductController::class, 'category'])->name('category');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product_id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{product_id}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/update/{product_id}', [CartController::class, 'update'])->name('cart.update');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'showShipping'])->name('checkout');
Route::get('/checkout/shipping', [CheckoutController::class, 'showShipping'])->name('checkout.shipping');
Route::post('/checkout/shipping', [CheckoutController::class, 'storeShipping'])->name('checkout.storeShipping');
Route::get('/checkout/payment', [CheckoutController::class, 'showPayment'])->name('checkout.payment');
Route::post('/checkout/payment', [CheckoutController::class, 'storePayment'])->name('checkout.storePayment');
Route::get('/checkout/details', [CheckoutController::class, 'showDetails'])->name('checkout.details');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::get('/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/profile', [AdminController::class, 'profile'])
        ->name('admin.profile');

    Route::get('/products/create', [AdminController::class, 'create'])
        ->name('admin.products.create');

    Route::post('/products', [AdminController::class, 'store'])
        ->name('admin.products.store');


    Route::get('/products/delete', [AdminController::class, 'deleteProduct'])
        ->name('admin.products.deleteProduct');

    Route::get('/products/edit', [AdminController::class, 'editProduct'])
        ->name('admin.products.editProduct');

    Route::get('/products/{id}/edit', [AdminController::class, 'edit'])
        ->name('admin.products.edit');

    Route::put('/products/{id}', [AdminController::class, 'update'])
        ->name('admin.products.update');

    Route::delete('/products/{id}', [AdminController::class, 'destroy'])
        ->name('admin.products.delete');

    Route::delete('/images/{imageId}', [AdminController::class, 'deleteImage'])
        ->name('admin.images.delete');
});
