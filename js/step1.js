$(document).ready(function(){
    var storedata = $("input[name='storedata']").val();
    checkselect(storedata);
    $("input[name='storedata']").click(function(){
        checkselect(this.value);
    });
    $(".cancelLink > .cancel").live("click",function() { 
            if (confirm("Are you sure you want to cancel?")) { return true; } else { return false; } });
});

function checkselect(storedata) {
    if(storedata != 'create_newtable') {
        $(".cancel").attr('disabled', 'disabled');
    } else {
        $(".cancel").removeAttr('disabled');
    }
}