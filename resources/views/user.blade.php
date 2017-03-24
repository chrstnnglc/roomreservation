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
          <td class="user_name">singkosa153</td>
        </tr>
        <tr>
          <td>Name</td>
          <td class="full_name">Yes</td>
        </tr>
        <tr>
          <td>E-Mail</td>
          <td class="e-mail">iamsusceptibletohackers@example.com</td>
        </tr>
        <tr>
          <td>Password</td>
          <td class="password">*****</td>
        </tr>
      </tbody>
    </table>
    <a href="{{url('edit_user')}}">
    <div class="container">
      <div class="ui yellow button">
        Edit Details
      </div>
    </div>
    </a>
  </div>
</div>
@stop