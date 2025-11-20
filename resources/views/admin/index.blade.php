@extends('layouts.appl')

@section('title', 'Manajemen Produk')

@section('content')

 <main class="flex-1 p-6 md:p-10 mt-12 md:mt-0">

            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Dashboard Admin</h1>

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-10">
                <div class="bg-white rounded-2xl p-4 md:p-5 shadow border border-gray-200">
                    <p class="text-gray-500 text-sm mb-1">Total Produk</p>
                    <h2 class="text-xl md:text-2xl font-bold text-sky-700">128</h2>
                </div>

                <div class="bg-white rounded-2xl p-4 md:p-5 shadow border border-gray-200">
                    <p class="text-gray-500 text-sm mb-1">Pesanan Hari Ini</p>
                    <h2 class="text-xl md:text-2xl font-bold text-sky-700">36</h2>
                </div>

                <div class="bg-white rounded-2xl p-4 md:p-5 shadow border border-gray-200">
                    <p class="text-gray-500 text-sm mb-1">Pendapatan Bulan Ini</p>
                    <h2 class="text-xl md:text-2xl font-bold text-sky-700">Rp 42.500.000</h2>
                </div>

                <div class="bg-white rounded-2xl p-4 md:p-5 shadow border border-gray-200">
                    <p class="text-gray-500 text-sm mb-1">Pelanggan Baru</p>
                    <h2 class="text-xl md:text-2xl font-bold text-sky-700">15</h2>
                </div>
            </div>

        </main>

@endsection
