document.addEventListener('DOMContentLoaded', function () {
    const serviceCategoryDropdown = document.getElementById('serviceCategoryDropdown');
    const serviceDropdown = document.getElementById('serviceDropdown');
    const medicalServices = document.querySelector('.medical-services');
    const nonMedicalServices = document.querySelector('.nonMedical-services');
    const totalPayment = document.getElementById('totalPayment');
    
    const selectedServiceCategoryInput = document.getElementById('selectedServiceCategory');
    const selectedServiceInput = document.getElementById('selectedService');
    const servicePriceInput = document.getElementById('servicePrice');
    
    document.querySelectorAll('#serviceCategoryDropdown + .dropdown-menu .dropdown-item').forEach(item => {
        item.addEventListener('click', function () {
            const selectedCategory = this.getAttribute('data-value');
            serviceCategoryDropdown.textContent = this.textContent;
            selectedServiceCategoryInput.value = selectedCategory; // Set hidden input value

            if (selectedCategory === 'medical') {
                medicalServices.style.display = 'block';
                nonMedicalServices.style.display = 'none';
            } else if (selectedCategory === 'nonMedical') {
                medicalServices.style.display = 'none';
                nonMedicalServices.style.display = 'block';
            }

            serviceDropdown.textContent = 'Select Service';
            totalPayment.textContent = '₱0.00';
            selectedServiceInput.value = ''; // Reset selected service
            servicePriceInput.value = ''; // Reset service price
        });
    });
    
    document.querySelectorAll('#serviceDropdown + .dropdown-menu .dropdown-item').forEach(item => {
        item.addEventListener('click', function () {
            const selectedService = this.getAttribute('data-service');
            const selectedValue = this.getAttribute('data-value');
            serviceDropdown.textContent = selectedService;
            totalPayment.textContent = `₱${selectedValue}`;
            
            selectedServiceInput.value = selectedService; // Set hidden input value for service
            servicePriceInput.value = selectedValue; // Set hidden input value for price
        });
    });
});
