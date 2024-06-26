<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index()
{
    $user = Auth::user()->id;
    $orders = Order::where('user_id', $user)->get();
    $order_details = [];
    $settings = Setting::first();

    foreach ($orders as $order) {
        $details = OrderDetail::where('order_id', $order->id)->get();
        array_push($order_details, ...$details);
    }

    return view('user.invoice', compact('orders', 'order_details', 'settings'));
}

    public function detail_order()
    {
        $user = Auth::user()->id;
        $order = Order::where('id', $user)->first();
        $order_detail = OrderDetail::where('order_id', $order->id)->get();
        $settings = Setting::first();

        return view('user.invoices', compact('order', 'order_detail', 'settings'));
    }
}
