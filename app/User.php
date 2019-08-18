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
        'name', 'email', 'password',
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
    //have more topics
    public function topics(){
        return $this->hasMany('App\Topic', 'author_id');
    }
    //have more decisions
    public function decisions(){
        return $this->hasMany('App\Decision', 'author_id');
    }
    //have more likes
    public function likes(){
        return $this->hasMany('App\Like', 'author_id');
    }
    public function is_admin(){
        return ($this->role === 'admin') ? true : false;
    }
    public function is_author(){
        return ($this->role === 'author') ? true : false;
    }
    public function is_guest(){
        return ($this->role === 'guest') ? true : false;
    }
}
