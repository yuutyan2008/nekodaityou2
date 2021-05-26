<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model; // 
use Illuminate\Support\Facades\DB;  // 
 
use Faker\Factory as Faker;  //テストデータ生成ライブラリ
use Carbon\Carbon;  // 
use App\Article; //

class CatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *データの登録処理を行う
     * @return void
     */
    public function run()
    {
      
      //クエリ文を生成するビルダクラスを取得
      DB::table('cats')->insert([
        [
        'name' => 'ゆう',
 
 
      ],
        [
        'name' => 'しん',
        

      ],
        [
        'name' => 'めい',
        


      ],
    ]);
    }
 
}