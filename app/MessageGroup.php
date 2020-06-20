<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageGroup extends Model
{
    protected $fillable = ['admin_id','message','is_read'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
