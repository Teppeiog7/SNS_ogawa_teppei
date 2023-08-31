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
        //▼ログインユーザー情報の取得
        $user = Auth::user();
        //ddd($user);
        //▼ログインユーザーのフォローしているユーザーの取得
        //pluckメソッド:指定したカラムの値を取得
        $followingUsers = $user->followUsers()->pluck('followed_id');;
        //ddd($followingUsers);
        //▼「Postテーブルのユーザー」と「ユーザーがフォローしているid」が一致している値をすべて出力
        $posts = Post::with('user')->whereIn('user_id', $followingUsers)->get();
        //ddd($posts);
        //▼viewメソッド：画面遷移時に使用するメソッド
        //▼第一引数について：'follows' フォルダ内の 'followList.blade.php' ファイルを指定しています。(画面遷移)
        //▼第二引数について：キー名が変数名としてfollowList.blade内のforeachで利用される
        //▼第三引数について：キー名が変数名としてfollowList.blade内のforeachで利用される
        return view('follows.followList', ['users' => $followingUsers], ['posts' => $posts]);
    }

    //=====================================

    public function followerList(){
        //▼ログインユーザー情報の取得
        $user = Auth::user();
        //ddd($user);
        //▼ログインユーザーがフォローされているユーザーの取得
        //pluckメソッド:指定したカラムの値を取得
        $followersUsers = $user->followers()->pluck('following_id');;
        //ddd($followingUsers);
        //▼「Postテーブルのユーザー」と「ユーザーがフォローされているid」が一致している値をすべて出力
        $posts = Post::with('user')->whereIn('user_id', $followersUsers)->get();
        //ddd($posts);
        //▼viewメソッド：画面遷移時に使用するメソッド
        //▼第一引数について：'follows' フォルダ内の 'followerList.blade.php' ファイルを指定しています。(画面遷移)
        //▼第二引数について：キー名が変数名としてfollowList.blade内のforeachで利用される
        //▼第三引数について：キー名が変数名としてfollowList.blade内のforeachで利用される
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

        //▼backメソッド：上記処理後、前の画面に戻る
        return back();

     }

    //=====================================

    //unfollowメソッドの「User $User」とは、routeから送られてきたユーザーIDのすべての情報をUserモデル(すなわちUsersテーブル)から取得
    public function unfollow(User $user){
        ///ddd($user);
        //▼認証済みのログインユーザーのすべての情報を取得
        $follower = Auth::user();
        ///ddd($follower);
        //▼ログインユーザーが相手をフォローしているかどうか確認する
        //フォローしていれば「選択したユーザー情報」を返す
        $is_following = $follower->isFollowing($user->id);
        //ddd($is_following);
        if($is_following){
            //フォローしていればフォローを外す
            $follower->unfollow($user->id);

        }

        //▼backメソッド：上記処理後、前の画面に戻る
        return back();

    }

    //=====================================
    /*



/*
    public function show(User $user){

    }
*/
}
