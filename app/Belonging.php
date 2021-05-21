<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Belonging extends Model
{
    
    //belongingとuserは1対多の関係
    public function user(){ 
    
        return $this->belongsTo('App\User');
    }
    
}
