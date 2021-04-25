<?php

require_once "interfaces/IDailyRepository.php";
require_once "BaseRepository.php";

class DailyRepository extends BaseRepository implements IDailyRepository {
    public function addDailyList($dailyList) {
        foreach ($dailyList as $daily) {
            $this->addDaily($daily);
        }
    }


    public function addDaily($daily) {
        $sql = "call add_daily(?, ?, ?, ?);";
        $succeded = false;
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->bind_param("isis", $eventId, $groupId, $dayOfWeek, $startTime);
            $eventId = $daily->getEventId();
            $groupId = $daily->getGroupId();
            $dayOfWeek = $daily->getDayOfWeek();
            $startTime = $daily->getStartTime();
            if ($stmt->execute()) {
                $succeded = true;
            }
            $stmt->close();
        }
        return $succeded;
    }
}
?>