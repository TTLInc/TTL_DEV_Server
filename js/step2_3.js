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
});