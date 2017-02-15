@extends('admin.master')

@section('content')

Room information here.

Pati equipment.

<table class="ui celled red table">
<tr>
	<td class="room">{{ $room->name }}</td>
	<td class="rates">{{ $room->capacity }}</td>
	<td class="capacity">{{ $room->rate }}</td>
	<td class="options">
		<button><a href="/admin/rooms/{{ $room->id }}">Edit</a></button>
	</td>
	</tr>
</table>

<form method="POST" action="/admin/rooms">
	{{ csrf_field() }}
	
	<input type="hidden" name="roomname">
	<input type="hidden" name="rate">
	<input type="hidden" name="capacity">
	<button type="submit" id="add">Delete Room</button>
</form>
@stop