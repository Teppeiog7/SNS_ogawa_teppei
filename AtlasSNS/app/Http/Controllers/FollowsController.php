<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Post;

use App\follow;

use Auth;

class FollowsController extends Controller
{
    //=====================================

    public function followList(){
        $user = Auth::user();//ログインユーザー情報の取得
        //ddd($user);
        $followingUsers = $user->followUsers()->pluck('followed_id');; // ログインユーザーのフォローしているユーザーの取得
        //ddd($followingUsers);
        $posts = Post::with('user')->whereIn('user_id', $followingUsers)->get();
        //ddd($posts);
        return view('follows.followList', ['users' => $followingUsers], ['posts' => $posts]);
    }

    //=====================================

    public function followerList(){
        $user = Auth::user();//ログインユーザー情報の取得
        //ddd($user);
        $followersUsers = $user->followers()->pluck('following_id');; // ログインユーザーのフォローしているユーザーの取得
        //ddd($followingUsers);
        $posts = Post::with('user')->whereIn('user_id', $followersUsers)->get();
        //ddd($posts);
        return view('follows.followerList', ['users' => $followersUsers], ['posts' => $posts]);
    }

    //=====================================

    //▼下記追加
    //followメソッドの「User $User」とは、routeから送られてきたユーザーIDのすべての情報をUserモデル(すなわちUsersテーブル)から取得
    public function follow(User $user){
        //ddd($user);
        //▼認証済みのログインユーザーのすべての情報を取得
        $follower = Auth::user();
        //ddd($follower);
        //▼ログインユーザーが相手をフォローしているかどうか確認する
        //フォローしていなければ「null」を返す
        $is_following = $follower->isFollowing($user->id);
        //ddd($is_following);
        if(!$is_following){
             //フォローしていなければフォローする
             $follower->follow($user->id);
        }

        return back();

     }

    //=====================================

    //unfollowメソッドの「User $User」とは、routeから送られてきたユーザーIDのすべての情報をUserモデル(すなわちUsersテーブル)から取得
    public function unfollow(User $user){
        ///ddd($user);
        //▼認証済みのログインユーザーのすべての情報を取得
        $follower = Auth::user();
        ///ddd($follower);
        //ログインユーザーが相手をフォローしているかどうか確認する
        //フォローしていれば「選択したユーザー情報」を返す
        $is_following = $follower->isFollowing($user->id);
        //ddd($is_following);
        if($is_following){
            //フォローしていればフォローを外す
            $follower->unfollow($user->id);

        }

        return back();

    }

    //=====================================
    /*



/*
    public function show(User $user){

    }
*/
}
