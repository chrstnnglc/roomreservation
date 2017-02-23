@extends('user.menu')
@section('name')
<title>Reservations - Diocese of Cubao Reservation System</title>
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
<a class="item" style="font-size: 110%" href="{{url('/')}}">Calendar</a>
<a class="active item" style="font-size: 110%" href="{{url('reserve')}}">Reservations</a>
<a class="item" style="font-size: 110%" href="{{url('user')}}">User</a>
@stop
@section('content')
<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h3>Reservations</h3>
    <table class="ui celled yellow table">
      <thead>
        <tr>
          <th>Date</th>
          <th>Room</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="date"></td>
          <td class="room"></td>
          <td class="start_time"></td>
          <td class="end_time"></td>
          <td>
          <div class="container" align="center">
            <div class="container" style="padding: 5px 0px 5px 0px; height: 50%; width: 50%;">
            <div class="ui fluid large yellow submit button" style="font-size: 75%;">Delete</div>
            </div>
            <div class="container" style="padding: 5px 0px 5px 0px; height: 50%; width: 50%;">
            <div class="ui fluid large yellow submit button" style="font-size: 75%;" >Edit</div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="container" align="center">
    <div class="container" style="padding: 5px 0px 5px 0px; height: 50%; width: 25%;">
    <a href="{{url('reserve_form')}}">
    <div class="ui fluid large yellow button" style="font-size: 75%;">New Reservation</div>
    </a>
    </div>
    </div>
  </div>
</div>
@stop