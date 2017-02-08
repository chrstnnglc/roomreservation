@extends('admin.master')

@section('content')
<h3>Add User</h3>

<form class="ui form">
  <div class="ui stacked segment">
  <div class="field">
    <div class="ui input">
      <input type="text" name="first_name" placeholder="First Name">
    </div>
  </div>
  <div class="field">
    <div class="ui input">
      <input type="text" name="last_name" placeholder="Last Name">
    </div>
  </div>
  <div class="field">
    <div class="ui input">
      <input type="text" name="user_name" placeholder="User Name">
    </div>
  </div>
  <div class="field">
    <div class="ui left icon input">
      <i class="user icon"></i>
      <input type="text" name="email" placeholder="E-mail address">
    </div>
  </div>
  <div class="field">
    <div class="ui left icon input">
      <i class="lock icon"></i>
      <input type="password" name="password" placeholder="Password">
    </div>
  </div>
    <div class="container" style="padding: 0px 0px 20px 0px;">
      <div class="ui simple dropdown item">
        <input name="roles" type="hidden">
        <i class="dropdown icon"></i>
        <div class="default text">Roles</div>
        <div class="menu">
          <div class="item" data-value="1">Treasury</div>
          <div class="item" data-value="2">Admin</div>
          <div class="item" data-value="3">Media</div>
        </div>
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
</form>
@stop