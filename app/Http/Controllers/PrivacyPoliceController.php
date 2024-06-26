<?php

namespace App\Http\Controllers;

use App\Models\PrivacyPolice;
use App\Models\Setting;
use Illuminate\Http\Request;

class PrivacyPoliceController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        $data = PrivacyPolice::first();

        return view('front.privacy_police', compact('settings', 'data'));
    }
}
