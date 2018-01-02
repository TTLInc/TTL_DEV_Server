$(document).ready(function(){
     
    jQuery.validator.addMethod("greaterThan", 
        function(value, element, params) {
            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) > new Date($(params).val());
            }

            return isNaN(value) && isNaN($(params).val()) 
            || (Number(value) > Number($(params).val())); 
        },returnmessage());
    
    $("#step5").validate({
        rules: {
            samp_desc: {
                required: true
            },
            //            status: {
            //                required: true
            //            },
            startdate: {
                required: true
            },
            enddate: {
                required: true,
                greaterThan: "#startdate"
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
            samp_desc: {
                required: "Please Enter Sampling Description"
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
function returnmessage()
{
    return 'Must be greater than Startdate ';
}