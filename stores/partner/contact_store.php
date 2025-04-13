<?php
// Start the session
session_start();

// Check if partner's name is set in the session
if(isset($_SESSION['partner'])) {
    // Include database connection
    $conn = new mysqli("localhost", "root", "", "janata");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Get partner's name from session
    $partner_name = $_SESSION['partner'];
    
    // Query to fetch store_id and partner_id from partner table using partner's name
    $sql = "SELECT store_id, id FROM partner WHERE name = '$partner_name'";
    $result = $conn->query($sql);
    
    if ($result && $row = $result->fetch_assoc()) {
        $store_id = $row['store_id'];
        $partner_id = $row['id'];
        
        // Fetch store details using store_id
        $sql_store = "SELECT * FROM stores WHERE store_id = '$store_id'";
        $result_store = $conn->query($sql_store);
        
        if ($result_store && $row_store = $result_store->fetch_assoc()) {
            $store_name = $row_store['store_name'];
            $store_address = $row_store['store_address'];
            // Add more details as needed
            
            // Close the database connection
            $conn->close();
        } else {
            echo "Failed to fetch store details.";
        }
    } else {
        echo "Failed to fetch store_id and partner_id.";
    }
} else {
    // Redirect to login page if partner's name is not set in the session
    header("Location: login.php");
    exit();
}

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Get the message and body from the form
    $message = $_POST['message'];
    $body = $_POST['body'];
    
    // Include database connection
    $conn = new mysqli("localhost", "root", "", "janata");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Escape special characters in message and body
    $message = $conn->real_escape_string($message);
    $body = $conn->real_escape_string($body);
    
    // Insert the message into the message table
    $sql_insert = "INSERT INTO message (id, name, body, msg) VALUES ('$partner_id', '$partner_name', '$body', '$message')";
    if ($conn->query($sql_insert) === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Store - Janata</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Janata</a>
        <!-- Add any navbar elements as needed -->
    </div>
</nav>

<!-- Page Content -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Contact <?php echo $store_name; ?></h2>
            <p>Store Address: <?php echo $store_address; ?></p>
            <form method="post" action="">
                <div class="form-group">
                    <label for="body">Body</label>
                    <input type="text" class="form-control" id="body" name="body" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Send Message</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

