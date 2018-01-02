$(document).ready(function(){
    jQuery.validator.addMethod("greaterThan", 
        function(value, element, params) {
            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) > new Date($(params).val());
            }

            return isNaN(value) && isNaN($(params).val()) 
            || (Number(value) > Number($(params).val())); 
        },'Must be greater than {0}.');
    
    $("#step2").validate({
        rules: {
            datasetname: {
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
});