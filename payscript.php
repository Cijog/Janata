<?php
session_start(); // Start or resume the session
if (isset($_SESSION['user'])) {
    // User is logged in, continue with the code
} else {
    header("Location: login.php");
    exit();
}
if(isset($_GET['order_id']) && isset($_GET['order_date']) && isset($_GET['total'])) {
    // Retrieve the values from the URL
    $order_id = $_GET['order_id'];
    $order_date = $_GET['order_date'];
    $totalPrice = $_GET['total'];
} else {
    // Redirect the user to an error page or handle the case where parameters are not set
    header("Location: error.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm to Pay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="pay.css">
</head>

<body>
    <div class="container">
        <div class="parent_main">
            <h2 class="h3 text-center">Click the Pay button for payment!</h2>
            <div>
                <button class="btn btn-success" id="rzp-button1">Pay with Razorpay</button>
            </div>
        </div>
    </div>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "rzp_test_MqahbqAezSfStY", // Enter the Key ID generated from the Dashboard
            "amount": "<?php echo $totalPrice * 100; ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            "currency": "INR",
           
            "description": "Payment for waste collection ?>",
            "image": "https://example.com/your_logo",
            //"order_id": " //echo(rand(10,100));", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            "callback_url":" ./confirmation.php",
            "prefill": {
                "order id": "<?php echo $oid; ?>",
                
            },
            "theme": {
                "color": "#3399cc"
            }
        };
        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button1').onclick = function(e) {
            rzp1.open();
            e.preventDefault();
        }
    </script>

    <script>
        window.onload = function() {
            document.getElementById('rzp-button1').click();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>