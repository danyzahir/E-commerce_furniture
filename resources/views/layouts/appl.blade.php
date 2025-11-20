<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Funiloka')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        /* Menghilangkan kedip saat load */
        body { visibility: hidden; }
        html.loaded body { visibility: visible; }
    </style>

    <script>
        window.addEventListener("load", function () {
            document.documentElement.classList.add("loaded");
        });
    </script>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- HEADER MOBILE -->
    <header
        class="md:hidden bg-gradient-to-r from-sky-700 to-sky-900 text-white px-5 py-4 
               shadow-lg rounded-b-3xl flex items-center justify-between">

        <!-- Logo + Title -->
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-md">
                <i class="ri-dashboard-fill text-xl"></i>
            </div>
            <h1 class="font-semibold text-lg tracking-wide">Funiloka Admin</h1>
        </div>

        <!-- User + Logout -->
        <div class="flex items-center gap-3">

            <!-- Icon User -->
            <div class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md 
                        flex items-center justify-center text-white">
                <i class="ri-user-3-line text-xl"></i>
            </div>

            <!-- Logout Button -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="p-2 bg-white/20 backdrop-blur-md rounded-xl hover:bg-white/30 transition">
                    <i class="ri-logout-box-r-line text-xl"></i>
                </button>
            </form>

        </div>
    </header>



    <div class="flex min-h-screen">

        <!-- SIDEBAR DEKSTOP -->
        <aside class="hidden md:flex md:flex-col w-64 
                      bg-gradient-to-b from-sky-700 to-sky-900 
                      text-white shadow-xl">

            <div class="px-6 py-5 border-b border-white/10">
                <h2 class="font-bold text-xl">
                    Funiloka<span class="text-sky-300">Admin</span>
                </h2>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 text-sm">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                    @if(request()->routeIs('admin.dashboard')) bg-sky-700 @else hover:bg-sky-600 @endif">
                    <i class="ri-dashboard-line"></i> Dashboard
                </a>

                <a href="{{ route('admin.produk.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                    @if(request()->routeIs('admin.produk.*')) bg-sky-700 @else hover:bg-sky-600 @endif">
                    <i class="ri-box-3-line"></i> Produk
                </a>

                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                    @if(request()->routeIs('admin.categories.*')) bg-sky-700 @else hover:bg-sky-600 @endif">
                    <i class="ri-folder-3-line"></i> Kategori
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg transition
                    @if(request()->routeIs('admin.users.*')) bg-sky-700 @else hover:bg-sky-600 @endif">
                    <i class="ri-user-line"></i> Users
                </a>
            </nav>

            <div class="px-6 py-4 border-t border-white/10 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="ri-user-3-line text-xl text-sky-300"></i>
                    <span>{{ Auth::user()->name }}</span>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="py-2 px-3 bg-sky-800 hover:bg-sky-700 rounded-lg text-sm">
                        <i class="ri-logout-box-line text-lg"></i>
                    </button>
                </form>
            </div>
        </aside>


        <!-- MAIN CONTENT -->
        <main class="flex-1 p-5 md:p-10 pb-32">
            @yield('content')
        </main>

    </div>

    <!-- BOTTOM NAV MOBILE -->
    <nav
        class="md:hidden fixed bottom-2 left-1/2 -translate-x-1/2 
        bg-white/80 backdrop-blur-xl rounded-2xl shadow-lg border border-white/30
        w-[90%] max-w-md z-40 px-6 py-2">

        <div class="grid grid-cols-4 text-center text-xs font-medium">

            <a href="{{ route('admin.dashboard') }}"
                class="flex flex-col items-center py-2 
                {{ request()->routeIs('admin.dashboard') ? 'text-sky-600' : 'text-gray-500' }}">
                <i class="ri-dashboard-line text-xl"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.produk.index') }}"
                class="flex flex-col items-center py-2 
                {{ request()->routeIs('admin.produk.*') ? 'text-sky-600' : 'text-gray-500' }}">
                <i class="ri-box-3-line text-xl"></i>
                Produk
            </a>

            <a href="{{ route('admin.categories.index') }}"
                class="flex flex-col items-center py-2 
                {{ request()->routeIs('admin.categories.*') ? 'text-sky-600' : 'text-gray-500' }}">
                <i class="ri-folder-3-line text-xl"></i>
                Kategori
            </a>

            <a href="{{ route('admin.users.index') }}"
                class="flex flex-col items-center py-2 
                {{ request()->routeIs('admin.users.*') ? 'text-sky-600' : 'text-gray-500' }}">
                <i class="ri-user-line text-xl"></i>
                Users
            </a>
        </div>

    </nav>

</body>
</html>
