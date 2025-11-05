<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin - FinLoka</title>
  @vite('resources/css/app.css')
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">

  <div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gradient-to-b from-sky-700 to-sky-900 text-white hidden md:flex flex-col shadow-lg">
      <div class="px-6 py-5 text-center font-bold text-2xl border-b border-white/10">
        FinLoka<span class="text-sky-300">Admin</span>
      </div>
      <nav class="flex-1 px-4 py-6 space-y-2 text-sm">
        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-600 transition"><i class="ri-dashboard-line"></i> Dashboard</a>
        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-600 transition"><i class="ri-box-3-line"></i> Produk</a>
        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-600 transition"><i class="ri-shopping-bag-3-line"></i> Pesanan</a>
        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-600 transition"><i class="ri-user-line"></i> Pelanggan</a>
        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-sky-600 transition"><i class="ri-bar-chart-2-line"></i> Laporan</a>
      </nav>
      <div class="px-6 py-4 border-t border-white/10">
        <button class="w-full py-2 bg-sky-800 hover:bg-sky-700 rounded-lg text-sm font-medium">Keluar</button>
      </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6 md:p-10">
      <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Admin</h1>

      <!-- CARD STATISTICS -->
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

      <!-- CHARTS -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
        <div class="bg-white p-6 rounded-2xl shadow border border-gray-200">
          <h3 class="font-semibold text-gray-700 mb-3">Grafik Penjualan</h3>
          <div class="h-64 flex items-center justify-center text-gray-400 text-sm border border-dashed border-gray-300 rounded-lg">
            (Grafik Penjualan Akan Ditampilkan di sini)
          </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow border border-gray-200">
          <h3 class="font-semibold text-gray-700 mb-3">Produk Terlaris</h3>
          <ul class="space-y-3">
            <li class="flex justify-between text-sm"><span>Meja Kayu Solid</span> <span class="font-semibold text-sky-700">120 terjual</span></li>
            <li class="flex justify-between text-sm"><span>Kursi Minimalis</span> <span class="font-semibold text-sky-700">98 terjual</span></li>
            <li class="flex justify-between text-sm"><span>Lampu Gantung</span> <span class="font-semibold text-sky-700">87 terjual</span></li>
          </ul>
        </div>
      </div>

      <!-- TABLE -->
      <div class="bg-white p-6 rounded-2xl shadow border border-gray-200">
        <h3 class="font-semibold text-gray-700 mb-4">Pesanan Terbaru</h3>
        <table class="w-full text-sm text-gray-700">
          <thead class="border-b bg-gray-50 text-gray-600">
            <tr>
              <th class="py-2 text-left">ID</th>
              <th class="py-2 text-left">Pelanggan</th>
              <th class="py-2 text-left">Produk</th>
              <th class="py-2 text-left">Total</th>
              <th class="py-2 text-left">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b hover:bg-gray-50">
              <td class="py-2">#1001</td>
              <td>Dewi Lestari</td>
              <td>Kursi Tolix</td>
              <td>Rp 599.000</td>
              <td><span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs">Selesai</span></td>
            </tr>
            <tr class="border-b hover:bg-gray-50">
              <td class="py-2">#1002</td>
              <td>Andi Pratama</td>
              <td>Lampu Gantung</td>
              <td>Rp 450.000</td>
              <td><span class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full text-xs">Proses</span></td>
            </tr>
            <tr>
              <td class="py-2">#1003</td>
              <td>Rina Wulandari</td>
              <td>Meja Bundar</td>
              <td>Rp 899.000</td>
              <td><span class="bg-red-100 text-red-700 px-2 py-0.5 rounded-full text-xs">Dibatalkan</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>

</body>
</html>
