<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     * authミドルウェアがユーザー認証を行う
     * コンストラクタで指定することで全てのメソッドに適用される
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');  //ログイン認証
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');  //viewメソッド管理で者ホームページに移動
    }
}
