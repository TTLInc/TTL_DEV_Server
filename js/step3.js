$(document).ready(function(){
    $("#step3").validate({
        rules: {
            'new_tags': {
                required: true
            },
            'links_url': {
                required: true,
                url : true
            }
        },
        message: {
            'new_tags': {
                required: "Please Select Tags"
            }
        },
        errorPlacement: function(error, element) {
            error.appendTo('#' + element.attr('id') + "Err");
        }
    });
    
    $("#new_tags").change( function() {
        var val = $(this).val();
        if( val == 'others') {
            $("#other_new_tags").show();
        }else{
            $("#other_new_tags").hide();
        }   
    });
    
    $("a[class^='edit_tags']").click( function() {
        var rec_no = $(this).attr('alt');
        $(this).hide();
        $(".label_tags_" + rec_no).hide();
        $(".tags_" + rec_no).show();
        $(".update_tags_" + rec_no).show();
    });
    $("a[class^='update_tags_']").click( function() {
        var rec_no = $(this).attr('alt');
        $(this).hide();
        $(".label_tags_" + rec_no).show();
        $(".tags_" + rec_no).hide();
        $(".edit_tags_" + rec_no).show();
    });
    $("a[class^='update_tags_']").click( function() {
        var rec_no = $(this).attr('alt');
        $(this).hide();
        $(".label_tags_" + rec_no).html($(".tags_" + rec_no).val());
        $(".label_tags_" + rec_no).show();
        $(".tags_val_" + rec_no).val($(".tags_" + rec_no).val());
        $(".tags_" + rec_no).hide();
        $(".edit_tags_" + rec_no).show();
    });
    $("a[class^='delete_tags_']").click( function() {
        var con_msg = confirm('Are you sure to delete this tags?');
        if(con_msg) {
            $(this).parent().remove();
        }else{
            return false;
        }
    });
    
    $("a[class^='edit_links']").click( function() {
        var rec_no = $(this).attr('alt');
        $(this).hide();
        $(".label_links_" + rec_no).hide();
        $(".links_" + rec_no).show();
        $(".update_links_" + rec_no).show();
    });
    $("a[class^='update_links_']").click( function() {
        var rec_no = $(this).attr('alt');
        $(this).hide();
        $(".label_links_" + rec_no).show();
        $(".links_" + rec_no).hide();
        $(".edit_links_" + rec_no).show();
    });
    $("a[class^='update_links_']").click( function() {
        var rec_no = $(this).attr('alt');
        $(this).hide();
        $(".label_links_" + rec_no).html($(".links_" + rec_no).val());
        $(".label_links_" + rec_no).show();
        $(".links_val_" + rec_no).val($(".links_" + rec_no).val());
        $(".links_" + rec_no).hide();
        $(".edit_links_" + rec_no).show();
    });
    $("a[class^='delete_links_']").click( function() {
        var con_msg = confirm('Are you sure to delete this links?');
        if(con_msg) {
            $(this).parent().remove();
        }else{
            return false;
        }
    });
    $(".cancelLink > .cancel").live("click",function() { 
            if (confirm("Are you sure you want to cancel?")) { return true; } else { return false; } });
});