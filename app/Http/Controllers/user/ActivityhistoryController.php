<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Activity;

// //imageの保存をS3になるよう変更
// use Storage;

//自分の猫活動表示
class ActivityController extends Controller
{
    public function index(Request $request)
    {
       
        //Activity Modelを使って、データベースに保存されている、activityテーブルのレコードをすべて取得
        $activity = new Activity;
        $activity = Activity::where('user_id', auth()->user()->id)->get()->sortByDesc('updated_at');
        
        if (count($activity) > 0) {
            /* shift:配列の最初のデータを削除し、その値を返すメソッド
              削除した最新データを$headline（最新の投稿を格納）に代入
              $posts（最新投稿以外を格納）
              最新とそれ以外で表記を変えたいため
            */
            $headline = $activity->shift();
        } else {
            $headline = null;
        }
        
        /*
          index.blade.phpのファイルに取得したレコード（$activity）を渡し、ページを開く
          view(ファイル名, 使いたい配列)
        */
        return view('user.activity.historyindex', ['headline' => $headline, 'activity' => $activity]);
    }
    
    // // 編集画面の処理
    // public function edit(Request $request)
    // {
    //     //findメソッドを使用して主キーのidからActivityテーブルレコードを抽出する
    //     $activity = Activity::find($request->id);
    //     if (empty($activity)) {
    //         abort(404);
    //     }
    //     return view('user.history.edit', ['activity_form' => $activity]);//user入力データが格納されたactivity_formから、データをactivityに格納して
    // }
    
    // //編集画面から送信されたフォームデータを処理
    // public function update(Request $request)
    // {
    //     /*
    //      Validationをかける.
    //      第1引数に$requestとすると様々な値をチェックできる。
    //      第２引数ModelのActivityクラスの$rulesメソッド(validationのルールをまとめたもの)にアクセスしたい
    //     */
    //     $this->validate($request, Activity::$update_rules);
        
    //     //findメソッドを使用して主キーのidからhistoryテーブルレコードを抽出する
    //     $activity = Activity::find($request->id);
        
    //     // 送信されてきたフォームデータをhistory_formに格納する
    //     $activity_form = $request->all();
      
    //     if ($request->remove == 'true') {
    //         $activity_form['image_path'] = null;
    //     } elseif ($request->file('image')) {
    //         //画像の取得から保存までの場所$pathを定義し、public/imageディレクトリに保存できたら$pathに代入//
    //         $path = $request->file('image')->store('public/image');
    //         $activity->image_path = basename($path);
    //     // $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');
    //         // //$pathの経路public/imageディレクトリを削除し、ファイル名だけをフォームに入力
    //         // $activity->image_path = Storage::disk('s3')->url($path);
    //     } else {
    //         $activity_form['image_path'] = $activity->image_path;
    //     }
    //     //activity_formから送信されてきた[ ]を削除
    //     unset($activity_form['_token']);
    //     unset($activity_form['image']);
    //     unset($activity_form['remove']);
    
    //     //$activity呼び出して、フォームに入力した内容を全て入力（更新）、そして保存
    //     $activity->fill($history_form)->save();
        
    //     return redirect('user/activity');
    // }

    public function activitydelete(Request $request)
    {
        // 該当するactivity Modelを取得
        // dd($request);
        $activity = Activity::find($request->id);
        // 削除する
        $cat->delete();
        return redirect('user/activity/');
    }
}
