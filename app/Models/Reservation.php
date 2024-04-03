<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
  use HasFactory;

  public function schedule() {
    return $this->belongsTo('App\Models\Schedule');
  }

  public function sheet() {
    return $this->belongsTo('App\Models\Sheet');
  }

  public function user() {
    return $this->belongsTo('App\Models\User');
  }
}
