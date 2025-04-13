<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $uid = $_POST['uid'];
    $cname = $_POST['cname'];
    $store_id = $_POST['store_id'];
    $uname = $_POST['uname'];
    $password =$_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $postcode = $_POST['postcode'];
    $email = $_POST['email'];

    $conn = new mysqli("localhost", "root", "", "janata");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO userreq (uid, cname, store_id, uname, password, address, phone, postcode, email)
            VALUES ('$uid', '$cname', '$store_id', '$uname', '$password', '$address', '$phone', '$postcode', '$email')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['msg'] = "User request added successfully!";
        echo "<script>
                alert('User request added successfully. Verification updates will be sent through your mail within 24hrs!!');
                window.location.href='login.php';
              </script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    
    
        $_SESSION['msg'] = "Error adding user request: " . $conn->error;
    }

    $conn->close();
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
    <title>Karma Shop</title>

    <!-- CSS -->
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

    <!-- Header Area -->
    <!-- Your header code goes here -->

    <!-- Banner Area -->
    <!-- Your banner code goes here -->

    <!-- Checkout Area -->
    <style>
    /* Custom CSS to make form text brighter */
    .form-control {
        color:black /* Adjust the color as needed */
    }
</style>

<section class="checkout_area section_gap">
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Create User Request</h3>
                    <form class="row contact_form" action="" method="post" onsubmit="return validateForm()">
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="uid" name="uid" placeholder="User ID">
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <label for="cname">Card Type</label>
                            <select class="form-control" id="cname" name="cname">
                                <option value="Pink Card">Pink Card</option>
                                <option value="Blue Card">Blue Card</option>
                                <option value="Yellow Card">Yellow Card</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <label for="store_id">Store ID</label>
                            <select class="form-control" id="store_id" name="store_id">
                                <?php
                                // Establish connection to the database
                                $conn = new mysqli("localhost", "root", "", "janata");

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // SQL query to fetch store addresses and IDs
                                $sql = "SELECT store_id, store_address FROM stores";

                                // Execute the query
                                $result = $conn->query($sql);

                                // Check if there are rows returned
                                if ($result->num_rows > 0) {
                                    // Loop through each row and display as options in the select element
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['store_id'] . "'>" . $row['store_address'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No stores found</option>";
                                }

                                // Close the database connection
                                $conn->close();
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" class="form-control" id="uname" name="uname" placeholder="Username">
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode">
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" name="submit" class="primary-btn">Create User Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function validateForm() {
        var uid = document.getElementById("uid").value;
        var cname = document.getElementById("cname").value;
        var store_id = document.getElementById("store_id").value;
        var uname = document.getElementById("uname").value;
        var password = document.getElementById("password").value;
        var address = document.getElementById("address").value;
        var phone = document.getElementById("phone").value;
        var postcode = document.getElementById("postcode").value;
        var email = document.getElementById("email").value;

        // Regular expression for email validation
        var emailRegex = /^\S+@\S+\.\S+$/;

        // Regular expression for phone number validation
        var phoneRegex = /^\d{10}$/;

        if (uid == "" || cname == "" || store_id == "" || uname == "" || password == "" || address == "" || phone == "" || postcode == "" || email == "") {
            alert("All fields must be filled out");
            return false;
        }
        if (!emailRegex.test(email)) {
            alert("Please enter a valid email address");
            return false;
        }
        if (!phoneRegex.test(phone)) {
            alert("Please enter a valid 10-digit phone number");
            return false;
        }
        return true;
    }
</script>


    <!-- End Checkout Area -->

    <!-- Footer Area -->
    <!-- Your footer code goes here -->

    <!-- Scripts -->
    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="js/gmaps.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
