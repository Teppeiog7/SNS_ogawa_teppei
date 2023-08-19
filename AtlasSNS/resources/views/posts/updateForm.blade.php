@extends('layouts.login')

@section('content')
<body class="container">
  <div class="container">
    <h2 class='page-header'>投稿内容を変更する</h2>
    {!! Form::open(['url' => '/post/update']) !!}
    <div class="form-group">
      {!! Form::hidden('id', $post->id) !!}
      {!! Form::input('text', 'upPost', $post->post, ['required', 'class' => 'form-control']) !!}
    </div>
    <button type="submit" class="btn btn-primary pull-right">編集</button>
    {!! Form::close() !!}
  </div>
</body>
@endsection
