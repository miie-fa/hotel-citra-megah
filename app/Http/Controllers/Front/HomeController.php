<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Home;
use App\Models\Room;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Room::limit(3)->where('is_published', 1)->get();
        $home = Home::first();
        $settings = Setting::first();
        $sliders = Slider::get();
        $amenities = Amenity::limit(8)->get();

        return view('front.home', compact('rooms', 'settings', 'sliders', 'amenities','home'));
    }
}
