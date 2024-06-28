// JavaScript for loading data asynchronously

// Example function to load student data
function loadStudentData(studentId) {
    // Example AJAX request using Fetch API (modern approach)
    fetch('scripts/load_student_data.php?id=' + studentId)
    .then(response => response.json())
    .then(data => {
        // Example code to handle loaded data (e.g., update UI)
        console.log(data);
        // Update DOM elements with loaded data
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Example usage
// loadStudentData(123); // Replace with actual student ID
