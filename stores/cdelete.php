<?php
session_start();
$conn = new mysqli("localhost","root","","janata");

if(isset($_GET['id']))
{
echo $id=$_GET['id'];

$conn = new mysqli("localhost","root","","janata");

 $sql = "DELETE from tblcategories where id=$id";

$result= $conn->query($sql);

if($result)
{
	$_SESSION['msg']="New record deleted successfully";
	header("Location:cview.php");
}
}
?>