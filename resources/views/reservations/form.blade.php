@extends('layouts.master')
@section('name')
<title>Reservations - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 50%;
@stop
@section('items')
@if (Auth::user()->users_role == 'admin')
<a class="active item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'treasury')
<a class="active item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'user')
<a class="active item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('profile')}}">{{Auth::user()->username}}</a>
@endif
@stop
@section('content')
<div class="ui middle aligned center aligned grid">
  <div class="column">
	<form class="ui large form" method="POST" action="{{ url('/reservations')}}">
	<!--{{ method_field('PUT') }}-->
	{{ csrf_field() }}
	  <div class="ui yellow stacked segment">
	    <div class="field">
	      <div class="ui input">
			<select name="roomname" class="ui dropdown" id="select">
		        <option value=""></option>
		        @foreach ($rooms as $room)
		        	<option value="{{ $room-> name }}">{{ $room->name }}</option>
		        @endforeach
		    </select>
	      </div>
	    </div>
	    @if (Auth::user() !== NULL and Auth::user()->users_role != 'user')
			<div class="field">
	      <div class="ui input">
	        <input type="text" name="username" placeholder = "Enter user name">
	      </div>
	    </div>
	    @endif
	    <div class="field">
	      <div class="ui input">
	        <input type="date" name="date" value = "" placeholder="mm/dd/yyyy">
	      </div>
	    </div>
	    <div class="field">
	      	<select name="starttime" class="ui dropdown" id="select">
		        <option value=""></option>
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
		        <option value=""></option>
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
	    <!--<a href="{{url('/reservations')}}">-->
	    <div class="container" align="center">
	    <div class="conatiner" style="width: 50%;">
	    <input class="ui fluid large yellow submit button" type = "submit" value = "Add"/>
	    </div>
	  </div>
	  </form>
	</div>
</div>
@stop
