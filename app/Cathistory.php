<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cathistory extends Model
{
    //
    protected $guarded = array('id');

    public static $rules = array(
        'cats_id' => 'required',
        'edited_at' => 'required',
    );
    
    //CatsとCathistoriesは１対多の関係
    public function Cat()
    {
        return $this->belongsTo('App\Cat');
    }

    //userとcathistoryは１対多の関係
    public function user()
    {
        return $this->belongsTo('App\user');
    }
}
