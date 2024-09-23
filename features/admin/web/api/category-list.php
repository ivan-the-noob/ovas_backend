<?php
require '../../../../db.php';

try {
    $sql = "SELECT id, category_name FROM categories";
    $stmt = $conn->query($sql);
    
    // Fetch all the categories
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

$count_sql = "SELECT COUNT(*) FROM categories WHERE is_read = 0";
$count_stmt = $conn->query($count_sql);
$unread_count = $count_stmt->fetchColumn();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/category-list.css">
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
                <a href="category-list.php" class="navbar-highlight">
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
    <!--Navigation Links-->
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
        <?php if ($unread_count > 0): ?>
            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle"><?php echo $unread_count; ?></span>
        <?php endif; ?>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
        <li class="dropdown-header">
            <h5 class="mb-0">Notifications</h5>
        </li>
        <?php
        // Fetch notifications
        $notification_sql = "SELECT message FROM notifications WHERE is_read = 0";
        $notification_stmt = $conn->query($notification_sql);
        if ($notification_stmt->rowCount() > 0) {
            while ($row = $notification_stmt->fetch(PDO::FETCH_ASSOC)) {
                $message = htmlspecialchars($row['message']);
                echo '<li class="dropdown-item">
                        <div class="alert alert-success mb-0">
                            <strong>New Notification!</strong>
                            <p>' . $message . '</p>
                        </div>
                    </li>';
            }
            // Mark notifications as read after displaying
            $update_sql = "UPDATE notifications SET is_read = 1 WHERE is_read = 0";
            $conn->query($update_sql);
        } else {
            echo '<li class="dropdown-item">
                    <div class="alert alert-light mb-0">
                        <p>No new notifications.</p>
                    </div>
                </li>';
        }
        ?>
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
            <h3>Category List</h3>
            <div class="walk-in px-lg-5">
                <div class="mb-3 x d-flex">
                    <div class="search">
                        <div class="search-bars">
                            <i class="fa fa-magnifying-glass"></i>
                            <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                        </div>
                    </div>

                    <script>
                            $(document).ready(function() {
                                $('#searchInput').on('keyup', function() {
                                    var searchTerm = $(this).val().trim();

                                    $.ajax({
                                        url: '../../function/php/search/search_categories.php', 
                                        type: 'POST',
                                        data: { search: searchTerm },
                                        success: function(data) {
                                            $('#tableBody').html(data); 
                                        }
                                    });
                                });
                            });
                        </script>
                    <button type="button" class="btn-new" data-toggle="modal" data-target="#addCategoryModal">
                        Add new
                    </button>
                </div>
            </div>
             <!--Notification and Profile Admin End-->

              <!--Category List Modal (add new)-->
              <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header justify-content-between">
                                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="../../function/php/categories/save_category.php" method="POST">
                                    <div class="form-group">
                                        <label for="categoryName">Category Name</label>
                                        <input type="text" class="form-control mt-2" id="categoryName" name="category_name" placeholder="Enter category name" required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                                </form>
                        </div>
                    </div>
                </div>

             <!--Category List Modal (add new) End-->
           
             <!--Category Table-->
            <div class="px-lg-5" style="overflow-x: auto;">
            <table class="table table-hover table-remove-borders">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="tableBody">
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $category): ?>
                <tr class="test-hover">
                    <td><?php echo htmlspecialchars($category['id']); ?></td>
                    <td><?php echo htmlspecialchars($category['category_name']); ?></td>
                    <td>
                        <!-- Update Button triggers the modal -->
                        <button type="button" data-toggle="modal" data-target="#editModal<?php echo $category['id']; ?>" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Delete Button triggers the delete modal -->
                        <button type="button" data-toggle="modal" data-target="#deleteModal<?php echo $category['id']; ?>" title="Delete" style="color: red;">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <!-- Edit Category Modal -->
                        <div class="modal fade" id="editModal<?php echo $category['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $category['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel<?php echo $category['id']; ?>">Edit Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="../../function/php/categories/edit_categories.php" method="POST">
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                                            <div class="form-group">
                                                <label for="categoryName<?php echo $category['id']; ?>">Category Name</label>
                                                <input type="text" class="form-control" id="categoryName<?php echo $category['id']; ?>" name="category_name" value="<?php echo htmlspecialchars($category['category_name']); ?>" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal<?php echo $category['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?php echo $category['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-between">
                                        <h5 class="modal-title" id="deleteModalLabel<?php echo $category['id']; ?>">Delete Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete the category "<?php echo htmlspecialchars($category['category_name']); ?>"?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <a href="../../function/php/categories/delete_category.php?id=<?php echo $category['id']; ?>" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No categories found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

                <!--Category Table End-->

                


                
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