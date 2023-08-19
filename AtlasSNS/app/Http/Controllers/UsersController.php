<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

/*use App\Models\User;*/
use App\User;

use Auth;

use App\Post;

class UsersController extends Controller
{

    //=====================================

    public function profile($id){
        //dd($id);
        $profileUser = User::where('id', $id)->get();
        //ddd($profileUser);
        $posts = Post::with('user')->where('user_id', $id)->get();
        //ddd($posts);
        return view('users.profile',['profileUser'=>$profileUser],['posts'=>$posts]);
    }

    //=====================================

    public function users(){
        //$list = User::get();
        $id=Auth::id();
        //dd($id);
        $user=User::where('id','!=',$id)->get();
        //dd($user);
        return view('users.search',['users'=>$user]);
    }

    //=====================================

    public function search(Request $request)
    {

        //$requestにあるinputメソッドで値をもらう

        $keyword = $request->input('keyword');
        //dd($keyword);

        //ログインしているユーザーのIDを$id変数に代入する

        $id=Auth::id();
        //dd($id);

        //もし$keyword変数に値があったら、Whereメソッドでusersテーブルにある'username'カラムのような値($keyword)を抽出

        //かつ

        //User DBの'id'カラムの値とユーザーidの値が一致していない「ユーザー名」を抽出する

        //それ以外だったら、User DBの'id'カラムの値とユーザーidの値が一致していない「ユーザー名」を抽出する

        if(isset($keyword)){
             $user = User::where('username','like', '%'.$keyword.'%')->where('id','!=',$id)->get();
             //dd($user);
        }else{
             $user=User::where('id','!=',$id)->get();
             //dd($user);
        }
        //▼viewメソッド

        //第一引数:usersフォルダにあるsearch.bladeに遷移する

        //第二引数:キー名が変数名としてsearch.blade内のforeachで利用される

        return view('users.search' , ['users' => $user]);
    }

    //=====================================

    public function show(Follower $follower)
    {
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);

        return view('.show', [
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

    //=====================================

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|email|min:5|max:40',
            'password' => 'required|string|min:8|max:20|alpha_num|confirmed',
        ]);
    }

    //=====================================

    public function profileEdit(){
        $user = Auth::user();
        //ddd($user);
        return view('users.profileEdit', ['user' => $user]);
    }

    //=====================================

    public function profileUpdate(Request $request){
    //dd($request);
    $id=Auth::id();
    //dd($id);
    $data = $request->input();
    //dd($data);
    $validator = $this->validator($data);
    //dd($validator);
    if($validator->fails()){//もしvalidatorメソッドが失敗したら
            return redirect('/profileEdit')//registerへリダイレクト
            ->withErrors($validator)
            ->withInput();
            }

    $username = $request->input('username');
    $mail = $request->input('mail');
    $password = $request->input('password');
    $bio = $request->input('bio');
    $images = $request->file('images');
    //ddd($images);
    if($images === null){
        $imagesName = 'icon1.png';
        //ddd($images);
    }else{
        $imagesName = $images->getClientOriginalName();
    }

    //ddd($filename);
    //ddd($username);
    //ddd($mail);
    //ddd($password);
    //ddd($bio);
    //ddd($images);

    User::where('id', $id)->update([
            'username' => $username,
            'mail' => $mail,
            'password' => bcrypt($password),
            'bio' => $bio,
            'images' => $imagesName
        ]);

    return redirect('/top');

    }


    //=====================================

    public function index(){

    }

}


/*
public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            //ddd($data);
            $validator = $this->validator($data);//validatorメソッドを呼び出し
            //ddd($validator);

            if($validator->fails()){//もしvalidatorメソッドが失敗したら
            return redirect('/register')//registerへリダイレクト
            ->withErrors($validator)
            ->withInput();
            }
            //登録完了ページにユーザー名を表示させる処理
            $username = $this->create($data);
            $user = $request->get('username');
            return redirect('added')->with('username', $user);
        }
        return view('auth.register');
    }
*/
