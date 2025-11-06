@extends('layouts.app')

@section('title', 'Beranda - FinLoka')

@section('content')
<main class="container mx-auto px-4 py-8">

  <!-- SLIDER -->
  <section class="relative overflow-hidden rounded-2xl shadow-lg mb-12 h-64 md:h-96 -mt-4 md:-mt-6">
    <div id="slider" class="flex transition-transform duration-700 ease-in-out h-full select-none">
      <div class="min-w-full bg-gradient-to-r from-sky-300 to-sky-500 flex items-center justify-center text-3xl md:text-4xl font-bold text-white">Promo Spesial Minggu Ini</div>
      <div class="min-w-full bg-gradient-to-r from-sky-400 to-blue-500 flex items-center justify-center text-3xl md:text-4xl font-bold text-white">Diskon 50% Produk Pilihan</div>
      <div class="min-w-full bg-gradient-to-r from-blue-400 to-sky-500 flex items-center justify-center text-3xl md:text-4xl font-bold text-white">Belanja Nyaman & Aman</div>
    </div>

    <button onclick="moveSlide(-1)" class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/80 backdrop-blur-md text-sky-700 hover:bg-sky-500 hover:text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-all duration-300">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
    </button>

    <button onclick="moveSlide(1)" class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/80 backdrop-blur-md text-sky-700 hover:bg-sky-500 hover:text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-all duration-300">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
    </button>

    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
      <span class="slider-dot w-3 h-3 bg-white/70 rounded-full transition"></span>
      <span class="slider-dot w-3 h-3 bg-white/50 rounded-full transition"></span>
      <span class="slider-dot w-3 h-3 bg-white/50 rounded-full transition"></span>
    </div>
  </section>

  <!-- KATEGORI -->
  <section class="mb-16">
    <h2 class="font-bold text-2xl mb-6 text-gray-800 select-none text-center">Kategori Produk</h2>
    <div class="flex justify-center flex-wrap gap-6 snap-x snap-mandatory scrollbar-thin pb-2">
      @foreach (['Perabotan','Dekorasi','Dapur'] as $i => $kategori)
        <div class="flex-shrink-0 w-32 snap-center text-center">
          <div class="bg-sky-100 p-4 rounded-full mx-auto w-24 h-24 flex items-center justify-center shadow hover:bg-sky-200 transition">
            <img src="https://via.placeholder.com/60x60?text=K{{ $i+1 }}" class="object-contain w-12 h-12" alt="{{ $kategori }}">
          </div>
          <p class="mt-3 text-gray-700 font-medium text-sm">{{ $kategori }}</p>
        </div>
      @endforeach
    </div>
  </section>

  <!-- PRODUK TERLARIS -->
<section class="mb-20">
  <h2 class="font-bold text-2xl mb-8 text-gray-800 select-none text-center">Produk Terlaris</h2>
  
  <div id="productGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8 place-items-center">
    @foreach($produks as $p)
    <div class="bg-white rounded-xl border border-gray-200 hover:border-gray-300 hover:shadow-xl transition relative p-5 w-[260px] sm:w-[280px]">
      @if($p->diskon)
        <span class="absolute top-4 left-4 bg-red-600 text-white text-sm font-semibold px-3 py-1 rounded-lg shadow-lg">-{{ $p->diskon }}%</span>
      @endif

      <div class="overflow-hidden rounded-lg">
        <img src="{{ asset('storage/'.$p->gambar) }}" alt="{{ $p->nama_produk }}" 
             class="w-full h-52 object-cover hover:scale-105 transition-transform duration-300 rounded-lg">
      </div>

      <p class="font-semibold text-gray-900 text-base sm:text-lg mt-4 leading-snug line-clamp-2 hover:text-sky-600 transition-colors duration-300">
        {{ $p->nama_produk }}
      </p>

      <div class="flex justify-between text-gray-500 text-sm mt-2">
        <div class="flex items-center space-x-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.462a1 1 0 00-.364 1.118l1.286 3.974c.3.921-.755 1.688-1.538 1.118l-3.388-2.462a1 1 0 00-1.176 0l-3.388 2.462c-.783.57-1.838-.197-1.538-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.4c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.974z" />
          </svg>
          <span>Belum ada rating</span>
        </div>
        <span>Terjual (0)</span>
      </div>

      <p class="text-black font-bold text-lg mt-2">Rp {{ number_format($p->harga,0,',','.') }}</p>
    </div>
    @endforeach
  </div>
</section>


  <!-- PRODUK UNTUKMU -->
<section class="mb-20">
  <h2 class="font-bold text-2xl mb-8 text-gray-800 select-none text-center">Produk Untukmu</h2>
  
  <div id="productGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8 place-items-center">
    @foreach($produks as $p)
    <div class="bg-white rounded-xl border border-gray-200 hover:border-gray-300 hover:shadow-xl transition relative p-5 w-[260px] sm:w-[280px]">
      @if($p->diskon)
        <span class="absolute top-4 left-4 bg-red-600 text-white text-sm font-semibold px-3 py-1 rounded-lg shadow-lg">-{{ $p->diskon }}%</span>
      @endif

      <div class="overflow-hidden rounded-lg">
        <img src="{{ asset('storage/'.$p->gambar) }}" alt="{{ $p->nama_produk }}" 
             class="w-full h-52 object-cover hover:scale-105 transition-transform duration-300 rounded-lg">
      </div>

      <p class="font-semibold text-gray-900 text-base sm:text-lg mt-4 leading-snug line-clamp-2 hover:text-sky-600 transition-colors duration-300">
        {{ $p->nama_produk }}
      </p>

      <div class="flex justify-between text-gray-500 text-sm mt-2">
        <div class="flex items-center space-x-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.462a1 1 0 00-.364 1.118l1.286 3.974c.3.921-.755 1.688-1.538 1.118l-3.388-2.462a1 1 0 00-1.176 0l-3.388 2.462c-.783.57-1.838-.197-1.538-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.4c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.974z" />
          </svg>
          <span>Belum ada rating</span>
        </div>
        <span>Terjual (0)</span>
      </div>

      <p class="text-black font-bold text-lg mt-2">Rp {{ number_format($p->harga,0,',','.') }}</p>
    </div>
    @endforeach
  </div>
</section>



</main>
@endsection

@push('scripts')
<script>
  // === SLIDER ===
  let slideIndex = 0;
  const slides = document.querySelectorAll("#slider > div");
  const dots = document.querySelectorAll(".slider-dot");

  function moveSlide(n) {
    slideIndex = (slideIndex + n + slides.length) % slides.length;
    document.getElementById("slider").style.transform = `translateX(-${slideIndex * 100}%)`;
    dots.forEach((d, i) => d.classList.toggle("bg-white/90", i === slideIndex));
  }

  setInterval(() => moveSlide(1), 4000);
</script>
@endpush
