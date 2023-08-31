@extends('layouts.login')

@section('content')

<div class="all_container">
  <ul>
    <li>
      <h2>Follower List</h2>
    </li>
    <li>
      @foreach ($users as $userId)
      @php
      $user = App\User::find($userId);//Userモデル(userテーブル)にあるidが$userIdと同じものを見つける。
      $imagePath = $user->images; // ユーザーの画像パスを取得
      $imageUrl = asset('/storage/images/' . $imagePath); // 画像のURLを生成
      @endphp
      <div class="container02">
        <a href="/users/{{ $userId }}">
          <img src="{{ $imageUrl }}">
        </a>
      </div>
      @endforeach
    </li>
  </ul>
</div>
<span></span>

@php
$sortedPosts = $posts->sortByDesc('created_at');//指定したカラム（ここでは created_at カラム）の値を降順（大きい値から小さい値へ）でソートするためのメソッド
@endphp

@foreach($sortedPosts as $post)
@php
$images = $post->user->images; // ユーザーの画像パスを取得
$imageUrl = asset('/storage/images/' . $images); // 画像のURLを生成
@endphp

<div id="UserIsFollowing">
  <ul>
    <li>
      <a href="/users/{{ $userId }}">
        <img src="{{ $imageUrl }}">
      </a>
    </li>
    <li>
      <p>{{ $post->user->username }}</p>
      <!-- ▼改行された状態でindex.bladeに出力させる -->
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
