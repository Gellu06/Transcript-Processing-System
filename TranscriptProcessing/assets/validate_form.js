// JavaScript for form validation

// Example function to validate registration form inputs
function validateRegistrationForm() {
    let fullName = document.getElementById('fullName').value;
    let matricNo = document.getElementById('matricNo').value;

    if (fullName === '' || matricNo === '') {
        alert('Please fill in all fields.');
        return false;
    }
    return true;
}

// Example usage
// Add event listener to form submission for validation
// document.getElementById('registrationForm').addEventListener('submit', function(event) {
//     if (!validateRegistrationForm()) {
//         event.preventDefault(); // Prevent form submission if validation fails
//     }
// });
