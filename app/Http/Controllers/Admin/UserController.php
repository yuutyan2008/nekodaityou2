<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    //user一覧表示
    public function index()
    {
        
        /*User::all()は、Eloquentを使い全てのusersテーブルを取得するというメソッド（処理）
        updated_at:投稿日時で、sortByDesc:updated_at新しいもの順に並べ替える
        */
        $posts = User::all()->sortByDesc('updated_at');
        
        return view('admin.user.index', ['posts' => $posts]);
    }
    
    // 編集画面の処理
    public function edit(Request $request)
    {
        //findメソッドを使用して主キーのidからUserテーブルレコードを抽出する
        $user = User::find($request->id);
        if (empty($user)) {
            abort(404);
        }
        return view('admin.user.edit', ['user_form' => $user]);//user入力データが格納されたuser_formから、データをuserに格納して
    }
    
    
    //編集画面から送信されたフォームデータを処理
    public function update(Request $request)
    {
        /*
         Validationをかける.
         第1引数に$requestを渡し$request->all()を判定。エラーならメッセージと共に前のページへ。
         第２引数（）Userモデルクラスの$rules変数(どのカラムにどんなvalidationをかけるか配列で指定)を呼び出している
        */
        $this->validate($request, User::$update_rules);
        
        //findメソッドを使用して主キーのidからUserテーブルレコードを抽出する
        $user = User::find($request->id);
        
        // 送信されてきたフォームデータを$user_formに格納する
        $user_form = $request->all();
      
        //user_formから送信されてきた不要な[ ]を削除するメソッドunset
        unset($user_form['_token']);
        unset($user_form['remove']);
    
        // 変更した配列を上書きしてカラムに保存するfillメソッド
        $user->fill($user_form)->save();
      
        //Cat model保存と同時に、User Modelにも編集履歴を追加(会員情報から編集履歴を参照できるようにする)
        $user = new User;
        //オブジェクト変数（インスタンス化されたUserクラス）からcat_idメソッドを呼び出す=catオブジェクトからidメソッドを呼び出す
        $user->cat_id = $cat->id;
        //Carbon:日付操作ライブラリで現在時刻を取得し、user Modelの edited_at として記録
        $user->edited_at = Carbon::now();
        $user->save();
    
        //送信前の画面へ戻る
        return redirect()->back();
    }
    
    public function delete(Request $request)
    {
        // 該当するUser Modelを取得
        // dd($request);
        $user = User::find($request->id);
        // 削除する
        $user->delete();
        return redirect('admin/user/edit');
    }
}
