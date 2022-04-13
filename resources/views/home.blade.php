@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-2">
      @component('components.sidebar', ['categories' => $categories])
      @endcomponent
    </div>
    <div class="col-9">
      <h1>おすすめ商品</h1>
      <div class="row">
        @foreach ($recommends as $product)
          <div class="col-4">
            <a href="{{ route('products.show', $product->id) }}">
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

      <h1>新着商品</h1>
      <div class="row">
        @foreach ($newArrivals as $product)
          <div class="col-3">
            <a href="{{ route('products.show', $product->id) }}">
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
    </div>
  </div>
@endsection