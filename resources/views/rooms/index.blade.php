@extends('layouts.master')
@section('name')
<title>Rooms - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 40%;
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="active item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@stop
@section('content')
@if (Auth::user() !== NULL and Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
<div class = "container" align = "center">
  <div class="container" align="center" style="padding: 5px 0px 5px 0px; height: 50%; width: 25%;">
  <a href="{{url('/rooms/form')}}" class="ui yellow fluid button">Add Room</a>
</div>
</div>
@endif
<table class="ui celled yellow table">
  <thead>
    <tr>
      <th>Room Name</th>
      <th>Rate</th>
      <th>Capacity</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($rooms as $room)
        <tr>
            <td class="room">{{ $room->name }}</td>
            <td class="rate">{{ $room->rate }}</td>
            <td class="capacity">{{ $room->capacity }}</td>
            <td class="options">
              <div class="container" align="center" style="padding: 0px 0px 0px 0px;">
                <a href="/rooms/{{ $room->id }}" class="ui tiny yellow fluid button">View</a>
              </div>
            </td>
            </tr>
    @endforeach
</tbody>
</table>
@stop

<!--  -->