<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Hotel;
use App\Models\Setting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        $about_us = AboutUs::first();

        return view('front.about', compact('settings', 'about_us'));
    }
}
