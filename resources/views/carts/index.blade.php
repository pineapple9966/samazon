@extends('layouts.app')

@section('javascript')
  <script>
    $(function () {
      function deleteCart(cartIds) {
        $.ajax({
          headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          url: '/carts',
          method: 'delete',
          data: { cart_ids: cartIds }
        }).done(function (response) {
          location.reload();
        })
      }

      $('.all-delete-btn').click(function () {
        if (confirm('商品をすべて削除してもよろしいですか？')) {
          const cartIds = $('.delete-btn').map(function () {
            return $(this).data('cart_id');
          }).get();
          deleteCart(cartIds);
        }
      });

      $('.delete-btn').click(function () {
        const cartId = [$(this).data('cart_id')];
        deleteCart(cartId);
      });

      $('.payment-btn').click(function () {
        if (!('{{ Auth::user()->stripe_customer_id }}')) {
          alert('クレジットカードを登録してください');
          return false;
        }

        if (confirm('購入を確定してもよろしいですか？')) {
          $.ajax({
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: '/payment',
            method: 'post',
            data: { amount: '{{ Auth::user()->cartTotalAmount() }}' },
          }).done(function (response) {
            if (response['status'] === 'failed') {
              $('.error').text('');
              $('.succeeded').text('');
              let found = false;
              $('.error').each(function () {
                if ($(this).attr('id') === response['stripeCode']) {
                  $(this).text(response['message']);
                  found = true;
                }
              });
              if (!found) {
                $('#other-error').text('入力情報に誤りがあります');
              }
              console.log(response['status'])
              console.log(response['message'])
            } else {
              $('.error').text('');
              $('.succeeded').text('');
              console.log('success');
              $(`#customer_id_succeeded`).text(response['status']);
              location.reload();
            }
          });
        }
      });
    });
  </script>
@endsection

@section('style')
  <style>
      #qty {
          width: 3em;
      }
  </style>
@endsection

@section('content')
  <div class="container d-flex justify-content-center mt-3">
    <div class="w-75">
      @if (Auth::user()->carts->count() > 0)
        <h1>ショッピングカート</h1>

        <div class="row">
          <div class="offset-8 col-4">
            <div class="row">
              <div class="col-6">
                <h2>数量</h2>
              </div>
              <div class="col-6">
                <h2>合計</h2>
              </div>
            </div>
          </div>
        </div>

        <hr>

        <div class="row">
          @foreach (Auth::user()->carts as $cart)
            <div class="col-md-2 mt-2">
              <a href="{{ route('products.show', $cart->product->id) }}">
                <img src="{{ Storage::url($cart->product->photo) }}" class="img-fuild w-100">
              </a>
            </div>
            <div class="col-md-6 mt-4">
              <h3 class="mt-4">{{ $cart->product->name }}</h3>
            </div>
            <div class="col-md-2">
              <h3 class="w-100 mt-4">{{ $cart->qty }}</h3>
            </div>
            <div class="col-md-2">
              <h3 class="w-100 mt-4">￥{{ $cart->sum() }}</h3>
            </div>
          @endforeach
        </div>

        <hr>

        <div class="offset-8 col-4">
          <div class="row">
            <div class="col-6">
              <h2>合計</h2>
            </div>
            <div class="col-6">
              <h2>￥{{ floor(Auth::user()->cartTotalAmount() * 1.10) }}</h2>
            </div>
            <div class="col-12 d-flex justify-content-end">
              表示価格は税込みです
            </div>
          </div>
        </div>

        <form method="post" action="{{ route('payment') }}" class="d-flex justify-content-end mt-3">
          @csrf
          <input type="hidden" name="_method" value="DELETE">
          <a href="/" class="btn samazon-favorite-button border-dark text-dark mr-3">
            買い物を続ける
          </a>
          <div class="btn samazon-submit-button payment-btn">購入を確定する</div>
        </form>
      @else
        現在カートに商品はありません
      @endif
    </div>
  </div>
@endsection