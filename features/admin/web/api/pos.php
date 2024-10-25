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
                                <label class="col-4 col-form-label">Services:</label>
                                <div class="col-8 d-flex">
                                    <select class="form-control service-dropdown" name="services[]" style="margin: 5px;">
                                        <option value="">Select a service</option>
                                        <?php foreach ($services as $service): ?>
                                            <option data-cost="<?php echo htmlspecialchars($service['cost']); ?>" value="<?php echo htmlspecialchars($service['service_name']); ?>">
                                                <?php echo htmlspecialchars($service['service_name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" name="cost[]" class="service-cost">

                                    <input type="text" class="form-control service-cost-display" placeholder="Cost" readonly>

                                    <button type="button" class="add-service add" style="margin-left:auto;">+</button>
                                </div>
                            </div>
                        </div>
                    
                        <h5>Add Medication or Supplies</h5>

                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-7 text-center">
                                    <div class="pos-buttons">
                                        <button type="button"  class="pos-button btn btn-primary m-1" data-value="0">0</button>
                                        <button type="button" class="pos-button btn btn-primary m-1" data-value="1">1</button>
                                        <button type="button" class="pos-button btn btn-primary m-1" data-value="5">5</button>
                                        <button type="button" class="pos-button btn btn-primary m-1" data-value="10">10</button>
                                        <button type="button" class="pos-button btn btn-primary m-1" data-value="20">20</button>
                                        <button type="button" class="pos-button btn btn-primary m-1" data-value="50">50</button>
                                        <button type="button" class="pos-button btn btn-primary m-1" data-value="100">100</button>
                                        <button type="button" class="pos-button btn btn-primary m-1" data-value="1000">1000</button>
                                        <button type="button" class="undo-button btn btn-secondary m-1"><i class="fas fa-arrow-left"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="medication-group">
                            <div class="form-group row medication-item">
                                <label class="col-4 col-form-label">Medications:</label>
                                <div class="col-8 d-flex">
                                    <input type="text" class="form-control" name="medication[]" placeholder="Medication">
                                    <input type="number" class="form-control cost-input" name="medication_cost[]" placeholder="Cost" style="margin-left: 10px;">
                                    <button type="button" class="add-medication add" style="margin-left:auto;">+</button>
                                </div>
                            </div>
                        </div>


                        <!-- Supplies Section -->
                        <div id="supplies-group">
                            <div class="form-group row supplies-item">
                                <label class="col-4 col-form-label">Supplies:</label>
                                <div class="col-8 d-flex">
                                    <input type="text" class="form-control" name="supplies[]" placeholder="Supplies">
                                    <input type="number" class="form-control cost-input" name="supplies_cost[]" placeholder="Cost" style="margin-left: 10px;">
                                    <button type="button" class="add-supplies add" style="margin-left:auto;">+</button>
                                </div>
                            </div>
                        </div>
                    

                        <div class="form-group row total">
                            <label class="col-7 col-form-label">TOTAL:</label>
                            <div class="col-5">
                                <input type="number" class="form-control" name="total" placeholder="₱00.0" readonly required>
                            </div>
                        </div>

                        <div class="form-group row cash-tendered">
                            <label class="col-7 col-form-label">Cash Tendered:</label>
                            <div class="col-5">
                                <input type="number" class="form-control cost-input" name="cash_tendered" placeholder="₱00.0" required>
                            </div>
                        </div>

                        <div class="form-group row change">
                            <label class="col-7 col-form-label">Change:</label>
                            <div class="col-5">
                                <input type="number" class="form-control" name="changee" placeholder="₱00.0" readonly required>
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
   document.querySelector('#service-group').addEventListener('click', function (event) {
    if (event.target.classList.contains('add-service')) {
        var newServiceItem = document.createElement('div');
        newServiceItem.classList.add('form-group', 'row', 'service-item');
        newServiceItem.style.marginTop = '10px';

        newServiceItem.innerHTML = `
            <label class="col-4 col-form-label">Services:</label>
            <div class="col-8 d-flex">
                <select class="form-control service-dropdown" name="services[]">
                    <option value="">Select a service</option>
                    <?php foreach ($services as $service): ?>
                        <option data-cost="<?php echo htmlspecialchars($service['cost']); ?>" value="<?php echo htmlspecialchars($service['service_name']); ?>">
                            <?php echo htmlspecialchars($service['service_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="cost[]" class="service-cost">
                <input type="text" class="form-control service-cost-display" placeholder="Cost" readonly>
                <button type="button" class="remove-service add" style="margin-left:auto;">-</button>
            </div>
        `;

        document.querySelector('#service-group').appendChild(newServiceItem);

        addServiceListeners();
        calculateTotal(); 
    }
});

document.querySelector('input[name="cash_tendered"]').addEventListener('input', function() {
    const total = parseFloat(document.querySelector('input[name="total"]').value) || 0; 
    const cashTendered = parseFloat(this.value) || 0; 
    const change = cashTendered - total; 
    document.querySelector('input[name="changee"]').value = change >= 0 ? change.toFixed(2) : 0;
});

</script>

              
</body>

       
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" crossorigin="anonymous">
</script>
<script src="../../function/script/toggle-menu.js"></script>
<script src="../../function/script/drop-down.js"></script>
<script src="../../function/script/pos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</html>