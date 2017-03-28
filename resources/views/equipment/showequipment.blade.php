@extends('layouts.master')
@section('name')
<title>Equipment - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="active item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
@stop
@section('content')


<table class="ui celled yellow table">
<tr>
      <td class="equipment">{{$equipment->name}}</td>
      <td class="brand">{{$equipment->brand}}</td>
      <td class="model">{{$equipment->model}}</td>
      <td class="price">{{$equipment->price}}</td>
      <td class="condition">{{$equipment->condition}}</td>
      <td class="room_id">{{$equipment->room_id}}</td>
      @if (Auth::user() !== NULL and Auth::user()->users_role == 'admin')
	<td class="options">
		<button><a href="/equipments/{{ $equipment->id }}/editequipment">Edit</a></button>
	</td>
	@endif
	</tr>
</table>

@if (Auth::user() !== NULL and Auth::user()->users_role == 'admin')
<form method="POST" action="/equipments/{{ $equipment->id }}">
	{{ csrf_field() }}
	
	<input type="hidden" name="id" value="{{ $equipment->id }}">
	<input type="hidden" name="equipment" value="{{ $equipment->equipment }}">
	<input type="hidden" name="brand" value="{{ $equipment->brand }}">
	<input type="hidden" name="price" value="{{ $equipment->price }}">
	<input type="hidden" name="condition" value="{{ $equipment->rate }}">
	<input type="hidden" name="room_id" value="{{ $equipment->room_id }}">
	<button type="submit">Delete Equipment</button>
</form>
@endif
@stop