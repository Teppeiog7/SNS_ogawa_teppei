@extends('layouts.login')

@section('content')

<dic class="search_form">
  <form action="/search" method="post">
    @csrf
    <ul>
      <li>
        <input type="text" name="keyword" class="form" placeholder="ユーザー名">
      </li>
      <li>
        <button type="submit" class="search_btn">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
          </svg>
        </button>
      </li>
      <li>
        <p>
          @if (!empty($keyword))
          検索キーワード：{{ $keyword }}
          @endif
        </p>
      </li>
    </ul>
  </form>
</dic>


<span></span>

<div class="user_search">
  @foreach ($users as $user)
  <ul>
    <li>
      <!-- @php
      $images = $user->images; // ユーザーの画像パスを取得
      $imageUrl = asset('/storage/images/' . $images); // 画像のURLを生成
      @endphp -->
      <img src="{{ asset('/storage/images/' . $images) }}">
    </li>
    <li>
      {{ $user->username }}さん
    </li>
    <li>
      @if(Auth::user()->isFollowing($user->id))
      <a class="btn btn-primary" id='red_btn' name="" href="/search/{{$user->id}}/unfollow">フォロー解除</a>
      @else
      <a class="btn btn-primary" name="" href="/search/{{$user->id}}/follow">フォローする</a>
      @endif
    </li>
  </ul>
  @endforeach
</div>

@endsection
