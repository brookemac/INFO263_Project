<?php

require_once "interfaces/IWeeklyRepository.php";
require_once "BaseRepository.php";

class WeeklyRepository extends BaseRepository implements IWeeklyRepository {
    public function addWeeklyList($weeklyList) {
        foreach ($weeklyList as $weekly) {
            $this->addWeekly($weekly);
        }
    }

    public function addWeekly($weekly) {
        $sql = "call add_weekly(?, ?, ?);";
        $succeded = false;
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->bind_param("iii", $eventId, $weekOfYear, $year);
            $eventId = $weekly->getEventId();
            $weekOfYear = $weekly->getWeekOfYear();
            $year = $weekly->getYear();
            if ($stmt->execute()) {
                $succeded = true;
            }
            $stmt->close();
        }
        return $succeded;
    }
}
?>