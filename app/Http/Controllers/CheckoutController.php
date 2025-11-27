<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Ambil item terpilih dari keranjang
        $selectedIds = $request->selected_items;

        if (!$selectedIds) {
            return redirect()->route('cart.index')->with('error', 'Pilih produk terlebih dahulu.');
        }

        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->whereIn('id', $selectedIds)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item valid.');
        }

        return view('checkout.index', compact('cartItems'));
    }


    // Proses checkout → simpan ke tabel orders
    public function process(Request $request)
    {
        $request->validate([
            'selected_items' => 'required|array',
        ]);

        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->whereIn('id', $request->selected_items)
            ->get();

        $items = [];
        $total = 0;

        foreach ($cartItems as $item) {
            $items[] = [
                'product_id' => $item->product_id,
                'nama_produk' => $item->product->nama_produk,
                'harga' => $item->product->harga,
                'qty' => $item->qty,
                'subtotal' => $item->qty * $item->product->harga,
            ];

            $total += $item->qty * $item->product->harga;
        }

        // Simpan order
        $order = Order::create([
            'user_id' => Auth::id(),
            'items' => $items,  // → JSON
            'total' => $total,
            'payment_method' => 'manual', // boleh diganti
            'status' => 'pending',
        ]);

        // Hapus item dari keranjang
        CartItem::where('user_id', Auth::id())
            ->whereIn('id', $request->selected_items)
            ->delete();

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Checkout berhasil!');
    }
}
