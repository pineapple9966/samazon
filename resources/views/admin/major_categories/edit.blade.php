@extends('layouts.dashboard')

@section('content')
  <div class="w-75">
    <h1>親カテゴリ情報更新</h1>

    <form method="POST" action="{{ route('admin.major_categories.update', $majorCategory->id) }}" class="mb-4">
      @csrf
      @method('put')
      <div class="form-group">
        <label for="major-category-name">親カテゴリ名</label>
        <input type="text" name="name" id="major-category-name" class="form-control" value="{{ $majorCategory->name }}">
      </div>
      <div class="form-group">
        <label for="major-category-description">親カテゴリの説明</label>
        <textarea name="description" id="major-category-description" class="form-control">{{ $majorCategory->description }}</textarea>
      </div>
      <button type="submit" class="btn samazon-submit-button">更新</button>
    </form>

    <a href="{{ route('admin.major_categories.index') }}">親カテゴリ一覧に戻る</a>
  </div>
@endsection