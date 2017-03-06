@extends('media.master')
@section('name')
<title>Equipment - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/media/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/user')}}">Users</a>
<a class="active item" style="font-size: 110%" href = "{{url('/media/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/logs')}}">Logs</a>
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
	<td class="options">
		<button><a href="/media/equipments/{{ $equipment->id }}/editequipment">Edit</a></button>
	</td>
	</tr>
</table>

<form method="POST" action="/media/equipments/{{ $equipment->id }}">
	{{ csrf_field() }}
	
	<input type="hidden" name="id" value="{{ $equipment->id }}">
	<input type="hidden" name="equipment" value="{{ $equipment->equipment }}">
	<input type="hidden" name="brand" value="{{ $equipment->brand }}">
	<input type="hidden" name="price" value="{{ $equipment->price }}">
	<input type="hidden" name="condition" value="{{ $equipment->rate }}">
	<input type="hidden" name="room_id" value="{{ $equipment->capacity }}">
	<button type="submit">Delete Equipment</button>
</form>
@stop