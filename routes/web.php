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
Route::get('/register', function () {
    return view('register');
})->name('register');

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
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'min:8'], // Pridaj si prípadne 'confirmed', ak máš v HTML input password_confirmation
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    //Presmerovanie na HLAVNÚ stránku
    return redirect()->route('index');
});

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

//Hlavná stránka s bannermi
Route::get('/', [ProductController::class, 'home'])->name('index');

//Stránka vyhľadávania a kategórií
Route::get('/category', [ProductController::class, 'index'])->name('products.index');

//konkrétna kategória zo sidebar
Route::get('/category/{category}', [ProductController::class, 'category'])->name('category');

//shipping
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');