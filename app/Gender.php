<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{

    //genderとcatは1対多の関係
    public function cats(){

        return $this->hasMany('App\Cat');
    }

    
}
