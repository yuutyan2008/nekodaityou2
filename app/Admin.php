<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
//Authにより組み込まれた認証には、Authenticatableを継承したmodelクラスが必要
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

//Authにより組み込まれる認証機能では、Authenticatableを継承したModelクラスが必要
class Admin extends Authenticatable
{
    use Notifiable;//通知の設定を行う

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *castsはmodelに装備されている型変換のプロパティ
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',//email承認日フィールドのデータをdatetimeに型変換
    ];
    
    //adminとactivityは１対多の関係
    public function activities()
    {
        return $this->hasMany('App\Activity');
    }
       
    
    
    //validation設定。guardをかけてModelで値を用意しなくても保存できるよう保護する
    protected $guarded = array('id');
    
    public static $rules = array(
         'name' => 'required',
         'email' => 'required',
         'password' => 'required|string|min:6|confirmed',
    );
}
