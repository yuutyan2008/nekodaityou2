<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sinsei_cat;

//Cathistorymodelを使用
use App\Cathistory;


//時刻を扱うために Carbonという日付操作ライブラリを使う
use Carbon\Carbon;

// //imageの保存をS3になるよう変更
// use Storage;

class Sinsei_catController extends Controller
{
    
    //入力した文字をDBに保存する
    public function create(Request $request)
    {
        //controllerのVaridationメソッドを呼び出す。Catディレクトリの$rules変数を検証する
        $this->validate($request, Sinsei_cat::$rules);
        
        //newはCatモデルからインスタンス（レコード）を生成するメソッド
        $sinsei_cat = new Sinsei_cat;
        $form = $request->all();
    
        // formに画像があれば、保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');//fileメソッドにはinputタグのname属性、storeメソッドには画像のパスを指定
            $sinsei_cat->image_path = basename($path);//画像名のみ保存するbasenameメソッド
        } else {
            $sinsei_cat->image_path = null;
        }
    
        //フォームから送信された使用済トークンの削除
        unset($form['_token']);
        
        //フォームから送信された保存済画像の削除
        unset($form['image']);
        
        //$sinsei_cat呼び出して、フォームに入力した内容を全て入力（更新）、そして保存
        $sinsei_cat->fill($form);
        $sinsei_cat->save();
        
        return redirect('user/sinsei_cats/create');
    }
    
    //フォームに入力する
    public function add()
    {
        return view('user.sinsei_cats.create');
    }
}
