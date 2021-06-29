<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Sinsei_cat;

//Cathistorymodelを使用
use App\Cathistory;

//時刻を扱うために Carbonという日付操作ライブラリを使う
use Carbon\Carbon;

//imageの保存をS3になるよう変更
use Storage;

class Sinsei_catController extends Controller
{
    
    
    //入力した文字をDBに保存する
    public function create(Request $request)
    {
        //controllerのVaridationメソッドを呼び出す。Catディレクトリの$rules変数を検証する
        $this->validate($request, Sinsei_cat::$rules);
        
        //newはCatモデルからインスタンス（レコード）を生成するメソッド
        $Sinsei_cat = new Sinsei_cat;
        $form = $request->all();
    
        // formに画像があれば、保存する
        if (isset($form['image'])) {
            $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');
            $sinsei_cat->image_path = Storage::disk('s3')->url($path);
        } else {
            $cat->image_path = null;
        }
    
        //フォームから送信された使用済トークンの削除
        unset($form['_token']);
        
        //フォームから送信された保存済画像の削除
        unset($form['image']);
        
        // データベースに保存する
        $sinsei_cat->fill($form);
        $sinsei_cat->save();
        
        return redirect('admin/sinsei_cats/create');
    }
}
