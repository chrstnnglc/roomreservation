// days of the week
cal_days_labels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

// months
cal_months_labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'Semptember', 'October', 'November', 'December'];

// days in each month
cal_days_in_month = [31,28,31,30,31,30,31,31,30,31,30,31];

//current day
cal_current_date = new Date();

function Calendar(month, year) {
  this.month = (isNaN(month) || month == null) ? cal_current_date.getMonth() : month;
  this.year = (isNaN(year) || year == null) ? cal_current_date.getFullYear() : year;
  this.html = '';
}

Calendar.prototype.generateHTML = function(){
  var firstDay = new Date(this.year, this.month, 1);
  var startingDay = firstDay.getDay();
  var monthLength = cal_days_in_month[this.month];
  if(this.month == 1){
    if((this.year%4==0 && this.year%100!=0) || this.year%400==0){
      monthLength=29;
    }
  }
  var monthName = cal_months_labels[this.month];
  var html = '<table class="ui fixed yellow celled table">';
  html += '<thead>';
  html +='<tr><th colspan="7" style="text-align: center;">';
  html += monthName + "&nbsp;" + this.year;
  html += '</th></tr>';
  html += '</thead>';
  html += '<tr>';
  for (var i=0; i<=6; i++){
    html += '<td class="calendar-header-day">';
    html += cal_days_labels[i];
    html += '</td>';
  }
  html +='</tr><tr>';
  var day = 1;
  // this loop is for is weeks (rows)
  for (var i = 0; i < 6; i++) {
    // this loop is for weekdays (cells)
    for (var j = 0; j <= 6; j++) {
      if (day <= monthLength && (i > 0 || j >= startingDay)) {
        html += '<td class="calendar-day">';
        html += day;
        day++;
      }else{
        html+='<td class="active">';
      }
      html += '</td>';
    }
    // stop making rows if we've run out of days
    if (day > monthLength) {
      break;
    } else {
      html += '</tr><tr>';
    }
  }

  html+='<tfoot><tr><th colspan="7"><div class="ui right floated pagination menu">';
  html+='<a class="icon item"><i class="left chevron icon"></i></a>';
  for (var i = 0; i<12; i++){
    if(this.month==i){
      html+='<a class="active item">';
    }else{
      html+='<a class="item">';
    }
    html+=String(i+1)
    html+='</a>'
  }
  html+='<a class="icon item"><i class="right chevron icon"></i></a></div></th></tr></tfoot>';

  html += '</tr></table>';

  this.html = html;
}

Calendar.prototype.getHTML = function(){
  return this.html;
}

var cal = new Calendar();
cal.generateHTML();
document.write(cal.getHTML());