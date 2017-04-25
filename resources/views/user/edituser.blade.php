@extends('layouts.master')
@section('name')
<title>Equipment - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 25%;
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="active item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
@stop
@section('content')
<div class="ui middle aligned center aligned grid">
  <div class="column">
	<h1>Edit User</h1>				
		
		@if (count($errors) > 0)
		<div class = "ui left aligned inverted red stacked segment">
			<i class="warning icon"></i>
			Can't update!
			<ul>
				@foreach ($errors->all() as $error)
					<li class = "">{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif

	    <form class="ui large form" method="POST" action="/user/{{ $user->id }}">
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
					<input type="password" name="password" value="" placeholder = "Password">
				</div>
				<div class="field">
					<input type="password" name="password_confirmation" value="" placeholder = "Confirm Password">
				</div>
				<div class="field">
					<input type="text" name="mobile" value="{{ $user->mobile }}">
				</div>
				<div class="field">
			  	<input type="text" name="affiliation" value="{{ $user->affiliation }}">
			  </div>

			  <div class="field">
		      <select name="users_role" class="ui dropdown" id="select">
		        <option value=""></option>
		        <option value="admin"
					@if($user->users_role == "admin")
						selected
					@endif
				>Admin</option>
		        <option value="media"
					@if($user->users_role == "media")
						selected
					@endif
				>Media</option>
		        <option value="treasury"
					@if($user->users_role == "treasury")
						selected
					@endif>Treasury</option>
		        <option value="user"
					@if($user->users_role == "user")
						selected
					@endif
				>User</option>
		      </select>
		    </div>
	        </div>
	        <a href="{{url('/user')}}">
	        	<button class="ui yellow fluid button" type="submit">Update</button>
	    	</a>
	    </form>
	</div>
</div>