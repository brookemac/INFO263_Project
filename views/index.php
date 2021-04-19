<?php
require_once "../models/User.php";
require_once "../views/partials/redirect_to_login_check.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container h-100">
        <h1 class="my-5">Hi, <b><?php echo htmlspecialchars(($_SESSION["loggedUser"])->getUsername()); ?></b>. Welcome to our site.</h1>
        <div class="d-flex justify-content-center h-100">

            <p>
                <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
            </p>
        </div>
    </div>
</body>
</html>