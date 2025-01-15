<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../../users/web/api/login.php");
    exit();
}

require '../../../../db.php';
$user_email = $_SESSION['email'] ?? '';

$stmt = $conn->prepare("SELECT COUNT(*) AS unread_count FROM notifications WHERE email = :email AND is_read = 0");
$stmt->bindParam(':email', $user_email);
$stmt->execute();
$unread_notification = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt2 = $conn->prepare("SELECT * FROM notifications WHERE email = :email ORDER BY created_at DESC");
$stmt2->bindParam(':email', $user_email);
$stmt2->execute();
$notifications = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$stmt3 = $conn->prepare("SELECT SUM(total_payment) AS total_sales FROM appointments WHERE status = 'complete'");
$stmt3->execute();
$total_sales_data = $stmt3->fetch(PDO::FETCH_ASSOC);
$total_sales = $total_sales_data['total_sales'] ?? 0;


$stmt = $conn->prepare("SELECT * FROM appointments LIMIT 3");
$stmt->execute();
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM pos_records LIMIT 3");
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/index.css">
    <script src="../../function/script/calendar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
</head>

<body>
    <!--Navigation Links-->
    <div class="navbar flex-column bg-white shadow-sm p-3 collapse d-md-flex" id="navbar">
        <div class="navbar-links">
            <a class="navbar-brand d-none d-md-block logo-container" href="#">
                <img src="../../../../assets/img/logo.png" alt="Logo">
            </a>
            <a href="#dashboard" class="navbar-highlight">
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span>
            </a>
            <a href="app-req.php">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Appointment Request</span>
            </a>
            
            
            <a href="app-records-list.php">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Record Lists</span>
            </a>
            <a href="pos.php">
                <i class="fas fa-cash-register"></i>
                <span>Point of Sales</span>
            </a>
            <a href="reports.php">
            <i class="fa-solid fa-file-lines"></i>
                <span>Reports</span>
            </a>
            <a href="transaction.php">
                <i class="fas fa-exchange-alt"></i>
                <span>Transaction</span>
            </a>

            <div class="maintenance">
                <p class="maintenance-text">Maintenance</p>
                <a href="review.php">
                    <i class="fa-solid fa-list"></i>
                    <span>User Reviews</span>
                </a>
                <a href="category-list.php">
                    <i class="fa-solid fa-list"></i>
                    <span>Category List</span>
                </a>
               <a href="service-list.php">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Service List</span>
                </a>

                <a href="faqs.php">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>FAQS</span>
                </a>
                <a href="unavailable.php">
                    <i class="fa-solid fa-list"></i>
                    <span>Unavailable Date</span>
                </a>
              
                <a href="admin-user.php">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>Admin User List</span>
                </a>
               
                <a href="settings.php">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>
        </div>
    </div>
    <!--Navigation Links End-->
    <div class="content flex-grow-1">
        <div class="header">
            <button class="navbar-toggler d-block d-md-none" type="button" onclick="toggleMenu()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    style="stroke: black; fill: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>

            <!--Notification and Profile Admin-->
            <div class="profile-admin">

                <div class="dropdown">
                    <button class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../../../assets/img/vet logo.jpg"
                            style="width: 40px; height: 40px; object-fit: cover;">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../../users/web/api/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        require '../../../../db.php';
        try {
            $stmt = $conn->prepare("SELECT COUNT(*) as total_users FROM users WHERE role = :role");
            $stmt->execute(['role' => 'user']);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalUsers = $result['total_users'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        try {
            $stmt = $conn->prepare("SELECT COUNT(*) as total_booked FROM appointments");
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalBooked = $result['total_booked'];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>

        <div class="modal fade" id="dayModal" tabindex="-1" aria-labelledby="dayModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dayModalLabel">Appointments for Selected Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
        <!--Pos Card with graphs-->
        <div class="dashboard">
            <h3>Dashboard</h3>
            <div class="row card-box">
            <div class="col-md-8 justify-content-center mx-auto">
                <div class="calendar-container">
                    <div id="appointmentCalendar"></div>
                </div>
            </div>
                <div class="col-8 col-md-6 col-lg-3 cc d-flex flex-column align-items-center justify-content-center mx-auto" style="height: 100%;">
                    <div class="card">
                        <div class="cards">
                            <div class="card-text">
                                <p>Total Users</p>
                                <h5><?php echo $totalUsers; ?></h5>
                            </div>
                            <div class="logo">
                                <i class="fa-solid fa-users"></i>
                            </div>
                        </div>
                        <div class="trend card-up"><i class="fa-solid fa-arrow-trend-up"> 8.5 % </i> Up from yesterday
                        </div>
                    </div>
                    <div class="card">
                        <div class="cards">
                            <div class="card-text">
                                <p>Total Booked</p>
                                <h5><?php echo $totalBooked; ?></h5>
                            </div>
                            <div class="logo">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="trend card-up"><i class="fa-solid fa-arrow-trend-up"> 1.3 % </i> Up from yesterday
                        </div>
                        
                    </div>
                    <div class="card">
                        <div class="cards">
                            <div class="card-text">
                                <p>Total Sales</p>
                                <h5>₱<?php echo number_format($total_sales, 2); ?></h5>
                            </div>
                            <div class="logo">
                                <i class="fa-solid fa-peso-sign"></i>
                            </div>
                        </div>
                        <div class="trend card-down"><i class="fa-solid fa-arrow-trend-down"> 4.3 % </i> Down from
                            yesterday</div>
                    </div>
                </div>
                <div class="flex-container">
                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <canvas id="weekSalesChart"></canvas>
                    </div>
                </div>
                </div>
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6">
                        <table class="table table-hover table-remove-borders appointment mt-4">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Owner Name</th>
                                <th>Date</th>
                                <th>Service Category</th>
                                <th>Service</th>
                                <th>Code</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($appointments as $index => $appointment): ?>
                            <tr data-name="<?= strtolower($appointment['owner_name']) ?>" data-service-category="<?= strtolower($appointment['service_category']) ?>" data-status="<?= strtolower($appointment['status']) ?>">
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($appointment['owner_name']) ?></td>
                                <td><?= htmlspecialchars(date('M j, Y', strtotime($appointment['created_at']))) ?></td>
                                <td><?= $appointment['service_category'] === 'medical' ? 'Medical' : ($appointment['service_category'] === 'nonMedical' ? 'Non-Medical' : 'N/A') ?></td>
                                <td><?= htmlspecialchars($appointment['service_type']) ?></td>
                                <td><?= $appointment['code'] ?? 'Pending' ?></td>
                                <td>
                                    <span class="badge bg-<?= $appointment['status'] == 'confirm' ? 'primary' : ($appointment['status'] == 'complete' ? 'success' : ($appointment['status'] == 'decline' ? 'danger' : 'warning')) ?>">
                                        <?= ucfirst($appointment['status']) ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                                <a href="reports.php" class="text-decoration-line text-black d-flex justify-content-center">See more</a>
                        </div>
                        <div class="col-md-5">
                            <div id="chartContainer" style="width: 200px; height: 200px; margin: 0 auto; background-color: #fff; margin-top: 20px;">
                                <canvas id="ratingPieChart" width="150" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

             
        </div>
    </div>
    </div>
    </div>

    <script>
        
function fetchRatings() {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', '../../function/php/fetch_ratings.php', true);

        xhr.onload = function() {
            if (xhr.status === 200) {

                console.log('Ratings fetched:', xhr.responseText);  
                const ratings = xhr.responseText.split(',');  
                resolve(ratings);
            } else {
                reject('Error fetching ratings');
            }
        };

        xhr.onerror = function() {
            reject('Request error');
        };

        xhr.send();
    });
}

fetchRatings().then(ratings => {
    console.log('Data received:', ratings);  

    if (ratings.length === 0) {
        console.log('No ratings available.');
        return;
    }


    const ratingCount = {};
    ratings.forEach(rating => {
        if (ratingCount[rating]) {
            ratingCount[rating]++;
        } else {
            ratingCount[rating] = 1;
        }
    });

    console.log('Rating Count:', ratingCount); 

    const totalRatings = ratings.length;
    console.log('Total Ratings:', totalRatings); 

    const percentages = {
        5: (ratingCount['5'] || 0) / totalRatings * 100,
        4: (ratingCount['4'] || 0) / totalRatings * 100,
        3: (ratingCount['3'] || 0) / totalRatings * 100,
        2: (ratingCount['2'] || 0) / totalRatings * 100
    };

    console.log('Percentages:', percentages); 

    const ctx = document.getElementById('ratingPieChart').getContext('2d');
    const data = {
        labels: ['5 Stars', '4 Stars', '3 Stars', '2 Stars'],
        datasets: [{
            data: [
                percentages[5] || 0,
                percentages[4] || 0,
                percentages[3] || 0,
                percentages[2] || 0
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(255, 205, 86, 0.6)',
                'rgba(54, 162, 235, 0.6)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Total Ratings'
                }
            }
        },
    };

    const myChart = new Chart(ctx, config);
}).catch(error => {
    console.error('Error:', error);
});
    </script>

    <!--Pos Card with graphs End-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../function/script/daily-chart.js"></script>
    <script src="../../function/script/toggle-menu.js"></script>
    <script src="../../function/script/week-chart.js"></script>
    <script src="../../function/script/pie-chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    


</body>

</html>