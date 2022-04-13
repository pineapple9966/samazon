@extends('layouts.dashboard')

@section('content')
  <div class="w-50">
    <h1>商品登録</h1>

    <hr>

    <form method="POST" action="{{ route('admin.products.store') }}" class="mb-5" enctype="multipart/form-data">
      @csrf
      <div class="form-inline mt-4 mb-4 row">
        <label for="product-name" class="col-2 d-flex justify-content-start">商品名</label>
        <input type="text" name="name" id="product-name" class="form-control col-8" required>
      </div>
      <div class="form-inline mt-4 mb-4 row">
        <label for="product-image" class="col-2 d-flex justify-content-start">画像</label>
        <img src="#" id="product-image-preview" style="display: none">
        <input type="file" name="photo" id="product-image" required>
      </div>
      <div class="form-inline mt-4 mb-4 row">
        <label for="product-price" class="col-2 d-flex justify-content-start">価格</label>
        <input type="number" name="price" id="product-price" class="form-control col-8" required>
      </div>
      <div class="form-inline mt-4 mb-4 row">
        <label for="product-carriage" class="col-2 d-flex justify-content-start">送料</label>
        <input type="checkbox" name="has_delivery_fee" id="product-carriage" class="samazon-check-box" value="1">
      </div>
      <div class="form-inline mt-4 mb-4 row">
        <label for="product-category" class="col-2 d-flex justify-content-start">カテゴリ</label>
        <select class="form-control col-8" id="category_id" name="category_id" required>
          <option value="" selected disabled>カテゴリーを選択してください</option>
          @foreach ($categories as $major_category_name => $subcategories)
            <optgroup label="{{ $major_category_name }}">
              @foreach ($subcategories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </optgroup>
          @endforeach
        </select>
      </div>
      <div class="form-inline mt-4 mb-4 row">
        <label for="product-recommend" class="col-2 d-flex justify-content-start">オススメ?</label>
        <input type="checkbox" name="is_recommended" id="product-recommend" class="samazon-check-box" value="1">
      </div>
      <div class="form-inline mt-4 mb-4 row">
        <label for="product-description" class="col-2 d-flex justify-content-start align-self-start">商品説明</label>
        <textarea name="description" id="product-description" class="form-control col-8" rows="10" required></textarea>
      </div>
      <div class="d-flex justify-content-end">
        <button type="submit" class="w-25 btn samazon-submit-button">商品を登録</button>
      </div>
    </form>

    <div class="d-flex justify-content-end">
      <a href="{{ route('admin.products.index') }}">商品一覧に戻る</a>
    </div>

    <script type="text/javascript">
      $("#product-image").change(function() {
        if (this.files && this.files[0]) {
          let reader = new FileReader();
          reader.onload = function(e) {
            $('#product-image-preview').show();
            $('#product-image-preview').width(300);
            $("#product-image-preview").attr("src", e.target.result);
          }
          reader.readAsDataURL(this.files[0]);
        }
      });
    </script>
  </div>
@endsection