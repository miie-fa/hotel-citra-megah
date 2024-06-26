<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $settings = Setting::first();

        return view('user.dashboard', compact('settings'));
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $settings = Setting::first();

        return view('front.edit-profile',compact('user', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $settings = Setting::first();

        return view('user.profile.user_detail', compact('user', 'settings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = User::find(Auth::user()->id);
        $settings = Setting::first();


        return view('user.edit-profiles', compact('user', 'settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
      $user = User::find($id);

        $validatedData = $request->validate([
          'name' => 'required',
          'email' => 'required|email|unique:users,email,' . $user['id'],
          'phone' => 'required',
          'country' => 'required',
          'address' => 'required',

        ]);

        if($request->filled('password')) {
          $validatedData['password'] = Hash::make($request->password);
        } else {
          $validatedData['password'] = $user->password;
        }

        if ($request->hasFile('avatar')) {
          $oldAvatar = $user->avatar;

          $ext = $request->file('avatar')->extension();
          $finalName = time() . '.' . $ext;
          $request->file('avatar')->move(public_path('uploads/'), $finalName);
          $user->avatar = $finalName;

          // Hapus gambar lama setelah avatar baru berhasil diunggah
          if ($oldAvatar) {
              $oldAvatarPath = public_path('uploads/' . $oldAvatar);
              if (file_exists($oldAvatarPath)) {
                  unlink($oldAvatarPath);
              }
          }
      }

        $user->update($validatedData);

        return redirect()->route('user.dashboard')
                    ->with('success', 'Profil Berhasil diperbarui!');

                    // Setelah selesai update data, tambahkan flash message
    Session::flash('success', 'Profil berhasil diperbarui.');
      }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('home');
    }

}
