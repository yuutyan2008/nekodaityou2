<?php
//topページの活動一覧
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *コンストラクタでmiddlewareを呼び出している。
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');//マルチ認証
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.cats.index');//マルチ認証。homeからcats.indexに変更
    }
    
    // public function add()
    // {
    //     return view('admin.home');//マルチ認証
    // }
}
