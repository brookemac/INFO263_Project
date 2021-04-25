<?php

require_once "interfaces/IEventRepository.php";
require_once "BaseRepository.php";

class EventRepository extends BaseRepository implements IEventRepository {
    public function addEventWithReturn($name, $status) {
        $event = null;
        $sql = "SELECT add_event(?, ?);";
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->bind_param("si", $name, $status);
            if ($stmt->execute()) {
                $stmt->store_result();
                if($stmt->num_rows == 1) {
                    $stmt->bind_result($id);
                    if($stmt->fetch()) {
                        $event = new Event($id, $name, $status);
                    }
                }
            }
            $stmt->close();
        }
        return $event;
    }
}
?>