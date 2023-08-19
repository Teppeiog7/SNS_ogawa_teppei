@extends('layouts.login')

@section('content')

<div class="container">

  <div class="container01">
    {!! Form::open(['url' => 'post/create']) !!}
    <ul>
      <li>
        @if (Auth::check())
        <img src="{{ asset('/images/' . Auth::user()->images) }}">
        @endif
      </li>
      <li>
        <div class="form-group">
          {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください']) !!}
        </div>
      </li>
      <li>
        <button type="submit" class="image-button"><img src="{{ asset('/images/post.png') }}"></button>
      </li>
      {!! Form::close() !!}
    </ul>
  </div>

  <span class="main_border"></span>

  @foreach($posts as $post)

  @if (Auth::user()->isFollowing($post->user->id))

  <!-- もしログインユーザーがフォローしているユーザーがいればフォローユーザーの投稿を出力 -->

  @php
  $images = $post->user->images; // ユーザーの画像パスを取得
  $imageUrl = asset('/images/' . $images); // 画像のURLを生成
  @endphp

  <div id="UserIsFollowing">
    <ul>
      <li>
        <img src="{{ $imageUrl }}">
      </li>
      <li>
        <p>{{ $post->user->username }}</p>
        <p>{{ $post->post }}</p>
      </li>
      <li>
        <p>{{ $post->created_at }}</p>
      </li>
    </ul>
  </div>

  @elseif(Auth::user()->id === $post->user->id)
  <!-- ログインユーザーだけの投稿を出力 -->
  @php
  $images = $post->user->images; // ユーザーの画像パスを取得
  $imageUrl = asset('/images/' . $images); // 画像のURLを生成
  @endphp

  <div id="User_comment">
    <ul>
      <li>
        <p><img src="{{ $imageUrl }}"></p>
      </li>
      <li>
        <p>{{ $post->user->username }}</p>
        <p>{{ $post->post }}</p>
      </li>
      <li>
        <p>{{ $post->created_at }}</p>
        <div id="User_button">
          @if ($loggedInUser && $loggedInUser->id === $post->user_id)
          <a class="js-modal-open" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="{{ asset('/images/edit.png') }}" width="50" height="50"></a>
          <div class="delete_button">
            <a class="btn-danger" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの本を削除してもよろしいでしょうか？')">
              <img src="{{ asset('/images/trash-h.png') }}" width="50" height="50" class="image" id="imageA">
              <img src="{{ asset('/images/trash.png') }}" width="50" height="50" class="image" id="imageB">
            </a>
          </div>
        </div>
      </li>
    </ul>
  </div>

  @endif

  <!-- モーダルの中身 -->
  <div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
      {!! Form::open(['url' => '/post/update']) !!}
      <div class="form-group">
        {!! Form::hidden('id', $post->id) !!}
        {!! Form::input('text', 'upPost', $post->post, ['required', 'class' => 'form-control']) !!}
      </div>
      <button type="submit" class="image-button"><img src="{{ asset('/images/edit.png') }}" width="50" height="50"></button>
      {!! Form::close() !!}
      <a class="js-modal-close" href="">閉じる</a>
    </div>
  </div>

  @endif

  <span></span>

  @endforeach

  <br>
</div>

@endsection
