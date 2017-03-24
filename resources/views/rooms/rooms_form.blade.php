@extends('layouts.master')
@section('name')
<title>Rooms - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="active item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
@stop
@section('content')
<h3>Add Rooms</h3>

<form method="POST" class="ui form" action="/rooms">
  {{ csrf_field() }}
  <div class="ui yellow stacked segment">
    <div class="field">
      <div class="ui input">
        <input type="text" name="roomname" placeholder="Name">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="rate" placeholder="Rate">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="capacity" placeholder="Capacity">
      </div>
    </div>
   <a href="{{url('/rooms')}}">
      <button class="ui yellow fluid button" type="submit">Add</button>
    </a>
  </div>
</form>
@stop