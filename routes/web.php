<?php

use Illuminate\Support\Facades\Route;

// ===============================
// Halaman Utama User
// ===============================
Route::get('/', function () {
    return view('welcome');
});

// Halaman katalog produk
Route::get('/catalog', function () {
    return view('catalog.index');
})->name('catalog.index');

// Detail Produk (halaman user)
Route::get('/produk/{id}', function ($id) {
    $products = [
        1 => [
            'nama' => 'Kursi Kayu Minimalis',
            'harga' => 750000,
            'deskripsi' => 'Kursi kayu elegan dengan desain minimalis cocok untuk ruang tamu modern.',
            'gambar' => '/img/kursi.jpg'
        ],
        2 => [
            'nama' => 'Meja Belajar Putih',
            'harga' => 550000,
            'deskripsi' => 'Meja belajar simpel dengan finishing putih bersih dan kokoh.',
            'gambar' => '/img/meja.jpg'
        ],
        3 => [
            'nama' => 'Sofa 2 Dudukan',
            'harga' => 2250000,
            'deskripsi' => 'Sofa empuk dua dudukan dengan kain halus dan rangka kuat.',
            'gambar' => '/img/sofa.jpg'
        ],
    ];

    if (!isset($products[$id])) {
        abort(404);
    }

    return view('product', ['product' => $products[$id]]);
});


// ===============================
// ROUTE UNTUK ADMIN DASHBOARD
// ===============================
Route::prefix('admin')->group(function () {

    // Dashboard utama
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.dashboard');

    // Daftar produk (nanti bisa diganti pakai controller)
    Route::get('/produk', function () {
        return view('admin.produk');
    })->name('admin.produk');

    // Daftar pengguna
    Route::get('/pengguna', function () {
        return view('admin.pengguna');
    })->name('admin.pengguna');

    // Daftar transaksi
    Route::get('/transaksi', function () {
        return view('admin.transaksi');
    })->name('admin.transaksi');
    
});
