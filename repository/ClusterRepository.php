<?php

require_once "interfaces/IClusterRepository.php";
require_once "BaseRepository.php";

class ClusterRepository extends BaseRepository implements IClusterRepository{
    public function getAll() {
        $clusters = array();
        $query = 'SELECT * FROM info263_front_project.vw_display_cluster;';
        $result = mysqli_query($this->mysqli, $query);
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $cluster = new Cluster($row['cluster_id'], $row['cluster_name']);
            array_push($clusters, $cluster);
        }
        return $clusters;
    }
}
?>