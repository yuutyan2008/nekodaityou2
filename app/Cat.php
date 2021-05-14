<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cats extends Model
{

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
<<<<<<< HEAD
<<<<<<< HEAD
    public function area(){
=======
    public function aarea(){
>>>>>>> origin/master
=======
    public function aarea(){
>>>>>>> origin/master

        return $this->belongsTo('App\Area');
    } 
    
    //attentionとcatは1対多の関係
    public function attention(){

        return $this->belongsTo('App\Attention');
<<<<<<< HEAD
<<<<<<< HEAD
    }    
    
    /**
     * catに属する注意事項を取得(多対多のリレーション定義)
     */
    public function attentions()
    {
        return $this->belongsToMany('App\Attention');
    }    
=======
    }     
>>>>>>> origin/master
=======
    }     
>>>>>>> origin/master
}
