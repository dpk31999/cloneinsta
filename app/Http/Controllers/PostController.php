<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\ReplyComment;
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
        $get = $post->getTime();
        $image = $post->image;
        $caption = $post->caption;
        $check_show = 'success';
        $posts = DB::table('posts')->where([
            ['id', '!=' , $post->id],
            ['user_id' , $post->user->id]
        ])->get();
        $url = "profile/" . $post->user->id;
        $comments = $post->commented;
        $id_post = $post->id;
        $countLike = $post->liked->count();
        $id_user = $post->user->id;
        if(url()->previous() != url($url)){
            return view('posts.show', [
                'user' => $user,
                'image' =>$image,
                'caption' =>$caption,
                'posts' => $posts,
                'follows' => $follows,
                'get' => $get,
                'comments' => $comments,
                'id_post' => $id_post,
                'countLike' => $countLike,
                'id_user' => $id_user
            ]);
        }
        else{
        return view('profiles.index' , [
            'check_show' => $check_show,
            'user' => $user,
            'image' => $image,
            'caption' => $caption,
            'follows' => $follows,
            'get' => $get,
            'comments' => $comments,
            'id_post' => $id_post,
            'countLike' => $countLike,
            'id_user' => $id_user
        ]);
        }
    }

    public function createcomment(Post $post,Request $request){
        $data = Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'content' => $request->input('comment')
        ]);
        $id_comment = $data->id;
        $url_thumb = 'default_ava.jpg';
        if(auth()->user()->profile->url_thumb != ''){
            $url_thumb = auth()->user()->profile->url_thumb;
        }
        $id = auth()->user()->id;   
        return response()->json([
            'comment' => $request->input('comment'),
            'username' => auth()->user()->username,
            'id_post' => $post->id,
            'url_thumb' => $url_thumb,
            'id' => $id,
            'id_comment' => $id_comment
        ], 200);
    }

    public function createreplycomment(Request $request, Comment $comment){
        $data = ReplyComment::create([
            'user_id' => auth()->user()->id,
            'comment_id' => $comment->id,
            'content' => $request->input('replyCmt')
        ]);
        $id_comment = $comment->id;
        $url_thumb = 'default_ava.jpg';
        if(auth()->user()->profile->url_thumb != ''){
            $url_thumb = auth()->user()->profile->url_thumb;
        }
        return response()->json([
            'replyCmt' => $request->input('replyCmt'),
            'id_comment' => $comment->id,
            'url_thumb' => $url_thumb,
            'user' => auth()->user(),
            'id_comment' => $id_comment
        ], 200);
    }
}
