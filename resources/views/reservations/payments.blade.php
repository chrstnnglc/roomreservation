@extends('layouts.master')
@section('name')
<title>Payments - Diocese of Cubao Reservation System</title>
@stop
@section('items')
@if (Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
<a class="active item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'treasury')
<a class="active item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'user')
<a class="active item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@endif
@stop
@section('content')
<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h3>Payments</h3>
    <table class="ui celled yellow table">
      <thead>
        <tr>
          <th>Date</th>
          <th>Reservation</th>
          <th>User</th>
          <th>Paid?</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="date"></td>
          <td class="reservation"></td>
          <td class="user"></td>
          <td class="paid">
            <div class="container" style="padding: 5px 0px 5px 0px; height: 50%; width: 50%;">
            <div class="ui fluid large yellow submit button" style="font-size: 75%;">Confirm</div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@stop