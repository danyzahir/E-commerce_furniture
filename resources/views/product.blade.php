@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">
  {{-- BREADCRUMB --}}
  <nav class="text-sm mb-6 text-gray-500">
    <a href="/" class="hover:text-sky-600">Beranda</a>
    <span class="mx-2">/</span>
    <a href="#" class="hover:text-sky-600">Produk</a>
    <span class="mx-2">/</span>
    <span class="text-gray-700 font-semibold">NEW TOLIX WOOD HIGH STOOL H76CM METAL</span>
  </nav>

  {{-- DETAIL PRODUK --}}
  <div class="grid md:grid-cols-2 gap-10">
    {{-- GAMBAR PRODUK --}}
    <div>
      <div class="bg-gray-100 rounded-2xl overflow-hidden shadow-md flex justify-center items-center p-6 border border-gray-200">
        <img id="mainImage" src="https://atria.co.id/assets/upload/product/NEW-TOLIX-WOOD-HIGH-STOOL-H76CM-METAL-1.jpg"
             alt="Produk" class="object-contain max-h-[420px] transition-all duration-300">
      </div>

      {{-- Thumbnail --}}
      <div class="flex gap-3 mt-4 overflow-x-auto scrollbar-thin">
        <img onclick="gantiGambar(this)" src="https://atria.co.id/assets/upload/product/NEW-TOLIX-WOOD-HIGH-STOOL-H76CM-METAL-1.jpg"
             class="w-20 h-20 object-cover rounded-xl border-2 border-sky-400 cursor-pointer transition">
        <img onclick="gantiGambar(this)" src="https://atria.co.id/assets/upload/product/NEW-TOLIX-WOOD-HIGH-STOOL-H76CM-METAL-2.jpg"
             class="w-20 h-20 object-cover rounded-xl border border-gray-300 hover:border-sky-400 cursor-pointer transition">
        <img onclick="gantiGambar(this)" src="https://atria.co.id/assets/upload/product/NEW-TOLIX-WOOD-HIGH-STOOL-H76CM-METAL-3.jpg"
             class="w-20 h-20 object-cover rounded-xl border border-gray-300 hover:border-sky-400 cursor-pointer transition">
      </div>
    </div>

    {{-- INFO PRODUK --}}
    <div class="flex flex-col justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">NEW TOLIX WOOD HIGH STOOL H76CM METAL</h1>
        <p class="text-sm text-gray-500 mb-4">Kode: TOLIX-H76CM</p>

        {{-- Harga --}}
        <div class="flex items-end gap-3 mb-4">
          <span class="text-3xl font-bold text-black-700">Rp599.000</span>
          <span class="text-gray-400 line-through text-lg">Rp799.000</span>
          <span class="bg-sky-600 text-white text-sm font-semibold px-2 py-1 rounded">-25%</span>
        </div>

        {{-- Deskripsi --}}
        <p class="text-gray-600 leading-relaxed mb-6">
          Kursi tinggi berbahan metal kokoh dengan dudukan kayu solid, cocok untuk area dapur,
          bar, atau kafe dengan gaya industrial modern. Finishing cat powder coating yang tahan lama.
        </p>

        {{-- PILIH JUMLAH + STOK + KERANJANG --}}
        <div class="flex flex-col gap-3">
          <div class="flex items-center gap-4">
            {{-- Input Jumlah --}}
            <div class="flex items-center border border-gray-300 rounded-full overflow-hidden shadow-sm bg-white">
              <button id="minusBtn" class="bg-gray-100 px-3 py-2 hover:bg-gray-200 text-xl font-bold text-gray-700 transition">-</button>
              <input id="qtyInput" type="number" value="1" min="1" class="w-14 text-center text-gray-800 focus:outline-none">
              <button id="plusBtn" class="bg-gray-100 px-3 py-2 hover:bg-gray-200 text-xl font-bold text-gray-700 transition">+</button>
            </div>

            {{-- Info Stok --}}
            <p class="text-sm text-gray-600"><strong>Stok:</strong> 12 tersedia</p>
          </div>

          {{-- Tombol Keranjang --}}
          <button class="bg-sky-700 hover:bg-sky-800 text-white px-8 py-3 rounded-full font-semibold shadow-md transition w-fit">
            Tambah Keranjang
          </button>
        </div>
      </div>
    </div>
  </div>

  {{-- PRODUK TERKAIT --}}
  <div class="mt-16 border-t border-gray-200 pt-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Produk Terkait</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
      @php
        $produkTerkait = [
          ['nama' => 'Meja Kayu Jati Minimalis', 'harga' => 'Rp1.200.000', 'gambar' => 'https://atria.co.id/assets/upload/product/DAKOTA-NEW-ROUND-METAL-TABLE-UNFOLDED.jpg'],
          ['nama' => 'Lampu Gantung Industrial', 'harga' => 'Rp450.000', 'gambar' => 'https://atria.co.id/assets/upload/product/STIFFANY-RECTANGULAR-COFFEE-TABLE-SCT310.jpg'],
          ['nama' => 'Kursi Kantor Ergonomis', 'harga' => 'Rp950.000', 'gambar' => 'https://atria.co.id/assets/upload/product/DE-GRASS-WICKER-CHAIR-WR2719.jpg'],
          ['nama' => 'Rak Buku Scandinavian', 'harga' => 'Rp800.000', 'gambar' => 'https://atria.co.id/assets/upload/product/JESSICA-B-ALUMINIUM-TABLE-BASE.jpg'],
        ];
      @endphp

      @foreach ($produkTerkait as $item)
      <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden border border-gray-200 hover:border-sky-300">
        <a href="#">
          <img src="{{ $item['gambar'] }}" alt="{{ $item['nama'] }}" class="h-48 w-full object-cover">
          <div class="p-4">
            <h3 class="font-semibold text-gray-800 truncate">{{ $item['nama'] }}</h3>
            <p class="text-sky-700 font-bold text-sm mt-1">{{ $item['harga'] }}</p>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- SCRIPT GANTI GAMBAR & JUMLAH --}}
<script>
function gantiGambar(el) {
  document.querySelectorAll('.flex img').forEach(img => img.classList.remove('border-2', 'border-sky-400'));
  el.classList.add('border-2', 'border-sky-400');
  document.getElementById('mainImage').src = el.src;
}

const minusBtn = document.getElementById('minusBtn');
const plusBtn = document.getElementById('plusBtn');
const qtyInput = document.getElementById('qtyInput');

minusBtn.addEventListener('click', () => {
  let val = parseInt(qtyInput.value);
  if (val > 1) qtyInput.value = val - 1;
});

plusBtn.addEventListener('click', () => {
  let val = parseInt(qtyInput.value);
  qtyInput.value = val + 1;
});
</script>
@endsection
