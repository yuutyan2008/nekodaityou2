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
        
        //Carbon:日付操作ライブラリで現在時刻を取得し、History Modelの edited_at として記録
        // $cathistory->edited_at = Carbon::now();

        // $posts = Cathistory::find($request->user_id);
        return view('user.cathistory.index', ['cathistory' => $cathistory]);
        // return redirect()->route('cathistory', ['id' => auth()->user()->id]);
    }
}
