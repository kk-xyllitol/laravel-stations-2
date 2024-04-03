<?php

namespace App\Http\Controllers;
use App\Practice;

class PracticeController extends Controller
{
  // 1つ1つがメソッド（クラスに定義された引数をもとに、定められた手順で処理を行って特定の値を返す）
  public function sample()
  {
    return view('practice');
  }

  public function sample2()
  {
    $test = 'practice2';
    return view('practice2', ['testParam' => $test]);
  }

  public function sample3()
  {
    $test = 'test';
    return view('practice3', ['testParam' => $test]);
  }

  public function getPractice()
  {
    $practices = Practice::all();
    return view('getPractice', ['practices' => $practices]);
  }
}