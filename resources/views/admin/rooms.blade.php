@extends('admin.master')

@section('content')

<table class="ui celled red table">
  <thead>
    <tr>
      <th>Room Name</th>
      <th>Rate</th>
      <th>Capacity</th>
      <th>Options</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($rooms as $room)
        <tr>
            <td class="room">{{ $room->name }}</td>
            <td class="rates">{{ $room->capacity }}</td>
            <td class="capacity">{{ $room->rate }}</td>
            <td class="options">
            <form method="POST" action="/admin/rooms">{{ method_field('PUT') }}<button type="submit">Edit</button></form>
            <form method="POST" action="/admin/rooms"><button type="submit">Delete</button></td></form>
            </tr>
    @endforeach
</tbody>
</table>

<h3>Add Rooms</h3>

<form method="POST" class="ui form" action="/admin/rooms">
  {{ csrf_field() }}
  <div class="ui stacked segment">
    <div class="field">
      <div class="ui input">
        <input type="text" name="roomname" placeholder="Name">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="rate" placeholder="Rate">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="capacity" placeholder="Capacity">
      </div>
    </div>
    <div class="container" style="padding: 0px 0px 10px 0px;">
    <button type="submit">Add</button>
    </div>
  </div>
  </div>
</form>
@stop

<!--  -->