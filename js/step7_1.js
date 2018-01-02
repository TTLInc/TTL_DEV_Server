$(document).ready(function(){
    $("#step7").validate({
        rules: {
            csvFile: {
                required: true,
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
});