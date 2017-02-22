@extends('admin.master')
@section('name')
<title>Equipment - Diocese of Cubao Reservation System</title>
@stop
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/admin/reserve')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/user')}}">Users</a>
<a class="active item" style="font-size: 110%" href = "{{url('/admin/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/room')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/log')}}">Logs</a>
@stop
@section('content')

<br><br><br><br><br>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Store</h1>
				</div>

				<div class="panel-body">				

                    <form method="POST" action="/admin/equipments/{{ $equipment->id }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <br>
                        <div class="form-group">
                        	Name: <input type="text" name="equipment" value={{ $equipment->name }}>
					    	Brand: <input type="text" name="brand" value={{ $equipment->brand }}>
						    Model: <input type="text" name="model" value={{ $equipment->model }}>
						    Price: <input type="text" name="price" value={{ $equipment->price }}>
					    	Condition: <input type="text" name="condition" value={{ $equipment->condition }}>
						    Room ID: <input type="text" name="room_id" value={{ $equipment->room_id }}>
                        </div>
                        <br>
                        <div class="form-group">
                        	<button type="submit">Update</button>
                    	</div>


                    </form>
				</div>
		</div>
	</div>
</div>