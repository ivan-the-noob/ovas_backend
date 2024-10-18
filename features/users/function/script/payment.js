function selectPayment(paymentMethod, button) {
    const buttons = document.querySelectorAll('.pay-btn button');
    buttons.forEach(btn => {
        btn.classList.remove('selected'); 
        btn.style.backgroundColor = ''; 
        btn.style.color = ''; 
        btn.style.borderColor = '#7A3015'; 
    });

    button.classList.add('selected');
    button.style.backgroundColor = '#7A3015';
    button.style.color = 'white';
    button.style.borderColor = '#7A3015'; 

    document.getElementById('payment_method').value = paymentMethod;

    console.log('payment: ' + document.getElementById('payment_method').value);

    const gcashDetails = document.getElementById('gcash-details');
    if (paymentMethod === 'gcash') {
        gcashDetails.style.display = 'block';
    } else {
        gcashDetails.style.display = 'none'; 
    }
}
