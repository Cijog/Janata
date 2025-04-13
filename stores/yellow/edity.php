<?php
 global $Root;
 $Root= $_SERVER['DOCUMENT_ROOT'];
 session_start();
 if (isset($_SESSION['store'])) {
     // User is logged in, continue with the code
 } else {
     header("Location: login.php");
     exit();
 }

if(isset($_GET['eid']))
{
    $id = $_GET['eid'];
}
    $conn = new mysqli("localhost","root","","janata");
    $sql = "select * from products where id = '$id'"; 
    if ($conn->connect_error) 
    {							
      die("Connection failed: " .$conn->connect_error);
    }

    $result = $conn->query($sql);
    if($result->num_rows>0)
    {
      $row = $result->fetch_assoc();
     
      $oldProductName= $row['products'];
     
      $oldQuantity = $row['quantity'];
      $oldPrice = $row['price'];
	    $oldImage = $row['image'];
      $oldProductStatus = $row['status'];
      $oldPath="$Root/img/$oldImage";
    }

    if(isset($_POST['submit']))
    {   
      $productName = $_POST['productName'];
      
      $quantity = $_POST['Quantity'];
      $status = $_POST['Status'];
      $price = $_POST['Price'];

      if(!empty ($_FILES['file']['name'] ))
      {
     
        
        $fileName = $_FILES['file']['name'];
        $targetPath = $Root."img/";
        $jmgFile = $_FILES['file']['tmp_name'];
        $file = $targetPath.$fileName;
        if(unlink($oldPath))
        {
          if(move_uploaded_file($jmgFile,$file))
          {
            $sql = "update products set catid = '2',products = '$productName',quantity ='$quantity', price ='$price', image = '$fileName',status = '$status',  where id = '$id'";
            $result = $conn->query($sql);
          }
        }
     
      }
      else
      {  
 
        $sql = "update products set catid='2',products = '$productName', quantity ='$quantity', price ='$price',status = '$status' where id = '$id'";
        $result = $conn->query($sql);
  
      }

        if($result)
        {
          $_SESSION['msg'] = "Record Edited Successfully";
           
          header("Location: viewy.php");
        }
    }

?>
<!DOCTYPE html>
<style>
.button_add
{
	color:#FFFFFF; 
	background-color:#66FF99; 
	border:0;
	border-radius: 4px;
}
.button_add:hover
{
	color: #66FF99;
	background:#FFFFFF;
	transition: 0.5s;
}
</style>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB stores</title>
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
                                            <a class="nav-link" href="../blue/viewb.php">View Products</a>
                                            <a class="nav-link" href="../blue/addb.php">Add Products</a>                                            
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
                                            <a class="nav-link" href="viewy.php">View Products</a>
                                            <a class="nav-link" href="addy.php">Add Products</a>                 
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
    <!-- BODY STARTS -->
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title" align="center">Edit Product</h4>
          <form name="myform" id="myform" method="post" action="" enctype="multipart/form-data">
            
            
            <div class="form-group">
              <label for="exampleInputName1">Product name</label>
              <input type="text" class="form-control" name="productName" id="productName" placeholder="Product Name" value="<?php echo $oldProductName; ?>" />
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Quantity</label>
              <input type="text" class="form-control" name="Quantity" id="quantity" placeholder="quantity" value="<?php echo $oldQuantity; ?>" />
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Price</label>
              <input type="text" class="form-control" name="Price" id="price" placeholder="Price" value="<?php echo $oldPrice; ?>" />
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Current Image</label>
              <img src="/janatac/stores/yellow/img/" width="50" height="50" />
            </div>
            <div class="form-group">
              <label for="exampleInputName1">Select Image File to Upload:</label>
              <input type="file" name="file" id="file" />
            </div>
            <div class="form-group">
              <label>Status</label>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="Status" id="status" value="1"  />Active</label>
              </div>
              <div class="form-check">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="Status" id="status" value="0"  />Inactive</label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
            <button class="btn btn-light">Cancel</button>
          </form>
        </div>
      </div>
    </div>
    <!-- BODY ENDS -->
  </div>
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
