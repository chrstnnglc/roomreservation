@extends('admin.master')
@section('name')
<title>Rooms - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/admin/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/equipment')}}">Equipment</a>
<a class="active item" style="font-size: 110%" href = "{{url('/admin/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/logs')}}">Logs</a>
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
              <button><a href="/admin/rooms/{{ $room->id }}">View Room</a></button>
            </td>
            </tr>
    @endforeach
</tbody>
</table>

<h3>Add Rooms</h3>

<form method="POST" class="ui form" action="/admin/rooms">
  {{ csrf_field() }}
  <div class="ui yellow stacked segment">
    <div class="field">
      <div class="ui input">
        <input type="text" name="roomname" placeholder="Name">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="rate" placeholder="Rate">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="capacity" placeholder="Capacity">
      </div>
    </div>
   <a href="{{url('/admin/rooms')}}">
      <button class="ui yellow fluid button" type="submit">Add</button>
    </a>
  </div>
</form>
@stop

<!--  -->