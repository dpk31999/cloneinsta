<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Post extends Model
{   
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function liked()
    {
        return $this->belongsToMany(User::class);
    }

    public function commented()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC');
    }

    public function getTime()
    {  
        $create_day = DB::table('posts')->select('created_at')->where('id', $this->id)->first();
        $dt = Carbon::now();
        $now = Carbon::createFromFormat('Y-m-d H:i:s', $dt);
        return Carbon::parse($create_day->created_at)->diffForHumans($now);
    }
}
