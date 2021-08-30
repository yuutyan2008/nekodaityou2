<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCathistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cathistories', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            
            $table->bigInteger('name')->unsigned();
            $table->foreign('name')->references('name')->on('cats')->onDelete('cascade');
            
            $table->bigInteger('tail')->unsigned()->nullable();
            $table->foreign('tail')->references('tail')->on('cats')->onDelete('cascade');
            
            $table->bigInteger('hair')->unsigned();
            $table->foreign('hair')->references('hair')->on('cats')->onDelete('cascade');
            
            $table->bigInteger('gender')->unsigned()->cnullable();
            $table->foreign('gender')->references('gender')->on('cats')->onDelete('cascade');
            
            $table->bigInteger('area')->unsigned();
            $table->foreign('area')->references('area')->on('cats')->onDelete('cascade');
            
            $table->bigInteger('attention')->nullable();
            $table->foreign('attention')->references('attention')->on('cats')->onDelete('cascade');
            
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->bigInteger('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('cats')->onDelete('cascade');
            
                    
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
        Schema::dropIfExists('cathistories');
    }
}
