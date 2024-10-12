<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Function to display error message in a dialog box
function showError($errorMessage) {
    echo "<script>alert('$errorMessage');</script>";
}

if(isset($_POST['SendOTP'])) {
    // Handle login functionality
    $user = $_POST['txtUsername'];
    $pass = $_POST['txtPassword'];

    $conn = new mysqli("localhost", "root", "", "janata");

    $sql = "SELECT * FROM tblusers where uname='$user'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $duser = $row['uname'];
            $dpass = $row['password'];
            $email = $row['email']; // Fetch the email from the result
        }
        if($pass == $dpass) {
            $_SESSION['user'] = $duser;
            $_SESSION['email'] = $email; // Store the email in session

            // Generate OTP
            $otp = mt_rand(100000, 999999);
            $_SESSION['otp'] = $otp;

            // Send OTP via email
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'cijogeorge2002@gmail.com';
                $mail->Password = 'ktqs ahqs ueyz bpsa';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('cijogeorge2002@gmail.com', 'Janata');
                $mail->addAddress($email, 'Recipient Name');

                $mail->Subject = 'OTP Verification';
                $mail->Body = 'Your OTP for verification is: ' . $otp;

                $mail->send();
                echo 'OTP has been sent successfully to ' . $email;
            } catch (Exception $e) {
                showError("Mailer Error: {$mail->ErrorInfo}");
            }
        } else {
            showError("Incorrect password");
        }
    } else {
        showError("No such user exists");
    }
}

if(isset($_POST['VerifyOTP'])) {
    // Handle OTP verification functionality
    if($_POST['otp'] == $_SESSION['otp']) {
        header("Location: index.php");
    } else {
        showError("Incorrect OTP. Please try again.");
    }
}
?>



<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Janata</title>

    <!--
        CSS
        ============================================= -->
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <!--================Login Box Area =================-->
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="img/login.jpg" alt="">
                        <div class="hover">
                            <h4>New to our website?</h4>
                            <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                            <a class="primary-btn" href="userrequest.php">Create an Account</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner">
                        <h3>Log in to enter</h3>
                        <form class="row login_form" action="" method="post" id="contactForm">
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="txtUsername" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="name" name="txtPassword" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                            </div>
                            
                            <div class="col-md-12 form-group">
                                <button type="submit" name="SendOTP" value="submit" class="primary-btn">Send OTP</button>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter OTP'">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" name="VerifyOTP" value="submit" class="primary-btn">Verify OTP</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Login Box Area =================-->

    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="js/gmaps.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
