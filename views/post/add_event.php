<?php
require_once "../../database/database_client.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../../models/Daily.php";
    require_once "../../models/Weekly.php";
    require_once "../../models/Event.php";
    require_once "../../Repository/EventRepository.php";
    require_once "../../Repository/ActionRepository.php";
    require_once "../../Repository/DailyRepository.php";
    require_once "../../Repository/WeeklyRepository.php";
    $eventName = trim($_POST["event_name"]);
    $status = 0;
    if (isset($_POST["event_status"]) && !empty(trim($_POST["event_status"]))) {
        $status = 1;
    }
    $actionClusterIdToActivate = trim($_POST["action_cluster_to_activate"]);
    $actionClusterIdToDeactivate = trim($_POST["action_cluster_to_deactivate"]);
    $actionOffset = trim($_POST["action_start_offset"]);
    $actionDurationOffset = trim($_POST["action_duration_offset"]);
    $dailyList = array();
    $weeklyList = array();
    $thereIsDaily = true;
    $eventRepository = new EventRepository($mysqli);
    $event = $eventRepository->addEventWithReturn($eventName, $status);

    $dailyId = 1;
    while ($thereIsDaily) {
        if (isset($_POST["daily_group_" . $dailyId])) {
            $daily = new Daily($event->getId(), $_POST["daily_group_" . $dailyId], $_POST["daily_week_" . $dailyId], $_POST["daily_start_time_" . $dailyId]);
            array_push($dailyList, $daily);
            $dailyId++;
        }
        else {
            $thereIsDaily = false;
        }
    }
    $thereIsWeekly = true;
    $weeklyId = 1;
    while ($thereIsWeekly) {
        if (isset($_POST["weekly_week_of_year_" . $weeklyId])) {
            $weekly = new Weekly($event->getId(), $_POST["weekly_week_of_year_" . $weeklyId], $_POST["weekly_year_" . $weeklyId]);
            array_push($weeklyList, $weekly);
            $weeklyId++;
        }
        else {
            $thereIsWeekly = false;
        }
    }
    $actionRepository = new ActionRepository($mysqli);
    $actionRepository->addAction($event->getId(), $actionClusterIdToActivate, $actionClusterIdToDeactivate, $actionOffset, $actionDurationOffset);
    $dailyRepository = new DailyRepository($mysqli);
    $dailyRepository->addDailyList($dailyList);
    $weeklyRepository = new WeeklyRepository($mysqli);
    $weeklyRepository->addWeeklyList($weeklyList);
    $eventAdded = true;
    $_SESSION["productAdded"] = true;
    header("Location: ../add_event.php");
    exit();
}