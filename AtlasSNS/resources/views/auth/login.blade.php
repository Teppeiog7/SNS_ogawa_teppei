@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<div id="login">
  <h2>AtlasSNSへようこそ</h2>
  <p>{{ Form::label('mail address') }}</p>
  <br>
  {{ Form::text('mail',null,['class' => 'input']) }}
  <br>
  <p>{{ Form::label('password') }}</p>
  <br>
  {{ Form::password('password',['class' => 'input']) }}
  <br>
  <div id="button">{{ Form::submit('LOGIN') }}</div>
  <p class="btn"><a href="/register">新規ユーザーの方はこちら</a></div>
</div>

{!! Form::close() !!}

@endsection
