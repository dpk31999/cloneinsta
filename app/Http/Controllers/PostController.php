<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{   
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'caption' => 'required|unique:posts|min:5',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $image_path = 'uploads/' . time() . '.' . $image->getClientOriginalExtension();
        
        $path = public_path('/storage/uploads');   

        $image->move($path ,$image_path);

        
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $image_path
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Post $post){
        $user = $post->user;
        $follow = DB::table('profile_user')->where([
            ['user_id', auth()->user()->id],
            ['profile_id', $user->profile->id],
        ])->get();
        $follows = false;
        if($follow->count() > 0){
            $follows = true;
        }
        $image = $post->image;
        $caption = $post->caption;
        $check_show = 'success';
        $posts = DB::table('posts')->where('id', '!=' , $post->id)->get();
        $url = "profile/" . $post->user->id;
        if(url()->previous() != url($url)){
            return view('posts.show', [
                'user' => $user,
                'image' =>$image,
                'caption' =>$caption,
                'posts' => $posts,
                'follows' => $follows
            ]);
        }
        else{
        return view('profiles.index' , [
            'check_show' => $check_show,
            'user' => $user,
            'image' => $image,
            'caption' => $caption,
            'follows' => $follows
        ]);
        }
    }
}
