@extends('layouts.master')
@section('name')
<title>Rooms - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="active item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
@stop
@section('content')

<table class="ui celled yellow table">
  <thead>
    <tr>
      <th>Room Name</th>
      <th>Capacity</th>
      <th>Rate</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($rooms as $room)
        <tr>
            <td class="room">{{ $room->name }}</td>
            <td class="rates">{{ $room->capacity }}</td>
            <td class="capacity">{{ $room->rate }}</td>
            <td class="options">
              <button><a href="/rooms/{{ $room->id }}">View Room</a></button>
            </td>
            </tr>
    @endforeach
</tbody>
</table>

@if (Auth::user() !== NULL and Auth::user()->users_role == 'admin')
<div class="container" align="center" style="padding: 5px 0px 5px 0px; height: 50%; width: 25%;">
<a href="{{url('/rooms/room_form')}}">
  <button class="ui yellow fluid button">Add Equipment</button>
</a>
</div>
@endif
@stop

<!--  -->