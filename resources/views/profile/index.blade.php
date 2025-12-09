@extends('layouts.app')

@section('title', 'Profil Saya - FinLoka')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-10 text-center">
        <div class="mx-auto w-20 h-20 rounded-full bg-[#8A5A32] text-white flex items-center justify-center text-2xl font-bold shadow">
            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
        </div>
        <h1 class="text-2xl font-bold text-[#4A2308] mt-4">Profil Saya</h1>
        <p class="text-gray-500 text-sm">Kelola informasi akun dan keamanan</p>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg text-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- CARD PROFIL --}}
    <div class="bg-white rounded-2xl shadow-lg border border-[#E4D5C1] p-8 mb-12">

        <h2 class="text-lg font-semibold text-[#4A2308] mb-6 border-b pb-3">
            Informasi Profil
        </h2>

        <form action="{{ route('profile.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            {{-- NAMA --}}
            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input type="text" name="name"
                    value="{{ Auth::user()->name }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-[#7A4A1E] focus:outline-none">
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email"
                    value="{{ Auth::user()->email }}"
                    disabled
                    class="w-full bg-gray-100 border border-gray-300 px-4 py-2 rounded-lg text-gray-600">
            </div>

            {{-- ALAMAT --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Alamat</label>
                <textarea name="alamat" rows="3"
                    class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-[#7A4A1E] focus:outline-none resize-none">{{ Auth::user()->alamat }}</textarea>
            </div>

            <div class="md:col-span-2 flex justify-end pt-2">
                <button
                    class="bg-[#7A4A1E] hover:bg-[#4A2308] text-white px-8 py-2 rounded-lg shadow transition">
                    Simpan Profil
                </button>
            </div>
        </form>
    </div>

    {{-- CARD PASSWORD --}}
    <div class="bg-white rounded-2xl shadow-lg border border-red-200 p-8">

        <h2 class="text-lg font-semibold text-red-700 mb-6 border-b pb-3">
            Keamanan Akun
        </h2>

        <form action="{{ route('profile.password') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Password Lama</label>
                <input type="password" name="password_lama"
                    class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Password Baru</label>
                <input type="password" name="password_baru"
                    class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none"
                    required>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="password_baru_confirmation"
                    class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none"
                    required>
            </div>

            <div class="md:col-span-2 flex justify-end pt-2">
                <button
                    class="bg-red-600 hover:bg-red-700 text-white px-8 py-2 rounded-lg shadow transition">
                    Ubah Password
                </button>
            </div>
        </form>
    </div>

</div>

@endsection
