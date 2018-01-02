$(document).ready(function(){
    $("#step6").validate({
        rules: {
            method: {
                required: true
            //            },
            //            status: {
            //                required: true
            //            },
            //            startdate: {
            //                required: true
            //            },
            //            enddate: {
            //                required: true
            //            },
            //            description: {
            //                required: true
            //            },
            //            purpose: {
            //                required: true
            //            },
            //            imagefile: {
            //                required: true
            }
        },
        message: {
            method: {
                required: "Please Enter Method"
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo('#' + element.attr('id') + "Err");
        }
    });
    $(".cancelLink > .cancel").live("click",function() { 
            if (confirm("Are you sure you want to cancel?")) { return true; } else { return false; } });
});