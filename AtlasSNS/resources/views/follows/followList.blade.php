@extends('layouts.login')

@section('content')

<div class="all_container">
  <ul>
    <li>
      <h2>Follow List</h2>
    </li>
    <li>
    <li>
      @foreach ($users as $userId)
      <!-- @php
      $user = App\User::find($userId);
      $imagePath = $user->images; // ユーザーの画像パスを取得
      $imageUrl = asset('/images/' . $imagePath); // 画像のURLを生成
      $imageUrl = asset('/storage/images/' . $imagePath); // 画像のURLを生成
      @endphp -->
      <div class="container02">
        <a href="/users/{{ $userId }}">
          <img src="{{ asset('/storage/images/' . $user->images) }}">
        </a>
      </div>
      @endforeach
    </li>
  </ul>
</div>
<span></span>

@php
$sortedPosts = $posts->sortByDesc('created_at');
@endphp

@foreach($sortedPosts as $post)
<!-- @php
$images = $post->user->images; // ユーザーの画像パスを取得
$imageUrl = asset('/storage/images/' . $images); // 画像のURLを生成
@endphp -->
<div id="UserIsFollowing">
  <ul>
    <li>
      <a href="/users/{{ $userId }}">
        <img src="{{ asset('/storage/images/' . $post->user->images) }}">
      </a>
    </li>
    <li>
      <p>{{ $post->user->username }}</p>
      <p>{!! nl2br(e($post->post)) !!}</p>
    </li>
    <li>
      <p>{{ $post->created_at }}</p>
    </li>
  </ul>
</div>
<span></span>
@endforeach

@endsection
