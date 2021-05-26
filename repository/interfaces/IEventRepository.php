<?php
interface IEventRepository
{
    public function addEventWithReturn($name, $status);
    public function getCurrentStateTable($endDate, $startDate, $happeningNow);
    public function getAllEvents();
    public function deleteEvent($eventId);
    public function editEvent($eventId, $updatedName);
    public function getPropertiesTable($eventId);
}
?>