@extends('admin.base')

@section('javascript')
  <script>
    $(function () {
      $('.delete-btn').click(function () {
        if (confirm('削除してもよろしいですか？')) {
          const $form = $(this).parents('form');
          $form.submit();
        }
      });
    });
  </script>
@endsection

@section('content')
  <form method="post" action="{{ route('admin.products.destroy', $product->id) }}">
    @csrf
    <input type="hidden" name="_method" value="delete">
    <button type="button" class="delete-btn">削除</button>
  </form>

  <form action="{{ route('admin.products.edit', $product->id) }}">
    <table>
      <tr>
        <td colspan="2"><img src="{{ Storage::url($product->photo) }}" alt="{{ $product->name }}" width="300"></td>
      </tr>
      <tr>
        <th>カテゴリー</th><td>{{ $product->category->name }}</td>
      </tr>
      <tr>
        <th>商品名</th><td>{{ $product->name }}</td>
      </tr>
      <tr>
        <th>説明</th><td>{{ $product->description }}</td>
      </tr>
      <tr>
        <th>価格</th><td>{{ $product->price }}</td>
      </tr>
      <tr>
        <th>オススメ</th><td>{{ $product->is_recommended ? 'on' : 'off' }}</td>
      </tr>
      <tr>
        <th>送料</th><td>{{ $product->has_delivery_fee ? 'on' : 'off' }}</td>
      </tr>
    </table>

    <button type="button" class="back-btn" data-action="{{ route('admin.products.index') }}">戻る</button>
    <button>編集</button>
  </form>
@endsection