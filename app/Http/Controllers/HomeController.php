<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; // pastikan model Produk ada

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua produk terbaru
        $produks = Produk::latest()->get();

        // Kirim data ke view welcome.blade.php
        return view('welcome', compact('produks'));
    }
    public function catalog()
    {
        // Ambil semua produk
        $produks = Produk::all();

        // Kirim data ke view catalog.blade.php
        return view('catalog.index', compact('produks'));
    }
    
    
    
}
