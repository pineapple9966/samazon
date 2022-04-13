@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <span>
          <a href="{{ route('mypage.index') }}">マイページ</a> > お届け先変更
        </span>

        <div class="container mt-4">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">注文番号</th>
                <th scope="col">購入日時</th>
                <th scope="col">合計金額</th>
                <th scope="col">詳細</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
                <tr>
                  <td>{{ $order->payment_intent_id }}</td>
                  <td>{{ $order->created_at }}</td>
                  <td>{{ $order->total_amount }}</td>
                  <td>
                    <a href="{{ route('mypage.orders.show', $order->id) }}">
                      {{ $order->id }}
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{ $orders->links('vendor.pagination.bootstrap-4') }}
      </div>
    </div>
  </div>
@endsection