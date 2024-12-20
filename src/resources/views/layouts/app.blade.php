<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pigly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" >
    @yield('css')

</head>
<body>
    <header class="header">
        <div class="header__utilities">
            <div class="header__logo">
                PiGLy
            </div>
            <div class="header__link-group">
                <div class="header__link-item">
                <img src="{{ asset('/images/設定の歯車アイコン素材 1.png')}}" alt="" class="">
                <a href="{{ route('goal.setting') }}" class="target-weight__link">目標体重設定</a>
                </div>
                <div class="header__link-item">
                <img src="{{ asset('/images/ログアウト・サインアウトのアイコン素材 4 (1).png') }}" alt="" class="">
                <a href="" class="log__link">ログアウト
                </a>
                </div>
            </div>
        </div>
 </header>
<main>
@yield('content')
</main>
    
</body>
</html>