<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;


/*
|--------------------------------------------------------------------------
| ROUTE USER (FRONTEND)
|--------------------------------------------------------------------------
*/

// Halaman Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Katalog → untuk user
Route::get('/katalog', [ProdukController::class, 'index'])->name('katalog.index');

// Halaman Detail Produk → untuk user
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');

// Halaman Cart
Route::view('/cart', 'cart.index')->name('cart.index');


/*
|--------------------------------------------------------------------------
| ROUTE ADMIN (LOGIN WAJIB)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/', function () {
            if (auth()->user()->role !== 'admin') {
                return redirect()->route('home')
                    ->with('error', 'Akses ditolak! Anda bukan admin.');
            }
            return view('admin.index');
        })->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | USERS CRUD (SEHARUSNYA ADA JUGA)
        |--------------------------------------------------------------------------
        */
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        /*
        |--------------------------------------------------------------------------
        | PRODUK CRUD UNTUK ADMIN
        |--------------------------------------------------------------------------
        */
        Route::resource('produk', ProdukController::class)->names([
            'index' => 'produk.index',
            'create' => 'produk.create',
            'store' => 'produk.store',
            'show' => 'produk.show',
            'edit' => 'produk.edit',
            'update' => 'produk.update',
            'destroy' => 'produk.destroy',
        ]);

        /*
        |--------------------------------------------------------------------------
        | CATEGORY CRUD
        |--------------------------------------------------------------------------
        */
        Route::resource('categories', CategoryController::class)
            ->except(['create', 'edit', 'show'])
            ->names([
                'index' => 'categories.index',
                'store' => 'categories.store',
                'update' => 'categories.update',
                'destroy' => 'categories.destroy',
            ]);
    });



/*
|--------------------------------------------------------------------------
| AUTH ROUTES (LOGIN, REGISTER)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
