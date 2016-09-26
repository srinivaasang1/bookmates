/**
 * Created by TomLiu on 18/04/2016.
 */

jQueryDatepicker.day_names_short = {
    1: 'Mon',
    2: 'Tue',
    3: 'Wed',
    4: 'Thu',
    5: 'Fri',
    6: 'Sat',
    7: 'Sun'
};

jQueryDatepicker.day_names = {
    1: 'Monday',
    2: 'Tuesday',
    3: 'Wednesday',
    4: 'Thursday',
    5: 'Friday',
    6: 'Saturday',
    7: 'Sunday'
};

jQueryDatepicker.month_names = {
    1: 'January',
    2: 'February',
    3: 'March',
    4: 'Apri',
    5: 'May',
    6: 'June',
    7: 'July',
    8: 'Agust',
    9: 'September',
    10: 'October',
    11: 'November',
    12: 'December'
};

var dateObj = new Date();
var monthCur = dateObj.getUTCMonth() + 1; //months from 1-12
var dayCur = dateObj.getUTCDate();
var yearCur = dateObj.getUTCFullYear();



$(document).ready(function () {
    var $selected = $('.selected');

    $some_datepicker = $('.some_datepicker');

    $some_datepicker.datepicker({
        next_button: '&gt;',
        prev_button: '&lt;'
    });

    $some_datepicker.setStartDate({
        year: yearCur,
        // jquery.datepicker accepts first month as 1
        // (built-in Date() class accepts first month as 0)
        month: monthCur,
        day: dayCur
    });

    $some_datepicker.on('date_selected.datepicker', function (event, date) {
        $selected.show().html('Selected date is: '+date.date.toString());
    });
});
