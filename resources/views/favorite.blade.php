@extends('layouts.app')

@section('javascript')
  <script>
    $(function () {
      function deleteFavorite(favoriteIds) {
        $.ajax({
          headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          url: '/favorites',
          method: 'delete',
          data: { favorite_ids: favoriteIds }
        }).done(function (response) {
          location.reload();
        })
      }

      $('.all-delete-btn').click(function () {
        if (confirm('商品をすべて削除してもよろしいですか？')) {
          const favoriteIds = $('.delete-btn').map(function () {
            return $(this).data('favorite_id');
          }).get();
          deleteFavorite(favoriteIds);
        }
      });

      $('.delete-btn').click(function () {
        const favoriteId = [$(this).data('favorite_id')];
        deleteFavorite(favoriteId);
        return false;
      });
    });
  </script>
@endsection

@section('content')
  <div class="container  d-flex justify-content-center mt-3">
    <div class="w-75">
      @if (Auth::user()->favorites->count() > 0)
        <h1>お気に入り</h1>

        <hr>

        <div class="row">
          @foreach (Auth::user()->favorites as $favorite)
            <div class="col-md-8 mt-2">
              <div class="d-inline-flex">
                <a href="{{ route('products.show', $favorite->product->id) }}" class="w-25">
                  <img src="{{ Storage::url($favorite->product->photo) }}" class="img-fuild w-100">
                </a>
                <div class="container mt-3">
                  <h5 class="w-100 samazon-favorite-item-text">{{ $favorite->product->name }}</h5>
                  <h6 class="w-100samazon-favorite-item-text">￥{{ $favorite->product->price }}</h6>
                </div>
              </div>
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-end">
              <a href="" class="samazon-favorite-item-delete delete-btn" data-favorite_id="{{ $favorite->id }}">
                削除
              </a>
            </div>
          @endforeach
        </div>

        <hr>
      @else
        現在お気に入り商品はありません
      @endif
    </div>
  </div>
@endsection