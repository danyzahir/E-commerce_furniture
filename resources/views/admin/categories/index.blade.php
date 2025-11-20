@extends('layouts.appl')

@section('title', 'Data Kategori - FUNILOKA Admin')

@section('content')

@include('components.alert')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Data Kategori</h1>
</div>

<!-- FORM TAMBAH KATEGORI -->
<div class="bg-white p-6 rounded-2xl shadow border border-gray-200 mb-6 max-w-md">
    <h2 class="text-lg font-semibold text-sky-700 mb-4">Tambah Kategori</h2>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="flex gap-3">
        @csrf
        <input type="text" name="nama" placeholder="Nama Kategori"
            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-sky-400" required>

        <button type="submit"
            class="px-6 py-2 rounded-lg bg-sky-700 text-white font-semibold hover:bg-sky-800">
            Simpan
        </button>
    </form>
</div>

<!-- TABLE KATEGORI -->
<div class="bg-white p-6 rounded-2xl shadow border border-gray-200 overflow-x-auto">
    <table class="w-full text-sm text-gray-700 border-collapse">
        <thead class="border-b bg-gray-50 text-gray-600">
            <tr>
                <th class="py-3 px-2 text-left">No</th>
                <th class="py-3 px-2 text-left">Nama Kategori</th>
                <th class="py-3 px-2 text-left">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($categories as $index => $kategori)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-2">{{ $index + 1 }}</td>

                    <td class="py-3 px-2 font-medium text-gray-800">
                        {{ $kategori->nama }}
                    </td>

                    <td class="py-3 px-2 flex gap-2">

                        <!-- TOMBOL EDIT -->
                        <button onclick="document.getElementById('modal-edit-{{ $kategori->id }}').classList.remove('hidden')"
                            class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg text-xs font-medium flex items-center gap-1">
                            <i class="ri-edit-line"></i> Edit
                        </button>

                        <!-- TOMBOL DELETE -->
                        <button onclick="document.getElementById('modal-delete-{{ $kategori->id }}').classList.remove('hidden')"
                            class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-xs font-medium flex items-center gap-1">
                            <i class="ri-delete-bin-line"></i> Hapus
                        </button>

                        <!-- MODAL EDIT -->
                        <div id="modal-edit-{{ $kategori->id }}" class="fixed inset-0 z-50 hidden bg-black/40 flex items-center justify-center">

                            <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6 relative">
                                <button type="button"
                                    onclick="document.getElementById('modal-edit-{{ $kategori->id }}').classList.add('hidden')"
                                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                                    <i class="ri-close-line text-xl"></i>
                                </button>

                                <h2 class="text-lg font-semibold text-yellow-700 mb-4">Edit Kategori</h2>

                                <form action="{{ route('admin.categories.update', $kategori->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div>
                                        <label class="text-sm font-semibold text-gray-700">Nama Kategori</label>
                                        <input type="text" name="nama" value="{{ $kategori->nama }}"
                                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-yellow-400"
                                            required>
                                    </div>

                                    <div class="flex justify-end gap-3 pt-4">
                                        <button type="button"
                                            onclick="document.getElementById('modal-edit-{{ $kategori->id }}').classList.add('hidden')"
                                            class="px-5 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">
                                            Batal
                                        </button>

                                        <button type="submit"
                                            class="px-6 py-2 rounded-lg bg-yellow-500 text-white font-semibold hover:bg-yellow-600">
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- MODAL DELETE -->
                        <div id="modal-delete-{{ $kategori->id }}" class="fixed inset-0 z-50 hidden bg-black/40 flex items-center justify-center">

                            <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6 relative">

                                <button type="button"
                                    onclick="document.getElementById('modal-delete-{{ $kategori->id }}').classList.add('hidden')"
                                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                                    <i class="ri-close-line text-xl"></i>
                                </button>

                                <div class="flex items-start gap-3">
                                    <i class="ri-alert-line text-red-600 text-2xl"></i>

                                    <div>
                                        <h2 class="text-lg font-semibold text-gray-800 mb-1">Konfirmasi Hapus</h2>
                                        <p class="text-sm text-gray-600">
                                            Apakah Anda yakin ingin menghapus kategori
                                            <span class="font-semibold text-gray-800">"{{ $kategori->nama }}"</span>?
                                        </p>
                                    </div>
                                </div>

                                <div class="flex justify-end gap-3 mt-6">
                                    <button type="button"
                                        onclick="document.getElementById('modal-delete-{{ $kategori->id }}').classList.add('hidden')"
                                        class="px-5 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                                        Batal
                                    </button>

                                    <form action="{{ route('admin.categories.destroy', $kategori->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="px-6 py-2 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700">
                                            Hapus
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-5 text-gray-500">
                        Belum ada kategori.
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>
</div>

@endsection
