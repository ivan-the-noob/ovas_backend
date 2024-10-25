$(document).ready(function() {
    // Search Functionality
    $('#search-input').on('input', function() {
        let query = $(this).val().toLowerCase(); // Get the search query

        $('.appointment-card').each(function() {
            let cardText = $(this).text().toLowerCase(); // Get the text content of the card
            if (cardText.includes(query)) {
                $(this).show(); // Show the card if it matches
            } else {
                $(this).hide(); // Hide the card if it does not match
            }
        });
    });

    // Sort Functionality
    $(document).ready(function() {
        $('#sort-dropdown').on('change', function() {
            let sortBy = $(this).val(); // Get the selected sort option
            let cards = $('.appointment-card').get(); // Get all the cards
    
            // Reset the cards visibility
            cards.forEach(card => $(card).show());
    
            // Filter cards based on selected option
            if (sortBy === 'medical') {
                cards.forEach(card => {
                    if ($(card).data('service-category') !== 'medical') {
                        $(card).hide(); // Hide non-medical cards
                    }
                });
            } else if (sortBy === 'nonMedical') {
                cards.forEach(card => {
                    if ($(card).data('service-category') !== 'nonmedical') {
                        $(card).hide(); // Hide medical cards
                    }
                });
            } else if (sortBy === 'pending') {
                cards.forEach(card => {
                    if ($(card).data('status') !== 'pending') {
                        $(card).hide(); // Hide non-pending cards
                    }
                });
            } else if (sortBy === 'confirm') {
                cards.forEach(card => {
                    if ($(card).data('status') !== 'confirm') {
                        $(card).hide(); // Hide non-confirmed cards
                    }
                });
            } else if (sortBy === 'decline') {
                cards.forEach(card => {
                    if ($(card).data('status') !== 'decline') {
                        $(card).hide(); // Hide non-declined cards
                    }
                });
            }
    
            // Optional: Sort by name if selected
            if (sortBy === 'name') {
                cards.sort(function(a, b) {
                    let aValue = $(a).data('name');
                    let bValue = $(b).data('name');
                    return aValue.localeCompare(bValue); // Compare names
                });
            }
    
            // Append filtered/sorted cards back to the container
            $('#appointments-container').empty(); // Clear the existing cards
            $.each(cards, function(index, card) {
                $('#appointments-container').append(card);
            });
        });
    
        // Reset button functionality
        $('#reset-sort').on('click', function() {
            $('#sort-dropdown').val(''); // Reset the dropdown selection
            $('.appointment-card').show(); // Show all cards
            $('#appointments-container').empty(); // Clear the existing cards
    
            // Append all cards back to the container
            $('.appointment-card').each(function() {
                $('#appointments-container').append(this);
            });
        });
    });
    
    
    

});