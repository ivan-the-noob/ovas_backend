<?php
require '../../../../db.php';

session_start();  

    if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../../../users/web/api/login.php");
        exit(); 
    }

$stmt = $conn->prepare("SELECT id, name, profile_picture, comment, view FROM reviews ORDER BY created_at DESC");
$stmt->execute();
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

$latestApprovedReviews = array_filter($reviews, function($review) {
    return $review['view'] == 1;
});
$latestApprovedReviews = array_slice($latestApprovedReviews, 0, 4);

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
                <a href="review.php" class="navbar-highlight">
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
                <a href="unavailable.php">
                    <i class="fa-solid fa-list"></i>
                    <span>Unavailable Date</span>
                </a>
                <a href="max-book.php">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Max Book</span>
                </a>
                <a href="admin-user.php">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>Admin User List</span>
                </a>
                <a href="chat-bot.php" >
                <i class="fa-solid fa-headset"></i>
                    <span>Chat Bot</span>
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

    
</div>

    <div class="dropdown">
        <button class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../../../../assets/img/vet logo.jpg" style="width: 40px; height: 40px; object-fit: cover;">
        </button>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="../../../users/web/api/logout.php">Logout</a></li>
        </ul>
    </div>
</div>

        </div>
         <!--Notification and Profile Admin End-->
        <div class="app-req">
            <h3>User Reviews</h3>
            <div class="walk-in px-lg-5">
                <div class="mb-3 x d-flex">
            
                   
                </div>
            </div>
             <!--Notification and Profile Admin End-->

              

             <!--Category List Modal (add new) End-->
           
             <!--Category Table-->
            <div class="px-lg-5" style="overflow-x: auto;">

            <style>
  


</style>
<table class="table table-hover table-remove-borders">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Review</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($reviews as $index => $review) {
            $profilePicture = $review['profile_picture'] ? 'assets/img/profile/' . htmlspecialchars($review['profile_picture'], ENT_QUOTES, 'UTF-8') : 'assets/img/customer.jfif';
            ?>
            <tr>
                <td class="<?php echo in_array($review, $latestApprovedReviews) ? 'bg-success text-white' : ''; ?>">
                    <?php echo $index + 1; ?>
                </td>
                <td class="<?php echo in_array($review, $latestApprovedReviews) ? 'bg-success text-white' : ''; ?>">
                    <div><?php echo htmlspecialchars($review['name'], ENT_QUOTES, 'UTF-8'); ?></div>
                </td>
                <td class="<?php echo in_array($review, $latestApprovedReviews) ? 'bg-success text-white' : ''; ?>">
                    <?php echo nl2br(htmlspecialchars($review['comment'], ENT_QUOTES, 'UTF-8')); ?>
                </td>
                <td>
                    <!-- Check icon to update view status -->
                    <form action="../../function/php/update_review.php" method="POST" style="display:inline;">
                        <input type="hidden" name="review_id" value="<?php echo $review['id']; ?>">
                        <button type="submit" class="btn btn-success btn-sm" title="Approve">
                            <i class="fas fa-check"></i>
                        </button>
                    </form>

                    <!-- Delete button -->
                    <form action="../../function/php/delete_review.php" method="POST" style="display:inline;">
                        <input type="hidden" name="review_id" value="<?php echo $review['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
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