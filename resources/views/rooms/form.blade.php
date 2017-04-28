@extends('layouts.master')
@section('name')
<title>Rooms - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 25%;
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="active item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@stop

@section('content')
<h3>Add Rooms</h3>

<form method="POST" class="ui form" action="/rooms">
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
        <input type="text" name="roomname" placeholder="Name" value = "{{ old('roomname') }}">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="rate" placeholder="Rate" value = "{{ old('rate') }}">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="capacity" placeholder="Capacity"  value = "{{ old('capacity') }}">
      </div>
    </div>
   <a href="{{url('/rooms')}}">
      <button class="ui yellow fluid button" type="submit">Add</button>
    </a>
  </div>
</form>
@stop