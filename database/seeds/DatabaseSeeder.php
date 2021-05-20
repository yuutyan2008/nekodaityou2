<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //CatsTableSeederを利用するための設定
        $this->call(CatsTableSeeder::class);
        
    }
}
