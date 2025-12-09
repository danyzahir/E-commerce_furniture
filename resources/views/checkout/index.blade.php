@extends('layouts.app')

@section('title', 'Checkout - FinLoka')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">

    <h1 class="text-3xl font-bold text-gray-800 mb-8">Checkout</h1>

    <form method="POST" action="{{ route('checkout.process') }}" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf

        {{-- ✅ KIRIM SEMUA SELECTED ITEM --}}
        @foreach ($cartItems as $item)
            <input type="hidden" name="selected_items[]" value="{{ $item->id }}">
        @endforeach

        {{-- ✅ KIRIM ALAMAT DARI PROFILE --}}
        <input type="hidden" name="alamat" value="{{ Auth::user()->alamat }}">

        {{-- ================= LEFT: DATA & ALAMAT ================= --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow border p-6 space-y-6">

            <h2 class="text-xl font-bold text-gray-800">Data Pengiriman</h2>

            {{-- NAMA --}}
            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text"
                       value="{{ Auth::user()->name }}"
                       disabled
                       class="w-full border rounded-lg px-4 py-2 bg-gray-100">
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email"
                       value="{{ Auth::user()->email }}"
                       disabled
                       class="w-full border rounded-lg px-4 py-2 bg-gray-100">
            </div>

            {{-- ✅ ALAMAT OTOMATIS DARI PROFILE --}}
            <div>
                <label class="block text-sm font-medium mb-1">
                    Alamat Pengiriman
                </label>

                <textarea rows="4"
                          disabled
                          class="w-full border rounded-lg px-4 py-2 resize-none bg-gray-100">
{{ Auth::user()->alamat }}
                </textarea>

                @if (!Auth::user()->alamat)
                    <p class="text-red-600 text-sm mt-1">
                        Alamat belum diisi di profil. Silakan lengkapi terlebih dahulu.
                    </p>
                @endif
            </div>

        </div>

        {{-- ================= RIGHT: RINGKASAN ================= --}}
        <div class="bg-white rounded-2xl shadow border p-6 space-y-6">

            <h2 class="text-xl font-bold text-gray-800">Ringkasan Pesanan</h2>

            <div class="space-y-4 text-sm">
                @php $total = 0; @endphp

                @foreach ($cartItems as $item)
                    @php
                        $subtotal = $item->product->harga * $item->qty;
                        $total += $subtotal;
                    @endphp

                    <div class="flex justify-between">
                        <div>
                            <p class="font-medium text-gray-800">
                                {{ $item->product->nama_produk }}
                            </p>
                            <p class="text-gray-500 text-xs">
                                {{ $item->qty }} x Rp {{ number_format($item->product->harga, 0, ',', '.') }}
                            </p>
                        </div>
                        <p class="font-semibold">
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </p>
                    </div>
                @endforeach
            </div>

            <hr>

            <div class="flex justify-between text-base font-bold">
                <span>Total</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            {{-- ✅ BUTTON BAYAR --}}
            <button type="submit"
                {{ !Auth::user()->alamat ? 'disabled' : '' }}
                class="w-full bg-[#8A5A32] hover:bg-[#6F4628] transition text-white py-3 rounded-lg font-semibold
                       disabled:bg-gray-400 disabled:cursor-not-allowed">
                Lanjutkan Pembayaran
            </button>

        </div>

    </form>

</div>
@endsection
