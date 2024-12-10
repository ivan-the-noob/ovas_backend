<?php 
    require '../../../../db.php';
    include '../../function/php/transaction.php';

    session_start();  

    if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
        header("Location: ../../../users/web/api/login.php");
        exit(); 
    }
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
                    <li><a class="dropdown-item" href="../../../users/web/api/logout.php">Logout</a></li>
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
                                url: '../../function/php/search/search_transactions.php', 
                                type: 'POST',
                                data: { search: searchTerm },
                                success: function(data) {
                                    $('.row').html(data); 
                                }
                            });
                        });
                    });
                </script>
            

            <div class="container my-4 px-lg-4">
    <div class="row px-lg-4" id="cardContainer">
        <?php foreach ($records as $record): 
            $services = json_decode($record['services'], true);
            $costs = json_decode($record['cost'], true); 
            $medications = json_decode($record['medication'], true);
            $supplies = json_decode($record['supplies'], true);
            $total = !empty($record['total']) && is_numeric($record['total']) ? number_format($record['total'], 2) : '0.00';
            $cash_tendered = !empty($record['cash_tendered']) && is_numeric($record['cash_tendered']) ? number_format($record['cash_tendered'], 2) : '0.00'; // Get cash_tendered
            $changee = !empty($record['changee']) && is_numeric($record['changee']) ? number_format($record['changee'], 2) : '0.00'; // Get changee
        ?>
        <div class="col-md-4 mb-4 card-item">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thank you, <span class="fw-bold"><?php echo htmlspecialchars($record['owner_name']); ?>.</span></h5>
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
                    <?php if (!empty($medications)): ?>
                    <div class="mb-3">
                        <label for="medication" class="form-label fw-bold">Add Medication or Supplies:</label>
                        <?php foreach ($medications as $medication): ?>
                        <div class="d-flex justify-content-between">
                            <span id="medication"><?php echo htmlspecialchars($medication); ?></span>
                            <span>₱ 25.00</span> 
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($supplies)): ?>
                    <div class="mb-3">
                        <label for="supplies" class="form-label fw-bold">Supplies:</label>
                        <?php foreach ($supplies as $supply): ?>
                        <div class="d-flex justify-content-between">
                            <span id="supplies"><?php echo htmlspecialchars($supply); ?></span>
                            <span>₱ 299.00</span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>TOTAL:</span>
                        <span>₱ <?php echo $total; ?></span>
                    </div>
                    
                    <div class="d-flex justify-content-between fw-bold mt-3">
                        <span>CASH TENDERED:</span>
                        <span>₱ <?php echo $cash_tendered; ?></span>
                    </div>
                    
                    <div class="d-flex justify-content-between fw-bold">
                        <span>CHANGE:</span>
                        <span>₱ <?php echo $changee; ?></span>
                    </div>
                    
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
    var card = button.closest('.card');
    
    var buttons = card.querySelector('.buttons');
    if (buttons) {
        buttons.remove();  
    }


    var brandHeader = document.createElement('div');
    var today = new Date();
    
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    var formattedDate = today.toLocaleDateString('en-US', options);
    
    brandHeader.innerHTML = `
        <p style="text-align: end; padding: 3px;">${formattedDate}</p>
        <h5 style="text-align: center;">Bark Yard Pet Salon and Wellness Clinic</h5>
        <div style="border: 2px solid #7A3015; width: 80%; justify-content: center; margin: auto;"></div>

    `;
    
    card.prepend(brandHeader);

    html2canvas(card, { scale: 2 }).then(function(canvas) {
        var imgData = canvas.toDataURL('image/png');
        
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

        printWindow.onafterprint = function() {
            printWindow.close();
            location.reload(); 
        };
        
        printWindow.onload = function() {
            printWindow.print();
        };

    }).catch(function(error) {
        console.error('Error capturing the card for printing:', error);
    });
}


</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const rowsPerPage = 3; 
    const cards = document.querySelectorAll('.card-item');
    const totalPages = Math.ceil(cards.length / rowsPerPage);
    const paginationControls = document.getElementById('paginationControls');
    const pageNumbers = document.getElementById('pageNumbers');
    let currentPage = 1;

    function updatePageNumbers() {
        pageNumbers.innerHTML = '';
        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.className = 'page-item';
            li.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
            if (i === currentPage) {
                li.classList.add('active');
            }
            pageNumbers.appendChild(li);
        }
    }

    function showPage(pageNumber) {
        if (pageNumber < 1 || pageNumber > totalPages) return;
        currentPage = pageNumber;

        const start = (pageNumber - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        cards.forEach((card, index) => {
            card.style.display = (index >= start && index < end) ? '' : 'none';
        });

        updatePageNumbers();
    }

    paginationControls.addEventListener('click', function(e) {
        e.preventDefault();
        const page = e.target.getAttribute('data-page');
        if (page === 'prev') {
            showPage(currentPage - 1);
        } else if (page === 'next') {
            showPage(currentPage + 1);
        } else if (page) {
            showPage(parseInt(page));
        }
    });

    // Show the first page by default
    showPage(1);
});
</script>

              <!--Transaction Card End-->
              <ul class="pagination justify-content-end mt-3 px-lg-5" id="paginationControls">
                <li class="page-item">
                    <a class="page-link" href="#" data-page="prev" style="margin-right: 5px"><</a>
                </li>
                <li class="page-item d-flex gap-2" id="pageNumbers"></li>
                <li class="page-item">
                    <a class="page-link" href="#" data-page="next" style="margin-left: 5px">></a>
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

<script src="../../function/script/drop-down.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>