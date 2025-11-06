<!-- MODAL TAMBAH / EDIT -->
<div id="produkModal" class="fixed inset-0 bg-black/40 hidden z-50">
  <div class="flex items-center justify-center min-h-screen">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-lg p-6 relative">
      <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
        <i class="ri-close-line text-xl"></i>
      </button>
      <h2 id="modalTitle" class="text-lg font-semibold text-sky-700 mb-4">Tambah Produk</h2>

      <form id="produkForm" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <input type="hidden" id="methodInput" name="_method" value="POST">
        
        <div>
          <label class="text-sm font-semibold text-gray-700">Nama Produk</label>
          <input type="text" name="nama_produk" id="nama_produk" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-sky-400" required>
        </div>

        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="text-sm font-semibold text-gray-700">Harga</label>
            <input type="number" name="harga" id="harga" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-sky-400" required>
          </div>
          <div>
            <label class="text-sm font-semibold text-gray-700">Kuantitas</label>
            <input type="number" name="kuantitas" id="kuantitas" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-sky-400" required>
          </div>
        </div>

        <div>
          <label class="text-sm font-semibold text-gray-700">Kategori</label>
          <select name="category_id" id="category_id" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-sky-400" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->nama }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="text-sm font-semibold text-gray-700">Gambar Produk</label>
          <input type="file" name="gambar" id="gambar" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-sky-400" accept="image/*" onchange="previewImage(event)">
          <img id="preview" class="hidden w-20 h-20 object-cover mt-2 rounded-lg border">
        </div>

        <div class="flex justify-end gap-3 pt-4">
          <button type="button" onclick="closeModal()" class="px-5 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">Batal</button>
          <button type="submit" class="px-6 py-2 rounded-lg bg-sky-700 text-white font-semibold hover:bg-sky-800">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const modal = document.getElementById('produkModal');
  const form = document.getElementById('produkForm');
  const methodInput = document.getElementById('methodInput');
  const modalTitle = document.getElementById('modalTitle');
  const preview = document.getElementById('preview');
  const categorySelect = document.getElementById('category_id');

  function openModal() {
    modal.classList.remove('hidden');
    form.action = "{{ route('admin.produk.store') }}";
    methodInput.value = "POST";
    modalTitle.innerText = "Tambah Produk";
    form.reset();
    preview.classList.add('hidden');
  }

  function closeModal() {
    modal.classList.add('hidden');
  }

  // Tambah parameter kategori ke edit modal
  function editModal(id, nama, harga, qty, img, categoryId) {
    modal.classList.remove('hidden');
    modalTitle.innerText = "Edit Produk";
    form.action = `/admin/produk/${id}`;
    methodInput.value = "PUT";
    document.getElementById('nama_produk').value = nama;
    document.getElementById('harga').value = harga;
    document.getElementById('kuantitas').value = qty;
    categorySelect.value = categoryId ?? '';

    if (img && img !== 'null') {
      preview.src = img;
      preview.classList.remove('hidden');
    } else {
      preview.classList.add('hidden');
    }
  }

  function previewImage(event) {
    const reader = new FileReader();
    reader.onload = () => {
      preview.src = reader.result;
      preview.classList.remove('hidden');
    };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>
