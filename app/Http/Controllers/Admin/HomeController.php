<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     * コンストラクタでmiddlewareを呼び出している。
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
        return view('admin.home');  //ログイン認証
    }
}
