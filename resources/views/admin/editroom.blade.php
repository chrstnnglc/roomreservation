<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Store</h1>
				</div>

				<div class="panel-body">				

                    <form method="POST" action="/admin/rooms">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div>
                        	Name: <input type="text" name="roomname" value={{ $room->name }}>
					    	Rate: <input type="text" name="rate" value={{ $room->rate }}>
						    Capacity: <input type="text" name="capacity" value={{ $room->capacity }}>
                        </div>

                        <button type="submit">Update</button>

                    </form>
				</div>
		</div>
	</div>
</div>