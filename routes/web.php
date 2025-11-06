<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------|
| ROUTE UNTUK USER (FRONTEND)
|--------------------------------------------------------------------------|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/catalog', [HomeController::class, 'catalog'])->name('catalog.index');

Route::get('/produk/{id}', [HomeController::class, 'show'])->name('produk.show');

/*
|--------------------------------------------------------------------------|
| ROUTE UNTUK ADMIN DASHBOARD
|--------------------------------------------------------------------------|
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () {
        return view('admin.index');
    })->name('dashboard');

    Route::get('/pengguna', function () {
        return view('admin.pengguna');
    })->name('pengguna');

    Route::get('/transaksi', function () {
        return view('admin.transaksi');
    })->name('transaksi');

    // Resource route untuk Produk CRUD
    Route::resource('produk', ProdukController::class);

    // Resource route untuk Category CRUD (tanpa create, edit, show)
    Route::resource('categories', CategoryController::class)->except(['create','edit','show']);
});
