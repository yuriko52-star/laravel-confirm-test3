<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>step1</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register1.css') }}">
</head>
<body>
<main>
    <div class="content">
        <div class="register-title__group">
            <h2 class="title">PiGLy</h2>
            <h3 class="register__heading">新規会員登録</h3>
            <h4 class="info__regisrer">step1 アカウント情報の登録</h4>
        </div>
        <form action="{{ route('register.step1') }}" class="register__form" method="post" >
        @csrf
        <div class="form__group">
            <label class="form__group-label">お名前</label>
            <input type="text" class="form__group-input"name="name" value="{{ old('name')}}">
            <p>
                @error('name')
                {{ $message }}
                @enderror
            </p>
            <label class="form__group-label">メールアドレス</label>
            <input type="email" class="form__group-input"name="email" value="{{ old('email') }}">
           <p>
                @error('email')
                {{$message}}
                 @enderror
           </p>
            <label class="form__group-label">パスワード</label>
            <input type="password" class="form__group-input" name="password" >
            <p>
                @error('password')
                {{$message}}
                @enderror
            </p>
        </div>
        <div class="button__item">
            <button class="next__button" type="submit">
                 次に進む
            </button>
            <a href="/login" class="login__link">ログインはこちら</a>
        </div>
        </form>
    </div>
</main>
</body>
</html>
