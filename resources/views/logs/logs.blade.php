@extends('admin.master')
@section('name')
<title>Log - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/admin/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/rooms')}}">Rooms</a>
<a class="active item" style="font-size: 110%" href = "{{url('/admin/logs')}}">Logs</a>
@stop
@section('content')
<div class="ui middle aligned center aligned grid" style="width=100%;">
  <div class="column">
    <table class="ui celled yellow table">
      <thead>
        <tr>
          <th>Log No.</th>
          <th>Date</th>
          <th>Reservation</th>
          <th>User</th>
        </tr>
      </thead>
      <tbody>
            <tr>
                <td class="id"></td>
                <td class="user_id"></td>
            </tr>
        </tr>
        @foreach ($logs as $log)
            <tr>
            <td class="id">{{ $log->id }}</td>
            <td class="user_id">{{ $log->user_id }}</td>
            </tr>
    @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop