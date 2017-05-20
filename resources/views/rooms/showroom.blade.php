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

<table class="ui celled yellow table">
<thead>
<tr>
<th>Name</th>
<th>Rate (inclusive of equipment)</th>
<th>Capacity</th>
@if (Auth::user() !== NULL and Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
<th>Options</th>
@endif
</tr>
</thead>
<tbody>
<tr>
	<td class="room">{{ $room->name }}</td>
	<td class="rates">Php {{ number_format((float)$room->rate, 2, '.', '') }}</td>
	<td class="capacity">{{ $room->capacity }}</td>
	@if (Auth::user() !== NULL and Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
	<td class="options">
		<div class="container" align="center">
			<a href="/rooms/{{ $room->id }}/editroom" class="ui tiny yellow fluid button">Edit</a>
		</div>
	</td>
	@endif
</tr>
</tbody>
</table>

<!-- @if (Auth::user() !== NULL and Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
<form method="POST" action="/rooms/{{ $room->id }}">
	{{ csrf_field() }}
	
	<input type="hidden" name="id" value="{{ $room->id }}">
	<input type="hidden" name="roomname" value="{{ $room->name }}">
	<input type="hidden" name="rate" value="{{ $room->rate }}">
	<input type="hidden" name="capacity" value="{{ $room->capacity }}">
	<div class="container" align="center">
	<div class="container" align="center" style="padding: 5px 0px 5px 0px; height: 50%; width: 25%;">
		<button type="submit" class="ui red fluid button">Delete Room</button>
	</div>
	</div>
</form>
@endif -->
@stop
