@extends('layouts.master')
@section('name')
<title>Reservations - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 90%;
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
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
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
  @if (count($errors) > 0)
  <div class = "ui left aligned inverted red stacked segment">
      <i class="warning icon"></i>
      Warning!
      <ul>
          @foreach ($errors->all() as $error)
              <li class = "">{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif
  
  @forelse ($reserves as $reserve)
    @if ($loop->first)
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
          <th>Date Paid</th>
          <th>OR Number</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody>  
    @endif
    <tr>
      <td class="room">{{ $reserve->date_of_reservation }}</td>
      <td class="user">{{ $reserve->user->username }}</td>
      <td class="room">{{ $reserve->room->name }}</td>
      <td class="date">{{ $reserve->date_reserved }}</td>
      <td class="start_time">{{ date('g:iA', strtotime($reserve->start_of_reserved)) }}</td>
      <td class="end_time">{{ date('g:iA', strtotime($reserve->end_of_reserved)) }}</td>
      <td class="hours">{{ $reserve->hours }}</td>
      <td class="price">Php {{ number_format((float)$reserve->price, 2, '.', '') }}</td>
      <td class="status">{{ $reserve->reservations_status }}</td>
      <td class="date_paid">{{ $reserve->date_paid }}</td>
      <td class="or_number">{{ $reserve->or_number }}</td>
      <td>
      
        @if(Auth::user()->username == $reserve->user->username or Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
        <form method="POST" action="/reservations/{{ $reserve->id }}">
          {{ csrf_field() }}
          
          <input type="hidden" name="id" value="{{ $reserve->id }}">
          <div class = "container" align = "center">
            <div class="container" align="center" style="padding: 5px 0px 5px 0px;">
              <button type="submit" class="ui red tiny fluid button" onclick = "return confirm('This action cannot be undone. If you have paid, please note that your payment is non-refundable. Are you sure?');">Cancel</button>
            </div>
          </div>
        </form>
        @endif

        @if(Auth::user()->users_role=='treasury' and $reserve->reservations_status == "not paid")
        <form class = "" method = "POST" action="{{ url('reservations/' . $reserve->id) }}">
          {!! method_field('PATCH') !!}
          {{ csrf_field() }}

          <div class="ui mini input">
            <input type="text" placeholder="OR Number" name = "or_number" style="width: 90%;">
            <button class="ui very compact mini blue button" type = "submit" onclick = "return confirm('This action cannot be undone. Are you sure?')"><font size='1'>Confirm</font></button>
          </div>
        </form>
        @endif
      </td>
    </tr>
        @if ($loop->last)
    </tbody>
</table>
    @endif
  @empty
    <h1>No reservations to show.</h1>
  @endforelse
@stop