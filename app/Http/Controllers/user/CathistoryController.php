<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Cat;
//Cathistory modelを使用
use App\Cathistory;
use App\User;

//時刻を扱うために Carbonという日付操作ライブラリを使う
use Carbon\Carbon;

// //imageの保存をS3になるよう変更
// use Storage;

class CathistoryController extends Controller
{
    //猫台帳編集履歴の一覧表示
    public function index(Request $request)
    {
        // //newはCatモデルからインスタンス（レコード）を生成するメソッド
        $cathistory = Cathistory::where('user_id', auth()->user()->id)->get();
        // dd($cathistory);
        
        //Carbon:日付操作ライブラリで現在時刻を取得し、History Modelの updated_at として記録
        // $cathistory->updated_at = Carbon::now();

        return view('user.cathistory.index', ['cathistory' => $cathistory]);
    }


    // 編集画面の処理
    public function edit(Request $request)
    {
        // Cathistory Modelからデータを取得する
        $cathistory = Cathistory::find($request->id);
        if (empty($cathistory)) {
            abort(404);
        }
        return view('user.cathistory.edit', ['cathistory_form' => $cathistory_form]);
    }
    
    //編集画面から送信されたフォームデータを処理
    public function update(Request $request)
    {
        /*
         Validationをかける.
         第1引数に$requestとすると様々な値をチェックできる。
         第２引数ModelのNewsクラスの$rulesメソッド(validationのルールをまとめたもの)にアクセスしたい
         */
        $this->validate($request, Cathistory::$rules);
        
        //findメソッドを使用して主キーのidからModelのデータを取得する
        $cathistory = Cathistory::find($request->id);
        
        // 送信されてきたフォームデータを格納する
        $cathistory_form = $request->all();
        if ($request->remove == 'true') {
            $cathistory_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $cathistory_form['image_path'] = basename($path);
        } else {
            $cathistory_form['image_path'] = $cathistory->image_path;
        }

        unset($cathistory_form['_token']);
        unset($cathistory_form['image']);
        unset($cathistory_form['remove']);
        $cathistory->fill($cathistory_form)->save();

        //Cat Modelを保存するタイミングで、同時に cathistory Modelにも編集履歴を追加する
        $cathistory = new Cathistory;
        $cathistory->cat_id = $cat->id;
        $cathistory->user_id = $cat->user_id;
        $cathistory->updated_at = Carbon::now();
        $cathistory->save();

        return view('user/cathistory/update');
    }
    
    public function delete(Request $request)
    {
        // 該当するcat Modelを取得
        // dd($request);
        $cathistory = Cathistory::find($request->id);
        // 削除する
        $cathistory->delete();
        return redirect('user/cathistory/');
    }
}
