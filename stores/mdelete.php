<?php
session_start();
global $Root;
$Root= $_SERVER['DOCUMENT_ROOT'];
$conn = new mysqli("localhost","root","", "janata");

// this id is actually the value returned using get method
$id=$_GET['id'];
$sql = "SELECT * FROM products where id=$id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
    $row = $result->fetch_assoc();
$photoname=$row['image'];
$path="$Root/janatac/stores/img/$photoname";
if(unlink($path))
{
$sql = "DELETE FROM products WHERE id='$id'";
$result = $conn->query($sql);
if($result)

$_SESSION['msg']="User record deleted successfully";
header("Location:mview.php");
}
else
{
  echo "not unlinked";
}
}

?>
