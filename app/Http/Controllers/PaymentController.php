<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Xendit\Xendit;

class PaymentController extends Controller
{
    public function createInvoice($orderId)
    {
        // ✅ AMBIL ORDER DARI DATABASE
        $order = Order::findOrFail($orderId);

        // ✅ PAKAI API KEY DARI .env
        Xendit::setApiKey(config('services.xendit.secret_key'));

        // ✅ PARAMETER INVOICE
        $params = [
            "external_id" => "order-" . $order->id,
            "amount" => $order->total,
            "description" => "Pembayaran Order #" . $order->id,
            "success_redirect_url" => route('orders.success', $order->id),
            "failure_redirect_url" => route('orders.failed', $order->id),
        ];

        // ✅ BUAT INVOICE
        $invoice = \Xendit\Invoice::create($params);

        // ✅ SIMPAN KE DATABASE
        $order->update([
            'invoice_id'  => $invoice['id'],
            'invoice_url' => $invoice['invoice_url'],
        ]);

        // ✅ REDIRECT KE XENDIT
        return redirect($invoice['invoice_url']);
    }
}
