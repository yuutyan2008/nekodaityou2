<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins_cats', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->timestamps();
            
            $table->BigInteger('admin_id')->unsigned();
            $table->BigInteger('cat_id')->unsigned();
            
            // 外部キー
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('cat_id')->references('id')->on('cats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //テーブルの削除
        Schema::dropIfExists('admins_cats');
    }
}
