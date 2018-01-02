<?php
$multi_lang = 'en';
if(!isset($_SESSION)) {
	session_start();
}
if(isset($_SESSION['multi_lang'])){
	$multi_lang = $_SESSION['multi_lang'];
}else{
	$multi_lang = 'en';	
}
$this->load->model(array('lookup_model'));
$arrVal 		= $this->lookup_model->getValue('200', $multi_lang);
$lpurchasedlesson	= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('201', $multi_lang);
$lremovevideo		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('202', $multi_lang);
$lrecorded		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('203', $multi_lang);
$llength		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('87', $multi_lang);
$ldescription 		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('325', $multi_lang);
$plessonstxt 		= $arrVal[$multi_lang];

$arrVal 		= $this->lookup_model->getValue('1403', $multi_lang);
$PVIDEO 		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('323', $multi_lang);
$vsearch 		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('957', $multi_lang);
$yougoto 		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('958', $multi_lang);
$findexp 		= $arrVal[$multi_lang];

/* Teacher Profile */
$arrVal = $this->lookup_model->getValue('85', $multi_lang);
$llesson = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('86', $multi_lang);
$llesson_text = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('47', $multi_lang);
$lprice = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('87', $multi_lang);
$ldescription = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('88', $multi_lang);
$lrecorded = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('89', $multi_lang);
$llength = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('90', $multi_lang);
$lnewprice = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('92', $multi_lang);
$lsetprice = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('243', $multi_lang);
$ldelete = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('91', $multi_lang);
$llesson_name = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('93', $multi_lang);
$ladd = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('94', $multi_lang);
$laddmore = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('893', $multi_lang);
$vsale = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1055', $multi_lang);
$UplodedVideo = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('442', $multi_lang);
$UpVideo = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1297', $multi_lang);
$lngvidUploadedMsg = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1298', $multi_lang);
$lngvidUploadedSuccMsg = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1403', $multi_lang);
$myvideos = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1411', $multi_lang);	$shareyourexperience   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1412', $multi_lang);	$interestingvideoon   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1413', $multi_lang);	$wordorphrase   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1414', $multi_lang);	$minutemax   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1410', $multi_lang);	$eachuploadcontribute   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1409', $multi_lang);	$enterphrase   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1408', $multi_lang);	$definition   		= $arrVal[$multi_lang];

/* For Student */
$this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js");
$this->layout->appendFile('javascript',"js/fullCalendar.js");
$this->layout->appendFile('javascript',"js/calendar.js");
/* End */

$this->layout->appendFile('javascript',"js/jquery-jtemplates.js");
$this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");
$this->layout->appendFile('javascript',"js/projekktor-1.1.00r107.min.js");
$this->layout->appendFile('css',"css/palyerTheme/style.css");
$this->layout->appendFile('css',"css/video_search.css");
/* For Teacher Private */
$this->layout->appendFile('css',"css/cupertino/theme.css");
/* End */
?>
<div class="baseBox baseBoxBg clearfix">
<div class="content_main fr">
<div class="main_inner">
<!--/student_prof-->
<div id="student_prof_Wp">
<div class="hd clearfix">
<div class="content tle" style="padding-top:0px;">
<h2><?php echo $myvideos;?></h2>
<div class="upload_video_right clearfix">
<?php echo $shareyourexperience;?> <br>
<span>1</span> <?php echo $interestingvideoon; ?> <span>1</span> <?php echo $wordorphrase; ?> <span>1</span> <?php echo $minutemax; ?>
<br>
<br>
</div>
</div>
<div class="bd" id="player_b">
</div>

</div>
<div class="addBtn_Wp upload_190516"><a class="redRadiusBtn2 video_popup190516_open w96" href="#video_popup190516" onclick="addLessons()" id="addmorelesson" alt="1min max in MP4 or MOV format." title="1min max in MP4 or MOV format.">Upload</a></div>


<div class="upload_popup_main_190516" id="video_popup190516">
<div class="popup_close_icon_190516"><a class="video_popup190516_close" href="#" onclick="distroyform();"></a></div>


<div class="mod">

<div class="bd">
<ul class="archivedList lessonsList">

<li class="addnewTemplate" style="display:none">


<div class="video_pic_intro c666">
<div class=" clearfix">
<h3 class="selectlang230516"><span><strong> <?php echo "Language";?>:</strong></span>
<select class="lesson_language" placeholder="<?php echo $llesson_name;?>">
<option value="1">English</option>
<option value="2">Español</option>
<option value="3">Français</option>
<option value="4">简体中文</option>
<option value="5">繁體中文</option>
<option value="6">日本語</option>
<option value="7">한국어</option>
<option value="8">Português</option>
</select>
</h3>
<h3 class="selectlang230516"><span><strong> <?php echo $enterphrase;?>:</strong></span>
<input type="text" class="lesson_name" placeholder="<?php echo $enterphrase;?>">
</h3>
</div>
<div class="archived_desc"> <strong><?php echo $definition;?>: </strong> <br/>
<textarea class="lesson_desc" cols="50" rows="4"> </textarea>
</div>
<div class="archived_info clearfix">

</div>
</div>
<div class="video_pic_163x90 posR fl">
<a href="#">
<img src="<?php echo Base_url('images/clicktoupload.jpg');?>" width="140" height="120" class="successgreen"/>

<div class="nick_name tl-nw-btn"  style="display:none"><span></span></div>
</a>

<a href="#" class="upload_hdpic upload_videopic" ><?php echo "Choose File"."<br>"."(mp4, mov)";?></a>
</div>
<div class="addBtn_Wp"> <a href="javascript:void(0)" class="addmore_v_btn redRadiusBtn2 w96 doAddLesson video_popup190516_close"><?php echo "Submit";?></a> </div>
<div class="set_price">

<input type="hidden" value="0" class="lesson_id"/>

</div>
</li>
<li class="editnewTemplate" style="display:none">
<div class="video_pic_intro c666">
<div class=" clearfix">
<h3 class="selectlang230516"><span><strong> <?php echo "Language";?>:</strong></span>
<select class="lesson_language" placeholder="<?php echo $llesson_name;?>">
<option value="1">English</option>
<option value="2">Español</option>
<option value="3">Français</option>
<option value="4">简体中文</option>
<option value="5">繁體中文</option>
<option value="6">日本語</option>
<option value="7">한국어</option>
<option value="8">Português</option>
</select>
</h3>
<h3 class="selectlang230516"><span><strong> <?php echo "Phrase";?>:</strong></span>
<input type="text" class="lesson_name" placeholder="<?php echo "Phrase";?>">
</h3>
</div>
<div class="archived_desc"> <strong><?php echo "Definition";?>: </strong> <br/>
<textarea class="lesson_desc" cols="50" rows="4"> </textarea>
</div>
<div class="archived_info clearfix">
</div>
</div>
<div class="video_pic_163x90 posR fl">
<a href="#">
<img src="<?php echo Base_url('images/clicktoupload.jpg');?>" width="140" height="120" class="successgreen"/>
<div class="nick_name tl-nw-btn"  style="display:none"><span></span></div>
</a>
<input type='file'>

<a href="javascript:void(0)" class="upload_hdpic upload_videopic" ><?php echo "Choose File"."<br>"."(mp4, mov)";?></a>

</div>
<div class="addBtn_Wp"> <a href="javascript:void(0)" class="addmore_v_btn redRadiusBtn2 w96 doAddLesson video_popup190516_close"><?php echo "Submit";?></a> </div>
<div class="set_price">

<input type="hidden" value="0" class="lesson_id"/>

</div>
</li>
<!--Add Video Template-->
</ul>
</div>
<!--Video Listing-->
<!--Add Video-->
</div>
</div>
<div class="bd" id="player_b">
<div class="video_Wp posR projekktor" id="player_a">
<a class="upload_hdpic upload_videopic" id="profile_vedio_upload" href="javascript:void(0)" > </a>
</div>
</div>


<div class="eachupload">Each upload contributes to the community and shows why they should book you.</div>



<div class="video_3colum_main_230516 cf">
<ul class="cf">
<?php foreach($lessonsforsale as $k=>$lesson):?>
<li><div class="video_block230516_main01 cf">
<?php
$filename = "http://52.8.248.161/uploads/video/".$lesson['source'].".jpg";
$size = getimagesize($filename);
if($size[1] > $size[0]){
?>
<div class="video_block230516_left02">
<?php
}else{
?>
<div class="video_block230516_left01">
<?php
}
?>
<dl source="<?php echo 'http://52.8.248.161/uploads/video/'.$lesson['source'];?>" class="showVideo">
<?php
$filename = "uploads/video/images/".$lesson['source'].".jpg";
if (file_exists($filename)) {
?>
<img src="<?php echo "http://52.8.248.161/uploads/video/images/".$lesson['source'].".jpg";?>" width="200px">
<?php
}else{
?>
<img src="<?php echo "http://52.8.248.161/uploads/video/".$lesson['source'].".jpg";?>" width="200px">
<?php } ?>
</dl></div>
<div class="video_block230516_right01">
<h2><a class="redRadiusBtn2 video_popup190516_open w96" href="#video_popup190516" onclick="editLessons(<?php echo $lesson['id'];?>)" id="addmorelesson" alt="" title=""><?php echo $lesson['name'];?></a></h2>
<div class="video_like01 cf">
<img alt="" src="<?php echo base_url("images/thumb-up.png");?>">
<span><?php echo $lesson['likes'];?></span>
</div>
<div class="video_like01 cf">
<img alt="" src="<?php echo base_url("images/filesq-viewer-icon.png");?>">
<span><?php echo $lesson['views'];?></span>
<input type="hidden" value="<?php echo $lesson['id'];?>" id="lessonID1"/>
</div>
</div>
</div>
<div class="close_icon230516"><a class="deleteLesson" href="javascript:void(0)" mid="<?php echo $lesson['id']; ?>" ><span lessonID='<?php echo $lesson['id'];?>'> <img alt="" src="<?php echo base_url("images/video-close-btn_30.png");?>"></span></a></div>
</li>
<?php endforeach;?>
</ul>
</div>
</div>
<!--/student_prof_Wp-->





<!--/teacher_prof-->
<div id="teacher_prof_Wp" style="margin-top:25px !important;">
<!--R&D@Dec-05 Added Video-->
<div class="video_Wp posR "  id="player_b">
<div class="projekktor" id="player_a"></div>
</div>
<!--R&D@Dec-05 Added Video-->

<!--/mod-->
</div>
<!--/teacher_prof_Wp-->

</div>
</div>
<!--/content_main-->
<?php include dirname(__FILE__).'/../leftSide.php';?>
</div>
<textarea id="calendarTemp" style="display:none"  rows="0" cols="0">

</textarea>
<textarea  id="lessonListTemp" style="display:none"  rows="0" cols="0">

</textarea>
<textarea id="eventDialogTemplate" style="display:none"  rows="0" cols="0">

</textarea>
<div id="dialog1" title="Upload Video" style="display:none">
<?php echo $lngvidUploadedSuccMsg;?>
</div>
<div id="dialog2" title="Edit Upload Video" style="display:none">
<?php echo "Thank you for editing and that the video needs to be re-approved.";?>
</div>
<script>
function distroyform(){
	$('.addNewLesson').hide();
	$(".successgreen").attr("src", "<?php echo base_url("images/clicktoupload.jpg")?>");
}

function testlink(){
	var _temp 	= $('.addnewTemplate').clone();
	_temp 		= $(_temp).removeClass('addnewTemplate').addClass('addNewLesson').show();
	$('.lessonsList').append(_temp);
	var _index = _temp.index();
	_temp.attr('index',_index);
	buttons[_index] = _temp.find('.upload_hdpic');
	intervals[_index] = '';
	addRows[_index] = _temp;
	new AjaxUpload(buttons[_index],{
		action: '<?php echo Base_url('user/lesson_video');?>', 
		enable:true,
		type:'video/*,video/mp4,video/3gpp,video/rm,video/avi,video/wma,video/rmvb,video/wmv,video/mov,video/MOV',
		name: 'userfile',
		onSubmit : function(file, ext){
			if(typeof(this._input.files[0])!='undefined' && typeof(this._input.files[0].size)!='undefined'){
				if(this._input.files[0].size > 52428800){
					alert('Filesize too large, please use a video less than 50mb.  Converting to MP4 can reduce filesize considerably.');
					return false;
				}
			}
			var _lesson_id = addRows[_index].find('.lesson_id').val();
			this.setData ({lesson_id:_lesson_id});
			var _showText = addRows[_index].find('.nick_name').show();
			_showText.text('Uploading');//$( "#dialog p").html('Uploading.');
			_showText.attr('buttontype','doing');
			this.disable();
		},
		onComplete: function(file, response){
			console.log(response);
			var _showText = addRows[_index].find('.nick_name');
			_showText.text('Uploaded');
			_showText.attr('buttontype','done');
			this.enable();
			try{
				if (String == response.constructor) {      
					eval ('var response = ' + response);
				} 
			}catch(e){

			}
			if(response.error){
				$("#dialog").html('Uploading error.'+response.error);
				$("#dialog").dialog({
					modal: true,
					show: "blind",
					hide: "explode"
				});
				return;
			}
			addRows[_index].find('.lesson_id').val(response.lesson_id);
			addRows[_index].data('videoUploaded',true);
			_showText.hide(3000);
			$(".successgreen").attr("src", "<?php echo base_url("images/green_check_mark.png")?>");
		}
	});

	_temp.find('.doAddLesson').click(function(){
		var _data = {};
		var _button = $(this);
		var _li = $(this).parents('li.addNewLesson');
		_data['id'] = _li.find('.lesson_id').val();
		_data['name'] = _li.find('.lesson_name').val();
		_data['desc'] = _li.find('.lesson_desc').val();
		_data['price'] = _li.find('.price').val();
		if(_data['name'] == null||_data['name'] == ''){
			alert('Oops, you are missing something. All fields are required.');
			return false;
		}
		//hacks for check
		if(_li.data('videoUploaded')!=true){
			$('#dialog').html('You must upload video first!');
			$( "#dialog" ).dialog({
				modal: true,
				show: "blind",
				hide: "explode"
			});
			return false;
		}
		if(_button.attr('buttontype') == 'doing'){
			return false;
		}
		_button.html('Updating');
		_button.attr('buttontype','doing');
		$.post('<?php echo base_url("user/updateLession");?>',_data,function(msg) {
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			console.log(json);
			if(json.status == true || json.status == 'true'){
				$('#dialog1').dialog({
					modal:true,
					buttons: {
					"Ok": function() {
							console.info(json);
							container = $('<div></div>').setTemplateElement('lessonListTemp').processTemplate(json.lesson);
							$('.lessonsList').append(container.children());
							_li.remove();
							$( this ).dialog( "close" );
							window.location.replace("https://www.thetalklist.com/en/user/lessons/");
						}
					}
				});
			}else {
				$('#dialog').html(json.msg).dialog({modal: true});
			}
			_button.attr('buttontype','done').html('Add');
		});
	});

}

var intervals 	= {};
var buttons 	= {};
var addRows 	= {};
//--------Upload Video-----//
function addLessons(){
	var _temp 		= $('.addnewTemplate').clone();
	
	_temp 			= $(_temp).removeClass('addnewTemplate').addClass('addNewLesson').show();
	$('.lessonsList').append(_temp);
	
	var _index 		= _temp.index();
	_temp.attr('index',_index);
	
	buttons[_index] 	= _temp.find('.upload_hdpic');
	intervals[_index] 	= '';
	addRows[_index] 	= _temp;
	
	new AjaxUpload(buttons[_index],{
		action: '<?php echo Base_url('user/lesson_video');?>', 
		enable:true,
		type:'video/mp4,video/MOV,video/mov,video/MP4',
		name: 'userfile',
		onSubmit : function(file, ext){
			if(ext == 'avi' || ext =='flv' || ext =='swf' || ext =='rm' || ext =='wma' || ext =='3gp' || ext =='wmv'){
				alert('File Type is not valid. Please upload mov or mp4 video only.');
				return false;
			}
			if(typeof(this._input.files[0])!='undefined' && typeof(this._input.files[0].size)!='undefined'){
				if(this._input.files[0].size > 52428800){
					alert('Filesize too large, please use a video less than 50mb. Converting to MP4 can reduce filesize considerably.');
					return false;
				}
			}
			var _lesson_id = addRows[_index].find('.lesson_id').val();
			console.info(_lesson_id);


			this.setData ({lesson_id:_lesson_id});
			var _showText = addRows[_index].find('.nick_name').show();
				_showText.text('Uploading');
				_showText.attr('buttontype','doing');
				this.disable();
		},
		onComplete: function(file, response){
			console.info(response);
			try{
				if (String == response.constructor) {      
					eval ('var response = ' + response);
				} 
			}catch(e){
			
			}	
			if(response.message == false){
				alert('Video is bigger than 1 minute. Please upload video which is less than 1 minute.');
				var _showText = addRows[_index].find('.nick_name');
				_showText.text('');
				_showText.attr('buttontype','done');
				return false;
			}
			var _showText = addRows[_index].find('.nick_name');
			_showText.text('Uploaded');
			_showText.attr('buttontype','done');
			this.enable();
			if(response.error){
				$("#dialog").html('Uploading error.'+response.error);
					$("#dialog").dialog({
						modal: true,
						show: "blind",
						hide: "explode"
					});
				return;
			}
				addRows[_index].find('.lesson_id').val(response.lesson_id);
				addRows[_index].data('videoUploaded',true);
				_showText.hide(3000);
				$(".successgreen").attr("src", "<?php echo base_url("images/green_check_mark.png")?>");
				console.info(response);
			}
	});

	_temp.find('.doAddLesson').click(function(){
		var _data = {};
		var _button = $(this);
		var _li = $(this).parents('li.addNewLesson');
		_data['id'] = _li.find('.lesson_id').val();
		_data['name'] = _li.find('.lesson_name').val();
		_data['language'] = _li.find('.lesson_language').val();
		_data['desc'] = _li.find('.lesson_desc').val();
		_data['price'] = _li.find('.price').val();
		
		console.info(_data);
		
		
		if(_data['name'] == null||_data['name'] == ''){
			alert('Oops, you are missing something. All fields are required.');
			return false;
		}
		//hacks for check
		if(_li.data('videoUploaded')	!=	true	){
			alert("You must upload video first!");
			return false;
		}	
		if(_button.attr('buttontype') == 'doing'){
			return false;
		}
		_button.html('Updating');
		_button.attr('buttontype','doing');
		$.post('<?php echo base_url("user/updateLession");?>',_data,function(msg) {
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			console.info(json);
			if(json.status == true || json.status == 'true'){
				$('#dialog1').dialog({
					modal:true,
					buttons: {
						"Ok": function() {
							container = $('<div></div>').setTemplateElement('lessonListTemp').processTemplate(json.lesson);
							$('.lessonsList').append(container.children());
							_li.remove();
							$( this ).dialog( "close" );
							window.location.replace("https://www.thetalklist.com/en/user/lessons/");
						}
					}
				});
			}
			else {
				$('#dialog').html(json.msg).dialog({modal: true});
			}
			_button.attr('buttontype','done').html('Add');
		});
	});
}


function editLessons(id){
cupdate ='vid='+id;
$.ajax({
url:'<?php echo base_url('user/editlessons/');?>',
type:'POST',
data:cupdate,
dataType: 'html',
cache: false,
success:function(msg){
if (String == msg.constructor) {
eval ('var json = ' + msg);
} else {
var json = msg;
}

$('.lesson_name').val(json.name);
$('.lesson_desc').val(json.desc);
$('.lesson_id').val(json.id);
}
});

var _temp = $('.addnewTemplate').clone();
_temp = $(_temp).removeClass('addnewTemplate').addClass('addNewLesson').show();
$('.lessonsList').append(_temp);
var _index = _temp.index();
_temp.attr('index',_index);
buttons[_index] = _temp.find('.upload_hdpic');
intervals[_index] = '';
addRows[_index] = _temp;
new AjaxUpload(buttons[_index],{
action: '<?php echo Base_url('user/lesson_video');?>', 
enable:true,
type:'video/*,video/mp4,video/3gpp,video/rm,video/avi,video/wma,video/rmvb,video/wmv,video/mov,video/MOV',
name: 'userfile',
onSubmit : function(file, ext){
if(typeof(this._input.files[0])!='undefined' && typeof(this._input.files[0].size)!='undefined'){
if(this._input.files[0].size > 52428800){
alert('Filesize too large, please use a video less than 50mb. Converting to MP4 can reduce filesize considerably.');
return false;
}
}
var _lesson_id = addRows[_index].find('.lesson_id').val();
this.setData ({lesson_id:_lesson_id});
var _showText = addRows[_index].find('.nick_name').show();
_showText.text('Uploading');//$( "#dialog p").html('Uploading.');
_showText.attr('buttontype','doing');
this.disable();

},
onComplete: function(file, response){

var _showText = addRows[_index].find('.nick_name');
_showText.text('Uploaded');
_showText.attr('buttontype','done');
//window.clearInterval(intervals[_index]);
this.enable();
//console.info(response);

try{
if (String == response.constructor) {      
eval ('var response = ' + response);
} 
}
catch(e){

}
if(response.error){
$("#dialog").html('Uploading error.'+response.error);
$("#dialog").dialog({
modal: true,
show: "blind",
hide: "explode"
});
return;
}
//addRows[_index].find('.video_pic_163x90 img').attr('src',response.image+'.jpg');
addRows[_index].find('.lesson_id').val(response.lesson_id);
addRows[_index].data('videoUploaded',true);
_showText.hide(3000);
//alert('<?php echo $lngvidUploadedMsg;?>');
$(".successgreen").attr("src", "<?php echo base_url("images/green_check_mark.png")?>");
//createVideo(response.image+'.jpg',response.video);
}
});

_temp.find('.doAddLesson').click(function(){
var _data = {};
var _button = $(this);
var _li = $(this).parents('li.addNewLesson');
_data['id'] = _li.find('.lesson_id').val();
_data['name'] = _li.find('.lesson_name').val();
_data['language'] = _li.find('.lesson_language').val();
_data['desc'] = _li.find('.lesson_desc').val();
_data['price'] = _li.find('.price').val();
if(_data['name'] == null||_data['name'] == ''){
//$('#dialog').html('The lesson name can not be null!');
alert('Oops, you are missing something. All fields are required.');

return false;
}
//hacks for check

if(_button.attr('buttontype') == 'doing'){
return false;
}
_button.html('Updating');
_button.attr('buttontype','doing');
$.post('<?php echo base_url("user/updateLession");?>',_data,function(msg) {
if (String == msg.constructor) {      
eval ('var json = ' + msg);
} else {
var json = msg;
}

if(json.status == true || json.status == 'true'){
$('#dialog1').dialog({
modal:true,
buttons: {
"Ok": function() {
//console.info(json);
container = $('<div></div>').setTemplateElement('lessonListTemp').processTemplate(json.lesson);
//_data['price'] = _data['price']	* (1-(-window.configs['LES_PRICE_PERCENT']['value']) )	;
//_data['price']  = Math.round(parseInt(_data['price'] *10000) /100)  /100;
//$('.lprice',container).html(_data['price']);
$('.lessonsList').append(container.children());
//$('#dialog').html('Update success..').dialog({modal: true});

_li.remove();
$( this ).dialog( "close" );
window.location.replace("https://www.thetalklist.com/en/user/lessons/");
}
}
})

//$('#dialog').html('Update success..').dialog({modal: true});
}
else {
$('#dialog').html(json.msg).dialog({modal: true});
}
_button.attr('buttontype','done').html('Add');
});
})
}



$(function(){

$('.setPrice').live('click',function(){
var _data = {};
var _button = $(this);
var _li = $(this).parents('li.lesson');
_data['id'] = _li.find('.lesson_id').val();
_data['price'] = _li.find('.price').val();
if(isNaN(_data['price'])){
$('#dialog').html('Price must be number.').dialog({modal: true});
}
//_button.html('Updating..');
if(_button.attr('buttontype') == 'doing'){
return false;
}
_button.html('Updating').attr('buttontype','doing');
$.post('<?php echo base_url("user/updateLession");?>',_data,function(msg){
if (String == msg.constructor) {      
eval ('var json = ' + msg);
} else {
var json = msg;
}
if(json.status == true || json.status == 'true'){
//_data['price'] = _data['price']	* (1-(-window.configs['LES_PRICE_PERCENT']['value']) )	;
//_data['price']  = Math.round(parseInt(_data['price'] *10000) /100)  /100;
$('.lprice',_li).html(_data['price']);
$('#dialog').html('Update success..').dialog({
modal: true,
buttons: {
"Ok": function() {
$( this ).dialog( "close" );
}
}
});
}
else {
$('#dialog').html(json.msg).dialog({modal: true});
}
_button.attr('buttontype','done').html('Set Price');
});
})

$('.deleteLesson').live('click',function(){
if(!window.confirm('Are you sure you want to delete it?')){
return;
}
var _data = {};
var _button = $(this);
var _li = $(this).parents('li.lesson');
_data['id'] = $(this).attr('mid');
//_button.html('Updating..');
if(_button.attr('buttontype') == 'doing'){
return false;
}
_button.html('...').attr('buttontype','doing');

$.post('<?php echo base_url("user/delete_lesson");?>',_data,function(msg){
//alert(msg);
if (String == msg.constructor) {      
eval ('var json = ' + msg);
} else {
var json = msg;
}
alert('Video is successfully deleted');
location.reload();
});
})

})
</script>
<script>
function createVideo(poster,videoPath,title){

$('#player_a').parent('#player_b').empty().append($('<div id="player_a" class="video_Wp posR projekktor"></div>')); 
proje = '';
proje = projekktor('#player_a', {
title: title,
debug: false,
poster: poster,//'<?php echo profile_video($profile["vedio"]);?>',//'<?php echo Base_url("images/intro.png");?>',
width: 719,
height: 397,
playerFlashMP4:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
playerFlashMP3:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
//plugin_display: {
//	logoImage: '<?php echo Base_url("images/header.jpg");?>',
//	logoDelay: 5
//},
controls: true,
playlist: [
{
0: {src:videoPath, type:'video/mp4'}
/*1: {src:videoPath+'.ogg', type:'video/ogg'},
2: {src:videoPath+'.mp4', type:'video/mp4'}*/
}
] 
});
}
$(function(){
$('.delClass').hide();
$('.archivedList li').hover(function(){
$('.delClass',this).show();
},function(){
$('.delClass',this).hide();
})
var _firstLesson = $('.archivedList li:first');
if( typeof(_firstLesson.get(0)) == 'undefined' || _firstLesson.attr('source')==''){ 
createVideo('<?php echo profile_video("");?>','<?php echo profile_video("","");?>','Default video');
}
else {
//var _source = _firstLesson.attr('source');
//createVideo(_source.replace('__PATH__','uploads/video/images/')+'.jpg',_source.replace('__PATH__','uploads/video/'),_firstLesson.find('.lname').html());
//createVideo('<?php echo profile_video("","");?>','<?php echo profile_video('','');?>','Default video');
createVideo('<?php echo profile_video("");?>','<?php echo profile_video("","");?>','Default video');
//createVideo('<?php echo profile_video($profile["vedio"]);?>','<?php echo profile_video($profile["vedio"],"");?>');
//createVideo('<?php echo profile_video("");?>','<?php echo profile_video($profile["vedio"],"");?>');
}
$('.showVideo').click(function(){ 
var _clickEl = $(this);
//alert(_clickEl);
var _li = _clickEl;
var _source =  _li.attr('source');
/*alert(_source);
return false;*/
createVideo(_source.replace('__PATH__','uploads/video/images/')+'.jpg',_source.replace('__PATH__','uploads/video/'),_li.find('.lname').html());
})
})
</script>
<style>
.teacher_prof li a.prof_on span{ background-position:-310px -333px !important;}
.prof_on{ background-position:-309px -333px;}
</style>
<script type="text/javascript">
$(document).ready(function(){
$('.delClass').live('click',function(){
if(window.confirm('Are you sure you want to delete it?')==true){
var _li = $(this).parents('li.lesson');
$.post('<?php echo base_url("user/delArchive");?>',{'archiveId':$(this).attr('id')},function(msg){
_li.remove();
if($(".purchasearchivedList li").length==0) {
$("#player_b").remove();
}

});
return;
}
});
});
</script>

<script src="<?php echo base_url("js/jquery.popupoverlay.js");?>" ></script>
<script>
$(document).ready(function (event) {
$('#video_popup190516').popup({
pagecontainer: '.container',
transition: 'all 0.3s',
scrolllock: true,
blur: false
});
});
</script>
<style>
.upload_popup_main_190516{ background: #ccc none repeat scroll 0 0;
border-radius: 5px;
margin: 0 auto;
max-width: 816px;
overflow:visible;
padding: 15px; position:relative; border:10px solid #fff; display:none;}
.popup_close_icon_190516 {
background: rgba(0, 0, 0, 0) url("../../../../images/main/video-close-btn.png") no-repeat scroll 0 0 / 80% auto;
display: block;
height: 47px;
position: absolute;
right: -32px;
top: -20px;
width: 47px;
z-index: 999;
}
.popup_close_icon_190516 a {
display: block;
height: 35px;
width: 35px;
}

.selectlang230516{ padding-bottom:15px; float:left; padding-right:10px;}
.selectlang230516 span{ display:block; padding-bottom:5px;}
.selectlang230516 input{ padding:5px 5px;width: 213px;}
.selectlang230516 select{ padding:5px 5px; width:146px;}

.video_3colum_main_230516 *,
.video_3colum_main_230516 *:before,
.video_3colum_main_230516 *:after{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}

.video_3colum_main_230516{ padding:15px 0;}
.video_3colum_main_230516 ul{}
.video_3colum_main_230516 ul li{ float:left; width:50%; position:relative; padding-right:10px;}

.close_icon230516{ position:absolute; top:0px; right:10px; width:25px; height:25px;}
.close_icon230516 img{ width:100%; display:block;}

.video_block230516_main01{ padding-bottom:10px;}
.video_block230516_left01{ float:left; width:48%; cursor: pointer;}
.video_block230516_left02{ float:left; height:100px; overflow: hidden; width:48%;}
.video_block230516_right01{ float:left; width:50%; padding-left:5px;}

.video_block230516_left01 img{ width:100%; display:block;}
.video_block230516_right01 h2{ font-size:14px; padding-bottom:10px; min-height:44px; padding-right:20px;}
.video_block230516_right01 h2 span{ font-size:10px; display:block; color:#636363;}
.video_block230516_right01 h2.blue{ color:#5b9bd5;}
.eachupload{ padding:15px; text-align:center; font-size:18px;}
.addBtn_Wp .addmore_v_btn{ margin-top:52px;}

@media only screen and (max-width: 767px) {
.video_3colum_main_230516 ul li{ float:none; width:100%; position:relative; padding-right:10px;}
}

#dialog1{ font-size: 15px; line-height: 1.2; }
.lesson{display:none;}
#player_a_media{cursor: pointer;}
</style>