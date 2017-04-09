<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
 @yield('name')
  <link rel="stylesheet" typ  - Diocese of Cubao Reservation Systeme="text/css" href="{{ asset('/css/semantic.min.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('/css/divider.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/segment.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/form.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/input.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/button.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/list.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/message.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/icon.css') }}">

  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="{{asset('/js/semantic.min.js')}}"></script>
  <script src="{{asset('/js/main.js')}}"></script>

  <script>
    $('#idDropDown').dropdown('get value');
  </script>

  <style type="text/css">
    body {
      background-color: #DADADA;
      overflow: auto;
    }
    body > .grid {
      height: 100%;

    }
    .image {
      margin-top: -100px;
    }
    .column {
      @yield('width')
      max-height: 75%;
    }
  </style>
</head>
<body>
  <div class="ui secondary top fixed inverted blue borderless menu">
    <div class="container" style="padding: 10px 0 10px 10px;">
      <img src="{{asset('12logo.png')}}">
    </div>
    <div class="container" style="padding: 10px 0 10px 10px;">
    <a href="{{url('/')}}"><h3 class="header item">Room Reservation System</h3></a>
    </div>
    @yield('items')
    <div class="right menu">
        @if (Auth::guest())
        <div class="container" align="center">
        <div class="container" style="padding: 15px 10px 10px 0;">
        <a href="{{url('/login')}}" class="ui yellow fluid button">Login</a>
        </div>
        </div>
        <div class="container" align="center">
        <div class="container" style="padding: 15px 10px 10px 0;">
        <a href="{{url('/register')}}" class="ui yellow fluid button">Register!</a>
        </div>
        </div>
        @else
        <div class="container" style="padding: 15px 10px 10px 0;">
        <form action="{{ url('/logout') }}" method="POST" style = "display: inline-block;">
        {{ csrf_field() }}
        <button type = "submit" class="ui yellow fluid button"><div>
          Logout
        </div></button>
        </form>
        @endif
      </div>
    </div>
  </div>
  <div class="ui middle aligned center aligned grid">
    <div class="column">
      @yield('content')
    </div>
  </div>
</body>
</html>
