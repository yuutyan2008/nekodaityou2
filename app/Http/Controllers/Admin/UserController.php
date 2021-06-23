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
}
