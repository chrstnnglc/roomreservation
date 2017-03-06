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
<div class="ui middle aligned center aligned grid">
  <div class="column">
	<h1>User</h1>				

	    <form class="ui large form" method="POST" action="/media/user/{{ $user->id }}">
	        {{ method_field('PUT') }}
	        {{ csrf_field() }}
	        <div class="ui yellow stacked segment">
				<div class="field">
					<input type="text" name="username" value="{{ $user->username }}">
				</div>
				<div class="field">
					<input type="text" name="firstname" value="{{ $user->firstname }}">
				</div>
				<div class="field">
			  	<input type="text" name="lastname" value="{{ $user->lastname }}">
			  </div>
			  <div class="field">
					<input type="hidden" name="email" value="{{ $user->email }}">
				</div>
				<div class="field">
					<input type="text" name="password" value="{{ $user->password }}">
				</div>
				<div class="field">
					<input type="text" name="mobile" value="{{ $user->mobile }}">
				</div>
				<div class="field">
			  	<input type="text" name="affiliation" value="{{ $user->affiliation }}">
			  </div>
			  <div class="field">
			  	<input type="text" name="users_role" value="{{ $user->users_role }}">
			  </div>
	        </div>
	        <a href="{{url('/media/user')}}">
	        	<button class="ui yellow fluid button" type="submit">Update</button>
	    	</a>
	    </form>
	</div>
</div>