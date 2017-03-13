@extends('media.master')
@section('name')
<title>Equipment - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/media/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/user')}}">Users</a>
<a class="active item" style="font-size: 110%" href = "{{url('/media/equipments')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/logs')}}">Logs</a>
@stop
@section('content')
<div class="ui middle aligned center aligned grid">
  <div class="column">
	<h1>Room</h1>				

		<form class="ui large form" method="POST" action="/media/rooms/{{ $room->id }}">
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
			<a href="{{url('/media/rooms')}}">
	        	<button class="ui yellow fluid button" type="submit">Update</button>
	    	</a>
	    </form>
	</div>
</div>