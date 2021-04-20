<?php
session_start();

$_SESSION = array();

session_destroy();
setcookie("loggedUsername","value",time() - 3600);

header("location: login.php");
exit();
?>