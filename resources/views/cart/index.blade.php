@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 lg:px-8">

    <!-- BREADCRUMB -->
    <nav class="text-sm text-gray-500 mb-4 flex items-center gap-1">
        <a href="/" class="hover:text-gray-700">Beranda</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">Keranjang</span>
    </nav>

    <h1 class="text-3xl font-bold mb-8 text-gray-800">Keranjang Belanja</h1>

    <!-- FORM DELETE SELECTED -->
    <form action="{{ route('cart.deleteSelected') }}" method="POST" id="deleteSelectedForm">
        @csrf
        <input type="hidden" name="selected_items" id="selectedItemsInput">
    </form>

    <!-- LAYOUT UTAMA -->
    <div class="flex flex-col lg:flex-row gap-6">

        <!-- LEFT SIDE (LIST ITEM) -->
        <div class="w-full lg:w-2/3 bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-6">

            <!-- HEADER -->
            <div class="flex justify-between items-center pb-4 border-b">
                <label class="flex items-center gap-3">
                    <input type="checkbox" id="selectAll" class="h-5 w-5 rounded">
                    <span class="text-gray-700">Pilih Semua ({{ $cartItems->count() }} item)</span>
                </label>

                <button type="button" id="deleteSelectedBtn"
                    class="flex items-center gap-2 text-red-600 hover:text-red-700 transition">
                    <i class="fas fa-trash"></i>
                    <span class="text-sm font-medium">Hapus Terpilih</span>
                </button>
            </div>

            <!-- LIST ITEM -->
            @foreach ($cartItems as $item)
            <div class="cart-item flex gap-4 items-center p-4 bg-gray-50 border rounded-xl">

                <input type="checkbox" class="cart-check h-5 w-5" value="{{ $item->id }}">

                <img src="{{ asset('storage/' . $item->product->gambar) }}"
                     class="w-24 h-24 rounded-xl object-cover">

                <div class="flex flex-col flex-1">
                    <p class="font-semibold text-gray-800">
                        {{ $item->product->nama_produk }}
                    </p>

                    <div class="mt-2 flex items-center gap-3">
                        <button type="button" class="qtyMinus w-8 h-8 border rounded-lg">-</button>
                        <span class="qtyValue w-8 text-center font-semibold">{{ $item->qty }}</span>
                        <button type="button" class="qtyPlus w-8 h-8 border rounded-lg">+</button>
                    </div>
                </div>

                <div class="text-right font-semibold hargaItem"
                     data-price="{{ $item->product->harga }}">
                    Rp {{ number_format($item->product->harga * $item->qty, 0, ',', '.') }}
                </div>

                <!-- DELETE SATUAN -->
                <form action="{{ route('cart.delete', $item->id) }}" method="POST" 
                      class="inline-block ml-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 p-2">
                        <i class="fa-solid fa-trash text-lg"></i>
                    </button>
                </form>

            </div>
            @endforeach

            <!-- TOTAL -->
            <div class="border-t pt-4 flex justify-between items-center">
                <p class="text-gray-600 text-sm">Total Harga Produk</p>
                <p id="totalHarga" class="text-lg font-bold text-gray-900">Rp 0</p>
            </div>

        </div>

        <!-- RIGHT SUMMARY (FORM TERPISAH) -->
        <form action="{{ route('cart.index') }}" method="GET" class="w-full lg:w-1/3">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-6">

                <h2 class="text-xl font-semibold text-gray-800">Ringkasan Belanja</h2>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jumlah Item</span>
                        <span id="ringkasanItem" class="font-medium text-gray-900">0 item</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Harga</span>
                        <span id="ringkasanTotal" class="font-medium text-gray-900">Rp 0</span>
                    </div>

                    <div class="flex justify-between pt-2 text-base font-bold">
                        <span>Total</span>
                        <span id="ringkasanTotal2">Rp 0</span>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 transition text-white py-3 rounded-lg font-semibold text-sm">
                    Lanjutkan ke payment
                </button>

            </div>
        </form>

    </div>
</div>


<!-- SCRIPT -->
<script>
function updateSummary() {
    let total = 0;
    let count = 0;

    document.querySelectorAll(".cart-item").forEach(item => {
        let checkbox = item.querySelector(".cart-check");
        let harga = item.querySelector(".hargaItem");
        let price = parseInt(harga.dataset.price);
        let qty = parseInt(item.querySelector(".qtyValue").innerText);

        if (checkbox.checked) {
            total += price * qty;
            count++;
        }

        harga.innerText = "Rp " + (price * qty).toLocaleString("id-ID");
    });

    document.getElementById("totalHarga").innerText = "Rp " + total.toLocaleString("id-ID");
    document.getElementById("ringkasanTotal").innerText = "Rp " + total.toLocaleString("id-ID");
    document.getElementById("ringkasanTotal2").innerText = "Rp " + total.toLocaleString("id-ID");
    document.getElementById("ringkasanItem").innerText = count + " item";
}

// SELECT ALL
document.getElementById("selectAll").addEventListener("change", function() {
    document.querySelectorAll(".cart-check").forEach(c => c.checked = this.checked);
    updateSummary();
});

// ITEM CHECKBOX
document.querySelectorAll(".cart-check").forEach(c => {
    c.addEventListener("change", updateSummary);
});

// QTY +
document.querySelectorAll(".qtyPlus").forEach(btn => {
    btn.addEventListener("click", () => {
        let qty = btn.parentElement.querySelector(".qtyValue");
        qty.innerText = parseInt(qty.innerText) + 1;
        updateSummary();
    });
});

// QTY -
document.querySelectorAll(".qtyMinus").forEach(btn => {
    btn.addEventListener("click", () => {
        let qty = btn.parentElement.querySelector(".qtyValue");
        if (parseInt(qty.innerText) > 1) qty.innerText = parseInt(qty.innerText) - 1;
        updateSummary();
    });
});

// DELETE SELECTED
document.getElementById("deleteSelectedBtn").addEventListener("click", () => {
    let selected = [];

    document.querySelectorAll(".cart-check:checked").forEach(c => {
        selected.push(c.value);
    });

    if (selected.length === 0) {
        alert("Tidak ada item dipilih.");
        return;
    }

    document.getElementById("selectedItemsInput").value = JSON.stringify(selected);
    document.getElementById("deleteSelectedForm").submit();
});

// INIT
updateSummary();
</script>

@endsection
