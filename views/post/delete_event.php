<?php
require_once "../../database/database_client.php";
require_once "../../Repository/EventRepository.php";
$eventId = $_POST["eventId"];
$eventRepository = new EventRepository($mysqli);
echo $eventRepository->deleteEvent($eventId);