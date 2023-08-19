<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <!--IEブラウザ対策-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="ページの内容を表す文章" />
  <title></title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
  <!--スマホ,タブレット対応-->
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <!--サイトのアイコン指定-->
  <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
  <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
  <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
  <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
  <!--iphoneのアプリアイコン指定-->
  <link rel="apple-touch-icon-precomposed" href="画像のURL" />
  <!--OGPタグ/twitterカード-->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="./js/script.js"></script>
</head>

<body>
  <header>

    <ul id="head">
      <li>
        <h1><a href="{{ url('/top') }}"><img src="{{ asset('/images/atlas.png') }}"></a></h1>
      </li>
      <div class="right-aligned">
        <ul>
          <li>
            @if (Auth::check())
            <p>{{ Auth::user()->username }}さん</p>
            @endif
          </li>
          <li class="btn-space">
            <p class="nav-open"></p>
            <nav>
              <a href="/top">ホーム</a>
              <a href="/profileEdit">プロフィール</a>
              <a href="/logout">ログアウト</a>
            </nav>
          </li>
          <li>
            @if (Auth::check())
            <img src="{{ asset('/images/' . Auth::user()->images) }}">
            @endif
          </li>
        </ul>
      </div>
    </ul>
  </header>


  <div id="row">
    <div id="container">
      @yield('content')
    </div>
    <div id="side-bar">
      <div id="confirm">
        @if (Auth::check())
        <p>{{ Auth::user()->username }}さんの</p>
        @endif
        <div class="btn_space">
          <ul>
            <li>
              フォロー数 {{ Auth::user()->followUsers()->count() }}名
            </li>
            <li>
              <a href="/follow-list" class="btn">フォローリスト</a>
            <li>
              フォロワー数 {{ Auth::user()->followers()->count() }}名
            <li>
              <a href="/follower-list" class="btn">フォロワーリスト</a>
            </li>
          </ul>
        </div>
      </div>
      <span></span>
      <div class="user_search">
        <p class="btn"><a href="/search">ユーザー検索</a></p>
      </div>
    </div>
</body>
</html>
