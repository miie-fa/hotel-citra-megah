<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Hotel;
use App\Models\OrderDetail;
use App\Models\Room;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomsController extends Controller
{
    public function index()
    {
        $rooms = Room::where('is_published', 1)->get();
        $users = User::get();
        $settings = Setting::first();

        return view('front.rooms', compact('rooms', 'users', 'settings'));
    }

    public function search(Request $request)
    {
        $sort = $request->input('sort', 'asc');
        $rooms = Room::where('is_published', 1)->orderBy('price', $sort)->filter(request(['search', 'search_adults', 'search_childrens', 'priceRange']))->get();
        $minValue = Room::where('is_published', 1)->min('price');
        $maxValue = Room::where('is_published', 1)->max('price');


        if ($request->ajax()) {
            return view('front.search_room', [
                "title" => "Blog",
                "settings" => Setting::first(),
                "users" => User::get(),
            ], compact('rooms', 'minValue', 'maxValue'))->render();
        }

        return view('front.search_room', [
                "title" => "Blog",
                "settings" => Setting::first(),
                "users" => User::get(),
        ], compact('rooms', 'minValue', 'maxValue'));
    }

    public function detail_room($slug)
    {
        $settings = Setting::first();
        $detail_room = Room::where('slug', $slug)->first();
        $comments = Comment::where('is_visible', 1)->get();

        return view('front.detail_room', compact('detail_room', 'settings', 'comments'));
    }

    public function prosesPemesanan(Request $request)
    {
        $checkinText = $request->input('checkinText');
        $checkoutText = $request->input('checkoutText');
        $nightCount = $request->input('nightCount');
        $roomId = $request->input('roomId');
        $roomNameSummary = $request->input('roomNameSummary');
        $childCount = $request->input('childCount');
        $adultCount = $request->input('adultCount');
        $totalRoomPrice = $request->input('totalRoomPrice');

        $userId = Auth::id();

        $timestamp = now()->format('YmdHis');
        $userIdPart = str_pad($userId, 4, '0', STR_PAD_LEFT); // Maksimum ID 4 digit
        $randomPart = mt_rand(100, 999); // Angka acak 3 digit
        $orderNumber = $timestamp . $userIdPart . $randomPart;

        $obj = new OrderDetail();
        $obj->user_id = $userId;
        $obj->room_id = $roomId;
        $obj->room_name = $roomNameSummary;
        $obj->order_no = $orderNumber;
        $obj->checkin_date = $checkinText;
        $obj->checkout_date = $checkoutText;
        $obj->night = $nightCount;
        $obj->children = $childCount;
        $obj->adult = $adultCount;
        $obj->subtotal = $totalRoomPrice;
        $obj->save();

        return response()->json(['message' => 'Pemesanan berhasil dilakukan']);
    }
    public function show($id)
{
    $room = Room::find($id);
    return response()->json($room);
}

}
