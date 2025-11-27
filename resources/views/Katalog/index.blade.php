@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
<section class="mb-20">

    <h2 class="font-bold text-2xl mb-8 text-[#4A2308] select-none text-center">Produk</h2>

    <nav class="text-sm text-gray-500 mb-4 flex items-center gap-1">
        <a href="/" class="hover:text-gray-700">Beranda</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">Produk</span>
    </nav>

    <!-- LIST PRODUK -->
    <div id="productList" class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach ($produks as $p)
        <a href="{{ route('produk.show', $p->id) }}"
            class="bg-white rounded-xl border border-[#E4D5C1]
                   hover:border-[#C7A980] hover:shadow-xl transition relative p-5 block">

            {{-- DISKON --}}
            @if ($p->diskon)
                <span class="absolute top-4 left-4 bg-red-600 text-white text-sm
                             font-semibold px-3 py-1 rounded-lg shadow-lg">
                    -{{ $p->diskon }}%
                </span>
            @endif

            {{-- GAMBAR --}}
            <div class="overflow-hidden rounded-lg">
                <img src="{{ asset('storage/' . $p->gambar) }}"
                     alt="{{ $p->nama_produk }}"
                     class="w-full h-52 object-cover hover:scale-105 transition-transform duration-300">
            </div>

            {{-- NAMA PRODUK --}}
            <p class="font-semibold text-[#4A2308] text-base sm:text-lg mt-4 leading-snug line-clamp-2
                       hover:text-[#7A4A1E] transition-colors duration-300">
                {{ $p->nama_produk }}
            </p>

            {{-- RATING & TERJUAL --}}
            <div class="flex justify-between text-gray-600 text-sm mt-2">
                <div class="flex items-center space-x-1 text-[#B8860B]">
                    <i class="fas fa-star text-[#B8860B]"></i>
                    <span>5/5</span>
                </div>
                <span>Terjual (0)</span>
            </div>

            {{-- HARGA --}}
            <p class="text-[#4A2308] font-bold text-lg mt-2">
                Rp {{ number_format($p->harga, 0, ',', '.') }}
            </p>

        </a>
        @endforeach

    </div>

    <!-- PAGINATION -->
    <div class="text-center mt-10">
        {{ $produks->appends(request()->query())->links() }}
    </div>

</section>
@endsection
