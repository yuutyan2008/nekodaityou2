<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cathistory extends Model
{
    public static $rules = array(
        'user_id' => 'required',
        'cats_id' => 'required',
        'edited_at' => 'required',
    );
    
    //$guardプロパティは入力フォームの値がnullでもエラーにならない保護設定。
    //idフィールドはデータベースで自動的に番号が入るため、Modelで設定しない
    protected $guarded = array('id');
    
    //CatsとCathistoriesは１対多の関係
    public function Cat()
    {
        return $this->belongsTo('App\Cat');
    }

    //userとcathistoryは１対多の関係
    public function user()
    {
        return $this->belongsTo('App\user');
    }
}
