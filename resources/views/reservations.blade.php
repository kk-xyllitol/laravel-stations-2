<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>予約一覧</title>
</head>
<body>
<h1>予約一覧</h1>
@if (Session::has('message'))
  <p>{{ session('message') }}</p>
@endif
<button type="button" onclick="location.href='/admin/reservations/create'">予約を作成する</button>
<table border="1">
    <tr>
      <th>ID</th>
      <th></th>
      <th>映画作品</th>
      <th>座席</th>
      <th>開始日時</th>
      <th>終了日時</th>
      <th>名前</th>
      <th>メールアドレス</th>
    </tr>
    @foreach ($reservations as $reservation)
    @if ( $reservation->schedule->start_time > date("Y-m-d H:i:s"))
      <tr>
        <td>{{ $reservation->id }}</td>
        <td>
          <button type="button" onclick="location.href='/admin/reservations/{{ $reservation->id }}/edit'">編集</button>
        </td>
        <td>{{ $reservation->schedule->movie->title }}</td>
        <td>{{ strtoupper($reservation->sheet->row) }}{{ $reservation->sheet->column }}</td>
        <td>{{ $reservation->schedule->start_time }}</td>
        <td>{{ $reservation->schedule->end_time }}</td>
        <td>{{ $reservation->name }}</td>
        <td>{{ $reservation->email }}</td>
      </tr>
    @endif
    @endforeach
  </table>
</body>
</html>