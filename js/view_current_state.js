$(function () {
    var table;
    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        weekStart: 1,
        time: false
    });

    $('#applyRange').on('click', function (e) {
        $.get("get/view_current_state.php", {startDate: $("#startDate").val(), endDate: $("#endDate").val()} , function(data){
            table.destroy();
            $("#tableResults tbody").html(data);
            buildTable();
        });
    });

    $('#happeningNow').on('click', function (e) {
        $.get("get/view_current_state.php", {happeningNow: true} , function(data){
            table.destroy();
            $("#tableResults tbody").html(data);
            buildTable();
        });
    });

    $.get("get/view_current_state.php", function(data){
        $("#tableResults tbody").html(data);
        buildTable();
    });

    function buildTable(){
        table = $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    }
});