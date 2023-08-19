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

//ログイン中のページ
//ミドルウェア ログインしてない場合、エラー画面にする。
Route::group(['middleware' => 'auth'], function() {

//PostsControllerにあるindexメソッドを用いて、/topへ遷移する。
Route::get('/top','PostsController@index');

//PostsControllerにあるshowメソッドを用いて、/topへ遷移する。
Route::get('/top','PostsController@show');

//UsersControllerにあるprofileメソッドへidが送られる。profileメソッド処理後、/profileへ遷移する。
Route::get('/users/{id}/','UsersController@profile');

//UsersControllerにあるprofileEditメソッドで処理されたあと、/profileEditへ遷移する。
Route::get('/profileEdit','UsersController@profileEdit');

//プロフィール編集
Route::post('/profileUpdate','UsersController@profileUpdate');


/*Route::get('/search','UsersController@index');*/
Route::get('/search','UsersController@users');

Route::post('/search','UsersController@search');

//下記7/8追加
/*Route::get('/users/{id}', 'UsersController@index');*/

/*Route::get('/follow-list','PostsController@index');*/
Route::get('/follow-list','FollowsController@followList');

/*Route::get('/follow-list','FollowsController@followerShow');*/

//▼フォロー機能
Route::get('/search/{user}/follow','FollowsController@follow');
//▼フォロー削除
Route::get('/search/{user}/unfollow','FollowsController@unfollow');

/*Route::get('/follower-list','PostsController@index');*/
Route::get('/follower-list','FollowsController@followerList');

Route::post('post/create', 'PostsController@create');

//▼投稿の編集
Route::get('post/{id}/update-form', 'PostsController@updateForm');

Route::post('/post/update', 'PostsController@update');

Route::get('post/{id}/delete', 'PostsController@delete');







/*
Route::get('/top','FollowController@show');//フォロー、フォロアー数の表示
*/

//↓logout機能
Route::get('/logout', 'Auth\LoginController@logout');

});
