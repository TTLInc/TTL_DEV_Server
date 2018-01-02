// Threedots jQuery plugin from http://plugins.jquery.com/project/ThreeDots and http://tpgblog.com/threedots/
(function(e){e.fn.ThreeDots=function(h){var g=this;if((typeof h=="object")||(h==undefined)){e.fn.ThreeDots.the_selected=this;var g=e.fn.ThreeDots.update(h)}return g};e.fn.ThreeDots.update=function(u){var k,t=null;var m,j,s,q,o;var l,i;var r,h,n;if((typeof u=="object")||(u==undefined)){e.fn.ThreeDots.c_settings=e.extend({},e.fn.ThreeDots.settings,u);var p=e.fn.ThreeDots.c_settings.max_rows;if(p<1){return e.fn.ThreeDots.the_selected}var g=false;jQuery.each(e.fn.ThreeDots.c_settings.valid_delimiters,function(v,w){if(((new String(w)).length==1)){g=true}});if(g==false){return e.fn.ThreeDots.the_selected}e.fn.ThreeDots.the_selected.each(function(){k=e(this);if(e(k).children("."+e.fn.ThreeDots.c_settings.text_span_class).length==0){return true}l=e(k).children("."+e.fn.ThreeDots.c_settings.text_span_class).get(0);var y=a(k,true);var x=e(l).text();d(k,l,y);var v=e(l).text();if((h=e(k).attr("threedots"))!=undefined){e(l).text(h);e(k).children("."+e.fn.ThreeDots.c_settings.e_span_class).remove()}r=e(l).text();if(r.length<=0){r=""}e(k).attr("threedots",x);if(a(k,y)>p){curr_ellipsis=e(k).append('<span style="white-space:nowrap" class="'+e.fn.ThreeDots.c_settings.e_span_class+'">'+e.fn.ThreeDots.c_settings.ellipsis_string+"</span>");while(a(k,y)>p){i=b(e(l).text());e(l).text(i.updated_string);t=i.word;n=i.del;if(n==null){break}}if(t!=null){var w=c(k,y);if((a(k,y)<=p-1)||(w)||(!e.fn.ThreeDots.c_settings.whole_word)){r=e(l).text();if(i.del!=null){e(l).text(r+n)}if(a(k,y)>p){e(l).text(r)}else{e(l).text(e(l).text()+t);if((a(k,y)>p+1)||(!e.fn.ThreeDots.c_settings.whole_word)||(v==t)||w){while((a(k,y)>p)){if(e(l).text().length>0){e(l).text(e(l).text().substr(0,e(l).text().length-1))}else{break}}}}}}}if(x==e(e(k).children("."+e.fn.ThreeDots.c_settings.text_span_class).get(0)).text()){e(k).children("."+e.fn.ThreeDots.c_settings.e_span_class).remove()}else{if((e(k).children("."+e.fn.ThreeDots.c_settings.e_span_class)).length>0){if(e.fn.ThreeDots.c_settings.alt_text_t){e(k).children("."+e.fn.ThreeDots.c_settings.text_span_class).attr("title",x)}if(e.fn.ThreeDots.c_settings.alt_text_e){e(k).children("."+e.fn.ThreeDots.c_settings.e_span_class).attr("title",x)}}}})}return e.fn.ThreeDots.the_selected};e.fn.ThreeDots.settings={valid_delimiters:[" ",",","."],ellipsis_string:"...",max_rows:2,text_span_class:"ellipsis_text",e_span_class:"threedots_ellipsis",whole_word:true,allow_dangle:false,alt_text_e:false,alt_text_t:false};function c(k,h){if(e.fn.ThreeDots.c_settings.allow_dangle==true){return false}var l=e(k).children("."+e.fn.ThreeDots.c_settings.e_span_class).get(0);var g=e(l).css("display");var i=a(k,h);e(l).css("display","none");var j=a(k,h);e(l).css("display",g);if(i>j){return true}else{return false}}function a(i,j){var g=typeof j;if((g=="object")||(g==undefined)){return e(i).height()/j.lh}else{if(g=="boolean"){var h=f(e(i));return{lh:h}}}}function b(k){var j;var i=e.fn.ThreeDots.c_settings.valid_delimiters;k=jQuery.trim(k);var g=-1;var h=null;var l=null;jQuery.each(i,function(m,o){if(((new String(o)).length!=1)||(o==null)){return false}var n=k.lastIndexOf(o);if(n!=-1){if(n>g){g=n;h=k.substring(g+1);l=o}}});if(g>0){return{updated_string:jQuery.trim(k.substring(0,g)),word:h,del:l}}else{return{updated_string:"",word:jQuery.trim(k),del:null}}}function f(h){e(h).append("<div id='temp_ellipsis_div' style='position:absolute; visibility:hidden'>H</div>");var g=e("#temp_ellipsis_div").height();e("#temp_ellipsis_div").remove();return g}function d(k,l,m){var q=e(l).text();var i=q;var o=e.fn.ThreeDots.c_settings.max_rows;var h,g,n,r,j;var p;if(a(k,m)<=o){return}else{p=0;curr_length=i.length;curr_middle=Math.floor((curr_length-p)/2);h=q.substring(p,p+curr_middle);g=q.substring(p+curr_middle);while(curr_middle!=0){e(l).text(h);if(a(k,m)<=(o)){j=Math.floor(g.length/2);n=g.substring(0,j);p=h.length;i=h+n;curr_length=i.length;e(l).text(i)}else{i=h;curr_length=i.length}curr_middle=Math.floor((curr_length-p)/2);h=q.substring(0,p+curr_middle);g=q.substring(p+curr_middle)}}}})(jQuery);

var MEDO_HOST = "http://www.macmillandictionary.com/"; //"http://localhost:8080/medo2free-skdico4/";
var MEDO_MEDIA_PATH = MEDO_HOST + "external/images/buzzword/";
var MEDO_CURBOX_TYPE = null;
var MEDO_CSS_PROP = { smallbox: "width:130px;",
                      mediumbox: "width:300px;",
                      box: "border:0px solid #AAA; font-family:Arial,Helvetica,sans-serif; color:#666; font-size:120%; margin-bottom:4em;",
                      smallbox_container: "margin:5px;",
                      mediumbox_container: "margin:7px;",
                      smallbox_buzzword: "width:120px; height:31px; background-image: url('" + MEDO_MEDIA_PATH + "buzzword_small.gif');",
                      mediumbox_buzzword: "width:150px; height:39px; background-image: url('" + MEDO_MEDIA_PATH + "buzzword_medium.gif');",
                      smallbox_logo: "display:block; width:80px; height:19px; background-image: url('" + MEDO_MEDIA_PATH + "logo_small.gif');",
                      mediumbox_logo: "display:block; width:100px; height:24px; background-image: url('" + MEDO_MEDIA_PATH + "logo_medium.gif');",
                      h2: "font-size:1em; color:#666; margin:10px 0 0 0; padding:4px; border-top:1px solid #C40000; border-bottom:1px solid #C40000;",
                      definition: "font-size:.9em; line-height:1.2em; margin:0 0 5px 0; padding:4px; border-bottom:1px solid #AAA; background-color:#EEE;",
                      wordlist: "list-style-type:none; margin: 0 0 10px 0; padding:0;",
                      wordlistitem: "line-height:1em; margin:0 0 5px 0; padding:0;",
                      wordlink: "font-size:.9em; color:#666;",
                      morelink: "color: #C40000;"
                    };

function displayBuzzword(data, boxType) {
    var baseUrl = MEDO_HOST + "/buzzword/entries";
    var currentWord, currentId;

    currentId = data["current_buzzword"][0];
    currentWord = data["current_buzzword"][1];

    var html = "<div style=\"" + MEDO_CSS_PROP[MEDO_CURBOX_TYPE + '_container'] + "\">" +
               "<div style=\"" + MEDO_CSS_PROP[MEDO_CURBOX_TYPE + '_buzzword'] + "\"></div>" +
               "<h2 style=\"" + MEDO_CSS_PROP.h2 + "\">" + currentWord + "</h2>" +
               "<div class=\"def\" style=\"" + MEDO_CSS_PROP.definition + "\"><span class=\"ellipsis_text\">" + data["current_buzzword_definition"] + "</span>" +
    		   "</div>";
    
    var previousBw = data["previous"];
    var words = "";
    var word, id;

    for (var i = 0; i <  previousBw.length ; i++) {
        id = previousBw[i][0];
        word = previousBw[i][1];
        words += "<li style=\"" + MEDO_CSS_PROP.wordlistitem + "\"><a href=\"" + baseUrl + "/" + id + "\" style=\"" + MEDO_CSS_PROP.wordlink + "\" target=new>" + word + "</a></li>";
    }
    
    html += "<ul style=\"" + MEDO_CSS_PROP.wordlist + "\">" + words + "</ul>";
    html += "<a href=\"" + MEDO_HOST + "\" style=\"" + MEDO_CSS_PROP[MEDO_CURBOX_TYPE + '_logo'] + "\" target=new></a>";
    html += "</div>";
    jQuery("#medo_buzzword").html(html);
    jQuery("#medo_buzzword .def").ThreeDots({ max_rows: 3 });
    jQuery("#medo_buzzword .def").append("<br/><a href=\"" + baseUrl + "/" + currentId + "\" style=\"" + MEDO_CSS_PROP.morelink + "\" target=new>more</a>");
}
function setupBuzzword(boxType) {
    var bzContainer = jQuery("#medo_buzzword");
    bzContainer.attr("style", MEDO_CSS_PROP[boxType] + MEDO_CSS_PROP.box);
    bzContainer.html("Loading...");
    MEDO_CURBOX_TYPE = boxType; 
    jQuery.getJSON(MEDO_HOST + "/buzzword/buzzword.json?callback=?");
}
jQuery.noConflict();
;
jQuery(function() { setupBuzzword("mediumbox") });
