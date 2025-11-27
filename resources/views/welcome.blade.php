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
        <h2 class="font-bold text-2xl mb-6 text-[#4A2308] select-none text-center">Kategori Produk</h2>

        <div class="flex justify-center flex-wrap gap-6 snap-x snap-mandatory scrollbar-thin pb-2">
            @foreach (['Ruang Tamu', 'Kamar Tidur', 'Ruang Kerja'] as $kategori)
                <div class="flex-shrink-0 w-32 snap-center text-center">
                    <a href="{{ route('katalog.index', ['kategori' => $kategori]) }}" class="block">

                        <div class="bg-[#F7EED6] p-4 rounded-full mx-auto w-24 h-24
                            flex items-center justify-center shadow hover:bg-[#EED9B7] transition">

                            @if ($kategori == 'Ruang Tamu')
                                <i class="fas fa-couch text-3xl text-[#7A4A1E]"></i>
                            @elseif($kategori == 'Kamar Tidur')
                                <i class="fas fa-bed text-3xl text-[#7A4A1E]"></i>
                            @else
                                <i class="fas fa-desktop text-3xl text-[#7A4A1E]"></i>
                            @endif

                        </div>

                        <p class="mt-3 text-gray-700 font-medium text-sm">{{ $kategori }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </section>



    {{-- PRODUK TERLARIS --}}
    <section class="mb-20 relative">
        <h2 class="font-bold text-2xl mb-6 text-[#4A2308] select-none text-center">Produk Terlaris</h2>

        <div class="mb-6 rounded-2xl overflow-hidden shadow-md">
            <img src="{{ asset('img/1.jpeg') }}" alt="Banner"
                 class="w-full object-cover h-52 md:h-64" />
        </div>

        <div class="relative">
            <button id="prevProductBtn"
                class="absolute top-1/2 -left-4 -translate-y-1/2 bg-white/80 text-[#7A4A1E]
                hover:bg-[#7A4A1E] hover:text-white w-12 h-12 rounded-full
                flex items-center justify-center shadow-lg z-10 transition">
                <i class="fas fa-chevron-left text-lg"></i>
            </button>

            <div id="productCarousel" class="flex overflow-hidden scroll-smooth space-x-6 px-2 md:px-6"></div>

            <button id="nextProductBtn"
                class="absolute top-1/2 -right-4 -translate-y-1/2 bg-white/80 text-[#7A4A1E]
                hover:bg-[#7A4A1E] hover:text-white w-12 h-12 rounded-full
                flex items-center justify-center shadow-lg z-10 transition">
                <i class="fas fa-chevron-right text-lg"></i>
            </button>
        </div>
    </section>



    {{-- PRODUK UNTUKMU --}}
    <section class="mb-20">
        <h2 class="font-bold text-2xl mb-8 text-[#4A2308] select-none text-center">Produk Untukmu</h2>

        <div id="productList" class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach ($produks as $p)
                <a href="{{ route('produk.show', $p->id) }}"
                    class="product-item hidden bg-white rounded-xl border border-[#E4D5C1]
                    hover:border-[#C7A980] hover:shadow-xl transition relative p-5 block">

                    @if ($p->diskon)
                    <span class="absolute top-4 left-4 bg-red-600 text-white text-sm font-semibold
                        px-3 py-1 rounded-lg shadow-lg">-{{ $p->diskon }}%</span>
                    @endif

                    <div class="overflow-hidden rounded-lg">
                        <img src="{{ asset('storage/' . $p->gambar) }}"
                             class="w-full h-52 object-cover hover:scale-105 transition-transform duration-300">
                    </div>

                    <p class="font-semibold text-[#4A2308] text-base sm:text-lg mt-4 leading-snug line-clamp-2
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
    // PRODUK TERLARIS (DUMMY)
    const products = [
        { img: "https://via.placeholder.com/250x200?text=Kursi+1", name: "New Tolix Wood High Stool H76cm", price: 599000 },
        { img: "https://via.placeholder.com/250x200?text=Meja+1", name: "Jessica-B Aluminium Table Base", price: 579000 },
        { img: "https://via.placeholder.com/250x200?text=Sofa", name: "Elegant Brown Sofa", price: 2500000 },
        { img: "https://via.placeholder.com/250x200?text=Lampu", name: "Modern Lamp Gold Edition", price: 450000 }
    ];

    const productCarousel = document.getElementById("productCarousel");

    products.forEach(p => {
        productCarousel.innerHTML += `
        <div class="min-w-[250px] bg-white rounded-xl shadow hover:shadow-lg
            transition relative p-4 border border-[#E4D5C1]">
            <img src="${p.img}" class="rounded-md mb-3 w-full h-40 object-cover">
            <p class="font-semibold text-[#4A2308] mb-1 truncate">${p.name}</p>
            <p class="text-[#4A2308] font-bold text-lg">Rp ${p.price.toLocaleString("id-ID")}</p>
        </div>`;
    });

    document.getElementById("prevProductBtn").onclick = () =>
        productCarousel.scrollBy({ left: -260, behavior: "smooth" });

    document.getElementById("nextProductBtn").onclick = () =>
        productCarousel.scrollBy({ left: 260, behavior: "smooth" });

    // PRODUK UNTUKMU
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
            if (visibleCount >= products.length) loadMoreBtn.style.display = "none";
        });
    });
</script>
@endpush
