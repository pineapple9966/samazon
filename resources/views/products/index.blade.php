@extends('layouts.app')

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
        // id="order-form"のformタグを取得
        const $form = $('#order-form');
        // formタグのaction属性のURLにリクエストする
        $form.submit();
      });

      // ページのリンクをクリックした際の処理
      $('.page-link').click(function () {
        // ページ番号を表すinputタグのvalue属性の値を、クリックされたページの値にする
        $('input[name=page]').val($(this).data('page'));
        // id="order-form"のformタグを取得
        const $form = $('#order-form');
        // formタグのaction属性のURLにリクエストする
        $form.submit();
        // aタグのリンクの効果を無効にする
        return false;
      });
    });
  </script>
@endsection

@section('content')
  <div class="row">
    <div class="col-2">
      @component('components.sidebar', ['categories' => $categories])
      @endcomponent
    </div>

    <div class="col-9">
      <div class="container">
        @if ($category !== null)
          <a href="/">トップ</a> > <a href="#">{{ $category->majorCategory->name }}</a> > {{ $category->name }}
          <h1>{{ $category->name }}の商品一覧{{ $category->products->count() }}件</h1>
          <form id="order-form" method="GET" action="{{ route('products.index', $category->id) }}" class="form-inline">
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
        @endif
      </div>
      <div class="container mt-4">
        <div class="row w-100">
          @foreach ($products as $product)
            <div class="col-3">
              <a href="{{ route('products.show', $product) }}">
                <img src="{{ Storage::url($product->photo) }}" class="img-thumbnail">
              </a>
              <div class="row">
                <div class="col-12">
                  <p class="samazon-product-label mt-2">
                    {{ $product->name }}<br>
                    <label>￥{{ $product->price }}</label>
                  </p>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        {{ $products->links('vendor.pagination.bootstrap-4') }}
      </div>
    </div>
  </div>
@endsection