<?php
    require_once "../../database/database_client.php";
    require_once "../../Repository/EventRepository.php";

    $eventRepository = new EventRepository($mysqli);

    $happeningNow = $startDate = $endDate = null;
    if (isset($_GET['startDate']))
    {
        $startDate = $_GET['startDate'];
    }
    if (isset($_GET['endDate']))
    {
        $endDate = $_GET['endDate'];
    }
    if (isset($_GET['happeningNow']))
    {
        $happeningNow = $_GET['happeningNow'];
    }

    $results = $eventRepository->getCurrentStateTable($endDate, $startDate, $happeningNow);
    echo $results;
?>