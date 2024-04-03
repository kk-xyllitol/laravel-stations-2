<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('movies', function (Blueprint $table) {
      $table->id();
      $table->string('title')->uniqe();
      $table->text('image_url')->comment('画像URL');
      $table->integer('published_year')->comment('公開年');
      $table->text('description')->comment('概要');
      $table->tinyInteger('is_showing')->comment('上映中かどうか');
      $table->unsignedBigInteger('genre_id');
      $table->timestamps();

      $table->unique(['title']);

      $table->foreign('genre_id')->references('id')->on('genres');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('movies');
  }
}
