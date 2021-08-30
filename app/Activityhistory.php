<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activityhistory extends Model
{
    
    //$guardプロパティは入力フォームの値がnullでもエラーにならない保護設定。
    //idフィールドはデータベースで自動的に番号が入るため、Modelで設定しない
    protected $guarded = array('id');
    
    public static $rules = array(
        'activity_id' => 'required',
    
    );

    
    // //ActivityとActivityhistoriesは１対多の関係
    // public function Activity()
    // {
    //     return $this->belongsTo('App\Activity');
    // }

    //userとActivityhistoryは１対多の関係
    public function user()
    {
        return $this->belongsTo('App\user');
    }
}
