<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('content')->comment('活動内容');
            $table->string('image_path')->nullable();  // 画像のパスを保存するカラム
            $table->timestamps();
            $table->unsignedBigInteger('belonging_id')->comment('所属ID');
            $table->bigInteger('user_id')->comment('userID');
            
            // //外部キー制約
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
