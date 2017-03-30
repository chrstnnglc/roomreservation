@extends('layouts.master')
@section('name')
<title>Reservations - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="active item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('profile')}}">{{Auth::user()->username}}</a>
@stop
@section('content')

<div class="container" align="center">
<div class="container" style="padding: 5px 0px 5px 0px; height: 50%; width: 25%;">
<a href="{{url('/reservations/form')}}" class="ui yellow fluid button">New Reservation</a>
</div>
</div>

<table class="ui celled yellow table">
  <thead>
    <tr>
      <th>Date Reserved</th>
      <th>User</th>
      <th>Room</th>
      <th>Date of Reservation</th>
      <th>Start Time</th>
      <th>End Time</th>
      <th>Hours</th>
      <th>Price</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($reserves as $reserve)
    <tr>
      <td class="room">{{ $reserve->date_reserved }}</td>
      <td class="user">{{ $reserve->user->username }}</td>
      <td class="room">{{ $reserve->room->name }}</td>
      <td class="date">{{ $reserve->date_of_reservation }}</td>
      <td class="start_time">{{ $reserve->start_of_reserved }}</td>
      <td class="end_time">{{ $reserve->end_of_reserved }}</td>
      <td class="hours">{{ $reserve->hours }}</td>
      <td class="price">{{ $reserve->price }}</td>
      <td class="status">
      @if(Auth::user()->users_role=='treasury')
        <form class = "" method = "POST" action="{{ url('reservation/' . $reserve->id) }}">
          {!! method_field('PATCH') !!}
          {{ csrf_field() }}
          <select class="ui dropdown" name = "status">
            <option value="paid"
              @if ($reserve->reservations_status == "paid")
                selected
              @endif
            >Paid</option>
            <option value="not paid"
              @if ($reserve->reservations_status == "not paid")
                selected
              @endif
            >Not Paid</option>
          </select>

          <input class="ui primary button" type = "submit" value = "Save" />
        </form>
      @else
      {{ $reserve->reservations_status }}
      @endif
      </td>
    </tr>
  @endforeach

  
  </tbody>
</table>
@stop

<!-- User, Room, date of res, date reserved, starttime, endtime, hours, price, date_paid-->
