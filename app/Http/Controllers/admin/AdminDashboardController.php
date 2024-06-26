<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // $rooms_total = Room::count();
        return view('admin.dashboard', compact('rooms_total'));
    }
}
