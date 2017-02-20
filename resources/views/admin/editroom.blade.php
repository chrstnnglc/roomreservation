@extends('admin.master')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Edit Room</h1>
				</div>

				<div class="panel-body">				

                    <form method="POST" action="/admin/rooms/{{ $room->id }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div>
                        	<input type="hidden" name="id" value="{{ $room->id }}">
                        	Name: <input type="text" name="roomname" value={{ $room->name }}><br>
					    	Rate: <input type="text" name="rate" value={{ $room->rate }}><br>
						    Capacity: <input type="text" name="capacity" value={{ $room->capacity }}><br>
                        </div>

                        <button type="submit">Update</button>

                    </form>
				</div>
		</div>
	</div>
</div>

@stop