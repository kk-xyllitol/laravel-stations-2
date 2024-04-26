<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('reservations', function (Blueprint $table) {
        $table->id()->comment('ID');
        $table->date('date')->comment('上映日');
        $table->unsignedBigInteger('schedule_id')->comment('スケジュールID');
        $table->unsignedBigInteger('user_id')->comment('予約者ID');
        
        $table->unsignedBigInteger('sheet_id')->comment('シートID');
        $table->string('email')->comment('予約者メールアドレス');
        $table->string('name')->comment('予約者名');
        $table->boolean('is_canceled')->comment('予約キャンセル済み')->default(false);
        $table->timestamps();
        
        $table->foreign('schedule_id')->references('id')->on('schedules');
        $table->foreign('sheet_id')->references('id')->on('sheets');
        $table->foreign('user_id')->references('id')->on('sheets');
        $table->unique(['schedule_id', 'sheet_id'], 'id');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('reservations');
    }
}
