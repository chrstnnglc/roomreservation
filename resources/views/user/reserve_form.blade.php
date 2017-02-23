@extends('user.menu')
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
  	<h3> Reservation Form </h3>
	<form class="ui large form" method="POST" action="/admin/reservations/{{ $reserve->id }}">
	{{ method_field('PUT') }}
	{{ csrf_field() }}
	  <div class="ui yellow stacked segment">
	    <div class="field">
	      <div class="ui input">
	        <input type="text" name="roomname" value="{{ $reserve->id }}">
	      </div>
	    </div>
	    <div class="field">
	      <div class="ui input">
	        <input type="text" name="date" value = "{{ $reserve->date }}">
	      </div>
	    </div>
	    <div class="field">
	      <div class="ui input">
	        <input type="text" name="starttime" value = "{{ $reserve->starttime }}">
	      </div>
	    </div>
	    <div class="field">
	      <div class="ui input">
	        <input type="text" name="endtime" value = "{{ $reserve->endtime }}">
	      </div>
	    </div>
	    <a href="{{url('/admin/reservations')}}">
	    <div class="container" align="center">
	    <div class="conatiner" style="width: 50%;">
	    <div class="ui fluid large yellow submit button">Submit!</div></a>
	    </div>
	  </div>
	  </form>
	</div>
</div>
@stop

<!-- <input type="hidden" name="id" value="{{ $room->id }}">
Name: <input type="text" name="roomname" value={{ $room->name }}><br>
Rate: <input type="text" name="rate" value={{ $room->rate }}><br>
Capacity: <input type="text" name="capacity" value={{ $room->capacity }}><br> -->