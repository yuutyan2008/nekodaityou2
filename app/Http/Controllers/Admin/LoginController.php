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
    protected $redirectTo =  '/admin/home';//マルチ認証でadmin/indexに変更

    /**
     * Create a new controller instance.
     *controllerのコンストラクタでmiddlewareを呼び出している。
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest:admin')->except('logout');//routingに記載のため不要
    }
    
    public function showLoginForm()
    {
        return view('admin.login');  //ログイン認証
    }
 
    // 登録済みユーザーを認証するguardメソッド
    protected function guard()
    {
        return Auth::guard('admin');  //ログイン認証。admnの認証を呼び出している
    }
    
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();  //ログイン認証
        $request->session()->flush();//全データの削除
        $request->session()->regenerate();//sessionIDの再発行
 
        return redirect('/admin/login');  //ログイン認証
    }
}
