<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //$guardプロパティは入力フォームの値がnullでもエラーにならない保護設定。
    //idフィールドはデータベースで自動的に番号が入るため、Modelで
    protected $guarded = array(
        'id', 'admin_id', 'user_id', 'belonging_id'
    );

    // validation:項目ごとに検証ルールを割り当て、入力情報を検証
    //入力が必須なもの以外には不要
    public static $rules = array(
        'content' => 'required',

    );
    
    //userとactivityは１対多の関係
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    // //adminとactivityは１対多の関係
    // public function admin()
    // {
    //     return $this->belongsTo('App\Admin');
    // }
}
