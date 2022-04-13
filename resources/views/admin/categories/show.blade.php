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
  <form method="post" action="{{ route('admin.categories.destroy', $category->id) }}">
    @csrf
    <input type="hidden" name="_method" value="delete">
    <button type="button" class="delete-btn">削除</button>
  </form>

  <table>
    <tr>
      <th>親カテゴリー名</th>
      <td>{{ $category->majorCategory->name }}</td>
    </tr>
    <tr>
      <th>カテゴリー名</th>
      <td>{{ $category->name }}</td>
    </tr>
    <tr>
      <th>説明</th>
      <td>{{ $category->description }}</td>
    </tr>
  </table>

  <form action="{{ route('admin.categories.edit', $category->id) }}">
    <button type="button" class="back-btn" data-action="{{ route('admin.categories.index') }}">戻る</button>
    <button>編集</button>
  </form>
@endsection