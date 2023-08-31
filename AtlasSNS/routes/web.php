<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 Route::get('/', function () {
     return view('welcome');
 });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

//Route::get('/top', [UserController::class, 'showProfile'])->name('top');/////

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//=====================================

//ログイン中のページ
//ミドルウェア ログインしてない場合、エラー画面にする。
Route::group(['middleware' => 'auth'], function() {

//PostsControllerにあるindexメソッドを用いて、/topへ遷移する。
Route::get('/top','PostsController@index');

//▼投稿内容
//PostsControllerにあるshowメソッドを用いて、/topへ遷移する。
Route::get('/top','PostsController@show');

//▼ユーザーのプロフィール情報
//UsersControllerにあるprofileメソッドへidが送られる。profileメソッド処理後、/profileへ遷移する。
Route::get('/users/{id}/','UsersController@profile');

//▼ユーザーのプロフィール編集画面
//UsersControllerにあるprofileEditメソッドで処理されたあと、/profileEditへ遷移する。
Route::get('/profileEdit','UsersController@profileEdit');

//▼ユーザーのプロフィール編集画面後の処理内容
//UsersControllerにあるprofileUpdateメソッドで処理されたあと、/profileUpdateへ遷移する。
Route::post('/profileUpdate','UsersController@profileUpdate');

//▼検索画面のログインユーザー取得
//UsersControllerにあるusersメソッドで処理されたあと、/searchへ遷移する。
Route::get('/search','UsersController@users');

//▼検索画面の検索ワード取得
//UsersControllerにあるsearchメソッドで処理されたあと、/searchへ遷移する。
Route::post('/search','UsersController@search');

//▼フォローリスト表示
//FollowsControllerにあるfollowListメソッドで処理されたあと、followListへ遷移する。
Route::get('/follow-list','FollowsController@followList');

//▼フォロワーリスト表示
//FollowsControllerにあるfollowerListメソッドで処理されたあと、followListへ遷移する。
Route::get('/follower-list','FollowsController@followerList');

//▼フォロー機能
//FollowsControllerにあるfollowメソッドで処理されたあと、followListへ遷移する。
Route::get('/search/{user}/follow','FollowsController@follow');

//▼フォロー削除
//FollowsControllerにあるunfollowメソッドで処理されたあと、followListへ遷移する。
Route::get('/search/{user}/unfollow','FollowsController@unfollow');

//▼新規投稿
//PostsControllerにあるcreateメソッドで処理されたあと、/topへ遷移する。(/top遷移はコントローラー上にあるcreateメソッド内で処理される。)
Route::post('post/create', 'PostsController@create');

//▼投稿の編集
//PostsControllerにあるupdateメソッドで処理されたあと、/topへ遷移する。(/top遷移はコントローラー上にあるupdateメソッド内で処理される。)
Route::post('post/update', 'PostsController@update');

//▼投稿の削除
//PostsControllerにあるdeleteメソッドで処理されたあと、/topへ遷移する。(/top遷移はコントローラー上にあるdeleteメソッド内で処理される。)
Route::get('post/{id}/delete', 'PostsController@delete');

//▼logout機能
Route::get('/logout', 'Auth\LoginController@logout');

//=====================================

});
