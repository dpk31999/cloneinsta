<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noti extends Model
{
    protected $fillable = ['from','to','action','type','is_read'];

    protected $table = 'notifications';

    public function user()
    {
        return $this->belongsTo(User::class,'from');
    }

    public function newNoti($action,$type,$user_id,$id_target)
    {
        $noti = new Noti();
        $noti->from = auth()->user()->id;
        $noti->to = $user_id;
        $noti->action = $action;
        $noti->type = $type;
        $noti->id_target = $id_target;
        $noti->is_read = 0;
        if(auth()->user()->id != $user_id){
            $noti->save();
        }
    }
}
