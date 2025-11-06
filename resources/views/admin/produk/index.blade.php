<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" x-cloak>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Produk - FinLoka Admin</title>
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
      @include('components.alert')

      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Produk</h1>
        <button onclick="openModal()" class="bg-sky-700 hover:bg-sky-800 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center justify-center gap-2">
          <i class="ri-add-line"></i> Tambah Produk
        </button>
      </div>

      <!-- TABLE PRODUK -->
    <div class="bg-white p-6 rounded-2xl shadow border border-gray-200 overflow-x-auto">
      <table class="w-full text-sm text-gray-700 border-collapse">
        <thead class="border-b bg-gray-50 text-gray-600">
          <tr>
            <th class="py-3 px-2 text-left">No</th>
            <th class="py-3 px-2 text-left">Gambar</th>
            <th class="py-3 px-2 text-left">Nama Produk</th>
            <th class="py-3 px-2 text-left">Kategori</th> <!-- Tambahan -->
            <th class="py-3 px-2 text-left">Kuantitas</th>
            <th class="py-3 px-2 text-left">Harga</th>
            <th class="py-3 px-2 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($produks as $produk)
          <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-2">{{ $loop->iteration }}</td>
            <td class="py-3 px-2">
              @if($produk->gambar)
                <img src="{{ asset('storage/'.$produk->gambar) }}" alt="Produk" class="w-16 h-16 object-cover rounded-lg border">
              @else
                <div class="w-16 h-16 flex items-center justify-center bg-gray-100 text-gray-400 rounded-lg border">No Img</div>
              @endif
            </td>
            <td class="py-3 px-2 font-medium text-gray-800">{{ $produk->nama_produk }}</td>
            <td class="py-3 px-2">{{ $produk->category ? $produk->category->nama : '-' }}</td> <!-- Kolom kategori -->
            <td class="py-3 px-2">{{ $produk->kuantitas }}</td>
            <td class="py-3 px-2 font-semibold text-sky-700">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
            <td class="py-3 px-2">
              <div class="flex gap-2">
                <button 
                  onclick="editModal('{{ $produk->id }}', '{{ $produk->nama_produk }}', '{{ $produk->harga }}', '{{ $produk->kuantitas }}', '{{ $produk->gambar ? asset('storage/'.$produk->gambar) : '' }}', '{{ $produk->category_id }}')" 
                  class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg text-xs font-medium flex items-center gap-1">
                  <i class="ri-edit-line"></i> Edit
                </button>
                <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" class="delete-form" data-produk="{{ $produk->nama_produk }}">
                  @csrf
                  @method('DELETE')
                  <button class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-xs font-medium flex items-center gap-1">
                    <i class="ri-delete-bin-line"></i> Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center py-5 text-gray-500">Belum ada produk.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>


      @include('admin.produk.modal')
    </main>
  </div>

</body>
</html>
