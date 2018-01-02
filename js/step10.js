$(document).ready(function(){
    $("#step2").validate({
        rules: {
            datasetname: {
                required: true
            }
        },
        message: {
            datasetname: {
                required: "Please Enter your Name"
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo('#' + element.attr('id') + "Err");
        }
    });
    $(".cancelLink > .cancel").live("click",function() { 
            if (confirm("Are you sure you want to cancel?")) { return true; } else { return false; } });
});