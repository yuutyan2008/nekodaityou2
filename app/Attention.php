<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attention extends Model
{
<<<<<<< HEAD
<<<<<<< HEAD
    /**
     * 注意事項を有するcatを取得 (多対多のリレーション定義)
     */
    public function cats()
    {
        
        /**
         * 引数は接続先モデル名,(中間テーブル名),(中間テーブルのFKid),(リレーション先のFKid)
         *
         */        
        return $this->belongsToMany('App\Cat');
    }
=======
    //
>>>>>>> origin/master
=======
    //
>>>>>>> origin/master
}
