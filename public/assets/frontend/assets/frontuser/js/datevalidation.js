function formattedDate(e) {
    var t = new Date(e || Date.now()),
        r = "" + (t.getMonth() + 1),
        a = "" + t.getDate(),
        i = t.getFullYear();
    return r.length < 2 && (r = "0" + r), a.length < 2 && (a = "0" + a), [a, r, i].join("-");
}

$(".datepicker").on("change", function() {
    var selectedDate = $(this).val(); // Get the selected date from the datepicker
    var currentDate = new Date();

    // Convert currentDate to the format expected by the datepicker
    var currentDateString = ('0' + currentDate.getDate()).slice(-2) + "-" + ('0' + (currentDate.getMonth() + 1)).slice(-2) + "-" + currentDate.getFullYear();
    if (selectedDate === currentDateString) {
        // If the selected date is today, set the minimum time to current time + 1 hour and 30 minutes
        var hours = currentDate.getHours() + 1;
        var minutes = currentDate.getMinutes() + 30;
        if (minutes >= 60) {
            hours += 1;
            minutes -= 60;
        }
        var minTime = (hours < 10 ? "0" : "") + hours + ":" + (minutes < 10 ? "0" : "") + minutes;
    } else {
        // If the selected date is not today, set the minimum time to "00:00"
        var minTime = "00:00";
    }
    // Set the datetimepickernew with the calculated minTime and other options
    $(".datetimepickernew").datetimepicker({
        formatTime: "h:i A",
        datepicker: false,
        format: "h:i A",
        value: minTime,
        minTime: minTime,
        maxTime: "23:45",
        step: 15
    });
}),
$(function() {
    // Get current date and time
    var currentDate = new Date();
    var currentHour = currentDate.getHours();
    var currentMinute = currentDate.getMinutes();

    // Add 1.5 hours to the current time
    var addedHours = 1;
    var addedMinutes = 30;
    currentHour += addedHours;
    currentMinute += addedMinutes;

    // Adjust if minutes exceed 60
    if (currentMinute >= 60) {
        currentMinute -= 60;
        currentHour += 1;
    }

    // Check if time moves to the next date
    if (currentHour >= 24) {
        currentHour -= 24;
        currentDate.setDate(currentDate.getDate() + 1); // Move to the next date
    }

    // Set the maximum time to 11:59 PM
    var maxHour = 23;
    var maxMinute = 59;

    // Format the adjusted time
    var adjustedTime = (currentHour < 10 ? "0" : "") + currentHour + ":" + (currentMinute < 10 ? "0" : "") + currentMinute;
    
    // Show the adjusted time above the datepicker
    $("#timeDisplay").text("Adjusted Time: " + adjustedTime);

    // Set the datepicker with the adjusted date
    $(".datepicker").datetimepicker({
        i18n: {
            en: {
                months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                dayOfWeek: ["Sun", "Mon", "Tues", "Wed", "Thu", "Fri", "Sat"]
            }
        },
        timepicker: false,
        value: currentDate,
        format: "d-m-Y",
        closeOnDateSelect: true,
        minDate: "today", // Set minDate to the adjusted date
        weeks: false,
        onSelectDate: function(ct, $i) {
            // Close the datepicker when a date is selected
            this.hide();
        }
    });

    // Format the adjusted time
    var currentTime = (currentHour < 10 ? "0" : "") + currentHour + ":" + (currentMinute < 10 ? "0" : "") + currentMinute;

    // Set the timepicker with the adjusted time
    $(".timeON").datetimepicker({
        formatTime: "h:i A",
        datepicker: false,
        format: "h:i A",
        step: 15,
        value: currentTime, // Set the value to the adjusted time
        minTime: currentTime, // Set the minimum time to the adjusted time
        maxTime: "23:59", // Set the maximum time to 11:59 PM
        validateOnBlur: false,
    });
});
