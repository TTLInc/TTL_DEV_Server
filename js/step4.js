$(document).ready(function(){
    $("#step2").validate({
        rules: {
            datasetname: {
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
            datasetname: {
                required: "Please Enter your Name"
            },
            status: {
                required: "Please Enter Email Address"
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo('#' + element.attr('id') + "Err");
        }
    });
    $(".cancelLink > .cancel").live("click",function() { 
            if (confirm("Are you sure you want to cancel?")) { return true; } else { return false; } });
});