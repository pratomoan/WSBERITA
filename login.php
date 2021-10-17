<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

    header("location: admin.php");
    exit;
}

// Include config file
require_once "include/dbconnection.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["nip"]))) {
        $username_err = "Please enter NIP.";
    } else {
        $username = trim($_POST["nip"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT nip, password, nama FROM admin WHERE nip = ?";

        if ($stmt = $dbh->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            // Set parameters
            //$param_username = $username;
            // Attempt to execute the prepared statement
            if ($stmt->execute([$username])) {
                // Store result
                $row = $stmt->fetch();
                $hashed_password = $row['password'];
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, so start a new session
                    session_start();

                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["nip"] = $nip;
                    $_SESSION["password"] = $password;
                    $_SESSION["name"] = $row['nama'];

                    // Redirect user to welcome page
                    header("location: admin.php");
                } else {
                    // Password is not valid, display a generic error message
                    $login_err = "Invalid username or password.";
                }
                // Check if username exists, if yes then verify password   
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>QNA - Admin Login</title>
        <?php include_once('include/head.php'); ?>
        <style>
            body{ font: 14px sans-serif; }
            .wrapper{ width: 350px; padding: 20px; }
        </style>
        <link rel="stylesheet" href="assets/custom.css">
    </head>
    <body>
        <?php include_once('include/navbar.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">

                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="wrapper">
                        <div class="col-md-13">
                            <h2>Login</h2>
                            <p>Masukan data untuk masuk.</p>

                            <?php
                            if (!empty($login_err)) {
                                echo '<div class="alert alert-danger">' . $login_err . '</div>';
                            }
                            ?>

                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <div class="form-group">
                                    <label>NIP</label>
                                    <input type="text" name="nip" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                                </div>    
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Login">

                                </div>
                                


                            </form>
                            <input type="submit" id="daftar" class="btn btn-primary" value="Daftar">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">

                    </div>
                </div>
            </div>

        </div>
        <script type="text/javascript">
            document.getElementById("daftar").onclick = function () {
                location.href = "./registeradmin.php";
            };
        </script>
    </body>
</html>