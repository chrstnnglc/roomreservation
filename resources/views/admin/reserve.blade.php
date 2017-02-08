@extends('admin.master')

@section('content')

<table class="ui celled red table">
  <thead>
    <tr>
      <th>Date</th>
      <th>User</th>
      <th>Room</th>
      <th>Start Time</th>
      <th>End Time</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="date"></td>
      <td class="user"></td>
      <td class="room"></td>
      <td class="start_time"></td>
      <td class="end_time"></td>
    </tr>
  </tbody>
</table>

<h3>Add Reservation</h3>

<form class="ui form">
  <div class="ui stacked segment">
    <div class="field">
      <div class="ui input">
        <input type="text" name="user_name" placeholder="Insert user name here...">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="room" placeholder="Insert room being reserved here...">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="date" placeholder="Insert date here...">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="start_time" placeholder="Insert start time here...">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="end_time" placeholder="Insert end time here...">
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
    </div
  </div>
</form>
@stop

<!-- User, Room, date of res, date reserved, starttime, endtime, hours, price, date_paid-->