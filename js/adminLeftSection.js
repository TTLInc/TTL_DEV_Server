$(document).ready(function(){
    $('.adm_main_nav li p').click(function(){
        $('.adm_main_nav li ul').each(function(k,j){
            if($(j).css("display") == "block"){
                $(j).slideToggle("fast");
            }
        });
        if($(this).next('ul').css("display") != "block"){
            $(this).next('ul').slideToggle("fast");
        }
    });
});

function showmenu(menu,submenu){    
    
    $("#"+menu+" p a").click();
    $("#"+menu+" p").addClass('current');
    $("#"+menu+" ul li").eq(submenu).addClass('current');
}

function showSucc(container,msg){
    
    html = "";
    html += '<div class="notice_3"><span class="notice_icon"></span> <a href="javascript:void(0);" onclick="$(\'.notice_3\').hide()" class="close"><img src="../assets/images/cross_grey_small.png"></a>';
    html += '<p>';
    html += msg;
    html += '</p>';
    html += '</div>';
    
    $("#"+container).append(html);
    
}

function showFail(container,msg){
    
    html = "";
    html += '<div class="notice_4"><span class="notice_icon"></span> <a href="javascript:void(0);" onclick="$(\'.notice_4\').hide()" class="close"><img src="../assets/images/cross_grey_small.png"></a>';
    html += '<p>';
    html += msg;
    html += '</p>';
    html += '</div>';
    
    $("#"+container).append(html);
    
}