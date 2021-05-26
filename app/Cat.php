<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cat extends Model
{
    
    //入力フォームに入力できるように設定
    protected $fillable = ['name'];
                        


 
    
    // /**
    //  * catに属する注意事項を取得(多対多のリレーション定義)
    //  * attentionとcatは多対多の関係
    //  */
    // public function attentions()
    // {
    //     return $this->belongsToMany('App\Attention');
    // }    
    

}
