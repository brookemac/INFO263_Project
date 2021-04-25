<?php

require_once "interfaces/IGroupRepository.php";
require_once "BaseRepository.php";

class GroupRepository extends BaseRepository implements IGroupRepository{
    public function getAll() {
        $groups = array();
        $query = 'SELECT * FROM info263_front_project.vw_display_group;';
        $result = mysqli_query($this->mysqli, $query);
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $group = new Group($row['group_id'], $row['machine_group']);
            array_push($groups, $group);
        }
        return $groups;
    }
}
?>