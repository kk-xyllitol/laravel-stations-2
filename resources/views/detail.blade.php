<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>詳細</title>
</head>
<body>
  <h1>{{ $movies->title }}</h1> 
  @if (Session::has('message'))
    <p>{{ session('message') }}</p>
  @endif
  <img src="{{ $movies->image_url }}" alt="">
  <h4>発行年 {{ $movies->published_year }}</h4> 
  <h4>ジャンル {{ $movies->genre->name }}</h4> 
  <p>詳細</p>
  <div>{{ $movies->description }}</div>
  <h4>上映スケジュール</h4> 

  @foreach ($schedules as $schedule)
  <div>{{ $schedule->start_time->format('H:i') }} ～ {{ $schedule->end_time->format('H:i') }}</div>
  <button type="button" onclick="location.href='/movies/{{$movies->id}}/schedules/{{$schedule->id}}/sheets?date={{$schedule->start_time->format('Y-m-d')}}'">座席を予約する</button>
  @endforeach
  <div><a href="/movies">{{ __('映画一覧へ') }}</a></div>

</body>
</html>