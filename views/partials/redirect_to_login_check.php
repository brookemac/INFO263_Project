<?php
session_start();

if (!isset($_SESSION["loggedUser"])) {
    if (isset($_COOKIE['loggedUsername'])) {
        require_once "../Repository/UserRepository.php";
        require_once "../database/database_client.php";
        $userRepository = new UserRepository($mysqli);
        $user = $userRepository->getByUsername($_COOKIE['loggedUsername']);
        if ($user != null) {
            $_SESSION["loggedUser"] = $user;
        }
    } else {
        header("location: login.php");
        exit();
    }
}
