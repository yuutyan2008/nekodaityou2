<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('管理者ID');
            $table->string('name')->comment('管理者名');
            $table->string('email')->unique()->comment('管理者メールアドレス');
            //timestampメソッド：Blueprintにより作成日時と更新日時を自動設定
            //メールの認証機能。登録確認メール受信で日時が自動入力される
            $table->timestamp('email_verified_at')->nullable()->comment('メールアドレス確認用');
            $table->string('password')->comment('管理者パスワード');
            $table->rememberToken();//ログイン情報を保持
            $table->timestamps();
            $table->integer('belonging_id')->comment('所属ID');

        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //ロールバック（エラーがあった時の巻き戻し）
    {
        //このテーブルがあれば削除して、なければ何もしない
        Schema::dropIfExists('admins');
    }
}
