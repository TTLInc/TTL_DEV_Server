<?php
$multi_lang = 'en';
if(!isset($_SESSION)) {
     session_start();
}
if(isset($_SESSION['multi_lang']))
{
	$multi_lang = $_SESSION['multi_lang'];
}
else
{
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

$arrVal 		= $this->lookup_model->getValue('959', $multi_lang);
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
/* For Student */
$this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js");
$this->layout->appendFile('javascript',"js/fullCalendar.js");
$this->layout->appendFile('javascript',"js/calendar.js");
/* End */

$this->layout->appendFile('javascript',"js/jquery-jtemplates.js");
$this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");
$this->layout->appendFile('javascript',"js/projekktor-1.1.00r107.min.js");
$this->layout->appendFile('css',"css/palyerTheme/style.css");
/* For Teacher Private */
$this->layout->appendFile('css',"css/cupertino/theme.css");
/* End */
?>

<div class="baseBox baseBoxBg clearfix">
  <div class="content_main fr">
    <div class="main_inner">
      <?php /*<ul class="student_prof teacher_prof">
        <?php echo profile_menu('t_private','l_prof',$profile['uid']);?>
      </ul>*/?>
      <!--/student_prof-->
      <div id="student_prof_Wp">
        <div class="hd">
          <div class="content tle" style="padding-top:0px;">
            <h2><?php echo $PVIDEO;?></h2>
            <!--<span style="font-size:14px;"><?php //echo $plessonstxt; ?></span>-->
            <span style="font-size:14px;"><?php echo $yougoto;?> <a href="<?php echo base_url('search/videosearch')?>"><?php echo $vsearch;?></a> <?php echo $findexp ; ?> </span> </div>
        </div>
        <div class="bd" id="player_b">
          <div class="video_Wp posR projekktor"  id="player_a"> <a class="upload_hdpic upload_videopic" id="profile_vedio_upload" href="javascript:void(0)" > </a> </div>
        </div>
        <!--<div class="video_Wp posR "  id="player_b">
                <div class="projekktor" id="player_a"></div>
            </div>-->
        <div class="mod">
          <div class="bd">
            <ul class="archivedList">
              <?php foreach($lessons as $k=>$lesson):?>
              <li source="<?php echo base_url('__PATH__'.$lesson['source']);?>" class="lesson">
                <div class="video_pic_163x90 posR fl"> <a href="javascript:void(0)" class="showVideo"><img src="<?php echo profile_video($lesson['source']);?>" width="163" height="90" /><span class="video_ic video_ic_s"></span></a> </div>
                <div class="video_pic_intro c666">
                  <div class="video_hd clearfix">
                    <h3 class="c424242 f14 fl"> <a href="javascript:void(0)" class="lname"><?php echo $lesson['name'];?></a> - <span class="c047d9e"> <a href="<?php echo tl_url('user/profile',$lesson['uid']);?>"><?php echo $lesson['firstName'],' ',$lesson['lastName'];?></a> </span> </h3>
                    <span class="fr c939393"><a href="javascript:void(0)" class="delClass"><em class="ico_op ico_del2 "></em><?php echo $lremovevideo;?></a></span> </div>
                  <div class="archived_desc"><strong><?php echo $ldescription;?>: </strong> <?php echo $lesson['desc'];?></div>
                  <div class="archived_info clearfix"> <span class="fl"><?php echo $lrecorded;?>: <?php echo date( 'M d, Y' , outTime($lesson['creat_at']));?></span> <span class="fr"><?php echo $llength;?>: <?php echo sec2min($lesson['length']);?></span> </div>
                </div>
              </li>
              <?php endforeach;?>
            </ul>
          </div>
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
        <div class="mod">
          <div class="content tle">
            <h2><?php echo $UplodedVideo;?></h2>
          </div>
          <div class="video_intro_desc"> <?php echo $llesson_text;?> </div>
          <!--Video Listing-->
          <div class="bd">
            <ul class="archivedList lessonsList">
              <?php foreach($lessonsforsale as $k=>$lesson):?>
              <li source="<?php echo base_url('__PATH__'.$lesson['source']);?>" class="lesson">
              <li class="lesson">
                <div class="video_pic_163x90 posR fl">
					<?php 
					if($lesson['upload_status']==2){
					?>
					<a href="javascript:void(0)"><img src="<?php echo base_url("uploads/video/".$lesson['source'].".jpg");?>" width="163" height="90" /><span class="video_ic video_ic_s"></span>
					</a>
					<?php }?>
				</div>
                <div class="video_pic_intro c666">
                  <div class="video_hd clearfix">
                    <h3 class="c424242 f14 fl"> <a href="javascript:void(0)" class="lname"><?php echo $lesson['name'];?></a> - <span class="c047d9e"><a href="<?php echo tl_url('user/profile',$lesson['uid']);?>" class="tname"><?php echo $lesson['firstName'],' ',$lesson['lastName'];?></a></span>
                      <!-- <?php //echo $lprice;?> <span class="cbd0000 lprice" >$<?php //echo $lesson['price'];?>-->
                      </span> </h3>
                  </div>
                  <div class="archived_desc"><strong><?php echo $ldescription;?>: </strong> <?php echo $lesson['desc'];?> </div>
                  <div class="archived_info clearfix"> <span class="fl"><?php echo $lrecorded;?>: <?php echo date( 'h:i a, M d, Y' , outTime($lesson['creat_at']));?></span> <span class="fr"><?php echo $llength;?>: <?php echo sec2min($lesson['length']);?></span> </div>
                </div>
                <div class="set_price"> <?php echo $lnewprice;?><br />
                  $
                  <input type="text" class="new_prize_ipt price"  value="<?php echo $lesson['price'];?>"/>
                  <input type="hidden" value="<?php echo $lesson['id'];?>" class="lesson_id"/>
                  <div class="addBtn_Wp"> <a class="addmore_v_btn redRadiusBtn2 w80 setPrice" href="javascript:void(0)"><?php echo $lsetprice;?></a> <a class="addmore_v_btn redRadiusBtn2 w55 deleteLesson" href="javascript:void(0)"><?php echo $ldelete;?></a> </div>
                </div>
              </li>
              <?php endforeach;?>
              <!--Add Video Template-->
              <li class="addnewTemplate" style="display:none">
                <div class="video_pic_163x90 posR fl"> <a href="#"> <img src="<?php echo Base_url('images/clicktoupload.jpg');?>" width="140" height="120" />
                  <!--<span class="video_ic video_ic_s"></span>-->
                  <div class="nick_name tl-nw-btn"  style="display:none"><span></span></div>
                  <a href="javascript:void(0)" class="upload_hdpic upload_videopic" ><?php echo $UpVideo;?></a> </div>
                <div class="video_pic_intro c666">
                  <div class="video_hd clearfix">
                    <h3 class="c424242 f14 fl"> <?php echo $llesson_name;?>:
                      <input type="text" class="lesson_name" placeholder="<?php echo $llesson_name;?>">
                    </h3>
                  </div>
                  <div class="archived_desc"> <strong><?php echo $ldescription;?>: </strong> <br/>
                    <textarea class="lesson_desc" cols="50" rows="4"> </textarea>
                  </div>
                  <div class="archived_info clearfix">
                    <!--<span class="fl">Recorded: June 18, 2012 - 3:49 PM</span>
										<span class="fr">Length: 2:05:05</span>-->
                  </div>
                </div>
                <div class="set_price"> <?php echo $lsetprice;?><br />
                  $
                  <input type="text" class="new_prize_ipt price" />
                  <input type="hidden" value="0" class="lesson_id"/>
                  <div class="addBtn_Wp"> <a href="javascript:void(0)" class="addmore_v_btn redRadiusBtn2 w96 doAddLesson"><?php echo $ladd;?></a> </div>
                </div>
              </li>
              <!--Add Video Template-->
            </ul>
          </div>
          <!--Video Listing-->
          <!--Add Video-->
          <div class="bd">
            <div class="addBtn_Wp"><a href="javascript:void(0)" class="addmore_v_btn redRadiusBtn2 w96" onclick="addLessons()"><?php echo $laddmore;?></a></div>
          </div>
          <!--Add Video-->
        </div>
        <!--/mod-->
      </div>
      <!--/teacher_prof_Wp-->
      
    </div>
  </div>
  <!--/content_main-->
  <?php include dirname(__FILE__).'/../leftSide.php';?>
</div>
<textarea id="calendarTemp" style="display:none"  rows="0" cols="0">
    <!--
    <table width="720px" height="500px" cellpadding="2" cellspacing="2" border="1">
        <thead>
            <th class="prev"> <a href="javascript:Calendar.getInstance().move(-1);"> < </a></th>
            <th colspan="5" class="month"> {$T.month} </th>
            <th class="next"> <a href="javascript:Calendar.getInstance().move(1);"> > </a> </th>
        </thead>
        {#foreach $T.rows as row}
        <tr>
            {#foreach $T.row as day}
            <td class="col {$T.day.thisMonth} {$T.day.today}">
                <div class="title day_{$T.day.month}_{$T.day.day}">
                    <span class="weekday">{$T.day.weekDay}</span>
                    <span class="event"></span>
                </div>
                <div class="day">{$T.day.day}</div>  
            </td>
            {#/for}
        </tr>
        {#/for}
    </table>
    -->
</textarea>
<textarea  id="lessonListTemp" style="display:none"  rows="0" cols="0">
<!--<li class="lesson">
    <div class="video_pic_163x90 posR fl">

    </div>
    <div class="video_pic_intro c666">
        <div class="video_hd clearfix">
            <h3 class="c424242 f14 fl">
                <a href="javascript:void(0)" class="lname">{$T.name}</a> - <span class="c047d9e"><a href="#" class="tname">{$T.firstName} {$T.lastName}</a></span>
                 - Price <span class="cbd0000 lprice">${$T.price}</span>
            </h3>
        </div>
        <div class="archived_desc">
            <strong>Description: </strong> 
            {$T.desc}
        </div>

        <div class="archived_info clearfix">
            <span class="fl">Recorded: {$T.creat_at}</span>
            <span class="fr">Length: {$T.length}</span>
        </div>
    </div>
    
    <div class="set_price">
        New Price<br />
        $ <input type="text" class="new_prize_ipt price"  value="{$T.price}"/>
        <input type="hidden" value="{$T.id}" class="lesson_id"/>
        <div class="addBtn_Wp">
			<a class="addmore_v_btn redRadiusBtn2 w80 setPrice" href="javascript:void(0)">Set Price</a>
			<a class="addmore_v_btn redRadiusBtn2 w55 deleteLesson" href="javascript:void(0)">Delete</a>
		</div>
    </div>
</li>-->
</textarea>
<textarea id="eventDialogTemplate" style="display:none"  rows="0" cols="0">
<!--<div id="calendarEventDialog" class="er_arr">
    <ul id="eventList">
        {#foreach $T.rows as row}
        <li>
            <div class="event_tle">{$T.row.title} </div> 
            <div class="event_time">{$T.row.start} - {$T.row.end} </div>
        </li>
        {#else}
        <li>
            There is no event.
        </li>
        {#/for}
    </ul>
    <div class="event_arr"></div>
</div>-->
</textarea>
<div id="dialog1" title="Upload Video" style="display:none">
  <?php echo $lngvidUploadedSuccMsg;?>
</div>
<script>
	var intervals = {};
	var buttons = {};
	var addRows = {};
	function addLessons(){ 
		/*if(<?php echo $profile['roleId'];?> != 3 ){
			alert('<?php echo $vsale;?>');
			return;
		}*/

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
				/*intervals[_index] = window.setInterval(function(){
					var text = _showText.text();
					if (text.length < 13){
						_showText.text(text + '.');
					} else {
						_showText.text('Uploading');				
					}
				}, 200);*/
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
					/*$("#dialog").html('Uploading error. Video may be in an unsupported format. Must be in MP4,AVI,3GP, and maximum of 50mb.');
					$("#dialog").dialog({
						modal: true,
						show: "blind",
						hide: "explode"
					});
					return;*/
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
				alert('<?php echo $lngvidUploadedMsg;?>');
				//createVideo(response.image+'.jpg',response.video);
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
				$('#dialog').html('The lesson name can not be null!');
				$( "#dialog" ).dialog({
					modal: true,
					show: "blind",
					hide: "explode"
				});
				return false;
			}
			//hacks for check
			if(_li.data('videoUploaded')!=true){
			//if(_li.data('videoUploaded')==true){
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
							}/*,
							Cancel: function() {
								$( this ).dialog( "close" );
							}*/
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
			_data['id'] = _li.find('.lesson_id').val();
			
			//_button.html('Updating..');
			if(_button.attr('buttontype') == 'doing'){
				return false;
			}
			_button.html('Deleting').attr('buttontype','doing');
			$.post('<?php echo base_url("user/delete_lesson");?>',_data,function(msg){
				if (String == msg.constructor) {      
					eval ('var json = ' + msg);
				} else {
					var json = msg;
				}
				_button.attr('buttontype','done').html('Delete');
				if(json.status == true || json.status == 'true'){
					_li.remove();
				}
				else {
					$('#dialog').html(json.msg).dialog({modal: true});
				}
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
			var _li = _clickEl.parents('li.lesson');
			var _source =  _li.attr('source');
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