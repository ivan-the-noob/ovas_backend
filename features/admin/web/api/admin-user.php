<?php 
require '../../../../db.php'; // Include your database connection file

// Initialize variables for storing error and success messages
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security
    $role = $_POST['role'];

    try {
        // Check if the email already exists in the database
        $checkEmailStmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $checkEmailStmt->bindParam(':email', $email);
        $checkEmailStmt->execute();

        if ($checkEmailStmt->rowCount() > 0) {
            // Email already exists, set error message
            $error = "The email address is already in use.";
        } else {
            // Email does not exist, proceed with the insertion
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");

            // Bind the parameters to the statement
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':role', $role);

            // Execute the statement
            if ($stmt->execute()) {
               
            } else {
                $error = "Error: Could not add user.";
            }
        }
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }

}

try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE role IN ('admin', 'staff')");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


    $conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin User List | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/admin-user.css">
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
            <a href="pos.php">
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
                <a href="admin-user.php" class="navbar-highlight">
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
         <!--Noticiation and Profile Admin End-->
        <div class="app-req">
            <h3>Admin User List</h3>
            <div class="walk-in px-lg-5">
                <div class="mb-3 x d-flex">
                    <div class="">
                        <div class="search-bars">
                            <i class="fa fa-magnifying-glass"></i>
                            <input type="text" id="search-input" class="form-control" placeholder="Search...">
                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $('#search-input').on('keyup', function() {
                                var searchTerm = $(this).val().trim();

                                $.ajax({
                                    url: '../../function/php/search/search_users.php', // PHP script to handle search
                                    type: 'POST',
                                    data: { search: searchTerm },
                                    success: function(data) {
                                        $('#tableBody').html(data); // Replace the table body with search results
                                    }
                                });
                            });
                        });
                    </script>

                    <button type="button" class=" btn-new" data-toggle="modal" data-target="#addCategoryModal">
                        Add new
                    </button>
                </div>
            </div>
            <!--Category Modal-->
            <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form that submits to the same page -->
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control mt-2" id="name" name="name" placeholder="Enter name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control mt-2" id="email" name="email" placeholder="Enter email" required>
                        <!-- Display error below the input if email exists -->
                        <?php if (!empty($error)): ?>
                            <small class="text-danger"><?php echo $error; ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control mt-2" id="password" name="password" placeholder="Enter password" required>
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control mt-2" id="role" name="role" required>
                            <option value="">Select User Type</option>
                            <option value="staff">Staff</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

 
                    <div class="modal-footer">
                        <button type="submit" class="btn-new">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




             <!--Category Modal End-->


           <!--Category Table-->
            <div class = "table-wrapper px-lg-5">
            <table class="table table-hover table-remove-borders">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
    <?php if (!empty($users)): ?>
        <?php foreach ($users as $index => $user): ?>
            <tr class="test-hover">
                <td><?php echo $index + 1; ?></td>
                <td><img src="../../../../assets/img/customer.jfif" alt="Avatar"></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo ucfirst(htmlspecialchars($user['role'])); ?></td>
                <td>
                    <!-- Button to open the modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal-<?php echo $user['id']; ?>">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal-<?php echo $user['id']; ?>">
                        <i class="fas fa-trash-alt"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="editUserModal-<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="editUserModalLabel-<?php echo $user['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-between">
                                    <h5 class="modal-title" id="editUserModalLabel-<?php echo $user['id']; ?>">Edit User</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form to update user -->
                                    <form action="../../function/php/edit_user.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

                                        <div class="mb-3">
                                            <label for="name-<?php echo $user['id']; ?>" class="form-label">Name</label>
                                            <input type="text" class="form-control edit_admin text-center" id="name-<?php echo $user['id']; ?>" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email-<?php echo $user['id']; ?>" class="form-label">Email</label>
                                            <input type="email" class="form-control edit_admin text-center" id="email-<?php echo $user['id']; ?>" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="role-<?php echo $user['id']; ?>" class="form-label">Role</label>
                                            <select class="form-control edit_admin text-center" id="role-<?php echo $user['id']; ?>" name="role" required>
                                                <option value="staff" <?php if ($user['role'] == 'staff') echo 'selected'; ?>>Staff</option>
                                                <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                            </select>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteUserModal-<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="deleteUserModalLabel-<?php echo $user['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-between">
                                    <h5 class="modal-title" id="deleteUserModalLabel-<?php echo $user['id']; ?>">Delete User</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this user?</p>
                                    <p><strong><?php echo htmlspecialchars($user['name']); ?></strong> (<?php echo htmlspecialchars($user['email']); ?>)</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="../../function/php/delete_user.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6" class="text-center">No users found</td>
        </tr>
    <?php endif; ?>
</tbody>


            </table>
            <?php if (!empty($error)): ?>
                            <small class="text-danger"><?php echo $error; ?></small>
                        <?php endif; ?>
       
            </div>
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
            <!--Category Table End-->
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