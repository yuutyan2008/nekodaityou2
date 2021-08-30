<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            //timestampメソッド：Blueprintにより作成日時と更新日時を自動設定
            //メールの認証機能。登録確認メール受信で日時が自動入力される
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();//ログイン情報を保持
            $table->timestamps();
            $table->unsignedBigInteger('belonging')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
