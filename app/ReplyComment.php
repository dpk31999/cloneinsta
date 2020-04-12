<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyComment extends Model
{   
    protected $fillable = ['comment_id','user_id','content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
