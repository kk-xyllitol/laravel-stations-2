<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\Schedule;
use App\Http\Requests\UpdateScheduleRequest;
use App\Http\Requests\CreateScheduleRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
  public function show()
  {
    $schedules = Schedule::all();
    $movies = Movie::whereHas('schedules')
      ->with(['schedules' => function ($query) {
        $query->orderBy('start_time');
      }])
      ->get();
    return view('schedules', ['schedules' => $schedules, 'movies' =>$movies]); 
  }

  public function detail($id)
  {    
    $movies=Movie::find($id);
    $schedules = Schedule::query()
      ->orderBy('start_time','asc')
      ->get();
    return view('detail', ['movies' => $movies, 'schedules' => $schedules]);
  }

  // 作成画面画面表示
  public function create($id)
  {        
    return view('schedulesCreate', ['id' => $id]);
  }

  // 作成
  public function store(CreateScheduleRequest $request)  
  { 
    try {
      // モデルの中に分割させる
      DB::beginTransaction();
      $inputs = $request->validated();
      $movie_id = $inputs['movie_id'];
      $screen_id = $inputs['screen_id'];
      $start_time_date = $inputs['start_time_date'];
      $start_time_time = $inputs['start_time_time'];
      $start_time_check = new Carbon("$start_time_time");
      $start_time = new Carbon("$start_time_date $start_time_time");
      $end_time_date = $inputs['end_time_date'];
      $end_time_time = $inputs['end_time_time'];
      $end_time_check = new Carbon("$end_time_time");
      $end_time = new Carbon("$end_time_date $end_time_time");

      $check = Schedule::query()
             -> where('screen_id', $screen_id)
             ->where(function($query) use($start_time, $end_time){
              $query->whereBetween('start_time', [$start_time, $end_time])
                    ->orWhereBetween('end_time', [$start_time, $end_time]);})
             ->first();

      if ($check) {
        $validator = Validator::make($request->all(), []);

        $validator->errors()->add('start_time_time', 'その時間帯は上映予定があります。');
        return back()->withInput()->withErrors($validator);
      }

      $diffInSeconds = $start_time_check->diffInSeconds($end_time_check);

      if ($diffInSeconds<=300) {
        $validator = Validator::make($request->all(), []);

        $validator->errors()->add('start_time_time', '開始時刻と終了時刻の差が 5 分以下です。');
        $validator->errors()->add('end_time_time', '開始時刻と終了時刻の差が 5 分以下です。');
        return back()->withInput()->withErrors($validator);
      }

      $schedule=new Schedule;
      // コンストラクタでインスタンスを初期設定する

        $schedule->movie_id=$movie_id;
        $schedule->screen_id=$screen_id;
        $schedule->start_time=$start_time;
        $schedule->end_time=$end_time;
        
        $schedule->save();

      DB::commit();
    }
     catch (\Throwable $e) {
      DB::rollBack();
      abort(500);
     }
     return redirect('/admin/schedules');
  }

  // 編集画面表示
  public function edit($scheduleId)
  {
    $schedule=Schedule::find($scheduleId);
    return view('schedulesEdit', ['schedule' => $schedule]);
  }

  // 更新
  public function update(UpdateScheduleRequest $request, $scheduleId)  
  { 
    try {
      DB::beginTransaction();
      $inputs = $request->validated();
      $start_time_date = $inputs['start_time_date'];
      $start_time_time = $inputs['start_time_time'];
      $start_time_check = new Carbon("$start_time_time");
      $start_time = new Carbon("$start_time_date $start_time_time");
      $end_time_date = $inputs['end_time_date'];
      $end_time_time = $inputs['end_time_time'];
      $end_time_check = new Carbon("$end_time_time");
      $end_time = new Carbon("$end_time_date $end_time_time");


      $check = Schedule::query()
             -> where('id','!=', $scheduleId)
             ->where(function($query) use($start_time, $end_time){
              $query->whereBetween('start_time', [$start_time, $end_time])
                    ->orWhereBetween('end_time', [$start_time, $end_time]);})
             ->first();

      if ($check) {
        $validator = Validator::make($request->all(), []);

        $validator->errors()->add('start_time_time', 'その時間帯は上映予定があります。');
        return back()->withInput()->withErrors($validator);
      }

      $diffInSeconds = $start_time_check->diffInSeconds($end_time_check);

      if ($diffInSeconds<=300) {
        $validator = Validator::make($request->all(), []);

        $validator->errors()->add('start_time_time', '開始時刻と終了時刻の差が 5 分以下です。');
        $validator->errors()->add('end_time_time', '開始時刻と終了時刻の差が 5 分以下です。');
        return back()->withInput()->withErrors($validator);
      }

      $schedule= Schedule::find($scheduleId);

      // dd($schedule);


      $schedule->movie_id=$request['movie_id'];
      $schedule->start_time=$start_time;
      $schedule->end_time=$end_time;
      
      $schedule->save();
      DB::commit();
    }
     catch (\Throwable $e) {
      DB::rollBack();
      abort(500);
    }
    return redirect('/admin/schedules');
  }

  // 削除
  public function destroy($id)
  {
    $schedule=Schedule::find($id);
    if($schedule) {
      $schedule->delete();
      return redirect('/admin/schedules');
    } else {
      return abort(404);
    }
  }
}

