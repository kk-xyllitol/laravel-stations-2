<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    // スケジュールに関する関数を入れる

    public function movie() {
      return $this->belongsTo('App\Models\Movie');
    }

    public function screen() {
      return $this->belongsTo('App\Models\Screen');
    }

    public function reservations() {
      return $this->hasMany('App\Models\Reservation');
    }

    protected $fillable = ['movie_id','start_time','end_time'];
    protected $dates = ['start_time','end_time'];

}
