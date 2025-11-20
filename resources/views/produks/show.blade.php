@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">

    <!-- BREADCRUMB -->
    <nav class="text-sm text-gray-500 mb-4 flex items-center gap-1">
        <a href="/" class="hover:text-gray-700">Beranda</a>
        <span>/</span>
        <a href="{{ route('katalog.index') }}" class="hover:text-gray-700">Katalog</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">Produk</span>
    </nav>

    <div class="grid md:grid-cols-2 gap-12">

        <!-- GAMBAR PRODUK -->
        <div class="space-y-4">
            <div class="bg-white rounded-3xl overflow-hidden shadow-xl p-6 border border-gray-200 group">
                <img id="mainImage" 
                     src="{{ asset('storage/' . $produk->gambar) }}" 
                     alt="{{ $produk->nama_produk }}"
                     class="object-contain max-h-[460px] mx-auto transition duration-500 group-hover:scale-105">
            </div>

            <!-- THUMBNAIL -->
            <div class="flex gap-4">
                @if ($produk->images && count($produk->images) > 0)
                    @foreach ($produk->images as $image)
                        <img onclick="gantiGambar(this)" 
                             src="{{ asset('storage/' . $image) }}"
                             class="thumb w-24 h-24 object-cover rounded-2xl border-2 border-gray-300 hover:border-sky-500 cursor-pointer transition">
                    @endforeach
                @endif
            </div>
        </div>

        <!-- INFO PRODUK -->
        <div class="flex flex-col justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-3 leading-tight">
                    {{ $produk->nama_produk }}
                </h1>

                <!-- Harga -->
                <div class="flex items-end gap-3 mb-4">
                    <span class="text-4xl font-extrabold text-gray-900 tracking-tight">
                        Rp{{ number_format($produk->harga, 0, ',', '.') }}
                    </span>
                    @if ($produk->diskon)
                        <span class="text-gray-400 line-through text-lg">
                            Rp{{ number_format($produk->harga_asli, 0, ',', '.') }}
                        </span>
                        <span class="bg-sky-600 text-white text-xs px-2 py-1 rounded-full font-semibold">
                            Hemat {{ $produk->diskon }}%
                        </span>
                    @endif
                </div>

                <!-- Rating -->
                <div class="flex items-center gap-2 mb-5">
                    <div class="flex text-yellow-400 text-lg">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <span class="text-gray-500 text-sm">4.0 • 123 Ulasan</span>
                </div>

                <!-- Deskripsi -->
                <p class="text-gray-600 leading-relaxed text-[15px] mb-8">
                    {{ $produk->deskripsi }}
                </p>

                <!-- QTY + STOK -->
                <div class="space-y-5">

                    <div class="flex items-center gap-2">
                        <button id="minusBtn"
                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md hover:bg-gray-100 active:scale-95 transition">-</button>

                        <input id="qtyInput" type="text" value="1"
                               class="w-12 h-8 text-center border border-gray-300 rounded-md focus:ring-sky-400 focus:outline-none">

                        <button id="plusBtn"
                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md hover:bg-gray-100 active:scale-95 transition">+</button>
                    </div>

                    <!-- Tombol Keranjang -->
                    <button class="bg-sky-700 hover:bg-sky-800 text-white px-8 py-3 rounded-full font-semibold shadow-md transition w-fit flex items-center gap-2">
                        <i class="fa-solid fa-cart-plus"></i>
                        Tambah ke Keranjang
                    </button>

                </div>
            </div>
        </div>
    </div>

    <!-- REKOMENDASI PRODUK -->
<!-- REKOMENDASI PRODUK -->
<div class="mt-20">
    <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Rekomendasi untuk Kamu</h2>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($rekomendasi as $item)
            <a href="{{ route('produk.show', $item->id) }}"
               class="bg-white rounded-xl border border-gray-200 hover:border-gray-300 hover:shadow-xl transition relative p-5 block">

                @if ($item->diskon)
                    <span class="absolute top-4 left-4 bg-red-600 text-white text-sm font-semibold px-3 py-1 rounded-lg shadow-lg">
                        -{{ $item->diskon }}%
                    </span>
                @endif

                <div class="overflow-hidden rounded-lg">
                    <img src="{{ asset('storage/' . $item->gambar) }}"
                        alt="{{ $item->nama_produk }}"
                        class="w-full h-52 object-cover hover:scale-105 transition-transform duration-300 rounded-lg">
                </div>

                <p class="font-semibold text-gray-900 text-base mt-4 leading-snug line-clamp-2 hover:text-sky-600 transition">
                    {{ $item->nama_produk }}
                </p>

                <div class="flex justify-between text-gray-500 text-sm mt-2">
                    <div class="flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.462a1 1 0 00-.364 1.118l1.286 3.974c.3.921-.755 1.688-1.538 1.118l-3.388-2.462a1 1 0 00-1.176 0l-3.388 2.462c-.783.57-1.838-.197-1.538-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.4c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.974z" />
                        </svg>
                        <span>5/5</span>
                    </div>
                    <span>Terjual (0)</span>
                </div>

                <p class="text-black font-bold text-lg mt-2">
                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                </p>
            </a>
        @endforeach
    </div>
</div>


</div>

<script>
    function gantiGambar(el) {
        document.getElementById('mainImage').src = el.src;
        document.querySelectorAll('.thumb').forEach(t => t.classList.remove('border-sky-500'));
        el.classList.add('border-sky-500');
    }

    const minusBtn = document.getElementById('minusBtn');
    const plusBtn = document.getElementById('plusBtn');
    const qtyInput = document.getElementById('qtyInput');

    minusBtn.addEventListener('click', () => {
        let val = parseInt(qtyInput.value);
        if (val > 1) qtyInput.value = val - 1;
    });

    plusBtn.addEventListener('click', () => {
        qtyInput.value = parseInt(qtyInput.value) + 1;
    });
</script>

@endsection
