<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{

    //catとpictureは1対多の関係
    public function picture(){

        return $this->belongsTo('App\Picture');
    }
}
