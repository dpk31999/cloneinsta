<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;

class PostController extends Controller
{
    public function index()
    {   
        $posts = Post::all();
        return view('admin.post',compact('posts'));
    }
}
