@extends('layouts.master')
@section('name')
<title>Equipment - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 25%;
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="active item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@stop
@section('content')
<div class="ui middle aligned center aligned grid">
  <div class="column">
  	<br>
	<h2>Edit Equipment</h2>				
		
		@if (count($errors) > 0)
		<div class = "ui left aligned inverted red stacked segment">
			<i class="warning icon"></i>
			Can't update!
			<ul>
				@foreach ($errors->all() as $error)
					<li class = "">{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif

	    <form class="ui large form" method="POST" action="/equipment/{{ $equipment->id }}">
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
			    	<input type="number" name="price" value="{{ $equipment->price }}">
			    </div>
			    <div class="field">
		    		<input type="text" name="condition" value="{{ $equipment->condition }}">
		    	</div>

				<div class="field">
					<select class = "ui search dropdown" name = "room">
						<option value = ""></option>
						
						@foreach ($rooms as $room)
						<option value = "{{ $room->name }}" 
						@if($equipment->room)
							@if($equipment->room->name == $room->name)
								selected
							@endif
						@endif			
						>{{ $room->name }}</value>
						@endforeach
					</select>
				</div>
	        </div>
	        <a href="{{url('/equipment')}}">
	        	<button class="ui yellow fluid button" type="submit">Update</button>
	    	</a>
	    </form>
	</div>
</div>
