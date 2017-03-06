@extends('media.master')
@section('name')
<title>Rooms - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/media/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/equipments')}}">Equipment</a>
<a class="active item" style="font-size: 110%" href = "{{url('/media/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/logs')}}">Logs</a>
@stop
@section('content')

Room information here.

Pati equipment.

<table class="ui celled yellow table">
<tr>
	<td class="room">{{ $room->name }}</td>
	<td class="rates">{{ $room->capacity }}</td>
	<td class="capacity">{{ $room->rate }}</td>
	<td class="options">
		<button><a href="/media/rooms/{{ $room->id }}/editroom">Edit</a></button>
	</td>
	</tr>
</table>

<form method="POST" action="/media/rooms/{{ $room->id }}">
	{{ csrf_field() }}
	
	<input type="hidden" name="id" value="{{ $room->id }}">
	<input type="hidden" name="roomname" value="{{ $room->name }}">
	<input type="hidden" name="rate" value="{{ $room->rate }}">
	<input type="hidden" name="capacity" value="{{ $room->capacity }}">
	<button type="submit">Delete Room</button>
</form>
@stop