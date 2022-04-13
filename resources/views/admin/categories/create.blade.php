@extends('admin.base')

@section('content')
  <form method="post" action="{{ route('admin.categories.store') }}">
    @csrf

    <table>
      <tr>
        <th><label for="major_category_id">親カテゴリー</label></th>
        <td>
          <select id="major_category_id" name="major_category_id" required>
            @foreach ($majorCategories as $majorCategory)
              <option value="{{ $majorCategory->id }}">{{ $majorCategory->name }}</option>
            @endforeach
          </select>
        </td>
      </tr>
      <tr>
        <th><label for="name">カテゴリー名</label></th>
        <td><input id="name" name="name" required></td>
      </tr>
      <tr>
        <th><label for="description">説明</label></th>
        <td><textarea id="description" name="description" required></textarea></td>
      </tr>
    </table>

    <button type="button" class="back-btn" data-action="{{ route('admin.categories.index') }}">戻る</button>
    <button>登録</button>
  </form>
@endsection