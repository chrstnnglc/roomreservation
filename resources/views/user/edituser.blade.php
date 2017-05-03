@extends('layouts.master')
@section('name')
<title>Edit User - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 25%;
@stop
@section('items')
@if (Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="active item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'treasury')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'user')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@endif
@stop
@section('content')
<div class="ui middle aligned center aligned grid">
  <div class="column">
  <br>
	<h2>Edit User</h2>
		
		@if (count($errors) > 0 || isset($error))
		<div class = "ui left aligned inverted red stacked segment">
			<i class="warning icon"></i>
			Can't update!
			<ul>
				@foreach ($errors->all() as $error1)
					<li class = "">{{ $error1 }}</li>
				@endforeach
				@if(isset($error))
					<li class = "">{{$error}}</li>
				@endif
			</ul>
		</div>
		@endif
		
			

		@if (Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
	    <form class="ui large form" method="POST" action="/user/{{ $user->id }}">
	        {{ method_field('PUT') }}
	        {{ csrf_field() }}
	        <div class="ui yellow stacked segment">
				<div class="field">
					<input type="text" name="username" value="{{ $user->username }}" placeholder = "Username">
				</div>
				<div class="field">
					<input type="text" name="firstname" value="{{ $user->firstname }}" placeholder = "First Name">
				</div>
				<div class="field">
			  	<input type="text" name="lastname" value="{{ $user->lastname }}" placeholder = "Last Name">
			  </div>
			  <div class="field">
					<input type="text" name="email" value="{{ $user->email }}"placeholder = "Email">
				</div>
				<div class="field">
					<input type="password" name="password" value="" placeholder = "Password">
				</div>
				<div class="field">
					<input type="password" name="password_confirmation" value="" placeholder = "Confirm Password">
				</div>
				<div class="field">
					<input type="text" name="mobile" value="{{ $user->mobile }}" placeholder = "Mobile (09xxxxxxxxx)">
				</div>
				<div class="field">
			  	<input type="text" name="affiliation" value="{{ $user->affiliation }}" placeholder = "Affiliation">
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
	    @else
	    <form class="ui large form" method="POST" action="/user/{{ $user->id }}">
	        {{ method_field('PUT') }}
	        {{ csrf_field() }}
	        <div class="ui yellow stacked segment">
				<div class="field">
					<input type="text" name="username" value="{{ $user->username }}" placeholder = "Username">
				</div>
				<div class="field">
					<input type="text" name="firstname" value="{{ $user->firstname }}" placeholder = "First Name">
				</div>
				<div class="field">
			  	<input type="text" name="lastname" value="{{ $user->lastname }}" placeholder = "Last Name">
			  </div>
			  <div class="field">
					<input type="text" name="email" value="{{ $user->email }}" placeholder = "Email">
				</div>
				<div class="field">
					<input type="text" name="mobile" value="{{ $user->mobile }}" placeholder = "Mobile (09xxxxxxxxx)">
				</div>
				<div class="field">
			  	<input type="text" name="affiliation" value="{{ $user->affiliation }}" placeholder = "Affiliation">
			  </div>
			  <div class="field">
			  	<input type="hidden" name="users_role" value="{{ $user->users_role }}">
			  </div>

				<div class="field">
						<input type="password" name="old_password" value="" placeholder = "Current Password">
					</div>
			  <div class="field">
					<input type="password" name="password" value="" placeholder = "New Password">
				</div>
				<div class="field">
					<input type="password" name="password_confirmation" placeholder = "Confirm New Password">
				</div>
	        </div>
	        <a href="{{url('/user')}}">
	        	<button class="ui yellow fluid button" type="submit">Update</button>
	    	</a>
	    </form>
	    @endif
	</div>
</div>
