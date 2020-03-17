<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable=['user_id','smallpict','bigpict','descript'];

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }


}

