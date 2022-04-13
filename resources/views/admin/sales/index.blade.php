@extends('admin.base')

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
  <h3>{{ request()->input('group_by') == 'daily' ? '日' : '月'}}別売上{{ $sales->count() }}件</h3>

  <form action="{{ route('admin.sales.index') }}">
    <select name="group_by">
      <option value="monthly" @if (request()->input('group_by') == 'monthly') selected @endif>月別</option>
      <option value="daily" @if (request()->input('group_by') == 'daily') selected @endif>日別</option>
    </select>
  </form>

  <table>
    <tr>
      <th>年月日</th>
      <th>金額</th>
      <th>件数</th>
      <th>平均単価</th>
    </tr>
    @foreach ($sales as $sale)
      <tr>
        <td>{{ $sale->date }}</td>
        <td>{{ $sale->amount }}</td>
        <td>{{ $sale->count }}</td>
        <td>{{ $sale->avg }}</td>
      </tr>
    @endforeach
  </table>

  {{ $sales->links('vendor.pagination.bootstrap-4') }}
@endsection