<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\User;

class ExploreController extends Controller
{
    public function show(){
        $following = auth()->user()->following->pluck('user_id');
        $posts = Post::whereIn('user_id', $following)->orderBy('id', 'desc')->get(); 

        // lay ra user duoc auth follow
        $userFls = User::whereIn('id', $following)->get();
        // tao arr chua nguoi duoc follow cua nguoi duoc auth follow :))
        $arr_idUser = [];
        $arr_temp = [];
        // lap qua tung user duoc auth follow
        foreach ($userFls as $userFl) {
            // lap qua tung user duoc follow boi $userFl
            foreach ($userFl->following as $user_follow) {
                // neu trung voi id cua auth thi continue
                if($user_follow->user->id == auth()->user()->id){
                    continue;
                }
                // check trung voi id cua nguoi da duoc auth follow
                $check = DB::table('profile_user')->where([
                    ['user_id', auth()->user()->id],
                    ['profile_id', $user_follow->id]
                ])->get();
                if($check->count() > 0 ){
                    continue;
                }
                // check trung username 
                if(in_array($user_follow->user->username,$arr_temp)){
                    continue;
                }
                // push vao $arr_idUser mot mang gom [profile cua user,ten cua nguoi duoc auth follow];
                array_push($arr_idUser, [$user_follow,$userFl->username]);
                array_push($arr_temp,$user_follow->user->username);
                // cai nay de qua r :))
                if(count($arr_idUser) == 3){
                    break;
                }
            }
        }
        return view('explore.show', compact('arr_idUser'));
    }
}
