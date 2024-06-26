<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Room;
use App\Models\RoomPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::orderByDesc('id')->get();
        return view('admin.room.room_index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::get();
        $all_amenities = Amenity::get();
        $room_id = rand(1000, 9999);
        return view('admin.room.room_add', compact('rooms', 'all_amenities', 'room_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $amenities = '';
        $i=0;
        if(isset($request->arr_amenities)) {
            foreach($request->arr_amenities as $item) {
                if($i==0) {
                    $amenities .= $item;
                } else {
                    $amenities .= ','.$item;
                }
                $i++;
            }
        }

        $request->validate([
            'featured_photo' => 'required|image|mimes:jpg,jpeg,png,gif',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'total_rooms' => 'required'
        ]);

        $ext = $request->file('featured_photo')->extension();
        $final_name = time().'.'.$ext;
        $request->file('featured_photo')->move(public_path('uploads/'), $final_name);

        $newRoom = new Room();
        $newRoom->room_id = $request->room_id;
        $newRoom->featured_photo = $final_name;
        $newRoom->name = $request->name;
        $newRoom->description = $request->description;
        $newRoom->price = $request->price;
        $newRoom->total_rooms = $request->total_rooms;
        $newRoom->amenities = $amenities;
        $newRoom->size = $request->size;
        $newRoom->bed_type = $request->bed_type;
        $newRoom->total_bathrooms = $request->total_bathrooms;
        $newRoom->total_guests = $request->total_guests;
        $newRoom->save();

        return redirect()->route('room.index')->with('success', 'Room created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $all_amenities = Amenity::get();
        $room_data = Room::where('id', $id)->first();

        $existing_amenities = array();
        if($room_data->amenities != '') {
            $existing_amenities = explode(',',$room_data->amenities);
        }

        return view('admin.room.room_edit', compact('room_data', 'all_amenities', 'existing_amenities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $object = Room::where('id', $id)->first();

        $amenities = '';
        $i=0;
        if(isset($request->arr_amenities)) {
            foreach($request->arr_amenities as $item) {
                if($i==0) {
                    $amenities .= $item;
                } else {
                    $amenities .= ','.$item;
                }
                $i++;
            }
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'total_rooms' => 'required',
            'featured_photo' => 'image|mimes:jpg,jpeg,png,gif',
        ],[
            'thumbnail.image' => 'The uploaded file must be an image.',
            'thumbnail.mimes' => 'Allowed image formats: jpg, jpeg, png, gif.',
        ]);


        if ($request->hasFile('featured_photo')) {
            $oldFeaturedPhoto = $object->featured_photo;

            $ext = $request->file('featured_photo')->extension();
            $finalName = time() . '.' . $ext;
            $request->file('featured_photo')->move(public_path('uploads/'), $finalName);
            $object->featured_photo = $finalName;

            // Hapus gambar lama setelah foto unggulan baru berhasil diunggah
            if ($oldFeaturedPhoto) {
                $oldFeaturedPhotoPath = public_path('uploads/' . $oldFeaturedPhoto);
                if (file_exists($oldFeaturedPhotoPath)) {
                    unlink($oldFeaturedPhotoPath);
                }
            }
        }

        $object->name = $request->name;
        $object->description = $request->description;
        $object->price = $request->price;
        $object->total_rooms = $request->total_rooms;
        $object->amenities = $amenities;
        $object->size = $request->size;
        $object->bed_type = $request->bed_type;
        $object->total_bathrooms = $request->total_bathrooms;
        $object->total_guests = $request->total_guests;
        $object->update();

        return redirect()->route('room.index')->with('warning', 'Data Room has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Room::where('id', $id)->first();
        unlink(public_path('uploads/'. $data->featured_photo));
        $data->delete();

        return redirect()->route('room.index')->with('danger', 'Successfully deleted');
    }

    public function gallery($id)
    {
        $room_data = Room::where('id', $id)->first();
        $room_photos = RoomPhoto::where('room_id', $id)->get();

        return view('admin.room.gallery', compact('room_data', 'room_photos'));
    }

    public function gallery_store(Request $request, $room_id)
    {
        // Validasi unggahan gambar
        // $request->validate([
        //     'photos' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Contoh batasan jenis file dan ukuran
        // ]);

        // // Simpan gambar ke direktori penyimpanan
        // $ext = $request->file('photo')->extension();
        // $final_name = time().'.'.$ext;
        // $request->file('photo')->move(public_path('uploads/'), $final_name);

        // // Simpan informasi gambar ke database
        // $roomImage = new RoomPhoto();
        // dd($roomImage);
        // $roomImage->photo = $final_name;
        // $roomImage->room_id = $room_id;
        // $roomImage->save();

        // return response()->json(['status' => 'success', 'message' => 'Image uploaded and saved successfully']);

        $request->validate([
            'photo' => ['required', 'image', 'mimes:png,jpg,jpeg,gif']
        ]);

        $ext = $request->file('photo')->extension();
        $final_name = time().'.'.$ext;
        $request->file('photo')->move(public_path('uploads/'), $final_name);

        $obj = new RoomPhoto;
        $obj->photo = $final_name;
        $obj->room_id = $id;
        $obj->save();

        return redirect()->back()->with('success', 'Room Photo Added Successfully');
    }

    public function gallery_delete($id)
    {
        $single_photo = RoomPhoto::where('id', $id)->first();
        unlink(public_path('uploads/' . $single_photo->photo));
        $single_photo->delete();

        return redirect()->back()->with('danger', 'Room Photo Deleted Successfully');
    }
}
