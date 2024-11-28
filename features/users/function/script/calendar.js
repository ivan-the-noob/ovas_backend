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

      if (date < today || date > maxDate) {
        dayCell.style.backgroundColor = '#808080';
        dayCell.style.cursor = 'not-allowed';
        dayCell.style.pointerEvents = 'none';
      } else {
        var adjustedDate = new Date(date);
        adjustedDate.setDate(adjustedDate.getDate() + 1);
        var formattedDate = adjustedDate.toISOString().split('T')[0];

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
              dayCell.style.backgroundColor = 'red';
              dayCell.style.pointerEvents = 'none';
              dayCell.style.cursor = 'not-allowed';
            } else {
              dayCell.style.backgroundColor = 'green';

              dayCell.addEventListener('mouseover', function () {
                dayCell.style.backgroundColor = '#73BD1E';
              });
              dayCell.addEventListener('mouseout', function () {
                dayCell.style.backgroundColor = 'green';
              });

              dayCell.classList.add('fc-daygrid-day-button');
              dayCell.addEventListener('click', function () {
                var options = { year: 'numeric', month: 'long', day: 'numeric' };
                var formattedDate = date.toLocaleDateString('en-US', options);

                document.getElementById('modalContent').textContent = formattedDate;

                var isoDate = new Date(date);
                isoDate.setDate(isoDate.getDate() + 1); 
                var formattedDate = isoDate.toISOString().split('T')[0];
                var hiddenInput = document.getElementById('appointmentDate');
                hiddenInput.value = formattedDate;

                var modal = new bootstrap.Modal(document.getElementById('dayModal'));
                modal.show();
              });
            }
          }
        };
        xhr.send('date=' + formattedDate);
      }
    },
  });

  calendar.render();
});
