@extends('layouts.master')
@section('name')
<title>Users - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 50%;
@stop
@section('items')
@if (Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'treasury')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
@elseif (Auth::user()->users_role == 'user')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="active item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@endif
@stop
@section('content')

      @forelse ($reserves as $reserve)
        @if ($loop->first)
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
        @endif
        <tr>
            <td class="room">{{ $reserve->date_of_reservation }}</td>
            <td class="room">{{ $reserve->room->name }}</td>
            <td class="date">{{ $reserve->date_reserved }}</td>
            <td class="start_time">{{ date('g:iA', strtotime($reserve->start_of_reserved)) }}</td>
            <td class="end_time">{{ date('g:iA', strtotime($reserve->end_of_reserved)) }}</td>
            <td class="hours">{{ $reserve->hours }}</td>
            <td class="price">Php {{ number_format((float)$reserve->price, 2, '.', '') }}</td>
            <td class="or_number">{{ $reserve->or_number }}</td>
        </tr>
              @if ($loop->last)
    </tbody>
</table>
    @endif
        @empty
          <h1>You have no reservations yet.</h1>
        @endforelse
<a href="../profile">Back to Profile</a>
</form>
@stop
