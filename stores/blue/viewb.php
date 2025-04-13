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
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="../index.php">Janata</a>
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
                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
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
                            <a class="nav-link" href="../index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="../deliverypartner.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Delivery Partner
                            </a>
                            <a class="nav-link" href="../stock.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                                Stock
                            </a>
                            <a class="nav-link" href="../report.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Report
                            </a>
                            <a class="nav-link" href="../help.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Help
                            </a>
                            <a class="nav-link" href="../message.php">
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
                                            <a class="nav-link" href="viewb.php">View Products</a>
                                            <a class="nav-link" href="addb.php">Add Products</a>                                            
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Pink Card
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="../pink/viewp.php">View Products</a>
                                            <a class="nav-link" href="../pink/addp.php">Add Products</a>                                           
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Yellow Card
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="../yellow/viewy.php">View Products</a>
                                            <a class="nav-link" href="../yellow/addy.php">Add Products</a>                 
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Suplyco Products
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="../mview.php">View Products</a>
                                            <a class="nav-link" href="../madd.php">Add Products</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Categories
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="../cview.php">View Categories</a>
                                            <a class="nav-link" href="../cadd.php">Add Categories</a>
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
    </div>
        <div class="main-panel">
            <div class="content-wrapper pb-0">
             
                 <!--BODY STARTS-->
                 <div align="right"><input type="button" class="button" value="Add" name="add" onClick="location.href='new.php';"/></div>
                 <br>
                 <div class="row">
                     
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                      
                        <h4 class="card-title" align="center">Products</h4>
                        
                   
                       <div class="table-responsive">
                       <div align="center" style="color: green">
                       <?php
                            if(isset($_SESSION['msg']))
                                echo ($_SESSION['msg']);
                            unset ($_SESSION['msg']);
                        ?>
                        </div>
                          <table class="table">
                            <thead>
                              <tr>
                           
                                <th>Id</th>
                                <th>Category Name</th>
                                <th>Product name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conn = new mysqli("localhost","root","","janata");

                            $sql = "SELECT * FROM products where catid=3";
                            $result= $conn->query($sql);
                            if($result->num_rows>0)
                            { 
                                while($row=$result->fetch_assoc())
                                {   
                                    $id=$row['id'];
                                    $cid=$row['catid'];
                                    $pdname = $row['products'];
                                    $quantity = $row['quantity'];
                                    $price=$row['price'];
                                    $image=$row['image'];
                                    $stat=$row['status']; 
                                    
                                    $sql_catname = "SELECT * from tblcategories where id='$cid';";
                                    $result_catname=$conn->query($sql_catname);
                                    if($result_catname->num_rows>0)
                                   { 
                                        $row_catname = $result_catname->fetch_assoc();
                                        $cname = $row_catname['ctgname'];
                                        
                                        if($stat==1)
                                        {
                                            $stat="Active";
                                            $class="badge bg-success";
                                        }
                                        else 
                                        {
                                            $stat="Inactive";
                                            $class="badge bg-danger";
                                        }                   
                            ?>
                              <tr>
                                <td><?php echo $id;?></td>
                                <td><?php echo $cname;?></td>
                                <td><?php echo $pdname;?></td>
                                <td><?php echo $quantity;?></td>
                                <td><?php echo $price;?></td>
                                <td><img src="/janatac/stores/blue/img/<?php echo $image; ?>" height="25" width="25"></td>
                                
                                
                                <td>                        
                                   <label class="<?php echo $class; ?>"><?php echo $stat;?></label>
                                   
                                </td>
                                <td><img src="img/edit.png" height="25" width="25" onClick="location.href='editb.php?eid=<?php echo $id;?>';"></td>
                                <td><img src="img/delete.png" height="25" width="25" onClick="location.href='deleteb.php?id=<?php echo $id;?> ';"></td>
                              </tr>
                              
                              
                              <?php }}}?>
                            </tbody>
                            
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                 </div>
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
