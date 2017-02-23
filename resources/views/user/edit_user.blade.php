@extends('user.menu')
@section('name')
<title>User - Diocese of Cubao Reservation System</title>
@stop
@section('style')
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
@stop
@section('items')
<a class="item" style="font-size: 110%" href="{{ url('/') }}">Calendar</a>
<a class="item" style="font-size: 110%" href="{{ url('reserve') }}">Reservations</a>
<a class="active item" style="font-size: 110%" href="{{ url('user') }}">User</a>
@stop
@section('content')
<div class="ui middle aligned center aligned grid">
  <div class="column">
    <table class="ui yellow table">
      <thead>
        <tr>
          <th colspan="7">User Details</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>User Name</td>
          <td class="user_name">
              <div class="field">
                <div class="ui input">
                  <input type="text" name="user_name" placeholder="User Name">
                </div>
              </div>
          </td>
        </tr>
        <tr>
          <td>Name</td>
          <td class="full_name">
            <div class="field">
              <div class="ui input">
                <input type="text" name="full_name" placeholder="Full Name">
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>E-Mail</td>
          <td class="e-mail">
              <div class="field">
                <div class="ui input">
                  <input type="text" name="user_name" placeholder="User Name">
                </div>
              </div>
          </td>
        </tr>
        <tr>
          <td>Password</td>
          <td class="password">
            <div class="field">
              <div class="ui input">
                <input type="password" name="password" placeholder="Password">
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <a href = "{{url('user')}}">
    <div class="container">
      <div class="ui blue button">
        Submit!
      </div>
    </div>
    </a>
  </div>
</div>
@stop