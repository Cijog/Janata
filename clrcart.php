<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Clear the cart session
unset($_SESSION['cart']);

// You can also clear any cart-related data from the database if needed
// For example, if you are storing cart data in a database table

// Assuming you have a database connection
$conn = new mysqli("localhost", "root", "", "janata");

// Check for a successful database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have a table named 'cart' to store cart data
// You may need to adjust this query based on your database schema
$sql = "DELETE FROM cart";

// Execute the SQL query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Return a success message
    $response = array('status' => 'success', 'message' => 'Cart cleared successfully');
} else {
    // Return an error message
    $response = array('status' => 'error', 'message' => 'Failed to clear cart');
}

// Close the database connection
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
