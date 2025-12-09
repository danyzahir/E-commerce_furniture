@extends('layouts.appl')

@section('title', 'Riwayat Transaksi - FUNILOKA Admin')

@section('content')

@include('components.alert')

<div class="flex flex-col md:flex-row md:items-center justify-between mb-4 md:mb-6 gap-3 px-1">
    <h1 class="text-xl md:text-2xl font-bold text-gray-800">
        Riwayat Transaksi
    </h1>
</div>

<div class="bg-white p-3 md:p-6 rounded-2xl shadow border border-gray-200">

    <div id="ajaxTableContainer">

        {{-- ================= DESKTOP TABLE ================= --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm text-gray-700 border-collapse">
                <thead class="border-b bg-gray-50 text-gray-600">
                    <tr>
                        <th class="py-3 px-2 text-left">No</th>
                        <th class="py-3 px-2 text-left">Nama User</th>
                        <th class="py-3 px-2 text-left">Email</th>
                        <th class="py-3 px-2 text-left">Alamat</th> {{-- ✅ TAMBAH --}}
                        <th class="py-3 px-2 text-left">Total</th>
                        <th class="py-3 px-2 text-left">Status</th>
                        <th class="py-3 px-2 text-left">Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-2">{{ $loop->iteration }}</td>

                            <td class="py-3 px-2 font-medium text-gray-800 flex items-center gap-2">
                                <div class="w-8 h-8 flex items-center justify-center rounded-full bg-[#8A5A32]/10 text-[#8A5A32] font-semibold">
                                    {{ strtoupper(substr($order->user->name, 0, 2)) }}
                                </div>
                                {{ $order->user->name }}
                            </td>

                            <td class="py-3 px-2">{{ $order->user->email }}</td>

                            {{-- ✅ ALAMAT --}}
                            <td class="py-3 px-2 text-gray-700 max-w-[220px] truncate">
                                {{ $order->alamat ?? '-' }}
                            </td>

                            <td class="py-3 px-2 font-semibold text-[#8A5A32]">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </td>

                            <td class="py-3 px-2">
                                <span class="
                                    {{ $order->status === 'paid'
                                        ? 'bg-green-100 text-green-700'
                                        : ($order->status === 'failed'
                                            ? 'bg-red-100 text-red-700'
                                            : 'bg-yellow-100 text-yellow-700') }}
                                    px-2 py-1 rounded-lg text-xs font-semibold capitalize">
                                    {{ $order->status }}
                                </span>
                            </td>

                            <td class="py-3 px-2 text-gray-500">
                                {{ $order->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ================= MOBILE VERSION ================= --}}
        <div class="md:hidden space-y-3 mt-4">
            @foreach ($orders as $order)
                <div class="border rounded-xl p-3 bg-gray-50 shadow-sm">

                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#8A5A32]/10 flex items-center justify-center text-[#8A5A32] font-bold">
                                {{ strtoupper(substr($order->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $order->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $order->user->email }}</p>
                            </div>
                        </div>

                        <span class="
                            {{ $order->status === 'paid'
                                ? 'bg-green-100 text-green-700'
                                : ($order->status === 'failed'
                                    ? 'bg-red-100 text-red-700'
                                    : 'bg-yellow-100 text-yellow-700') }}
                            px-2 py-1 text-xs rounded-lg">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="mt-2 text-sm text-gray-700 font-semibold">
                        Total: Rp {{ number_format($order->total, 0, ',', '.') }}
                    </div>

                    {{-- ✅ ALAMAT MOBILE --}}
                    <div class="text-xs text-gray-600 mt-1">
                        Alamat: {{ $order->alamat ?? '-' }}
                    </div>

                    <div class="text-xs text-gray-500 mt-1">
                        Tanggal: {{ $order->created_at->format('d M Y') }}
                    </div>

                </div>
            @endforeach
        </div>

        {{-- ✅ PAGINATION --}}
        <div class="mt-6">
            {{ $orders->links() }}
        </div>

    </div>

</div>

{{-- ✅ AJAX PAGINATION TANPA PINDAH HALAMAN --}}
<script>
document.addEventListener('click', function(e) {
    if (e.target.closest('.pagination a')) {
        e.preventDefault();
        let url = e.target.closest('.pagination a').getAttribute('href');
        loadData(url);
    }
});

function loadData(url) {
    fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById('ajaxTableContainer').innerHTML = data;
    })
    .catch(err => console.error(err));
}
</script>

@endsection
