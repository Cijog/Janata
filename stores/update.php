<?php
global $Root;
$Root = $_SERVER['DOCUMENT_ROOT'];
session_start();
$store_name = $_SESSION['store'];

if (isset($_GET['name'])) {
    $item_name = $_GET['name'];

    // Connect to your database
    $conn = new mysqli("localhost", "root", "", "janata");

    // Get the item_id based on the item_name
    $item_query = "SELECT item_id FROM items WHERE item_name = ?";
    
    // Use prepared statement to prevent SQL injection
    $stmt_item = $conn->prepare($item_query);
    $stmt_item->bind_param("s", $item_name); // 's' indicates a string
    $stmt_item->execute();
    $stmt_item->bind_result($item_id);
    $stmt_item->fetch();
    $stmt_item->close();

    if ($item_id !== null) {
        // Get the store_id based on the store_name
        $store_query = "SELECT store_id FROM stores WHERE store_name = ?";
        $stmt_store = $conn->prepare($store_query);
        $stmt_store->bind_param("s", $store_name);
        $stmt_store->execute();
        $stmt_store->bind_result($store_id);
        $stmt_store->fetch();
        $stmt_store->close();

        if ($store_id !== null) {
            // Prepare and execute an SQL query to update the quantity in the 'inventory' table
            $sql = "UPDATE inventory SET quantity = 200 WHERE item_id = ? AND store_id = ?";

            // Use prepared statement to prevent SQL injection
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $item_id, $store_id); // 'ii' indicates two integers
            $result = $stmt->execute();

            if ($result) {
                echo "Quantity updated successfully.";
                header("Location: stock.php");
            } else {
                echo "Error updating quantity: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error retrieving store information: " . $conn->error;
        }
    } else {
        echo "Error retrieving item information: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
