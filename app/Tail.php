<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tail extends Model
{

    //tailとcatは1対多の関係
    public function cats(){ 
    
        return $this->hasMany('App\Cat');
    }

}
