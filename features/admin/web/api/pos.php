<?php 
    require '../../function/php/pos_service.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point of Sales | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/pos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

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
            <a href="pos.php"  class="navbar-highlight">
                <i class="fas fa-cash-register"></i>
                <span>Point of Sales</span>
            </a>
            <a href="transaction.php">
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
    <h3>Point of Sales</h3>
    <form action="../../function/php/save_pos.php" method="POST">
        <div class="container field">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6">
                    <div class="receipt">
                        <h3>Pet Owner Name: <input type="text" class="form-control" name="owner_name" placeholder="Name" required></h3>
                        
                        <!-- Services Section -->
                        <div id="service-group">
                            <div class="form-group row service-item">
                                <label class="col-7 col-form-label">Services:</label>
                                <div class="col-5 d-flex">
                                    <select class="form-control service-dropdown" name="services[]">
                                        <option value="">Select a service</option>
                                        <?php foreach ($services as $service): ?>
                                            <option data-cost="<?php echo htmlspecialchars($service['cost']); ?>" value="<?php echo htmlspecialchars($service['service_name']); ?>">
                                                <?php echo htmlspecialchars($service['service_name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!-- Hidden input to store the corresponding cost -->
                                    <input type="hidden" name="cost[]" class="service-cost">
                                    <button type="button" class="add-service add" style="margin-left:auto;">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Title: Add Medication or Supplies -->
                        <h5>Add Medication or Supplies</h5>

                        <!-- Medications Section -->
                        <div id="medication-group">
                            <div class="form-group row medication-item">
                                <label class="col-7 col-form-label">Medications:</label>
                                <div class="col-5 d-flex">
                                    <input type="text" class="form-control" name="medication[]" placeholder="Medication">
                                    <button type="button" class="add-medication add" style="margin-left:auto;">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Supplies Section -->
                        <div id="supplies-group">
                            <div class="form-group row supplies-item">
                                <label class="col-7 col-form-label">Supplies:</label>
                                <div class="col-5 d-flex">
                                    <input type="text" class="form-control" name="supplies[]" placeholder="Supplies">
                                    <button type="button" class="add-supplies add" style="margin-left:auto;">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Total Section -->
                        <div class="form-group row total">
                            <label class="col-7 col-form-label">TOTAL:</label>
                            <div class="col-5">
                                <input type="number" class="form-control" name="total" placeholder="₱00.0" required>
                            </div>
                        </div>
                        <button type="submit" class="save">Add Bills</button>
                    </div>
                </div>
            </div>
        </div>     
    </form>
</div>

<script>
    // Function to update the hidden cost input when a service is selected
    function updateCostListeners() {
        document.querySelectorAll('.service-dropdown').forEach(function(dropdown) {
            dropdown.addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var costInput = this.parentNode.querySelector('.service-cost');
                
                if (selectedOption) {
                    var cost = selectedOption.getAttribute('data-cost');
                    costInput.value = cost;  // Update the hidden input with the service cost
                } else {
                    costInput.value = '';  // Clear the hidden input if no service is selected
                }
            });
        });
    }

    // Initially apply cost update listeners
    updateCostListeners();

    // Add new service input when the "+" button is clicked
    document.querySelector('#service-group').addEventListener('click', function(event) {
        if (event.target.classList.contains('add-service')) {
            var serviceItem = event.target.closest('.service-item');
            var newServiceItem = document.createElement('div');
            newServiceItem.classList.add('form-group', 'row', 'service-item');
            newServiceItem.style.marginTop = '10px';

            // Create select element and remove button, along with hidden cost input
            newServiceItem.innerHTML = `
                <div class="col-7"></div>
                <div class="col-5 d-flex">
                    <select class="form-control service-dropdown" name="services[]">
                        <option value="">Select a service</option>
                        <?php foreach ($services as $service): ?>
                            <option data-cost="<?php echo htmlspecialchars($service['cost']); ?>" value="<?php echo htmlspecialchars($service['service_name']); ?>">
                                <?php echo htmlspecialchars($service['service_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="cost[]" class="service-cost">
                    <button type="button" class="remove-service add" style="margin-left:auto;">-</button>
                </div>
            `;

            // Append the new service item to the service group
            document.querySelector('#service-group').appendChild(newServiceItem);

            // Re-apply the cost update listeners to the new dropdowns
            updateCostListeners();
        }
    });

    // Add new medication input when the "+" button is clicked
    document.querySelector('#medication-group').addEventListener('click', function(event) {
        if (event.target.classList.contains('add-medication')) {
            var medicationItem = document.createElement('div');
            medicationItem.classList.add('form-group', 'row', 'medication-item');
            medicationItem.style.marginTop = '10px';

            // Create input field and remove button
            medicationItem.innerHTML = `
                <div class="col-7"></div>
                <div class="col-5 d-flex">
                    <input type="text" class="form-control" name="medication[]" placeholder="Medication">
                    <button type="button" class="remove-medication add" style="margin-left:auto;">-</button>
                </div>
            `;

            // Append the new medication item to the medication group
            document.querySelector('#medication-group').appendChild(medicationItem);
        }
    });

    // Add new supplies input when the "+" button is clicked
    document.querySelector('#supplies-group').addEventListener('click', function(event) {
        if (event.target.classList.contains('add-supplies')) {
            var suppliesItem = document.createElement('div');
            suppliesItem.classList.add('form-group', 'row', 'supplies-item');
            suppliesItem.style.marginTop = '10px';

            // Create input field and remove button
            suppliesItem.innerHTML = `
                <div class="col-7"></div>
                <div class="col-5 d-flex">
                    <input type="text" class="form-control" name="supplies[]" placeholder="Supplies">
                    <button type="button" class="remove-supplies add" style="margin-left:auto;">-</button>
                </div>
            `;

            // Append the new supplies item to the supplies group
            document.querySelector('#supplies-group').appendChild(suppliesItem);
        }
    });

    // Remove service, medication, or supplies input when "-" button is clicked
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-service')) {
            event.target.closest('.service-item').remove();
        } else if (event.target.classList.contains('remove-medication')) {
            event.target.closest('.medication-item').remove();
        } else if (event.target.classList.contains('remove-supplies')) {
            event.target.closest('.supplies-item').remove();
        }
    });
</script>







                
</body>

       
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" crossorigin="anonymous">
</script>
<script src="../../function/script/toggle-menu.js"></script>
<script src="../../function/script/pagination.js"></script>
<script src="../../function/script/drop-down.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</html>