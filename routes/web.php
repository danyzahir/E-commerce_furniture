<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| ROUTE UNTUK USER (FRONTEND)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/catalog', function () {
    return view('catalog.index');
})->name('catalog.index');

Route::get('/produk/{id}', function ($id) {
    $products = [
        1 => ['nama'=>'Kursi Kayu Minimalis','harga'=>750000,'deskripsi'=>'Kursi kayu elegan desain minimalis','gambar'=>'/img/kursi.jpg'],
        2 => ['nama'=>'Meja Belajar Putih','harga'=>550000,'deskripsi'=>'Meja belajar simpel','gambar'=>'/img/meja.jpg'],
        3 => ['nama'=>'Sofa 2 Dudukan','harga'=>2250000,'deskripsi'=>'Sofa empuk dua dudukan','gambar'=>'/img/sofa.jpg'],
    ];
    if(!isset($products[$id])) abort(404);
    return view('product',['product'=>$products[$id]]);
})->name('produk.show');

/*
|--------------------------------------------------------------------------
| ROUTE UNTUK ADMIN DASHBOARD
|--------------------------------------------------------------------------
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
