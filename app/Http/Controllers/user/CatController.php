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

//クラスの定義
class CatController extends Controller
{
    //入力した文字をDBに保存する
    public function create(Request $request)
    {
        //controllerのVaridationメソッドを呼び出す。Catディレクトリの$rules変数を検証する
        $this->validate($request, Cat::$rules);
        
        //新しいレコードを追加。newはCatモデルからインスタンス（レコード）を生成するメソッド
        $cat = new Cat;
        
        $form = $request->all();
    
        // formに画像があれば、保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');//fileメソッドにはinputタグのname属性、storeメソッドには画像のパスを指定
            $cat->image_path = basename($path);//画像名のみ保存するbasenameメソッド
        } else {
            $cat->image_path = null;
        }
    
        //フォームから送信された使用済トークンの削除
        unset($form['_token']);
        
        //フォームから送信された保存済画像の削除
        unset($form['image']);
        
        //ログインuserのidを取得して、DBに保存時catテーブルにuser_idを代入して一緒に保存
        $cat->user_id = Auth::id();
        //$cat呼び出して、フォームに入力した内容を全て入力（更新）
        $cat->fill($form)->save();
         
        

        //Cat Modelを保存するタイミングで、同時に cathistory Modelにも編集履歴を追加する
        $cathistory = new Cathistory;
        $cathistory->cat_id = $cat->id;
        $cathistory->user_id = $cat->user_id;
        $cathistory->updated_at = Carbon::now();
        $cathistory->save();
        // dd($cathistory);
        return view('user/cats/create');
    }
    
    //フォームに入力する
    public function add()
    {
        return view('user.cats.create');
    }
  
    //猫台帳検索、一覧表示
    public function index(Request $request)
    {
    
       //$requestの中の検索欄へのuser入力値cond_titleのを、変数cond_titleに代入
        $cond_title = $request->cond_title;
       
        //検索欄が空欄でない場合（検索された場合）
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
        return view('user.cats.index', ['posts' => $posts, 'cond_title' => $cond_title]);
        
     
        $form = $request->all();
    }
    
    //
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

        //Cat Modelを保存するタイミングで、同時に cathistory Modelにも編集履歴を追加する
        $cathistory = new Cathistory;
        $cathistory->cat_id = $cat->id;
        $cathistory->user_id = $cat->user_id;
        $cathistory->updated_at = Carbon::now();
        $cathistory->save();

        return redirect('user/cats/index');
    }
    
    public function delete(Request $request)
    {
        // 該当するcat Modelを取得
        // dd($request);
        $cat = Cat::find($request->id);
        // 削除する
        $cat->delete();
        return redirect('user/cats/');
    }
}
