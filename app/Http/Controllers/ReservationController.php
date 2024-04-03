<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\Sheet;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\User;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\CreateAdminReservationRequest;
use App\Http\Requests\UpdateAdminReservationRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class ReservationController extends Controller
{  
  public function show()
  {
    $reservations = Reservation::query()
          ->get();
    
    return view('reservations', ['reservations' => $reservations]);  
  }
  

  // 作成画面表示
  public function create($movie_id, $schedule_id)
  {        
    // モデルに処理を追い出し
    $date=request()->input('date');
    $sheetId=request()->input('sheetId');
    $user = Auth::user();
    // dd($user);
    $check = Reservation::query()
          ->where('schedule_id',$schedule_id)
          ->where('sheet_id',$sheetId)
          ->first();
    if(!$date || !$sheetId || $check) {
      abort(400);
    }
    $sheets = Sheet::all();
    return view('reservationsCreate', [ 'sheets' => $sheets, 'movie_id' => $movie_id, 'schedule_id' => $schedule_id]);
  }

  // 作成画面表示（管理者）
  public function adminCreate()
  {        
    $movies = Movie::get();
    $Schedules = Schedule::get();
    $sheets = Sheet::get();
    
    return view('reservationsAdminCreate', ['sheets' => $sheets, 'movies' => $movies, 'schedules' => $Schedules]);
  }


  // 作成
  public function store(CreateReservationRequest $request)  
  { 
    $inputs = $request->validated();
    
    $movie_id = Schedule::query()
            ->where('id', $inputs['schedule_id'])
            ->first('movie_id');
    $check = Reservation::query()
          ->where('schedule_id', $inputs['schedule_id'])
          ->where('sheet_id', $inputs['sheet_id'])
          ->first();
    if($check) {
      return redirect()->route('sheets.reservation', ['movie_id' => $movie_id['movie_id'],'schedule_id' => $inputs['schedule_id'],'date'=>$inputs['date']])->with('message', 'その座席はすでに予約されています。');
    }

    $reservation=new Reservation;
    $reservation->name=$inputs['name'];
    $reservation->email=$inputs['email'];
    $reservation->schedule_id=$inputs['schedule_id'];
    $reservation->sheet_id=$inputs['sheet_id'];
    $reservation->date=$inputs['date'];
    $reservation->save();
    return redirect()->route('movie.detail', ['id' => $movie_id['movie_id']])->with('message', '予約完了しました。');
  }

  // 作成（管理者）
  public function adminStore(CreateAdminReservationRequest $request)  
  { 
    $inputs = $request->validated();
    $check = Reservation::query()
          ->where('schedule_id', $inputs['schedule_id'])
          ->where('sheet_id', $inputs['sheet_id'])
          ->first();
    if($check) {
      return redirect()->route('admin.reservations')->with('message', 'その座席はすでに予約されています。');
    }
    $user = User::query()
            ->where('name',$inputs['name'])
            ->first();

    $date = new Carbon('now');

    $reservation=new Reservation;
    $reservation->name=$inputs['name'];
    $reservation->email=$inputs['email'];
    $reservation->schedule_id=$inputs['schedule_id'];
    $reservation->sheet_id=$inputs['sheet_id'];
    $reservation->date=$date->format('Y-m-d');
    $reservation->save();
    return redirect()->route('admin.reservations')->with('message', '予約作成しました。');
  }

  // 編集画面表示
  public function edit($id)
  {
    $movies = Movie::get();
    $Schedules = Schedule::get();
    $sheets = Sheet::get();
    $reservation=Reservation::find($id);
    return view('reservationsEdit', ['sheets' => $sheets, 'movies' => $movies, 'schedules' => $Schedules, 'reservation' => $reservation]);
  }

  // 更新
  public function update(UpdateAdminReservationRequest $request, $reservationId)  
  { 
    try {
      $inputs = $request->validated();
      $reservation= Reservation::find($reservationId);
      $date = new Carbon('now');

      $reservation->name=$inputs['name'];
      $reservation->email=$inputs['email'];
      $reservation->schedule_id=$inputs['schedule_id'];
      $reservation->sheet_id=$inputs['sheet_id'];
      $reservation->date=$date->format('Y-m-d');

      $reservation->save();
      return redirect()->route('admin.reservations')->with('message', '予約変更しました。');
    }
     catch (\Throwable $e) {
      return redirect()->route('admin.reservations')->with('message', 'その座席はすでに予約されています。');
    }
    
  }

  // 削除
  public function destroy($id)
  {
    $reservation=Reservation::find($id);
    if($reservation) {
      $reservation->delete();
      return redirect()->route('admin.reservations')->with('message', '予約を削除しました。');
    } else {
      return abort(404);
    }
  }


}