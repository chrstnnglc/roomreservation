@extends('layouts.master')
@section('name')
<title>Users - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 25%;
@stop
@section('items')
@if (Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="active item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'treasury')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
@elseif (Auth::user()->users_role == 'user')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('profile')}}">{{Auth::user()->username}}</a>
@endif
@stop
@section('content')

<h3>Add User</h3>

<form method="POST" class="ui form" action="/user">
  {{ csrf_field() }}

  @if (count($errors) > 0)
    <div class = "ui left aligned inverted red stacked segment">
        <i class="warning icon"></i>
        Can't add!
        <ul>
            @foreach ($errors->all() as $error)
                <li class = "">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

  <div class="ui yellow stacked segment">
    <div class="field">
      <div class="ui input">
        <input type="text" name="username" placeholder="User Name">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="firstname" placeholder="First Name">
      </div>
    </div>
    <div class="field">
      <div class="ui input">
        <input type="text" name="lastname" placeholder="Last Name">
      </div>
    </div>
    <div class="field">
      <div class="ui left icon input">
        <i class="mail icon"></i>
        <input type="email" name="email" placeholder="E-mail address">
      </div>
    </div>
    <div class="field">
      <div class="ui left icon input">
        <i class="lock icon"></i>
        <input type="password" name="password" placeholder="Password">
      </div>
    </div>
    <div class="field">
      <div class="ui left icon input">
          <i class="lock icon"></i>
      <input type="password" name="password_confirmation" value="" placeholder = "Confirm Password">
      </div>
    </div>
    <div class="field">
      <div class="ui left icon input">
        <i class="mobile icon"></i>
        <input type="text" name="mobile" placeholder="Mobile">
      </div>
    </div>
    <div class="field">
      <div class="ui left icon input">
        <i class="users icon"></i>
        <input type="text" name="affiliation" placeholder="Affiliation">
      </div>
    </div>
    <!-- <div class="field">
      <div class="ui input">
        <input type="text" name="users_role" placeholder="Role">
      </div>
    </div> -->
    <div class="field">
      <select name="users_role" class="ui dropdown" id="select">
        <option value=""></option>
        <option value="admin">Admin</option>
        <option value="media">Media</option>
        <option value="treasury">Treasury</option>
        <option value="user">User</option>
      </select>
    </div>
    <a href="{{url('/user')}}">
      <button class="ui yellow fluid button" type="submit">Add</button>
    </a>
  </div>
</form>
@stop
