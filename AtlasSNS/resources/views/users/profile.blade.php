@extends('layouts.login')

@section('content')

<div class="user_profile">
  <ul>
    <li>
      <img src="{{ asset('/storage/images/' . $profileUser->images) }}">
    </li>
    <li>
      <div>
        <p>name</p>
        <p>{{ $profileUser->username }}</p>
      </div>
      <div>
        <p>bio</p>
        <p>{{ $profileUser->bio }}</p>
      </div>
    </li>
    <li>
      <div class="profile_button">
        @if (Auth::user()->isFollowing($profileUser->id))
        <a class="btn btn-primary" name="" href="/search/{{$profileUser->id}}/unfollow">フォロー解除</a>
        <br>
        @else
        <a class="btn btn-primary" name="" href="/search/{{$profileUser->id}}/follow">フォローする</a>
        @endif

      </div>
    </li>
  </ul>
</div>

<span></span>

<div id="User_comment">
  <ul>
    <li>
      @foreach($posts as $post)
      <img src="{{ asset('/storage/images/' . $profileUser->images) }}">
    </li>
    <li>
      {{ $post->user->username }}
      {{ $post->post }}
    </li>
    <li>
      {{ $post->created_at }}
    </li>
  </ul>
  <span></span>
  @endforeach

  <br>
</div>



@endsection
