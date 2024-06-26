<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Room;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $orders = Order::where('user_id', $user)->get();
        $settings = Setting::first();

        return view('user.order', compact('orders', 'settings'));
    }

    public function detail_order($id)
    {
        $user = Auth::user()->id;
        $order = Order::where('id', $id)->first();
        $order_detail = OrderDetail::where('order_id', $order->id)->get();
        $room = Room::find($order_detail->first()->room_id);
        $settings = Setting::first();

        return view('user.order_details', compact('order', 'order_detail', 'room', 'settings'));
    }
    
    public function cancel_order($id)
{
    $order = Order::find($id);
    if ($order->user_id != Auth::user()->id) {
        return redirect()->back();
    }

    $order_details = OrderDetail::where('order_id', $order->id)->get();
    foreach ($order_details as $detail) {
        $room = Room::find($detail->room_id);
        $room->total_rooms += $detail->quantity;
        $room->save();
    }

    // Ubah status order menjadi 'CANCEL'
    $order->status = 'CANCEL';
    $order->save();

    return redirect()->back()->with('success', 'Order berhasil dibatalkan');
}



}
