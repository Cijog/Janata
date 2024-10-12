<?php
session_start(); // Start or resume the session

if (isset($_SESSION['user']) && isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    // Get the user ID from the session
    $user_id = $_SESSION['user'];

    // Connect to the database (replace with your database connection code)
    $conn = new mysqli("localhost", "root", "", "janata");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch store_id from tblusers based on the username
    $store_id_query = "SELECT store_id FROM tblusers WHERE uname = ?";
    $stmt_store_id = $conn->prepare($store_id_query);
    $stmt_store_id->bind_param("s", $user_id);
    $stmt_store_id->execute();
    $result_store_id = $stmt_store_id->get_result();

    if ($result_store_id && $result_store_id->num_rows > 0) {
        $row = $result_store_id->fetch_assoc();
        $store_id = $row['store_id'];

        // Get the current date and time for the order date
        $order_date = date("Y-m-d H:i:s");

        // Initialize the total price
        $totalPrice = 0;

        // Prepare an array to hold product details
        $products = [];
        $quantities = [];

        foreach ($_SESSION['cart'] as $product) {
            $product_name = $product['product_name'];
            $product_quantity = $product['quantity'];
            $product_price = $product['product_price'];

            // Add the product price to the total price
            $totalPrice += $product_price;

            // Add product details to the arrays
            $products[] = ['product_name' => $product_name];
            $quantities[] = ['quantity' => $product_quantity];
        }

        // Convert the $products and $quantities arrays to JSON strings
        $products_json = json_encode($products);
        $quantities_json = json_encode($quantities);

        // Prepare the SQL statement with store_id
       // Prepare the SQL statement with store_id and include the current date directly
        $sql = "INSERT INTO orders (store_id, username, products, quantity, date, total) VALUES (?, ?, ?, ?, NOW(), ?)";

        // Create a prepared statement
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters and execute the statement
            $stmt->bind_param("ssssd", $store_id, $user_id, $products_json, $quantities_json, $totalPrice);


            if ($stmt->execute()) {
                // Get the order ID of the inserted row
                $order_id = $conn->insert_id;

                // Redirect to the confirmation page with order details
                header("Location: confirmation.php?order_id=$order_id&order_date=$order_date&total=$totalPrice");

                // Clear the cart as the order is now confirmed
                $_SESSION['cart'] = [];
            } else {
                echo "Error placing order: " . $stmt->error;
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Error fetching store_id from tblusers: " . $stmt_store_id->error;
    }

    // Close the prepared statement for store_id
    $stmt_store_id->close();

    // Close the database connection
    $conn->close();
} else {
    echo "No products in the cart, user not logged in, or store information missing.";
}
?>
