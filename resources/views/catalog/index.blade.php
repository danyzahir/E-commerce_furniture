@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
<section class="mb-20">
  <h2 class="font-bold text-2xl mb-6 text-gray-800 select-none text-center">Catalog Produk</h2>
  <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6"></div>
  <div class="text-center mt-8">
    <button id="loadMoreBtn" class="px-6 py-2.5 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-full shadow transition-all duration-300">
      Muat Lebih Banyak
    </button>
  </div>
</section>
@endsection

@push('scripts')
<script>
  const products = [
    { img:"https://via.placeholder.com/250x200?text=Kursi+1", name:"New Tolix Wood High Stool H76cm", price:599000, oldPrice:null, discount:null },
    { img:"https://via.placeholder.com/250x200?text=Meja+1", name:"Jessica-B Aluminium Table Base", price:579000, oldPrice:629000, discount:"8%" },
    { img:"https://via.placeholder.com/250x200?text=Meja+2", name:"Dakota Round Metal Table", price:799000, oldPrice:899000, discount:"11%" },
    { img:"https://via.placeholder.com/250x200?text=Meja+3", name:"Steffany Coffee Table SCT310", price:1199000, oldPrice:2349000, discount:"49%" },
    { img:"https://via.placeholder.com/250x200?text=Kursi+2", name:"De Grass Wicker Chair WR2719", price:320000, oldPrice:null, discount:null },
    { img:"https://via.placeholder.com/250x200?text=Sofa", name:"Elegant Brown Sofa", price:2500000, oldPrice:2999000, discount:"17%" },
    { img:"https://via.placeholder.com/250x200?text=Lampu", name:"Modern Lamp Gold Edition", price:450000, oldPrice:null, discount:null },
    { img:"https://via.placeholder.com/250x200?text=Rak", name:"Minimalist Wooden Shelf", price:700000, oldPrice:850000, discount:"18%" },
  ];

  const productGrid = document.getElementById("productGrid");
  const loadMoreBtn = document.getElementById("loadMoreBtn");
  let shownCount = 4;

  function renderProducts() {
    productGrid.innerHTML = "";
    products.slice(0, shownCount).forEach(p => {
      productGrid.innerHTML += `
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition relative p-4">
          ${p.discount ? `<span class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded">-${p.discount}</span>` : ""}
          <img src="${p.img}" alt="${p.name}" class="rounded-md mb-3 w-full h-40 object-cover">
          <p class="font-semibold text-gray-700 mb-1 truncate">${p.name}</p>
          <p class="text-sm text-gray-500 mb-1">⭐ Belum ada rating</p>
          <p class="text-sm text-gray-500 mb-1">Terjual (0)</p>
          <p class="text-sm text-gray-500 mb-2">Atria Puri Indah (Jakarta)</p>
          <div class="flex items-center space-x-2">
            <p class="text-black font-bold text-lg">Rp ${p.price.toLocaleString("id-ID")}</p>
            ${p.oldPrice ? `<p class="text-gray-400 line-through text-sm">Rp ${p.oldPrice.toLocaleString("id-ID")}</p>` : ""}
          </div>
        </div>`;
    });
    if (shownCount >= products.length) loadMoreBtn.style.display = "none";
  }

  loadMoreBtn.onclick = () => {
    shownCount += 4;
    renderProducts();
  };

  renderProducts();
</script>
@endpush
