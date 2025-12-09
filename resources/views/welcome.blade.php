@extends('layouts.app')

@section('title', 'Beranda - FinLoka')

@section('content')

    {{-- HERO FULL WIDTH --}}
@section('hero')
    @include('components.hero-fullwidth')
@endsection


<main class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 py-8">

    {{-- KATEGORI PRODUK --}}
    <section class="mb-16">
        <h2 class="font-bold text-2xl mb-6 text-[#4A2308] select-none text-center">
            Kategori Produk
        </h2>

        <div class="flex justify-center flex-wrap gap-6 snap-x snap-mandatory scrollbar-thin pb-2">

            @foreach (['Ruang Tamu', 'Ruang Keluarga', 'Kamar Tidur', 'Ruang Kerja'] as $kategori)
                <div class="flex-shrink-0 w-32 snap-center text-center">
                    <a href="{{ route('katalog.index', ['kategori' => $kategori]) }}" class="block">

                        <div
                            class="bg-[#F7EED6] p-4 rounded-full mx-auto w-24 h-24
                        flex items-center justify-center shadow hover:bg-[#EED9B7] transition">

                            @if ($kategori == 'Ruang Tamu')
                                <i class="fas fa-couch text-3xl text-[#7A4A1E]"></i>
                            @elseif ($kategori == 'Ruang Keluarga')
                                <i class="fas fa-tv text-3xl text-[#7A4A1E]"></i>
                            @elseif ($kategori == 'Kamar Tidur')
                                <i class="fas fa-bed text-3xl text-[#7A4A1E]"></i>
                            @else
                                <i class="fas fa-desktop text-3xl text-[#7A4A1E]"></i>
                            @endif

                        </div>

                        <p class="mt-3 text-gray-700 font-medium text-sm">
                            {{ $kategori }}
                        </p>

                    </a>
                </div>
            @endforeach

        </div>
    </section>



    {{-- PRODUK UNTUKMU --}}
    <section class="mb-20">
        <h2 class="font-bold text-2xl mb-8 text-[#4A2308] select-none text-center">Produk Untukmu</h2>

        <div class="mb-6 rounded-2xl overflow-hidden shadow-md">
            <img src="{{ asset('img/1.jpeg') }}" alt="Banner" class="w-full object-cover h-52 md:h-64" />
        </div>

        <div id="productList" class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach ($produks as $p)
                <a href="{{ route('produk.show', $p->id) }}"
                    class="product-item hidden bg-white rounded-xl border border-[#E4D5C1]
                    hover:border-[#C7A980] hover:shadow-xl transition relative p-5 block">

                    @if ($p->diskon)
                        <span
                            class="absolute top-4 left-4 bg-red-600 text-white text-sm font-semibold
                            px-3 py-1 rounded-lg shadow-lg">-{{ $p->diskon }}%</span>
                    @endif

                    <div class="overflow-hidden rounded-lg">
                        <img src="{{ asset('storage/' . $p->gambar) }}"
                            class="w-full h-52 object-cover hover:scale-105 transition-transform duration-300">
                    </div>

                    <p
                        class="font-semibold text-[#4A2308] text-base sm:text-lg mt-4 leading-snug line-clamp-2
                        hover:text-[#7A4A1E] transition-colors duration-300">
                        {{ $p->nama_produk }}
                    </p>

                    <div class="flex justify-between text-gray-600 text-sm mt-2">
                        <div class="flex items-center space-x-1 text-[#B8860B]">
                            <i class="fas fa-star text-[#B8860B]"></i>
                            <span>5/5</span>
                        </div>
                        <span>Terjual (0)</span>
                    </div>

                    <p class="text-[#4A2308] font-bold text-lg mt-2">
                        Rp {{ number_format($p->harga, 0, ',', '.') }}
                    </p>
                </a>
            @endforeach

        </div>

        <div class="text-center mt-10">
            <button id="loadMoreBtn"
                class="bg-[#7A4A1E] hover:bg-[#4A2308] text-white px-6 py-2 rounded-lg
                font-medium shadow transition">
                Lihat Lebih Banyak
            </button>
        </div>
    </section>

</main>

@endsection



{{-- SCRIPT --}}
@push('scripts')
<script>
    // PRODUK UNTUKMU - LOAD MORE
    document.addEventListener("DOMContentLoaded", function() {
        const products = document.querySelectorAll(".product-item");
        const loadMoreBtn = document.getElementById("loadMoreBtn");

        let visibleCount = 4;
        const increment = 4;

        for (let i = 0; i < visibleCount && i < products.length; i++) {
            products[i].classList.remove("hidden");
        }

        loadMoreBtn.addEventListener("click", () => {
            for (let i = visibleCount; i < visibleCount + increment && i < products.length; i++) {
                products[i].classList.remove("hidden");
            }

            visibleCount += increment;

            if (visibleCount >= products.length) {
                loadMoreBtn.style.display = "none";
            }
        });
    });
</script>
@endpush
