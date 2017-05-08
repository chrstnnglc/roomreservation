@extends('layouts.master')
@section('name')
<title>Rooms - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 40%;
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="active item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>@stop
@section('content')
@if (Auth::user() !== NULL and Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
        @forelse ($logs as $log)
            @if ($loop->first)
        <table class="ui celled yellow table">
              <thead>
                <tr>
                  <?php 
                    $new_ord = ($ord == 'asc')?'desc':'asc';
                  ?>
                  <th><a href = "{{ url('logs') }}?sort=id{{ ($sort == 'id')?'&ord='.$new_ord:''}}">
                      Log No.
                    <i class="sort {{ ($sort == 'id')?$new_ord.'ending':''}} icon"></i>
                    </a>
                  </th>
                  <th><a href = "{{ url('logs') }}?sort=user_id{{ ($sort == 'user_id')?'&ord='.$new_ord:''}}">
                      User Id
                    <i class="sort {{ ($sort == 'user_id')?$new_ord.'ending':''}} icon"></i>
                    </a>
                  </th>
                  <th><a href = "{{ url('logs') }}?sort=date_of_reservation{{ ($sort == 'date_of_reservation')?'&ord='.$new_ord:''}}">
                      Date of Reservation
                    <i class="sort {{ ($sort == 'date_of_reservation')?$new_ord.'ending':''}} icon"></i>
                    </a>
                  </th>
                  <th>Remarks</th>
                </tr>
              </thead>
              <tbody>
            @endif
            <tr>
            <td class="id">{{ $log->id }}</td>
            <td class="user_id">{{ $log->user->username }}</td>
            <td class="user_id">{{ $log->date_of_reservation }}</td>
            <td class="remarks">{{ $log->remarks }}</td>
            </tr>
      @if ($loop->last)
      </tbody>
      </table>
      @endif
    @empty
      <h1>There are no logs to show.</h1>
    @endforelse
@endif
@stop

<!--  -->