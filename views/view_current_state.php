<?php
$array_css = array('../css/bootstrap-material-datetimepicker.css', '../css/dataTables.bootstrap.min.css');

include 'partials/loggedIn/header.php';

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
                                    <input type="text" id="startDate" class="datepicker form-control" placeholder="Date start...">
                                </div>
                                <span class="input-group-addon">to</span>
                                <div class="form-line">
                                    <input type="text" id="endDate" class="datepicker form-control" placeholder="Date end...">
                                </div>
                                <span class="input-group-addon"></span>
                                <button type="button" id="applyRange" class="btn bg-blue waves-effect">Apply range</button>
                            </div>
                            <button type="button" class="btn bg-indigo waves-effect" id="happeningNow">
                                <i class="material-icons">trending_up</i>
                                <span>Happening now</span>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tableResults">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$scripts = array('../js/datatable/jquery.dataTables.js', '../js/moment.js', '../js/datatable/dataTables.bootstrap.min.js', '../js/datatable/buttons.html5.min.js', '../js/datatable/buttons.print.min.js', '../js/datatable/dataTables.buttons.min.js', '../js/datatable/jszip.min.js', '../js/datatable/pdfmake.min.js', '../js/bootstrap-material-datetimepicker.js', '../js/datatable/vfs_fonts.js', '../js/view_current_state.js');
include 'partials/loggedIn/footer.php'
?>