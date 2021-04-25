<?php

require_once "interfaces/IActionRepository.php";
require_once "BaseRepository.php";

class ActionRepository extends BaseRepository implements IActionRepository {
    public function addAction($eventId, $clusterId, $offset, $duration) {
        $sql = "call add_action(?, ?, ?, ?);";
        $succeded = false;
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->bind_param("iiss", $eventId, $clusterId, $offset, $duration);
            if ($stmt->execute()) {
                $succeded = true;
            }
            $stmt->close();
        }
        return $succeded;
    }
}
?>