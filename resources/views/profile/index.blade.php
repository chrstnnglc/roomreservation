@extends('layouts.master')
@section('items')
@if (Auth::user()->users_role=='admin')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="active item" style="font-size: 110%" href = "{{url('profile')}}">{{Auth::user()->username}}</a>
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
            <td class="name">{{ Auth::user()->last_name }} {{Auth::user()->first_name}}</td>
        </tr>
        <tr>
            <td>E-mail:</td>
            <td class="capacity">{{ Auth::user()->Email }}</td>
        </tr>
  </tbody>
</table>
@stop