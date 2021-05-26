<?php

namespace App\Http\Controllers\Auth;

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


  // 台帳新規作成
  public function create(Request $request)
  {

      // Varidationを行う。Catディレクトリの$rules変数を呼び出す
      $this->validate($request, Cat::$rules);

      $cat = new Cat;
      $form = $request->all();

      // formに画像があれば、保存する
      if (isset($form['image'])) {
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        $cat->image_path = Storage::disk('s3')->url($path);  
      } else {
          $cat->image_path = null;
      }
      
      //フォームから送信された使用済トークンの削除
      unset($form['_token']);
      
      //フォームから送信された保存済画像の削除
      unset($form['image']);
      
      // データベースに保存する
      $cat->fill($form);
      $cat->save();

      return redirect('admin/cat/create');
  }


  //猫台帳一覧を表示
  public function index(Request $request)
  {
    //$requestの中の検索欄へのuser入力値cond_titleのを、変数cond_titleに代入
      $cond_title = $request->cond_title;
      //検索欄が空欄でなければ
      if ($cond_title != '') {
      //catテーブルのtitleカラムで$cond_titleユーザー入力文字に一致するレコードを全て取得
          $posts = Cat::where('title', $cond_title)->get();
      } else {
      //Cat Modelを使って、データベースに保存されている、catsテーブルのレコードをすべて取得し、変数$postsに代入
          $posts = Cat::all();
      }
      /*
        index.blade.phpのファイルに取得したレコード（$posts）と、
        ユーザーが入力した文字列（$cond_title）を渡し、ページを開く
        view(ファイル名, 使いたい配列)
      */
      return view('admin.cat.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }


  // 編集画面の処理
  public function edit(Request $request)
  {
      // Cat Modelからデータを取得する
      $cat = Cat::find($request->id);
      if (empty($cat)) {
        abort(404);    
      }
      return view('admin.cat.edit', ['cat_form' => $cat]);
  }


  //編集画面から送信されたフォームデータを処理
  public function update(Request $request)
  {
     /*
      Validationをかける.
      第1引数に$requestとすると様々な値をチェックできる。
      第２引数Modelのcat
      クラスの$rulesメソッド(validationのルールをまとめたもの)にアクセスしたい
    */
      $this->validate($request, Cat::$rules);
      // Cat Modelからデータを取得する
      $cat = Cat::find($request->id);
      // 送信されてきたフォームデータを格納する
      $cat_form = $request->all();
      
      if ($request->remove == 'true') {
            $cat_form['image_path'] = null;
        } elseif ($request->file('image')) {
      //画像の取得から保存までの場所$pathを定義し、public/imageディレクトリに保存できたら$pathに代入//
            $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
      //$pathの経路public/imageディレクトリを削除し、ファイル名だけをフォームに入力
            $cat->image_path = Storage::disk('s3')->url($path);
        } else {
            $cat_form['image_path'] = $cat->image_path;
        }
      //cat_formから送信されてきた[ ]を削除
      unset($cat_form['_token']);
      unset($cat_form['image']);
      unset($cat_form['remove']);

      // 該当するデータを上書きして保存する
      $cat->fill($cat_form)->save();
      
      //Cat Modelの編集を保存する時に、Cathistory Modelにも編集履歴を追加
      $cathistory = new Cathistory;
      //オブジェクト変数（インスタンス化されたHistoryクラス）からnews_idメソッドを呼び出す=newsオブジェクトからidメソッドを呼び出す
      //
      $cathistory->cat_id = $cat->id;
      //Carbon:日付操作ライブラリで現在時刻を取得し、Cathistory Modelの edited_at として記録
      $cathistory->edited_at = Carbon::now();
      $cathistory->save();


      return redirect('admin/cat');
  }
  
    public function delete(Request $request)
  {
      // 該当するCat Modelを取得
      // dd($request);
      $cat = Cat::find($request->id);
      // 削除する
      $cat->delete();
      return redirect('admin/cat/');
  }  


}