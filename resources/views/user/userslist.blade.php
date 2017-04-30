@extends('layouts.master')
@section('name')
<title>Users - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 50%;
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
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
@endif
@stop
@section('content')
<div class = "container" align = "center">
  <div class="container" align="center" style="padding: 5px 0px 5px 0px; height: 50%; width: 25%;">
  <a href="{{url('/user/form')}}" class="ui yellow fluid button">Add User</a>
</div>
</div>
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
      <th></th>
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
              <a href="/user/{{ $user->id }}" class="ui yellow button">View User</a>
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
</form>
@stop