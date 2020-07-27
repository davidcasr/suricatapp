<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wink\WinkPost;

class FrontendController extends Controller
{
    public function index()
    {
        $posts = WinkPost::with('tags')
            ->live()->latest()
            ->take(3)->get();

        return view('frontend.app', compact('posts'));
    }

    public function blog($slug)
    {   
        $post = WinkPost::with('tags')
            ->live()
            ->where('slug', $slug)
            ->first();

        return view('frontend.blog.app', compact('slug', 'post'));
    }
}

