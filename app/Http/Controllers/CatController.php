<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cat;

//時刻を扱うために Carbonという日付操作ライブラリを使う
use Carbon\Carbon;

//imageの保存をS3になるよう変更
use Storage;


class CatController extends Controller
{

    //猫台帳一覧を表示
    public function index() {
        $cats = Cat::all();
        return view('index')->with('cats', $cats);
    }       
}
