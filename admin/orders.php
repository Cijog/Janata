<?php
session_start();
if (isset($_SESSION['admin'])) {
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
        <title>Dashboard - SB Admin</title>
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
                            <a class="nav-link" href="users.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Users
                            </a>
                            <a class="nav-link" href="stores.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                                Stores
                            </a>
                            <a class="nav-link" href="orders.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Orders
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            
                           
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="addstores.php">Add Stores</a>  
                                <a class="nav-link" href="addusers.php">Add Users</a>
                                <a class="nav-link" href="userreq.php">Users Requests</a>
                                    
                                </nav>
                            </div>
                           
                        </div>
                    </div>
                    <?php $admin = $_SESSION['admin']; ?>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: <?php echo $admin ?></div>
                        
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
                            <!-- Date Range Filter -->
                            <form method="post">
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="start_date" class="form-label">Start Date:</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo isset($_POST['start_date']) ? htmlspecialchars(date('Y-m-d', strtotime($_POST['start_date']))) : ''; ?>">
                                    </div>
                                    <div class="col">
                                        <label for="end_date" class="form-label">End Date:</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo isset($_POST['end_date']) ? htmlspecialchars(date('Y-m-d', strtotime($_POST['end_date']))) : ''; ?>">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Apply Date Range</button>
                            </form>

                            </div>
                            
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Store ID</th>
                                            <th>Store Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Products</th>
                                            <th>Quantity</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
						$conn = new mysqli("localhost","root","","janata");
                        $whereClause = '';
                            // Check if start_date and end_date are set in the form submission
                            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                                // Get the start_date and end_date from the form
                                $start_date = $conn->real_escape_string($_POST['start_date']);
                                $end_date = $conn->real_escape_string($_POST['end_date']);

                                
                                $whereClause = " where DATE_FORMAT(date, '%Y-%m-%d') BETWEEN '$start_date' AND '$end_date'";
                            }

                                        $sql = "SELECT * FROM topup $whereClause";
                                        $result= $conn->query($sql);
                                        if($result->num_rows>0)
                                        { 

                                            while($row=$result->fetch_assoc())
                                            {	
                                                $id=$row['order_id'];
                                                $store_id=$row['store_id'];
                                                $products = $row['products'];
                                                $quantity = $row['quantity'];
                                                $date = $row['date'];
                                                $status=$row['status'];
                                                $badgeClass = "badge bg-danger"; 
                                                if($status==1)
                                                    {
                                                        $status="Completed";
                                                        $badgeClass="badge bg-success";
                                                    }
                                                elseif($status==2) 
                                                    {
                                                        $status="Active";
                                                        $badgeClass="badge bg-warning";
                                                    }		
                                                else
                                                    {
                                                        $status="Pending";
                                                        
                                                    }					
			

                                                $sql_user = "SELECT * from stores where store_id='$store_id';";
                                            $result_user=$conn->query($sql_user);
                                            if($result_user->num_rows>0)
                                        { 
                                            $row_user = $result_user->fetch_assoc();
                                            $store_name = $row_user['store_name'];
                                            $store_address = $row_user['store_address'];
                                            $store_phone = $row_user['store_phone'];
                                            
                                            
                                           ?>
                                    
                                        <tr>
                                            <td><?php echo $id;?></td>
                                            <td><?php echo $store_id;?></td>
                                            <td><?php echo $store_name;?></td>
                                            <td><?php echo $store_address;?></td>
                                            <td><?php echo $store_phone;?></td>
                                            <td><?php echo $products;?></td>
                                            <td><?php echo $quantity;?></td>
                                            <td><?php echo $date;?></td>
                                            <td><span class="<?php echo $badgeClass; ?>"><?php echo $status; ?></span></td>
                                        </tr>
                                        <?php }}} ?>
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
