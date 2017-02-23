@extends('user.menu')
@section('name')
<title>Calendar - Diocese of Cubao Reservation System</title>
@stop
@section('style')
<style type="text/css">
  body {
    background-color: #DADADA;
    overflow: auto;
  }
  body > .grid {
    height: 100%;
  }
  .image {
    margin-top: -100px;
  }
  .column {
    max-width: 85%;
    max-height: 100%;
  }
</style>
@stop
@section('items')
<a class="active item" style="font-size: 110%" href="{{ url('/') }}">Calendar</a>
<a class="item" style="font-size: 110%" href="{{ url('reserve') }}">Reservations</a>
<a class="item" style="font-size: 110%" href="{{ url('user') }}">User</a>
@stop
@section('content')
  <div class="ui middle aligned center aligned grid" style="width=100%;">
    <div class="column">
      <script src="{{asset('/js/calendar.js')}}"></script>
    </div>
  </div>

@stop