<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // マイグレーションを編集するのはNG
      // 新しくファイルを作らなければならない
        Schema::create('users', function (Blueprint $table) {
          $table->id();
          $table->string('name')->comment('ユーザ名');
          $table->string('email')->comment('メールアドレス');
          $table->string('password')->comment('パスワード');

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
        Schema::dropIfExists('users');
    }
}
