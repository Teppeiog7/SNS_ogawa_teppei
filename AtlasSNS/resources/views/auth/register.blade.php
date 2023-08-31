@extends('layouts.logout')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif


{!! Form::open() !!}

<div id="login">
  <h2>新規ユーザー登録</h2>

  <p>{{ Form::label('ユーザー名') }}</p>
  {{ Form::text('username',null,['class' => 'input']) }}

  <p>{{ Form::label('メールアドレス') }}</p>
  {{ Form::text('mail',null,['class' => 'input']) }}

  <p>{{ Form::label('パスワード') }}</p>
  {{ Form::password('password',null,['class' => 'input']) }}

  <p>{{ Form::label('パスワード確認') }}</p>
  {{ Form::password('password_confirmation',null,['class' => 'input']) }}

  <div id="button">{{ Form::submit('RGEISTER') }}</div>

  <div class="btn"><a href="/login">ログイン画面へ戻る</a></div>
</div>

{!! Form::close() !!}


@endsection
