<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    
    //areaとcatは1対多の関係
    public function cats(){

        return $this->hasMany('App\Cat');
    }    
     
}
