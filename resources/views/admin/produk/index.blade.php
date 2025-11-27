@extends('layouts.appl')

@section('title', 'Data Produk - FUNILOKA Admin')

@section('content')

    @include('components.alert')


    <div class="flex flex-col items-start mb-6 gap-3">
        <h1 class="text-2xl font-bold text-gray-800">Data Produk</h1>

        <button onclick="openModal()"
            class="bg-sky-700 hover:bg-sky-800 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2">
            <i class="ri-add-line"></i> Tambah Produk
        </button>
    </div>



    <div class="hidden md:block bg-white p-6 rounded-2xl shadow border border-gray-200 overflow-x-auto">
        <table class="w-full text-sm text-gray-700 border-collapse">
            <thead class="border-b bg-gray-50 text-gray-600">
                <tr>
                    <th class="py-3 px-2">No</th>
                    <th class="py-3 px-2">Gambar</th>
                    <th class="py-3 px-2">Nama Produk</th>
                    <th class="py-3 px-2">Kategori</th>
                    <th class="py-3 px-2">Kuantitas</th>
                    <th class="py-3 px-2">Harga</th>
                    <th class="py-3 px-2 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($produks as $produk)
                    <tr class="border-b hover:bg-gray-50">


                        <td class="py-3 px-2">{{ $loop->iteration }}</td>


                        <td class="py-3 px-2">
                            @if ($produk->gambar)
                                <img src="{{ asset('storage/' . $produk->gambar) }}"
                                    class="w-16 h-16 object-cover rounded-lg border">
                            @else
                                <div
                                    class="w-16 h-16 flex items-center justify-center bg-gray-100 
                                        text-gray-400 rounded-lg border">
                                    No Img
                                </div>
                            @endif
                        </td>

                        <td class="py-3 px-2 font-medium text-gray-800">
                            {{ $produk->nama_produk }}
                        </td>

                        <td class="py-3 px-2">
                            {{ $produk->category ? $produk->category->nama : '-' }}
                        </td>


                        <td class="py-3 px-2">{{ $produk->kuantitas }}</td>


                        <td class="py-3 px-2 font-semibold text-sky-700">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </td>


                        <td class="py-3 px-2 text-center">
                            <div class="flex gap-2 justify-center">


                                <button
                                    onclick="editModal(
                                    '{{ $produk->id }}', 
                                    '{{ $produk->nama_produk }}', 
                                    '{{ $produk->harga }}', 
                                    '{{ $produk->kuantitas }}', 
                                    '{{ $produk->gambar ? asset('storage/' . $produk->gambar) : '' }}',
                                    '{{ $produk->category_id }}'
                                )"
                                    class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 
                                       px-3 py-1 rounded-lg text-xs font-medium flex items-center gap-1">
                                    <i class="ri-edit-line"></i> Edit
                                </button>


                                <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST"
                                    class="delete-form" data-produk="{{ $produk->nama_produk }}">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="bg-red-100 hover:bg-red-200 text-red-700 
                                           px-3 py-1 rounded-lg text-xs font-medium flex items-center gap-1">
                                        <i class="ri-delete-bin-line"></i> Hapus
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center py-5 text-gray-500">
                            Belum ada produk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="md:hidden space-y-4">

        @forelse($produks as $produk)
            <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-4">


                <div class="flex items-start gap-4">


                    @if ($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}"
                            class="w-16 h-16 rounded-xl object-cover border shadow-sm">
                    @else
                        <div
                            class="w-16 h-16 flex items-center justify-center 
                                bg-gray-100 text-gray-400 rounded-xl border shadow-sm">
                            No Img
                        </div>
                    @endif

                    <div class="flex-1">


                        <h2 class="text-sm font-bold text-gray-800 leading-tight">
                            {{ $produk->nama_produk }}
                        </h2>


                        <p class="text-xs text-gray-500 mt-0.5">
                            {{ $produk->category ? $produk->category->nama : '-' }}
                        </p>


                        <p class="text-sky-700 font-bold text-sm mt-1">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </p>
                    </div>
                </div>


                <div class="mt-3 text-xs text-gray-600">
                    <span class="font-semibold">Stok:</span> {{ $produk->kuantitas }}
                </div>


                <div class="grid grid-cols-2 gap-2 mt-4">


                    <button
                        onclick="editModal(
                        '{{ $produk->id }}',
                        '{{ $produk->nama_produk }}',
                        '{{ $produk->harga }}',
                        '{{ $produk->kuantitas }}',
                        '{{ $produk->gambar ? asset('storage/' . $produk->gambar) : '' }}',
                        '{{ $produk->category_id }}'
                    )"
                        class="w-full bg-yellow-100 text-yellow-700 hover:bg-yellow-200 
                           py-2 rounded-lg text-xs font-medium flex items-center justify-center gap-1">
                        <i class="ri-edit-line text-sm"></i> Edit
                    </button>


                    <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" class="delete-form"
                        data-produk="{{ $produk->nama_produk }}">
                        @csrf
                        @method('DELETE')

                        <button
                            class="w-full bg-red-100 text-red-700 hover:bg-red-200 
                               py-2 rounded-lg text-xs font-medium flex items-center justify-center gap-1">
                            <i class="ri-delete-bin-line text-sm"></i> Hapus
                        </button>
                    </form>
                </div>

            </div>

        @empty
            <p class="text-center text-gray-500 py-4">Belum ada produk.</p>
        @endforelse

    </div>

    @include('admin.produk.modal')

@endsection
