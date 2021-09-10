<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

//バリデーションルールで実行されるクエリをカスタマイズする場合は
use Illuminate\Validation\Rule;

//Validatorの使用
use Validator;

use App\Cat;

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
         
        // dd($request->all());//入力データを配列として受け取る
        //実行したいvalidationルールをvalidateメソッドに渡す
        $request->validate([
            'name' => 'required_with_all | unique:cats',
            'hair' => 'required_with_all',
            'area' => 'required_with_all',
        ]);
        
        //データを新規作成。newはCatモデルからインスタンス（レコード）を生成するメソッド
        $cat = new Cat;
        
        $form = $request->all();
    
        // formに画像があれば、保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');//fileメソッドにはinputタグのname属性、storeメソッドには画像のパスを指定
            $cat->image_path = basename($path);//画像ファイル名のみ保存するbasenameメソッドで、パスではなくファイル名でテーブルに保存
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
        
        return view('user.cats.create');
    }
    
    //フォームに入力する
    public function add()
    {
        return view('user.cats.create');
    }
  
    //猫台帳検索、一覧表示
    public function index(Request $request)
    {
    
       //$requestの中の検索欄へのuser入力値cond_titleを呼び出し、変数cond_titleに代入
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
         ユーザーが入力した文字列（$cond_title）を渡し、検索結果を表示
         view(ファイル名, 使いたい配列)
        */
        // dd($posts, $cond_title);
        return view('user.cats.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    //
    // public function update(Request $request)
    // {
    //     $this->validate($request, Cats::$rules);
    //     $cats = Cats::find($request->id);
    //     $cats_form = $request->all();
    //     if ($request->remove == 'true') {
    //         $cats_form['image_path'] = null;
    //     } elseif ($request->file('image')) {
    //         $path = $request->file('image')->store('public/image');
    //         $cats_form['image_path'] = basename($path);
    //     } else {
    //         $cats_form['image_path'] = $cats->image_path;
    //     }

    //     unset($cats_form['_token']);
    //     unset($cats_form['image']);
    //     unset($cats_form['remove']);
    //     $cats->fill($cats_form)->save();

    //     return redirect('user/cats/index');
    // }
    
    public function delete(Request $request)
    {
        // 該当するcat Modelを取得
        //データの入った$requestの中のidプロパティに該当するレコードを取得、＄catへ代入
        $cat = Cat::find($request->id);
        // 削除する
        $cat->delete();
        return redirect('user/cats/');
    }
    
    //自分の猫台帳の表示
    public function cathistoryindex(Request $request)
    {
        // //newはCatモデルからインスタンス（レコード）を生成するメソッド
        $cat = Cat::where('user_id', auth()->user()->id)->get();
        
        
        //Carbon:日付操作ライブラリで現在時刻を取得し、 updated_at として記録
        // $cat->updated_at = Carbon::now();
        
        //$cat(自分の猫データ)を取得して画面表示する
        return view('user.cats.cathistoryindex', ['cat' => $cat]);
    }
    
    // 編集画面の処理
    public function cathistoryedit(Request $request)
    {
        //modelのfindメソッドで、更新するCat modelを取得し、編集前のデータが入った$requestの中のidプロパティに該当するレコードをDBより取得
        $cat = Cat::find($request->id);
        // dd($cat);
        if (empty($cat)) {
            abort(404);
        }
        //入力データが格納されたcat_formから、データをcatに格納して
        return view('user.cats.cathistoryedit', ['cat_form' => $cat]);
    }
    
    //編集画面からPOSTで受け取った編集データの処理
    public function cathistoryupdate(Request $request)
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
        
        // 編集後のデータが入った$requestのデータ全てを$cat_formに格納する
        $cat_form = $request->all();
        
        // dd($cat_form);
        //画像の変更、削除設定
        if ($request->remove == 'true') {
            $cat_form['image_path'] = null;//更新時の削除をする場合。userが保存した画像$cat_form['image_path']を削除
        } elseif ($request->file('image')) {//新しい画像に変更する場合
            //画像の取得から保存までの場所$pathを定義し、public/imageディレクトリに保存できたら$pathに代入
            $path = $request->file('image')->store('public/image');
            $cat_form['image_path'] = basename($path);//basename()でファイル名だけ取得し,image_pathカラムに代入
        } else {                            //更新以外（変更なし）の場合
            $cat_form['image_path'] = $cat->image_path;//DBから取得したimage_pathカラムの値(ファイル名)を、そのまま新フォームに入れる
        }
        // $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');
        // //$pathの経路public/imageディレクトリを削除し、ファイル名だけをフォームに入力
        // $cat->image_path = Storage::disk('s3')->url($path);
        
        //unsetメソッドで、取得したフォームデータから必要のないtokenを削除する
        unset($cat_form['_token']);
        unset($cat_form['image']);
        unset($cat_form['remove']);
        
        // 該当するデータを上書きして保存する
        $cat->fill($cat_form)->save();

        return redirect('user/cats/cathistoryindex');
    }
    
    public function cathistorydelete(Request $request)
    {
        // 該当するcat Modelを取得
        // dd($request);
        $cat = Cat::find($request->id);
        // 削除する
        $cat->delete();
        return redirect('user/cats/');
    }
}
