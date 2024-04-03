<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>予約編集</title>
</head>
<body>
<h1>予約を編集（管理者）</h1>
  @if ($errors->any())
    <div>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form action="/admin/reservations/{{$reservation->id}}" method="POST">
  @method('PATCH')
  @csrf
    <div>
      <label for="movie_id">{{ __('映画作品') }}</label>
      <select name="movie_id" id="movie_id">
      @foreach ($movies as $movie)
        @if ($movie->id == $reservation->schedule->movie_id)
          <option value="{{ $movie->id }}" selected>
        @else
          <option value="{{ $movie->id }}">
        @endif
        {{ $movie->title }}
        </option>
      @endforeach
      </select>
      <label for="schedule_id">{{ __('日時') }}</label>
      <select name="schedule_id" id="schedule_id">
      @foreach ($schedules as $schedule)
        @if ($schedule->id == $reservation->schedule_id)
          <option value="{{ $schedule->id }}" selected>
        @else
          <option value="{{ $schedule->id }}">
        @endif
        {{ $schedule->movie->title }} {{ $schedule->start_time }}</option>
      @endforeach
      </select>
      <label for="sheet_id">{{ __('座席') }}</label>
      <select name="sheet_id" id="sheet_id">
      @foreach ($sheets as $sheet)
        @if ($sheet->id == $reservation->sheet_id)
          <option value="{{ $sheet->id }}" selected>
        @else
          <option value="{{ $sheet->id }}">
        @endif
        {{$sheet->row}}-{{$sheet->column}}</option>
      @endforeach
      </select>
      <label for="name">{{ __('予約者氏名') }}</label>
      <input type="text" name="name" value="{{ $reservation->name }}">
      <label for="email">{{ __('予約者メールアドレス') }}</label>
      <input type="email" name="email" value="{{ $reservation->email }}">
      <button type="submit">{{ __('予約変更') }}</button>
    </div>
  </form>
  <form action="{{ route('admin.reservations.destroy', ['id'=>$reservation->id]) }}" method="POST">
  @method('DELETE')
  @csrf
    <div>
      <button type="submit">{{ __('削除する') }}</button>
    </div>
  </form>
</body>
</html>