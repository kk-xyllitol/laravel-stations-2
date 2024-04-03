<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スケジュール追加</title>
</head>
<body>
<h1>スケジュールを登録</h1>
  @if (session('flash_message'))
    <div class="flash_message">
      {{ session('flash_message') }}
    </div>
  @endif
  @if ($errors->any())
    <div>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form action="store" method="POST">
  @csrf
    <div>
      <input type="hidden" name="movie_id" value={{$id}}>
      <label for="screen_id">{{ __('スクリーン') }}</label>
      <select name="screen_id" id="screen_id">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select>
      <label for="start_time_date">{{ __('開始日付') }}</label>
      <input type="date" name="start_time_date">
      <label for="start_time_time">{{ __('開始時刻') }}</label>
      <input type="time" name="start_time_time">
      <label for="end_time_date">{{ __('終了日付') }}</label>
      <input type="date" name="end_time_date">
      <label for="end_time_time">{{ __('終了時刻') }}</label>
      <input type="time" name="end_time_time">
      <button type="submit">{{ __('登録') }}</button>
    </div>
  </form>
</body>
</html>