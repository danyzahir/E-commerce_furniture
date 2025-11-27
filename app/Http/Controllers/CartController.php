<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilkan halaman keranjang
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    // Tambah ke keranjang
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produks,id',
            'qty'        => 'required|integer|min:1',
        ]);

        $produk = Produk::find($request->product_id);
        if (!$produk) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        $item = CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($item) {
            $item->qty += $request->qty;
            $item->save();
        } else {
            CartItem::create([
                'user_id'    => Auth::id(),
                'product_id' => $request->product_id,
                'qty'        => $request->qty,
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    // Hapus 1 item
    public function delete($id)
    {
        CartItem::where('user_id', Auth::id())
            ->where('id', $id)
            ->delete();

        return back()->with('success', 'Item dihapus dari keranjang!');
    }

    // Hapus item terpilih
    public function deleteSelected(Request $request)
    {
        if (!$request->selected_items) {
            return back()->with('error', 'Tidak ada item yang dipilih.');
        }

        // Decode JSON dari "[1,2,3]" menjadi array [1,2,3]
        $ids = json_decode($request->selected_items, true);

        if (!is_array($ids) || count($ids) === 0) {
            return back()->with('error', 'Data tidak valid.');
        }

        CartItem::where('user_id', Auth::id())
            ->whereIn('id', $ids)
            ->delete();

        return back()->with('success', 'Item terpilih berhasil dihapus!');
    }
}
