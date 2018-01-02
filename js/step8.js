$(document).ready(function(){
    checkselect();
    $(".csv_chk").click(function(){
        checkselect();
    });
    $("#chkmst").live("click",function() { $(".csv_chk").each(function() { (this.checked = $("#chkmst").attr("checked")); }) });
    $(".cancelLink > .cancel").live("click",function() { 
            if (confirm("Are you sure you want to cancel?")) { return true; } else { return false; } });
});

function checkselect() {
    var csv_chk_length = $(".csv_chk:checked").length;
    if(csv_chk_length > 0) {
        $(".Next").removeAttr('disabled');
    } else {
        $(".Next").attr('disabled', 'disabled');
    }
}