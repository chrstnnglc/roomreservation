@extends('layouts.master')
@section('name')
<title>Reservations - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 25%;
@stop
@section('items')
@if (Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
<a class="active item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'treasury')
<a class="active item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'user')
<a class="active item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>@endif
@stop
@section('content')
<div class="ui middle aligned center aligned grid">
	<h3>Add Reservation</h3>

	<form class="ui form" method="POST" action="{{ url('/reservations')}}">
	<!--{{ method_field('PUT') }}-->
	{{ csrf_field() }}

	          @if (count($errors) > 0 || isset($conflict))
            <div class = "ui left aligned inverted red stacked segment">
                <i class="warning icon"></i>
									Can't Add!
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class = "">{{ $error }}</li>
                    @endforeach
										@if(isset($conflict))
												<li class = "">{{ $conflict }}</li>
										@endif
                </ul>
            </div>
            @endif

	  <div class="ui yellow stacked segment">
	    <div class="field">
	      <select name="roomname" class="ui dropdown" id="select">
		        <option value="">Select Room</option>
		        @foreach ($rooms as $room)
		        	<!-- <option value="{{ $room-> name }}">{{ $room->name }}</option> -->
		        	<option value = "{{ $room->name }}"
          
		            @if (old('roomname') == $room->name)
		            	selected
		            @endif
		            >{{ $room->name }}</value>
		        @endforeach
		    </select>
	    </div>
	    <div class="field">
	    	@foreach ($equipment as $equip)
		    	<div class="ui checkbox">
				  <input type="checkbox" name="addlequip[]" value={{ $equip->id }}>
				  <label>{{ $equip->name }} - Php {{ $equip->price }}</label>
				</div>
				<br>
			@endforeach
	    </div>
	    @if (Auth::user() !== NULL and Auth::user()->users_role != 'user')
			<div class="field">
	      	<select name="username" class="ui dropdown" id="select">
			        <option value="">Select User</option>
			        @foreach ($users as $user)
			        	@if($user->users_role == 'admin' or $user->users_role == 'media')
			        		<option value="{{ $user->username }}"
          
						        @if (old('username') == $user->username)
	            				selected
	          					@endif
			        		>{{ $user->username }}</option>
			        	@endif
			        @endforeach
			    </select>
	    </div>
	    @endif
	    <div class="field">
	      <div class="ui input">
	        <input type="date" name="date" placeholder="mm/dd/yyyy" value = "{{ old('date') }}">
	      </div>
	    </div>
	    <div class="field">
	      	<select name="starttime" class="ui dropdown" id="select">
		        <option value="">Select Start Time</option>
		        @for ($i = 0; $i < 24; $i+=0.5)
		        @if($i/0.5 % 2 == 0)
		        	<option value="{{ $i }}:00"
		        	
		        		@if (old('starttime') == $i . ":00")
	            		selected
	          			@endif
			        >{{ $i }}:00</option>
		        @else
		        	<option value="{{ $i-0.5 }}:30"
		        		@if (old('starttime') == $i-0.5 . ":30")
	            		selected
	          			@endif
			        >{{ $i-0.5 }}:30</option>
		        @endif
		        @endfor
		    </select>
	    </div>
	    <div class="field">
	      <div class="ui input">
	      	<select name="endtime" class="ui dropdown" id="select">
		        <option value="">Select End Time</option>
		        @for ($i = 0; $i < 24; $i+=0.5)
		        @if($i/0.5 % 2 == 0)
		        	<option value="{{ $i }}:00"
		        	
		        		@if (old('endtime') == $i . ":00")
	            		selected
	          			@endif
			        >{{ $i }}:00</option>
		        @else
		        	<option value="{{ $i-0.5 }}:30"
		        		@if (old('endtime') == $i-0.5 . ":30")
	            		selected
	          			@endif
			        >{{ $i-0.5 }}:30</option>
		        @endif
		        @endfor
		    </select>
	      </div>
	    </div>
	    
	    <div id = "terms" style="height: 200px; overflow: scroll; text-align: left;">
	    	Upon submission, please pay the amount within 2 days in order to keep your reservation.
		    <br><br>
		    An ingress of 1 hour and egress of 30 minutes are included in your reservation.
		    <br><br>
		    
	   	</div>

	    <div class="field">
	    	<div class="ui slider checkbox">
			  <input type="checkbox" name="termsconditions" onchange="document.getElementById('submit').disabled = !this.checked;">
			  <label>I accept the terms and conditions.</label>
			</div>
		</div>

		<div class="container" align="center">
	    <div class="container" style="width: 50%;">

	    	<input class="ui fluid large yellow submit button" type = "submit" value = "Submit" id = "submit" disabled>

		</div>
		</div>
	  </form>
@stop