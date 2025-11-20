    @extends('layouts.app')

    @section('title', 'Katalog Produk')

    @section('content')
        <section class="mb-20">
            <h2 class="font-bold text-2xl mb-8 text-gray-800 select-none text-center">Katalog</h2>
            <nav class="text-sm text-gray-500 mb-4 flex items-center gap-1">
                <a href="/" class="hover:text-gray-700">Beranda</a>
                <span>/</span>
                <span class="text-gray-800 font-medium">Katalog</span>
            </nav>

            <!-- Daftar Produk -->
            <div id="productList" class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($produks as $p)
                    <a href="{{ route('produk.show', $p->id) }}">
                        <class="bg-white rounded-xl border border-gray-200 hover:border-gray-300 hover:shadow-xl transition relative p-5 block">

                        @if ($p->diskon)
                            <span
                                class="absolute top-4 left-4 bg-red-600 text-white text-sm font-semibold px-3 py-1 rounded-lg shadow-lg">-{{ $p->diskon }}%</span>
                        @endif

                        <div class="overflow-hidden rounded-lg">
                            <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->nama_produk }}"
                                class="w-full h-52 object-cover hover:scale-105 transition-transform duration-300 rounded-lg">
                        </div>

                        <p
                            class="font-semibold text-gray-900 text-base sm:text-lg mt-4 leading-snug line-clamp-2 hover:text-sky-600 transition-colors duration-300">
                            {{ $p->nama_produk }}
                        </p>

                        <div class="flex justify-between text-gray-500 text-sm mt-2">
                            <div class="flex items-center space-x-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-400" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.462a1 1 0 00-.364 1.118l1.286 3.974c.3.921-.755 1.688-1.538 1.118l-3.388-2.462a1 1 0 00-1.176 0l-3.388 2.462c-.783.57-1.838-.197-1.538-1.118l1.286-3.974a1 1 0 00-.364-1.118L2.045 9.4c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.974z" />
                                </svg>
                                <span>5/5</span>
                            </div>
                            <span>Terjual (0)</span>
                        </div>

                        <p class="text-black font-bold text-lg mt-2">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>

                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="text-center mt-10">
                {{ $produks->appends(request()->query())->links() }} <!-- Pagination links -->
            </div>
        </section>
    @endsection
