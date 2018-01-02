$(document).ready(function(){
    $("#step12").validate({
        rules: {
            projec_code: {
                required: true
            }
        },
        message: {
            projec_code: {
                required: "Please Enter Projec Code."
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo('#' + element.attr('id') + "Err");
        }
    });
    $(".cancelLink > .cancel").live("click",function() { 
            if (confirm("Are you sure you want to cancel?")) { return true; } else { return false; } });
});