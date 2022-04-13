@extends('layouts.dashboard')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <h3 class="mt-3 mb-3">ログイン</h3>

        @if (session('warning'))
          <div class="alert alert-danger">
            {{ session('warning') }}
          </div>
        @endif

        <hr>
        <form method="POST">
          @csrf

          <div class="form-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror samazon-login-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレス">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror samazon-login-input" name="password" required autocomplete="current-password" placeholder="パスワード">
          </div>

          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

              <label class="form-check-label samazon-check-label w-100" for="remember">
                次回から自動的にログインする
              </label>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="mt-3 btn samazon-submit-button w-100">
              ログイン
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
