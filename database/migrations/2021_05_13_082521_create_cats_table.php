
<?php
//クラスをインポートし使えるようにする
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
//migration機能
use Illuminate\Database\Migrations\Migration;

class CreateCatsTable extends Migration
{
    /**
     * Run the migrations.
     *テーブル作成、カラム追加を行うup()
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cats', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->string('name');
            $table->string('tail')->nullable();
            $table->string('hair');
            $table->string('gender')->nullable();
            $table->string('area');
            $table->string('attention')->nullable();
            
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->timestamps();

            $table->string('remarks')->nullable();
            
            // 画像のパスを保存するカラム
            $table->string('image_path')->nullable();
            
            // 外部キ
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
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
