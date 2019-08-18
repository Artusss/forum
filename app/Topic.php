<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Topic extends Model
{
    use Searchable;

    protected $table = 'topics';

    public function toSearchableArray()
    {
        $array = $this->toArray();
        return array('id' => $array['id'], 'title' => $array['title']);
    }

    //have one author
    public function author(){
        return $this->belongsTo('App\User', 'author_id');
    }
    //have one category
    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }
    //have more decisions
    public function decisions(){
        return $this->hasMany('App\Decision', 'topic_id');
    }
    //have more likes
    public function likes(){
        return $this->hasMany('App\Like', 'topic_id');
    }
}
