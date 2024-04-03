<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>一覧</title>
</head>
<body>
  <h1>映画一覧</h1>
  <button type="button" onclick="location.href='/admin/movies/create'">映画情報を追加</button>
  <table border="1">
    <tr>
      <th>映画タイトル</th>
      <th></th>
      <th></th>
      <th>ジャンル</th>
      <th width="150px">画像URL</th>
      <th>公開年</th>
      <th>上映中かどうか</th>
      <th>概要</th>
    </tr>
    @foreach ($movies as $movie)
      <tr>
        <th><a href="movies/{{ $movie->id }}">{{ $movie->title }}</a></th>
        <th><a href="movies/{{ $movie->id }}/edit">{{ __('編集') }}</a></th>
        <th>
          <form action="movies/{{ $movie->id }}/destroy" method="POST">
            @method('DELETE')
            @csrf
              <div>
                <button type="submit">{{ __('削除') }}</button>
              </div>
          </form>
        </th>
        <td>{{ $movie->genre->name }}</td>
        <td><img style="max-width: 150px;" src="{{ $movie->image_url }}" alt=""></td>


        <td>{{ $movie->published_year }}</td>
        <td>
          @if ( $movie->is_showing )
            上映中
          @else
            上映予定
          @endif
        </td>
        <td>{{ $movie->description }}</td>
      </tr>
    @endforeach
  </table>
  <div><a href="/admin/schedules">{{ __('上映一覧へ') }}</a></div>
  <div><a href="/admin/reservations">{{ __('予約一覧へ') }}</a></div>
</body>
</html>