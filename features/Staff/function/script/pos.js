let currentInputIndex = 0;

function addValueToInput(value) {
const inputFields = document.querySelectorAll('.cost-input');
inputFields[currentInputIndex].value += value;
calculateTotal(); 
}
function undoLastCharacter() {
const inputFields = document.querySelectorAll('.cost-input');
const currentInput = inputFields[currentInputIndex];
currentInput.value = currentInput.value.slice(0, -1);
calculateTotal(); 
}

document.querySelectorAll('.pos-button').forEach(button => {
    button.addEventListener('click', function() {
        const valueToAdd = this.getAttribute('data-value');
        addValueToInput(valueToAdd);
    });
});

document.querySelector('.undo-button').addEventListener('click', function() {
    undoLastCharacter();
});

document.querySelectorAll('.cost-input').forEach((input, index) => {
    input.addEventListener('click', function() {
        currentInputIndex = index;
    });
});
   function calculateTotal() {
    let total = 0;

    document.querySelectorAll('input[name="cost[]"]').forEach(function (input) {
        total += parseFloat(input.value) || 0;
    });

    document.querySelectorAll('input[name="medication_cost[]"]').forEach(function (input) {
        total += parseFloat(input.value) || 0;
    });

    document.querySelectorAll('input[name="supplies_cost[]"]').forEach(function (input) {
        total += parseFloat(input.value) || 0; 
    });

    document.querySelector('input[name="total"]').value = total.toFixed(2);
}

function updateServiceCost(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var cost = selectedOption ? parseFloat(selectedOption.getAttribute('data-cost')) : 0;

    var serviceCostInput = selectElement.closest('.service-item').querySelector('.service-cost');
    var serviceCostDisplay = selectElement.closest('.service-item').querySelector('.service-cost-display');

    serviceCostInput.value = cost.toFixed(2);
    serviceCostDisplay.value = cost.toFixed(2);

    calculateTotal();
}

function addServiceListeners() {
    document.querySelectorAll('.service-dropdown').forEach(function (select) {
        select.addEventListener('change', function () {
            updateServiceCost(this);
        });
    });
}

function addNewItemListeners() {
    document.querySelectorAll('input[name="medication_cost[]"]').forEach(function (input) {
        input.addEventListener('input', calculateTotal);
    });

    document.querySelectorAll('input[name="supplies_cost[]"]').forEach(function (input) {
        input.addEventListener('input', calculateTotal);
    });
}



document.querySelector('#medication-group').addEventListener('click', function (event) {
    if (event.target.classList.contains('add-medication')) {
        var medicationItem = document.createElement('div');
        medicationItem.classList.add('form-group', 'row', 'medication-item');
        medicationItem.style.marginTop = '10px';

        medicationItem.innerHTML = `
            <div class="col-4"></div>
            <div class="col-8 d-flex">
                <input type="text" class="form-control" name="medication[]" placeholder="Medication">
                <input type="number" class="form-control cost-input" name="medication_cost[]" placeholder="Cost" style="margin-left: 10px;">
                <button type="button" class="remove-medication add" style="margin-left:auto;">-</button>
            </div>
        `;

        document.querySelector('#medication-group').appendChild(medicationItem);
        
        const medicationCostInput = medicationItem.querySelector('input[name="medication_cost[]"]');
        medicationCostInput.addEventListener('input', calculateTotal);
        
        medicationCostInput.addEventListener('click', function() {
            currentInputIndex = Array.from(document.querySelectorAll('.cost-input')).indexOf(medicationCostInput);
        });
        
        calculateTotal();
    }
});


document.querySelector('#supplies-group').addEventListener('click', function (event) {
    if (event.target.classList.contains('add-supplies')) {
        var suppliesItem = document.createElement('div');
        suppliesItem.classList.add('form-group', 'row', 'supplies-item');
        suppliesItem.style.marginTop = '10px';

        suppliesItem.innerHTML = `
            <div class="col-4"></div>
            <div class="col-8 d-flex">
                <input type="text" class="form-control" name="supplies[]" placeholder="Supplies">
                <input type="number" class="form-control cost-input" name="supplies_cost[]" placeholder="Cost" style="margin-left: 10px;">
                <button type="button" class="remove-supplies add" style="margin-left:auto;">-</button>
            </div>
        `;

        document.querySelector('#supplies-group').appendChild(suppliesItem);
        
        const suppliesCostInput = suppliesItem.querySelector('input[name="supplies_cost[]"]');
        suppliesCostInput.addEventListener('input', calculateTotal);
        
        suppliesCostInput.addEventListener('click', function() {
            currentInputIndex = Array.from(document.querySelectorAll('.cost-input')).indexOf(suppliesCostInput);
        });
        
        calculateTotal();
    }
});

document.addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-service')) {
        event.target.closest('.service-item').remove();
        calculateTotal(); 
    } else if (event.target.classList.contains('remove-medication')) {
        event.target.closest('.medication-item').remove();
        calculateTotal(); 
    } else if (event.target.classList.contains('remove-supplies')) {
        event.target.closest('.supplies-item').remove();
        calculateTotal(); 
    }
});

window.addEventListener('DOMContentLoaded', function() {
    addServiceListeners();
    addNewItemListeners(); 
    calculateTotal(); 
});

