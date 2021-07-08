<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use User;
   
use App\Activity;

//時刻を扱うために Carbonという日付操作ライブラリを使う
use Carbon\Carbon;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
       
        //Activity Modelを使って、データベースに保存されている、activityテーブルのレコードをすべて取得し、変数$postsに代入
        $posts = Activity::all()->sortByDesc('updated_at');
        
        if (count($posts) > 0) {
            /* shift:配列の最初のデータを削除し、その値を返すメソッド
              削除した最新データを$headline（最新の投稿を格納）に代入
              $posts（最新投稿以外を格納）
              最新とそれ以外で表記を変えたいため
            */
            $headline = $posts->shift();
        } else {
            $headline = null;
        }
        
        /*
          index.blade.phpのファイルに取得したレコード（$posts）を渡し、ページを開く
          view(ファイル名, 使いたい配列)
        */
        return view('activity.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
