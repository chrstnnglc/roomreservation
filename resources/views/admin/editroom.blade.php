@extends('admin.master')
@section('name')
<title>Rooms - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/admin/reserve')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/equipment')}}">Equipment</a>
<a class="active item" style="font-size: 110%" href = "{{url('/admin/room')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/log')}}">Logs</a>
@stop
@section('content')
<div class="ui middle aligned center aligned grid">
  <div class="column">
		<h1>Edit Room</h1>				

		<form method="POST">
			{{ method_field('PUT') }}
			{{ csrf_field() }}
			<div class="ui yellow stacked segment">
				<div class="field">
					<input type="hidden" name="id" value="{{ $room->id }}">
				</div>
				<div class="field">
					<input type="text" name="roomname" value="{{ $room->name }}">
				</div>
				<div class="field">
					<input type="text" name="rate" value="{{ $room->rate }}">
				</div>
				<div class="field">
			  	<input type="text" name="capacity" value="{{ $room->capacity }}">
			  </div>
			</div>
			<a href="{{url('/admin/rooms')}}">
			<button class="ui fluid yellow button" type="submit">Update</button>
			</a>
		</form>
	</div>
</div>

@stop