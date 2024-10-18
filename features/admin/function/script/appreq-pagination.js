document.addEventListener('DOMContentLoaded', function() {
    const rowsPerPage = 6; // Number of appointments to show per page
    const cards = document.querySelectorAll('.appointment-card'); // Get all appointment cards
    const totalPages = Math.ceil(cards.length / rowsPerPage); // Calculate total pages
    const paginationControls = document.getElementById('paginationControls');
    const pageNumbers = document.getElementById('pageNumbers');
    let currentPage = 1;

    // Function to update page numbers
    function updatePageNumbers() {
        pageNumbers.innerHTML = ''; // Clear existing page numbers
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

    // Function to show a specific page of appointment cards
    function showPage(pageNumber) {
        if (pageNumber < 1 || pageNumber > totalPages) return; // Return if out of bounds
        currentPage = pageNumber;

        const start = (pageNumber - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        // Show or hide cards based on current page
        cards.forEach((card, index) => {
            if (index >= start && index < end) {
                card.style.display = ''; // Show card
            } else {
                card.style.display = 'none'; // Hide card
            }
        });

        updatePageNumbers(); // Update the pagination numbers
    }

    // Event listener for pagination controls
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
