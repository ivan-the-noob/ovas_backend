document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('appointmentCalendar');
  var appointments = [];

  // Use AJAX to fetch appointment dates from the server
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '../../function/php/fetchAppointments.php', true); // Adjust the endpoint as needed
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function () {
    if (xhr.status === 200) {
      appointments = xhr.responseText.split(','); // Parse response as CSV (dates separated by commas)
      console.log('Appointments fetched:', appointments); // Log the appointments to check
      renderCalendar(); // Render calendar after appointments are fetched
    } else {
      console.error('Failed to fetch appointments:', xhr.statusText);
    }
  };
  xhr.send();

  // Function to render the calendar after the appointments are fetched
  function renderCalendar() {
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: '',
        center: 'title',
        right: '',
      },
      dayCellDidMount: function (info) {
        var dayCell = info.el;
        var date = new Date(info.date);
        var isoDate = date.toISOString().split('T')[0]; // Format date as YYYY-MM-DD

        console.log('Checking date:', isoDate); // Log the date being checked

        // Check if the current date has an appointment
        if (appointments.includes(isoDate)) {
          dayCell.style.backgroundColor = 'green'; // Highlight the cell in green
          dayCell.style.color = 'white'; // Adjust text color for better contrast
        }

        // Add click functionality to all days
        dayCell.classList.add('fc-daygrid-day-button');
        dayCell.addEventListener('click', function () {
          // Fetch appointment details for the clicked date
          var appointmentDate = isoDate; // The clicked date
          var modalContent = document.getElementById('modalContent');
          modalContent.innerHTML = ''; // Clear previous content

          // Make AJAX call to get appointments for the clicked date
          var xhrDetails = new XMLHttpRequest();
          xhrDetails.open('POST', '../../function/php/getAppointmentsForDate.php', true);
          xhrDetails.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhrDetails.onload = function () {
            if (xhrDetails.status === 200) {
              var appointments = xhrDetails.responseText; // Plain HTML or CSV response

              // If we receive HTML, simply add it to the modal content
              modalContent.innerHTML = appointments;

              // Show the modal
              var modal = new bootstrap.Modal(document.getElementById('dayModal'));
              modal.show();
            } else {
              console.error('Failed to fetch appointment details:', xhrDetails.statusText);
            }
          };
          xhrDetails.send('date=' + appointmentDate);
        });
      }
    });

    calendar.render();
  }
});
