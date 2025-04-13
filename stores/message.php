<?php
// Include database connection
session_start();
if (isset($_SESSION['store'])) {
    // User is logged in, continue with the code
} else {
    header("Location: login.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "janata");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch messages from the message table
$sql = "SELECT * FROM message";
$result = $conn->query($sql);

// Check if there are messages
if ($result && $result->num_rows > 0) {
    $messages = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $messages = [];
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - Janata</title>
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
    <h2>Messages</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                   
                    <th>Name</th>
                    <th>Body</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                    <tr>
                        <td><?php echo $message['id']; ?></td>
                       
                        <td><?php echo $message['name']; ?></td>
                        <td><?php echo $message['body']; ?></td>
                        <td><?php echo $message['msg']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
