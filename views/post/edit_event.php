<?php
require_once "../../database/database_client.php";
require_once "../../Repository/EventRepository.php";

$eventId = $_POST["eventId"];
$updateName = $_POST["updateName"];

$eventRepository = new EventRepository($mysqli);
echo $eventRepository->editEvent($eventId, $updateName);
?>