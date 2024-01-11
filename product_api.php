<?php
// Include the database connection file
require_once 'config.php';

// Set the response header as JSON
header('Content-Type: application/json');

// Check the request method
$method = $_SERVER['REQUEST_METHOD'];
$categoryName = $_GET['category'];

// Handle GET request to fetch products
if ($method === 'GET') {
    // Fetch all products from the table
    $query = "SELECT * FROM products where catagory='$categoryName'";
    $result = mysqli_query($conn, $query);

    // Check if any products were found
    if (mysqli_num_rows($result) > 0) {
        $products = array();

        // Fetch each product as an associative array
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }

        // Return the products as JSON
        echo json_encode($products);
    } else {
        // No products found
        echo json_encode(array('message' => 'No products found.'));
    }
}

// Close the database connection
mysqli_close($conn);
?>
