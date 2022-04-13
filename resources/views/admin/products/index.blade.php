@extends('layouts.dashboard')

@section('javascript')
  <script>
    $(function () {
      // 並び替えセレクトボックスのオプションの値を１つ１つチェックする
      $('select[name=order_by] option').each(function () {
        // オプションの値が、直前に選択されたオプションの値であるか調べる
        if ($(this).val() === '{{ request()->input('order_by') }}') {
          // オプションの値が、直前に選択されたオプションの値である場合、selected属性を追加する
          $(this).attr('selected', true);
        }
      });

      // 並び替えセレクトボックスの値が変更された際の処理
      $('select[name=order_by]').change(function () {
        // id="search-form"のformタグを取得
        const $form = $('#search-form');
        // formタグのaction属性のURLにリクエストする
        $form.submit();
      });

      // ページのリンクをクリックした際の処理
      $('.page-link').click(function () {
        // ページ番号を表すinputタグのvalue属性の値を、クリックされたページの値にする
        $('input[name=page]').val($(this).data('page'));
        // id="order-form"のformタグを取得
        const $form = $('#search-form');
        // formタグのaction属性のURLにリクエストする
        $form.submit();
        // aタグのリンクの効果を無効にする
        return false;
      });

      $('.dashboard-delete-link').click(function () {
        if (confirm('削除してもよろしいですか？')) {
          const $form = $('#delete-form');
          $form.attr('action', $(this).data('action'));
          $form.submit();
        }
        return false;
      });
    });
  </script>
@endsection

@section('content')
  <h1>商品管理</h1>
  <form id="search-form" action="{{ route('admin.products.index')}}" class="form-inline">
    並び替え
    <input type="hidden" name="page" value="1">
    <select name="order_by">
      <option value="id asc">並び替え</option>
      <option value="price asc">価格の安い順</option>
      <option value="price desc">価格の高い順</option>
      <option value="created_at asc">出品の古い順</option>
      <option value="created_at desc">出品の新しい順</option>
    </select>
  </form>

  <div class="w-75 mt-2">
    <div class="w-75">
      <form action="{{ route('admin.products.index') }}">
        <div class="d-flex flex-inline form-group">
          <div class="d-flex align-items-center">
            商品ID・商品名
          </div>
          <textarea id="search-products" name="keyword" class="form-controll ml-2 w-50">{{ request()->input('keyword') }}</textarea>
        </div>
        <button type="submit" class="btn samazon-submit-button">検索</button>
      </form>
    </div>

    <form id="delete-form" method="post">
      @csrf
      @method('delete')
    </form>

    <div class="d-flex justify-content-between w-75 mt-4">
      <h3>合計{{ $products->total() }}件</h3>

      <a href="{{ route('admin.products.create') }}" class="btn samazon-submit-button">+ 新規作成</a>
    </div>
    <table class="table table-responsive mt-5">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">画像</th>
          <th scope="col">商品名</th>
          <th scope="col">価格</th>
          <th scope="col">カテゴリ名</th>
          <th scope="col">親カテゴリ名</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $product)
          <tr>
            <td scope="row">{{ $product->id }}</td>
            <td><img src="{{ Storage::url($product->photo) }}" class="img-thumbnail w-100"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->category->majorCategory->name }}</td>
            <td>
              <a href="{{ route('admin.products.edit', $product->id) }}" class="dashboard-edit-link">編集</a>
            </td>
            <td>
              <a href="" class="dashboard-delete-link" data-action="{{ route('admin.products.destroy', $product->id) }}">
                削除
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{ $products->links('vendor.pagination.bootstrap-4') }}
  </div>
@endsection