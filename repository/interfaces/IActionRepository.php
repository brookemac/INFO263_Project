<?php
interface IActionRepository
{
    public function addAction($eventId, $clusterIdToActivate, $clusterIdToDeactivate, $offset, $duration);
}
?>