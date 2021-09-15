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
  

    Route::get('user/cats/create', 'user\CatController@add');//猫台帳登録フォームに入力
    Route::post('user/cats/create', 'user\CatController@create');//猫台帳新規作成申請ボタンでDB追加
    Route::get('user/cats/index', 'user\CatController@index');//猫台帳一覧画面の表示
    
   
    Route::get('user/activity/create', 'user\ActivityController@add');//猫活動フォームに入力
    Route::post('user/activity/create', 'user\ActivityController@create')->name('activity.create');//送信ボタンでDBに追加
    Route::get('user/activity/index', 'user\ActivityController@index')->name('activity.index');//猫活動一覧
    
    
 
    Route::get('user/cats/cathistoryindex', 'user\CatController@cathistoryindex');//自分の猫台帳表示
    Route::get('user/cats/cathistoryedit', 'user\CatController@cathistoryedit')->name('cats.cathistoryedit');//自分の猫台帳編集ボタンを押して編集画面へ移動
    Route::post('user/cats/cathistoryedit', 'user\CatController@cathistoryupdate')->name('cats.cathistoryupdate');//自分の猫台帳を更新
    
    Route::get('user/activity/historyindex', 'user\ActivityController@historyindex')->name('activity.historyindex');//自分の猫台帳一覧表示
    Route::post('user/activity/historindex', 'user\ActivityController@historydelete')->name('activity.historydelete');//自分の猫台帳を削除
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
    
    
    // Route::post('home', 'Admin\UserController@index')->name('admin.user.index');//home画面の会員情報参照ボタンから一覧表示へ
    Route::get('user/index', 'Admin\UserController@index');//会員一覧画面表示
    // Route::get('user/edit', 'Admin\UserController@edit');//会員情報一覧の編集ボタンを押す1とidを渡して編集画面へ
    // Route::post('user/edit', 'Admin\UserController@update');//会員情報編集画面の編集ボタンを押すとidを渡して確認画面へ
    
    
    Route::get('cats/create', 'Admin\CatController@add');//フォームに入力するとaddアクションへ
    Route::post('cats/create', 'Admin\CatController@create');//送信ボタンでDBに追加
    Route::get('cats/index', 'Admin\CatController@index')->name('get.cats.index');//猫台帳一覧画面の表示
    
    Route::get('cats/edit', 'Admin\CatController@edit')->name('admin.cats.edit');//編集したい猫台帳の表示
    Route::post('cats/edit', 'Admin\CatController@update')->name('admin.cats.update');//編集画面の更新ボタンを押すとidを渡して更新
});
