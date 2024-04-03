<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>スケジュール一覧</title>
</head>
<body>
<h1>スケジュール一覧</h1>

@foreach ($movies as $movie)
<h2>{{ $movie->id }}{{ $movie->title }}</h2>
<table border="1">
    <tr>
      <th></th>
      <th></th>
      <th>スクリーン</th>
      <th>開始</th>
      <th>終了</th>
    </tr>
    @foreach ($movie->schedules as $schedule)
      <tr>
        <td><a href="schedules/{{ $schedule->id }}/edit">{{ __('編集') }}</a></td>
        <td>
          <form action="schedules/{{ $schedule->id }}/destroy" method="POST">
            @method('DELETE')
            @csrf
              <div>
                <button type="submit">{{ __('削除') }}</button>
              </div>
          </form>
        </td>
        <td>{{ $schedule->screen_id }}</td>
        <td>{{ $schedule->start_time }}</td>
        <td>{{ $schedule->end_time }}</td>
      </tr>
    @endforeach
  </table>
@endforeach
<div><a href="/admin/movies">{{ __('映画一覧へ') }}</a></div>
<div><a href="/admin/reservations">{{ __('予約一覧へ') }}</a></div>

</body>
</html>