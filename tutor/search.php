<?php
// Connect to the database using mysqli
include('../incs/connect.php');

// Get the search query from the URL parameters
$nameAvtor = mysqli_real_escape_string($connection, $_GET['nameAvtor'])

// Prepare a SQL statement to search for matching results
        
$sql = "SELECT * FROM tutors WHERE firstname LIKE 'hdfhdhdh'";

$result = mysqli_query($connection, $sql);
// Check for errors
if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}
// Create an array to hold the search results
$search_results = array();

// Loop through the query results and add them to the search results array
while ($row = mysqli_fetch_assoc($result)) {
    $search_results[] = $row['name'];
}

// Return the search results as a JSON-encoded string
echo json_encode($search_results);

// Close the database connection
mysqli_close($connection);
?>