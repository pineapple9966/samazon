@extends('layouts.dashboard')

@section('javascript')
  <script>
    $(function () {
      $('.dashboard-delete-link').click(function () {
        if (confirm('削除してもよろしいですか？')) {
          $(this).parents('form').submit();
        }
      });
    });
  </script>
@endsection

@section('content')
  <div class="w-75">

    <h1>顧客一覧</h1>

    <div class="w-75">
      <form method="GET" action="{{ route('admin.users.index') }}">
        <div class="d-flex flex-inline form-group">
          <div class="d-flex align-items-center">
            ID・氏名など
          </div>
          <textarea id="search-products" name="keyword" class="form-controll ml-2 w-50">{{ request()->input('keyword') }}</textarea>
        </div>
        <button type="submit" class="btn samazon-submit-button">検索</button>
      </form>
    </div>

    <table class="table mt-5">
      <thead>
      <tr>
        <th scope="col" class="w-25">ID</th>
        <th scope="col">名前</th>
        <th scope="col">メールアドレス</th>
        <th scope="col">電話番号</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
      @foreach ($users as $user)
        <tr>
          <th scope="row">{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->phone }}</td>
          <td>
            <form action="{{ route('admin.users.change_status', $user->id) }}" method="POST">
              @csrf
              @method('delete')
              <button type="button" class="btn dashboard-delete-link">削除</button>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>

    {{ $users->links('vendor.pagination.bootstrap-4') }}
  </div>
@endsection