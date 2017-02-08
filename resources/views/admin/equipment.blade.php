@extends('admin.master')

@section('content')

<table class="ui celled red table">
  <thead>
    <tr>
      <th>Equipment</th>
      <th>Brand</th>
      <th>Model</th>
      <th>Price</th>
      <th>Condition</th>
      <th>Room</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="equipment"></td>
      <td class="brand"></td>
      <td class="model"></td>
      <td class="price"></td>
      <td class="condition"></td>
      <td class="room"></td>
    </tr>
  </tbody>
</table>

<h3>Add Equipment</h3>

<form class="ui form">
  <div class="ui stacked segment">
    <div class="field">
      <div class="ui input">
        <input type="text" name="equipment" placeholder="Equipment name">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="brand" placeholder="Brand">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="model" placeholder="Model">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="price" placeholder="Price">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="condition" placeholder="Condition">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="room" placeholder="Room">
      </div>
    </div>
    <div class="container" style="padding: 0px 0px 10px 0px;">
    <div class="ui fluid large red submit button">Add</div>
    </div>
    <div class="container" style="padding: 10px 0px 10px 0px;">
    <div class="ui fluid large red submit button">Delete</div>
    </div>
    <div class="ui fluid large red submit button">Edit</div>
    </div>
  </div>
</form>
@stop

<!-- name, brand, model, price, condition, room -->