@extends('layouts.master')
@section('name')
<title>Diocese of Cubao Reservation System</title>
@stop
@section('width')
max-width: 67.5%;
@stop
@section('items')
@if (Auth::user() != NULL)
@if (Auth::user()->users_role == 'admin')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('/user')}}">Users</a>
<a class="item" style="font-size: 110%" href = "{{url('/equipment')}}">Equipment</a>
<a class="item" style="font-size: 110%" href = "{{url('/rooms')}}">Rooms</a>
<a class="item" style="font-size: 110%" href = "{{url('/logs')}}">Logs</a>
<a class="item" style="font-size: 110%" href = "{{url('profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'treasury')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('profile')}}">{{Auth::user()->username}}</a>
@elseif (Auth::user()->users_role == 'user')
<a class="item" style="font-size: 110%" href = "{{url('/reservations')}}">Reservations</a>
<a class="item" style="font-size: 110%" href = "{{url('profile')}}">{{Auth::user()->username}}</a>
@endif
@endif
@stop

@section('content')
<!-- <script src="{{asset('/js/calendar.js')}}"></script> -->
<script language="javascript">
dates_reserved = [
@foreach ($reserves as $reserve)
@if ($loop->last)
"{{ $reserve->date_reserved}}"
@else    
"{{ $reserve->date_reserved}}",
@endif
@endforeach
];
start_time = [
@foreach ($reserves as $reserve)
@if ($loop->last)
"{{ $reserve->start_of_reserved}}"
@else
"{{ $reserve->start_of_reserved}}",
@endif
@endforeach
];
end_time = [
@foreach ($reserves as $reserve)
@if ($loop->last)
"{{ $reserve->end_of_reserved}}"
@else
"{{ $reserve->end_of_reserved}}",
@endif
@endforeach
];
reservation_status = [
@foreach ($reserves as $reserve)
@if ($loop->last)
"{{ $reserve->reservations_status }}"
@else
"{{ $reserve->reservations_status }}",
@endif
@endforeach
];
name_of_months=['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']; 

// fill the month table with column headings
function day_title(day_name){
     calendarTable+="<td>"+day_name+"</td>";
}
// fills the month table with numbers
function fill_table(month,month_length,year){
  calendarTable="";
  day=1
  // begin the new month table
  calendarTable+="<table class='ui fixed yellow celled table' style='column: 100%'>";
  calendarTable+='<thead><tr><th style="border-right: 0;"> <button class="ui yellow button" id = "prev_month" onclick = "month_subtracter();"> <h3> << </h3> </button> </th><th colspan="5" style="text-align: center; border-left: 0; border-right: 0;"><h2>'+name_of_months[month]+'   '+year+'</h2></th><th style="border-left: 0;"><div style="text-align: right;"> <button class="ui yellow button" id = "next_month" onclick = "month_adder();"> <h3> >> </h3> </button> </div></th></tr></thead>';
  // column headings
  day_title("Sun");
  day_title("Mon");
  day_title("Tue");
  day_title("Wed");
  day_title("Thu");
  day_title("Fri");
  day_title("Sat");
  // pad cells before first day of month
  calendarTable+="</tr><tr>";
  if(start_day%7!=0){
    for (var i=0;i<start_day;i++){
          calendarTable+="<td class='active'></td>";
    }
  }
  if(month>9){
    string_of_month=String(month+1);
  }else{
    string_of_month='0'+String(month+1);
  }
  // fill the first week of days
  for (var i=start_day;i<7;i++){
    if (day<10){
      string_of_day='0'+String(day);
    }else{
      string_of_day=String(day);
    }
    var yes=0;
    var indices=[];
    for (var index=0; index<dates_reserved.length; index++){
      if(dates_reserved[index]==year+"-"+string_of_month+"-"+string_of_day){
        yes=1;
        indices.push(index);
      }
    }
    if(yes==1){
      calendarTable+="<td style='height: 125px;'><div style='height: 100px;'>"+string_of_day;
      for(var index=0; index<indices.length; index++){
        if(index>2){
          calendarTable+="...";
          break;
        }
        if(reservation_status[indices[index]]=="paid"){
          calendarTable+="<div style='background-color: lightgreen'><font size='1'>"+start_time[indices[index]]+"-"+end_time[indices[index]];
        }else{
          calendarTable+="<div style='background-color: #EE6363'><font size='1'>"+start_time[indices[index]]+"-"+end_time[indices[index]];
        }
        calendarTable+="</div></font>";
      }
      calendarTable+="</div></td>";
    }else{
      calendarTable+="<td style='height: 125px;'><div style='height: 100px;'>"+string_of_day+"</td>";
    }
    day++;
  }
  calendarTable+="</tr><tr>";
  // fill the remaining weeks
  
  while (day <= month_length) {
    for (var i=0;i<7 && day<=month_length;i++){
      if (day<10){
        string_of_day='0'+String(day);
      }else{
        string_of_day=String(day);
      }
      var yes=0;
      var indices=[];
      for (var index=0; index<dates_reserved.length; index++){
        if(dates_reserved[index]==year+"-"+string_of_month+"-"+string_of_day){
          yes=1;
          indices.push(index);
        }
      }
      if(yes==1){
        calendarTable+="<td style='height: 125px;'><div style='height: 100px'>"+string_of_day;
        for(var index=0; index<indices.length; index++){
          if(index>2){
            calendarTable+="...";
            break;
          }
          if(reservation_status[indices[index]]=="paid"){
            calendarTable+="<div style='background-color: lightgreen'><font size='1'>"+start_time[indices[index]]+"-"+end_time[indices[index]];
          }else{
            calendarTable+="<div style='background-color: #EE6363'><font size='1'>"+start_time[indices[index]]+"-"+end_time[indices[index]];
          }
          calendarTable+="</div></font>";
        }
        calendarTable+="</td>";
      }else{
        calendarTable+="<td style='height: 125px;'><div style='height: 100px'>"+string_of_day+"</td>";
      }
      day++;
    }
    for(j=i; j<7; j++){
      calendarTable+="<td class='active'></td>";
    }
    calendarTable+="</tr><tr>";
    // the first day of the next month
    start_day=i;
  }
  calendarTable+="</tr></table><br>";
  return calendarTable;
}
window.onload = function (){
  current = new Date();
  month = current.getMonth();
  year = current.getFullYear();
  // CAHNGE the below variable to the CURRENT YEAR
  // first day of the week of the new year
  today= new Date(name_of_months[month]+" 1,"+ year);
  start_day = today.getDay();   // starts with 0
  actual_calendar = document.getElementById('show_calendar');
  if(month == 1){
    if((year%4==0 && year%100!=0) || year%400==0){
      actual_calendar.innerHTML = fill_table(month,29,year);
    }else{
      actual_calendar.innerHTML = fill_table(month,28,year);  
    }
  }else{
    if(month<7){
      if(month%2==1){
        actual_calendar.innerHTML = fill_table(month,30,year);  
      }else{
        actual_calendar.innerHTML = fill_table(month,31,year);  
      }
    }else if(month>=7){
      if(month%2==1){
        actual_calendar.innerHTML = fill_table(month,31,year);
      }else{
        actual_calendar.innerHTML = fill_table(month,30,year);
      }
    }
  }
  prev_month = document.getElementById('prev_month');
  next_month = document.getElementById('next_month');
}

function month_adder(){
  month = month + 1;
  if(month>11){
    month=month%12;
    year+=1;
  }
  today= new Date(name_of_months[month]+" 1,"+ year);
  start_day = today.getDay();
  if(month == 1){
    if((year%4==0 && year%100!=0) || year%400==0){
      actual_calendar.innerHTML = fill_table(month,29,year);
    }else{
      actual_calendar.innerHTML = fill_table(month,28,year);  
    }
  }else{
    if(month<7){
      if(month%2==1){
        actual_calendar.innerHTML = fill_table(month,30,year);  
      }else{
        actual_calendar.innerHTML = fill_table(month,31,year);  
      }
    }else if(month>=7){
      if(month%2==1){
        actual_calendar.innerHTML = fill_table(month,31,year);
      }else{
        actual_calendar.innerHTML = fill_table(month,30,year);
      }
    }
  }
}
function month_subtracter(){
  month = month - 1;
  if(month<0){
    month=11;
    year-=1;
  }
  today= new Date(name_of_months[month]+" 1,"+ year);
  start_day = today.getDay();
  if(month == 1){
    if((year%4==0 && year%100!=0) || year%400==0){
      actual_calendar.innerHTML = fill_table(month,29,year);
    }else{
      actual_calendar.innerHTML = fill_table(month,28,year);  
    }
  }else{
    if(month<7){
      if(month%2==1){
        actual_calendar.innerHTML = fill_table(month,30,year);  
      }else{
        actual_calendar.innerHTML = fill_table(month,31,year);  
      }
    }else if(month>=7){
      if(month%2==1){
        actual_calendar.innerHTML = fill_table(month,31,year);
      }else{
        actual_calendar.innerHTML = fill_table(month,30,year);
      }
    }
  }
}
</script>
<div id="show_calendar">&nbsp;</div>
@endsection
