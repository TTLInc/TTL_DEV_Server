
 $(document).ready(function() {
    $('.homeimg img').each(function(intIndex) {
        var url = $(this).attr('src');
        $(this).bind (
            "click",
            function(){
                alert( "Image Url is :  " + url );
            }
         );
       }
    );
});

function validation() {
    $("#contactusfrm").validate({
        rules: {
            fname: {
                required: true
            },
            e_mail: {
                required: true,
                email: true
            },
            vPhone: {
                required: true,
                digits: true,
                maxlength: 12,
                minlength: 9
            },
            vComment: {
                required: true
            }
        },
        message: {
            fname: {
                required: "Please Enter your Name"
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo('#Err' + element.attr('id'));
        }
    });
}
