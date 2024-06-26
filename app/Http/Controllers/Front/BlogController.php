<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;

class BlogController extends Controller
{
    public function index()
    {
        $title = '';

        if(request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        $settings = Setting::first();

        return view('front.blog', [
            "title" => "Blog" . $title,
            "active" => 'posts',
            "posts" => Post::latest()->where('is_published', 1)->filter(request(['search', 'category']))->paginate(3),
            "latest_posts" => Post::popular()->where('is_published', 1)->limit(5)->get()
        ], compact('settings'));
    }

    public function detailBlog($slug)
    {
        $detail_post = Post::where('slug', $slug)->firstOrFail();
        $detail_post->update([
            'views' => $detail_post->views + 1
        ]);
        $settings = Setting::first();

        if (request()->has('search')) {
            return redirect()->route('blog', [
                'search' => request('search')
            ]);
        } else {
            return view('front.detail_blog', [
                "latest_posts" => Post::popular()->limit(5)->get()
            ], compact('settings', 'detail_post'));
        }



    }
}
