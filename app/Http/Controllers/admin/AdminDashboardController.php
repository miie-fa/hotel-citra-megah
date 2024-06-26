<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $rooms_total = Room::count();
        return view('admin.dashboard', compact('rooms_total'));
    }
}
