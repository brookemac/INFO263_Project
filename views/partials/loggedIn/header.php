<?php

require_once "../models/User.php";
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

function getTitle(){
    global $title;
    if (isset($title)) {
        return $title;
    }
    else {
        return "Home";
    };
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo getTitle(); ?></title>
    <link rel="icon" href="../../../../favicon.ico" type="image/x-icon">
    <link href="../css/web-font.min.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap-3.3.6.min.css" rel="stylesheet">
    <link href="../css/animate.min.css" rel="stylesheet" />
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/all-themes.min.css" rel="stylesheet" />
<?php
    if (isset($array_css)){
        foreach($array_css as $css_path)
        {
            echo '<link href="'.$css_path.'" rel="stylesheet">';
        }
    }
?>
</head>
<body class="theme-red">
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand">INFO263 Group Project - <?php echo getTitle();?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
<?php
    include 'left_menu.php'
?>
    <section class="content">