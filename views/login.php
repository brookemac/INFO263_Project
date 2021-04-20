<?php
require_once "../views/partials/redirect_to_index_check.php";
require_once "../Repository/UserRepository.php";
require_once "../database/database_client.php";

$username = $password = "";
$usernameError = $passError = $login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    if (empty(trim($_POST["username"]))) {
        $usernameError = "Please enter username.";
    }

    $password = trim($_POST["password"]);
    if (empty(trim($_POST["password"]))) {
        $passError = "Please enter your password.";
    }

    if (empty($usernameError) && empty($passError)) {
        $userRepository = new UserRepository($mysqli);
        $user = $userRepository->getByUsername($username);
        if ($user != null) {
            if (password_verify($password, $user->getHashedPassword())) {
                $_SESSION["loggedUser"] = $user;
                if (isset($_POST["rememberMe"]) && !empty(trim($_POST["rememberMe"]))) {
                    $expireTime = time() + (60 * 20);
                    setcookie("loggedUsername", $user->getUsername(), $expireTime);
                }
                header("location: home.php");
                exit();
            } else {
                $login_error = "Invalid username or password.";
            }
        } else {
            $login_error = "Invalid username or password.";
        }
    }
}
include 'partials/notloggedIn/header.php'
?>
<article class="card-body mx-auto user_register_card_body">
    <p class="text-center"><h4 class="card-title mt-3 text-center">Sign in</h4></p>
    <?php
        if (!empty($login_error)) {
            echo '<div class="alert alert-danger">' . $login_error . '</div>';
        }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="input-group mb-3 form-group">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" name="username" class="form-control input_user <?php echo (!empty($usernameError)) ? 'is-invalid' : ''; ?>" placeholder="username" value="<?php echo $username; ?>">
            <span class="invalid-feedback"><?php echo $usernameError; ?></span>
        </div>
        <div class="input-group mb-2">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" name="password" class="form-control input_pass <?php echo (!empty($passError)) ? 'is-invalid' : ''; ?>" placeholder="password" value="<?php echo $password; ?>">
            <span class="invalid-feedback"><?php echo $passError; ?></span>
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customControlInline" name="rememberMe">
                <label class="custom-control-label" for="customControlInline">Remember me</label>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3 login_container">
            <button type="submit" name="button" class="btn login_btn">Sign in</button>
        </div>
        <div class="mt-4">
            <p class="text-center">Don't have an account? <a href="register.php">Sign Up</a> </p>
        </div>
    </form>
</article>
<?php
    include 'partials/notloggedIn/footer.php'
?>