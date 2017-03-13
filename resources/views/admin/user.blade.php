@extends('admin.master')
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/admin/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/admin/logs')}}">Logs</a>
@stop
@section('content')

<table class="ui celled yellow table">
  <thead>
    <tr>
      <th>User Name</th>
      <th>Last Name</th>
      <th>First Name</th>
      <th>E-mail</th>
      <th>Mobile</th>
      <th>Affiliation</th>
      <th>Role</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($users as $user)
        <tr>
            <td class="username">{{ $user->username }}</td>
            <td class="firstname">{{ $user->firstname }}</td>
            <td class="lastname">{{ $user->lastname }}</td>
            <td class="email">{{ $user->email }}</td>
            <td class="mobile">{{ $user->mobile }}</td>
            <td class="affiliation">{{ $user->affiliation }}</td>
            <td class="users_role">{{$user->users_role}}</td>
            <td class="options">
              <button><a href="/admin/user/{{ $user->id }}">View User</a></button>
            </td>
            <!-- <td><button><a href = "/manage/users/{{$user->id}}/edit">Edit</a> </button>
                <form action = "/manage/users/{{$user->id}}" method="POST" onsubmit = "return confirm('Do you really want to delete this user?');">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit">
                        Delete
                    </button>
                </form>
            </td> -->
        </tr>
    @endforeach
  </tbody>
</table>

<h3>Add User</h3>

<form method="POST" class="ui form" action="/admin/user">
  {{ csrf_field() }}
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
  <div class="field">
    <div class="ui left icon input">
      <i class="lock icon"></i>
      <input type="text" name="mobile" placeholder="Mobile">
    </div>
  </div>
  <div class="field">
    <div class="ui left icon input">
      <i class="lock icon"></i>
      <input type="text" name="affiliation" placeholder="Affiliation">
    </div>
  </div>
  <div class="field">
    <div class="ui left icon input">
      <i class="lock icon"></i>
      <input type="text" name="users_role" placeholder="Role">
    </div>
  </div>
    <!--<div class="container" style="padding: 0px 0px 20px 0px;">
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
    </div>-->
    <a href="{{url('/admin/user')}}">
      <button class="ui yellow fluid button" type="submit">Add</button>
    </a>
  </div>
</form>
@stop