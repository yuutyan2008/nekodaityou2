<?php
//ログイン後のUser画面表示を処理するcontroller
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Auth;
use App\User;

//時刻を扱うために Carbonという日付操作ライブラリを使う
use Carbon\Carbon;

//App直下のHistoryモデルを使う
use App\History;

//imageの保存をS3になるよう変更
use Storage;

class UserController extends Controller
{
    /**
     * 全ユーザーリストの表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * 投稿フォーム作成
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * 投稿送信ボタン押した後の移動先となる
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * idで渡したユーザーのプロフィールを一件だけ表示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * idで渡したユーザーの編集画面を表示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 編集フォームの送信ボタ多を押した後の送信先
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * idで渡したユーザ一件だけ削除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

//Controllerを継承してProfileControllerクラスを定義します
class ProfileController extends Controller
{
    // add, create, edit, updateプロパティを追加  
    public function add()
    {
        return view('admin.profile.create');
    }

     //userとサーバー間で相互情報のやりとりを管理するrequest/responceクラス
    public function edit(Request $request)
    {
        // Profile Modelからデータを取得する
        $profile = Profile::find($request->id);
        if (empty($profile)) {
          abort(404);    
      }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }

    public function update(Request $request)
    {
      // Validationをかける
      $this->validate($request, Profile::$rules);
      
      // Profile Modelからデータを取得する
      $profile = Profile::find($request->id);
      
      // 送信されてきたフォームデータを格納する
      $profile_form = $request->all();
      
      unset($profile_form['_token']);      
      
     

      // 該当するデータを上書きして保存する
      $profile->fill($profile_form)->save(); 
      
      //ProfileHistory Modelにも編集履歴を追加
      $profilehistory = new ProfileHistory;
      $profilehistory->profile_id = $profile->id;
      $profilehistory->edited_at = Carbon::now();
      $profilehistory->save();
        
      return redirect(sprintf("admin/profile/edit?id=%d", $profile->id));
    }
      
     //userとサーバー間で相互情報のやりとりを管理するrequest/responceクラス
    public function create(Request $request)
    { 
      // Varidationを行う
      $this->validate($request, Profile::$rules);

      $profile = new Profile;
      $form = $request->all();

 
      unset($form['_token']);
      
      // データベースに保存する
      $profile->fill($form);
      $profile->save();

        
        
     // admin/profile/createにリダイレクトする
        return redirect('admin/profile/create');
    }  
              
}
