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
        return view('admin.cats.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    
    //フォームに入力する
    public function add()
    {
        return view('admin.cats.create');
    }
    
    //入力した文字をDBに保存する
    public function create(Request $request)
    {
        //controllerのVaridationメソッドを呼び出す。Catディレクトリの$rules変数を検証する
        $this->validate($request, Cat::$rules);
    
        $cat = new Cat;
        $form = $request->all();
    
        // formに画像があれば、保存する
        if (isset($form['image'])) {
            $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');
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
        
        return redirect('admin/cats/create');
    }
}
