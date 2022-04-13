@extends('layouts.app')

@section('javascript')
  <script>
    $(function () {
      $('.samazon-favorite-button').click(function () {
        const $form = $('#form');
        $form.attr('action', $(this).data('action'));
        $form.submit();
      });
    });
  </script>
@endsection

@section('content')
  <div class="d-flex justify-content-center">
    <div class="row w-75">
      <div class="col-5 offset-1">
        <img src="{{ Storage::url($product->photo) }}" class="w-100 img-fuild">
      </div>
      <div class="col">
        <div class="d-flex flex-column">
          <h1 class="">
            {{ $product->name }}
          </h1>
          <p class="">
            {{ $product->description }}
          </p>
          <hr>
          <p class="d-flex align-items-end">
            ￥{{ floor($product->price * 1.10) }}(税込)
          </p>
          <hr>
        </div>
        @auth
          <form id="form" method="POST" action="{{ route('carts.add') }}" class="m-3 align-items-end">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="form-group row">
              <label for="quantity" class="col-sm-2 col-form-label">数量</label>
              <div class="col-sm-10">
                <input type="number" id="quantity" name="qty" min="1" value="1" class="form-control w-25">
              </div>
            </div>
            <input type="hidden" name="weight" value="0">
            <div class="row">
              <div class="col-7">
                <button class="btn samazon-submit-button w-100">
                  <i class="fas fa-shopping-cart"></i>
                  カートに追加
                </button>
              </div>
              <div class="col-5">
                <button type="button" data-action="{{ route('favorites.add_destroy') }}" class="btn samazon-favorite-button text-favorite w-100">
                  <i class="fa fa-heart"></i>
                  @if ($favorite) お気に入り解除 @else お気に入り @endif
                </button>
              </div>
            </div>
          </form>
        @endauth
      </div>

      <div class="offset-1 col-11">
        <hr class="w-100">
        <h3 class="float-left">カスタマーレビュー</h3>
      </div>

      <div class="offset-1 col-10">
        <div class="row">
          @foreach ($reviews as $review)
            <div class="offset-md-5 col-md-5">
              <h3 class="review-score-color">{{ $review->scoreStar() }}</h3>
              <p class="h3">{{ $review->body }}</p>
              <label>{{ $review->created_at }}</label>
            </div>
          @endforeach
        </div>
        @auth
          <div class="row">
            <div class="offset-md-5 col-md-5">
              <form method="POST" action="{{ route('products.review', $product->id) }}">
                @csrf
                <h5>評価</h5>
                <select name="score" class="form-control m-2 review-score-color">
                  <option value="5" class="review-score-color">★★★★★</option>
                  <option value="4" class="review-score-color">★★★★</option>
                  <option value="3" class="review-score-color">★★★</option>
                  <option value="2" class="review-score-color">★★</option>
                  <option value="1" class="review-score-color">★</option>
                </select>
                <h5>レビュー内容</h5>
                <textarea name="body" class="form-control m-2"></textarea>
                <button type="submit" class="btn samazon-submit-button ml-2">レビューを追加</button>
              </form>
            </div>
          </div>
        @endauth
      </div>
    </div>
  </div>
@endsection