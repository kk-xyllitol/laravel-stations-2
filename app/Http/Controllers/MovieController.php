<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Requests\CreateMovieRequest;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{  
  // 一覧表示
  public function movies(Request $request)
  {    
    $keyword = $request->input('keyword');
    $is_showing = $request->input('is_showing');

    $movies = Movie::query()
          ->when(isset($keyword), function($query) use ($keyword) {
            // 作品データの変数名は、 view に渡している変数名と合わせて適宜変更してください
            // dd("title = '$keyword'");
            return $query->whereRaw("title = '$keyword'");
            //return $query->whereRaw("title = '$keyword'");
          })->when(isset($is_showing), function($query) use ($is_showing) {
            return $query->where('is_showing', $is_showing);
          })->paginate(20);
    
    return view('movies', ['movies' => $movies]);
  }

  // 一覧表示（管理者画面）
  public function adminMovies()
  { 
    $movie = Movie::get();
    return view('adminMovies', ['movies' => $movie]);
  }

  // 詳細表示
  public function detail($id)
  {    
    $movies=Movie::find($id);
    $schedules = Schedule::query()
      ->where('movie_id', $id)
      ->orderBy('start_time','asc')
      ->get();
    return view('detail', ['movies' => $movies, 'schedules' => $schedules]);
  }

  // 詳細表示（管理者画面）
  public function adminDetail($id)
  {    
    $movies=Movie::find($id);
    $schedules = Schedule::query()
      ->where('movie_id', $id)
      ->orderBy('start_time','asc')
      ->get();
    return view('adminDetail', ['movies' => $movies, 'schedules' => $schedules]);
  }

  // 作成画面画面表示
  public function create()
  {        
    return view('create');
  }

  // 作成
  public function store(CreateMovieRequest $request)  
  { 
    DB::beginTransaction();
    try {
      $inputs = $request->validated();
      $genre_check = Genre::where('name', $inputs['genre'])->first();

      $movie = new Movie;
      $movie->title = $inputs->title;
      $movie->image_url = $inputs['image_url'];
      $movie->published_year = $inputs['published_year'];
      $movie->is_showing = $inputs['is_showing'];
      $movie->description = $inputs['description'];

      if (!$genre_check) {
        $genre=new Genre;
        $genre->name=$inputs['genre'];
        $genre->save();
        $movie->genre_id=$genre->id;
      } else {
        $movie->genre_id=$genre_check->id;
      }
      
      $movie->save();
      DB::commit();
    } catch (\Throwable $e) {
      DB::rollBack();
      abort(500);
     }
     return redirect('/admin/movies');
  }

  // 編集画面表示
  public function edit($id)
  {
    $movie=Movie::find($id);
    return view('edit', ['movies' => $movie]);
  }

  // 更新
  public function update(UpdateMovieRequest $request, $id)
  {
    try {
      DB::beginTransaction();
      $inputs = $request->validated();
      $genre_check = Genre::where('name', $inputs['genre'])->first();

      $movie=Movie::find($id);
      $movie->title=$inputs['title'];
      $movie->image_url=$inputs['image_url'];
      $movie->published_year=$inputs['published_year'];
      $movie->is_showing=$inputs['is_showing'];
      $movie->description=$inputs['description'];

      if (!$genre_check) {
        $genre=new Genre;
        $genre->name=$inputs['genre'];
        $genre->save();
        $movie->genre_id=$genre->id;        
      } else {
        $movie->genre_id=$genre_check->id;
      }
      
      $movie->save();
      DB::commit();
    }
     catch (\Throwable $e) {
      DB::rollBack();
      abort(500);
    }
    return redirect('/admin/movies');
  }

  // 削除
  public function destroy($id)
  {
    $movie=Movie::find($id);
    if($movie) {
      $movie->delete();
      return redirect('/admin/movies');
    } else {
      return abort(404);
    }
  }
}