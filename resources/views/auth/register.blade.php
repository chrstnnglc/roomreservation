<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Register - Diocese of Cubao Reservation System</title>

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
  <div class="ui secondary top fixed inverted blue borderless menu">
    <div class="container" style="padding: 10px 0 10px 10px;">
      <img src="12logo.png">
    </div>
    <h3 class="header item">Room Reservation System</h3>
  </div>

<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h2>
      <div class="content">
        Sign up for your account!
      </div>
    </h2>
    <form class="ui large form" role="form" method="POST" action="{{ url('/register') }}">
      {{ csrf_field() }}
      <div class="ui yellow stacked segment">
        <div class="field">
        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
            <div class="col-md-6">
                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus placeholder="First Name">

                @if ($errors->has('firstname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('firstname') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        </div>

        <div class="field">
        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
            <div class="col-md-6">
                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required placeholder="Last Name">

                @if ($errors->has('lastname'))
                    <span class="help-block">
                        <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        </div>

        <div class="field">
        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
            <div class="col-md-6">
                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required placeholder="User Name">

                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        </div>

        <div class="field">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="E-Mail">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        </div>

        <div class="field">
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        </div>

        <div class="field">
        <div class="form-group">
            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
            </div>
        </div>
        </div>

        <div class="field">
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="ui fluid large yellow submit button">
                    Register
                </button>
            </div>
        </div>
        </div>
      </div>
  </form>
  </body>
  </html>