@extends('layouts.app')

@push('styles')
<style>
    /* Animasi masuk lembut */
    @keyframes toastSoftIn {
        0% { opacity: 0; transform: translateY(6px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    /* Animasi keluar lembut */
    @keyframes toastSoftOut {
        0% { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(6px); }
    }

    .toast-in {
        animation: toastSoftIn 0.35s ease-out forwards;
    }

    .toast-out {
        animation: toastSoftOut 0.35s ease-in forwards;
    }
</style>
@endpush

@section('content')

    @if (session('success'))
        <div id="toastSuccess"
            class="fixed top-6 right-6 bg-[#4A2308] text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3
                   border border-[#E4D5C1] z-50 toast-in">

            <i class="fa-solid fa-circle-check text-white text-xl"></i>
            <span class="font-medium tracking-wide">{{ session('success') }}</span>
        </div>

        <script>
            setTimeout(() => {
                const toast = document.getElementById("toastSuccess");
                if (!toast) return;

                toast.classList.remove("toast-in");
                toast.classList.add("toast-out");

                setTimeout(() => toast.remove(), 350);
            }, 2300);
        </script>
    @endif



    <div class="container mx-auto px-6 py-10">

        {{-- Breadcrumb --}}
        <nav class="text-sm text-gray-500 mb-4 flex items-center gap-1">
            <a href="/" class="hover:text-gray-700">Beranda</a>
            <span>/</span>
            <a href="{{ route('katalog.index') }}" class="hover:text-gray-700">Produk</a>
            <span>/</span>
            <span class="text-gray-800 font-medium">{{ $produk->nama_produk }}</span>
        </nav>

        <div class="grid md:grid-cols-2 gap-12">

            {{-- Gambar Produk --}}
            <div class="space-y-4">
                <div class="bg-white rounded-3xl overflow-hidden shadow-xl p-6 border border-gray-200 group">
                    <img id="mainImage" src="{{ asset('storage/' . $produk->gambar) }}"
                        class="object-contain max-h-[460px] mx-auto transition duration-500 group-hover:scale-105">
                </div>

                <div class="flex gap-4">
                    @if ($produk->images)
                        @foreach ($produk->images as $image)
                            <img onclick="gantiGambar(this)"
                                src="{{ asset('storage/' . $image) }}"
                                class="thumb w-24 h-24 object-cover rounded-2xl border-2 border-gray-300 
                                       hover:border-[#B88753] cursor-pointer transition">
                        @endforeach
                    @endif
                </div>
            </div>


            {{-- Info Produk --}}
            <div class="flex flex-col justify-between">
                <div>

                    <h1 class="text-4xl font-bold text-gray-800 mb-3 leading-tight">
                        {{ $produk->nama_produk }}
                    </h1>

                    {{-- Harga --}}
                    <div class="flex items-end gap-3 mb-4">
                        <span class="text-4xl font-extrabold text-gray-900 tracking-tight">
                            Rp{{ number_format($produk->harga, 0, ',', '.') }}
                        </span>

                        @if ($produk->diskon)
                            <span class="text-gray-400 line-through text-lg">
                                Rp{{ number_format($produk->harga_asli, 0, ',', '.') }}
                            </span>
                            <span class="bg-[#8A5A32] text-white text-xs px-2 py-1 rounded-full font-semibold">
                                Hemat {{ $produk->diskon }}%
                            </span>
                        @endif
                    </div>

                    {{-- Rating --}}
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

                    {{-- Deskripsi --}}
                    <p class="text-gray-600 leading-relaxed text-[15px] mb-8">
                        {{ $produk->deskripsi }}
                    </p>

                    {{-- Qty + Add to Cart --}}
                    <div class="space-y-5">

                        <div class="flex items-center gap-2">
                            <button id="minusBtn"
                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md hover:bg-gray-100 active:scale-95">
                                -
                            </button>

                            <input id="qtyInput" type="text" value="1"
                                class="w-12 h-8 text-center border border-gray-300 rounded-md focus:ring-[#B88753]">

                            <button id="plusBtn"
                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-md hover:bg-gray-100 active:scale-95">
                                +
                            </button>
                        </div>

                        {{-- Form Tambah Keranjang --}}
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $produk->id }}">
                            <input type="hidden" name="qty" id="qtyHidden" value="1">

                            <button type="submit"
                                class="bg-[#8A5A32] hover:bg-[#6F4628] text-white px-8 py-3 rounded-full 
                                       font-semibold shadow-md transition flex items-center gap-2">
                                <i class="fa-solid fa-cart-plus"></i>
                                Tambah ke Keranjang
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>

        {{-- Rekomendasi --}}
        <div class="mt-20">
            <h2 class="font-bold text-2xl mb-8 text-[#4A2308] select-none text-center">Rekomendasi untuk Kamu</h2>

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                @foreach ($rekomendasi as $item)
                    <a href="{{ route('produk.show', $item->id) }}"
                        class="bg-white rounded-xl border border-[#E4D5C1] hover:border-[#C7A980] 
                               hover:shadow-xl transition relative p-5 block">

                        @if ($item->diskon)
                            <span class="absolute top-4 left-4 bg-red-600 text-white text-sm font-semibold px-3 py-1 rounded-lg">
                                -{{ $item->diskon }}%
                            </span>
                        @endif

                        <div class="overflow-hidden rounded-lg">
                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                class="w-full h-52 object-cover hover:scale-105 transition-transform duration-300">
                        </div>

                        <p class="font-semibold text-[#4A2308] text-base sm:text-lg mt-4 leading-snug line-clamp-2 hover:text-[#7A4A1E] transition-colors">
                            {{ $item->nama_produk }}
                        </p>

                        <div class="flex justify-between text-gray-600 text-sm mt-2">
                            <div class="flex items-center space-x-1 text-[#B8860B]">
                                <i class="fas fa-star text-[#B8860B]"></i>
                                <span>5/5</span>
                            </div>
                            <span>Terjual (0)</span>
                        </div>

                        <p class="text-[#4A2308] font-bold text-lg mt-2">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </p>

                    </a>
                @endforeach

            </div>
        </div>

    </div>


    {{-- SCRIPT --}}
    <script>
        function gantiGambar(el) {
            document.getElementById('mainImage').src = el.src;
            document.querySelectorAll('.thumb').forEach(t => t.classList.remove('border-[#B88753]'));
            el.classList.add('border-[#B88753]');
        }

        const qtyInput = document.getElementById('qtyInput');
        const qtyHidden = document.getElementById('qtyHidden');

        document.getElementById('minusBtn').onclick = () => {
            let v = parseInt(qtyInput.value);
            if (v > 1) qtyInput.value = v - 1;
            qtyHidden.value = qtyInput.value;
        };

        document.getElementById('plusBtn').onclick = () => {
            qtyInput.value = parseInt(qtyInput.value) + 1;
            qtyHidden.value = qtyInput.value;
        };

        qtyInput.oninput = () => qtyHidden.value = qtyInput.value;
    </script>

@endsection
