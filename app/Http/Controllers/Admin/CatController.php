<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//InterventionImageの利用
use App\Http\Requests;
use App\Http\Controllers\Controller;

//バリデーションルールで実行されるクエリをカスタマイズする場合は
use Illuminate\Validation\Rule;
//Validatorの使用
use Validator;

use App\Cat;
use App\User;

//Cathistory modelを使用
use App\Cathistory;

//時刻を扱うために Carbonという日付操作ライブラリを使う
use Carbon\Carbon;

//imageの保存をS3になるよう変更
use Storage;
//画像リサイズするパッケージの利用
use InterventionImage;
use Image;

class CatController extends Controller
{
  
    //猫台帳検索、一覧表示
    public function index(Request $request)
    {
    
        //$requestの中の検索欄へのadmin入力値cond_titleのを、変数cond_titleに代入
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
        // //controllerのVaridationメソッドを呼び出す。Catディレクトリの$rules変数を検証する
        // $this->validate($request, Cat::$rules);
        
        // dd($request->all());//入力データを配列として受け取る
        //実行したいvalidationルールをvalidateメソッドに渡す
        $request->validate([
            'name' => 'required_with_all | unique:cats',
            'hair' => 'required_with_all',
            'area' => 'required_with_all',
        ]);

        //newはCatモデルからインスタンス（レコード）を生成するメソッド
        $cat = new Cat;
        $form = $request->all();
        
        //送信されたリクエストの完全な画像ファイルを取得する
        $image = $request->file('image');
        //リサイズする
        InterventionImage::make($image)->fit(300, 200)->save();
        
        // formに画像があれば、S3へ保存する
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
        
        //$cat呼び出して、フォームに入力した内容を全て入力（更新）、そして保存
        $cat->fill($form);
        $cat->save();
    
        
        return redirect('admin/cats/create');
    }
    

    // 編集画面の処理
    public function edit(Request $request)
    {
        //findメソッドを使用して主キーのidからCatテーブルレコードを抽出する
        $cat = Cat::find($request->id);
        if (empty($cat)) {
            abort(404);
        }
        return view('admin.cats.edit', ['cat_form' => $cat]);//admin入力データが格納されたcat_formから、データをcatに格納して
    }
    
    //編集画面から送信されたフォームデータを処理
    public function update(Request $request)
    {
        //modelのfindメソッドで、更新するCat modelを取得し、編集前のデータが入った$requestの中のidプロパティに該当するレコードをDBより取得
        $cat = Cat::find($request->id);
        
        //バリデータにcatIDを無視するように指示
        Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('cats')->ignore($cat->id),
            ],
            'hair' => [
                'required',
                Rule::unique('cats')->ignore($cat->id),
            ],
            'area' => [
                'required',
                Rule::unique('cats')->ignore($cat->id),
            ],
        ]);
        
        // 送信されてきたフォームデータを$cat_formに格納する
        $cat_form = $request->all();
        
        //送信されたリクエストの完全な画像ファイルを取得する
        $image = $request->file('image');
 
        
        if ($request->remove == 'true') {
            $cat_form['image_path'] = null;
        } elseif ($request->file('image')) {
            //リサイズする
            InterventionImage::make($image)->fit(300, 200)->save();
            
            //画像の取得から保存までの場所$pathを定義し、public/imageディレクトリに保存できたら$pathに代入//
            $path = Storage::disk('s3')->putFile('/', $cat_form['image'], 'public');
            //$pathの経路public/imageディレクトリを削除し、ファイル名だけをフォームに入力
            $cat->image_path = Storage::disk('s3')->url($path);
        } else {
            $cat_form['image_path'] = $cat->image_path;
        }
        //cat_formから送信されてきた[ ]を削除
        unset($cat_form['_token']);
        unset($cat_form['image']);
        unset($cat_form['remove']);
    
        //$cat呼び出して、フォームに入力した内容を全て入力（更新）、そして保存
        $cat->fill($cat_form)->save();

        
        return redirect('admin/cats/index');
    }
}
