<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>step2</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/register2.css') }}">
</head>
<body>
    <main>
    <div class="content">
        <div class="register-title__group">
            <h2 class="title">PiGLy</h2>
            <h3 class="register__heading">新規会員登録</h3>
            <h4 class="info__regisrer">step2 体重データの入力</h4>
        </div>
       <form action="{{ route('register.2') }}" 
        class="register__form"method="post">
       @csrf
        <div class="form__group">
                <label class="form__group-label">現在の体重</label>
                <input type="text" class="form__group-input"name="current_weight" value="{{ old('current_weight') }}"><span>kg</span>
                 <p>
                    @error('current_weight')
                    {{ $message }}
                    @enderror
                 </p>
                <label class="form__group-label">目標の体重</label>
                <input type="text" class="form__group-input" name="target_weight" value="{{ old('target_weight') }}"><span>kg</span>
                <p>
                    @error('target_weight')
                    {{ $message }}
                    @enderror
                </p>
            </div>     
            <div class="button__item">
               <button class="next__button" type="submit"> アカウント作成
            </button>

    </main>
</body>
</html>