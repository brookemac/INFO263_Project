<?php
include 'partials/loggedIn/header.php';
require_once "../database/database_client.php";


//----------------------------start the date picker----------------------------
//----------------------------------------------------------------------------
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Basic Form Elements | Bootstrap Based Admin Template - Material Design</title>
  
   <!-- these have to stay -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="../../plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

</head>
<body class="theme-red">
    <section class="content">
        <div class="container-fluid">
             <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DATE PICKER
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <h2 class="card-inside-title">Choose day and time</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="datetimepicker form-control" placeholder="Select date & time">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h2 class="card-inside-title">Choose a date Range</h2>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            
                                            <div class="form-line">
                                                <input type="text" class="datepicker form-control" placeholder="Select start date">                                           
                                            </div>                    
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            
                                            <div class="form-line">
                                              
                                                <input type="text" class="datepicker form-control" placeholder="Select end date">
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="../../plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="../../plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="../../plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/forms/basic-form-elements.js"></script>
</body>
</html>
<?php
//----------------------------------------------------------------------------
//----------------------------end the date picker----------------------------


function viewEvent() {
    global $mysqli;
    //SQL statement to get all event details from database
    $dateFilter = null;
    $eventName = null;
    if (isset($_GET['date'])) {
        $dateFilter = $_GET['date'];
    }
    if (isset($_GET['event_name'])) {
        $eventName = $_GET['event_name'];
    }
    $query = "select * from vw_front_event"; 
    if ($dateFilter != null || $eventName != null) {
        $query .= " where 1=1";
        if ($dateFilter != null) {
            $query .= " and date = '{$dateFilter}'";
        }
        if ($eventName != null) {
            $query .= " and event_name like '%{$eventName}%'";
        }
    }
    $query .= " order by time, cluster_id, group_id limit 10";    
    echo $query;
    $result = mysqli_query($mysqli, $query);
    $results = array();
    $events = array();

    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        //make an array for current event state with all details
        $each = array();
        $each['event_id'] = $row['event_id'];
        $each['event_name'] = $row['event_name'];
        $each['action_id'] = $row['action_id'];
        $each['cluster_name'] = $row['cluster_name'];
        $each['date'] = $row['date'];
        $each['time'] = $row['time'];
        $each['machine_group'] = $row['machine_group'];
        $each['activate'] = $row['activate'];
        $id = (string)$row["event_id"];

        array_push($results, $each);
        // if event_id already exists, add to existing entry of results -- uncomment the below lines and remove the array_push line above to group the events by event_id

        // if (array_key_exists($row['event_id'], $results)) {
        //     $before = $results[$row['event_id']];
        //     array_push($before, $each);
        //     $results[$id] = $before;
        // } else { //if event_id doesn't exist, add to results
        //     $results[$id] = [$each];
        // }
    }
    return $results;
}
//view_events.js will pick this up
//echo print_r(viewEvent(), true);
$myArray = viewEvent();
?> <table style="width:100%">
  <tr>
    <th>event_id</th>
    <th>event_name</th>
    <th>action_id</th>
    <th>cluster_name</th>
    <th>date</th>
    <th>time</th>
    <th>machine_group</th>
    <th>activate</th>
  </tr>
  <?php foreach($myArray as $row => $innerArray) { ?>
    <tr> 
    <?php
    foreach($innerArray as $innerRow => $value){?>
    <td><?php echo $value;?></td>
   <?php
} ?></tr> <?php
}?> </table>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
    <span>Provide the event date</span>
    <input type="text" name="date" value="<?php echo $_GET['date'];?>"/>
    <span>Event name</span>
    <input type="text" name="event_name" value="<?php echo $_GET['event_name'];?>"/>
    <button type="submit" class="btn btn-primary btn-block"> sUBMIT </button>
</form>
<?php
include 'partials/loggedIn/footer.php'
?>