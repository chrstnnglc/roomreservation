@extends('layouts.master')
@section('items')
@section('name')
<title>Profile - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 40%;
@stop
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="active item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
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
            <td class="username">{{ $user->username }}</td>
        </tr>
        <tr>
            <td>Name:</td>
            <td class="name">{{ $user->firstname }} {{Auth::user()->lastname}}</td>
        </tr>
        <tr>
            <td>E-mail:</td>
            <td class="capacity">{{ $user->email }}</td>
        </tr>
        <tr>
            <td>Mobile:</td>
            <td class="capacity">{{ $user->mobile }}</td>
        </tr>
        <tr>
            <td>Affiliation:</td>
            <td class="capacity">{{ $user->affiliation }}</td>
        </tr>
        <tr>
          <td colspan="3"><a href="/user/{{ $user->id }}/past">View previous reservations</a></td>
        </tr>
  </tbody>
</table>

<a href="/user/{{ $user->id }}/edituser"  class = "ui fluid large yellow submit button">Edit</a>
<form method="POST" action="/user/{{ $user->id }}">
	{{ csrf_field() }}
	
	<input type="hidden" name="id" value="{{ $user->id }}">
	<input type="hidden" name="username" value="{{ $user->username }}">
	<input type="hidden" name="firstname" value="{{ $user->firstname }}">
	<input type="hidden" name="lastname" value="{{ $user->lastname }}">
	<input type="hidden" name="email" value="{{ $user->email }}">
	<input type="hidden" name="mobile" value="{{ $user->mobile }}">
	<input type="hidden" name="affiliation" value="{{ $user->affiliation }}">
	<input type="hidden" name="users_role" value="{{ $user->users_role }}">
	<div class="container" align="center" style="padding: 5px 0px 0px 0px">
		<button type="submit" class="ui fluid large red submit button">Delete User</button>
	</div>
</form>
@stop