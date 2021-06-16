<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     *redirectToプロパティ
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *ontrollerのコンストラクタでmiddlewareを呼び出している。
     * @return void
     */
    public function __construct()
    {
        // 認証していないuserにmiddlewareをかけてログイン画面に飛ばす
        $this->middleware('guest')->except('logout');//routingに記載のため不要
    }
}
