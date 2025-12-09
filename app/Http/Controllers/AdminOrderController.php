<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
  
    public function index(Request $request)
    {

        $orders = Order::with('user')
            ->latest()
            ->paginate(10);


        if ($request->ajax()) {
            return view('admin.orders.index', compact('orders'))->render();
        }

        return view('admin.orders.index', compact('orders'));
    }


}
