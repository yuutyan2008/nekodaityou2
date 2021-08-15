<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityhistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activityhistories', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('activitiy_id')->unsigned();
            
            $table->string('edited_at');
            $table->timestamps();
            
            // 外部キー
            $table->foreign('activitiy_id')->references('id')->on('activities')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activityhistories');

        // //カラムの削除
        // Schema::table('activityhistories', function (Blueprint $table) {
        //     $table->dropForeign('ctivityhistories_user_id_foreign');
        // });
    }
}
