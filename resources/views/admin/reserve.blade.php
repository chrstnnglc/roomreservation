@extends('admin.master')
@section('name')
<title>Reservations - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="active item" style="font-size: 110%" href = "{{url('/admin/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/room')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/log')}}">Logs</a>
@stop
@section('content')

<table class="ui celled yellow table">
  <thead>
    <tr>
      <th>Date</th>
      <th>User</th>
      <th>Room</th>
      <th>Start Time</th>
      <th>End Time</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($reserves as $reserve)
    <tr>
      <td class="date"></td>
      <td class="user"></td>
      <td class="room"></td>
      <td class="start_time"></td>
      <td class="end_time"></td>
    </tr>
  @endforeach
  </tbody>
</table>

<div class="container" align="center">
<div class="container" style="padding: 5px 0px 5px 0px; height: 50%; width: 25%;">
<a href="{{url('/admin/reserve_form')}}">
<div class="ui fluid large yellow button" style="font-size: 75%;">New Reservation</div>
</a>
</div>
</div>
</form>
</form>
@stop

<!-- User, Room, date of res, date reserved, starttime, endtime, hours, price, date_paid-->