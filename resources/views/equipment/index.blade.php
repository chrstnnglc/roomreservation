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
<a class="item" style="font-size: 110%" href = "{{url('profile')}}">{{Auth::user()->username}}</a>
@stop
@section('content')

@if (Auth::user() !== NULL and Auth::user()->users_role == 'admin')
<div class = "container" align = "center">
  <div class="container" align="center" style="padding: 5px 0px 5px 0px; height: 50%; width: 25%;">
    <a href="{{url('/equipment/form')}}" class="ui yellow fluid button">Add Equipment</a>
  </div>
</div>
@endif

<table class="ui celled yellow table">
  <thead>
    <tr>
      <th>Equipment</th>
      <th>Brand</th>
      <th>Model</th>
      <th>Price</th>
      <th>Condition</th>
      <th>Room</th>
      <th></th>
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
      <td class="room">{{$equip->room->name}}</td>
      <td class="options">
        <!--<div class="container" align="center" style="padding: 0px 0px 0px 0px; height: 50%; width: 50%;">-->
          <a href="/equipment/{{ $equip->id }}" class="ui yellow fluid button">View</a>
        <!--</div>-->
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@stop

<!-- name, brand, model, price, condition, room -->