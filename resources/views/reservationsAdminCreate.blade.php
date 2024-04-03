<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>予約登録</title>
</head>
<body>
<h1>座席を登録（管理者）</h1>
  @if ($errors->any())
    <div>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form action="/admin/reservations" method="POST">
  @csrf
    <div>
      <label for="movie_id">{{ __('映画作品') }}</label>
      <select name="movie_id" id="movie_id">
      @foreach ($movies as $movie)
        <option value="{{ $movie->id }}">{{ $movie->title }}</option>
      @endforeach
      </select>
      <label for="schedule_id">{{ __('日時') }}</label>
      <select name="schedule_id" id="schedule_id">
      @foreach ($schedules as $schedule)
        <option value="{{ $schedule->id }}">{{ $schedule->movie->title }} {{ $schedule->start_time }}</option>
      @endforeach
      </select>
      <label for="sheet_id">{{ __('座席') }}</label>
      <select name="sheet_id" id="sheet_id">
      @foreach ($sheets as $sheet)
        <option value="{{ $sheet->id }}">{{$sheet->row}}-{{$sheet->column}}</option>
      @endforeach
      </select>
      <label for="name">{{ __('予約者氏名') }}</label>
      <input type="text" name="name">
      <label for="email">{{ __('予約者メールアドレス') }}</label>
      <input type="email" name="email">
      <button type="submit">{{ __('予約登録') }}</button>
    </div>
  </form>
</body>
</html>