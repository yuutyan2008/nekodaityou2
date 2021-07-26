<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cat;
use App\Sinsei_cat;

//Cathistorymodelを使用
use App\Cathistory;


//時刻を扱うために Carbonという日付操作ライブラリを使う
use Carbon\Carbon;

// //imageの保存をS3になるよう変更
// use Storage;

class Sinsei_catController extends Controller
{
    
        //申請中の猫台帳一覧表示
    public function index(Request $request)
    {
        //newはSinsei_catモデルからインスタンス（レコード）を生成するメソッド
        $sinsei_cat = new Sinsei_cat;
        
        $form = $request->all();
        /*Sinsei_cat::all()は、Eloquentを使い全てのSinsei_catテーブルを取得するというメソッド（処理）
        updated_at:投稿日時で、sortByDesc:updated_at新しいもの順に並べ替える
        */
        $posts = Sinsei_cat::all()->sortByDesc('updated_at');

        return view('admin.sinsei_cats.index', ['posts' => $posts]);
    }
     

    //フォームに入力する
    public function add()
    {
        //送信前の画面へ戻る
        return redirect()->back();
    }
    
    
    // 編集画面の処理
    public function edit(Request $request)
    {
    
        //sinsei_cat一覧のデータを編集
        $sinsei_cat = Sinsei_cat::find($request->id);
        if (empty($sinsei_cat)) {
            abort(404);
        }
        return view('admin.sinsei_cats.edit', ['sinsei_cat_form' => $sinsei_cat]);//user入力データが格納されたsinsei_cat_formから、データをcatに格納して
    }
    

    //編集フォームデータを処理
    public function update(Request $request)
    {
        /*
         Validationをかける.
         第1引数に$requestとすると様々な値をチェックできる。
         第２引数Modelのsinsei_catクラスの$rulesメソッド(validationのルールをまとめたもの)にアクセスしたい
        */
        $this->validate($request, sinsei_cat::$update_rules);
        
        //findメソッドを使用して主キーのidからCatテーブルレコードを抽出する
        $sinsei_cat = Sinsei_cat::find($request->id);
        
        // 編集画面から送信されてきたフォームデータを$sinsei_cat_formに格納する
        $sinsei_cat_form = $request->all();
      
        if ($request->remove == 'true') {
            $sinsei_cat_form['image_path'] = null;
        } elseif ($request->file('image')) {
            //画像の取得から保存までの場所$pathを定義し、public/imageディレクトリに保存できたら$pathに代入//
            $path = $request->file('image')->store('public/image');
            $sinsei_cat->image_path = basename($path);
        // $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');
            // //$pathの経路public/imageディレクトリを削除し、ファイル名だけをフォームに入力
            // $sinsei_cat->image_path = Storage::disk('s3')->url($path);
        } else {
            $sinsei_cat_form['image_path'] = $sinsei_cat->image_path;
        }
        //sinsei_cat_formから送信されてきた[ ]を削除
        unset($sinsei_cat_form['_token']);
        unset($sinsei_cat_form['image']);
        unset($sinsei_cat_form['remove']);
    
        //$sinsei_cat呼び出して、フォームに入力した内容を全て入力（更新）、そして保存
        $sinsei_cat->fill($sinsei_cat_form)->save();
    }
}
