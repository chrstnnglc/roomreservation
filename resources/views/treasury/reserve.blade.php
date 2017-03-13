@extends('media.master')
@section('name')
<title>Reservations - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="active item" style="font-size: 110%" href = "{{url('/media/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/equipments')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/logs')}}">Logs</a>
@stop
@section('content')

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
    @unless ($reserve->reservations_status == "waitlisted")
    <tr>
      <td class="room">{{ $reserve->date_reserved }}</td>
      <td class="user">{{ $reserve->user_id }}</td>
      <td class="room">{{ $reserve->room_id }}</td>
      <td class="date">{{ $reserve->date_of_reservation }}</td>
      <td class="start_time">{{ $reserve->start_of_reserved }}</td>
      <td class="end_time">{{ $reserve->end_of_reserved }}</td>
      <td class="hours">{{ $reserve->hours }}</td>
      <td class="price">{{ $reserve->price }}</td>
      <td class="status">
        <form class = "" method = "POST" action="{{ url('treasury/reservation/' . $reserve->id) }}">
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
      </td>
    </tr>
    @endunless
  @endforeach
  </tbody>
</table>
@stop

<!-- User, Room, date of res, date reserved, starttime, endtime, hours, price, date_paid-->