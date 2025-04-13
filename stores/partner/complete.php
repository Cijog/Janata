<?php
if(isset($_GET['cid']))
{
    $order_id = $_GET['cid'];

    // Connect to your database
    $conn = new mysqli("localhost", "root", "", "janata");

    // Prepare and execute an SQL query to update the status
    $sql = "UPDATE orders SET status = 1 WHERE oid = $order_id";
    $result = $conn->query($sql);
    

    if ($result) {
        echo "Status updated successfully.";
        header("Location: index.php");
    } else {
        echo "Error updating status: " . $conn->error;
    }

    
}
?>
