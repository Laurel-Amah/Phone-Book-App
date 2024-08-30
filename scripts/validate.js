// Restrict letters from the phone number field but allow other characters
document.getElementById('phone').addEventListener('input', function () {
    // Allow only numbers, spaces, and specific characters: +, -, (, )
    this.value = this.value.replace(/[a-zA-Z]/g, ''); // Remove letters only
});

// Form submission event listener
document.getElementById('contactForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent the form from submitting

    clearErrors(); // Clear previous error messages

    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    let isValid = true;

    // Email validation: check for '@' and '.'
    if (!email.includes('@') || !email.includes('.')) {
        displayError('emailError', 'Email must contain "@" and ".".');
        isValid = false;
    }

    // If form is valid, proceed to submit
    if (isValid) {
        alert('Form submitted successfully!');
        // Add your form submission logic here
    }
});

// Display error messages
function displayError(elementId, message) {
    const errorElement = document.getElementById(elementId);
    errorElement.textContent = message;
    const inputField = errorElement.previousElementSibling;
    inputField.classList.add('input-error');
}

// Clear all error messages
function clearErrors() {
    document.querySelectorAll('.error').forEach(error => error.textContent = '');
    document.querySelectorAll('.input-error').forEach(input => input.classList.remove('input-error'));
}
