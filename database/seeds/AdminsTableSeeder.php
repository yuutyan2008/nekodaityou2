<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *データの登録処理を行う
     * @return void
     */
    public function run()
    {
        //クエリ文を生成するビルダクラスを取得(クエリビルダによるDB操作）)
        DB::table('admins')->insert([
        [
        'name' => 'サンプル太郎',
        'email' => 'sample@gmail.com',
        'password' => Hash::make('sample'),
       
      ],
    //     [
    //      'name' => '山本さん',
    //     'email' => 'test@test',
    //     'password' => '1915580',
    //     'belonging_id' => '2',   ],
    //     [
    //     'name' => '長尾さん',
    //     'email' => 'test2@test',
    //     'password' => '191558',
    //     'belonging_id' => '3',
    //   ],
    ]);
    }
}
