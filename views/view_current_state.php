<?php
$array_css = array('../css/dataTables.bootstrap.min.css');

include 'partials/loggedIn/header.php';
require_once "../database/database_client.php";

function viewEvent() {
    global $mysqli;
    //SQL statement to get all event details from database
    $dateFilter = null;
    $eventName = null;
    if (isset($_GET['date'])) {
        $dateFilter = $_GET['date'];
    }
    if (isset($_GET['end_time'])) {
        $eventName = $_GET['end_time'];
    }
    $query = "select * from vw_front_event_grouped";
    if ($dateFilter != null || $eventName != null) {
        $query .= " where 1=1";
        if ($dateFilter != null) {
            $query .= " and start_time = '{$dateFilter}'";
        }
    }
    $query .= " order by start_time desc, event_name";
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
$myArray = viewEvent();
?>
    <div class="row clearfix">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <span>Provide the event date</span>
            <input type="text" name="date" />
        </form>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        EXPORTABLE TABLE
                    </h2>
                </div>
                <div class="body">
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