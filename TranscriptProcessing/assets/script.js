// Main JavaScript file for client-side interactions

// Example function to validate form inputs (e.g., registration form)
function validateForm() {
    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;

    if (username === '' || password === '') {
        alert('Please fill in all fields.');
        return false;
    }
    return true;
}

// Example function for AJAX request (e.g., querying results asynchronously)
function queryResults() {
    let studentId = document.getElementById('studentId').value;

    // Example AJAX request using Fetch API (modern approach)
    fetch('scripts/query_result.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ studentId: studentId }),
    })
    .then(response => response.json())
    .then(data => {
        // Example code to handle response data (e.g., update UI)
        console.log(data);
        // Update DOM elements with fetched data
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Example function for printing transcript (e.g., generating and printing PDF)
function printTranscript() {
    // Example code to generate and print transcript
    window.print();
}

// Example event listener (e.g., form submission)
document.getElementById('registrationForm').addEventListener('submit', function(event) {
    if (!validateForm()) {
        event.preventDefault(); // Prevent form submission if validation fails
    }
});

// Example event listener for querying results
document.getElementById('queryResultsBtn').addEventListener('click', function(event) {
    queryResults();
});

// Example event listener for printing transcript
document.getElementById('printTranscriptBtn').addEventListener('click', function(event) {
    printTranscript();
});
