<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Title</title>
  <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style>
    #logo > a {
        color: black;
        text-decoration: none;
    }
  </style>
  @yield('javascript')
  @yield('style')
</head>
<body>
  <h1 id="logo"><a href="{{ route('home') }}">Samazon</a></h1>
  <ul>
    @auth
      <li><a href="{{ route('carts.index') }}">カート</a></li>
      <li><a href="{{ route('favorites.index') }}">お気に入り</a></li>
      <li><a href="{{ route('mypage.index') }}">マイページ</a></li>
    @else
      <li><a href="{{ route('register') }}">新規登録</a></li>
      <li><a href="{{ route('login') }}">ログイン</a></li>
    @endif
  </ul>
  <hr>
  @yield('content')
</body>
</html>