@extends('layouts.master')
@section('name')
<title>Equipment - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 25%;
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="active item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
@stop
@section('content')
<div class="ui middle aligned center aligned grid">1
  <div class="column">
	<h1>Room</h1>				

		<form class="ui large form" method="POST" action="/rooms/{{ $room->id }}">
			{{ method_field('PUT') }}
			{{ csrf_field() }}

			
			@if (count($errors) > 0)
			<div class = "ui left aligned inverted red stacked segment">
				<i class="warning icon"></i>
				Can't update!
				<ul>
					@foreach ($errors->all() as $error)
						<li class = "">{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			
			<div class="ui yellow stacked segment">
				<div class="field">
					<input type="hidden" name="id" value="{{ $room->id }}">
				</div>
				<div class="field">
					<input type="text" name="roomname" value="{{ old('roomname') or $room->name }}">
				</div>
				<div class="field">
					<input type="text" name="rate" value="{{ old('rate') or $room->rate }}">
				</div>
				<div class="field">
			  	<input type="text" name="capacity" value="{{ old('capacity') or $room->capacity }}">
			  </div>
			</div>
			<a href="{{url('/rooms')}}">
	        	<button class="ui yellow fluid button" type="submit">Update</button>
	    	</a>
	    </form>
	</div>
</div>