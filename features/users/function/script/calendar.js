document.addEventListener('DOMContentLoaded', function () {

  var calendarEl = document.getElementById('appointmentCalendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    headerToolbar: {
      left: '',
      center: 'title',
      right: 'prev,next',
    },
    dayCellDidMount: function (info) {
      var dayCell = info.el;
      var date = new Date(info.date);
      var today = new Date();
      today.setHours(0, 0, 0, 0);
      var maxDate = new Date(today);
      maxDate.setDate(today.getDate() + 14);


      var xhrUnavailable = new XMLHttpRequest();
      xhrUnavailable.open('POST', '../../function/php/getUnavailableDates.php', true);
      xhrUnavailable.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhrUnavailable.onload = function () {
        if (xhrUnavailable.status === 200) {
          var unavailableDates = xhrUnavailable.responseText.split(',');

          console.log('Unavailable dates:', unavailableDates);

          var formattedDate = date.toISOString().split('T')[0];

          if (unavailableDates.includes(formattedDate)) {
            dayCell.style.backgroundColor = '#808080';
            dayCell.style.cursor = 'not-allowed';
            dayCell.style.pointerEvents = 'none';
          } else if (date < today || date > maxDate) {
            dayCell.style.backgroundColor = '#808080';
            dayCell.style.cursor = 'not-allowed';
            dayCell.style.pointerEvents = 'none';
          } else {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../../function/php/check-bookings.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
              if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.error) {
                  console.error('Error:', response.error);
                  return;
                }

                var bookingCount = response.bookingCount;
                var maxBooking = response.maxBooking;

                if (bookingCount >= maxBooking) {
                  dayCell.style.backgroundColor = '#F65859';
                  dayCell.style.pointerEvents = 'none';
                  dayCell.style.cursor = 'not-allowed';
                } else {
                  dayCell.style.backgroundColor = '#9EF3A0';

                  dayCell.addEventListener('mouseover', function () {
                    dayCell.style.backgroundColor = '#73BD1E';
                  });
                  dayCell.addEventListener('mouseout', function () {
                    dayCell.style.backgroundColor = '#9EF3A0';
                  });
                  dayCell.classList.add('fc-daygrid-day-button');
                  dayCell.addEventListener('click', function () {
                    var options = { year: 'numeric', month: 'long', day: 'numeric' };
                    var clickedDate = date.toLocaleDateString('en-US', options);

                    console.log('Clicked date:', clickedDate);

                    var timesXhr = new XMLHttpRequest();
                    timesXhr.open('POST', '../../function/php/getBookedTimes.php', true);
                    timesXhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    timesXhr.onload = function () {
                      if (timesXhr.status === 200) {
                        console.log('Response from PHP (unavailable times):', timesXhr.responseText);

                        var unavailableTimes = timesXhr.responseText.split(',');

                        console.log('Unavailable appointment times:', unavailableTimes);

                        var timeButtons = document.querySelectorAll('.choose-time');
                        timeButtons.forEach(function(button) {
                          var time = button.textContent.trim();
                          var buttonTime = convertTo24HourFormat(time);

                          if (unavailableTimes.includes(buttonTime)) {
                            button.disabled = true;
                            button.style.backgroundColor = '#808080'; 
                            button.style.cursor = 'not-allowed';
                            button.style.color = 'white';
                          } else {
                            button.disabled = false;
                            button.style.backgroundColor = ''; 
                            button.style.cursor = '';
                          }
                        });

                        unavailableTimes.forEach(function(time) {
                          console.log('Unavailable time: ' + time);
                        });
                      }
                    };
                    timesXhr.send('date=' + formattedDate);

                    document.getElementById('modalContent').textContent = clickedDate;

                    var isoDate = new Date(date); 
                    var formattedDateForInput = isoDate.toISOString().split('T')[0];
                    var hiddenInput = document.getElementById('appointmentDate');
                    hiddenInput.value = formattedDateForInput;

                    var modal = new bootstrap.Modal(document.getElementById('dayModal'));
                    modal.show();
                  });
                }
              }
            };
            xhr.send('date=' + formattedDate);
          }
        }
      };
      xhrUnavailable.send('action=fetchUnavailable');
    },
  });

  calendar.render();
});

function convertTo24HourFormat(time) {
  var timeParts = time.split(' '); 
  var hour = parseInt(timeParts[0], 10);
  var period = timeParts[1].toUpperCase();

  if (period === 'PM' && hour !== 12) {
    hour += 12; 
  }
  if (period === 'AM' && hour === 12) {
    hour = 0; 
  }

  return (hour < 10 ? '0' + hour : hour) + ':00:00'; 
}
