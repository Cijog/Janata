<?php
session_start();
if (isset($_SESSION['partner'])) {
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
        <title>Dashboard - Deivery Partner</title>
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
                            <a class="nav-link" href="help.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                                Help
                            </a>
                            <a class="nav-link" href="contact_store.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                                Contact Store
                            </a>   
                        </div>
                    </div>
                    <?php $user = $_SESSION['partner']; ?>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: <?php echo $user ?></div>
                        
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
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>User</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Products</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Orders</th>
                                            <th>Progress</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
						$conn = new mysqli("localhost","root","","janata");

                                        $sql = "SELECT * FROM orders";
                                        $result= $conn->query($sql);
                                        if($result->num_rows>0)
                                        { 

                                            while($row=$result->fetch_assoc())
                                            {	
                                                
                                                $id=$row['oid'];
                                                $name=$row['username'];
                                                $products = $row['products'];
                                                $date = $row['date'];
                                                $total=$row['total'];
                                                $status=$row['status'];
                                                if($status==1)
                                                {
                                                    $status="Completed";
                                                    $class="badge badge-success";
                                                }
                                                elseif($status==2) 
                                                {
                                                    $status="Active";
                                                    $class="badge badge-danger";
                                                }		
                                                else
                                                {
                                                    $status="Pending";
                                                    $class="badge badge-danger";
                                                }					
        
                                                $sql_user = "SELECT * from tblusers where uname='$name';";
                                            $result_user=$conn->query($sql_user);
                                            if($result_user->num_rows>0)
                                        { 
                                            $row_user = $result_user->fetch_assoc();
                                            $uname = $row_user['uname'];
                                            $address = $row_user['address'];
                                            $phone = $row_user['phone'];
                                            ?>
                                    <?php if($row['status']==0 || $row['status']==2 )
                                                { ?>
                                        <tr>
                                            <td><?php echo $id;?></td>
                                            <td><?php echo $name;?></td>
                                            <td><?php echo $address;?></td>
                                            <td><?php echo $phone;?></td>
                                            <td><?php echo $products;?></td>
                                            <td><?php echo $date;?></td>
                                            <td><?php echo $total;?></td>
                                            <td><img src="img/accept1.png" height="50" width="50" onClick="location.href='accept.php?aid=<?php echo $id;?>';"></td>
							                <td><img src="img/completed1.png" height="50" width="50" onClick="location.href='complete.php?cid=<?php echo $id;?> ';"></td>
                                            <td><?php echo $status;?></td>
                                        </tr>
                                        <?php }}}} ?>
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
