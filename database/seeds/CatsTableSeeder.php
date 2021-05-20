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
      DB::table('cats')->insert([
        [
        'name' => 'ゆう',
        'tail_id' => '1',
        'hair_id' => '1',
        'gender_id' => '1',
        'area_id' => '1',
        'attention_id' => '1',
        'remarks' => '可愛い',
      ],
        [
        'name' => 'しん',
        'tail_id' => '2',
        'hair_id' => '2',
        'gender_id' => '1',
        'area_id' => '2',
        'attention_id' => '2',
        'remarks' => '',
      ],
        [
        'name' => 'めい',
        'tail_id' => '2',
        'hair_id' => '2',
        'gender_id' => '1',
        'area_id' => '3',
        'attention_id' => '3',
        'remarks' => '',

      ],
 

    ]);
    }
 
}