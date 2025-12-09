<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Xendit\Xendit;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $selectedIds = $request->selected_items;

        if (!is_array($selectedIds)) {
            $selectedIds = explode(',', $selectedIds);
        }

        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->whereIn('id', $selectedIds)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item dipilih.');
        }

        return view('checkout.index', compact('cartItems'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'selected_items' => 'required|array',
            'alamat' => 'required',
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
                'subtotal' => $item->product->harga * $item->qty,
            ];

            $total += $item->product->harga * $item->qty;
        }

        // ✅ SIMPAN ORDER LANGSUNG PAID (KHUSUS TESTING)
        $order = Order::create([
            'user_id' => Auth::id(),
            'items' => $items,
            'total' => $total,
            'payment_method' => 'xendit',
            'alamat' => $request->alamat,
            'status' => 'paid', // ✅ LANGSUNG PAID AGAR TIDAK PENDING
        ]);

        // ✅ TETAP BUAT INVOICE XENDIT (TIDAK DIHAPUS)
        Xendit::setApiKey(config('services.xendit.secret_key'));

        $invoice = \Xendit\Invoice::create([
            'external_id' => 'order-' . $order->id,
            'amount' => $total,
            'description' => 'Pembayaran Order #' . $order->id,
            'success_redirect_url' => route('orders.success', $order->id),
            'failure_redirect_url' => route('orders.failed', $order->id),
        ]);

        // ✅ SIMPAN DATA INVOICE
        $order->update([
            'invoice_id' => $invoice['id'],
            'invoice_url' => $invoice['invoice_url'],
        ]);

        // ✅ HAPUS CART SETELAH CHECKOUT
        CartItem::where('user_id', Auth::id())
            ->whereIn('id', $request->selected_items)
            ->delete();

        // ✅ TETAP REDIRECT KE XENDIT (BUKAN LANGSUNG SUCCESS)
        return redirect($invoice['invoice_url']);
    }

    // ✅ WEBHOOK MASIH TETAP ADA JIKA MAU DIPAKAI NANTI
    public function callback(Request $request)
    {
        Log::info('XENDIT CALLBACK MASUK', $request->all());

        $status = strtolower($request->data['status'] ?? '');
        $externalId = $request->data['external_id'] ?? null;

        if (!$externalId) {
            return response()->json(['message' => 'external_id not found'], 400);
        }

        // order-29 → 29
        $orderId = str_replace('order-', '', $externalId);
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order Not Found'], 404);
        }

        // ✅ ANTI DOUBLE PAYMENT
        if ($order->status === 'paid') {
            return response()->json(['message' => 'Order already paid'], 200);
        }

        if (in_array($status, ['succeeded', 'paid', 'settled'])) {
            $order->update(['status' => 'paid']);
        }

        if (in_array($status, ['expired', 'failed'])) {
            $order->update(['status' => 'failed']);
        }

        return response()->json([
            'message' => 'Callback processed successfully',
            'order_id' => $order->id,
            'status' => $order->status,
        ]);
    }
}
