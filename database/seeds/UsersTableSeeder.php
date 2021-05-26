<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *データの登録処理を行う
     * @return void
     */
    public function run()
    {
        //クエリ文を生成するビルダクラスを取得(クエリビルダによるDB操作）)
        DB::table('users')->insert([
        [
        'name' => 'サンプル太郎',
        'email' => 'ricebead778899@gmail.com',
        'password' => '19155804',
        'belonging_id' => '1',
        'activity_id' => '1',
      ],
        [
         'name' => '山本さん',
        'email' => 'test@test',
        'password' => '1915580',
        'belonging_id' => '2',
        'activity_id' => '2',     ],
        [
        'name' => '長尾さん',
        'email' => 'test2@test',
        'password' => '191558',
        'belonging_id' => '3',
        'activity_id' => '3',
      ],
    ]);
    }
 
}