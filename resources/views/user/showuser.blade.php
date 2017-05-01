@extends('layouts.master')
@section('name')
<title>Equipment - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 60%;
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="active item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
@stop
@section('content')


<table class="ui celled yellow table">
<thead>
<tr>
<th>User Name</th>
<th>First Name</th>
<th>Last Name</th>
<th>E-mail</th>
<th>Mobile</th>
<th>Affiliation</th>
<th>Role</th>
@if (Auth::user() !== NULL and Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
<th>Options</th>
@endif
</tr>
</thead>
<tbody>
<tr>
    <td class="username">{{ $user->username }}</td>
    <td class="firstname">{{ $user->firstname }}</td>
    <td class="lastname">{{ $user->lastname }}</td>
    <td class="email">{{ $user->email }}</td>
    <td class="mobile">{{ $user->mobile }}</td>
    <td class="affiliation">{{ $user->affiliation }}</td>
    <td class="users_role">{{$user->users_role}}</td>
    @if (Auth::user() !== NULL and Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
	<td class="options">
		<a href="/user/{{ $user->id }}/edituser"  class = "ui fluid tiny yellow submit button">Edit</a>
	</td>
	@endif
	</tr>
</tbody>
</table>

@if (Auth::user() !== NULL and Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
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
	<div class = "container" align = "center">
		<div class="container" align="center" style="padding: 5px 0px 5px 0px; height: 50%; width: 25%;">
			<button type="submit" class="ui yellow fluid button">Delete User</button>
		</div>
	</div>
</form>
@endif
@stop