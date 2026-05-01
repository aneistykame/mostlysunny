<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;

// Hlavná stránka
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Stránka Login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Stránka Register
// Zobrazenie formulára (použije tvoj Controller)
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

// Spracovanie registrácie (použije tvoj Controller so všetkou validáciou)
Route::post('/register', [RegisteredUserController::class, 'store']);
// Profil
Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('dashboard');

// category
Route::get('/category/{category}', [ProductController::class, 'category'])->name('category');


//Spracovanie PRIHLÁSENIA
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        // Presmerovanie na HLAVNÚ stránku
        return redirect()->route('index');
    }

    return back()->withErrors([
        'email' => 'Nesprávne prihlasovacie údaje.',
    ])->onlyInput('email');
});

//Spracovanie REGISTRÁCIE


//Spracovanie ODHLÁSENIA
Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('index');
})->name('logout');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

//Pridanie produktu do košíka
Route::post('/cart/add/{product_id}', [CartController::class, 'add'])->name('cart.add');

//Odstránenie položky z košíka
Route::delete('/cart/remove/{product_id}', [CartController::class, 'remove'])->name('cart.remove');

//Aktualizácia množstva v košíku
Route::patch('/cart/update/{product_id}', [CartController::class, 'update'])->name('cart.update');

//Stránka vyhľadávania a kategórií
Route::get('/category', [ProductController::class, 'index'])->name('products.index');

//konkrétna kategória zo sidebar
Route::get('/category/{category}', [ProductController::class, 'category'])->name('category');

//shipping
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

Route::get('/', [ProductController::class, 'home'])->name('index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');