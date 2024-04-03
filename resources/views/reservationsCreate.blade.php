<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>予約登録</title>
</head>
<body>
<h1>座席を登録</h1>
  @if ($errors->any())
    <div>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form action="/reservations/store" method="POST">
  @csrf
    <div>
      <input type="hidden" name="movie_id" value={{$movie_id}}>
      <input type="hidden" name="schedule_id" value={{$schedule_id}}>
      <input type="hidden" name="sheet_id" value="{{ request()->input('sheetId') }}">
      <input type="hidden" name="date" value="{{ request()->input('date') }}">
      <label for="name">{{ __('予約者氏名') }}</label>
      <input type="text" name="name" value="{{ old('name') }}">
      <label for="email">{{ __('予約者メールアドレス') }}</label>
      <input type="email" name="email" value="{{ old('email') }}">
      <button type="submit">{{ __('予約登録') }}</button>
    </div>
  </form>
</body>
</html>