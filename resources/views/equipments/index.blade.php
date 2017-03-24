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

<table class="ui celled red table">
  <thead>
    <tr>
      <th>Equipment</th>
      <th>Brand</th>
      <th>Model</th>
      <th>Price</th>
      <th>Condition</th>
      <th>Room</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($equipments as $equip)
    <tr>

      <td class="equipment">{{$equip->name}}</td>
      <td class="brand">{{$equip->brand}}</td>
      <td class="model">{{$equip->model}}</td>
      <td class="price">{{$equip->price}}</td>
      <td class="condition">{{$equip->condition}}</td>
      <td class="room_id">{{$equip->room_id}}</td>
      <td class="options">
        <button><a href="/equipments/{{ $equip->id }}">View Equipment</a></button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@if (Auth::user() !== NULL and Auth::user()->users_role == 'admin')
<div class="container" align="center" style="padding: 5px 0px 5px 0px; height: 50%; width: 25%;">
<a href="{{url('equipments/equipment_form')}}">
  <button class="ui yellow fluid button">Add Equipment</button>
</a>
</div>
@endif
@stop

<!-- name, brand, model, price, condition, room -->