<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
  // use HasFactory;
  protected $fillable = ['name','email','password' ]; //保存したいカラム名が1つの場合

  public function reservations() {
    
    return $this->hasMany('App\Models\Reservation');
  }
}
