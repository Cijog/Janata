<?php
session_start();

// Redirect to login if store session is not set
if (!isset($_SESSION['store'])) {
    header("Location: login.php");
    exit();
}

// Fetch and store store_id using the store_name in the session
if (isset($_SESSION['store'])) {
    $store_name = $_SESSION['store'];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "janata");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch store_id from stores based on the store_name
    $store_id_query = "SELECT store_id FROM stores WHERE store_name = ?";
    $stmt_store_id = $conn->prepare($store_id_query);
    $stmt_store_id->bind_param("s", $store_name);
    $stmt_store_id->execute();
    $result_store_id = $stmt_store_id->get_result();

    if ($result_store_id && $result_store_id->num_rows > 0) {
        $row = $result_store_id->fetch_assoc();
        $store_id = $row['store_id'];

        // Store store_id in the session
        $_SESSION['store_id'] = $store_id;

        // Now, $_SESSION['store_id'] contains the store_id for future use
    } else {
        echo "Error fetching store_id from stores: " . $stmt_store_id->error;
    }

    // Close the prepared statement for store_id
    $stmt_store_id->close();

    // Close the database connection
    $conn->close();
} else {
    echo "Error: 'store' not found in the session.";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Store</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Janata</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="deliverypartner.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Delivery Partner
                            </a>
                            <a class="nav-link" href="stock.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                                Stock
                            </a>
                            <a class="nav-link" href="report.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Report
                            </a>
                            <a class="nav-link" href="help.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Help
                            </a>
                            <a class="nav-link" href="message.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                                Messages
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            
                           
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Blue Card
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="blue/viewb.php">View Products</a>
                                            <a class="nav-link" href="blue/addb.php">Add Products</a>                                            
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Pink Card
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="pink/viewp.php">View Products</a>
                                            <a class="nav-link" href="pink/addp.php">Add Products</a>                                           
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Yellow Card
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="yellow/viewy.php">View Products</a>
                                            <a class="nav-link" href="yellow/addy.php">Add Products</a>                 
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Suplyco Products
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="mview.php">View Products</a>
                                            <a class="nav-link" href="madd.php">Add Products</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Categories
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="cview.php">View Categories</a>
                                            <a class="nav-link" href="cadd.php">Add Categories</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                           
                        </div>
                    </div>  
                    <?php $store = $_SESSION['store']; ?>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: <?php echo $store ?></div>
                        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
    <?php
    if (isset($_SESSION['msg']))
        echo ($_SESSION['msg']);
    unset($_SESSION['msg']);
?>


    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Report</h1>
            <form method="post">
    <div class="row mb-3">
        <div class="col">
            <label for="start_date" class="form-label">Start Date:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo isset($_POST['start_date']) ? htmlspecialchars(date('Y-m-d', strtotime($_POST['start_date']))) : ''; ?>">
        </div>
        <div class="col">
            <label for="end_date" class="form-label">End Date:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="<?php //echo isset($_POST['end_date']) ? htmlspecialchars(date('Y-m-d', strtotime($_POST['end_date']))) : ''; ?>">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Apply Date Range</button>
</form>


            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Consumption Report</li>
            </ol>

            <div class="row">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Orders
                    </div>
                    <div class="card-body">
                    <?php
$conn = new mysqli("localhost", "root", "", "janata");

$whereClause = "WHERE store_id=$store_id"; // Initialize the WHERE clause with store_id

// Check if start_date and end_date are set in the form submission

    // Get the start_date and end_date from the form
    if(isset($_POST['start_date'])){
        $start_date = $conn->real_escape_string($_POST['start_date']);
        if($_POST['end_date']){
            $end_date = $conn->real_escape_string($_POST['end_date']);
            $whereClause .= " AND DATE_FORMAT(date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date'";
        }
        else{
             $whereClause.=" AND DATE_FORMAT(date, '%Y-%m-%d') = '$start_date'";
        }
    }
$sql = "SELECT * FROM orders $whereClause";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Initialize an associative array to store quantities for each product
    $productQuantities = [];

    while ($row = $result->fetch_assoc()) {
        $products = json_decode($row['products'], true);
        $quantities = json_decode($row['quantity'], true);

        // Loop through each product in the order
        for ($i = 0; $i < count($products); $i++) {
            $product_name = $conn->real_escape_string($products[$i]['product_name']);
            $quantity = $quantities[$i]['quantity'];

            // Add the quantity to the existing quantity for the product
            $productQuantities[$product_name] = isset($productQuantities[$product_name]) ? $productQuantities[$product_name] + $quantity : $quantity;
        }
    }

    // Display the aggregated quantities
    ?>
    <table id="datatablesSimple" class="table">
        <thead>
            <tr>
                <th>Products</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($productQuantities as $product_name => $totalConsumption) {
                ?>
                <tr>
                    <td><?php echo $product_name; ?></td>
                    <td><?php echo $totalConsumption; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
} else {
    echo "No orders found for the specified date range.";
}
?>
</div>
</div>
</div>
        </div>

<!-- Add this part to display total orders and total revenue -->
<?php
$sql_count = "SELECT COUNT(*) AS total_orders, SUM(total) AS total_revenue FROM orders WHERE store_id=$store_id ;";
$result_count = $conn->query($sql_count);

if ($result_count && $result_count->num_rows > 0) {
    $row_count = $result_count->fetch_assoc();
    $total_orders = $row_count['total_orders'];
    $total_revenue = $row_count['total_revenue'];
} else {
    $total_orders = 0;
    $total_revenue = 0;
}
?>
<table id="datatablesSimple" class="table">
    <thead>
        <tr>
            <th>Total Orders:</th>
            <th><?php echo $total_orders; ?></th>
        </tr>
        <tr>
            <th>Total Revenue:</th>
            <th>$<?php echo $total_revenue; ?></th>
        </tr>
    </thead>
</table>
</div>
</main>
</div>



                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>