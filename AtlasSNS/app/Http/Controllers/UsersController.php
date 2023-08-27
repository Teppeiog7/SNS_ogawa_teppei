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
        $profileUser = User::where('id', $id)->first();
        //ddd($profileUser);
        $posts = Post::with('user')->where('user_id', $id)->get();
        //ddd($posts);
        return view('users.profile',['profileUser'=>$profileUser],['posts'=>$posts]);
    }

    //=====================================

    public function users(){

        //▼ログインユーザーのidを抽出する。
        $id=Auth::id();
        //dd($id);

        //▼User DBの'id'カラムの値とログインユーザーidの値が一致していない「ユーザー名」をすべて抽出する。
        $user=User::where('id','!=',$id)->get();
        //dd($user);

        //▼viewメソッド
        //第一引数:usersフォルダにあるsearch.bladeに遷移する。
        //第二引数:キー名が変数名としてsearch.blade内のforeachで利用される。
        return view('users.search',['users'=>$user]);
    }

    //=====================================

    public function search(Request $request)
    {
        //ddd($request);
        //▼$requestにあるinputメソッドで値をもらう
        $keyword = $request->input('keyword');

        //ddd($keyword);

        //▼ログインしているユーザーのIDを$id変数に代入する
        $id=Auth::id();
        //dd($id);

        //▼下記if文の内容
        //もし$keyword変数に値があったら、Whereメソッドでusersテーブルにある'username'カラムのような値($keyword)を抽出
        //かつ
        //User DBの'id'カラムの値とユーザーidの値が一致していない「ユーザー名」を抽出する。
        //それ以外だったら、User DBの'id'カラムの値とログインユーザーidの値が一致していない「ユーザー名」をすべて抽出する。
        if(isset($keyword)){
             $user = User::where('username','like', '%'.$keyword.'%')->where('id','!=',$id)->get();
             //ddd($user);
        }else{
             $user=User::where('id','!=',$id)->get();
             //dd($user);
        }
        //▼viewメソッド
        //第一引数:usersフォルダにあるsearch.bladeに遷移する。
        //第二引数:キー名が変数名としてsearch.blade内のforeachで利用される。
        return view('users.search' , ['users' => $user, 'keyword' => $keyword]);
    }

    //=====================================

    //???
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
        //$dataには編集した値が配列として格納されている。
        //ddd($data);

        //Validatorモデルを使用してmakeメソッドより、$dataの情報の内容が第二引数の内容と正しいかどうかを検証する。
        //▼makeメソッド
        //第１引数：チェックする値をまとめた配列
        //第２引数：検証ルール(今回はユーザー名、メール、パスワード)
        return Validator::make($data, [
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|email|min:5|max:40',
            'password' => 'required|string|min:8|max:20|alpha_num|confirmed',
        ]);
    }

    //=====================================

    public function profileEdit()
    {
        //ログインしているユーザーのIDを$id変数に代入する
        $user = Auth::user();
        //ddd($user);
        //▼viewメソッド
        //第一引数:usersフォルダにあるprofileEditに遷移する
        //第二引数:キー名が変数名としてprofileEdit.blade内のforeachで利用される
        return view('users.profileEdit', ['user' => $user]);
    }

    //=====================================

    public function profileUpdate(Request $request)
    {
    //▼formから入力情報を受け取る。
    //ddd($request);
    //▼ログインしているユーザーのIDを$id変数に代入する
    $id=Auth::id();
    //dd($id);
    //▼profileEdit.bladeから受け取ったidを受け取り、inputメソッドで入力した情報をもらう。そのあと$dataに代入する
    $data = $request->input();
    //dd($data);
    //▼$thisはvalidatorメソッドの事。
    //▼validator()を使用し、$dataの情報をバリデートする。(validatorメソッドは109行目に記載済み)
    $validator = $this->validator($data);
    //ddd($validator);
    //▼もしvalidatorメソッドが失敗したら
    if($validator->fails()){
            //▼registerへリダイレクト
            return redirect('/profileEdit')
            //▼withErrorsでValidatorインスタンスを渡している。Validatorで発生したエラーメッセージをリダイレクト先まで引き継ぐことができる。
            ->withErrors($validator)
            //▼withInputは送信されてきたフォームの値をそのまま引き継ぐ。
            ->withInput();
            }

    //▼検証にクリアできたら、下記$request情報をinputメソッドを用いて情報を受け取る。
    $username = $request->input('username');
    $mail = $request->input('mail');
    $password = $request->input('password');
    $bio = $request->input('bio');
    $images = $request->file('images');
    //ddd($images);

    //▼もしimagesに値がなかったら、'icon1.png'を出力
    if($images === null){
        $imagesName = 'icon1.png';
        //ddd($images);
    //▼それ以外だったら
    }else{
        //▼ファイル名を指定
        $dir = 'images';
        //▼ファイル名のみ受け取る
        $imagesName = $images->getClientOriginalName();
        //▼storeAsメソッドを使用してファイル名を指定して保存するimagesフォルダに保存する
        $request->file('images')->storeAs('public/' . $dir, $imagesName);
    }

    //ddd($filename);
    //ddd($username);
    //ddd($mail);
    //ddd($password);
    //ddd($bio);
    //ddd($images);

    //▼User DBのidカラムと$idが一致したユーザーの情報を上書きする。
    User::where('id', $id)->update([
            'username' => $username,
            'mail' => $mail,
            'password' => bcrypt($password),
            'bio' => $bio,
            'images' => $imagesName
        ]);

    //▼トップへリダイレクト
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
