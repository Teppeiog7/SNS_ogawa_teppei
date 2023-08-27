@extends('layouts.login')

@section('content')

<dic class="search_form">
  <form action="/search" method="post">
    @csrf
    <input type="text" name="keyword" class="form" placeholder="ユーザー名">
    <button type="submit" class="btn btn-success">検索</button>
    <p>
    @if (!empty($keyword))
    検索キーワード：{{ $keyword }}
    @endif
    </p>
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
      {{ $user->username }}
    </li>
    <li>
      @if (Auth::user()->isFollowing($user->id))
      <a class="btn btn-primary" name="" href="/search/{{$user->id}}/unfollow">フォロー解除</a>
      @else
      <a class="btn btn-primary" name="" href="/search/{{$user->id}}/follow">フォローする</a>
      @endif
    </li>
  </ul>
  @endforeach
</div>

@endsection
