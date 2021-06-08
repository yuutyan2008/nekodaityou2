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

Auth::routes();

/*
|--------------------------------------------------------------------------
| 1) User 認証不要
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/home');
    Route::get('cats/index', 'CatController@index');//検索画面と結果の表示
});




 
/*
|--------------------------------------------------------------------------
| 2) User ログイン後
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'user', 'middleware' => 'auth:user'], function () {
    Route::get('cats/index', 'user\CatController@index');//検索画面と結果の表示
    Route::get('activity/create', 'user\ActivityController@add');//猫活動フォームに入力するとaddアクションへ
    Route::post('activity/create', 'user\ActivityController@create');//送信ボタンでDBに追加
    Route::get('activity', 'user\ActivityController@index');//猫活動一覧
});

 
/*
|--------------------------------------------------------------------------
| 3) Admin 認証不要
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return redirect('/admin/home');
    });
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login');
});
 
/*
|--------------------------------------------------------------------------
| 4) Admin ログイン後
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::get('home', 'Admin\HomeController@index')->name('admin.home');
    Route::get('cats/index', 'Admin\CatController@index');//検索画面と結果の表示
    Route::get('cats/create', 'Admin\CatController@add');//フォームに入力するとaddアクションへ
    Route::post('cats/create', 'Admin\CatController@create');//送信ボタンでDBに追加
});
