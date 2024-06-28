// JavaScript for calculating transcript details

// Example function to calculate GPA and transcript details
function calculateTranscript(studentId) {
    // Example AJAX request using Fetch API (modern approach)
    fetch('scripts/calculate_transcript.php?id=' + studentId)
    .then(response => response.json())
    .then(data => {
        // Example code to handle calculated transcript data
        console.log(data);
        // Update DOM elements with calculated transcript details
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Example usage
// calculateTranscript(456); // Replace with actual student ID
