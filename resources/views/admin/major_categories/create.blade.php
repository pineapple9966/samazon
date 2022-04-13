@extends('admin.base')

@section('content')
  <form method="post" action="{{ route('admin.major_categories.store') }}">
    @csrf

    <table>
      <tr>
        <th><label for="name">親カテゴリー名</label></th>
        <td><input id="name" name="name" required></td>
      </tr>
      <tr>
        <th><label for="description">説明</label></th>
        <td>
          <textarea id="description"name="description" required></textarea>
        </td>
      </tr>
    </table>

    <button type="button" class="back-btn" data-action="{{ route('admin.major_categories.index') }}">戻る</button>
    <button>登録</button>
  </form>
@endsection