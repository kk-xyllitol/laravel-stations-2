<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>座席選択</title>
</head>
<body>
  <h1>座席選択</h1>
  @if (Session::has('message'))
    <p>{{ session('message') }}</p>
  @endif
  <h2>スクリーン</h2>
  <table border="1">
    <tr>
      @foreach ($sheets as $sheet)
        @if ( $sheet->reservations->first())
          <td bgcolor="gray">{{$sheet->row}}-{{$sheet->column}}</td>
        @else
          <td><a href="/movies/{{$movie_id}}/schedules/{{$schedule_id}}/reservations/create?date={{ request()->input('date') }}&sheetId={{$sheet->id}}">{{$sheet->row}}-{{$sheet->column}}</a></td>
        @endif 
        @if ( $sheet->column%5==0 )
          </tr><tr>
        @endif
      @endforeach
    </tr>
  </table>
</body>
</html>