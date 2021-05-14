<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    
    //userとactivityは１対多の関係
    public function user(){ 
    
        return $this->belongsTo('App\User');
    }
    
    //adminとactivityは１対多の関係
    public function admin(){ 
    
        return $this->belongsTo('App\Admin');
    }
    
<<<<<<< HEAD
<<<<<<< HEAD
    
=======
>>>>>>> origin/master
=======
>>>>>>> origin/master
}
