<?php
// Include the database connection file
require_once 'config.php';

// Set the response header as JSON
header('Content-Type: application/json');

// Check the request method
$method = $_SERVER['REQUEST_METHOD'];

// Handle GET request to fetch categories
if ($method === 'GET') {
    // Fetch all categories from the table
    $query = "SELECT * FROM category";
    $result = mysqli_query($conn, $query);

    // Check if any categories were found
    if (mysqli_num_rows($result) > 0) {
        $categories = array();

        // Fetch each category as an associative array
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }

        // Return the categories as JSON
        echo json_encode($categories);
    } else {
        // No categories found
        echo json_encode(array('message' => 'No categories found.'));
    }
}

// Close the database connection
mysqli_close($conn);
?>
