@extends('layouts.master')
@section('name')
<title>History - Diocese of Cubao Reservation System</title>
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
      @forelse ($reserves as $reserve)
        @if ($loop->first)
            <table class="ui celled yellow table">
            <thead>
            <tr>
              <th>Date Reserved</th>
              <th>Room</th>
              <th>Additional Equipment Reserved</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Hours</th>
              <th>Price</th>
              <th>Status</th>
              <th>OR Number</th>
            </tr>
          </thead>
          <tbody>
        @endif
        <tr>
            <td class="date">{{ $reserve->date_reserved }}</td>
            <td class="room">{{ $reserve->room->name }}</td>
            <td>
              @foreach ($reserve->equipment as $addleq)
                {{ $addleq->equipment_name }}: {{ $addleq->equipment_brand }} {{ $addleq->equipment_model }}
                <br>
              @endforeach
            </td>
            <td class="start_time">{{ date('g:iA', strtotime($reserve->start_of_reserved)) }}</td>
            <td class="end_time">{{ date('g:iA', strtotime($reserve->end_of_reserved)) }}</td>
            <td class="hours">{{ $reserve->hours }}</td>
            <td class="price">Php {{ number_format((float)$reserve->price, 2, '.', '') }}</td>
            <td class="status">{{ $reserve->reservations_status }}</td>
            <td class="or_number">{{ $reserve->or_number }}</td>
        </tr>
              @if ($loop->last)
    </tbody>
    </table>
    @endif
        @empty
          <h1>This user has no reservations yet.</h1>
        @endforelse


<a href="../{{ $user->id }}">Back to Profile</a>
</form>
@stop
