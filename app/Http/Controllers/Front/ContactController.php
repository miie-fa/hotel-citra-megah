<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {

        return view('front.contact', [
            "settings" => Setting::first(),
        ]);
    }

    public function sendEmail(Request $request)
    {
        $details = [
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->pesan,
        ];

        Mail::to('pasharamabussines@gmail.com')->send(new ContactMail($details));
        return back()->with('success', 'Pesan kamu sudah berhasil di kirim!');
    }
}
