$(document).ready(function(){
    $(".cancelLink > .cancel").live("click",function() { 
            if (confirm("Are you sure you want to cancel?")) { return true; } else { return false; } });
});