<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\ReplyComment;
use App\Noti;
use Pusher\Pusher;
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
        $check_show = 'success';
        $posts = DB::table('posts')->where([
            ['id', '!=' , $post->id],
            ['user_id' , $post->user->id]
        ])->get();
        $url = "profile/" . $post->user->id;
        if(url()->previous() != url($url)){
            return view('posts.show', [
                'user' => $user,
                'posts' => $posts,
                'post' => $post,
                'follows' => $follows,
                'comments' => $post->commented,
            ]);
        }
        else{
        return view('profiles.index' , [
            'check_show' => $check_show,
            'user' => $user,
            'follows' => $follows,
            'comments' => $post->commented,
            'post' => $post,
        ]);
        }
    }

    public function createcomment(Post $post,Request $request){
        $url_thumb = 'default_ava.jpg';
        if(auth()->user()->profile->url_thumb != ''){
            $url_thumb = auth()->user()->profile->url_thumb;
        }

        $data = Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'content' => $request->input('comment')
        ]);
        $id_comment = $data->id;

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $arr_comments = DB::table('comments')->where([
            ['post_id',$post->id],
            ['user_id','!=',$post->user->id],
            ['user_id','!=',auth()->user()->id],
        ])->distinct()->pluck('user_id');
        // add noti
        $noti = new Noti();

        foreach ($arr_comments as $user_id) {
            $noti->newNoti("comment","post that you're following",$user_id,$post->id);
        }

        $noti->newNoti("comment","post",$post->user->id,$post->id);
        $data = [
            'from' => auth()->user()->id,
            'to' => $post->user->id,
            'id_post' => $post->id,
            'username' => auth()->user()->username,
            'comment' => $request->input('comment'),
            'url_thumb' => $url_thumb,
            'arr_comments' => $arr_comments,
            'id_comment' => $id_comment
        ]; // sending from and to user id when pressed enter
        $pusher->trigger('channel-cmt', 'event-cmt', $data);

        // add comment
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
        $url_thumb = 'default_ava.jpg';
        if(auth()->user()->profile->url_thumb != ''){
            $url_thumb = auth()->user()->profile->url_thumb;
        }

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $noti = new Noti();
        $noti->newNoti("reply","comment",$comment->user->id,$comment->post->id);

        $data = [
            'from' => auth()->user()->id, 
            'to' => $comment->user->id,
            'id_comment' => $comment->id,
            'username' => auth()->user()->username,
            'url_thumb' => $url_thumb,
            'replyCmt' => $request->input('replyCmt'),
        ]; // sending from and to user id when pressed enter
        $pusher->trigger('channel-rep-cmt', 'event-rep-cmt', $data);

        $data = ReplyComment::create([
            'user_id' => auth()->user()->id,
            'comment_id' => $comment->id,
            'content' => $request->input('replyCmt')
        ]);
        $id_comment = $comment->id;
        return response()->json([
            'replyCmt' => $request->input('replyCmt'),
            'id_comment' => $comment->id,
            'url_thumb' => $url_thumb,
            'user' => auth()->user(),
            'id_comment' => $id_comment
        ], 200);
    }
}
