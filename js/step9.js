$(document).ready(function(){
    $("#step9").validate({
        rules: {
            field_name: {
                required: true
            },
            data_type: {
                required: true
            },
            character_length: {
                required: true,
                number: true
            }
        },
        message: {
            field_name: {
                required: "Please Enter Field Name"
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo('#' + element.attr('id') + "Err");
        }
    });
    $(".cancelLink > .cancel").live("click",function() { 
            if (confirm("Are you sure you want to cancel?")) { return true; } else { return false; } });
});