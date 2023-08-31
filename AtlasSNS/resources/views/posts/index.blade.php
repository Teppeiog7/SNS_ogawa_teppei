@extends('layouts.login')

@section('content')

<div class="container">

  <div class="container01">
    {!! Form::open(['url' => 'post/create']) !!}
    @csrf
    <ul>
      <li>
        @if (Auth::check())
        <img src="{{ asset('/storage/images/' . Auth::user()->images) }}">
        @endif
      </li>
      <li>
        <div class="form-group">
          <!-- {!! Form::textarea('newPost', null, [
          'required',
          'class' => 'form-control',
          'placeholder' => '入力してください',
          ]
          )!!} -->
          <textarea required class="form" placeholder="投稿内容を入力してください。" maxlength="150" name="newPost"></textarea>
        </div>
      </li>
      <li>
        <button type="submit" id="image-button01"><img src="{{ asset('/images/post.png') }}"></button>
      </li>
      {!! Form::close() !!}
    </ul>
  </div>

  <span class="main_border"></span>

  @foreach($posts as $post)

  @if (Auth::user()->isFollowing($post->user->id))

  <!-- もしログインユーザーがフォローしているユーザーがいればフォローユーザーの投稿を出力 -->

  <!-- @php
  $images = $post->user->images; // ユーザーの画像パスを取得
  $imageUrl = asset('/storage/images/' . $images); // 画像のURLを生成
  @endphp -->

  <div id="UserIsFollowing">
    <ul>
      <li>
        <img src="{{ asset('/storage/images/' . $post->user->images) }}">
      </li>
      <li>
        <p>{{ $post->user->username }}</p>
        <!-- ▼改行された状態でindex.bladeに出力させる -->
        <p>{!! nl2br(e($post->post)) !!}</p>
        </p>
      </li>
      <li>
        <p>{{ $post->created_at }}</p>
      </li>
    </ul>
  </div>
  <span></span>

  @elseif(Auth::user()->id === $post->user->id)

  <!-- ログインユーザーだけの投稿を出力 -->

  <!-- @php
  $images = $post->user->images; // ユーザーの画像パスを取得
  $imageUrl = asset('/storage/images/' . $images); // 画像のURLを生成
  @endphp -->

  <div id="User_comment">
    <ul>
      <li>
        <p><img src="{{ asset('/storage/images/' . $post->user->images) }}"></p>
      </li>
      <li>
        <p>{{ $post->user->username }}</p>
        <p>{!! nl2br(e($post->post)) !!}</p>
      </li>
      <li>
        <p>{{ $post->created_at }}</p>
        <div id="User_button">
          @if ($loggedInUser && $loggedInUser->id === $post->user_id)
          <a class="js-modal-open" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="{{ asset('/images/edit.png') }}" width="50" height="50"></a>
          <div class="delete_button">
            <a class="btn-danger" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの本を削除してもよろしいでしょうか？')">
              <img src="{{ asset('/images/garbage_can-h.png') }}" width="50" height="50" class="image" id="imageA">
              <img src="{{ asset('/images/garbage_can.png') }}" width="50" height="50" class="image" id="imageB">
            </a>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <span></span>

  @endif

  <!-- モーダルの中身 -->
  <div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
      <form action="/post/update" method="post">
        <textarea name="upPost" class="modal_post" maxlength="150"></textarea>
        <input type="hidden" name="id" class="modal_id" value="{{ $post->id }}">
        <button type="submit" id="image-button02">
          <img src="{{ asset('/images/edit.png') }}" width="50" height="50" id="imageA">
        </button>
        {{ csrf_field() }}
        <a class="js-modal-close" href="">
          <i class="bi bi-x-square"></i>
        </a>
      </form>
    </div>
  </div>

  @endif



  @endforeach


  <br>
</div>

@endsection
