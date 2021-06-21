<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;//sessionの使用
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller 認証処理を行う
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
    protected $redirectTo = '/admin/home';//マルチ認証でadmin/indexに変更

    /**
     * Create a new controller instance.
     *controllerのコンストラクタでmiddlewareを呼び出している。
     * @return void
     */
    public function __construct()
    {
        // ログインチェック。認証していないゲストadminのmiddlewareを適用しログイン画面に飛ばす
        // $this->middleware('guest:admin')->except('logout');//middlewareをroutingに記載のため不要
    }
    
    public function showLoginForm()
    {
        return view('admin.login');  //ログイン認証
    }
 
    // 登録済みユーザーの認証方法を指定
    protected function guard()
    {
        return Auth::guard('admin');  //ログイン認証。admnの認証を呼び出している
    }
    
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();  //ログアウト処理
        $request->session()->flush();//全データの削除
        $request->session()->regenerate();//sessionIDの再発行
 
        return redirect('/admin/login');  //ログアウトの際のリダイレクト先
    }
}
