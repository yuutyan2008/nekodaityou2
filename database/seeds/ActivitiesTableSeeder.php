<?php

use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *データの登録処理を行う
     * @return void
     */
    public function run()
    {
        //クエリ文を生成するビルダクラスを取得(クエリビルダによるDB操作）)
        DB::table('activities')->insert([
        [
        'admin_id' => 'サンプル太郎',
        'content' => 'sample@gmail.com',
        'image_path' => 'japanese-cherry-blossoms-6125088_640.jpg',
        'belonging_id' => '10',
        'user_id' => '7',
      ],
    //     [
    //      'name' => '山本さん',
    //     'email' => 'test@test',
    //     'password' => '1915580',
    //     'belonging_id' => '2',
    //     'activity_id' => '2',     ],
    //     [
    //     'name' => '長尾さん',
    //     'email' => 'test2@test',
    //     'password' => '191558',
    //     'belonging_id' => '3',
    //     'activity_id' => '3',
    //   ],
    ]);
    }
 
}