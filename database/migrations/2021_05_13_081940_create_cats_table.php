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
            $table->string('tail_id')->comment('しっぽの長さ');
            $table->string('hair_id')->comment('毛の模様');
            $table->string('gender_id')->comment('性別');
            $table->string('area_id')->comment('居住エリア');
            $table->string('attention_id')->comment('注意事項');
            $table->string('remarks')->comment('備考欄');
            
            // 画像のパスを保存するカラム
            $table->string('image_path')->nullable();  
            
            //timestampメソッド：Blueprintにより作成日時と更新日時を自動設定
            //メールの認証機能。登録確認メール受信で日時が自動入力される
            $table->timestamp('email_verified_at')->nullable()->comment('メールアドレス確認用');
            $table->string('password')->comment('管理者パスワード');
            $table->rememberToken();//ログイン情報を保持
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
        Schema::dropIfExists('cats');
    }
}
