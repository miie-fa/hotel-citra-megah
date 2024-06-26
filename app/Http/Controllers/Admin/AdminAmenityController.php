<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AdminAmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $amenities = Amenity::get();

        return view('admin.amenity.amenity_index', compact('amenities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $amenities = Amenity::get();
        return view('admin.amenity.amenity_add', compact('amenities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'icon' => 'required',
            'name' => 'required',
        ]);

        Amenity::create($validate);

        return redirect()->route('amenity.index')->with('success', 'Amenity created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $amenity_data = Amenity::where('id', $id)->first();
        return view('admin.amenity.amenity_edit', compact('amenity_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'icon' => 'required',
            'name' => 'required',
        ]);

        $amenity = Amenity::find($id);
        $amenity->update($validate);

        return redirect()->route('amenity.index')->with('success', 'Amenity edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Amenity::find($id);

        $data->delete();

        return redirect()->route('amenity.index')->with('error', 'Successfully deleted');
    }
}
