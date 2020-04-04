<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;

class HoneController extends Controller
{
    public function index(){
        if(auth()->user()){
            $following = auth()->user()->following->pluck('user_id');
            $posts = Post::whereIn('user_id', $following)->orderBy('id', 'desc')->get(); 
        }
        else{
            $posts = Post::get();
        }
        $user = auth()->user();
        if(isset($user)){
            return view('posts.index', compact('posts','user'));
        }
        return view('welcome');
    }
}
