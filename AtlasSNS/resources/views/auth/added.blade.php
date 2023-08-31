@extends('layouts.logout')

@section('content')

<div id="clear">
  <p id="bold"> {{ session('username') }} さん<br>ようこそ！AtlasSNSへ！</p>
  <span></span>
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう。</p>
  <div id="btn_added">
    <a href="/login" id="button_added">
      <button type="button">ログイン画面へ</button>
    </a>
  </div>
</div>

@endsection
