<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannerVideos;

class BlogController extends Controller
{
    public function index()
    {
        $banners = BannerVideos::orderBy('id', 'desc')->get();
        return view('backend.pages.blog.index', compact('banners'));
    }

    public function create()
    {
        return view('backend.pages.blog.create');
    }
}
