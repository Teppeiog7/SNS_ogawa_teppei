@extends('layouts.login')

@section('content')

<div class="user_profile">
  @foreach($profileUser as $user)
  @php
  $imagePath = $user->images; // ユーザーの画像パスを取得
  $imageUrl = asset('/images/' . $imagePath); // 画像のURLを生成
  @endphp
  <ul>
    <li>
      <img src="{{ $imageUrl }}">
    </li>
    <li>
      <div>
        <p>name</p>
        <p>{{ $user->username }}</p>
      </div>
      <div>
        <p>bio</p>
        <p>{{ $user->bio }}</p>
      </div>
    </li>
    <li>
      <div class="profile_button">
        @if (Auth::user()->isFollowing($user->id))
        <a class="btn btn-primary" name="" href="/search/{{$user->id}}/unfollow">フォロー解除</a>
        <br>
        @else
        <a class="btn btn-primary" name="" href="/search/{{$user->id}}/follow">フォローする</a>
        @endif
        @endforeach
      </div>
    </li>
  </ul>
</div>

<span></span>

<div id="User_comment">
  <ul>
    <li>
      @foreach($posts as $post)
      @php
      $images = $post->user->images; // ユーザーの画像パスを取得
      $imageUrl = asset('/images/' . $images); // 画像のURLを生成
      @endphp
      <img src="{{ $imageUrl }}">
    </li>
    <li>
      {{ $post->user->username }}
      {{ $post->post }}
    </li>
    <li>
      {{ $post->created_at }}
      @endforeach
    </li>
  </ul>
  <span></span>
</div>



@endsection
