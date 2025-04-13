<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['did'])) {
    $user_id = $_GET['did'];

    $conn = new mysqli("localhost", "root", "", "janata");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // To delete the user
    $updateStatusQuery = "DELETE FROM tblusers WHERE  uid = ?";
    $stmtUpdateStatus = $conn->prepare($updateStatusQuery);
    $stmtUpdateStatus->bind_param("i", $user_id);

    if ($stmtUpdateStatus->execute()) {
        $_SESSION['msg'] = "User Deleted successfully!";
    } else {
        $_SESSION['msg'] = "Error Deleting User: " . $stmtUpdateStatus->error;
    }

    // Close prepared statements and the database connection
    $stmtUpdateStatus->close();
    $conn->close();

    // Redirect back to the dashboard or the orders page
    header("Location: users.php");
    exit();
} else {
    // Invalid request, redirect to some error page or handle accordingly
    header("Location: error.php");
    exit();
}
?>
