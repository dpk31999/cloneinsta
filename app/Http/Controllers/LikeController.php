<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;

class LikeController extends Controller
{
    public function store(User $user,Post $post){
        return auth()->user()->like()->toggle($post);
    }

    public function storeLikeComment(User $user,Comment $comment){
        return auth()->user()->likeCmt()->toggle($comment);
    }
}
