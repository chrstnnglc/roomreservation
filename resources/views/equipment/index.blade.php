@extends('layouts.master')
@section('name')
<title>Equipment - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 50%;
@stop
@section('items')
@if (Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="active item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'user')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="active item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@endif
@stop
@section('content')

@if (Auth::user() !== NULL and Auth::user()->users_role == 'admin')
<div class = "container" align = "center">
  <div class="container" align="center" style="padding: 5px 0px 5px 0px; height: 50%; width: 25%;">
    <a href="{{url('/equipment/form')}}" class="ui yellow fluid button">Add Equipment</a>
  </div>
</div>
@endif
    @forelse ($equipments as $equip)
      @if ($loop->first)
            <table class="ui celled yellow table">
            <thead>
          <tr>
            <?php 
              $new_ord = ($ord == 'asc')?'desc':'asc';
            ?>
            <th><a href = "{{ url('equipment') }}?sort=name{{ ($sort == 'name')?'&ord='.$new_ord:''}}">
                Equipment
              <i class="sort {{ ($sort == 'name')?$new_ord.'ending':''}} icon"></i>
              </a>
            </th>
            <th><a href = "{{ url('equipment') }}?sort=brand{{ ($sort == 'brand')?'&ord='.$new_ord:''}}">
                Brand
              <i class="sort {{ ($sort == 'brand')?$new_ord.'ending':''}} icon"></i>
              </a>
            </th>
            <th><a href = "{{ url('equipment') }}?sort=model{{ ($sort == 'model')?'&ord='.$new_ord:''}}">
                Model
              <i class="sort {{ ($sort == 'model')?$new_ord.'ending':''}} icon"></i>
              </a>
            </th>
            <th><a href = "{{ url('equipment') }}?sort=price{{ ($sort == 'price')?'&ord='.$new_ord:''}}">
                Price
              <i class="sort {{ ($sort == 'price')?$new_ord.'ending':''}} icon"></i>
              </a>
            </th>
            <th><a href = "{{ url('equipment') }}?sort=condition{{ ($sort == 'condition')?'&ord='.$new_ord:''}}">
                Condition
              <i class="sort {{ ($sort == 'condition')?$new_ord.'ending':''}} icon"></i>
              </a>
            </th>
            <th><a href = "{{ url('equipment') }}?sort=room_id{{ ($sort == 'room_id')?'&ord='.$new_ord:''}}">
                Room
              <i class="sort {{ ($sort == 'room_id')?$new_ord.'ending':''}} icon"></i>
              </a>
            </th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody>
      @endif
    <tr>

      <td class="equipment">{{$equip->name}}</td>
      <td class="brand">{{$equip->brand}}</td>
      <td class="model">{{$equip->model}}</td>
      <td class="price">Php {{ number_format((float)$equip->price, 2, '.', '') }}</td>
      <td class="condition">{{$equip->condition}}</td>
      @if ($equip->room != "")
        <td class="room">{{$equip->room->name}}</td>
      @else
        <td class="room"></td>
      @endif
      <td class="options">
        <!--<div class="container" align="center" style="padding: 0px 0px 0px 0px; height: 50%; width: 50%;">-->
          <a href="/equipment/{{ $equip->id }}" class="ui tiny yellow fluid button">View</a>
        <!--</div>-->
      </td>
    </tr>
    @if ($loop->last)
    </tbody>
</table>
    @endif
    @empty
      <h1>No equipment to show.</h1>
    @endforelse

@stop

<!-- name, brand, model, price, condition, room -->