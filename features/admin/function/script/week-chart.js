document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById('weekSalesChart').getContext('2d');

    var chartData = {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'], // Week labels
        datasets: [
            {
                label: 'This Week Sales',
                data: [], // Placeholder for dynamic data
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                fill: true,
                pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(54, 162, 235, 1)'
            },
            {
                label: 'Last Week Sales',
                data: [], // Placeholder for dynamic data
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                fill: true,
                pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(255, 99, 132, 1)'
            }
        ]
    };

    var salesChart = new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    min: 1000, // Minimum value for Y-axis
                    max: 20000, // Maximum value for Y-axis
                    ticks: {
                        callback: function (value) {
                            return value.toLocaleString(); // Format with commas (e.g., 1,000)
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            var label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.raw.toLocaleString(); // Format tooltip value with commas
                            return label;
                        }
                    }
                }
            }
        }
    });

    // Fetch data for This Week and Last Week Sales
    function fetchData() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../../function/php/fetch_sales_data_weekly.php', true); // Your new endpoint for weekly sales data
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    var response = xhr.responseText.split('|'); // Split response by '|'
                    var thisWeekData = response[0].split(',').map(Number); // Convert to numbers
                    var lastWeekData = response[1].split(',').map(Number); // Convert to numbers

                    // Update chart datasets with fetched data
                    salesChart.data.datasets[0].data = thisWeekData;
                    salesChart.data.datasets[1].data = lastWeekData;
                    salesChart.update(); // Update the chart
                } catch (e) {
                    console.error('Error parsing response:', e);
                }
            } else if (xhr.readyState === 4) {
                console.error('Error fetching data:', xhr.statusText);
            }
        };
        xhr.send();
    }

    fetchData(); // Fetch the sales data when the page loads
});
