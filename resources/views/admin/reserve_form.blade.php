@extends('admin.master')
@section('name')
<title>Reservations - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="active item" style="font-size: 110%" href = "{{url('/admin/reserve')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/room')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/log')}}">Logs</a>
@stop
@section('content')
<div class="ui middle aligned center aligned grid">
  <div class="column">
	<form class="ui large form">
	  <div class="ui yellow stacked segment">
	    <div class="field">
	      <div class="ui input">
	        <input type="text" name="room_name" placeholder="Room Name">
	      </div>
	    </div>
	    <div class="field">
	      <div class="ui input">
	        <input type="text" name="date" placeholder="Date">
	      </div>
	    </div>
	    <div class="field">
	      <div class="ui input">
	        <input type="text" name="start_time" placeholder="Start Time">
	      </div>
	    </div>
	    <div class="field">
	      <div class="ui input">
	        <input type="text" name="end_time" placeholder="End Time">
	      </div>
	    </div>
	    <a href="{{url('/admin/reserve')}}">
	    <div class="container" align="center">
	    <div class="conatiner" style="width: 50%;">
	    <div class="ui fluid large yellow submit button">Submit!</div></a>
	    </div>
	  </div>
	  </form>
	</div>
</div>
@stop