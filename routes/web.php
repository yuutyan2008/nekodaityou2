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

//Auth/phpファイルのrouteメソッド
Auth::routes();//make:Authにより実行され、認証に関わるrouting設定が作成される

/*
|--------------------------------------------------------------------------
| 1) User 認証不要
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/home');//マルチ認証
});
Route::get('cats/index', 'CatController@index');//検索画面と結果の表示





 
/*
|--------------------------------------------------------------------------
| 2) User ログイン後
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth:user'], function () {
    Route::get('/home', 'HomeController@index')->name('home');//マルチ認証
    Route::get('cats/index', 'CatController@index');//検索画面と結果の表示
    Route::get('activity/create', 'ActivityController@add');//猫活動フォームに入力するとaddアクションへ
    Route::post('activity/create', 'ActivityController@create');//送信ボタンでDBに追加
    Route::get('activity/index', 'ActivityController@index');//猫活動一覧
});

 
/*
|--------------------------------------------------------------------------
| 3) Admin 認証不要
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return redirect('/admin/home');
    });//マルチ認証
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');//マルチ認証
    Route::post('login', 'Admin\LoginController@login');//マルチ認証
});
 
/*
|--------------------------------------------------------------------------
| 4) Admin ログイン後
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');//マルチ認証
    Route::get('home', 'Admin\HomeController@index')->name('admin.home');//マルチ認証
    Route::get('cats/index', 'Admin\CatController@index');//検索画面と結果の表示
    Route::get('cats/create', 'Admin\CatController@add');//フォームに入力するとaddアクションへ
    Route::post('cats/create', 'Admin\CatController@create');//送信ボタンでDBに追加
});
