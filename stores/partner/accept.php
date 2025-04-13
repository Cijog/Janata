<?php
global $Root;
$Root= $_SERVER['DOCUMENT_ROOT'];
session_start();
$user=$_SESSION['partner'];

if(isset($_GET['aid']))
{
    $order_id = $_GET['aid'];

    // Connect to your database
    $conn = new mysqli("localhost", "root", "", "janata");

    // Prepare and execute an SQL query to update the status
    $sql = "UPDATE orders SET partner='$user',status = 2 WHERE oid = $order_id";
    $result = $conn->query($sql);
    

    if ($result) {
        echo "Status updated successfully.";
        header("Location: index.php");
    } else {
        echo "Error updating status: " . $conn->error;
    }

    
}
?>
