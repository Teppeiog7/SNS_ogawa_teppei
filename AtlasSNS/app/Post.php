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
        //＄thisはThe postの事
        //The post belongs to many users.
        //Postモデルはusers情報をもっている。
        return $this->belongsTo('App\User');
    }




}
