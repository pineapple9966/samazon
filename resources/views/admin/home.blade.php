@extends('layouts.dashboard')

@section('javascript')
  <script>
    $(function () {
      $('select[name=group_by]').change(function () {
        $(this).parents('form').submit();
      });
    });
  </script>
@endsection

@section('content')
  <div class="w-75">
    @if (request()->input('group_by') == 'daily')
      <h1>日別売上 {{ $sales->count() }} 件</h1>
    @else
      <h1>月別売上 {{ $sales->count() }} 件</h1>
    @endif

    <form action="{{ route('admin.home') }}" class="form-inline">
      切り替え
      <select name="group_by" class="form-inline ml-2">
        <option value="monthly" @if (request()->input('group_by') == 'monthly') selected @endif>月別</option>
        <option value="daily" @if (request()->input('group_by') == 'daily') selected @endif>日別</option>
      </select>
    </form>

    <div class="container mt-4">
      <table class="table">
        <thead>
        <tr>
          <th scope="col">年月日</th>
          <th scope="col">金額</th>
          <th scope="col">件数</th>
          <th scope="col">平均単価</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($sales as $sale)
          <tr>
            <td>{{ $sale->date}}</td>
            <td>{{ $sale->amount}}</td>
            <td>{{ $sale->count}}</td>
            <td>{{ $sale->avg}}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>

    {{ $sales->links('vendor.pagination.bootstrap-4') }}
  </div>
@endsection