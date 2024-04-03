<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ユーザ登録</title>
</head>
<body>

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<form method="POST" action="{{ route('store') }}">
  @csrf

  <!-- Name -->
  <div>
    <x-label for="name" :value="__('ユーザ名')" />

    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
  </div>

  <!-- Email Address -->
  <div class="mt-4">
    <x-label for="email" :value="__('メールアドレス')" />

    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
  </div>

  <!-- Password -->
  <div class="mt-4">
    <x-label for="password" :value="__('パスワード')" />

    <x-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="new-password" />
  </div>

  <!-- Confirm Password -->
  <div class="mt-4">
    <x-label for="password_confirmation" :value="__('パスワード確認')" />

    <x-input id="password_confirmation" class="block mt-1 w-full"
                    type="password"
                    name="password_confirmation" required />
  </div>

  <div class="flex items-center justify-end mt-4">
    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
        {{ __('ログイン') }}
    </a>

    <x-button class="ml-4">
        {{ __('新規登録') }}
    </x-button>
  </div>
</form>
</body>