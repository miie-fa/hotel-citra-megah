<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GuestIndex; 

class GuestController extends Controller
{
    public function index()
    {
        return view('admin.settings.guest_index');
    }
    
    public function getAll()
    {
        return GuestIndex::all();
    }

    public function add(Request $request) 
    {
        $guest = new GuestIndex();
        $guest->name = $request->name;
        $guest->save();

        return "Data berhasil ditambahkan";
    }

    public function update(Request $request, $id)
    {   
        $guest = GuestIndex::find($id);
        $guest->name = $request->name; 
        $guest->save();
        
        return "Data berhasil diupdate";
    }
}