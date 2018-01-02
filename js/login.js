$(document).ready(function(){
    $("#loginfrm").validate({
        rules: {
            user_name: {
                required: true
            },
            user_pass: {
                required: true
            }
        },
        message: {
            user_name: {
                required: "Please Enter your Name"
            },
            user_pass: {
                required: "Please Enter Email Address"
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo('#Err' + element.attr('id'));
        }
    });
});