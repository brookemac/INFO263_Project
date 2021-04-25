<?php
class Weekly {
    private $eventId;
    private $weekOfYear;
    private $year;

    public function __construct($eventId, $weekOfYear, $year) {
        $this->eventId = $eventId;
        $this->weekOfYear = $weekOfYear;
        $this->year = $year;
    }

    public function getEventId() {
        return $this->eventId;
    }

    public function setEventId($eventId) {
        $this->eventId = $eventId;
    }

    public function getWeekOfYear() {
        return $this->weekOfYear;
    }

    public function setWeekOfYear($weekOfYear) {
        $this->weekOfYear = $weekOfYear;
    }

    public function getYear() {
        return $this->year;
    }

    public function setYear($year) {
        $this->year = $year;
    }
}
?>