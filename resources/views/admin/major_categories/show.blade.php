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
  <form method="post" action="{{ route('admin.major_categories.destroy', $majorCategory->id) }}">
    @csrf
    @method('delete')
    <button type="button" class="delete-btn">削除</button>
  </form>

  <table>
    <tr>
      <th>親カテゴリー名</th>
      <td>{{ $majorCategory->name }}</td>
    </tr>
    <tr>
      <th>説明</th>
      <td>{{ $majorCategory->description }}</td>
    </tr>
  </table>

  <form action="{{ route('admin.major_categories.edit', $majorCategory->id) }}">
    <button type="button" class="back-btn" data-action="{{ route('admin.major_categories.index') }}">戻る</button>
    <button>編集</button>
  </form>
@endsection