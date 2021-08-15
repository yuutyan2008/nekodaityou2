<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activityhistory extends Model
{
    //
    protected $guarded = array('id');

    public static $rules = array(
        'activity_id' => 'required',
        'edited_at' => 'required',
    );
}
