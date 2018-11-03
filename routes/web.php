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

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 仮登録用
Route::post('register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');

// 本登録用
Route::get('register/verify/{token}', 'Auth\RegisterController@showForm');
Route::post('register/main_register', 'Auth\RegisterController@mainRegister')->name('register.main.registered');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//SNS認証
//各サービスに向かうときと、帰ってきたとき用
Route::get('login/{provider}', 'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');


//ログイン
Route::get('login','Auth\LoginController@showLoginform')->name('login');
Route::post('login','Auth\LoginController@login')->name('login.post');
Route::get('logout','Auth\LoginController@logout')->name('logout.get');

//ログインしてないとできないこと
Route::group(['middleware' => 'auth'], function() {
    Route::resource('users','UsersController');
    Route::resource('questions','QuestionsController'); 
});

// アバター画像をアップ
Route::get('profile','UsersController@update_avatar');



//検索apiでタグの予想
Route::group(['preix' => 'api', 'middleware' => 'auth'], function() {
  Route::get('find', function(Illuminate\Http\Request $request) {
    $keyword = $request->input('keyword');
    Log::info($keyword);
    $tags = DB::table('tags')->where('name','like','%'.$keyword.'%')->select('tags.id','tags.name','tags.display')->get();
    return json_encode($tags);
  })->name('api.tags');
});


