<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "janata");

// Check if store_id is set in the query string
if (isset($_GET['aid'])) {
    $store_id = $conn->real_escape_string($_GET['aid']);

    // Fetch store details based on store_id
    $sql = "SELECT * FROM stores WHERE store_id = '$store_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $store_name = $row['store_name'];
        $store_address = $row['store_address'];
        $store_phone = $row['store_phone'];
    } else {
        // Redirect to stores.php if store_id is not valid
        header("Location: stores.php");
        exit();
    }
} else {
    // Redirect to stores.php if store_id is not provided
    header("Location: stores.php");
    exit();
}

// Check if the form is submitted for updating
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $new_store_name = $conn->real_escape_string($_POST['store_name']);
    $new_store_address = $conn->real_escape_string($_POST['store_address']);
    $new_store_phone = $conn->real_escape_string($_POST['store_phone']);

    // Update the stores table
    $update_sql = "UPDATE stores SET store_name = '$new_store_name', store_address = '$new_store_address', store_phone = '$new_store_phone' WHERE store_id = '$store_id'";
    if ($conn->query($update_sql) === TRUE) {
        $_SESSION['msg'] = "Store details updated successfully!";
    } else {
        $_SESSION['msg'] = "Error updating store details: " . $conn->error;
    }

    // Redirect to stores.php after updating
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
    <title>Edit Store - Janata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <div class="container">
        <h1 class="mt-4">Edit Store</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="store_name" class="form-label">Store Name:</label>
                <input type="text" class="form-control" id="store_name" name="store_name" value="<?php echo $store_name; ?>" required />
            </div>
            <div class="mb-3">
                <label for="store_address" class="form-label">Store Address:</label>
                <textarea class="form-control" id="store_address" name="store_address" required><?php echo $store_address; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="store_phone" class="form-label">Store Phone:</label>
                <input type="text" class="form-control" id="store_phone" name="store_phone" value="<?php echo $store_phone; ?>" required />
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
