<?php
session_start(); // Start or resume the session
$user = $_SESSION['user'];
$conn = new mysqli("localhost", "root", "", "janata");

// Function to get store_id from tblusers
function getStoreId($conn, $user) {
    $storeQuery = "SELECT store_id FROM tblusers WHERE uname = ?";
    $stmt = $conn->prepare($storeQuery);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row['store_id'];
}


// Function to check if any product with a similar name is bought in the same month
function isProductBoughtInSameMonth($conn, $user, $product_name) {
    $query = "SELECT date FROM orders WHERE username = ? AND products LIKE ? AND MONTH(date) = MONTH(CURRENT_DATE())";
    $stmt = $conn->prepare($query);
    $product_name_like = "%$product_name%"; // Add wildcards to search for similar names
    $stmt->bind_param("ss", $user, $product_name_like);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastPurchaseDate = strtotime($row['date']);

        // Calculate the current date and time
        $currentDate = strtotime("now");

        // Calculate the difference in seconds between the current date and the last purchase date
        $timeDiff = $currentDate - $lastPurchaseDate;

        // Define the minimum allowed time difference for one month (about 30 days)
        $oneMonthInSeconds = 30 * 24 * 60 * 60;

        if ($timeDiff < $oneMonthInSeconds) {
            // A similar product is bought in the same month
            return true;
        }
    }

    return false;
}


// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get product details from the form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];

    // Debugging: Print the received values
    echo "Debugging: Received values - product_id: $product_id, product_name: $product_name, product_price: $product_price, product_quantity: $product_quantity<br>";

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

    // Debugging: Print the cart item array
    echo "Debugging: Cart item array - ";
    print_r($cart_item);
    echo "<br>";

    // Get store_id from tblusers
    $store_id = getStoreId($conn, $user);

    // Debugging: Print the store_id
    echo "Debugging: Store ID - $store_id<br>";

    // Check if the product is bought in the same month
    if (isProductBoughtInSameMonth($conn, $user, $product_name)) {
        echo "Error: This product cannot be purchased again in the same month.";
        // You can redirect or display an error message as needed
    } else {
        // Fetch current quantity from the 'inventory' table
        $inventory_query = "SELECT quantity FROM inventory WHERE store_id = ? AND item_name = ?";
        $stmt_inventory = $conn->prepare($inventory_query);
        $stmt_inventory->bind_param("is", $store_id, $product_name);
        $stmt_inventory->execute();
        $result_inventory = $stmt_inventory->get_result();

        if ($result_inventory && $result_inventory->num_rows > 0) {
            $row = $result_inventory->fetch_assoc();
            $current_quantity = $row['quantity'];

            // Debugging: Print the current quantity
            echo "Debugging: Current quantity - $current_quantity<br>";

            // Check if there is enough quantity in the inventory
            if ($current_quantity < $product_quantity) {
                echo "Error: Not enough quantity in the inventory.";
                // You can redirect or display an error message as needed
            } else {
                // Proceed with the shopping process
                // Update the inventory quantity
                $sql_update_inventory = "UPDATE inventory SET quantity = quantity - ? WHERE store_id = ? AND item_name = ?";
                $stmt_update_inventory = $conn->prepare($sql_update_inventory);
                $stmt_update_inventory->bind_param("iis", $product_quantity, $store_id, $product_name);
                if ($stmt_update_inventory->execute()) {
                    // The inventory has been updated successfully
                } else {
                    echo "Error updating inventory: " . $stmt_update_inventory->error;
                }
                $stmt_update_inventory->close();

                // Add the product to the cart or update its quantity if it already exists
                if (isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id]['quantity']++;
                } else {
                    $_SESSION['cart'][$product_id] = $cart_item;
                }

                // Insert the product into the 'cart' table in the database
                $user_name = $_SESSION['user']; // Assuming you have a user ID in the session
                $sql = "INSERT INTO cart (user_name, product_id, product_name, product_price, quantity)
                VALUES (?, ?, ?, ?, ?)"; // You can use prepared statements for better security

                $stmt_insert_cart = $conn->prepare($sql);
                $stmt_insert_cart->bind_param("sissi", $user_name, $product_id, $product_name, $product_price, $product_quantity);

                if ($stmt_insert_cart->execute()) {
                    // Redirect back to the product page or wherever you want
                    header('Location: index.php'); // Change this to the appropriate page
                    exit;
                } else {
                    echo "Error inserting into cart: " . $stmt_insert_cart->error;
                }
                $stmt_insert_cart->close();
            }
        } else {
            echo "Error fetching inventory information: " . $stmt_inventory->error;
        }
        $stmt_inventory->close();
    }
}
?>
