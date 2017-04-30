@extends('layouts.master')
@section('name')
<title>Login - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 50%;
@stop

@section('content')
  <div class="ui middle aligned center aligned grid">
    <div class="column">
      <h2>
        <div class="content">
          Log-in to your account
        </div>
      </h2>
      <form class="ui large form" method = "POST" action = "{{url('/login')}}" >
      {{ csrf_field() }}
          
          @if (count($errors) > 0)
          <div class = "ui left aligned inverted red stacked segment">
              <!--<i class="warning icon"></i>
              Can't add!-->
              <ul>
                  @foreach ($errors->all() as $error)
                      <li class = "">{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
        
        <div class="ui yellow stacked segment">
          <div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="text" name="username" placeholder="Username">
            </div>
          </div>
          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="password" name="password" placeholder="Password">
            </div>
          </div>
          <div><button type = "submit" class="ui fluid large yellow submit button">Login</button></div>
        </div>

        <div class="ui error message"></div>

      </form>

      <div class="ui message">
        New to us? <li style = "list-style-type: none"><a href="/register">Sign Up!</a></li>
      </div>
    </div>
  </div>
@stop