@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-10 px-4 lg:px-8">

        <!-- BREADCRUMB -->
        <nav class="text-sm text-gray-500 mb-4 flex items-center gap-1">
            <a href="/" class="hover:text-gray-700">Beranda</a>
            <span>/</span>
            <span class="text-gray-800 font-medium">Keranjang</span>
        </nav>

        <h1 class="text-3xl font-bold mb-8 text-gray-800">
            Keranjang Belanja
        </h1>

        <div class="flex flex-col lg:flex-row gap-6">

            <!-- LEFT -->
            <div class="w-full lg:w-2/3 bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-6">

                <!-- HEADER -->
                <div class="flex justify-between items-center pb-4 border-b">
                    <label class="flex items-center gap-3">
                        <input type="checkbox" class="h-5 w-5 rounded border-gray-300" id="selectAll">
                        <span class="text-gray-700">Pilih Semua (3 item)</span>
                    </label>

                    <button class="flex items-center gap-2 text-red-600 hover:text-red-700 transition">
                        <i class="fas fa-trash"></i>
                        <span class="text-sm font-medium">Hapus Semua</span>
                    </button>
                </div>

                <!-- PRODUCT 1 -->
                <!-- PRODUCT 1 -->
                <div
                    class="flex gap-4 items-center p-4 bg-gray-50 border border-gray-200 rounded-xl hover:bg-gray-100 transition-all">
                    <input type="checkbox" class="h-5 w-5 rounded">

                    <img src="https://via.placeholder.com/110"
                        class="w-24 h-24 rounded-xl object-cover border border-gray-200">

                    <div class="flex flex-col flex-1">
                        <p class="font-semibold text-gray-800 leading-snug">
                            Atria Kursi Lipat Aldira Folding Chair White
                        </p>
                       

                        <!-- KUANTITI -->
                        <div class="mt-2 flex items-center gap-3" data-qty-wrapper>
                            <button type="button"
                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100"
                                data-qty-minus>
                                -
                            </button>

                            <span class="w-8 text-center font-semibold text-gray-800" data-qty-value>1</span>

                            <button type="button"
                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100"
                                data-qty-plus>
                                +
                            </button>
                        </div>
                        <!-- END KUANTITI -->
                    </div>

                    <div class="text-right font-semibold text-gray-800 whitespace-nowrap">
                        Rp 409.900
                    </div>

                    <button class="text-red-500 hover:text-red-700 pl-4">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>


                <!-- PRODUCT 2 -->
                <!-- PRODUCT 1 -->
                <div
                    class="flex gap-4 items-center p-4 bg-gray-50 border border-gray-200 rounded-xl hover:bg-gray-100 transition-all">
                    <input type="checkbox" class="h-5 w-5 rounded">

                    <img src="https://via.placeholder.com/110"
                        class="w-24 h-24 rounded-xl object-cover border border-gray-200">

                    <div class="flex flex-col flex-1">
                        <p class="font-semibold text-gray-800 leading-snug">
                            Atria Kursi Lipat Aldira Folding Chair White
                        </p>
                        

                        <!-- KUANTITI -->
                        <div class="mt-2 flex items-center gap-3" data-qty-wrapper>
                            <button type="button"
                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100"
                                data-qty-minus>
                                -
                            </button>

                            <span class="w-8 text-center font-semibold text-gray-800" data-qty-value>1</span>

                            <button type="button"
                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100"
                                data-qty-plus>
                                +
                            </button>
                        </div>
                        <!-- END KUANTITI -->
                    </div>

                    <div class="text-right font-semibold text-gray-800 whitespace-nowrap">
                        Rp 409.900
                    </div>

                    <button class="text-red-500 hover:text-red-700 pl-4">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>

                <!-- PRODUCT 1 -->
                <div
                    class="flex gap-4 items-center p-4 bg-gray-50 border border-gray-200 rounded-xl hover:bg-gray-100 transition-all">
                    <input type="checkbox" class="h-5 w-5 rounded">

                    <img src="https://via.placeholder.com/110"
                        class="w-24 h-24 rounded-xl object-cover border border-gray-200">

                    <div class="flex flex-col flex-1">
                        <p class="font-semibold text-gray-800 leading-snug">
                            Atria Kursi Lipat Aldira Folding Chair White
                        </p>
                        

                        <!-- KUANTITI -->
                        <div class="mt-2 flex items-center gap-3" data-qty-wrapper>
                            <button type="button"
                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100"
                                data-qty-minus>
                                -
                            </button>

                            <span class="w-8 text-center font-semibold text-gray-800" data-qty-value>1</span>

                            <button type="button"
                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100"
                                data-qty-plus>
                                +
                            </button>
                        </div>
                        <!-- END KUANTITI -->
                    </div>

                    <div class="text-right font-semibold text-gray-800 whitespace-nowrap">
                        Rp 409.900
                    </div>

                    <button class="text-red-500 hover:text-red-700 pl-4">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>

                <!-- TOTAL -->
                <div class="border-t pt-4 flex justify-between items-center">
                    <p class="text-gray-600 text-sm">Total Harga Produk</p>
                    <p class="text-lg font-bold text-gray-900">Rp 2.307.900</p>
                </div>

            </div>

            <!-- RIGHT -->
            <div class="w-full lg:w-1/3 bg-white rounded-2xl p-6 shadow-sm border border-gray-100 h-max space-y-6">

                <h2 class="text-xl font-semibold text-gray-800">
                    Ringkasan Belanja
                </h2>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jumlah Item</span>
                        <span class="font-medium text-gray-900">3 item</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Harga</span>
                        <span class="font-medium text-gray-900">Rp 2.307.900</span>
                    </div>

                    <div class="flex justify-between pt-2 text-base font-bold">
                        <span>Total</span>
                        <span>Rp 2.307.900</span>
                    </div>
                </div>

                <button
                    class="w-full bg-blue-600 hover:bg-blue-700 transition text-white py-3 rounded-lg font-semibold text-sm">
                    Lanjutkan ke Checkout
                </button>

            </div>
        </div>
    </div>
@endsection
