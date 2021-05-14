<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hairs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('siro')->comment('白');
            $table->string('kuro')->comment('黒');
            $table->string('gray')->comment('グレー');
            $table->string('tya')->comment('茶');
            $table->string('tya_siro')->comment('茶白');
            $table->string('siro_kuro')->comment('白黒');
            $table->string('kiji_siro')->comment('キジ白');
            $table->string('sabi')->comment('サビ');
            $table->string('mike')->comment('三毛');
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
        Schema::dropIfExists('hairs');
    }
}
