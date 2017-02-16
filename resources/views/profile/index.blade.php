@extends('admin.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<h1>Profile</h1>
                </div>

                <div class="panel-body">
                    <div>
                        Name: {{ $user->name }}<br><br>
                        Email: {{ $user->email }}<br><br>
                    </div>
                </div>
        </div>
    </div>
</div>
@stop