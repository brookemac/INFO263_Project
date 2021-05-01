<?php
interface IActionRepository
{
    public function addAction($eventId, $clusterId, $offset, $duration);
}
?>