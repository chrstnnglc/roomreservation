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
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>@endif
@stop
@section('content')
<!--<div class="ui middle aligned center aligned grid">
  <div class="column">-->
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
		        	<option value="{{ $room-> name }}">{{ $room->name }}</option>
		        @endforeach
		    </select>
	    </div>
	    @if (Auth::user() !== NULL and Auth::user()->users_role != 'user')
			<div class="field">
	      <select name="username" class="ui dropdown" id="select">
			        <option value="">Select User</option>
			        @foreach ($users as $user)
			        	@if($user->users_role != 'treasury')
			        		<option value="{{ $user->username }}">{{ $user->username }}</option>
			        	@endif
			        @endforeach
			    </select>
	    </div>
	    @endif
	    <div class="field">
	      <div class="ui input">
	        <input type="date" name="date" value = "" placeholder="mm/dd/yyyy">
	      </div>
	    </div>
	    <div class="field">
	      	<select name="starttime" class="ui dropdown" id="select">
		        <option value="">Select Start Time</option>
		        @for ($i = 0; $i < 24; $i+=0.5)
		        @if($i/0.5 % 2 == 0)
		        	<option value="{{ $i }}:00">{{ $i }}:00</option>
		        @else
		        	<option value="{{ $i-0.5 }}:30">{{ $i-0.5 }}:30</option>
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
		        	<option value="{{ $i }}:00">{{ $i }}:00</option>
		        @else
		        	<option value="{{ $i-0.5 }}:30">{{ $i-0.5 }}:30</option>
		        @endif
		        @endfor
		    </select>
	      </div>
	    </div>

	    <div id = "terms" style="height: 200px; overflow: scroll; text-align: left;">
	    	    Upon submission, please pay the amount within 2 days in order to keep your reservation.
		    <br><br>
		    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pretium nunc eu libero fermentum, vulputate vehicula urna vulputate. Cras dui turpis, aliquam vitae sodales vel, imperdiet eget ligula. Nunc in cursus sem, vitae suscipit quam. Curabitur auctor nibh ac condimentum lobortis.
		    <br><br>
		    Duis eget arcu eu quam posuere volutpat. Sed non ultrices tellus. Proin auctor nulla feugiat, gravida elit nec, commodo dolor. Aliquam in tincidunt lacus. Phasellus fringilla porttitor lorem et finibus. Vivamus non mauris sit amet elit vulputate porta. Integer id bibendum lorem. Duis eget nulla sed orci blandit sodales ac nec erat. 
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
	<!--</div>
</div>-->
@stop
