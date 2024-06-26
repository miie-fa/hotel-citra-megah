<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class AdminHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::get();
        return view('admin.hotel.hotel_index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hotels = Hotel::get();
        return view('admin.hotel.hotel_add', compact('hotels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,gif',
            'name' => 'required',
        ]);

        $ext = $request->file('thumbnail')->extension();
        $final_name = time().'.'.$ext;
        $request->file('thumbnail')->move(public_path('uploads/'), $final_name);

        $obj = new Hotel();
        $obj->thumbnail = $final_name;
        $obj->name = $request->name;
        $obj->save();

        return redirect()->route('hotel.index')->with('success', 'Hotel created successfully!');
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
        $hotel_data = Hotel::where('id', $id)->first();
        return view('admin.hotel.hotel_edit', compact('hotel_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $object = Hotel::where('id', $id)->first();

        $request->validate([
            'name' => 'required',
            'thumbnail' => 'image|mimes:jpg,jpeg,png,gif',
        ], [
            'thumbnail.image' => 'The uploaded file must be an image.',
            'thumbnail.mimes' => 'Allowed image formats: jpg, jpeg, png, gif.',
        ]);

        if ($request->hasFile('thumbnail')) {
            $oldThumbnail = $object->thumbnail;

            $ext = $request->file('thumbnail')->extension();
            $finalName = time() . '.' . $ext;
            $request->file('thumbnail')->move(public_path('uploads/'), $finalName);
            $object->thumbnail = $finalName;

            // Hapus gambar lama setelah thumbnail baru berhasil diunggah
            if ($oldThumbnail) {
                $oldThumbnailPath = public_path('uploads/' . $oldThumbnail);
                if (file_exists($oldThumbnailPath)) {
                    unlink($oldThumbnailPath);
                }
            }
        }

        $object->name = $request->name;
        $object->update();

        return redirect()->route('hotel.index')->with('warning', 'Hotel data has been updated!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Hotel::where('id', $id)->first();
        unlink(public_path('uploads/'. $data->thumbnail));
        $data->delete();

        return redirect()->route('hotel.index')->with('danger', 'Successfully deleted');
    }
}
