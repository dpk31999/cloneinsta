<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportPost extends Model
{   
    protected $table = 'reportpost';

    protected $fillable = ['user_id','post_id','type','content_report','is_read'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
