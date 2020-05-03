<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Comment;
use App\Noti;
use Pusher\Pusher;

class LikeController extends Controller
{
    public function store(User $user,Post $post){
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

        $rowLike = DB::table('post_user')->where([
            ['user_id',auth()->user()->id],
            ['post_id',$post->id],
        ]);
        if($rowLike->count() == 0){
            $noti = new Noti();
            $noti->newNoti("like","post",$post->user->id,$post->id);

            $data = ['from' => auth()->user()->id, 'to' => $post->user->id]; // sending from and to user id when pressed enter
            $pusher->trigger('my-channel', 'my-event', $data);
        }

        return auth()->user()->like()->toggle($post);
    }

    public function storeLikeComment(User $user,Comment $comment){
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

        $rowLikeCmt = DB::table('comment_user')->where([
            ['user_id',auth()->user()->id],
            ['comment_id',$comment->id]
        ]);
        if($rowLikeCmt->count() == 0){
            $noti = new Noti();
            $noti->newNoti("like","comment",$comment->user->id,$comment->post->id);
            
            $data = ['from' => auth()->user()->id, 'to' => $comment->user->id]; // sending from and to user id when pressed enter
            $pusher->trigger('my-channel', 'my-event', $data);
        }
        return auth()->user()->likeCmt()->toggle($comment);
    }
}
