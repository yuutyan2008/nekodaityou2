<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cat extends Model
{
    

    
    //$guardプロパティは入力フォームの値がnullでもエラーにならない保護設定。
    //idフィールドはデータベースで自動的に番号が入るため、Modelで設定しない
    protected $guarded = array('id');

    // validation:項目ごとに検証ルールを割り当て、入力情報を検証
    //入力が必須なもの以外には不要
    public static $rules = array(
        'name' => 'required',
    
    );              


 
    
    // /**
    //  * catに属する注意事項を取得(多対多のリレーション定義)
    //  * attentionとcatは多対多の関係
    //  */
    // public function attentions()
    // {
    //     return $this->belongsToMany(app/atteition);
    // }    
    

}
