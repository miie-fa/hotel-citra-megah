<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function about()
    {
        $page_data = Page::where('id',1)->first();
        return view('admin.pages.about', compact('page_data'));
    }

    public function aboutUpdate(Request $request)
    {
        $obj = Page::where('id',1)->first();
        $obj->about_heading = $request->about_heading;
        $obj->about_content = $request->about_content;
        $obj->about_visi = $request->about_visi;
        $obj->about_misi = $request->about_misi;
        $obj->about_status = $request->about_status;
        $obj->update();

        return redirect()->back()->with('success', 'Data is updated successfully.');
    }
}
