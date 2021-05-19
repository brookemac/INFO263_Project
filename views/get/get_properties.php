<?php
require_once "../../database/database_client.php";
require_once "../../Repository/EventRepository.php";

$q = $_GET['q'];
$eventRepository = new EventRepository($mysqli);
echo $eventRepository->getPropertiesTable($q);