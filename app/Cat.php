<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cats extends Model
{
    
    //入力フォームに入力できるように設定
    protected $fillable = ['name','tail_id','hair_id', 
                            'gender_id', 'area_id','attention_id', 'remarks'];
                        


    //tailとcatは1対多の関係
    public function tail(){

        return $this->belongsTo('App\Tail');
    }
    
    //hairとcatは1対多の関係
    public function hair(){

        return $this->belongsTo('App\Hair');
    }
    
    //genderとcatは1対多の関係
    public function gender(){

        return $this->belongsTo('App\Gender');
    }
    
    //areaとcatは1対多の関係
    public function area(){

        return $this->belongsTo('App\Area');
    } 
    
    //attentionとcatは1対多の関係
    public function attention(){

        return $this->belongsTo('App\Attention');
    }    
    
    /**
     * catに属する注意事項を取得(多対多のリレーション定義)
     */
    public function attentions()
    {
        return $this->belongsToMany('App\Attention');
    }    
    

}
