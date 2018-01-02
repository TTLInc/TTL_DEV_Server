$(document).ready(function(){
    $("#step3").validate({
        rules: {
            'tags[]': {
                required: true
            }
        },
        message: {
            'tags[]': {
                required: "Please Enter Tags"
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo('#' + element.attr('id') + "Err");
        }
    });
});