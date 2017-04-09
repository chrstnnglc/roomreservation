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

<h3>Add Equipment</h3>

<form method="POST" class="ui form" action="/equipment">
  {{ csrf_field() }}

  @if (count($errors) > 0)
  <div class = "ui left aligned inverted red stacked segment">
      <i class="warning icon"></i>
      Can't add!
      <ul>
          @foreach ($errors->all() as $error)
              <li class = "">{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif

  <div class="ui yellow stacked segment">
    <div class="field">
      <div class="ui input">
        <input type="text" name="equipment" placeholder="Equipment name">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="brand" placeholder="Brand">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="model" placeholder="Model">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="number" name="price" placeholder="Price">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="condition" placeholder="Condition">
      </div>
    </div>
    <div class="field">
      <!--<div class="ui input">
        <input type="text" name="room" placeholder="Room Name">
      </div>-->
      <select class = "ui search dropdown" name = "room">
          <option value = ""></value>
        @foreach ($rooms as $room)
          <option value = "{{ $room->name }}">{{ $room->name }}</value>
        @endforeach
      </select>
    </div>
    <div class="container">
    <a href="{{url('/equipment')}}">
      <button class="ui yellow fluid button" type="submit">Add</button>
    </a>
    </div>
  </div>

</form>
@stop