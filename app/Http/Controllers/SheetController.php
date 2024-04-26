<?php

namespace App\Http\Controllers;
use App\Models\Sheet;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonImmutable;

class SheetController extends Controller
{
  public function show()
  {
    $sheets = Sheet::all();
    return view('sheets', ['sheets' => $sheets]);
  }

  public function reservation($movie_id, $schedule_id)
  {
    $sheets = Sheet::query()
            ->with(['reservations' => function ($query)  use ($schedule_id){
              $query->where('schedule_id', $schedule_id);
            }])
            ->get();
    // dd($sheets);
    $date=request()->input('date');
    if(!$date) {
      abort(400);
    }
    return view('sheetsReservation', ['sheets' => $sheets, 'movie_id' => $movie_id, 'schedule_id' => $schedule_id] );
  }
}