@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')

<section class="mb-24">

    <!-- Judul -->
    <h2 class="font-bold text-2xl mb-8 text-[#4A2308] select-none text-center">
        Pembayaran Berhasil 
    </h2>

    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 mb-6 flex items-center justify-center gap-1">
        <a href="/" class="hover:text-gray-700">Beranda</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">Pembayaran Berhasil</span>
    </nav>

    <!-- Card -->
    <div class="max-w-lg mx-auto bg-white rounded-xl border border-[#E4D5C1]
                p-8 shadow-sm text-center">

        <div class="text-green-600 text-6xl mb-4">
            <i class="fas fa-check-circle"></i>
        </div>

        <h3 class="text-xl font-semibold text-[#4A2308] mb-4">
            Pembayaran Anda Telah Berhasil!
        </h3>

        <p class="text-gray-600 mb-6">
            Terima kasih telah melakukan pembayaran. Pesanan Anda sedang kami proses.
        </p>

        <a href="{{ route('home') }}"
            class="inline-block bg-[#8A5A32] hover:bg-[#6F4628] text-white px-6 py-3
                   rounded-lg font-semibold transition">
            Kembali ke Beranda
        </a>

    </div>

</section>

@endsection
