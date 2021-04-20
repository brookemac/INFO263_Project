<?php
session_start();

if (isset($_SESSION["loggedUser"])) {
    header("location: home.php");
    exit();
}
?>