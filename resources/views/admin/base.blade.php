<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Title</title>
  <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script>
    $(function () {
      $('.back-btn').click(function () {
        const $form = $('#form');
        $form.attr('action', $(this).data('action'));
        $form.submit();
      });
    });
  </script>
  @yield('javascript')
</head>
<body>
  <h3>Samazon Admin</h3>
  <hr>
  <div class="row">
    <div class="col-2">
      <ul>
        <li><a href="{{ route('admin.major_categories.index') }}">親カテゴリー一覧</a></li>
        <li><a href="{{ route('admin.categories.index') }}">カテゴリー一覧</a></li>
        <li><a href="{{ route('admin.products.index') }}">商品一覧</a></li>
        <li><a href="{{ route('admin.users.index') }}">顧客一覧</a></li>
        <li><a href="{{ route('admin.orders.index') }}">受注一覧</a></li>
        <li><a href="{{ route('admin.sales.index') }}">売上一覧</a></li>
      </ul>
    </div>
    <div class="col-10">
      <form id="form"></form>
      @yield('content')
    </div>
  </div>
</body>
</html>