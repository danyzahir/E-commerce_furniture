<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'FinLoka')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .scrollbar-thin::-webkit-scrollbar { height: 6px; }
    .scrollbar-thin::-webkit-scrollbar-thumb { background-color: #38bdf8; border-radius: 20px; }
    .scrollbar-thin::-webkit-scrollbar-track { background-color: #e0f2fe; border-radius: 20px; }
    .slider-dot.active { background-color: #0ea5e9 !important; transform: scale(1.3); }
  </style>
  @stack('styles')
</head>
<body class="bg-white font-sans text-gray-800">

  {{-- HEADER --}}
  <header class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-white/10">
    <div class="container mx-auto flex items-center justify-between px-6 py-3">
      
      {{-- LOGO --}}
      <div class="flex items-center space-x-2 select-none">
        <div class="bg-white/20 p-2 rounded-xl shadow-inner">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
        </div>
        <span class="font-extrabold text-2xl text-sky-700 tracking-wide drop-shadow">FinLoka</span>
      </div>

      {{-- SEARCH BAR --}}
      <div class="flex-grow mx-6 hidden md:block max-w-md">
        <input type="text" placeholder="Cari produk..."
          class="w-full rounded-full px-5 py-2.5 bg-white/80 text-gray-700 border border-sky-200 focus:ring-2 focus:ring-sky-300 focus:outline-none placeholder-gray-500 shadow-inner" />
      </div>

      {{-- ACTIONS --}}
      <div class="flex items-center space-x-4">
        {{-- CART --}}
        <button aria-label="Keranjang" class="relative group">
          <svg xmlns="http://www.w3.org/2000/svg"
            class="w-7 h-7 text-black group-hover:scale-110 transition-transform duration-200"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3h2l.4 2M7 13h14l-1.5 8H6.4L5 6H21" />
          </svg>
          <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold rounded-full px-1.5 shadow-md border border-white/80">
            3
          </span>
        </button>

        <div class="h-6 w-px bg-gray-300"></div>

        {{-- BUTTON LOGIN / REGISTER --}}
        <button class="bg-white text-sky-600 font-semibold px-5 py-1.5 rounded-full border border-sky-400 hover:bg-sky-50 transition shadow-sm">
          Masuk
        </button>
        <button class="bg-sky-700 text-white font-semibold px-5 py-1.5 rounded-full hover:bg-sky-800 transition shadow-md">
          Daftar
        </button>
      </div>
    </div>
  </header>

  {{-- ISI HALAMAN --}}
  <main class="container mx-auto px-6 py-8">
    @yield('content')
  </main>

  {{-- FOOTER --}}
  <footer class="bg-gradient-to-br from-sky-600 to-sky-800 text-white pt-12 pb-8 mt-20">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 px-6">
      
      {{-- LOGO + DESKRIPSI --}}
      <div>
        <div class="flex items-center space-x-2 mb-3">
          <div class="bg-white/20 p-2 rounded-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
          </div>
          <span class="font-extrabold text-xl tracking-wide">FinLoka</span>
        </div>
        <p class="text-sky-100 text-sm leading-relaxed">
          Platform belanja modern yang menghadirkan pengalaman bertransaksi cepat, aman, dan nyaman untuk semua.
        </p>
      </div>

      {{-- TAUTAN CEPAT --}}
      <div>
        <h3 class="font-semibold text-lg mb-3 text-white/90">Tautan Cepat</h3>
        <ul class="space-y-2 text-sky-100 text-sm">
          <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
          <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
          <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
          <li><a href="#" class="hover:text-white transition">Hubungi Kami</a></li>
        </ul>
      </div>

      {{-- KONTAK --}}
      <div>
        <h3 class="font-semibold text-lg mb-3 text-white/90">Kontak</h3>
        <ul class="space-y-2 text-sky-100 text-sm">
          <li>📞 +62 812 3456 7890</li>
          <li>📧 support@finloka.com</li>
          <li>📍 Jakarta, Indonesia</li>
        </ul>
      </div>
    </div>

    {{-- COPYRIGHT --}}
    <div class="border-t border-white/20 mt-10 pt-6 text-center text-sky-100 text-sm">
      © 2025 FinLoka. Semua hak cipta dilindungi.
    </div>
  </footer>

  @stack('scripts')
</body>
</html>
