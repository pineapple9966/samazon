@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <span>
          <a href="{{ route('mypage.index') }}">マイページ</a> > <a href="{{ route('mypage.orders.index') }}">注文履歴</a> > お届け先変更
        </span>

        <h1 class="mt-3">注文履歴詳細</h1>

        <h4 class="mt-3">ご注文情報</h4>

        <hr>

        <div class="row">
          <div class="col-5 mt-2">
            注文番号
          </div>
          <div class="col-7 mt-2">
            {{ $order->payment_intent_id }}
          </div>

          <div class="col-5 mt-2">
            注文日時
          </div>
          <div class="col-7 mt-2">
            {{ $order->created_at }}
          </div>

          <div class="col-5 mt-2">
            合計金額
          </div>
          <div class="col-7 mt-2">
            {{ $order->total_amount }}円
          </div>

          <div class="col-5 mt-2">
            点数
          </div>
          <div class="col-7 mt-2">
            {{ $order->purchaseHistory->count() }}点
          </div>
        </div>

        <hr>

        <div class="row">
          @foreach ($order->purchaseHistory as $ph)
            <div class="col-md-5 mt-2">
              <a href="{{ route('products.show', $ph->product->id) }}" class="ml-4">
                <img src="{{ Storage::url($ph->product->photo) }}" class="img-fuild w-75">
              </a>
            </div>
            <div class="col-md-7 mt-2">
              <div class="flex-cloumn">
                <p class="mt-4">{{ $ph->product->name }}</p>
                <div class="row">
                  <div class="col-2 mt-2">
                    価格
                  </div>
                  <div class="col-10 mt-2">
                    ￥{{ $ph->product->price }}
                  </div>

                  <div class="col-2 mt-2">
                    数量
                  </div>
                  <div class="col-10 mt-2">
                    {{ $ph->qty }}
                  </div>

                  <div class="col-2 mt-2">
                    小計
                  </div>
                  <div class="col-10 mt-2">
                    ￥{{ $ph->amount }}
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection