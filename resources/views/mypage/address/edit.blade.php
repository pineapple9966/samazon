@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <span>
          <a href="{{ route('mypage.index') }}">マイページ</a> > お届け先変更
        </span>
        <h3 class="mt-3 mb-3">お届け先変更</h3>

        <hr>

        <form method="POST" action="{{ route('mypage.address.update') }}">
          @method('put')
          @csrf
          <div class="form-group row">
            <label for="name" class="col-md-5 col-form-label text-md-left">氏名<span class="ml-1 samazon-require-input-label"><span class="samazon-require-input-label-text">必須</span></span></label>

            <div class="col-md-7">
              <input id="name" type="text" class="form-control samazon-login-input" name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name" autofocus placeholder="侍 太郎">
            </div>
          </div>

          <div class="form-group row">
            <label for="postal_code" class="col-md-5 col-form-label text-md-left">郵便番号<span class="ml-1 samazon-require-input-label"><span class="samazon-require-input-label-text">必須</span></span></label>

            <div class="col-md-7">
              <input class="form-control samazon-login-input" id="postal_code" name="postal_code" value="{{ old('postal_code', Auth::user()->postal_code) }}" required placeholder="150-0043">
            </div>
          </div>

          <div class="form-group row">
            <label for="address" class="col-md-5 col-form-label text-md-left">住所<span class="ml-1 samazon-require-input-label"><span class="samazon-require-input-label-text">必須</span></span></label>

            <div class="col-md-7">
              <input type="text" class="form-control samazon-login-input" id="address" name="address" value="{{ old('address', Auth::user()->address) }}" required placeholder="東京都渋谷区道玄坂２丁目１１−１">
            </div>
          </div>

          <div class="form-group row">
            <label for="phone" class="col-md-5 col-form-label text-md-left">電話番号<span class="ml-1 samazon-require-input-label"><span class="samazon-require-input-label-text">必須</span></span></label>

            <div class="col-md-7">
              <input type="number" class="form-control samazon-login-input" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required placeholder="03-5790-9039">
            </div>
          </div>

          <hr>

          <div class="form-group d-flex justify-content-end">
            <button type="submit" class="btn samazon-submit-button w-25">
              保存する
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection