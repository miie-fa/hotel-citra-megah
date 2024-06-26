<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\TermsConditions;
use Illuminate\Http\Request;

class TermsConditionsController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        $data = TermsConditions::first();

        return view('front.term_conditions', compact('settings', 'data'));
    }
}
