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

//imageの保存をS3になるよう変更
use Storage;

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
            $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');
            $activity->image_path = Storage::disk('s3')->url($path);
        } else {
            $activity->image_path = null;
        }
      
        //フォームから送信された使用済トークンの削除
        unset($form['_token']);
      
        //フォームから送信された保存済画像の削除
        unset($form['image']);
      
        // データベースに保存する
        $activity->user_id = Auth::id();//activityテーブルのuser_idにアクセスしてAuthクラスのidに保存
        $activity->fill($form);
        $activity->save();

        return redirect('user/activity');
    }
    
    public function index(Request $request)
    {
       
        //Activity Modelを使って、データベースに保存されている、activityテーブルのレコードをすべて取得し、変数$postsに代入
        $posts = Activity::all();
    
        /*
          index.blade.phpのファイルに取得したレコード（$posts）を渡し、ページを開く
          view(ファイル名, 使いたい配列)
        */
        return view('user.activity.index', ['posts' => $posts]);
    }
}
