@extends('layouts.master')
@section('name')
<title>Users - Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 60%;
@stop
@section('items')
@if (Auth::user()->users_role == 'admin' or Auth::user()->users_role == 'media')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="active item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('/user/profile')}}">{{Auth::user()->username}}</a>
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

      @forelse ($users as $user)
        @if ($loop->first)
        <table class="ui celled yellow table">
            <thead>
            <tr>
              <?php 
                $new_ord = ($ord == 'asc')?'desc':'asc';
              ?>
              <th><a href = "{{ url('user') }}?sort=username{{ ($sort == 'username')?'&ord='.$new_ord:''}}">
                  Username
                <i class="sort {{ ($sort == 'username')?$new_ord.'ending':''}} icon"></i>
                </a>
              </th>
              <th><a href = "{{ url('user') }}?sort=lastname{{ ($sort == 'lastname')?'&ord='.$new_ord:''}}">
                  Last Name
                <i class="sort {{ ($sort == 'lastname')?$new_ord.'ending':''}} icon"></i>
                </a>
              </th>
              <th><a href = "{{ url('user') }}?sort=firstname{{ ($sort == 'firstname')?'&ord='.$new_ord:''}}">
                  First Name
                <i class="sort {{ ($sort == 'firstname')?$new_ord.'ending':''}} icon"></i>
                </a>
              </th>
              <th><a href = "{{ url('user') }}?sort=email{{ ($sort == 'email')?'&ord='.$new_ord:''}}">
                  E-mail
                <i class="sort {{ ($sort == 'email')?$new_ord.'ending':''}} icon"></i>
                </a>
              </th>
              <th><a href = "{{ url('user') }}?sort=mobile{{ ($sort == 'mobile')?'&ord='.$new_ord:''}}">
                  Mobile
                <i class="sort {{ ($sort == 'mobile')?$new_ord.'ending':''}} icon"></i>
                </a>
              </th>
              <th><a href = "{{ url('user') }}?sort=affiliation{{ ($sort == 'affiliation')?'&ord='.$new_ord:''}}">
                  Affiliation
                <i class="sort {{ ($sort == 'affiliation')?$new_ord.'ending':''}} icon"></i>
                </a>
              </th>
              <th><a href = "{{ url('user') }}?sort=users_role{{ ($sort == 'users_role')?'&ord='.$new_ord:''}}">
                  Role
                <i class="sort {{ ($sort == 'users_role')?$new_ord.'ending':''}} icon"></i>
                </a>
              </th>
              <th>Options</th>
            </tr>
          </thead>
          <tbody>
        @endif

        <tr>
            <td class="username">{{ $user->username }}</td>
            <td class="firstname">{{ $user->firstname }}</td>
            <td class="lastname">{{ $user->lastname }}</td>
            <td class="email">{{ $user->email }}</td>
            <td class="mobile">{{ $user->mobile }}</td>
            <td class="affiliation">{{ $user->affiliation }}</td>
            <td class="users_role">{{$user->users_role}}</td>
            <td class="options">
              <a href="/user/{{ $user->id }}" class="ui mini yellow button">View User</a>
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
            @if ($loop->last)
    </tbody>
    </table>
    @endif
    @empty
      <h1>No users to show.</h1>
    @endforelse
</form>
@stop