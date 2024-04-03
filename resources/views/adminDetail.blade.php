<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>詳細（管理者）</title>
</head>
<body>
  <h1>{{ $movies->title }}</h1> 
  <img src="{{ $movies->image_url }}" alt="">
  <h4>発行年 {{ $movies->published_year }}</h4> 
  <h4>ジャンル {{ $movies->genre->name }}</h4> 
  <p>詳細</p>
  <div>{{ $movies->description }}</div>
  <h4>上映予定</h4> 
  <button type="button" onclick="location.href='{{$movies->id}}/schedules/create'">スケジュールを作成</button>
  @foreach ($schedules as $schedule)
  <div>{{ $schedule->start_time }} ～ {{ $schedule->end_time }}</div>

  @endforeach
  
</body>
</html>