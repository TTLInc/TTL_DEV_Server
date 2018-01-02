<?php $this->layout->setLayoutData('content_for_layout_title','Edit Group Session');?>
<?php $this->layout->appendFile('javascript',"js/DateTimePicker/jquery.simple-dtpicker.js");?>
<?php if(@$errormsg):?>
 <div class="notice_4" id="errormsg">
	<span class="notice_icon"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg; ?></p>

</div>
<?php elseif(@$succrmsg):?>
	<div class="notice_4 notice_6" id="errormsg" style="background: none repeat scroll 0 0 green !important;color: #FFFFFF !important;">
	<span class="notice_icon notice_icon6"></span> 
	<a class="notice_icon6 " href="javascript:void(0);" onclick="$('#errormsg').hide()">
		
	</a>
	<p ><?php echo $succrmsg; ?></p>
</div>
<?php endif;?>
<form  autocomplete="off" method="post" action="" name="addAdform" id="adduserform" enctype="multipart/form-data">

 
    <p class="ft_title">Time</p>
	<?php $actual= strtotime($Sessions['Time']);
			$actual=$actual-(7*3600);
			$times=date( 'Y-m-d H:i:s' ,$actual); ?>
    <p class="setft"><input readonly type="text" onclick="showme();" name="Time" id="Time" value="<?php echo $times; ?>"  class="adm_box1" /></p>
	
	 <p class="ft_title">Topic</p>
    <p class="setft"><input  type="text" name="Topic" id="Topic" value="<?php echo $Sessions['Topic'];?>"  class="adm_box1" /></p>
    
	<p class="ft_title">Tutor1</p>
    <p class="setft">
     <input type="text" onkeyup="getall(this.value);"  name="tutora" id="tutora"  value="<?php echo $Sessions['tutora'];?>" class="adm_box1" />
	<input type="hidden" name="tutor1"  id="tutor1" value="<?php echo $Sessions['tutor1'];?>"> 
        
    </p><a   style="display:none;width:40px;margin-top:10px;" onclick="closeme();" id="clsme" class="button">Ok</a>
    <p class="ft_title">Tutor2</p>
    <p class="setft"><input type="text"   onkeyup="getall1(this.value);"  value="<?php  echo $Sessions['tutorb'];?>" name="tutorb" id="tutorb"   class="adm_box1" /></p>
   <input type="hidden" name="tutor2" id="tutor2" value="<?php echo $Sessions['tutor2'];?>"> 
    <p class="ft_title">Primary</p>
    <p class="setft">
		<?php echo form_dropdown('IspRIMARY',$Primary,$Sessions['isprimary'],' id="IspRIMARY" class="textarea_box"');?>
	</p>
   
   <div id="dynamic" style="width:100%;float:left;clear:both;">
					
						</div><br><br>
	 <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">Save</a>
	 <a href="<?php echo site_url('admin/ListSession')  ?>"  class="button">Close</a>
	 </p>
</form>


 

<script type="text/javascript">
function closeme()
{
	$("#clsme").css("display", "none");
}
function showme()
{
$("#clsme").css("display", "block");	
}
function getall(cnt)
{
 
var pattern = cnt;


			pattern ='sdata='+pattern;
$.ajax({
					  type:'POST',
					 dataType: 'html',
					  url:'<?php echo base_url('admin/GetTutorList');?>',
					  data:pattern,
					  success:function(msg){
					  if (String == msg.constructor)
					{
						var result;
						
						eval('result = ' + msg);
					} else {
						var result = msg;
					}
					$('#dynamic').empty();
					
					for (var i = 0;  i < (result.length); i++)
					{
					 
					var a ="<?php echo base_url('/uploads/images/thumb/');?>";
					var dimage="<?php echo base_url('images/header.jpg');?>";
					var uid=result[i]['uid'];
					var img;
					var name=result[i]['firstName']+result[i]['lastName'];
					if(result[i]['pic']=='')
					{
					  img=dimage;
					}
					else
					{
					img=a+"/"+result[i]['pic'];
					}
					var user="javascript:void(0)" ;
					$("#dynamic").append('<ul style="width:25%;max-height:205px;display:inline;clear:none;margin-bottom:20px;"><li class="myown" style="border:0px;"><p class="credit"><a href='+user+'><span class="tut-img" style="min-height:65px;"><img width="50px;" height="50px;" src='+img+'><h4>'+name+'</h4></span></a></p><p class="by-btn"><a  style="cursor:pointer;" id="'+uid+'" onclick="AddTutor(\'' + uid + '\',\'' + name + '\')">Add</a></p></li></ul>');
					
					}
										
					
					  } 
				});
}
function getall1(cnt)
{
 var pattern = cnt;
pattern ='sdata='+pattern;
$.ajax({
					  type:'POST',
					 dataType: 'html',
					  url:'<?php echo base_url('admin/GetTutorList');?>',
					  data:pattern,
					  success:function(msg){
					  if (String == msg.constructor)
					{
						var result;
						
						eval('result = ' + msg);
					} else {
						var result = msg;
					}
					$('#dynamic').empty();
					
					for (var i = 0;  i < (result.length); i++)
					{
					 
					var a ="<?php echo base_url('/uploads/images/thumb/');?>";
					var dimage="<?php echo base_url('images/header.jpg');?>";
					var uid=result[i]['uid'];
					var img;
					var name=result[i]['firstName']+result[i]['lastName'];
					if(result[i]['pic']=='')
					{
					  img=dimage;
					}
					else
					{
					img=a+"/"+result[i]['pic'];
					}
					var user="javascript:void(0)" ;
					$("#dynamic").append('<ul style="width:25%;max-height:205px;display:inline;clear:none;margin-bottom:20px;"><li class="myown" style="border:0px;"><p class="credit"><a href='+user+'><span class="tut-img" style="min-height:65px;"><img width="50px;" height="50px;" src='+img+'><h4>'+name+'</h4></span></a></p><p class="by-btn"><a  style="cursor:pointer;" id="'+uid+'" onclick="AddTutor1(\'' + uid + '\',\'' + name + '\')">Add</a></p></li></ul>');
					
					}
										
					
					  } 
				});
}
function AddTutor(id,name){

$('#tutora').val(name);
$('#tutor1').val(id);
$('#dynamic').empty();
 
}

function AddTutor1(id,name){

$('#tutor2').val(id);
$('#tutorb').val(name);
$('#dynamic').empty();
}
function checkform(){
if( $('#Time').val()==''){
		alert('Select date and time.');
		return false;;
	}
	if( $('#tutor1').val()==''){
		alert('Select tutor.');
		return false;
	}
	if( $('#Topic').val()==''){
		alert('Please enter topic.');
		return false;
	}
	$('#adduserform').submit();
}

$(function(){
				$('*[name=Time]').appendDtpicker({
					"autodateOnStart": false,
					"futureOnly": true,
					  
				});
			});
	
setTimeout('showmenu("usermenu",3)',1000);
</script>
 
		
		<style>
		.myown {
    border: 1px solid #ececec;
    display: inline;
    float: left;
    height: 155px;
    text-align: center;
    width: 164px;
}
		.credit
		{
			color: #666666;
    display: block;
    float: left;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 10pt;
    margin: 22px 0 10px;
    text-transform: uppercase;
    width: 100%;
		}
		#IspRIMARY
		{
		 height: 29px;
    width: 196px;
	 background: none repeat scroll 0 0 #f3f3f3;
		}
		.by-btn
{
  background: url("<?php echo base_url();?>images/by-btn-bg.jpg") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    color: #fff;
    display: inline-block;
    height: 28px;
    line-height: 26px;
    text-align: center;
    width: 74px;
	
}
/**
 * Style-sheet for dtpicker
 * https://github.com/mugifly/jquery-simple-datetimepicker
 */

.datepicker {
	display: inline-block;
	font: 15px/1.5 "Helvetica Neue", mplus-2c, Helvetica, Arial, "Hiragino Kaku Gothic Pro", Meiryo, sans-serif;
	font-weight: 300;
	border: 1px solid #dfdfdf;
	border-radius: 3px;
		-webkit-border-radius: 3px;  
		-moz-border-radius: 3px;
	box-shadow: 0.5px 0.5px 0px #c8c8c8;
		-webkit-box-shadow: 0.5px 0.5px 3px #eeeeee;
		-moz-box-shadow: 0.5px 0.5px 3px #eeeeee;
}

/*
 * datepicker_header
*/

.datepicker > .datepicker_header{
	padding-top:	2px;
	padding-bottom: 2px;
	padding-left:	5px;
	padding-right: 5px;
	background-color:	#eeeeee;
	color: #3f3f3f;
	text-align: center;
	font-size: 9pt;
	font-weight: bold;
	user-select: none;
		-webkit-user-select: none;
		-moz-user-select: none;
}

.datepicker > .datepicker_header > a {
	user-select: none;
		-webkit-user-select: none;
		-moz-user-select: none;
	cursor: pointer;
	color: #3b7796;
}

.datepicker > .datepicker_header > a:hover {
	color: #303030;
	background-color:	#c8c8c8;
}

.datepicker > .datepicker_header > a:active {
	color: #ffffff;
	background-color:	#808080;
}

.datepicker > .datepicker_header > span {
	margin-left: 20px;
	margin-right: 20px;
	user-select: none;
		-webkit-user-select: none;
		-moz-user-select: none;
}

.datepicker > .datepicker_header > .icon-home {
	position:	absolute;
	display:		block;
	float:		left;
	margin-top:	2px;
	margin-left:	5px;
	width:		11pt;
	height:		11pt;
	vertical-align: middle;
}

.datepicker > .datepicker_header > .icon-home > svg > g > path {
	fill: #3b7796;
}

.datepicker > .datepicker_header > a:hover > svg > g > path {
	fill: #303030; /* Icon button hover color */
}


/*
 * datepicker_inner_container 
*/

.datepicker > .datepicker_inner_container {
	margin: -2px 0px -2px 0px;
	background-color: #d2d2d2;
	border: 1px solid #c8c8c8;
	border-radius: 3px;
		-webkit-border-radius: 3px;  
		-moz-border-radius: 3px;

	box-shadow: 0.5px 0px 3px #c8c8c8;
		-webkit-box-shadow: 0.5px 0px 3px #c8c8c8;
		-moz-box-shadow: 0.5px 0px 3px #c8c8c8;
}

.datepicker > .datepicker_inner_container:after {
	content: ".";
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
}

/*
 * datepicker_inner_container > datepicker_calendar
*/

.datepicker > .datepicker_inner_container > .datepicker_calendar {
	float: left;
	width: auto;
	
	margin-top: -0.5px;
	margin-left: -1px;
	margin-bottom: -2px;
	
	background-color:	#ffffff;
	border: 1px solid #c8c8c8;
	
	border-top:none;
	border-top-left-radius: 3px;
	border-bottom-left-radius: 3px;
		-webkit-border-top-left-radius:	3px;
		-webkit-border-bottom-left-radius: 3px;
		-moz-border-radius-topleft:		3px;
		-moz-border-radius-bottomleft:	3px;
}

.datepicker > .datepicker_inner_container > .datepicker_calendar > table {
    padding: 10px;
}

/*
 * datepicker_inner_container > datepicker_calendar > datepicker_table > tbody > tr > th (WDay-cell)
*/

.datepicker > .datepicker_inner_container > .datepicker_calendar > .datepicker_table > tbody > tr > th {
	color:	#646464;
	width: 18px;
	font-size: small;
	font-weight: normal;
	text-align:center;
}

/*
 * datepicker_inner_container > datepicker_calendar > datepicker_table > tbody > tr > td (Day-cell)
*/

.datepicker > .datepicker_inner_container > .datepicker_calendar > .datepicker_table > tbody > tr > td {
	color:	#000000;
	font-size: small;
	text-align:center;
	
	user-select: none;
		-webkit-user-select: none;
		-moz-user-select: none;
	cursor: pointer;
}

.datepicker > .datepicker_inner_container > .datepicker_calendar > .datepicker_table > tbody > tr > td.today {
	border-bottom: #bfbfbf solid 2px;
	margin-bottom: -2px;
}

.datepicker > .datepicker_inner_container > .datepicker_calendar > .datepicker_table > tbody > tr > td.wday_sat {
	color:	#0044aa;
}

.datepicker > .datepicker_inner_container > .datepicker_calendar > .datepicker_table > tbody > tr > td.wday_sun {
	color:	#e13b00;
}

.datepicker > .datepicker_inner_container > .datepicker_calendar > .datepicker_table > tbody > tr > td.day_another_month {
	color:	#cccccc;
}

.datepicker > .datepicker_inner_container > .datepicker_calendar > .datepicker_table > tbody > tr > td.day_in_past {
	cursor: default;
	color: #cccccc;
}

.datepicker > .datepicker_inner_container > .datepicker_calendar > .datepicker_table > tbody > tr > td.day_in_unallowed {
	cursor: default;
	color: #cccccc;
}

.datepicker > .datepicker_inner_container > .datepicker_calendar > .datepicker_table > tbody > tr > td.out_of_range {
	cursor: default;
	color: #cccccc;
}

.datepicker > .datepicker_inner_container > .datepicker_calendar > .datepicker_table > tbody > tr > td.active {
	color: #ffffff;
	background-color:	#808080;
}

.datepicker > .datepicker_inner_container > .datepicker_calendar > .datepicker_table > tbody > tr > td.hover {
	color: #000000;
	background-color:	#c8c8c8;
}

/*
 * datepicker_inner_container > datepicker_timelist
*/

.datepicker > .datepicker_inner_container > .datepicker_timelist {
	float: left;
	width: 4.2em;
	height: 118px;
	
	margin-top: -0.5px;
	padding: 5px;
	padding-left: 0px;
	padding-right: 0px;
	
	overflow: auto;
	overflow-x: hidden; 
	
	background-color:	#ffffff;
	
	border-top-right-radius: 3px;
	border-bottom-right-radius: 3px;
	-webkit-border-top-right-radius:	3px;
	-webkit-border-bottom-right-radius: 3px;
	-moz-border-radius-topright:		3px;
	-moz-border-radius-bottomright:	3px;
}

/*
.datepicker > .datepicker_inner_container > .datepicker_timelist::after {
	content: ".";
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
}
*/

.datepicker > .datepicker_inner_container > .datepicker_timelist::-webkit-scrollbar {
	overflow: hidden;
	width: 6px;
	background: #fafafa;
	
	border-top-right-radius: 3px;
	border-bottom-right-radius: 3px;
	-webkit-border-top-right-radius:	3px;
	-webkit-border-bottom-right-radius: 3px;
	-moz-border-radius-topright:		3px;
	-moz-border-radius-bottomright:	3px;
}

.datepicker > .datepicker_inner_container > .datepicker_timelist::-webkit-scrollbar:horizontal {
	height: 1px;
}

.datepicker > .datepicker_inner_container > .datepicker_timelist::-webkit-scrollbar-button {
	display: none;
}

.datepicker > .datepicker_inner_container > .datepicker_timelist::-webkit-scrollbar-piece {
	background: #eee;
}

.datepicker > .datepicker_inner_container > .datepicker_timelist::-webkit-scrollbar-piece:start {
	background: #eee;
}

.datepicker > .datepicker_inner_container > .datepicker_timelist::-webkit-scrollbar-thumb {
	background: #aaaaaa;
	border-radius: 3px;
		-webkit-border-radius: 3px;  
		-moz-border-radius: 3px;
}

.datepicker > .datepicker_inner_container > .datepicker_timelist::-webkit-scrollbar-corner {
	background: #333;
}

.datepicker > .datepicker_inner_container > .datepicker_timelist > div.timelist_item {
	padding-top:   1px;
	padding-bottom:1px;
	padding-left:  7px;
	padding-right: 25px;
	margin-top: 5px;
	margin-bottom: 2px;
	font-size: small;
	
	user-select: none;
		-webkit-user-select: none;
		-moz-user-select: none;
	cursor: pointer;
}

.datepicker > .datepicker_inner_container > .datepicker_timelist > div.timelist_item.time_in_past {
	cursor: default;
	color: #cccccc;
}

.datepicker > .datepicker_inner_container > .datepicker_timelist > div.timelist_item.out_of_range {
	cursor: default;
	color: #cccccc;
}
.datepicker > .datepicker_inner_container > .datepicker_timelist > div.timelist_item.active {
	color: #ffffff;
	background-color:	#808080;
}

.datepicker > .datepicker_inner_container > .datepicker_timelist > div.timelist_item.hover {
	color: #000000;
	background-color:	#c8c8c8;
}

</style>
</body>
</html>