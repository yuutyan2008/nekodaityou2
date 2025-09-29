<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
//InterventionImageの利用
use App\Http\Requests;
use InterventionImage; //画像リサイズ
use Image;

//バリデーションルールで実行されるクエリをカスタマイズする場合は
use Illuminate\Validation\Rule;

//Validatorの使用
use Validator;
use App\Cat;
use App\User;

//時刻を扱うために Carbonという日付操作ライブラリを使う
use Carbon\Carbon;

//imageの保存をS3になるよう変更
use Storage;

//クラスの定義
class CatController extends Controller
{
    //登録画面表示
    public function add()
    {
        return view('user.cats.create');
    }

    //入力した文字をDBに保存する
    public function create(Request $request)
    {


        //実行したいvalidationルールをvalidateメソッドに渡す
        $request->validate([
            'name' => 'required_with_all | unique:cats',
            'hair' => 'required_with_all',
            'area' => 'required_with_all',
        ]);

        //データを新規作成。newはCatモデルからインスタンス（レコード）を生成するメソッド
        $cat = new Cat;

        $form = $request->only([
            'name',
            'tail',
            'hair',
            'gender',
            'area',
            'attention',
            'remarks',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            InterventionImage::make($image)->fit(300, 200)->save();

            $path = Storage::disk('public')->putFile('/', $image, 'public');
            $cat->image_path = Storage::disk('public')->url($path);
        } else {
            $cat->image_path = null;
        }

        // dd($path);
        //ログインuserのidを取得して、DBに保存時catテーブルにuser_idを代入して一緒に保存
        $cat->user_id = Auth::id();
        //$cat呼び出して、フォームに入力した内容を全て入力（更新）
        $cat->fill($form)->save();

        return view('user.cats.create');
    }


    //猫台帳検索、一覧表示
    public function index(Request $request)
    {
        // リクエストから検索条件を個別に取得
        $name = $request->input('name');
        $tail = $request->input('tail');
        $hair = $request->input('hair');
        $gender = $request->input('gender');
        $area = $request->input('area');
        $attention = $request->input('attention');

        // Catテーブルを対象にクエリビルダを生成
        $query = Cat::query();

        // 各条件が指定されていれば順に絞り込み
        if (!empty($name)) {
            $query->where('name', 'like', '%' . $name . '%'); //部分一致検索
        }
        if (!empty($tail)) {
            $query->where('tail', $tail);
        }
        if (!empty($hair)) {
            $query->where('hair', $hair);
        }
        if (!empty($gender)) {
            $query->where('gender', $gender);
        }
        if (!empty($area)) {
            $query->where('area', $area);
        }
        if (!empty($attention)) {
            $query->where('attention', $attention);
        }

        // 更新日時の新しい順に並び替え
        $query->orderBy('updated_at', 'desc');

        // 並び替え後のレコードを取得
        $cats = $query->get();

        // 結果表示のため、検索フォームの入力値をまとめる
        $filters = [
            'name' => $name,
            'tail' => $tail,
            'hair' => $hair,
            'gender' => $gender,
            'area' => $area,
            'attention' => $attention,
        ];

        return view('user.cats.index', [
            'posts' => $cats,
            'filters' => $filters,
        ]);
    }

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
        //newはCatモデルからインスタンス（レコード）を生成するメソッド
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

        //バリデータに自身のcatIDを無視するように指示
        Validator::make($request->only([
            'name',
            'hair',
            'area',
        ]), [
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
        $cat_form = $request->only([
            'name',
            'tail',
            'hair',
            'gender',
            'area',
            'attention',
            'remarks',
        ]);

        // dd($cat_form);
        //画像の変更、削除設定
        if ($request->remove == 'true') {
            $cat_form['image_path'] = null; // 更新時の削除をする場合。userが保存した画像$cat_form['image_path']を削除
        } elseif ($request->hasFile('image')) { // 新しい画像に変更する場合
            $newImage = $request->file('image');
            InterventionImage::make($newImage)->fit(300, 200)->save();

            $path = Storage::disk('public')->putFile('/', $newImage, 'public');
            $cat_form['image_path'] = Storage::disk('public')->url($path);
        } else { // 更新以外（変更なし）の場合
            $cat_form['image_path'] = $cat->image_path; // DBから取得したimage_pathカラムの値(ファイル名)を、そのまま新フォームに入れる
        }

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
