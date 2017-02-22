@extends('menu')
@section('name')
<title>Reservations - Diocese of Cubao Reservation System</title>
@stop
@section('style')
<style type="text/css">
body {
  background-color: #DADADA;
  overflow: auto;
}
body > .grid {
  height: 100%;
}
.image {
  margin-top: -100px;
}
.column {
  max-width: 450px;
}
</style>
@stop
@section('items')
<a class="item" style="font-size: 110%" href="{{url('/')}}">Calendar</a>
<a class="active item" style="font-size: 110%" href="{{url('reserve')}}">Reservations</a>
<a class="item" style="font-size: 110%" href="{{url('user')}}">User</a>
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
	    <a href="{{url('reserve')}}">
	    <div class="container" align="center">
	    <div class="conatiner" style="width: 50%;">
	    <div class="ui fluid large yellow submit button">Submit!</div></a>
	    </div>
	  </div>
	  </form>
	</div>
</div>
@stop