$(function () {
    $("#event_name_input").on('change', function (e) {
        if ($(this).val() == "") {
            $("#btnDeleteEvent").attr("disabled", "disabled")
            $("#tableResult tbody").html("<tr><td colspan='9'>No results</td></tr>");
            return;
        } else {
            let selectedOption = $("#event_name option[value='"+$(this).val()+"']");
            if (selectedOption.length == 0) return;
            $("#event_id_hidden").val(selectedOption.val());
            if ($("#event_id_hidden").val() != ''){
                $("#btnDeleteEvent, #btnEditEvent").removeAttr("disabled");
            } else{
                $("#btnDeleteEvent, #btnEditEvent").attr("disabled", "disabled")
            }
            $("#event_name_hidden").val(selectedOption.text());
            $(this).val(selectedOption.text())

            getTable();
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
            $.post("post/delete_event.php", {eventId: $("#event_id_hidden").val()} , function(data){
                if (data == true){
                    $("#event_name option[value="+$("#event_id_hidden").val()+"]").remove();
                    $("#tableResult tbody").html("<tr><td colspan='9'>No results</td></tr>");
                    $("#btnDeleteEvent, #btnEditEvent").attr("disabled", "disabled");
                    $("#event_name_input, #event_id_hidden, #event_name_hidden").val('');
                    $("#event_name_input").attr("list", "")
                    swal("Event removed!");
                } else{
                    swal("Some error happened!");
                }
            });
        });
    });

    $("#btnEditEvent").click(function (e) {
        swal({
            title: "Edit Event Name",
            text: "Are you sure you want to edit " + $("#event_name_hidden").val() + "?",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            inputPlaceholder: "Enter New Name"
        }, function(inputValue) {
            if (inputValue===false)
                return false;
            if (inputValue === "") {
                swal.showInputError("You need to write something!");
            } else{
                $.post("post/edit_event.php", {eventId: $("#event_id_hidden").val(), updateName: inputValue} , function(data){
                    if (data == true){
                        $("#event_name option[value="+$("#event_id_hidden").val()+"]").text(inputValue);
                        $("#event_name_input").val(inputValue);
                        getTable();
                        swal("Event edited!");
                    } else{
                        swal("Some error happened!");
                    }
                });
            }
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

    function getTable(){
        $.get("get/get_properties.php", {q: $("#event_id_hidden").val()} , function(data){
            if (data != ""){
                $("#tableResult tbody").html(data);
            } else{
                $("#tableResult tbody").html("<tr><td colspan='9'>No results</td></tr>");
            }
        });
    }
});
