<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Add User - Janata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <div class="container">
        <h1 class="mt-4">Add User</h1>
        <form method="POST" action="" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="cname" class="form-label">Customer Name:</label>
                <input type="text" class="form-control" id="cname" name="cname" required />
            </div>
            <div class="mb-3">
                <label for="store_id" class="form-label">Store ID:</label>
                <input type="text" class="form-control" id="store_id" name="store_id" required />
            </div>
            <div class="mb-3">
                <label for="uname" class="form-label">Username:</label>
                <input type="text" class="form-control" id="uname" name="uname" required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required />
                <small id="passwordHelp" class="form-text text-muted">Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.</small>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea class="form-control" id="address" name="address" required></textarea>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" required pattern="\d{10}" title="Phone number must be 10 digits long." />
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required />
            </div>
            <div class="mb-3">
                <label for="postcode" class="form-label">Postcode:</label>
                <input type="text" class="form-control" id="postcode" name="postcode" required />
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>

    <script>
        function validateForm() {
            // Validate password
            var password = document.getElementById('password').value;
            var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordRegex.test(password)) {
                alert("Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.");
                return false;
            }

            // Validate phone number
            var phone = document.getElementById('phone').value;
            var phoneRegex = /^\d{10}$/;
            if (!phoneRegex.test(phone)) {
                alert("Phone number must be 10 digits long.");
                return false;
            }

            // Validate email
            var email = document.getElementById('email').value;
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // You can add more validation as needed

            return true;
        }
    </script>
</body>
</html>
