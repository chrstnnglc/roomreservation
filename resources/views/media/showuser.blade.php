@extends('media.master')
@section('name')
<title>Equipment - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/media/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/user')}}">Users</a>
<a class="active item" style="font-size: 110%" href = "{{url('/media/equipments')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/media/logs')}}">Logs</a>
@stop
@section('content')


<table class="ui celled yellow table">
<tr>
    <td class="username">{{ $user->username }}</td>
    <td class="firstname">{{ $user->firstname }}</td>
    <td class="lastname">{{ $user->lastname }}</td>
    <td class="email">{{ $user->email }}</td>
    <td class="mobile">{{ $user->mobile }}</td>
    <td class="affiliation">{{ $user->affiliation }}</td>
    <td class="users_role">{{$user->users_role}}</td>
	<td class="options">
		<button><a href="/media/user/{{ $user->id }}/edituser">Edit</a></button>
	</td>
	</tr>
</table>

<form method="POST" action="/media/user/{{ $user->id }}">
	{{ csrf_field() }}
	
	<input type="hidden" name="id" value="{{ $user->id }}">
	<input type="hidden" name="username" value="{{ $user->username }}">
	<input type="hidden" name="firstname" value="{{ $user->firstname }}">
	<input type="hidden" name="lastname" value="{{ $user->lastname }}">
	<input type="hidden" name="email" value="{{ $user->email }}">
	<input type="hidden" name="mobile" value="{{ $user->mobile }}">
	<input type="hidden" name="affiliation" value="{{ $user->affiliation }}">
	<input type="hidden" name="users_role" value="{{ $user->users_role }}">
	<button type="submit">Delete User</button>
</form>
@stop