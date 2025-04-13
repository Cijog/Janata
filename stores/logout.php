<?php
session_start();
unset($_SESSION['store']);
session_destroy();          
header("Location: login.php");
?>