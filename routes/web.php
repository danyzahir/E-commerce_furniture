<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| ROUTE USER (FRONTEND)
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Katalog
Route::get('/katalog', [ProdukController::class, 'index'])->name('katalog.index');

// Detail Produk
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');

// CART (yang benar)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
Route::post('/cart/delete-selected', [CartController::class, 'deleteSelected'])->name('cart.deleteSelected');

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

        // USERS CRUD
        Route::resource('users', UserController::class)
            ->except(['show'])
            ->names([
                'index' => 'users.index',
                'edit' => 'users.edit',
                'update' => 'users.update',
                'destroy' => 'users.destroy',
            ]);

        // PRODUK CRUD
        Route::resource('produk', ProdukController::class)->names([
            'index' => 'produk.index',
            'create' => 'produk.create',
            'store' => 'produk.store',
            'show' => 'produk.show',
            'edit' => 'produk.edit',
            'update' => 'produk.update',
            'destroy' => 'produk.destroy',
        ]);

        // CATEGORY CRUD
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
| AUTH ROUTES
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
