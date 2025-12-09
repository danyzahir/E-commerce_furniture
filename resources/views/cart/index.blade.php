@extends('layouts.app')

@section('content')

{{-- TOAST WARNING --}}
<div id="toastWarning"
    class="hidden fixed top-24 right-6 bg-red-600 text-white px-6 py-3 rounded-xl shadow-lg z-50 text-sm font-medium">
    <span id="toastText"></span>
</div>

<div class="w-full max-w-[1400px] mx-auto py-10 px-6 lg:px-16">

    <!-- BREADCRUMB -->
    <nav class="text-sm text-gray-500 mb-4 flex items-center gap-1">
        <a href="/" class="hover:text-gray-700">Beranda</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">Keranjang</span>
    </nav>

    <!-- ✅ JUDUL DIPERBESAR -->
    <h1 class="text-4xl font-bold mb-8 text-gray-800">Keranjang Belanja</h1>

    <!-- FORM DELETE SELECTED -->
    <form action="{{ route('cart.deleteSelected') }}" method="POST" id="deleteSelectedForm">
        @csrf
        <input type="hidden" name="selected_items" id="selectedItemsInput">
    </form>

    <!-- LAYOUT -->
    <div class="flex flex-col lg:flex-row gap-6">

        <!-- LEFT -->
        <div class="w-full lg:w-[68%] bg-white rounded-2xl p-8 shadow-md border space-y-8">

            <div class="flex justify-between items-center pb-4 border-b text-base">
                <label class="flex items-center gap-3">
                    <input type="checkbox" id="selectAll" class="h-5 w-5 rounded">
                    <span class="text-gray-700">
                        Pilih Semua ({{ $cartItems->count() }} item)
                    </span>
                </label>

                <button type="button" id="deleteSelectedBtn"
                    class="flex items-center gap-2 text-red-600 hover:text-red-700">
                    <i class="fas fa-trash"></i> Hapus Terpilih
                </button>
            </div>

            @foreach ($cartItems as $item)
                <div class="cart-item flex gap-4 items-center p-4 bg-gray-50 border rounded-xl">

                    <input type="checkbox" class="cart-check h-5 w-5" value="{{ $item->id }}">

                    <img src="{{ asset('storage/' . $item->product->gambar) }}"
                        class="w-28 h-28 rounded-xl object-cover">

                    <div class="flex flex-col flex-1">
                        <!-- ✅ NAMA PRODUK DIPERBESAR -->
                        <p class="font-semibold text-lg text-gray-800">
                            {{ $item->product->nama_produk }}
                        </p>

                        <div class="mt-2 flex items-center gap-3">
                            <span class="qtyValue w-8 text-center font-semibold">
                                {{ $item->qty }}
                            </span>
                        </div>
                    </div>

                    <!-- ✅ HARGA PER ITEM DIPERBESAR -->
                    <div class="text-right text-lg font-semibold hargaItem"
                        data-price="{{ $item->product->harga }}">
                        Rp {{ number_format($item->product->harga * $item->qty, 0, ',', '.') }}
                    </div>
                </div>
            @endforeach

            <div class="border-t pt-4 flex justify-between items-center">
                <p class="text-gray-600 text-base">Total Harga Produk</p>

                <!-- ✅ TOTAL DIPERBESAR -->
                <p id="totalHarga" class="text-xl font-bold text-gray-900">Rp 0</p>
            </div>

        </div>

        <!-- RIGHT -->
        <form action="{{ route('checkout.index') }}" method="GET" class="w-full lg:w-1/3" id="checkoutForm">
            <input type="hidden" name="selected_items" id="selectedItemsCheckout">

            <div class="bg-white rounded-2xl p-8 shadow-sm border space-y-6">

                <!-- ✅ JUDUL RINGKASAN DIPERBESAR -->
                <h2 class="text-2xl font-semibold text-gray-800">
                    Ringkasan Belanja
                </h2>

                <!-- ✅ ISI DIPERBESAR -->
                <div class="space-y-3 text-base">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jumlah Item</span>
                        <span id="ringkasanItem" class="font-medium">0 item</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Harga</span>
                        <span id="ringkasanTotal" class="font-medium">Rp 0</span>
                    </div>

                    <!-- ✅ TOTAL AKHIR DIPERBESAR -->
                    <div class="flex justify-between pt-2 text-lg font-bold">
                        <span>Total</span>
                        <span id="ringkasanTotal2">Rp 0</span>
                    </div>
                </div>

                <!-- ✅ TOMBOL DIPERBESAR -->
                <button type="submit"
                    class="w-full bg-[#8A5A32] hover:bg-[#6F4628] text-white py-4 rounded-lg font-semibold text-base">
                    Lanjutkan ke payment
                </button>

            </div>
        </form>

    </div>
</div>

{{-- ✅ SCRIPT FINAL TANPA ALERT BROWSER --}}
<script>
    function showToast(text) {
        const toast = document.getElementById("toastWarning");
        const toastText = document.getElementById("toastText");
        toastText.innerText = text;
        toast.classList.remove("hidden");

        setTimeout(() => {
            toast.classList.add("hidden");
        }, 2500);
    }

    function updateSummary() {
        let total = 0;
        let count = 0;

        document.querySelectorAll(".cart-item").forEach(item => {
            let harga = item.querySelector(".hargaItem");
            let price = parseInt(harga.dataset.price);
            let qty = parseInt(item.querySelector(".qtyValue").innerText);

            total += price * qty;
            count++;
        });

        document.getElementById("totalHarga").innerText = "Rp " + total.toLocaleString("id-ID");
        document.getElementById("ringkasanTotal").innerText = "Rp " + total.toLocaleString("id-ID");
        document.getElementById("ringkasanTotal2").innerText = "Rp " + total.toLocaleString("id-ID");
        document.getElementById("ringkasanItem").innerText = count + " item";
    }

    window.addEventListener("load", updateSummary);

    document.getElementById("selectAll").addEventListener("change", function() {
        document.querySelectorAll(".cart-check").forEach(c => c.checked = this.checked);
    });

    document.getElementById("deleteSelectedBtn").addEventListener("click", () => {
        let selected = [];
        document.querySelectorAll(".cart-check:checked").forEach(c => selected.push(c.value));

        if (selected.length === 0) {
            showToast("Pilih minimal 1 produk untuk dihapus");
            return;
        }

        document.getElementById("selectedItemsInput").value = JSON.stringify(selected);
        document.getElementById("deleteSelectedForm").submit();
    });

    document.getElementById("checkoutForm").addEventListener("submit", function(e) {
        let selected = [];

        document.querySelectorAll(".cart-check:checked").forEach(c => selected.push(c.value));

        if (selected.length === 0) {
            e.preventDefault();
            showToast("Pilih minimal 1 produk sebelum checkout");
            return;
        }

        document.getElementById("selectedItemsCheckout").value = selected.join(',');
    });
</script>

@endsection
