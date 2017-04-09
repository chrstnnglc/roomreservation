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
	        <input type="text" name="roomname" placeholder="Enter room name">
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
	      <div class="ui input">
	        <input type="time" name="starttime" value = "" placeholder="hh:mm">
	      </div>
	    </div>
	    <div class="field">
	      <div class="ui input">
	        <input type="time" name="endtime" value = "" placeholder="hh:mm">
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
