<?php

session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../../users/web/api/login.php");
    exit();
}

if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8');

    echo "<script>
        window.onload = function() {
            Swal.fire({
                title: 'Success',
                text: '$message',
                icon: 'success',
                confirmButtonText: 'OK',
                html: '$message'
            });
        };
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Bot | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/chat-bot.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../function/script/toggle-menu.js"></script>
    <script src="../../function/script/checkup_pagination.js"></script>
    <script src="../../function/script/drop-down.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link rel="icon" href="../../../../assets/img/logo.png" type="image/x-icon">



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
                <a href="admin-user.php">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>Admin User List</span>
                </a>
                <a href="chat-bot.php" class="navbar-highlight" >
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
        <!--Notification and Profile Admin-->
        <div class="app-req">
            <h3>Chat Bot</h3>
            <div class="walk-in px-lg-5">
                <div class="mb-3 x d-flex">
                    <div class="search">
                        <div class="search-bars">
                            <i class="fa fa-search"></i> <!-- Updated icon for search -->
                            <input type="text" class="form-control" placeholder="Search..." id="search-input">
                        </div>
                    </div>
                </div>
            </div>


            <div class="chat-bot">
                <button type="button" class="btn checkup-btn" data-bs-toggle="modal" data-bs-target="#chatFormModal">
                    Add New Chat
                </button>
            </div>

            <div class="modal fade" id="chatFormModal" tabindex="-1" aria-labelledby="chatFormModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered d-flex mx-auto justify-content-center">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="chatFormModalLabel">Add New Chat Question and Response</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="chatForm" method="POST" action="../../function/php/save_chat.php">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="question" class="form-label">Question</label>
                                    <input type="text" class="form-control" id="question" name="question" required>
                                </div>
                                <div class="mb-3">
                                    <label for="response" class="form-label">Response</label>
                                    <textarea class="form-control" id="response" name="response" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Chat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-wrapper px-lg-5 mt-4">
    <table class="table table-hover table-remove-borders">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Question</th>
                <th>Response</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tableBody">
        <?php
                require '../../../../db.php';

                try {
                    $sql = "SELECT id, question, response FROM chat_messages";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['question']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['response']) . "</td>";
                            echo "<td>
                                    <button class='btn btn-primary' 
                                            data-bs-toggle='modal' 
                                            data-bs-target='#editModal" . htmlspecialchars($row['id']) . "'>
                                        Edit
                                    </button>
                                    <button class='btn btn-danger' 
                                            data-bs-toggle='modal' 
                                            data-bs-target='#deleteModal" . htmlspecialchars($row['id']) . "'>
                                        Delete
                                    </button>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No questions and responses found.</td></tr>";
                    }
                    
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>

        </tbody>
        </table>
        </div>
        <?php
        $stmt->execute(); 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal<?php echo htmlspecialchars($row['id']); ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Chat Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../../function/php/edit_chat.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <div class="mb-3">
                                <label for="editQuestion" class="form-label">Question</label>
                                <input type="text" class="form-control" id="editQuestion" name="question" value="<?php echo htmlspecialchars($row['question']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="editResponse" class="form-label">Response</label>
                                <textarea class="form-control" id="editResponse" name="response" required><?php echo htmlspecialchars($row['response']); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal<?php echo htmlspecialchars($row['id']); ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this chat message?
                    </div>
                    <div class="modal-footer">
                        <form action="../../function/php/delete_chat.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
}
?>



           

            <ul class="pagination justify-content-end mt-3 px-lg-5" id="paginationControls">
                <li class="page-item">
                    <a class="page-link" href="#" data-page="prev">
                        < </a>
                </li>
                <li class="page-item" id="pageNumbers"></li>
                <li class="page-item">
                    <a class="page-link" href="#" data-page="next">></a>
                </li>
            </ul>
        </div>
    </div>
</body>






            
</form>


<script>
    $(document).ready(function() {
        $('#search-input').on('keyup', function() {
            let searchTerm = $(this).val().toLowerCase();

            $('.card-body').each(function() {
                let ownerName = $(this).find('#ownerName').text().toLowerCase();
                if (ownerName.includes(searchTerm)) {
                    $(this).closest('.col-md-3').show();
                } else {
                    $(this).closest('.col-md-3').hide();
                }
            });
        });
    });
</script>





</html>
