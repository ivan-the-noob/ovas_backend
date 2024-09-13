<?php 
    require '../../../../db.php';
    include '../../function/php/transaction.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/transaction.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


</head>

<body>
     <!--Navigation Links-->
    <div class="navbar flex-column bg-white shadow-sm p-3 collapse d-md-flex" id="navbar">
        <div class="navbar-links">
            <a class="navbar-brand d-none d-md-block logo-container" href="#">
                <img src="../../../../assets/img/logo.png">
            </a>
            <a href="admin.php">
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span>
            </a>
            <a href="app-req.php">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Appointment Request</span>
            </a>
            <a href="app-records.php">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Patients Records</span>
            </a>
            <a href="app-records-list.php">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Record Lists</span>
            </a>
            <a href="pos.php">
                <i class="fas fa-cash-register"></i>
                <span>Point of Sales</span>
            </a>
            <a href="transaction.php" class="navbar-highlight">
                <i class="fas fa-exchange-alt"></i>
                <span>Transaction</span>
            </a>
            <div class="maintenance">
                <p class="maintenance-text">Maintenance</p>
                <a href="category-list.php">
                    <i class="fa-solid fa-list"></i>
                    <span>Category List</span>
                </a>
                <a href="service-list.php">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Service List</span>
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
                    <button class="" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                        <li class="dropdown-header">
                            <h5 class=" mb-0">Notification</h5>
                        </li>
                        <li class="dropdown-item">
                            <div class="alert alert-primary mb-0">
                                <strong>Successfully Booked!</strong>
                                <p>Rachel booked an appointment! <a href="#" class="alert-link">Check it now!</a></p>                               
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="alert alert-danger mb-0">
                                <strong>Decline</strong>
                                <p>Admin Kim declined Jana's appointment.<a href="#" class="alert-link">See here.</a></p> 
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="alert alert-success mb-0">
                                <strong>Paid!</strong>
                                <p>James paid the bill.</p> 
                            </div>
                        </li>
                        <li class="dropdown-item">
                            <div class="alert alert-primary mb-0">
                                <strong>Successfully Booked!</strong>
                                <p>Rachel booked an appointment! <a href="#" class="alert-link">Check it now!</a></p>                               
                            </div>
                        </li>
                       
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../../../assets/img/vet logo.jpg" style="width: 40px; height: 40px; object-fit: cover;">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../../users/web/api/login.html">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
         <!--Notification and Profile Admin End-->
        <div class="app-req">
            <h3>Transactions</h3>
            <div class="walk-in px-lg-5">
                <div class="mb-3 x d-flex justify-content-end">
                    <div class="search ">
                        <div class="search-bars">
                            <i class="fa fa-magnifying-glass"></i>
                            <input type="text" id="search-input" class="form-control" placeholder="Search by owner name..." />
                        </div>
                    </div>
    
                </div>
            </div>

            <script>
                    $(document).ready(function() {
                        $('#search-input').on('keyup', function() {
                            var searchTerm = $(this).val().trim();

                            $.ajax({
                                url: '../../function/php/search/search_transactions.php', // PHP script to handle search
                                type: 'POST',
                                data: { search: searchTerm },
                                success: function(data) {
                                    $('.row').html(data); // Replace the cards with search results
                                }
                            });
                        });
                    });
                </script>
            

            <div class="container my-4 px-lg-4">
    <div class="row px-lg-4">
        <?php foreach ($records as $record): 
            // Decode JSON fields (services, cost, medication, and supplies)
            $services = json_decode($record['services'], true);
            $costs = json_decode($record['cost'], true);  // Ensure costs are decoded as a JSON array
            $medications = json_decode($record['medication'], true);
            $supplies = json_decode($record['supplies'], true);

            // Handle potential empty or invalid numbers for total
            $total = !empty($record['total']) && is_numeric($record['total']) ? number_format($record['total'], 2) : '0.00';
        ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thank you, <span class="fw-bold"><?php echo htmlspecialchars($record['owner_name']); ?>.</span></h5>
                    
                    <!-- Services Section -->
                    <div class="mb-3">
                        <label for="service" class="form-label fw-bold">Services:</label>
                        <?php if (is_array($services) && is_array($costs)): ?>
                            <?php foreach ($services as $index => $service): ?>
                                <div class="d-flex justify-content-between">
                                    <span id="service"><?php echo htmlspecialchars($service); ?></span>
                                    <span>₱ <?php echo isset($costs[$index]) ? number_format((float)$costs[$index], 2) : '0.00'; ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Medications Section -->
                    <?php if (!empty($medications)): ?>
                    <div class="mb-3">
                        <label for="medication" class="form-label fw-bold">Add Medication or Supplies:</label>
                        <?php foreach ($medications as $medication): ?>
                        <div class="d-flex justify-content-between">
                            <span id="medication"><?php echo htmlspecialchars($medication); ?></span>
                            <span>₱ 25.00</span> <!-- Adjust cost based on your data structure if applicable -->
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Supplies Section -->
                    <?php if (!empty($supplies)): ?>
                    <div class="mb-3">
                        <label for="supplies" class="form-label fw-bold">Supplies:</label>
                        <?php foreach ($supplies as $supply): ?>
                        <div class="d-flex justify-content-between">
                            <span id="supplies"><?php echo htmlspecialchars($supply); ?></span>
                            <span>₱ 299.00</span> <!-- Adjust cost based on your data structure if applicable -->
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Total Section -->
                    <div class="d-flex justify-content-between fw-bold">
                        <span>TOTAL:</span>
                        <span>₱ <?php echo $total; ?></span> <!-- Safely handle and format the total -->
                    </div>
                    
                    <!-- Buttons Section -->
                    <div class="buttons d-flex justify-content-center gap-2">
                        <button onclick="printCard(this)">Print</button>
                        <button class="paid">Paid</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
        

<script>
    function printCard(button) {
    // Find the full card that the clicked button belongs to
    var card = button.closest('.card');
    
    // Store the buttons element and remove it from the card
    var buttons = card.querySelector('.buttons');
    if (buttons) {
        buttons.remove();  // Remove buttons completely
    }

    // Create a header with the brand name and today's date
    var brandHeader = document.createElement('div');
    var today = new Date();
    
    // Format the date as "Month Day, Year" (e.g., September 12, 2024)
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    var formattedDate = today.toLocaleDateString('en-US', options);
    
    brandHeader.innerHTML = `
        <p style="text-align: end; padding: 3px;">${formattedDate}</p>
        <h5 style="text-align: center;">Bark Yard Pet Salon and Wellness Clinic</h5>
        <div style="border: 2px solid #7A3015; width: 80%; justify-content: center; margin: auto;"></div>

    `;
    
    // Insert the header at the top of the card
    card.prepend(brandHeader);

    // Use html2canvas to convert the entire card to an image
    html2canvas(card, { scale: 2 }).then(function(canvas) {
        // Convert canvas to an image URL
        var imgData = canvas.toDataURL('image/png');
        
        // Create a new window for printing
        var printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
            <head>
                <title>Print Card</title>
                <style>
                    body {
                        margin: 0;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        width: 100vw;
                        overflow: hidden;
                    }
                    img {
                        width: 50%;
                        height: auto;
                    }
                </style>
            </head>
            <body>
                <img src="${imgData}" />
            </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.focus();

        // Add an event listener for when printing is done (whether printed or canceled)
        printWindow.onafterprint = function() {
            printWindow.close();
            location.reload(); // Reload the current page after printing is done
        };
        
        printWindow.onload = function() {
            printWindow.print();
        };

    }).catch(function(error) {
        console.error('Error capturing the card for printing:', error);
    });
}


</script>

              <!--Transaction Card End-->
            <ul class="pagination justify-content-end mt-3 px-lg-5" id="paginationControls">
                <li class="page-item">
                    <a class="page-link" href="#" data-page="prev"><</a>
                </li>
                <li class="page-item" id="pageNumbers"></li>
                <li class="page-item">
                    <a class="page-link" href="#" data-page="next">></a>
                </li>
            </ul>
                
            </div>
           
            
             </div>
</body>

       


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" crossorigin="anonymous">
</script>
<script src="../../function/script/toggle-menu.js"></script>
<script src="../../function/script/pagination.js"></script>
<script src="../../function/script/drop-down.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>