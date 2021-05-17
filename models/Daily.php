<?php
class Daily {
    private $eventId;
    private $groupId;
    private $dayOfWeek;
    private $startTime;

    public function __construct($eventId, $groupId, $dayOfWeek, $startTime) {
        $this->eventId = $eventId;
        $this->groupId = $groupId;
        $this->dayOfWeek = $dayOfWeek;
        $this->startTime = $startTime;
    }

    public function getEventId() {
        return $this->eventId;
    }

    public function setEventId($eventId) {
        $this->eventId = $eventId;
    }

    public function getGroupId() {
        return $this->groupId;
    }

    public function setGroupId($groupId) {
        $this->groupId = $groupId;
    }

    public function getDayOfWeek() {
        return $this->dayOfWeek;
    }

    public function setDayOfWeek($dayOfWeek) {
        $this->dayOfWeek = $dayOfWeek;
    }

    public function getStartTime() {
        return $this->startTime;
    }

    public function setStartTime($startTime) {
        $this->startTime = $startTime;
    }
}
?>