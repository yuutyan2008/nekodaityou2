<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//Authクラスを使用
use Auth;
use User;

use App\Activity;
use App\Activityhistory;

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
        

        //ログインuserのidを取得して、activityのuser_idをDBに保存する時に代入して一緒に保存
        $activity->user_id = Auth::id();
        
        $form = $request->all();

        //$activity呼び出して、フォームに入力した内容を全て入力（更新）、そしてデータベースに保存
        $activity->fill($form);
        $activity->save();
       
        // formに画像があれば、保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');//fileメソッドにはinputタグのname属性、storeメソッドには画像のパスを指定
            $activity->image_path = basename($path);//画像名のみ保存するbasenameメソッドを用いて$activity->image_pathに画像のパスを保存
        } else {
            $activity->image_path = null;
        }
      
        //フォームから送信された使用済トークンの削除
        unset($form['_token']);
      
        //フォームから送信された保存済画像の削除
        unset($form['image']);
        
        //Activity Modelを保存するタイミングで、同時に activityhistory Modelにも編集履歴を追加する
        $activityhistory = new Activityhistory;
        $activityhistory->activity_id = $activity->id;
        $activityhistory->user_id = $activity->user_id;
        $activityhistory->updated_at = Carbon::now();
        $activityhistory->save();
        // dd($$activityhistory);
        
        return view('user/activity/create');
        
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
    
    public function update(Request $request)
    {
        $this->validate($request, Cats::$rules);
        $cats = Cats::find($request->id);
        $cats_form = $request->all();
        if ($request->remove == 'true') {
            $cats_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $cats_form['image_path'] = basename($path);
        } else {
            $cats_form['image_path'] = $cats->image_path;
        }

        unset($cats_form['_token']);
        unset($cats_form['image']);
        unset($cats_form['remove']);
        $cats->fill($cats_form)->save();

        //Activity Modelを保存するタイミングで、同時に activityhistory Modelにも編集履歴を追加する
        $activityhistory = new Activityhistory;
        $activityhistory->activity_id = $activity->id;
        $activityhistory->user_id = $activity->user_id;
        $activityhistory->updated_at = Carbon::now();
        $activityhistory->save();
        // dd($$activityhistory);
        
        return view('user/activity/update');
    }
    
    public function delete(Request $request)
    {
        // 該当するactivity Modelを取得
        // dd($request);
        $actvity = Activity::find($request->id);
        // 削除する
        $activity->delete();
        return redirect('user/activity/');
    }
}
