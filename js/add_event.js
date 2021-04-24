$(function () {
    let dailyId = 2;
    $('#btnAddDaily').on('click', function (e) {
        let content = $('#daily_option_1').clone();
        content.attr('id', 'daily_option_' + dailyId);
        content.find('input[type=text]').val('');
        content.find('error').remove();
        content.find('select').val('');
        content.find('select[name="daily_group_1"]').attr('name', 'daily_group_' + dailyId);
        content.find('select[name="daily_week_1"]').attr('name', 'daily_week_' + dailyId);
        content.find('input[name="daily_start_time_1"]').attr('name', 'daily_start_time_' + dailyId);
        dailyId += 1;

        let removeButton = '<div class="col-md-1"><button type="button" title="Remove daily" class="btn btn-danger btn-circle waves-effect waves-circle waves-float remove-daily"><i class="material-icons">remove</i></button></div>';
        content.append(removeButton);
        $('.remove-daily').parent().fadeOut();
        $('#daily_option_parent').append(content);
        $('.timepicker').bootstrapMaterialDatePicker({
            format: 'HH:mm',
            clearButton: true,
            date: false
        });

        var form = $('#wizard_with_validation').show();
        form.validate();
    });

    $('#daily_option_parent').on('click', '.remove-daily', function (e) {
        $(this).parent().parent().remove();
        dailyId -= 1;
        $('#daily_option_' + (dailyId - 1)).find('.remove-daily').parent().fadeIn();
    });

    let weeklyId = 2;
    $('#btnAddWeekly').on('click', function (e) {
        let content = $('#weekly_option_1').clone();
        content.attr('id', 'weekly_option_' + weeklyId);
        content.find('input[type=text]').val('');
        content.find('select').val('');
        content.find('error').remove();
        content.find('select[name="weekly_week_of_year_1"]').attr('name', 'weekly_week_of_year_' + weeklyId);
        content.find('select[name="weekly_year_1"]').attr('name', 'weekly_year_' + weeklyId);
        weeklyId += 1;

        let removeButton = '<div class="col-md-1"><button type="button" title="Remove weekly" class="btn btn-danger btn-circle waves-effect waves-circle waves-float remove-weekly"><i class="material-icons">remove</i></button></div>';
        $('.remove-weekly').parent().fadeOut();
        content.append(removeButton);

        $('#weekly_option_parent').append(content);

        var form = $('#wizard_with_validation').show();
        form.validate();
    });

    $('#weekly_option_parent').on('click', '.remove-weekly', function (e) {
        $(this).parent().parent().remove();
        weeklyId -= 1;
        $('#weekly_option_' + (weeklyId - 1)).find('.remove-weekly').parent().fadeIn();
    });

    $('.timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        clearButton: true,
        date: false
    });

    $('.time24').inputmask('hh:mm:ss', { placeholder: '__:__:__', alias: 'time24', hourFormat: '24' });
});
