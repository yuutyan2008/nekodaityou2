<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *作成したファイルの実行
     * @return void
     */
    public function run()
    {
        //CatsTableSeederを利用するための設定
        $this->call(CatsTableSeeder::class);
       
        // $this->call(UsersTableSeeder::class);    
        
        // $this->call(AdminsTableSeeder::class);      
        
        //$this->call(ActivitiesTableSeeder::class);        


    }
}
