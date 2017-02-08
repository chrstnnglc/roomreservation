<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Login Example - Semantic</title>

  <link rel="stylesheet" type="text/css" href="{{ asset('/css/semantic.min.css') }}">
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
  <script src="{{asset('/js/login.js')}}"></script>


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
      max-width: 450px;
    }
  </style>
</head>
<body>
  <div class="ui secondary top fixed inverted red borderless menu">
    <div class="container" style="padding: 10px 0 10px 10px;">
      <img src="12logo.png">
    </div>
    <h3 class="header item">Room Reservation System</h3>
  </div>

<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui red image header">
      <img src="sprite.png" class="image">
      <div class="content">
        Log-in to your account
      </div>
    </h2>
    <form class="ui large form">
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="email" placeholder="E-mail address">
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="password" placeholder="Password">
          </div>
        </div>
        <div class="ui fluid large red submit button">Login</div>
      </div>

      <div class="ui error message"></div>

    </form>

    <div class="ui message">
      New to us? <a href="#">Sign Up</a>
    </div>
  </div>
</div>

</body>

</html>