@extends('layouts.login')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="Profile_Edit">
  <form action="/profileUpdate" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form_Edit">
      <div>
        <ul>
          <li id="form_inner01">
            @if (Auth::check())
            <img src="{{ asset('/storage/images/' . Auth::user()->images) }}" class="img_icon">
            @endif
          </li>
          <li id="form_inner02">
            <ul>
              <li>
                <label for="name">User Name</label>
              </li>
              <li>
                <!-- UsersControllerの$user配列を利用して値を出力 -->
                <input type="text" id="name" name="username" value="{{ $user->username }}">
              </li>
            </ul>
            <ul>
              <li>
                <label for="mail">Email Address</label>
              </li>
              <li>
                <!-- UsersControllerの$user配列を利用して値を出力 -->
                <input type="mail" id="mail" name="mail" value="{{ $user->mail }}">
              </li>
            </ul>
            <ul>
              <li>
                <label for="password">Password</label>
              </li>
              <li>
                <input type="password" id="password" name="password" value="">
              </li>
            </ul>
            <ul>
              <li>
                <label for="password_confirmation">Confirm Password:</label>
              </li>
              <li>
                <input type="password" id="password_confirmation" name="password_confirmation" value="">
              </li>
            </ul>
            <ul>
              <li>
                <label for="bio">Bio</label>
              </li>
              <li>
                <!-- UsersControllerの$user配列を利用して値を出力 -->
                <input id="bio" name="bio" value="{{ $user->bio }}"></input>
              </li>
            </ul>
            <ul>
              <li>
                <label for="icon_image">Icon Image</label>
              </li>
              <li>
                <input type="file" id="images" name="images">
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <div id="form_button">
      <button type="submit">更新</button>
    </div>
  </form>
</div>

@endsection
