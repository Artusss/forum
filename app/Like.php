<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    //have one author
    public function author(){
        $this->belongsTo('App\User', 'author_id');
    }
    //have one topic
    public function topic(){
        $this->belongsTo('App\Topic', 'topic_id');
    }
}
