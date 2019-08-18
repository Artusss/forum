<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Decision extends Model
{
    protected $table = 'decisions';
    //have one author
    public function author(){
        return $this->belongsTo('App\User', 'author_id');
    }
    //have one topic
    public function topic(){
        return $this->belongsTo('App\Topic', 'topic_id');
    }
}
