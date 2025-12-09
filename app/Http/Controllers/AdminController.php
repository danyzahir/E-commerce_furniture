<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // ✅ PROTEKSI ADMIN
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('home')
                ->with('error', 'Akses ditolak! Anda bukan admin.');
        }

        /* =======================
           STATISTIK ATAS DASHBOARD
        ======================= */

        // Total Produk
        $totalProduk = Produk::count();

        // Pesanan Hari Ini
        $pesananHariIni = Order::whereDate('created_at', today())->count();

        // Pendapatan Bulan Ini
        $pendapatanBulanIni = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        // Pelanggan Baru Bulan Ini
        $pelangganBaru = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        /* =======================
           DATA TRANSAKSI TERAKHIR
        ======================= */

        $orders = Order::with('user')
            ->latest()
            ->take(10)
            ->get();

        /* =======================
           LINE CHART (7 HARI)
        ======================= */

        $chartLabels = [];
        $chartData = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = now()->subDays($i)->format('Y-m-d');

            $chartLabels[] = now()->subDays($i)->format('d M');

            $chartData[] = Order::whereDate('created_at', $tanggal)->sum('total');
        }

        /* =======================
           PIE CHART STATUS PESANAN
        ======================= */

        $statusData = [
            Order::where('status', 'paid')->count(),
            Order::where('status', 'pending')->count(),
            Order::where('status', 'failed')->count(),
        ];

        /* =======================
           KIRIM KE VIEW
        ======================= */

        return view('admin.index', compact(
            'totalProduk',
            'pesananHariIni',
            'pendapatanBulanIni',
            'pelangganBaru',
            'orders',
            'chartLabels',
            'chartData',
            'statusData'
        ));
    }
}
