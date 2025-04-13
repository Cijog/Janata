<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['aid'])) {
    $order_id = $_GET['aid'];

    $conn = new mysqli("localhost", "root", "", "janata");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the status to "Completed"
    $updateStatusQuery = "UPDATE topup SET status = 1 WHERE order_id = ?";
    $stmtUpdateStatus = $conn->prepare($updateStatusQuery);
    $stmtUpdateStatus->bind_param("i", $order_id);

    if ($stmtUpdateStatus->execute()) {
        $_SESSION['msg'] = "Order completed successfully!";
    } else {
        $_SESSION['msg'] = "Error completing order: " . $stmtUpdateStatus->error;
    }

    // Close prepared statements and the database connection
    $stmtUpdateStatus->close();
    $conn->close();

    // Redirect back to the dashboard or the orders page
    header("Location: index.php");
    exit();
} else {
    // Invalid request, redirect to some error page or handle accordingly
    header("Location: error.php");
    exit();
}
?>
