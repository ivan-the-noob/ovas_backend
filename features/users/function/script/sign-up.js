


function showResentModal() {
    resendCode();
    
    var resentModal = new bootstrap.Modal(document.getElementById('resentModal'));
    resentModal.show();
  }

  
  function resendCode() {
    const formData = new FormData();
    formData.append('resend', true); 

    fetch('../../function/php/process_signup.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('resend-message').innerHTML = data;
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('resend-message').innerHTML = '<p class="alert alert-danger">Error resending the code. Please try again.</p>';
    });
}