<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>座席</title>
</head>
<body>
  <h1>スクリーン</h1>
  <table border="1">
    @foreach ($sheets as $sheet)
        @if ( $sheet->column%5==1 )
          <tr>
            <td>{{$sheet->row}}-{{$sheet->column}}</td>
        @elseif ( $sheet->column%5==0 )
            <td>{{$sheet->row}}-{{$sheet->column}}</td>
          </tr>
        @else
          <td>{{$sheet->row}}-{{$sheet->column}}</td>
        @endif
    @endforeach
  </table>
</body>
</html>