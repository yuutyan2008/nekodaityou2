<?php

namespace App;

use Illuminate\Notifications\Notifiable;//メールを送れる設定
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;//adminモデルはこのクラスを継承
use Illuminate\Database\Eloquent\Model;

//Authにより組み込まれる認証機能では、Authenticatableを継承したModelクラスを継承
class User extends Authenticatable
{
    use Notifiable;
    
    //$guardプロパティは入力フォームの値がnullでもエラーにならない保護設定。
    //idフィールドはデータベースで自動的に番号が入るため、Modelで設定しない
    protected $guarded = array('id');
    
    
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
     *remember_tokenはログイン時にremember meを選んだユーザーのトークンを保存しておくカラム
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // //belongingとuserは1対多の関係
    // public function belonging()
    // {
    //     return $this->belongsTo('App\Belonging');
    // }
    
    //userとactivityは１対多の関係
    public function activities()
    {
        return $this->hasMany('App\Activity');
    }
    
    //userとcatは多対多の関係
    public function users()
    {
        return $this->belongsToMany('App\Cat');
    }

    //userとcathistoryは１対多の関係
    public function cathistories()
    {
        return $this->hasMany('App\Cathistory');
    }
   

    
    public static $rules = array(
         'name' => 'required',
         'email' => 'required',
         'password' => 'required|string|min:6|confirmed',
    );
    
    public static $update_rules = array(
         'name' => 'required',
         'email' => 'required',
    );
}
