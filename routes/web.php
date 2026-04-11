<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| ZOBRAZOVACIE ROUTY (GET)
|--------------------------------------------------------------------------
*/

// Hlavná stránka
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Stránka Login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Stránka Register (Cez Controller alebo View)
Route::get('/register', function () {
    return view('register');
})->name('register');

// Profil (Prístupný len pre prihlásených)
Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('dashboard');

// category
Route::get('/category/{category}', [ProductController::class, 'category'])->name('category');

/*
|--------------------------------------------------------------------------
| LOGIKA (POST)
|--------------------------------------------------------------------------
*/

// 1. Spracovanie PRIHLÁSENIA
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

// 2. Spracovanie REGISTRÁCIE (Ručne, keďže nemáš Controller)
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

    // Presmerovanie na HLAVNÚ stránku
    return redirect()->route('index');
});

// 3. Spracovanie ODHLÁSENIA
Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('index');
})->name('logout');