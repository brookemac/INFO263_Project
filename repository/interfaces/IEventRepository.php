<?php
interface IEventRepository
{
    public function addEventWithReturn($name, $status);
    public function getCurrentStateTable($endDate, $startDate, $happeningNow);
}
?>