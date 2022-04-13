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
    });
  </script>
@endsection

@section('content')
  <div class="w-75">

    <h1>受注一覧</h1>

    <div class="w-75">
      <form action="{{ route('admin.orders.index') }}">
        <div class="d-flex flex-inline form-group">
          <div class="d-flex align-items-center">
            注文番号
          </div>
          <input id="search-products" name="keyword" class="form-controll ml-2 w-50" placeholder="123456789" value="{{ request()->input('keyword', '') }}" />
        </div>
        <button type="submit" class="btn samazon-submit-button">検索</button>
      </form>
    </div>

    <table class="table mt-5">
      <thead>
      <tr>
        <th scope="col" class="w-25">注文番号</th>
        <th scope="col">注文者名</th>
        <th scope="col">注文日時</th>
        <th scope="col">購入金額</th>
      </tr>
      </thead>
      <tbody>
      @foreach ($orders as $order)
        <tr>
          <td class="align-middle" scope="row">{{ $order->payment_intent_id }}</td>
          <td class="align-middle">{{ $order->user->name }}</td>
          <td class="align-middle">{{ $order->created_at }}</td>
          <td class="align-middle">{{ $order->total_amount }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>

    {{ $orders->links('vendor.pagination.bootstrap-4') }}
  </div>
@endsection