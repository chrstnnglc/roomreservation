@extends('layouts.master')
@section('name')
<title>Diocese of Cubao Reservation System</title>
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


// fill the month table with column headings
function day_title(day_name){
     document.write("<td align=center width=35>"+day_name+"</td>");
}
// fills the month table with numbers
function fill_table(month,month_length,year)
{
  name_of_months=['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'Semptember', 'October', 'November', 'December']; 
  day=1
  // begin the new month table
  document.write("<table class='ui fixed yellow celled table'>");
  document.write('<thead><tr><th colspan="7" style="text-align: center;"><b>'+name_of_months[month]+'   '+year+'</b></th></tr></thead>');
  // column headings
  day_title("Sun");
  day_title("Mon");
  day_title("Tue");
  day_title("Wed");
  day_title("Thu");
  day_title("Fri");
  day_title("Sat");
  // pad cells before first day of month
  document.write("</tr><tr>");
  if(start_day%7!=0){
    for (var i=0;i<start_day;i++){
          document.write("<td class='active'></td>");
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
      document.write("<td align=center>"+string_of_day);
      for(var index=0; index<indices.length; index++){
        if(index>2){
          document.write("...");
          break;
        }
        if(reservation_status[indices[index]]=="paid"){
          document.write("<div class='ui green label'><font size='1'>"+start_time[indices[index]]+"-"+end_time[indices[index]]);
        }else{
          document.write("<div class='ui yellow label'><font size='1'>"+start_time[indices[index]]+"-"+end_time[indices[index]]);
        }
        document.write("</div></font><br>");
      }
      document.write("</td>");
    }else{
      document.write("<td align=center>"+string_of_day+"</td>");
    }
    day++;
  }
  document.write("</tr><tr>");
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
        document.write("<td align=center>"+string_of_day);
        for(var index=0; index<indices.length; index++){
          if(index>2){
            document.write("...");
            break;
          }
          if(reservation_status[indices[index]]=="paid"){
            document.write("<div class='ui green label'><font size='1'>"+start_time[indices[index]]+"-"+end_time[indices[index]]);
          }else{
            document.write("<div class='ui yellow label'><font size='1'>"+start_time[indices[index]]+"-"+end_time[indices[index]]);
          }
          document.write("</div></font><br>");
        }
        document.write("</td>");
      }else{
        document.write("<td align=center>"+string_of_day+"</td>");
      }
      day++;
    }
    for(j=i; j<7; j++){
      document.write("<td class='active'></td>");
    }
    document.write("</tr><tr>");
    // the first day of the next month
    start_day=i;
  }
  document.write("</tr></table><br>");
}
year = new Date();
// CAHNGE the below variable to the CURRENT YEAR
// first day of the week of the new year
today= new Date("January 1,"+ year.getFullYear());
start_day = today.getDay();   // starts with 0
for(var month=0; month<12; month++){
  if(month==1){
    if((today.getFullYear()%4==0 && today.getFullYear()%100!=0) || today.getFullYear()%400==0){
      fill_table(month,29,today.getFullYear());
    }else{
      fill_table(month,28,today.getFullYear());
    }
  }else if (month<8){
    if(month%2==0){
      fill_table(month,31,today.getFullYear());
    }else{
      fill_table(month,30,today.getFullYear());
    }
  }else if(month>=8){
    if(month%2==1){
      fill_table(month,31,today.getFullYear());
    }else{
      fill_table(month,30,today.getFullYear());
    }
  }
}
</script>
@endsection
