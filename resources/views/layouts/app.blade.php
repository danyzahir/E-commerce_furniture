<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FinLoka')</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            visibility: hidden;
            opacity: 0;
            transition: opacity .25s ease-out;
        }

        html.loaded body {
            visibility: visible;
            opacity: 1;
        }

        .navlink {
            position: relative;
            padding-bottom: 4px;
        }

        .navlink::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0%;
            height: 2px;
            background-color: #B88753;
            transition: width 0.25s ease-out;
        }

        .navlink:hover::after {
            width: 100%;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.documentElement.classList.add("loaded");
        });
    </script>

    @stack('styles')
</head>

<body class="bg-[#FDF8F3] font-sans text-gray-900 min-h-screen flex flex-col">

    {{-- HEADER --}}
    <header class="bg-white/90 backdrop-blur-md shadow-md sticky top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between py-3">

            <div class="flex items-center space-x-3 select-none">
                <img src="{{ asset('img/Logooo.png') }}" alt="FinLoka Logo"
                    class="h-12 w-auto object-contain drop-shadow">
            </div>

            <div class="flex-1 flex justify-center">
                <nav class="hidden md:flex items-center gap-14 font-medium text-[15px]">
                    <a href="{{ route('home') }}" class="navlink">Home</a>
                    <a href="{{ route('katalog.index') }}" class="navlink">Produk</a>
                    <a href="#about" class="navlink">About</a>
                    <a href="#footer" class="navlink">Kontak</a>
                </nav>
            </div>

            <div class="flex items-center space-x-4">

                {{-- CART --}}
                <a href="{{ route('cart.index') }}" class="relative group">
                    <i class="fas fa-shopping-cart text-xl text-gray-700 group-hover:text-[#B88753] transition"></i>

                    @php
                        use App\Models\CartItem;
                        $cartCount = Auth::check() ? CartItem::where('user_id', Auth::id())->sum('qty') : 0;
                    @endphp

                    @if ($cartCount > 0)
                        <span
                            class="absolute -top-1 -right-2 bg-red-500 text-white text-[10px] font-bold rounded-full px-1.5 shadow-md">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                @guest
                    <a href="{{ route('login') }}"
                        class="bg-white text-[#8A5A32] font-semibold px-4 py-1.5 rounded-full border border-[#C8A67A] hover:bg-[#FAF4EB] transition">
                        Masuk
                    </a>

                    <a href="{{ route('register') }}"
                        class="bg-[#8A5A32] text-white font-semibold px-4 py-1.5 rounded-full hover:bg-[#6F4628] transition">
                        Daftar
                    </a>
                @else
                    {{-- USER MENU --}}
                    <div class="relative">
                        <button id="userMenuButton"
                            class="flex items-center justify-center w-9 h-9 rounded-full bg-[#8A5A32] text-white font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </button>

                        <div id="userDropdown"
                            class="hidden absolute right-0 mt-3 w-60 bg-white rounded-xl shadow-lg border border-[#E5D3C0]">

                            <div class="bg-[#8A5A32] text-white px-4 py-3 flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white/30 font-semibold text-lg">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="font-semibold leading-tight">{{ Auth::user()->name }}</p>
                                    <p class="text-sm opacity-90">{{ Auth::user()->email }}</p>
                                </div>
                            </div>

                            {{-- ✅ MENU PROFIL --}}
                            <a href="{{ route('profile') }}"
                               class="block px-4 py-2 text-gray-700 hover:bg-gray-100 flex items-center gap-2">
                               <i class="fas fa-user"></i> Profil Saya
                            </a>

                            {{-- LOGOUT --}}
                            <form action="{{ route('logout') }}" method="POST" class="border-t border-[#E7D8C9]">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2.5 text-red-600 hover:bg-red-50 flex items-center gap-2">
                                    <i class="fas fa-sign-out-alt"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            const btn = document.getElementById("userMenuButton");
                            const dropdown = document.getElementById("userDropdown");

                            btn.addEventListener("click", () => dropdown.classList.toggle("hidden"));

                            document.addEventListener("click", (e) => {
                                if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
                                    dropdown.classList.add("hidden");
                                }
                            });
                        });
                    </script>
                @endguest
            </div>
        </div>
    </header>

    {{-- HERO --}}
    @yield('hero')

    {{-- MAIN --}}
    <main class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 py-10 pb-20 flex-grow min-h-[900px] bg-[#FDF8F3]">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer id="footer"
        class="bg-[#7A4A26] bg-gradient-to-br from-[#8A5731] to-[#5A3016] text-white pt-14 pb-10 mt-auto">

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 grid grid-cols-1 md:grid-cols-3 gap-12">

            <div>
                <h3 class="text-white font-semibold text-lg mb-3">FinLoka Furniture</h3>
                <p class="text-white/80 text-sm leading-relaxed">
                    Platform belanja furniture modern dengan koleksi premium berkelas tinggi.
                    Mengutamakan kenyamanan, kecepatan, dan keamanan bertransaksi.
                </p>
            </div>

            <div>
                <h3 class="text-white font-semibold text-lg mb-4">Tautan Cepat</h3>
                <ul class="space-y-2 text-white/80 text-sm">
                    <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:text-white transition">Hubungi Kami</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-semibold text-lg mb-4">Kontak</h3>
                <ul class="space-y-3 text-white/80 text-sm">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-phone text-white"></i>
                        +62 812 3456 7890
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-envelope text-white"></i>
                        support@finloka.com
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-map-marker-alt text-white"></i>
                        Jakarta, Indonesia
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/20 mt-12 pt-6 text-center text-white/70 text-sm">
            © 2025 FinLoka. Semua hak cipta dilindungi.
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
