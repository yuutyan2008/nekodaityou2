<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hairs extends Model
{
 
 
    //hairとcatは1対多の関係
    public function cats(){

        return $this->hasMany('App\Cat');
    }

}
