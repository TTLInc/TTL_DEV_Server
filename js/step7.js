$(document).ready(function(){
    $.validator.addMethod("isfileselected", function (value, element) {
        if (value != "")
        {
            return true;
        }
        else
        {
            if ($("#hdncsvfiles").val() != "")
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }, 'Please Select CSV File.');
    $("#step7").validate({
        rules: {
            csvFile: {
                isfileselected: true,
                accept: "csv"
            }
        },
        message: {
            csvFile: {
                required: "Please Select CSV File.",
                csv: "File must be CSV."
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo('#' + element.attr('id') + "Err");
        }
    });
    $(".cancelLink > .cancel").live("click",function() { 
            if (confirm("Are you sure you want to cancel?")) { return true; } else { return false; } });
});