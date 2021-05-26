<?php
$array_css = array('../css/sweetalert.css');

include 'partials/loggedIn/header.php';

require_once "../database/database_client.php";
require_once "../models/Event.php";
require_once "../Repository/EventRepository.php";
$eventRepository = new EventRepository($mysqli);
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Events
                </h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-xs-4">
                        <h2 class="card-inside-title">Start typing to select your event to then view its properties</h2>
                        <div class="col-xs-8">
                            <input placeholder="Search..." id="event_name_input" class="form-control" />
                        </div>
                        <div class="col-xs-8">
                            <button type="button" id="btnEditEvent" class="btn btn-primary" disabled>Edit</button>
                            <button type="button" id="btnDeleteEvent" class="btn btn-primary" disabled>Delete</button>
                        </div>
                        <input type="hidden" name="answer" id="event_id_hidden" />
                        <input type="hidden" name="answer" id="event_name_hidden" />
                        <datalist id="event_name" class="dle">
                            <?php
                            $events = $eventRepository->getAllEvents();
                            foreach ($events as $event)
                            {
                            ?>
                                <option value="<?php echo $event->getId(); ?>"><?php echo $event->getName(); ?></option>
                            <?php
                            }
                            ?>
                        </datalist>
                    </div>
                </div>
                <div class="body table-responsive">
                    <table class="table" id="tableResult">
                        <thead>
                            <th>Event-name</th>
                            <th>Cluster-Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Activate</th>
                            <th>Machine-group</th>
                            <th>Time-offset</th>
                            <th>Event-id</th>
                            <th>Group-id</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="9">
                                    No results
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$scripts = array('../js/view_event_properties.js', '../js/sweetalert.min.js');
include 'partials/loggedIn/footer.php';
?>