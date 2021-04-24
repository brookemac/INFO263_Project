<?php
$array_css = array('../css/bootstrap-material-datetimepicker.css', '../css/waves.min.css');
require_once "../database/database_client.php";
$title = "Add event";
include 'partials/loggedIn/header.php';
?>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>ADDING AN EVENT</h2>
                    </div>
                    <div class="body">
                        <form id="wizard_with_validation" method="POST">
                            <h3>Adding an event</h3>
                            <fieldset>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label>Name*</label>
                                        <input type="text" class="form-control" name="event_name" required>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <input id="acceptTerms-2" name="event_status" type="checkbox">
                                    <label for="acceptTerms-2">Status</label>
                                </div>
                            </fieldset>
                            <h3>Adding action</h3>
                            <fieldset>
                                <div class="col-md-5">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <b>Cluster*</b>
                                            <?php
                                                $query = 'SELECT * FROM info263_front_project.vw_display_cluster;';
                                                $result = mysqli_query($mysqli, $query);
                                            ?>
                                            <select class="form-control" name="action_cluster" required>
                                                <option value="">--Please Select--</option>
                                                <?php
                                                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $row['cluster_id']; ?>"><?php echo $row['cluster_name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-float">
                                        <b>Start offset Time (24 hour)*</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">access_time</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="action_start_offset" class="form-control time24" placeholder="Ex: -00:15:00" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-float">
                                        <b>Duration offset Time (24 hour)*</b>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">access_time</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" name="action_duration_offset" class="form-control time24" placeholder="Ex: 23:59:00" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <h3>Adding daily</h3>
                            <fieldset>
                                <div id="daily_option_parent">
                                    <div id="daily_option_1" class="col-md-12">
                                        <div class="col-md-3">
                                            <div class="form-group form-float">
                                                <b>Group</b>
                                                <div class="form-line">
                                                        <?php
                                                            $query = 'SELECT * FROM info263_front_project.vw_display_group;';
                                                            $result = mysqli_query($mysqli, $query);
                                                        ?>
                                                        <select class="form-control" name="daily_group_1" required>
                                                            <option value="">--Please Select--</option>
                                                            <?php
                                                            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                                                            ?>
                                                            <option value="<?php echo $row['group_id']; ?>"><?php echo $row['machine_group']; ?></option>
                                                            <?php
                                                            }
                                                            $mysqli->close();
                                                            ?>
                                                        </select>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group form-float">
                                                <b>Day of the week</b>
                                                <div class="form-line">
                                                    <select class="form-control" name="daily_week_1" required>
                                                        <option value="">--Please Select--</option>
                                                        <option value="0">Sunday</option>
                                                        <option value="1">Monday</option>
                                                        <option value="2">Tuesday</option>
                                                        <option value="3">Wednesday</option>
                                                        <option value="4">Thursday</option>
                                                        <option value="5">Friday</option>
                                                        <option value="6">Saturday</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group form-float">
                                                <b>Start time*</b>
                                                <div class="form-line">
                                                    <input type="text" name="daily_start_time_1" class="timepicker form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" id="btnAddDaily">
                                        <i class="material-icons">add</i>
                                    </button>
                                    <label for="btnAddDaily">Add another daily</label>
                                </div>
                            </fieldset>
                            <h3>Adding weekly</h3>
                            <fieldset>
                                <div id="weekly_option_parent">
                                    <div id="weekly_option_1" class="col-md-12">
                                        <div class="col-md-3">
                                            <div class="form-group form-float">
                                                <b>Week of year</b>
                                                <div class="form-line">
                                                    <select class="form-control" name="weekly_week_of_year_1" required>
                                                        <option value="">--Please Select--</option>
                                                        <?php
                                                            for ($i=1;$i<=55;$i++){
                                                        ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group form-float">
                                                <b>Year</b>
                                                <div class="form-line">
                                                    <select class="form-control" name="weekly_year_1" required>
                                                        <option value="">--Please Select--</option>
                                                        <?php
                                                            for ($i=date("Y") - 5;$i<date("Y") + 3;$i++){
                                                        ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float" id="btnAddWeekly">
                                        <i class="material-icons">add</i>
                                    </button>
                                    <label for="btnAddWeekly">Add another weekly</label>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$scripts = array('../js/waves.min.js', '../js/jquery.steps.min.js', '../js/moment.js', '../js/jquery.validate.js', '../js/form-wizard.js', '../js/bootstrap-material-datetimepicker.js', '../js/jquery.inputmask.bundle.js', '../js/add_event.js');
include 'partials/loggedIn/footer.php';
?>