<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//Authクラスを使用
use Auth;
use User;

use App\Activity;

//時刻を扱うために Carbonという日付操作ライブラリを使う
use Carbon\Carbon;

// //imageの保存をS3になるよう変更
// use Storage;

class ActivityController extends Controller
{

  //フォームに入力する
    public function add()
    {
        return view('user.activity.create');
    }

    //入力した文字をDBに保存する
    public function create(Request $request)
    {

      // Varidationを行う。activityディレクトリの$rules変数を呼び出す
        $this->validate($request, activity::$rules);
        
        // activityクラスのインスタンス作成
        $activity = new Activity;
        
        //
        $form = $request->all();

        // formに画像があれば、保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');//fileメソッドにはinputタグのname属性、storeメソッドには画像のパスを指定
            $activity->image_path = basename($path);//画像名のみ保存するbasenameメソッド
        } else {
            $activity->image_path = null;
        }
      
        //フォームから送信された使用済トークンの削除
        unset($form['_token']);
      
        //フォームから送信された保存済画像の削除
        unset($form['image']);
      
        // データベースに保存する
        $activity->user_id = Auth::id();//ログインuserのidを取得して、activityのuser_idをDBに保存する時に代入して一緒に保存
        
        $activity->fill($form);
        $activity->save();

        //送信前の画面へ戻る
        return redirect()->back();
    }
    
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
        return view('user.activity.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
