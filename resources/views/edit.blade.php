<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編集</title>
</head>
<body>
<h1>投稿を編集</h1>
  @if ($errors->any())
      <div>
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  @if ($movies)
  <form action="update" method="POST">
  @method('PATCH')
  @csrf
    <fieldset>
      <div>
        <label for="title">{{ __('映画タイトル') }}</label>
        <input type="text" name="title" value="{{$movies->title}}">
        <label for="image_url">{{ __('画像URL') }}</label>
        <input type="url" name="image_url" value="{{$movies->image_url}}">
        <label for="published_year">{{ __('公開年') }}</label>
        <label for="genre">{{ __('ジャンル') }}</label>
        <input type="text" name="genre" value="{{$movies->genre->name}}">
        <input type="number" name="published_year" value="{{$movies->published_year}}">
        <label for="is_showing">{{ __('公開中かどうか') }}</label>
        <input type="hidden" name="is_showing" value="0">
        @if ($movies->is_showing)
        <input type="checkbox" id="true" name="is_showing" value="1" checked="checked"/>
        @else
        <input type="checkbox" id="true" name="is_showing" value="1"/>
        @endif
        <label for="description">{{ __('詳細') }}</label>
        <textarea name="description" cols="30" rows="10">{{$movies->description}}</textarea>
        <button type="submit">{{ __('更新') }}</button>
      </div>
    </fieldset>
  </form>
  @else
    <p>映画情報が見つかりません。</p>
  @endif

</body>
</html>