<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Calendar - Diocese of Cubao Reservation System</title>
  <link rel="stylesheet" typ  - Diocese of Cubao Reservation Systeme="text/css" href="{{ asset('/css/semantic.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/calendar.min.css') }}">

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
      max-width: 80%;
      max-height: 80%;
    }
  </style>
</head>
<body>
  <div class="ui secondary top fixed inverted red borderless menu">
    <div class="container" style="padding: 10px 0 10px 10px;">
      <img src="12logo.png">
    </div>
    <h3 class="header item">Room Reservation System</h3>
    <a class="active item" style="font-size: 110%">Calendar</a>
    <a class="item" style="font-size: 110%">Reservations</a>
    <a class="item" style="font-size: 110%">User</a>
    <div class="right menu">
      <div class="container" style="padding: 18px 10px 10px 0;">
        <div class="ui button" style="font-size: 75%;">
          Logout
        </div>
      </div>
    </div>
  </div>
  @yield('content')
</body>
</html>