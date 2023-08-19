<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use App\User;

use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    //=====================================

    public function index(){
        //▼Postモデル(postsテーブル)から全ての情報を取得し、変数$listへ代入
        $users = Post::get();
        //dd($users);
        //▼第一引数について：'posts' フォルダ内の 'index.blade.php' ファイルを指定しています。
        //▼第二引数について：
        return view('posts.index',['users'=>$users]);
    }

    //=====================================

    //▼リクエストデータを取得。
    public function create(Request $request)
    {
        //▼Authモデルを用いて認証されたユーザー情報のidのみ取得し、変数$idへ代入する。
        $id = Auth::user()->id;
        //▼コメントした文章を抽出する。
        $post = $request->input('newPost');
        //ddd($post);
        //▼postカラムとuser_idカラムに上記情報をPostモデル(Postsテーブル)に代入する。
        Post::create([
            'post' => $post,
            'user_id' => $id
        ]);
        //▼topへ遷移する。
        return redirect('/top');
    }

    //=====================================

    public function show(){
        //$users = User::all();
        //dd($users);
        //return view('posts.index',['lists'=>$users]);
        $posts = Post::get();
        //ddd($posts);
        $loggedInUser = Auth::user();
        //ddd($loggedInUser);
        return view('posts.index', compact('posts','loggedInUser'));
        //$users = User::with('posts')->get();
        //return view('posts.index',['users'=>$users]);
    }

    //=====================================

    public function updateForm($id)
    {
        $post = Post::where('id', $id)->first();
        //dd($post);
        return view('posts.updateForm', ['post'=>$post]);
    }

    //=====================================

    public function update(Request $request)
    {
        // 1つ目の処理
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        // 2つ目の処理
        Post::where('id', $id)->update(['post' => $up_post]);
        // 3つ目の処理
        return redirect('/top');
    }

    //=====================================

    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('/top');
    }

}
