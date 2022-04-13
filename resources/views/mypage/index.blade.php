@extends('layouts.app')

@section('content')
  <div class="container d-flex justify-content-center mt-3">
    <div class="w-50">
      <h1>マイページ</h1>

      <hr>

      <div class="container">
        <div class="d-flex justify-content-between">
          <div class="row">
            <div class="col-2 d-flex align-items-center">
              <i class="fas fa-user fa-3x"></i>
            </div>
            <div class="col-9 d-flex align-items-center ml-2 mt-3">
              <div class="d-flex flex-column">
                <label for="user-name">会員情報の編集</label>
                <p>アカウント情報の編集</p>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <a href="{{ route('mypage.profile.edit') }}">
              <i class="fas fa-chevron-right fa-2x"></i>
            </a>
          </div>
        </div>
      </div>

      <hr>

      <div class="container">
        <div class="d-flex justify-content-between">
          <div class="row">
            <div class="col-2 d-flex align-items-center">
              <i class="fas fa-credit-card fa-3x"></i>
            </div>
            <div class="col-9 d-flex align-items-center ml-2 mt-3">
              <div class="d-flex flex-column">
                <label for="user-name">クレジットカードの登録</label>
                <p>クレジットカードの登録</p>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <a href="{{ route('mypage.credit_card.create') }}">
              <i class="fas fa-chevron-right fa-2x"></i>
            </a>
          </div>
        </div>
      </div>

      <hr>

      <div class="container">
        <div class="d-flex justify-content-between">
          <div class="row">
            <div class="col-2 d-flex align-items-center">
              <i class="fas fa-archive fa-3x"></i>
            </div>
            <div class="col-9 d-flex align-items-center ml-2 mt-3">
              <div class="d-flex flex-column">
                <label for="user-name">注文履歴</label>
                <p>注文履歴を確認できます</p>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <a href="{{ route('mypage.orders.index') }}">
              <i class="fas fa-chevron-right fa-2x"></i>
            </a>
          </div>
        </div>
      </div>

      <hr>

      <div class="container">
        <div class="d-flex justify-content-between">
          <div class="row">
            <div class="col-2 d-flex align-items-center">
              <i class="fas fa-map-marked fa-3x"></i>
            </div>
            <div class="col-9 d-flex align-items-center ml-3 mt-3">
              <div class="d-flex flex-column">
                <label for="user-name">お届け先の変更</label>
                <p>登録住所の変更</p>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <a href="{{ route('mypage.address.edit') }}">
              <i class="fas fa-chevron-right fa-2x"></i>
            </a>
          </div>
        </div>
      </div>

      <hr>

      <div class="container">
        <div class="d-flex justify-content-between">
          <div class="row">
            <div class="col-2 d-flex align-items-center">
              <i class="fas fa-lock fa-3x"></i>
            </div>
            <div class="col-9 d-flex align-items-center ml-2 mt-3">
              <div class="d-flex flex-column">
                <label for="user-name">パスワード変更</label>
                <p>パスワードを変更します</p>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <a href="{{ route('mypage.password.edit') }}">
              <i class="fas fa-chevron-right fa-2x"></i>
            </a>
          </div>
        </div>
      </div>

      <hr>

      <div class="container">
        <div class="d-flex justify-content-between">
          <div class="row">
            <div class="col-2 d-flex align-items-center">
              <i class="fas fa-sign-out-alt fa-3x"></i>
            </div>
            <div class="col-9 d-flex align-items-center ml-2 mt-3">
              <div class="d-flex flex-column">
                <label for="user-name">ログアウト</label>
                <p>ログアウトします</p>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <a href="{{ route('logout') }}">
              <i class="fas fa-chevron-right fa-2x"></i>
            </a>
          </div>
        </div>
      </div>

      <hr>
    </div>
  </div>
@endsection
