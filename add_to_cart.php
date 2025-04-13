<?php
session_start(); // Start or resume the session
$conn = new mysqli("localhost", "root", "", "janata");

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get product details from the form
    echo $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];

    // Check if the cart session variable exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Create a cart item array
    $cart_item = [
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'quantity' => $product_quantity, // You can set the initial quantity to 1 or any other value
    ];

    // Add the product to the cart or update its quantity if it already exists
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        $_SESSION['cart'][$product_id] = $cart_item;
    }

    // Insert the product into the 'cart' table in the database
    $user_name = $_SESSION['user']; // Assuming you have a user ID in the session
    $sql = "INSERT INTO cart (user_name, product_id, product_name, product_price, quantity)
            VALUES ('$user_name', '$product_id', '$product_name', '$product_price','$product_quantity ')"; // You can use prepared statements for better security
    
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the product page or wherever you want
        header('Location: category.php'); // Change this to the appropriate page
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
