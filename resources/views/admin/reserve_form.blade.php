@extends('admin.master')
@section('name')
<title>Reservations - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="active item" style="font-size: 110%" href = "{{url('/admin/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/equipments')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/logs')}}">Logs</a>
@stop
@section('content')
<div class="ui middle aligned center aligned grid">
  <div class="column">
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
	        <input type="date" name="date" value = "{{ $reserve->date }}">
	      </div>
	    </div>
	    <div class="field">
	      <div class="ui input">
	        <input type="time" name="starttime" value = "{{ $reserve->starttime }}">
	      </div>
	    </div>
	    <div class="field">
	      <div class="ui input">
	        <input type="time" name="endtime" value = "{{ $reserve->endtime }}">
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