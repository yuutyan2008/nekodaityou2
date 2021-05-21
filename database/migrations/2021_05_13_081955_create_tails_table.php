<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('length')->comment('長さ');
            // $table->string('short')->comment('短い');
            // $table->string('middle')->comment('中間');
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
        Schema::dropIfExists('tails');
    }
}
