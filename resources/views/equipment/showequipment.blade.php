@extends('layouts.master')
@section('name')
<title>Equipment - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 40%;
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="active item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@stop
@section('content')


<table class="ui celled yellow table">
<thead>
<tr>
<th>Name</th>
<th>Brand</th>
<th>Model</th>
<th>Price</th>
<th>Condition</th>
<th>Room</th>
@if (Auth::user() !== NULL and Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
<th>Options</th>
@endif
</tr>
</thead>
<tr>
      <td class="equipment">{{$equipment->name}}</td>
      <td class="brand">{{$equipment->brand}}</td>
      <td class="model">{{$equipment->model}}</td>
      <td class="price">Php {{ number_format((float)$equipment->price, 2, '.', '') }}</td>
      <td class="condition">{{$equipment->condition}}</td>
      @if ($equipment->room)
	      <td class="room_id">{{$equipment->room->name}}</td>
	  @else
		  <td class="room_id"></td>
	  @endif    
      @if (Auth::user() !== NULL and Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
	<td class="options">
		<a href="/equipment/{{ $equipment->id }}/editequipment" class = "ui fluid tiny yellow submit button">Edit</a>
	</td>
	@endif
	</tr>
</table>

@if (Auth::user() !== NULL and Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
<form method="POST" action="/equipment/{{ $equipment->id }}">
	{{ csrf_field() }}
	
	<input type="hidden" name="id" value="{{ $equipment->id }}">
	<input type="hidden" name="equipment" value="{{ $equipment->equipment }}">
	<input type="hidden" name="brand" value="{{ $equipment->brand }}">
	<input type="hidden" name="price" value="{{ $equipment->price }}">
	<input type="hidden" name="condition" value="{{ $equipment->rate }}">
	<input type="hidden" name="room_id" value="{{ $equipment->room_id }}">
	<!-- <div class = "container" align = "center">
		<div class="container" align="center" style="padding: 5px 0px 5px 0px; height: 50%; width: 25%;">
			<button type="submit" class="ui red fluid button">Delete Equipment</button>
		</div>
	</div> -->
</form>
@endif
@stop
