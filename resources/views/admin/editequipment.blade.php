@extends('admin.master')
@section('name')
<title>Equipment - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/admin/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/user')}}">Users</a>
<a class="active item" style="font-size: 110%" href = "{{url('/admin/equipments')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/logs')}}">Logs</a>
@stop
@section('content')
<div class="ui middle aligned center aligned grid">
  <div class="column">
	<h1>Equipment</h1>				

	    <form class="ui large form" method="POST" action="/admin/equipments/{{ $equipment->id }}">
	        {{ method_field('PUT') }}
	        {{ csrf_field() }}
	        <div class="ui yellow stacked segment">
	        	<div class="field">
	        		<input type="text" name="equipment" value="{{ $equipment->name }}">
	        	</div>
	        	<div class="field">
		    		<input type="text" name="brand" value="{{ $equipment->brand }}">
		    	</div>
		    	<div class="field">
			    	<input type="text" name="model" value="{{ $equipment->model }}">
			    </div>
			    <div class="field">
			    	<input type="text" name="price" value="{{ $equipment->price }}">
			    </div>
			    <div class="field">
		    		<input type="text" name="condition" value="{{ $equipment->condition }}">
		    	</div>
		    	<div class="field">
			    	<input type="text" name="room_id" value="{{ $equipment->room_id }}">
			    </div>
	        </div>
	        <a href="{{url('/admin/equipment')}}">
	        	<button class="ui yellow fluid button" type="submit">Update</button>
	    	</a>
	    </form>
	</div>
</div>
