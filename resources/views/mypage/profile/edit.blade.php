@extends('layouts.app')

@section('javascript')
  <script>
    $(function () {
      if ('{{ $errors->first('email') }}') {
        switchEditUserInfo('.userMail', '.editUserMail', '.userMailEditLabel');
      }
    });
  </script>
@endsection

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
            <span>
                <a href="{{ route('mypage.index') }}">マイページ</a> > 会員情報の編集
            </span>

        <h1 class="mt-3 mb-3">会員情報の編集</h1>

        <hr>

          <input type="hidden" name="_method" value="PUT">
          <div class="form-group">
            <div class="d-flex justify-content-between">
              <label for="name" class="text-md-left samazon-edit-user-info-label">氏名</label>
              <span onclick="switchEditUserInfo('.userName', '.editUserName', '.userNameEditLabel');" class="userNameEditLabel user-edit-label">
                            編集
                        </span>
            </div>
            <div class="collapse show userName">
              <h1 class="samazon-edit-user-info-value">{{ Auth::user()->name }}</h1>
            </div>
            <div class="collapse editUserName">
              <form method="post" action="{{ route('mypage.profile.update') }}">
                @method('put')
                @csrf
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus placeholder="侍 太郎">

                <button type="submit" class="btn samazon-submit-button mt-3 w-25">
                  保存
                </button>

                @error('name')
                <span class="invalid-feedback" role="alert">
                              <strong>氏名を入力してください</strong>
                          </span>
                @enderror
              </form>
            </div>
          </div>

          <hr>

          <div class="form-group">
            <div class="d-flex justify-content-between">
              <label for="email" class="text-md-left samazon-edit-user-info-label">メールアドレス</label>
              <span onclick="switchEditUserInfo('.userMail', '.editUserMail', '.userMailEditLabel');" class="userMailEditLabel user-edit-label">
                            編集
                        </span>
            </div>
            <div class="collapse show userMail">
              <h1 class="samazon-edit-user-info-value">{{ Auth::user()->email }}</h1>
            </div>
            <div class="collapse editUserMail">
              <form method="post" action="{{ route('mypage.profile.update') }}">
                @method('put')
                @csrf
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email" autofocus placeholder="samurai@samurai.com">

                <button type="submit" class="btn samazon-submit-button mt-3 w-25">
                  保存
                </button>

              @error('email')
              <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
              @enderror
              </form>
            </div>
          </div>

          <hr>

          <div class="form-group">
            <div class="d-flex justify-content-between">
              <label for="phone" class="text-md-left samazon-edit-user-info-label">電話番号</label>
              <span onclick="switchEditUserInfo('.userPhone', '.editUserPhone', 'userPhoneEditLabel');" class="userPhoneEditLabel user-edit-label">
                            編集
                        </span>
            </div>
            <div class="collapse show userPhone">
              <h1 class="samazon-edit-user-info-value">{{ Auth::user()->phone }}</h1>
            </div>
            <div class="collapse editUserPhone">
              <form method="post" action="{{ route('mypage.profile.update') }}">
                @method('put')
                @csrf
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ Auth::user()->phone }}" required autocomplete="phone" autofocus placeholder="XXX-XXXX-XXXX">

                <button type="submit" class="btn samazon-submit-button mt-3 w-25">
                  保存
                </button>

                @error('phone')
                <span class="invalid-feedback" role="alert">
                              <strong>電話番号を入力してください</strong>
                          </span>
                @enderror
              </form>
            </div>
          </div>

          <hr>
        <div class="d-flex justify-content-end">
          <form method="POST" action="{{ route('mypage.users.destroy') }}">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <div class="btn dashboard-delete-link" data-toggle="modal" data-target="#delete-user-confirm-modal">退会する</div>

            <div class="modal fade" id="delete-user-confirm-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><label>本当に退会しますか？</label></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p class="text-center">一度退会するとデータはすべて削除され復旧はできません。</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn dashboard-delete-link" data-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn samazon-delete-submit-button text-white">退会する</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    let switchEditUserInfo = (textClass, inputClass, labelClass) => {
      if ($(textClass).css('display') == 'block') {
        $(labelClass).text("キャンセル");
        $(textClass).collapse('hide');
        $(inputClass).collapse('show');
      } else {
        $(labelClass).text("編集");
        $(textClass).collapse('show');
        $(inputClass).collapse('hide');
      }
    }
  </script>
@endsection