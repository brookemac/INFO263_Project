<?php
$array_css = array('../css/dataTables.bootstrap.min.css');

include 'partials/loggedIn/header.php';
require_once "../database/database_client.php";

function getEvents() {
    global $mysqli;
    $query = "select * from vw_front_event_grouped";
    $query .= " where date(start_time) >= date(now()) order by start_time desc, event_name";
    $result = mysqli_query($mysqli, $query);
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
    return $results;
}
$myArray = getEvents();
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
                            <div>
                                <h2 class="card-inside-title">Range</h2>
                            </div>
                            <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Date start...">
                                </div>
                                <span class="input-group-addon">to</span>
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Date end...">
                                </div>
                                <span class="input-group-addon"></span>
                                <button type="button" class="btn bg-blue waves-effect">Apply range</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Event Name</th>
                                    <th>Cluster Name</th>
                                    <th>Machine Group</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Event Name</th>
                                    <th>Cluster Name</th>
                                    <th>Machine Group</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php foreach($myArray as $row => $innerArray) { ?>
                                <tr>
                            <?php
                                foreach($innerArray as $innerRow => $value){ ?>
                                    <td><?php echo $value;?></td>
                            <?php } ?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$scripts = array('../js/datatable/jquery.dataTables.js', '../js/datatable/dataTables.bootstrap.min.js', '../js/datatable/buttons.html5.min.js', '../js/datatable/buttons.print.min.js', '../js/datatable/dataTables.buttons.min.js', '../js/datatable/jszip.min.js', '../js/datatable/pdfmake.min.js', '../js/datatable/vfs_fonts.js', '../js/view_current_state.js');
include 'partials/loggedIn/footer.php'
?>