<?php
session_start();

if (!isset($_SESSION['store_id'])) {
    header("Location: login.php"); // Redirect to login if store_id is not set in the session
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['aid'])) {
    $item_id = $_GET['aid'];
    $store_id=$_SESSION['store_id'];
    $conn = new mysqli("localhost", "root", "", "janata");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Fetch item details based on item_id
    $fetchItemQuery = "SELECT item_name,quantity FROM inventory WHERE item_id = ? and store_id= ? ";
    $stmtFetchItem = $conn->prepare($fetchItemQuery);
    $stmtFetchItem->bind_param("ii", $item_id,$store_id);
    $stmtFetchItem->execute();
    $resultFetchItem = $stmtFetchItem->get_result();

    if ($resultFetchItem && $resultFetchItem->num_rows > 0) {
        $rowItem = $resultFetchItem->fetch_assoc();
        $item_name = $rowItem['item_name'];
        $current_quantity=$rowItem['quantity'];

        // Insert order into topup table
        $insertOrderQuery = "INSERT INTO topup (store_id, products, quantity, date, status) VALUES (?, ?, ?, NOW(), 'Pending')";
        $stmtInsertOrder = $conn->prepare($insertOrderQuery);
        $stmtInsertOrder->bind_param("iss", $_SESSION['store_id'], $item_name, $quantity);
        
        // Assuming quantity is a predefined value or should be obtained from user input
        $quantity = 200-$current_quantity;

        if ($stmtInsertOrder->execute()) {
            $_SESSION['msg'] = "Order placed successfully!";
        } else {
            $_SESSION['msg'] = "Error placing order: " . $stmtInsertOrder->error;
        }

        // Close prepared statements
        $stmtFetchItem->close();
        $stmtInsertOrder->close();
    } else {
        $_SESSION['msg'] = "Error fetching item details: " . $stmtFetchItem->error;
    }

    // Close database connection
    $conn->close();

    // Redirect back to the page with the inventory table
    header("Location: stock.php");
    exit();
} else {
    // Invalid request, redirect to some error page or handle accordingly
    header("Location: error.php");
    exit();
}
?>
