<?php
require_once "../Repository/UserRepository.php";
require_once "../database/database_client.php";

$name = $username = $email = $password = $confirmPassword = "";
$nameError = $usernameError = $emailError = $passError = $confirmPassError = $generalError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    if (empty(trim($_POST["name"]))) {
        $nameError = "Please enter Full name.";
    }
    $email = trim($_POST["email"]);
    if (empty(trim($_POST["email"]))) {
        $emailError = "Please enter email.";
    }
    $userRepository = new UserRepository($mysqli);
    $username = trim($_POST["username"]);
    if (empty(trim($_POST["username"]))) {
        $usernameError = "Please enter a username.";
    } elseif ($userRepository->doesUserExistByUsername($_POST["username"])) {
        $generalError = "This username already exists.";
    }

    $password = trim($_POST["password"]);
    if (empty(trim($_POST["password"]))) {
        $passError = "Please provide a password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $passError = "Password must have at least 8 characters.";
    }

    $confirmPassword = trim($_POST["confirmPassword"]);
    if (empty(trim($_POST["confirmPassword"]))) {
        $confirmPassError = "Please confirm password.";
    } else if (empty($passError) && ($password != $confirmPassword)) {
        $confirmPassError = "Password did't match.";
    }

    if (empty($nameError) && empty($emailError) && empty($usernameError) && empty($passError) && empty($confirmPassError) && empty($generalError)) {
        if (!$userRepository->insert($name, $email, $username, $password)) {
            $generalError = "Ops, some error happened. Try again!";
        } else {
            header("location: login.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card user_register_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="../img/uc_logo.jpg" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <article class="card-body mx-auto user_register_card_body">
                    <h4 class="card-title mt-3 text-center">Create Account</h4>
                    <p class="text-center">Get started with your free account</p>
                    <?php
                        if (!empty($generalError)) {
                            echo '<div class="alert alert-danger">' . $generalError . '</div>';
                        }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="name" class="form-control <?php echo (!empty($nameError)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>" placeholder="Full name" type="text">
                            <span class="invalid-feedback"><?php echo $nameError; ?></span>
                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="username" class="form-control <?php echo (!empty($usernameError)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="Username" type="text">
                            <span class="invalid-feedback"><?php echo $usernameError; ?></span>
                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="email" class="form-control <?php echo (!empty($emailError)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="Email" type="email">
                            <span class="invalid-feedback"><?php echo $emailError; ?></span>
                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input class="form-control <?php echo (!empty($passError)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="Create password" type="password" name="password">
                            <span class="invalid-feedback"><?php echo $passError; ?></span>
                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input class="form-control <?php echo (!empty($confirmPassError)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirmPassword; ?>" placeholder="Repeat password" type="password" name="confirmPassword">
                            <span class="invalid-feedback"><?php echo $confirmPassError; ?></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Create Account </button>
                        </div>
                        <p class="text-center">Have an account? <a href="../views/login.php">Log In</a> </p>
                    </form>
                </article>
            </div>
        </div>
    </div>
</body>

</html>