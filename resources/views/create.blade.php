<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>映画登録</title>
</head>
<body>
<h1>映画情報を登録</h1>
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
      <label for="title">{{ __('映画タイトル') }}</label>
      <input type="text" name="title">
      <label for="image_url">{{ __('画像URL') }}</label>
      <input type="url" name="image_url">
      <label for="published_year">{{ __('公開年') }}</label>
      <input type="number" name="published_year">
      <label for="genre">{{ __('ジャンル') }}</label>
      <input type="text" name="genre">
      <label for="is_showing">{{ __('公開中かどうか') }}</label>
      <input type="hidden" name="is_showing" value="0">
      <input type="checkbox" id="true" name="is_showing" value="1" />
      <label for="description">{{ __('詳細') }}</label>
      <textarea name="description" cols="30" rows="10"></textarea>
      <button type="submit">{{ __('登録') }}</button>
    </div>
  </form>
</body>
</html>