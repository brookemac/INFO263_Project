<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'test');
define('DB_NAME', 'info263_front_project');

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($mysqli === false) {
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
