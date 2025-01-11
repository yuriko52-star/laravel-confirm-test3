<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
  <main>  
<div class="content">
   <div class="login-title__group">
        <h2 class="title">PiGLy</h2>
        <h3 class="login__heading">ログイン</h3>
    </div>
    <form action="/login" class="login__form" method="post">
        @csrf
        <div class="form__group">
            <label class="form__group-label">メールアドレス</label>
            <input type="email" class="form__group-input" name="email" value="{{ old('email') }}">
            <p>
                @error('email')
                {{ $message}}
                @enderror
            </p>
            <label class="form__group-label">パスワード</label>
            <input type="password" class="form__group-input" name="password">
            <p>
                @error('password')
                {{$message}}
                @enderror
            </p>
        </div>
        <div class="button__item">
            <button class="next__button" type="submit">
                ログイン
            </button>
            <a href="{{ route('register.step1') }}" class="login__link">アカウント作成はこちら</a>
        </div>
    </form>
</div>
</main>
</body>
</html>