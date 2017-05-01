@extends('layouts.master')
  @section('name')
  <title>Register - Diocese of Cubao Reservation System</title>
  @stop
  @section('width')
      max-width: 450px;
  @stop
@section('content')
    <h2>
      <div class="content">
        Sign up for your account!
      </div>
    </h2>
    <form class="ui large form" role="form" method="POST" action="{{ url('/register') }}">
      {{ csrf_field() }}

            @if (count($errors) > 0)
            <div class = "ui inverted red stacked segment">
                <i class="warning icon"></i>
                Can't Sign Up!
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class = "">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

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
@stop