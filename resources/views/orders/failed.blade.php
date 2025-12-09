@extends('layouts.app')

@section('title', 'Pembayaran Gagal')

@section('content')

<section class="mb-24">

    <!-- Judul -->
    
    <h2 class="font-bold text-2xl mb-8 text-[#4A2308] select-none text-center">
        Pembayaran Gagal 
    </h2>

    <!-- Breadcrumb -->

    <nav class="text-sm text-gray-500 mb-6 flex items-center justify-center gap-1">
        <a href="/" class="hover:text-gray-700">Beranda</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">Pembayaran Gagal</span>
    </nav>

    <!-- Card -->

    <div class="max-w-lg mx-auto bg-white rounded-xl border border-[#E4D5C1]
                p-8 shadow-sm text-center">

        <div class="text-red-600 text-6xl mb-4">
            <i class="fas fa-times-circle"></i>
        </div>

        <h3 class="text-xl font-semibold text-[#4A2308] mb-4">
            Pembayaran Tidak Berhasil
        </h3>

        <p class="text-gray-600 mb-6">
            Order ID: <strong class="text-[#4A2308]">#{{ $id }}</strong><br>
            Sepertinya terjadi masalah saat proses pembayaran.<br>
            Silakan coba lagi.
        </p>

        <a href="{{ route('cart.index') }}"
            class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-3
                   rounded-lg font-semibold transition">
            Kembali ke Keranjang
        </a>

    </div>

</section>

@endsection
