<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Admin;

class UserController extends Controller
{
    public function index()
    {      
        $users = User::all();
        return view('admin.user', compact('users'));
    }

    public function blockUser(User $user)
    {   

        // dd($user->status);
        if($user->status == 0)
        {
            $user->status = 1;
        }
        else{
            $user->status = 0;
        }
        $user->save();

        if($user->status == 0)
        {
            $status = 'Active';
        }
        else{
            $status = 'Block';
        }

        return response()->json(
            ['status' => $status]
        , 200);
    }

    public function getUser(User $user)
    {
        $count_post = $user->posts->count();
        $count_following = $user->following->count();
        $count_follower = $user->profile->followers->count();

        if($user->status == 0)
        {
            $status = 'Active';
        }
        else{
            $status = 'Block';
        }

        return response()->json([
            'user' => $user,
            'count_post' => $count_post,
            'count_following' => $count_following,
            'count_follower' => $count_follower,
            'status' => $status
        ], 200);
    }
}
