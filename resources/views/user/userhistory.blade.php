@extends('layouts.master')
@section('name')
<title>Users - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 50%;
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>

@stop
@section('content')
<table class="ui celled yellow table">
  <thead>
    <tr>
      <th>Date of Reservation</th>
      <th>Room</th>
      <th>Date Reserved</th>
      <th>Start Time</th>
      <th>End Time</th>
      <th>Hours</th>
      <th>Price</th>
      <th>OR Number</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($reserves as $reserve)
        <tr>
            <td class="room">{{ $reserve->date_of_reservation }}</td>
            <td class="room">{{ $reserve->room->name }}</td>
            <td class="date">{{ $reserve->date_reserved }}</td>
            <td class="start_time">{{ $reserve->start_of_reserved }}</td>
            <td class="end_time">{{ $reserve->end_of_reserved }}</td>
            <td class="hours">{{ $reserve->hours }}</td>
            <td class="price">Php {{ $reserve->price }}</td>
            <td class="or_number">{{ $reserve->or_number }}</td>
        </tr>
      @endforeach
  </tbody>
</table>
<a href="../{{ $reserve->user_id }}">Back to Profile</a>
</form>
@stop