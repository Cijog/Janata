<?php
session_start();
if (isset($_SESSION['store'])) {
    // User is logged in, continue with the code
} else {
    header("Location: login.php");
    exit();
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
                    <?php $store = $_SESSION['store']; 
                    
                    // Start or resume the session
                    
                    // Assuming you have the store_name in the session as 'store'
                    if (isset($_SESSION['store'])) {
                        $store_name = $_SESSION['store'];
                    
                        // Connect to the database (replace with your database connection code)
                        $conn = new mysqli("localhost", "root", "", "janata");
                    
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                    
                        // Fetch store_id from tblusers based on the store_name
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
                            echo "Error fetching store_id from tblusers: " . $stmt_store_id->error;
                        }
                    
                        // Close the prepared statement for store_id
                        $stmt_store_id->close();
                    
                        // Close the database connection
                        $conn->close();
                    } else {
                        echo "Error: 'store' not found in the session.";
                    }
                    ?>
                
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: <?php echo $store ?></div>
                        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
            <?php if(isset($_SESSION['msg']))
				   		echo ($_SESSION['msg']);
						unset ($_SESSION['msg']);
						?>
                        
                        <main>
                
                                    <div class="container-fluid px-4">
                                        <h1 class="mt-4">Dashboard</h1>
                                        <ol class="breadcrumb mb-4">
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                        <div class="row">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <i class="fas fa-table me-1"></i>
                                                Orders
                                            </div>
                                            <form method="post">
                                            <div class="mb-3">
                                                <label for="card_type" class="form-label">Card Type</label>
                                                <select class="form-select" id="card_type" name="card_type">
                                                    <option value="">Select Card Type</option>
                                                    <option value="Pink Card">Pink Card</option>
                                                    <option value="Yellow Card">Yellow Card</option>
                                                    <option value="Blue Card">Blue Card</option>
                                                </select>
                                            </div>
                                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                            </form>
                                            <div class="card-body">
                                                <table id="datatablesSimple">
                                                    <thead>
                                                        <tr>
                                                            <th>Order ID</th>
                                                            <th>Username</th>
                                                            <th>Partner</th>
                                                            <th>Address</th>
                                                            <th>Phone</th>
                                                            <th>Products</th>
                                                            <th>Date</th>
                                                            <th>Total</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                    $conn = new mysqli("localhost", "root", "", "janata");

                    $sql = "SELECT orders.*, partner.phone AS partner_phone FROM orders
                        LEFT JOIN partner ON orders.partner = partner.name";
                    
                    if (isset($_POST['card_type']) && !empty($_POST['card_type'])) {
                        $card_type = $conn->real_escape_string($_POST['card_type']);
                        $sql .= " WHERE orders.card_type LIKE '%$card_type%'";
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['oid'];
                        $name = $row['username'];
                        $partner = $row['partner'];
                        $products = $row['products'];
                        $date = $row['date'];
                        $total = $row['total'];
                        $status = $row['status'];
                        $partner_phone = $row['partner_phone'];

                        if ($status == 1) {
                            $status = "Completed";
                            $class = "badge badge-success";
                        } elseif ($status == 2) {
                            $status = "Active";
                            $class = "badge badge-danger";
                        } else {
                            $status = "Pending";
                            $class = "badge badge-danger";
                        }

                        $sql_user = "SELECT * from tblusers where uname='$name';";
                        $result_user = $conn->query($sql_user);
                        if ($result_user->num_rows > 0) {
                            $row_user = $result_user->fetch_assoc();
                            $uname = $row_user['uname'];
                            $address = $row_user['address'];
                            // Update the phone variable to use partner's phone number
                            $phone = $partner_phone;
                            ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $partner; ?></td>
                                <td><?php echo $address; ?></td>
                                <td><?php echo $phone; ?></td>
                                <td><?php echo $products; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $status; ?></td>
                            </tr>
                    <?php }
                    }
                    }
                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            
                
            </main>

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
