<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
//use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request){
        if($request->isMethod('post')){

            $data=$request->only('mail','password');
            // ログインが成功したら、トップページへ
            //↓ログイン条件は公開時には消すこと
            if(Auth::attempt($data)){
                // ログインしている場合、ログインユーザーの情報を取得
                //$user = Auth::user();
                // プロフィール画像のファイルパスを生成
                //$profileImagePath = '/images/' . $user->images; // 仮にimageフィールドがプロフィール画像のファイル名を格納するものとする
                //ddd($profileImagePath);
                //Session::put('profileImagePath', $profileImagePath);
                //return redirect('/top',['profileImagePath' => $profileImagePath]);
                return redirect('/top');
            }
        }
        return view("auth.login");
    }
    //ログアウトメソッド
    public function Logout(){
        Auth::logout();//ログアウトする。Authは認証関連の機能を提供するためのクラスの事。
        return redirect('/login');//ログイン画面にリダイレクト。
    }
}
