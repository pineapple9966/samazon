@extends('layouts.dashboard')

@section('content')
  <div class="w-75">
    <h1>カテゴリ情報更新</h1>

    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
      @csrf
      @method('put')
      <div class="form-group">
        <label for="category-name">カテゴリ名</label>
        <input type="text" name="name" id="category-name" class="form-control" value="{{ $category->name }}">
      </div>
      <div class="form-group">
        <label for="category-description">カテゴリの説明</label>
        <textarea name="description" id="category-description" class="form-control">{{ $category->description }}</textarea>
      </div>
      <div class="form-group">
        <label for="category-major-category">親カテゴリ名</label>
        <select class="form-control col-8" id="major_category_id" name="major_category_id" required>
          @foreach ($majorCategories as $majorCategory)
            <option value="{{ $majorCategory->id }}" @if ($category->majorCategory->id == $majorCategory->id) selected @endif>{{ $majorCategory->name }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-danger">更新</button>
    </form>

    <a href="{{ route('admin.categories.index') }}" class="mt-4">カテゴリ一覧に戻る</a>
  </div>
@endsection