<?php
session_start();

// Function to display error message in a dialog box
function showError($errorMessage) {
    echo "<script>alert('$errorMessage');</script>";
}

if(isset($_POST['Login'])) {
    $admin = $_POST['txtUsername'];
    $pass = $_POST['txtPassword'];

    $conn = new mysqli("localhost", "root", "", "janata");

    $sql = "SELECT * FROM tbladmin WHERE uname='$admin'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) {
            $dadmin = $row['uname'];
            $dpass = $row['password']; 
        }
        if($pass == $dpass) {
            $_SESSION['admin'] = $admin;
            header("Location: index.php");
        } else {
            showError("Incorrect password");
        } 
    } else {
        showError("No such user exists");
    }
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
        <title>Login - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  name="txtUsername" type="text" placeholder="Username" />
                                                <label for="username">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="txtPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <tr>
             <td height="95">
               <label>
               <input type="submit" name="Login" class="btn-login" id="Login" value="Login" >
             </label></td>
             <td><label>
               <input  type="submit"  name="Forgot?" class="btn-forgot" id="Forgot?" value="Forgot?">
             </label></td>
      </tr>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
    </body>
</html>
