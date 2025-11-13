<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| ROUTE UNTUK USER (FRONTEND)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [HomeController::class, 'catalog'])->name('catalog.index');
Route::get('/produk/{id}', [HomeController::class, 'show'])->name('produk.show');

/*
|--------------------------------------------------------------------------
| ROUTE UNTUK AUTH (LOGIN & REGISTER)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| ROUTE UNTUK ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {

        // DASHBOARD
        Route::get('/', function () {
            if (auth()->user()->role !== 'admin') {
                return redirect()->route('home')->with('error', 'Akses ditolak! Anda bukan admin.');
            }
            return view('admin.index');
        })->name('dashboard');

        // USERS (CRUD hanya admin)
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        // PRODUK CRUD (dikasih prefix nama agar bisa dipanggil admin.produk.index)
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
