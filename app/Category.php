<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use Searchable;

    protected $table = 'categories';

    public function toSearchableArray()
    {
        $array = $this->toArray();
        return array('id' => $array['id'], 'title' => $array['title']);
    }

    //have more topics
    public function topics(){
        return $this->hasMany('App\Topic', 'category_id');
    }
}
