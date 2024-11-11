<?php

namespace App\Http\Controllers;

use App\Models\Post;
class DailyWeatherController extends Controller
{
    public function index(){
        $posts = Post::where('status', 0)->orderBy('updated_at','desc')->paginate(5);
        return view('post.daily-weather', compact('posts'));
    }

    public function show($slug)
    {
        $posts = Post::where('slug', $slug)->firstOrFail();
        return view('post.detail', compact('posts'));
    }
}
