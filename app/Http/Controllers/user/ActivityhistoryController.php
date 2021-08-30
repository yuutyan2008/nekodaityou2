<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Activity;
use App\Activityhistory;

// //imageの保存をS3になるよう変更
// use Storage;

//自分の猫活動表示
class ActivityhistoryController extends Controller
{
    public function index(Request $request)
    {
       
        //Activity Modelを使って、データベースに保存されている、activityテーブルのレコードをすべて取得
        $activityhistory = new Activityhistory;
        $activityhistory = Activityhistory::where('user_id', auth()->user()->id)->get()->sortByDesc('updated_at');
        
        if (count($activityhistory) > 0) {
            /* shift:配列の最初のデータを削除し、その値を返すメソッド
              削除した最新データを$headline（最新の投稿を格納）に代入
              $posts（最新投稿以外を格納）
              最新とそれ以外で表記を変えたいため
            */
            $headline = $activityhistory->shift();
        } else {
            $headline = null;
        }
        
        /*
          index.blade.phpのファイルに取得したレコード（$activityhistory）を渡し、ページを開く
          view(ファイル名, 使いたい配列)
        */
        return view('user.activityhistory.index', ['headline' => $headline, 'activityhistory' => $activityhistory]);
    }
    
    // 編集画面の処理
    public function edit(Request $request)
    {
        //findメソッドを使用して主キーのidからActivityhistoryテーブルレコードを抽出する
        $activityhistory = Activityhistory::find($request->id);
        if (empty($activityhistory)) {
            abort(404);
        }
        return view('user.activityhistory.edit', ['activityhistory_form' => $activityhistory]);//user入力データが格納されたactivityhistory_formから、データをactivityhistoryに格納して
    }
    
    //編集画面から送信されたフォームデータを処理
    public function update(Request $request)
    {
        /*
         Validationをかける.
         第1引数に$requestとすると様々な値をチェックできる。
         第２引数ModelのActivityhistoryクラスの$rulesメソッド(validationのルールをまとめたもの)にアクセスしたい
        */
        $this->validate($request, Activityhistory::$update_rules);
        
        //findメソッドを使用して主キーのidからactivityhistoryテーブルレコードを抽出する
        $activityhistory = Activityhistory::find($request->id);
        
        // 送信されてきたフォームデータをactivityhistory_formに格納する
        $activityhistory_form = $request->all();
      
        if ($request->remove == 'true') {
            $activityhistory_form['image_path'] = null;
        } elseif ($request->file('image')) {
            //画像の取得から保存までの場所$pathを定義し、public/imageディレクトリに保存できたら$pathに代入//
            $path = $request->file('image')->store('public/image');
            $activityhistory->image_path = basename($path);
        // $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');
            // //$pathの経路public/imageディレクトリを削除し、ファイル名だけをフォームに入力
            // $activityhistory->image_path = Storage::disk('s3')->url($path);
        } else {
            $activityhistory_form['image_path'] = $activityhistory->image_path;
        }
        //activityhistory_formから送信されてきた[ ]を削除
        unset($activityhistory_form['_token']);
        unset($activityhistory_form['image']);
        unset($activityhistory_form['remove']);
    
        //$activityhistory呼び出して、フォームに入力した内容を全て入力（更新）、そして保存
        $activityhistory->fill($activityhistory_form)->save();
        
        return redirect('user/activityhistory');
    }
}
