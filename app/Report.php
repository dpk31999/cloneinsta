<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['user_id','content_report','is_read'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
