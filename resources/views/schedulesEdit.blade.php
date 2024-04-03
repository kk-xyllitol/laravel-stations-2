<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール編集</title>
</head>
<body>
<h1>スケジュールを編集</h1>
  @if ($errors->any())
    <div>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form action="update" method="POST">
  @method('PATCH')
  @csrf
    <div>
      <input type="hidden" name="movie_id" value="{{$schedule->movie_id}}">
      <label for="screen_id">{{ __('スクリーン') }}</label>
      <select name="screen_id" id="screen_id">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select>
      <label for="start_time_date">{{ __('開始日付') }}</label>
      <input type="date" name="start_time_date" value="{{$schedule->start_time->format('Y-m-d')}}">
      <label for="start_time_time">{{ __('開始時間') }}</label>
      <input type="time" name="start_time_time" value="{{$schedule->start_time->format('H:i')}}">
      <label for="end_time_date">{{ __('終了日付') }}</label>
      <input type="date" name="end_time_date" value="{{$schedule->end_time->format('Y-m-d')}}">
      <label for="end_time_time">{{ __('終了日') }}</label>
      <input type="time" name="end_time_time" value="{{$schedule->end_time->format('H:i')}}">
      <button type="submit">{{ __('更新') }}</button>
    </div>
  </form>
</body>
</html>