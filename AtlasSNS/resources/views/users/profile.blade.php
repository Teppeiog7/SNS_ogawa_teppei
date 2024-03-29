@extends('layouts.login')

@section('content')

<div class="user_profile">
  <ul>
    <li>
      <img src="{{ asset('/storage/images/' . $profileUser->images) }}" class="img_icon">
    </li>
    <li>
      <ul>
        <li>name</li>
        <li>{{ $profileUser->username }}</li>
      </ul>
      <ul>
        <li>bio</li>
        <li>{{ $profileUser->bio }}</li>
      </ul>
    </li>
    <li>
      <div class="profile_button">
        <!-- ▼Auth::user()：現在ログインしているユーザーの情報を取得するための方法 -->
        <!-- ▼isFollowingメソッド：ユーザーがフォローしているか -->
        @if (Auth::user()->isFollowing($profileUser->id))
        <a class="btn btn-primary" id='red_btn' name="" href="/search/{{$profileUser->id}}/unfollow">フォロー解除</a>
        <br>
        @else
        <a class="btn btn-primary" name="" href="/search/{{$profileUser->id}}/follow">フォローする</a>
        @endif
      </div>
    </li>
  </ul>
</div>

<span></span>

@foreach($posts as $post)
<div id="User_comment">
  <ul>
    <li>
      <img src="{{ asset('/storage/images/' . $profileUser->images) }}" class="img_icon">
    </li>
    <li>
      <p>{{ $post->user->username }}</p>
      <!-- ▼改行された状態でindex.bladeに出力させる -->
      <p>{!! nl2br(e($post->post)) !!}</p>
    </li>
    <li>
      {{ $post->created_at }}
    </li>
  </ul>
  <span></span>
</div>
@endforeach

@endsection
