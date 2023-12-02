<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__menu">
            <!-- ハンバーガーメニュー部分 -->
            <div class="nav">
                <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
                <input id="drawer__input" class="drawer__hidden" type="checkbox">
                <!-- ハンバーガーアイコン -->
                <label for="drawer__input" class="drawer__open"><span></span></label>

                <nav class="nav__content">
                    <ul class="nav__list">
                        <!-- メニュー（未ログイン時） -->
                        @guest
                        <li class="nav__item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="nav__item"><a href="{{ route('getRegister') }}">Registration</a></li>
                        <li class="nav__item"><a href="{{ route('getLogin') }}">Login</a></li>
                        @endguest
                        <!-- メニュー（ログイン時） -->
                        @auth
                        <li class="nav__item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="nav__item"><a href="{{ url('logout') }}">Logout</a></li>
                        <li class="nav__item"><a href="{{ route('mypage') }}">Mypage</a></li>
                        @endauth
                    </ul>
                </nav>
            </div>

            <!-- ロゴ部分 -->
            <div class="header__logo">
                Rese
            </div>
            <!-- 検索フォーム部分 -->
            @yield('search')
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>