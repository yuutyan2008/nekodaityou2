<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//Authクラスを使用
use Auth;
use User;
use App\Activity;

//時刻を扱うために Carbonという日付操作ライブラリを使う
use Carbon\Carbon;

//imageの保存をS3になるよう変更
use Storage;
//InterventionImageの利用
use App\Http\Requests;
use InterventionImage; //画像リサイズ
use Image;

class ActivityController extends Controller
{

    //フォームに入力する
    public function add()
    {
        return view('user.activity.create');
    }

    //入力した文字をDBに保存する
    public function create(Request $request)
    {

        //入力データを配列として受け取る
        //実行したいvalidationルールをvalidateメソッドに渡す
        $request->validate([
            'title' => 'required_with_all',
            'content' => 'required_with_all',
        ]);
        // activityクラスのインスタンス作成
        $activity = new Activity;


        //ログインuserのidを取得して、activityのuser_idをDBに保存する時に代入して一緒に保存
        $activity->user_id = Auth::id();

        $form = $request->only([
            'title',
            'content',
            'image',
        ]);

        //送信された画像がある場合のみリサイズ・保存する
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            InterventionImage::make($image)->fit(300, 200)->save();

            $path = Storage::disk('public')->putFile('/', $image, 'public');
            $activity->image_path = Storage::disk('public')->url($path);
        } else {
            $activity->image_path = null;
        }

        //フォームから送信された使用済トークンの削除
        unset($form['_token']);

        //フォームから送信された保存済画像の削除
        unset($form['image']);

        //$activity呼び出して、フォームに入力した内容を全て入力（更新）、そしてデータベースに保存
        $activity->fill($form);
        $activity->save();

        //送信前の画面へ戻る
        return redirect()->back();
    }

    public function index(Request $request)
    {

        //Activity Modelを使って、データベースに保存されている、activityテーブルのレコードをすべて取得し、変数$postsに代入
        $posts = Activity::all()->sortByDesc('updated_at');

        // if (count($posts) > 0) {
        //     /* shift:配列の最初のデータを削除し、その値を返すメソッド
        //       削除した最新データを$headline（最新の投稿を格納）に代入
        //       $posts（最新投稿以外を格納）
        //       最新とそれ以外で表記を変えたいため
        //     */
        //     $headline = $posts->shift();
        // } else {
        //     $headline = null;
        // }

        /*
          index.blade.phpのファイルに取得したレコード（$posts）を渡し、ページを開く
          view(ファイル名, 使いたい配列)
        */
        return view('user.activity.index', ['posts' => $posts]);
    }

    // public function update(Request $request)
    // {
    //     $this->validate($request, Cats::$rules);
    //     $cats = Cats::find($request->id);
    //     $cats_form = $request->only(['...']);
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

    //     return view('user/activity/update');
    // }

    // public function delete(Request $request)
    // {
    //     // 該当するactivity Modelを取得
    //     // dd($request);
    //     $actvity = Activity::find($request->id);
    //     // 削除する
    //     $activity->delete();
    //     return redirect('user/activity/');
    // }

    public function historyindex(Request $request)
    {

        //Activity Modelを使って、データベースに保存されている、activityテーブルのレコードをすべて取得
        $activity = new Activity;
        $activity = Activity::where('user_id', auth()->user()->id)->get()->sortByDesc('updated_at');

        /*
          index.blade.phpのファイルに取得したレコード（$activity）を渡し、ページを開く
          view(ファイル名, 使いたい配列)
        */
        return view('user.activity.historyindex', ['activity' => $activity]);
    }

    // // 編集画面の処理
    // public function edit(Request $request)
    // {
    //     //findメソッドを使用して主キーのidからActivityテーブルレコードを抽出する
    //     $activity = Activity::find($request->id);
    //     if (empty($activity)) {
    //         abort(404);
    //     }
    //     return view('user.history.edit', ['activity_form' => $activity]);//user入力データが格納されたactivity_formから、データをactivityに格納して
    // }

    // //編集画面から送信されたフォームデータを処理
    // public function update(Request $request)
    // {
    //     /*
    //      Validationをかける.
    //      第1引数に$requestとすると様々な値をチェックできる。
    //      第２引数ModelのActivityクラスの$rulesメソッド(validationのルールをまとめたもの)にアクセスしたい
    //     */
    //     $this->validate($request, Activity::$update_rules);

    //     //findメソッドを使用して主キーのidからhistoryテーブルレコードを抽出する
    //     $activity = Activity::find($request->id);

    //     // 送信されてきたフォームデータをhistory_formに格納する
    //     $activity_form = $request->only(['...']);

    //     if ($request->remove == 'true') {
    //         $activity_form['image_path'] = null;
    //     } elseif ($request->file('image')) {
    //         //画像の取得から保存までの場所$pathを定義し、public/imageディレクトリに保存できたら$pathに代入//
    //         $path = $request->file('image')->store('public/image');
    //         $activity->image_path = basename($path);
    //     // $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');
    //         // //$pathの経路public/imageディレクトリを削除し、ファイル名だけをフォームに入力
    //         // $activity->image_path = Storage::disk('s3')->url($path);
    //     } else {
    //         $activity_form['image_path'] = $activity->image_path;
    //     }
    //     //activity_formから送信されてきた[ ]を削除
    //     unset($activity_form['_token']);
    //     unset($activity_form['image']);
    //     unset($activity_form['remove']);

    //     //$activity呼び出して、フォームに入力した内容を全て入力（更新）、そして保存
    //     $activity->fill($history_form)->save();

    //     return redirect('user/activity');
    // }

    public function historydelete(Request $request)
    {
        // 該当するactivity Modelを取得

        $activity = Activity::find($request->id);
        // dd($activity);
        // 削除する
        $activity->delete();
        return redirect('user/activity/historyindex');
    }
}
