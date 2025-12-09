@extends('layouts.appl')

@section('title', 'Data Produk - FUNILOKA Admin')

@section('content')

@include('components.alert')

<div class="flex flex-col items-start mb-6 gap-3">
    <h1 class="text-2xl font-bold text-gray-800">Data Produk</h1>

    <button onclick="openModal()"
        class="bg-[#8A5A32] hover:bg-[#6F4628] text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2">
        <i class="ri-add-line"></i> Tambah Produk
    </button>
</div>

{{-- ================= DESKTOP ================= --}}
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

                    {{-- ✅ NOMOR TIDAK RESET --}}
                    <td class="py-3 px-2">
                        {{ ($produks->currentPage() - 1) * $produks->perPage() + $loop->iteration }}
                    </td>

                    <td class="py-3 px-2">
                        <img src="{{ asset('storage/' . $produk->gambar) }}"
                             class="w-16 h-16 object-cover rounded-lg border">
                    </td>

                    <td class="py-3 px-2 font-medium">{{ $produk->nama_produk }}</td>

                    <td class="py-3 px-2">
                        {{ $produk->category ? $produk->category->nama : '-' }}
                    </td>

                    <td class="py-3 px-2">{{ $produk->kuantitas }}</td>

                    <td class="py-3 px-2 font-bold text-[#8A5A32]">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </td>

                    <td class="py-3 px-2 text-center">
                        <div class="flex gap-2 justify-center">

                            <button onclick="editModal(
                                '{{ $produk->id }}', 
                                '{{ $produk->nama_produk }}', 
                                '{{ $produk->harga }}', 
                                '{{ $produk->kuantitas }}', 
                                '{{ asset('storage/' . $produk->gambar) }}',
                                '{{ $produk->category_id }}'
                            )"
                                class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 
                                   px-3 py-1 rounded-lg text-xs font-medium flex items-center gap-1">
                                <i class="ri-edit-line"></i> Edit
                            </button>

                            <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST">
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

{{-- ✅ PAGINATION --}}
<div class="mt-6">
    {{ $produks->links() }}
</div>

@include('admin.produk.modal')

@endsection
