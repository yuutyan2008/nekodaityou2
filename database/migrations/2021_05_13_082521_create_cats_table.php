
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cats', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('猫ID');
            $table->string('name')->comment('猫の名前');
            $table->string('tail')->comment('しっぽの長さ')->nullable();
            $table->string('hair')->comment('毛の模様');
            $table->string('gender')->comment('性別')->nullable();
            $table->string('area')->comment('居住エリア');
            $table->string('attention')->comment('注意事項')->nullable();
            
            $table->timestamps();

            $table->string('remarks')->comment('備考欄')->nullable();
            
            // 画像のパスを保存するカラム
            $table->string('image_path')->nullable();
            

            // //外部キーの設定
            // $table->foreign('tail_id')->references('id')->on('tails')->onDelete('cascade');
            // $table->foreign('hair_id')->references('id')->on('hairs')->onDelete('cascade');
            // $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
            // $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            // $table->foreign('attention_id')->references('id')->on('attentions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cats');
    }
}
