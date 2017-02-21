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

    @foreach ($equipments as $equip)
    <tr>

      <td class="equipment">{{$equip->name}}</td>
      <td class="brand">{{$equip->brand}}</td>
      <td class="model">{{$equip->model}}</td>
      <td class="price">{{$equip->price}}</td>
      <td class="condition">{{$equip->condition}}</td>
      <td class="room_id">{{$equip->room_id}}</td>
      <td class="options">
        <button><a href="/admin/equipments/{{ $equip->id }}">View Equipment</a></button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<h3>Add Equipment</h3>

<form method="POST" class="ui form" action="/admin/equipments">
  {{ csrf_field() }}
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
        <input type="text" name="room_id" placeholder="Room ID">
      </div>
    </div>
    <div class="container" style="padding: 0px 0px 10px 0px;">
    <button type="submit" id="add">Add</button>
    </div>
  </div>
</form>
@stop

<!-- name, brand, model, price, condition, room -->