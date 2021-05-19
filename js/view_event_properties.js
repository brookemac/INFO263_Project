$(function () {
    $("#event_name_input").on('change', function (e) {
        if ($(this).val() == "") {
            $("#btnDeleteEvent").attr("disabled", "disabled")
            $("#tableResult tbody").html("<tr><td colspan='9'>No results</td></tr>");
            return;
        } else {
            let selectedOption = $("#event_name option[value="+$(this).val()+"]");
            $("#event_name_hidden").val(selectedOption.val());
            if ($("#event_name_hidden").val() != ''){
                $("#btnDeleteEvent").removeAttr("disabled");
            } else{
                $("#btnDeleteEvent").attr("disabled", "disabled")
            }
            $(this).val(selectedOption.text())

            $.get("get/get_properties.php", {q: $("#event_name_hidden").val()} , function(data){
                if (data != ""){
                    $("#tableResult tbody").html(data);
                } else{
                    $("#tableResult tbody").html("<tr><td colspan='9'>No results</td></tr>");
                }
            });
        }
    });
    $("#btnDeleteEvent").on('click', function (e) {
        swal({
            title: "Are you sure?",
            text: "Are you sure you want to delete the event and its related data?",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            $.post("post/delete_event.php", {eventId: $("#event_name_hidden").val()} , function(data){
                if (data == true){
                    $("#tableResult tbody").html("<tr><td colspan='9'>No results</td></tr>");
                    $("#event_name option[value="+$("#event_name_hidden").val()+"]").remove();
                    $("#event_name_input").val('');
                    $("#btnDeleteEvent").attr("disabled", "disabled")
                    $("#event_name_input").attr("list", "")
                    swal("Event removed!");
                } else{
                    swal("Some error happened!");
                }
            });
        });
    });

    $("#event_name_input").on('keydown', function (e) {
        if (e.target.value.length < 3 || e.keyCode == 8) {
            $(this).attr("list", "")
        }
    });
    $("#event_name_input").on('keyup', function (e) {
        if (e.target.value.length >= 3) {
            $(this).attr("list", "event_name")
        }
    });
});
