@extends('layouts.master')
@section('name')
<title>Reservations - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 50%;
@stop
@section('items')
@if (Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
<a class="active item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'treasury')
<a class="active item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'user')
<a class="active item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@endif
@stop
@section('content')
@if (Auth::user()->users_role != 'treasury')
<div class="container" align="center">
<div class="container" style="padding: 5px 0px 5px 0px; height: 50%; width: 25%;">
<a href="{{url('/reservations/form')}}" class="ui yellow fluid button">New Reservation</a>
</div>
</div>
@endif

<table class="ui celled yellow table">
  <thead>
    <tr>
      <th>Date of Reservation</th>
      <th>User</th>
      <th>Room</th>
      <th>Date Reserved</th>
      <th>Start Time</th>
      <th>End Time</th>
      <th>Hours</th>
      <th>Price</th>
      <th>Status</th>
      <th>OR Number</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($reserves as $reserve)
    <tr>
      <td class="room">{{ $reserve->date_of_reservation }}</td>
      <td class="user">{{ $reserve->user->username }}</td>
      <td class="room">{{ $reserve->room->name }}</td>
      <td class="date">{{ $reserve->date_reserved }}</td>
      <td class="start_time">{{ $reserve->start_of_reserved }}</td>
      <td class="end_time">{{ $reserve->end_of_reserved }}</td>
      <td class="hours">{{ $reserve->hours }}</td>
      <td class="price">{{ $reserve->price }}</td>
      <td class="status">
      @if(Auth::user()->users_role=='treasury' and $reserve->reservations_status == "not paid")
        <form class = "" method = "POST" action="{{ url('reservations/' . $reserve->id) }}">
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
            <div class="field">
              <input type="text" name="or_number" placeholder="OR Number">
            </div>
          <input class="ui primary button" type = "submit" value = "Save" />
        </form>
      @else
      {{ $reserve->reservations_status }}
      @endif
      </td>
      <td class="or_number">{{ $reserve->or_number }}</td>
    </tr>
  @endforeach

  
  </tbody>
</table>
@stop

<!-- User, Room, date of res, date reserved, starttime, endtime, hours, price, date_paid-->
