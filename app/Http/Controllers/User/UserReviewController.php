<?php

namespace App\Http\Controllers\User;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReviewController extends Controller
{

    public function submitReview(Request $request, Order $order)
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Mendapatkan room dari order
        $room = $order->room; // asumsi bahwa Anda memiliki relasi 'room' dalam model Order Anda

        if ($room) {
            // Membuat comment baru
            $comment = new Comment();
            $comment->content = $request->content;
            $comment->commentable_type = 'App\Models\Room';
            $comment->commentable_id = $room->id;
            $comment->user_id = $user->id;

            // Menyimpan comment
            $comment->save();

            return back()->with('success', 'Review berhasil disimpan.');
        } else {
            // Jika tidak ada room yang terkait dengan order ini, kembalikan error
            return back()->with('error', 'Tidak ada kamar yang terkait dengan pesanan ini.');
        }
    }

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

    return view('user.review', compact('order_details', 'orders', 'settings'));
}








}