<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'username' , 'mail', 'password' , 'bio' , 'images' , 'following_id' , 'followed_id'
    ];

    //=====================================

    public function posts()
    {
    //$thisはUserの事
    //The User has many posts.
    //UserモデルはPost情報がたくさんもっている。
    return $this->hasMany('App\Post');
    }

    //=====================================

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //=====================================

    //▼追加
    //フォローしている側(ユーザーがフォローしている)
    //第一引数：相手のモデル
    //第二引数：中間テーブルを記載
    //第三引数：自分の外部キー
    //第四引数：相手の外部キー
    public function followUsers()
    {
        //Userモデル(すなわちUsersテーブル)はたくさんの引数情報を属している
        return $this->belongsToMany('App\User','follows','following_id','followed_id');
    }

    //=====================================

    //▼追加
    //フォローされている側(ユーザーが外部からフォローされている)
    //第一引数：相手のモデル
    //第二引数：中間テーブルを記載
    //第三引数：自分の外部キー
    //第四引数：相手の外部キー
    public function followers()
    {
        //Userモデル(すなわちUsersテーブル)はたくさんの引数情報を属している
        return $this->belongsToMany('App\User','follows','followed_id','following_id',);
    }

    //=====================================

    //▼フォロー
    public function follow($user_id)
    {
        //$thisは「Auth::user（ ）」のこと。すなわちログインユーザーのこと。
        //followUsers()はフォローしている側から見たメソッドのこと。(49行目)
        //attach($user_id)は、関連付けられたテーブル(followsテーブル)に新しい行を追加すること。
        return $this->followUsers()->attach($user_id);
    }

    //=====================================

    //▼フォロー解除
    public function unfollow($user_id)
    {
        //$thisは「Auth::user（ ）」のこと。すなわちログインユーザーのこと。
        //followUsers()はフォローしている側から見たメソッドのこと。(49行目)
        //detach($user_id)は、関連付けられたテーブル(followsテーブル)のレコードを削除すること。
        return $this->followUsers()->detach($user_id);
    }

    //=====================================

    //▼フォローしているかの判定
    public function isFollowing(Int $user_id)
    {
        //$thisは「Auth::user（ ）」のこと。すなわちログインユーザーのこと。
        //followUsers()はフォローしている側から見たメソッドのこと。(49行目)
        //where()は、どの値をどこのカラムに代入するか指定をする。今回は$user_idの値をfollowed_idカラムに代入する
        //first()は最初のレコードを取得する
        return $this->followUsers()->where('followed_id', $user_id)->first();
    }

    //=====================================

    //▼フォローされているかの判定
    public function isFollowed(Int $user_id)
    {
        //$thisは「Auth::user（ ）」のこと。すなわちログインユーザーのこと。
        //followers()はフォローされている側から見たメソッドのこと。(63行目)
        //where()は、どの値をどこのカラムに代入するか指定をする。今回は$user_idの値をfollowing_idカラムに代入する
        //first()は最初のレコードを取得する
        return $this->followers()->where('following_id', $user_id)->first();
    }

}
