<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" x-cloak>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin - FinLoka</title>
  @vite('resources/css/app.css')
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gradient-to-b from-sky-700 to-sky-900 text-white hidden md:flex flex-col shadow-lg">
      <div class="px-6 py-5 text-center font-bold text-2xl border-b border-white/10">
        FinLoka<span class="text-sky-300">Admin</span>
      </div>

      <nav class="flex-1 px-4 py-6 space-y-2 text-sm">
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors duration-200 
                  @if(request()->routeIs('admin.dashboard')) bg-sky-700 @else hover:bg-sky-600 @endif">
          <i class="ri-dashboard-line"></i> Dashboard
        </a>

        <a href="{{ route('admin.produk.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors duration-200
                  @if(request()->routeIs('admin.produk.*')) bg-sky-700 @else hover:bg-sky-600 @endif">
          <i class="ri-box-3-line"></i> Produk
        </a>

        <a href="{{ route('admin.categories.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors duration-200
                  @if(request()->routeIs('admin.categories.*')) bg-sky-700 @else hover:bg-sky-600 @endif">
          <i class="ri-folder-3-line"></i> Kategori
        </a>

        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors duration-200 hover:bg-sky-600">
          <i class="ri-shopping-bag-3-line"></i> Pesanan
        </a>

        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors duration-200 hover:bg-sky-600">
          <i class="ri-user-line"></i> Pelanggan
        </a>

        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors duration-200 hover:bg-sky-600">
          <i class="ri-bar-chart-2-line"></i> Laporan
        </a>
      </nav>

      <div class="px-6 py-4 border-t border-white/10">
        <form action="" method="POST">
          @csrf
          <button type="submit" class="w-full py-2 bg-sky-800 hover:bg-sky-700 rounded-lg text-sm font-medium">
            Keluar
          </button>
        </form>
      </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6 md:p-10 transition-all duration-200">
      <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Admin</h1>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white rounded-2xl p-5 shadow hover:shadow-md border border-gray-200">
          <p class="text-gray-500 text-sm mb-1">Total Produk</p>
          <h2 class="text-2xl font-bold text-sky-700">128</h2>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow hover:shadow-md border border-gray-200">
          <p class="text-gray-500 text-sm mb-1">Pesanan Hari Ini</p>
          <h2 class="text-2xl font-bold text-sky-700">36</h2>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow hover:shadow-md border border-gray-200">
          <p class="text-gray-500 text-sm mb-1">Pendapatan Bulan Ini</p>
          <h2 class="text-2xl font-bold text-sky-700">Rp 42.500.000</h2>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow hover:shadow-md border border-gray-200">
          <p class="text-gray-500 text-sm mb-1">Pelanggan Baru</p>
          <h2 class="text-2xl font-bold text-sky-700">15</h2>
        </div>
      </div>
    </main>

  </div>

</body>
</html>
