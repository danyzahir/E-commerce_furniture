@extends('layouts.appl')

@section('title', 'Dashboard Admin - FUNILOKA Admin')

@section('content')

<div class="p-6 md:p-10 max-w-7xl mx-auto">

    {{-- TITLE --}}
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
            Dashboard Admin
        </h1>
        <p class="text-sm text-gray-500 mt-1">Ringkasan statistik & performa toko</p>
    </div>

    {{-- STATISTIK CARDS --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-12">

        <div class="bg-white rounded-2xl p-5 shadow border flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Produk</p>
                <h2 class="text-2xl font-bold text-[#8A5A32] mt-1">
                    {{ $totalProduk }}
                </h2>
            </div>
            <div class="w-12 h-12 rounded-full bg-[#8A5A32]/10 flex items-center justify-center">
                <i class="ri-box-3-line text-2xl text-[#8A5A32]"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 shadow border flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Pesanan Hari Ini</p>
                <h2 class="text-2xl font-bold text-[#8A5A32] mt-1">
                    {{ $pesananHariIni }}
                </h2>
            </div>
            <div class="w-12 h-12 rounded-full bg-[#8A5A32]/10 flex items-center justify-center">
                <i class="ri-shopping-bag-3-line text-2xl text-[#8A5A32]"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 shadow border flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Pendapatan Bulan Ini</p>
                <h2 class="text-2xl font-bold text-[#8A5A32] mt-1">
                    Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}
                </h2>
            </div>
            <div class="w-12 h-12 rounded-full bg-[#8A5A32]/10 flex items-center justify-center">
                <i class="ri-money-dollar-circle-line text-2xl text-[#8A5A32]"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 shadow border flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Pelanggan Baru</p>
                <h2 class="text-2xl font-bold text-[#8A5A32] mt-1">
                    {{ $pelangganBaru }}
                </h2>
            </div>
            <div class="w-12 h-12 rounded-full bg-[#8A5A32]/10 flex items-center justify-center">
                <i class="ri-user-add-line text-2xl text-[#8A5A32]"></i>
            </div>
        </div>

    </div>

    {{-- GRAFIK --}}
    <div class="grid md:grid-cols-2 gap-6">

        {{-- LINE CHART --}}
        <div class="bg-white p-6 rounded-2xl shadow border">
            <h2 class="text-lg font-bold text-gray-800 mb-4 text-center">
                Grafik Pendapatan (7 Hari Terakhir)
            </h2>

            <div class="relative h-[260px]">
                <canvas id="orderChart"></canvas>
            </div>
        </div>

        {{-- PIE CHART --}}
        <div class="bg-white p-6 rounded-2xl shadow border">
            <h2 class="text-lg font-bold text-gray-800 mb-4 text-center">
                Perbandingan Status Pesanan
            </h2>

            <div class="relative h-[240px] w-[240px] mx-auto">
                <canvas id="statusChart"></canvas>
            </div>

            {{-- LEGEND MANUAL --}}
            <div class="flex justify-center gap-6 mt-6 text-sm">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-green-600"></span> Paid
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-yellow-400"></span> Pending
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-red-600"></span> Failed
                </div>
            </div>
        </div>

    </div>

</div>

{{-- CHART JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    /* LINE CHART */
    const ctx = document.getElementById('orderChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Pendapatan',
                data: @json($chartData),
                borderWidth: 3,
                borderColor: '#8A5A32',
                backgroundColor: 'rgba(138,90,50,0.2)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    /* PIE CHART */
    const statusCtx = document.getElementById('statusChart');
    new Chart(statusCtx, {
        type: 'pie',
        data: {
            labels: ['Paid', 'Pending', 'Failed'],
            datasets: [{
                data: @json($statusData),
                backgroundColor: [
                    '#16a34a',
                    '#facc15',
                    '#dc2626'
                ],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>

@endsection
