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
Route::get('activity/index', 'ActivityController@index');//ログイン前の活動一覧表示
Route::get('cats/index', 'CatController@index');//検索画面と結果の表示





 
/*
|--------------------------------------------------------------------------
| 2) User ログイン後
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth:user'], function () {
    Route::get('/home', 'user\HomeController@index')->name('home');//マルチ認証
    Route::get('user/cats/index', 'user\CatController@index');//検索画面と結果の表示
    
    Route::get('user/sinsei_cats/create', 'user\Sinsei_catController@add');//猫台帳登録フォームに入力
    Route::post('user/sinsei_cats/create', 'user\Sinsei_catController@create');//猫台帳新規作成申請ボタンでDB追加
    
    Route::get('user/activity/create', 'user\ActivityController@add');//猫活動フォームに入力
    Route::post('user/activity/create', 'user\ActivityController@create');//送信ボタンでDBに追加
    Route::get('user/activity/index', 'user\ActivityController@index');//猫活動一覧
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
    
    
    Route::post('home', 'Admin\UserController@index')->name('admin.user.index');//home画面の会員情報参照ボタンから一覧表示へ
    Route::get('user/index', 'Admin\UserController@index');//会員一覧画面表示
    Route::get('user/edit', 'Admin\UserController@edit');//会員情報一覧の編集ボタンを押す1とidを渡して編集画面へ
    Route::post('user/edit', 'Admin\UserController@update');//会員情報編集画面の編集ボタンを押すとidを渡して確認画面へ

    Route::post('home', 'Admin\Sinsei_catController@index')->name('admin.sinsei_cats.index');//home画面のリンクボタンからuserの猫台帳登録申請一覧へ移動
    Route::get('sinsei_cats/index', 'Admin\Sinsei_catController@index');// 猫台帳の新規作成申請一覧表示
    Route::get('sinsei_cats/edit', 'Admin\Sinsei_catController@edit');//編集ボタンで編集画面へ移動
    Route::post('sinsei_cats/edit', 'Admin\CatController@create');//編集画面の更新ボタンを押すとidを渡して更新
    
    
    Route::post('sinsei_cats/create', 'Admin\CatController@create');//登録ボタンでcatsテーブルのDBに追加
    
    
    Route::post('home', 'Admin\CatController@index')->name('admin.cats.index');//home画面の猫台帳一覧ボタンから猫台帳一覧表示へ
    
    Route::get('cats/index', 'Admin\CatController@index');//猫台帳一覧画面の表示
    Route::post('cats/index', 'Admin\CatController@edit');//猫台帳編集ボタンを押すとidを渡して編集画面へ
    
    Route::get('cats/edit', 'Admin\CatController@edit');//編集したい猫台帳の表示
    Route::post('cats/edit', 'Admin\CatController@update');//編集画面の更新ボタンを押すとidを渡して更新
    
    Route::get('cats/create', 'Admin\CatController@add');//フォームに入力するとaddアクションへ
    Route::post('cats/create', 'Admin\CatController@create');//送信ボタンでDBに追加
});
