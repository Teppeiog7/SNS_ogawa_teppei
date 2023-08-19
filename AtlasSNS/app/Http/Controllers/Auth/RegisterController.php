<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //=====================================

    public function __construct()
    {
        $this->middleware('guest');
    }

    //=====================================

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    //=====================================

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|email|min:5|max:40|unique:users',
            'password' => 'required|string|min:8|max:20|alpha_num|confirmed',
        ]);
    }

    //=====================================

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }

    //=====================================

    // public function registerForm(){
    //     return view("auth.register");
    // }

    //=====================================

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

    //=====================================

    //追加情報
    public function added(){
        return view('auth.added');
    }

}
