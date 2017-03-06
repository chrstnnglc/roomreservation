@extends('media.master')
@section('name')
<title>Log - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/media/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/equipments')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/rooms')}}">Rooms</a>
<a class="active item" style="font-size: 110%" href = "{{url('/media/logs')}}">Logs</a>
@stop
@section('content')
<div class="ui middle aligned center aligned grid" style="width=100%;">
  <div class="column">
    <table class="ui celled yellow table">
      <thead>
        <tr>
          <th>Log No.</th>
          <th>Date</th>
          <th>Reservation</th>
          <th>User</th>
        </tr>
      </thead>
      <tbody>
            <tr>
                <td class="log_no"></td>
                <td class="date"></td>
                <td class="reservation"></td>
                <td class="user"></td>
            </tr>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@stop