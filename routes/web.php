<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| USER / FRONTEND
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/katalog', [ProdukController::class, 'index'])->name('katalog.index');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');

/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
Route::post('/cart/delete-selected', [CartController::class, 'deleteSelected'])->name('cart.deleteSelected');

/*
|--------------------------------------------------------------------------
| CHECKOUT + XENDIT
|--------------------------------------------------------------------------
*/
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

/* ✅ WEBHOOK XENDIT (WAJIB TANPA AUTH & CSRF) */
Route::post('/xendit/callback', [CheckoutController::class, 'callback'])
    ->name('xendit.callback');

/* ✅ REDIRECT RESULT */
Route::get('/order-success/{id}', function ($id) {
    return view('orders.success', compact('id'));
})->name('orders.success');

Route::get('/order-failed/{id}', function ($id) {
    return view('orders.failed', compact('id'));
})->name('orders.failed');

/* ✅ (OPTIONAL) MANUAL PAYMENT TEST */
Route::get('/pay/{id}', [PaymentController::class, 'createInvoice'])
    ->name('pay.order');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

/*
|--------------------------------------------------------------------------
| ADMIN ORDERS
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
});

/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('produk', ProdukController::class);
        Route::resource('categories', CategoryController::class)
            ->except(['create', 'edit', 'show']);
    });

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
