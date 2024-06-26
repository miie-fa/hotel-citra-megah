<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Room;
use Illuminate\Http\Request;

class CommentController extends Controller
{


    public function submitReview(Request $request, Order $order)
{
    $room = $order->room; // asumsi bahwa Anda memiliki relasi 'room' dalam model Order Anda

    if ($room) {
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->commentable_type = 'App\Models\Room';
        $comment->commentable_id = $room->id;
        $comment->user_id = auth()->id(); // asumsi user sudah login

        $room->comments()->save($comment);

        return back();
    } else {
        // handle kasus ketika tidak ada kamar yang terkait dengan pesanan ini
        return back()->with('error', 'Tidak ada kamar yang terkait dengan pesanan ini.');
    }
}




}
