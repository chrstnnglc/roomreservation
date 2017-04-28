@extends('layouts.master')
@section('items')
@section('name')
<title>Profile - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 40%;
@stop
@if (Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="active item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'treasury')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="active item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'user')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="active item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@endif
@stop

@section('content')
<table class="ui yellow table">
  <thead>
    <tr><th colspan="3">
      Profile
    </th>
  </tr></thead>
  <tbody>
        <tr>
            <td class="collapsing">Username:</td>
            <td class="username">{{ Auth::user()->username }}</td>
        </tr>
        <tr>
            <td>Name:</td>
            <td class="name">{{ Auth::user()->firstname }} {{Auth::user()->lastname}}</td>
        </tr>
        <tr>
            <td>E-mail:</td>
            <td class="capacity">{{ Auth::user()->email }}</td>
        </tr>
        <tr>
            <td>Mobile:</td>
            <td class="capacity">{{ Auth::user()->mobile }}</td>
        </tr>
        <tr>
            <td>Affiliation:</td>
            <td class="capacity">{{ Auth::user()->affiliation }}</td>
        </tr>
        <tr>
          <td colspan="3"><a href="">View previous reservations</a></td>
        </tr>
  </tbody>
</table>

<a href="/user/{{ $user->id }}/edituser"  class = "ui fluid large yellow submit button">Edit</a>
@stop