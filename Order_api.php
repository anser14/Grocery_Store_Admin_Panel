<?php
// Assuming you have already established the database connection, which you have referred to as $conn.
// Also, the database connection and query should be sanitized to prevent SQL injection.
// Make sure you have the necessary database connection and query execution before this code.
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch data from the "OrderCheck" table for GET request
    $select = mysqli_query($conn, "SELECT * FROM ordercheck");

    // Create an array to store the orders
    $orders = array();

    while ($row = mysqli_fetch_assoc($select)) {
        // Add each order to the $orders array
        $order = array(
            'ordernumber' => $row['ordernumber'],
            'username' => $row['username'],
            'phonenumber' => $row['phonenumber'],
            'orderdetail' => $row['orderdetail'],
            'totalprice' => $row['totalprice']
        );

        $orders[] = $order;
    }

    // Set the appropriate headers to indicate JSON response
//    header('Content-Type: application/json');
header('Content-type: text/plain');

    // Convert the array to JSON and echo it
    echo json_encode(array('orders' => $orders));
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle insertion for POST request

    // Retrieve data from the POST request
    $orderNumber = $_POST['ordernumber'];
     
    $userName = $_POST['username'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phonenumber'];
    $orderDetails = $_POST['orderdetail'];
    $totalPrice = $_POST['totalprice'];

    // Perform data validation if required

    // Perform the database insertion operation
    $insertQuery = "INSERT INTO ordercheck (ordernumber, username, phonenumber, email, orderdetail, totalprice) VALUES ('$orderNumber', '$userName', '$phoneNumber', '$email', '$orderDetails', '$totalPrice')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
        // Return a success response
        echo json_encode(array('success' => true, 'message' => 'Data inserted successfully.'));
    } else {
        // Return an error response
        echo json_encode(array('success' => false, 'message' => 'Error inserting data into the database.'));
    }
} else {
    // Handle invalid HTTP method
    header("HTTP/1.1 405 Method Not Allowed");
    header("Allow: GET, POST");
    echo json_encode(array('error' => 'Invalid method. Only GET and POST requests are allowed.'));
}
?>
