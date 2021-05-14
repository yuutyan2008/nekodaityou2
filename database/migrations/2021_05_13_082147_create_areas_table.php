<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nyojyuutou')->comment('農獣棟');
            $table->string('taiikukannura')->comment('体育館裏');
            $table->string('biotoupu')->comment('ビオトープ');
            $table->string('tosyokan')->comment('図書館裏');
            $table->string('sonota')->comment('その他');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
