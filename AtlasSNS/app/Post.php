<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'post','user_id'
    ];

    public function user()
   {
        //＄thisはThe Bookの事
        //The post belongs to many users.
        return $this->belongsTo('App\User');
    }




}
