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

    public function getAllEvents(){
        $events = array();
        $query = "SELECT event_id, event_name, status FROM vw_front_event_raw;";
        $result = mysqli_query($this->mysqli, $query);
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $event = new Event($row['event_id'], $row['event_name'], $row['status']);
            array_push($events, $event);
        }
        return $events;
    }

    public function getCurrentStateTable($endDate, $startDate, $happeningNow) {
        $clusters = array();
        $query = "SELECT * FROM vw_front_event_grouped WHERE 1=1";
        if ($startDate != null || $endDate != null || $happeningNow != null){
            if ($startDate != null){
                $query .= " and date(start_time) >= '".$startDate."'";
            }
            if ($endDate != null){
                $query .= " and date(end_time) <= '".$endDate."'";
            }
            if ($happeningNow != null){
                $query .= " and now() > start_time and now() < end_time";
            }
        }else{
            $query .= " and date(start_time) >= date(now())";
        }
        $query .= " order by start_time desc, event_name";

        $result = mysqli_query($this->mysqli, $query);
        $results = array();
        $events = array();

        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $each = array();
            $each['start_time'] = $row['start_time'];
            $each['end_time'] = $row['end_time'];
            $each['event_name'] = $row['event_name'];
            $each['cluster_name'] = $row['cluster_name'];
            $each['machine_group'] = $row['machine_group'];

            array_push($results, $each);
        }
        $result = '';

        foreach($results as $row => $innerArray) {
            $result .= '<tr>';
            foreach($innerArray as $innerRow => $value){
                $result .= '<td>'.$value.'</td>';
            }
            $result .= '</tr>';
        }
        return $result;
    }

    public function editEvent($eventId, $updatedName) {
        $sql = "call update_event(?, ?);";
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->bind_param("is", $eventId, $updatedName);
            if ($stmt->execute()) {
                return true;
            }
            $stmt->close();
        }
        return false;
    }

    public function deleteEvent($eventId){
        $sql = "call delete_event(?);";
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->bind_param("i", $eventId);
            if ($stmt->execute()) {
                return true;
            }
            $stmt->close();
        }
        return false;
    }

    public function getPropertiesTable($eventId) {
        $clusters = array();
        $query = "SELECT * FROM info263_front_project.vw_display_view WHERE event_id = '{$eventId}'";

        $result = mysqli_query($this->mysqli, $query);
        $results = array();
        $events = array();

        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $each = array();
            $each['event_name'] = $row['event_name'];
            $each['cluster_name'] = $row['cluster_name'];
            $each['date'] = $row['date'];
            $each['time'] = $row['time'];
            $each['activate'] = $row['activate'];
            $each['machine_group'] = $row['machine_group'];
            $each['time_offset'] = $row['time_offset'];
            $each['event_id'] = $row['event_id'];
            $each['group_id'] = $row['group_id'];
            array_push($results, $each);
        }
        $result = '';

        foreach($results as $row => $innerArray) {
            $result .= '<tr>';
            foreach($innerArray as $innerRow => $value){
                $result .= '<td>'.$value.'</td>';
            }
            $result .= '</tr>';
        }
        return $result;
    }
}
?>