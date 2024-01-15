<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__menu">
            <div class="nav">
                <label for="drawer__input" class="drawer__open" style="cursor: default"><span></span></label>
            </div>
            <!-- ロゴ部分 -->
            <div class="header__logo">
                Rese
            </div>
        </div>
    </header>

    <main>
        @yield('content')
        @stack('scripts')
    </main>
</body>

</html>