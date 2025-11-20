<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FinLoka')</title>
    <!-- Menambahkan Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    {{-- TailwindCSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')

    {{-- Custom Style --}}
    <style>
        .scrollbar-thin::-webkit-scrollbar {
            height: 6px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background-color: #38bdf8;
            border-radius: 20px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background-color: #e0f2fe;
            border-radius: 20px;
        }

        .slider-dot.active {
            background-color: #0ea5e9 !important;
            transform: scale(1.3);
        }
    </style>

    @stack('styles')
</head>

<body class="bg-white font-sans text-gray-800">

    {{-- HEADER --}}
    {{-- HEADER --}}
    <header class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between py-2">

            {{-- LOGO --}}
            <div class="flex items-center space-x-3 select-none">
                <img src="{{ asset('img/Logo1.png') }}" alt="FinLoka Logo"
                    class="h-12 w-auto object-contain drop-shadow">
            </div>

            {{-- SEARCH BAR --}}
            <div class="hidden md:block flex-grow mx-6 max-w-md">
                <input type="text" placeholder="Cari produk..."
                    class="w-full rounded-full px-4 py-2.5 bg-gray-100 text-gray-700 border border-gray-200 focus:ring-2 focus:ring-sky-400 focus:outline-none placeholder-gray-500">
            </div>

            {{-- ICONS --}}
            <div class="flex items-center space-x-4">
                {{-- KERANJANG --}}
                <a href="{{ route('cart.index') }}" aria-label="Keranjang" class="relative group">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-gray-700 group-hover:text-sky-600 transition-transform duration-200"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h14l-1.5 8H6.4L5 6H21" />
                    </svg>
                    <span
                        class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold rounded-full px-1.5 shadow-md">
                        3
                    </span>
                </a>


                {{-- GARIS PEMISAH --}}
                <div class="h-6 w-px bg-gray-300 hidden md:block"></div>

                @guest
                    <a href="{{ route('login') }}"
                        class="bg-white text-sky-600 font-semibold px-4 py-1.5 rounded-full border border-sky-400 hover:bg-sky-50 transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-sky-600 text-white font-semibold px-4 py-1.5 rounded-full hover:bg-sky-700 transition">
                        Daftar
                    </a>
                @else
                    {{-- ICON USER --}}
                    <div class="relative">
                        <button id="userMenuButton"
                            class="flex items-center justify-center w-9 h-9 rounded-full bg-sky-600 text-white font-bold focus:outline-none">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </button>

                        {{-- DROPDOWN --}}
                        <div id="userDropdown"
                            class="hidden absolute right-0 mt-3 w-60 bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">

                            {{-- Header --}}
                            <div class="bg-sky-600 text-white px-4 py-3 flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white/30 font-semibold text-lg">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="font-semibold leading-tight">{{ Auth::user()->name }}</p>
                                    <p class="text-sm opacity-90">{{ Auth::user()->email }}</p>
                                </div>
                            </div>

                            {{-- Tombol Logout --}}
                            <form action="{{ route('logout') }}" method="POST" class="border-t border-gray-200">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2.5 text-red-600 hover:bg-red-50 transition flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                                    </svg>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- SCRIPT DROPDOWN --}}
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            const btn = document.getElementById("userMenuButton");
                            const dropdown = document.getElementById("userDropdown");
                            btn.addEventListener("click", () => dropdown.classList.toggle("hidden"));
                            document.addEventListener("click", (e) => {
                                if (!btn.contains(e.target) && !dropdown.contains(e.target)) dropdown.classList.add(
                                    "hidden");
                            });
                        });
                    </script>
                @endguest
            </div>
        </div>
    </header>


    {{-- ISI HALAMAN --}}
    <main class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 py-8">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="relative bg-sky-700 bg-gradient-to-br from-sky-600 to-sky-800 text-white pt-12 pb-8 mt-20">
        <div class="absolute inset-0 bg-gradient-to-br from-sky-600 to-sky-800 opacity-95 -z-10"></div>

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 grid grid-cols-1 md:grid-cols-3 gap-10 relative z-10">
            {{-- LOGO + DESKRIPSI --}}
            <div>
                <p class="text-sky-100 text-sm leading-relaxed">
                    Platform belanja modern yang menghadirkan pengalaman bertransaksi cepat, aman, dan nyaman untuk
                    semua.
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
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5h2l3 7h10l3-7h2M16 13v5H8v-5" />
                        </svg>
                        +62 812 3456 7890
                    </li>
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12H8m8 0V6a2 2 0 00-2-2H8a2 2 0 00-2 2v12a2 2 0 002 2h4" />
                        </svg>
                        support@finloka.com
                    </li>
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-sky-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 11c.828 0 1.5-.672 1.5-1.5S12.828 8 12 8s-1.5.672-1.5 1.5S11.172 11 12 11z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 22s8-4.5 8-11a8 8 0 10-16 0c0 6.5 8 11 8 11z" />
                        </svg>
                        Jakarta, Indonesia
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="border-t border-white/20 mt-10 pt-6 text-center text-sky-100 text-sm max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10">
            © 2025 FinLoka. Semua hak cipta dilindungi.
        </div>
    </footer>


    @stack('scripts')
</body>

</html>
