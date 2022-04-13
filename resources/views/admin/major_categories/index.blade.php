@extends('layouts.dashboard')

@section('javascript')
  <script>
    $(function () {
      $('.dashboard-delete-link').click(function () {
        if (confirm('削除してもよろしいですか？')) {
          const $form = $('#delete-form');
          $form.attr('action', $(this).data('action'));
          $form.submit();
        }
        return false;
      });
    });
  </script>
@endsection

@section('content')
  <div class="w-75">
    <form method="POST" action="{{ route('admin.major_categories.store') }}">
      @csrf
      <div class="form-group">
        <label for="major-category-name">親カテゴリ名</label>
        <input type="text" name="name" id="major-category-name" class="form-control">
      </div>
      <div class="form-group">
        <label for="major-category-description">親カテゴリの説明</label>
        <textarea name="description" id="major-category-description" class="form-control"></textarea>
      </div>
      <button type="submit" class="btn samazon-submit-button">＋新規作成</button>
    </form>

    <form id="delete-form" method="post">
      @csrf
      @method('delete')
    </form>

    <table class="table mt-5">
      <thead>
        <tr>
          <th scope="col" class="w-25">ID</th>
          <th scope="col">親カテゴリ</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
      @foreach ($majorCategories as $majorCategory)
        <tr>
          <th scope="row">{{ $majorCategory->id }}</td>
          <td>{{ $majorCategory->name }}</td>
          <td>
            <a href="{{ route('admin.major_categories.edit', $majorCategory->id) }}" class="dashboard-edit-link">編集</a>
          </td>
          <td>
            <a href="" class="dashboard-delete-link" data-action="{{ route('admin.major_categories.destroy', $majorCategory->id) }}">
              削除
            </a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>

    {{ $majorCategories->links('vendor.pagination.bootstrap-4') }}
  </div>
@endsection 