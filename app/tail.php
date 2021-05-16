<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tails extends Model
{

    //tailとcatは1対多の関係
    public function cat(){ 
    
        return $this->hasMany('App\Cat');
    }

}
