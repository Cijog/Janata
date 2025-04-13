<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "janata");

// Check if the form is submitted for insertion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $store_name = $conn->real_escape_string($_POST['store_name']);
    $store_address = $conn->real_escape_string($_POST['store_address']);
    $store_phone = $conn->real_escape_string($_POST['store_phone']);

    // Insert into stores table
    $insert_sql = "INSERT INTO stores (store_name, store_address, store_phone) VALUES ('$store_name', '$store_address', '$store_phone')";

    if ($conn->query($insert_sql) === TRUE) {
        $_SESSION['msg'] = "Store added successfully!";
    } else {
        $_SESSION['msg'] = "Error adding store: " . $conn->error;
    }

    // Redirect to stores.php after insertion
    header("Location: stores.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Add Store - Janata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <div class="container">
        <h1 class="mt-4">Add Store</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="store_name" class="form-label">Store Name:</label>
                <input type="text" class="form-control" id="store_name" name="store_name" required />
            </div>
            <div class="mb-3">
                <label for="store_address" class="form-label">Store Address:</label>
                <textarea class="form-control" id="store_address" name="store_address" required></textarea>
            </div>
            <div class="mb-3">
                <label for="store_phone" class="form-label">Store Phone:</label>
                <input type="text" class="form-control" id="store_phone" name="store_phone" required />
            </div>
            <button type="submit" class="btn btn-primary">Add Store</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
