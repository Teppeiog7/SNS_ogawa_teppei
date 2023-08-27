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
        //▼第二引数について：キー名が変数名としてsearch.blade内のforeachで利用される
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
        //▼Postモデルを使用して全ユーザー情報を新しい日付順で抽出する。
        $posts = Post::latest()->get();
        //ddd($posts);
        //▼Authモデルを使用してログインしているユーザー情報を抽出する。
        $loggedInUser = Auth::user();
        //ddd($loggedInUser);
        //▼viewメソッド：画面遷移時に使用するメソッド
        //▼第一引数について：'posts' フォルダ内の 'index.blade.php' ファイルを指定しています。(画面遷移)
        //▼第二引数について：compactメソッドを使用すると変数名なしでキー名のみで指定できる。よってキー名が変数名としてsearch.blade内のforeachで利用される
        return view('posts.index', compact('posts','loggedInUser'));
    }

    //=====================================
    /*
    public function updateForm($id)
    {
        //ddd($id);
        $post = Post::where('id', $id)->first();
        //ddd($post);
        return view('posts.updateForm', ['post'=>$post]);
    }
    */
    //=====================================

    public function update(Request $request)
    {
        //ddd($request);
        // 1つ目の処理
        //▼$requestにある情報をinputメソッドでユーザーが投稿したIdを受け取る。
        $id = $request->input('id');
        //dd($id);
        //▼$requestにある情報をinputメソッドでユーザーが投稿した文章を受け取る。
        $up_post = $request->input('upPost');
        //dd($up_post);
        // 2つ目の処理
        //▼Postモデルを使用して全ユーザーのidカラムにある'id'と$idが同じユーザーを抽出して、抽出されたユーザーのpostカラムに更新したpostデータを上書きする。
        Post::where('id', $id)->update(['post' => $up_post]);
        // 3つ目の処理
        //▼上記処理後、topへ遷移する。
        return redirect('/top');
    }

    //=====================================

    public function delete($id)
    {
        //dd($id);
        //▼Postモデルを使用して全ユーザーのidカラムにある'id'と$idが同じユーザーを抽出して、その後削除する
        Post::where('id', $id)->delete();
        //▼上記処理後、topへ遷移する。
        return redirect('/top');
    }

}
