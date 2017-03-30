@extends('layouts.master')
@section('items')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
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
              <button><a href="/user/{{ $user->id }}">View User</a></button>
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
    <a href="{{url('/user/form')}}">
      <button class="ui yellow fluid button" type="submit">Add</button>
    </a>
  </div>
</form>
@stop