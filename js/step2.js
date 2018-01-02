$(document).ready(function(){
    jQuery.validator.addMethod("greaterThan", 
        function(value, element, params) {
            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) > new Date($(params).val());
            }
            return isNaN(value) && isNaN($(params).val()) 
            || (Number(value) >= Number($(params).val())); 
        },returnmessage());
    $("#startdate").bind("change",function() { returnmessage() })
    $("#step2").validate({
        rules: {
            datasetname: {
                required: true
            },
            imagefile: {
                accept: "jpg|png|jpeg|gif|ico|bmp"
            },
            startdate: {
                required: true
            },
            enddate: {
                required: true,
                greaterThan: "#startdate"
            }
        },
        message: {
            datasetname: {
                required: "Please Enter your Name"
            },
            imagefile: {
                accept: "Please upload image file"
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