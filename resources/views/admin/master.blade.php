<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Admin Home Page - Diocese of Cubao Reservation System</title>
  <link rel="stylesheet" typ  - Diocese of Cubao Reservation Systeme="text/css" href="{{ asset('/css/semantic.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/calendar.min.css') }}">

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
  <script src="{{asset('/js/calendar.min.js')}}"></script>
  <script src="{{asset('/js/main.js')}}"></script>

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
      max-width: 50%;
      max-height: 75%;
    }
  </style>
</head>
<body>
  <div class="ui secondary top fixed inverted red borderless menu">
    <div class="container" style="padding: 10px 0 10px 10px;">
      <img src="12logo.png">
    </div>
    <h3 class="header item">Room Reservation System</h3>
    <a class="item" style="font-size: 110%" href = "{{url('/admin/reserve')}}">Reservations</a>
    <a class="item" style="font-size: 110%" href = "{{url('/admin/user')}}">Users</a>
    <a class="item" style="font-size: 110%" href = "{{url('/admin/equipment')}}">Equipment</a>
    <a class="item" style="font-size: 110%" href = "{{url('/admin/room')}}">Rooms</a>
    <a class="item" style="font-size: 110%" href = "{{url('/admin/log')}}">Logs</a>
    <div class="right menu">
      <div class="container" style="padding: 18px 10px 10px 0;">
        <form action="{{ url('/logout') }}" method="POST" style = "display: inline-block;">
        {{ csrf_field() }}
        <button type = "submit" class="ui button" style="font-size: 75%;"><div>
          Logout
        </div></button>
        </form>

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
