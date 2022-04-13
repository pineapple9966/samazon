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
    <form method="POST" action="{{ route('admin.categories.store') }}">
      @csrf
      <div class="form-group">
        <label for="category-name">カテゴリ名</label>
        <input type="text" name="name" id="category-name" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="category-description">カテゴリの説明</label>
        <textarea name="description" id="category-description" class="form-control" required></textarea>
      </div>
      <div class="form-group">
        <label for="category-major-category">親カテゴリ</label>
        <select name="major_category_id" class="form-control col-8" id="category-major-category" required>
          <option value="">親カテゴリーを選択してください</option>
          @foreach ($majorCategories as $majorCategory)
            <option value="{{ $majorCategory->id }}">{{ $majorCategory->name }}</option>
          @endforeach
        </select>
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
          <th scope="col">カテゴリ</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
          <tr>
            <th scope="row">{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>
              <a href="{{ route('admin.categories.edit', $category->id) }}" class="dashboard-edit-link">編集</a>
            </td>
            <td>
              <a href="" class="dashboard-delete-link" data-action="{{ route('admin.categories.destroy', $category->id) }}">
                削除
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{ $categories->links('vendor.pagination.bootstrap-4') }}
  </div>
@endsection