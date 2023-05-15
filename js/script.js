window.onload = function () {
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
}


//check
const saveButton = document.getElementById('save-info-profile-changes');
const messageOverlay = document.getElementById('message-overlay');
const messageText = document.getElementById('message-text');

saveButton.addEventListener('click', function() {
  // Show the message overlay
  messageOverlay.style.display = 'block';
  
  // Set the message text
  messageText.textContent = 'Your message here';
  
  // Hide the message overlay after a delay (e.g., 3 seconds)
  setTimeout(function() {
    messageOverlay.style.display = 'none';
  }, 3000);
});
