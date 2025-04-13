<?php
session_start();
unset($_SESSION['partner']);
session_destroy();          
header("Location: login.php");
?>