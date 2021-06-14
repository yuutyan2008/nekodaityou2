<?php

namespace App\Http\Controllers\user;

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
           
            /*Cat::all()は、Eloquentを使い全てのcatテーブルを取得するというメソッド（処理）
            updated_at:投稿日時で、sortByDesc:updated_at新しいもの順に並べ替える
            */
            $posts = Cat::all()->sortByDesc('updated_at');
        }
        /*
         index.blade.phpのファイルに取得したレコード（$posts）と、
         ユーザーが入力した文字列（$cond_title）を渡し、ページを開く
         view(ファイル名, 使いたい配列)
        */
        // dd($posts, $cond_title);
        return view('auth.cats.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
}
