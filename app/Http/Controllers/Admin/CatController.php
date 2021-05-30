<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cat;

//Cathistorymodelを使用
use App\Cathistory;

//時刻を扱うために Carbonという日付操作ライブラリを使う
use Carbon\Carbon;

//imageの保存をS3になるよう変更
use Storage;

class CatController extends Controller
{

  
    //猫台帳検索、一覧表示
    public function index(Request $request)
    {
    
       //$requestの中の検索欄へのuser入力値cond_titleのを、変数cond_titleに代入
        $cond_title = $request->cond_title;
       
        //検索欄が空欄でなければ（検索された場合）
        if ($cond_title != '') {
           
          //catテーブルのnameカラムで$cond_titleユーザー入力文字に一致するレコードを全て取得
            $posts = Cat::where('name', $cond_title)->get();
        } else {
           
          //Cat Modelを使って、データベースに保存されている、catテーブルのレコードをすべて取得し、変数$postsに代入
            $posts = Cat::all();
        }
        /*
         index.blade.phpのファイルに取得したレコード（$posts）と、
         ユーザーが入力した文字列（$cond_title）を渡し、ページを開く
         view(ファイル名, 使いたい配列)
        */
        // dd($posts, $cond_title);
        return view('admin.cats.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
}
