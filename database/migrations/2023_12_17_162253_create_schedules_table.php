<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('schedules', function (Blueprint $table) {
      $table->id()->comment('ID');
      $table->unsignedBigInteger('movie_id')->comment('作品ID');
      $table->unsignedBigInteger('screen_id')->comment('スクリーンID');
      $table->datetime('start_time')->comment('上映開始時刻')->default(null);
      $table->datetime('end_time')->comment('上映終了時刻')->default(null);
      $table->timestamps();

      $table->foreign('movie_id')->references('id')->on('movies');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('schedules');
  }
}
