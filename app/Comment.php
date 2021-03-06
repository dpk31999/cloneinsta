<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Comment extends Model
{   
    protected $fillable = ['user_id','post_id','content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function likedCmt()
    {
        return $this->belongsToMany(User::class);
    }

    public function replyComment()
    {
        return $this->hasMany(ReplyComment::class);
    }

    public function getTime()
    {  
        $create_day = DB::table('comments')->select('created_at')->where('id', $this->id)->first();
        $dt = Carbon::now();
        $now = Carbon::createFromFormat('Y-m-d H:i:s', $dt);
        return Carbon::parse($create_day->created_at)->diffForHumans($now);
    }

    public function is_liked()
    {
        $search_auth_like_comment = DB::table('comment_user')->where([
            ['comment_id',$this->id],
            ['user_id',auth()->user()->id]
        ])->get();
        if($search_auth_like_comment->count() > 0){
            return true;
        }
        return false;
    }
}  
