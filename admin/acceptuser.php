<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/autoload.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['aid'])) {
    $id = $_GET['aid'];

    $conn = new mysqli("localhost", "root", "", "janata");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch user details from userreq
    $sql_select = "SELECT * FROM userreq WHERE uid = '$id'";
    
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Insert user details into tblusers
        $sql_insert = "INSERT INTO tblusers (uid, cname, store_id, uname, password, address, phone, postcode, email) 
                       VALUES ('{$row['uid']}', '{$row['cname']}', '{$row['store_id']}', '{$row['uname']}', '{$row['password']}', '{$row['address']}', '{$row['phone']}', '{$row['postcode']}', '{$row['email']}')";

        if ($conn->query($sql_insert) === TRUE) {
            // Send email using PHPMailer
            $mail = new PHPMailer(true); // Passing `true` enables exceptions

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'cijogeorge2002@gmail.com'; // Replace with your SMTP username
                $mail->Password = 'ktqs ahqs ueyz bpsa'; // Replace with your SMTP password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('cijogeorge2002@gmail.com', 'Janata'); // Replace with your details
                // Check the column name for email in the userreq table
                $mail->addAddress($row['email'], $row['uname']); // Fetch email from the row and set it as the recipient
                $mail->Subject = 'Account Accepted';
                $mail->Body = "Dear {$row['uname']},\n\nYour account has been accepted. Thank you for joining us!";
                $mail->SMTPDebug = 2;
                $mail->send();
                $_SESSION['msg'] = "User accepted successfully!";
            } catch (Exception $e) {
                $_SESSION['msg'] = "Error accepting user: " . $mail->ErrorInfo;
            }

            // Delete the user from userreq
            $sql_delete = "DELETE FROM userreq WHERE uid = '$id'";
            $conn->query($sql_delete);
        } else {
            $_SESSION['msg'] = "Error accepting user: " . $conn->error;
        }
    }

    $conn->close();
    header("Location: userreq.php"); // Redirect to your previous page
    exit();
} else {
    header("Location: userreq.php"); // Redirect to your previous page
    exit();
}
?>
