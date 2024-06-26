<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::get();
        return view('admin.post.post_index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Post::get();
        return view('admin.post.post_add', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,gif',
            'title' => 'required',
            'content' => 'required',
        ]);

        $ext = $request->file('thumbnail')->extension();
        $final_name = time().'.'.$ext;
        $request->file('thumbnail')->move(public_path('uploads/'), $final_name);

        $obj = new Post();
        $obj->thumbnail = $final_name;
        $obj->title = $request->title;
        $obj->content = $request->content;
        $obj->total_view = 1;
        $obj->save();

        return redirect()->route('post.index')->with('success', 'Post created successfully!');
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
        $post_data = Post::where('id', $id)->first();
        return view('admin.post.post_edit', compact('post_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $object = Post::where('id', $id)->first();

        $request->validate([
            'title' => 'required',
            'content' => 'required',
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

        $object->title = $request->title;
        $object->content = $request->content;
        $object->update();

        return redirect()->route('post.index')->with('success', 'Data Post has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Post::where('id', $id)->first();
        unlink(public_path('uploads/'. $data->thumbnail));
        $data->delete();

        return redirect()->route('post.index')->with('error', 'Successfully deleted');
    }   
}
