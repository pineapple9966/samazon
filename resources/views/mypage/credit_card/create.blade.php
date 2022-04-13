@extends('layouts.app')

@section('javascript')
  <script>
    $(function () {
      $('#card-number').on('input', function () {
        const val = $(this).val();
        if (val.length > 16) {
          $(this).val(val.slice(0, 16));
        }
      });

      $('.exp').on('input', function () {
        const val = $(this).val();
        if (val.length > 2) {
          $(this).val(val.slice(0, 2));
        }
      });

      $('#cvc').on('input', function () {
        const val = $(this).val();
        if (val.length > 3) {
          $(this).val(val.slice(0, 3));
        }
      });

      $('.register-btn').click(function () {
        const cardNumberLength = $('#card-number').val().length;
        if (cardNumberLength !== 16) {
          $('.error').text('');
          $('#incorrect_number').text('正しいカード番号を入力してください');
          return false;
        }

        const data = {
          number: $('#card-number').val(),
          exp_month: $('#exp-month').val(),
          exp_year: $('#exp-year').val(),
          cvc: $('#cvc').val(),
        };

        $.ajax({
          headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          url: '/mypage/credit_card',
          method: 'post',
          data: data
        }).done(function (response) {
          if (response['status'] === 'failed') {
            $('.error').text('');
            $('.succeeded').text('');
            let found = false;
            $('.error').each(function () {
              if ($(this).attr('id') === response['stripeCode']) {
                $(this).text(response['message']);
                found = true;
              }
            });
            if (!found) {
              $('#other-error').text('入力情報に誤りがあります');
            }
            console.log(response['status']);
            console.log(response['stripeCode']);
            console.log(response['message']);
          } else {
            $('.error').text('');
            $('.succeeded').text('');
            $(`#card_info_succeeded`).text(response['status']);
            alert('クレジットカードを登録しました。')
          }
        });
      });
    });
  </script>
@endsection

@section('content')
  <div class="container">
    <form method="post" action="{{ route('mypage.password.update') }}">
      @method('put')
      @csrf
      <div class="form-group row">
        <label for="password" class="col-md-3 col-form-label text-md-right">カード番号</label>

        <div class="col-md-7">
          <input class="form-control" id="card-number" name="card_number" placeholder="カード番号を入力してください" autocomplete="cc-number">(4000 0039 2000 0003)
          <span class="error" id="incorrect_number"></span>
          <span class="error" id="invalid_number"></span>
          <span class="error" id="other-error"></span>
        </div>
      </div>

      <div class="form-group row">
        <label for="" class="col-md-3 col-form-label text-md-right">使用期限</label>

        <div class="form-inline col-md-7">
          <input type="number" class="exp form-control col-3 mr-3" id="exp-month" name="exp_month" placeholder="月" autocomplete="cc-emp-month">
          <div class="mr-3">/</div>
          <input type="number" class="exp form-control col-3" id="exp-year" name="exp_year" placeholder="年" autocomplete="cc-emp-year">
          <span class="error" id="invalid_expiry_month"></span>
          <span class="error" id="invalid_expiry_year"></span>
        </div>
      </div>

      <div class="form-group row">
        <label for="" class="col-md-3 col-form-label text-md-right">セキュリティコード</label>

        <div class="col-md-7">
          <input type="number" class="form-control col-3" id="cvc" name="cvc" placeholder="CVC" autocomplete="cc-csc">
          <span class="error" id="invalid_cvc"></span>
        </div>
      </div>

      <div class="form-group d-flex justify-content-center">
        <button type="button" class="btn btn-danger w-25 register-btn">
          クレジットカード登録
        </button>
      </div>
    </form>
  </div>
@endsection
