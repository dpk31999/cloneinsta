<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','provider', 'provider_id','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function like()
    {
        return $this->belongsToMany(Post::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function likeCmt()
    {
        return $this->belongsToMany(Comment::class);
    }

    public function replyCmt()
    {
        return $this->hasMany(ReplyComment::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class,'from');
    }

    public function noti()
    {
        return $this->hasMany(Noti::class,'from');
    }

    public function reported()
    {
        return $this->hasMany(Report::class);
    }

    public function reportPost()
    {
        return $this->hasMany(ReportPost::class);
    }
}
