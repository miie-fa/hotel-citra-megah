<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        $faqs = Faq::get();

        return view('front.faq', compact('settings', 'faqs'));
    }
}
