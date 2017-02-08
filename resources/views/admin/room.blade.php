@extends('admin.master')

@section('content')

<table class="ui celled red table">
  <thead>
    <tr>
      <th>Room Name</th>
      <th>Rate</th>
      <th>Capacity</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($rooms as $room)
        <tr>
            <td class="room">{{ $room->name }}</td>
            <td class="rates">{{ $room->capacity }}</td>
            <td class="capacity">{{ $room->rate }}</td>      
        </tr>
    @endforeach

    <tr>
      <td class="room"></td>
      <td class="rates"></td>
      <td class="capacity"></td>
    </tr>
  </tbody>
</table>

<h3>Add Rooms</h3>

<form class="ui form">
  <div class="ui stacked segment">
    <div class="field">
      <div class="ui input">
        <input type="text" name="equipment" placeholder="Add room here">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="rates" placeholder="Rates">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="capacity" placeholder="Capacity">
      </div>
    </div>
    <div class="container" style="padding: 0px 0px 10px 0px;">
    <div class="ui fluid large red submit button">Add</div>
    </div>
    <div class="container" style="padding: 10px 0px 10px 0px;">
    <div class="ui fluid large red submit button">Delete</div>
    </div>
    <div class="container" style="padding: 10px 0px 10px 0px;">
    <div class="ui fluid large red submit button">Edit</div>
    </div>
  </div>
  </div>
</form>
@stop

<!--  -->