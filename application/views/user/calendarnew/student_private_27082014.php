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
$arrVal = $this->lookup_model->getValue('65', $multi_lang);
$lcalender = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('66', $multi_lang);
$lschsession = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('69', $multi_lang);
$lschsessionat = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('67', $multi_lang);
$ltestVeeSession = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('68', $multi_lang);
$lsetupalerts = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('70', $multi_lang);
$l15min = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('71', $multi_lang);
$l30min = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('72', $multi_lang);
$l60min = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('73', $multi_lang);
$lset = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('35', $multi_lang);
$lemail	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('179', $multi_lang);
$lcancelclass = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('180', $multi_lang);
$ljoinvsession = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('328', $multi_lang);
$vtext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('329', $multi_lang);
$clickupgradetext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('372', $multi_lang);
$vnoevent = $arrVal[$multi_lang];
//--R&D@Oct-31-2013 : Set Language Variables
$arrVal 	= $this->lookup_model->getValue('421', $multi_lang);	$lLOCAL_TIMEZONE   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('422', $multi_lang);	$lRECURRING_SESSION   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('423', $multi_lang);	$lSESSIONS   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('424', $multi_lang);	$lBOOKING   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('425', $multi_lang);	$lCREATE_SLOT   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('426', $multi_lang);	$lMY_SESSIONS   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('427', $multi_lang);	$lTIME_SLOT   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('428', $multi_lang);	$lMINUTES   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('429', $multi_lang);	$lSUBMIT   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('430', $multi_lang);	$lENDED   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('431', $multi_lang);	$lBREAK   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('432', $multi_lang);	$lLOCKED   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('433', $multi_lang);	$lSHARE_MAP_TIP   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('457', $multi_lang);	$lCALENDER   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('458', $multi_lang);	$lOPEN   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('475', $multi_lang);	$lCANCEL_CLASS   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('476', $multi_lang);	$lSCHEDULED_SESSION_AT  = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('477', $multi_lang);	$lSELECT_ON_TYPE   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('478', $multi_lang);	$lDELETE_SESSION_MSG   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('479', $multi_lang);	$lDELETE_SUCCESS   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('480', $multi_lang);	$lLOCKED_TIP   			= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('481', $multi_lang);	$lHAVE_CHROME_QUE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('482', $multi_lang);	$lOK   					= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('483', $multi_lang);	$lYES   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('484', $multi_lang);	$lNO   					= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('485', $multi_lang);	$lADD_SUCCESS   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('486', $multi_lang);	$lEND_TIME_ALERT   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('487', $multi_lang);	$lINVALID_END_DATE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('488', $multi_lang);	$lINVALID_START_DATE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('489', $multi_lang);	$lIE_WARNING   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('490', $multi_lang);	$lDW_CHROME   			= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('491', $multi_lang);	$lLOGIN_CHROME   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('492', $multi_lang);	$lBOOKED_SUCCESS   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('493', $multi_lang);	$lYOUR_TOTAL_CHARGE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('494', $multi_lang);	$lOK_TO_CONFIRM   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('495', $multi_lang);	$lBOOKING_SUMMARYR   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('496', $multi_lang);	$lREADY_TALK_OP   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('497', $multi_lang);	$lINSUFFICIENT_CREDITS  = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('498', $multi_lang);	$lPLEASE   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('499', $multi_lang);	$lRECHARGE   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('500', $multi_lang);	$lACCOUNT   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('501', $multi_lang);	$lNO_SESSION_SELECTED   = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('502', $multi_lang);	$lQUARANTINE		    = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('522', $multi_lang);	$llocaltimezonetool	    = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('783', $multi_lang);	$lunothave	    = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('812', $multi_lang);	$iesupport	    = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1118', $multi_lang);	$MysessionBook	    = $arrVal[$multi_lang];
//--R&D@Oct-31-2013 : Set Language Variables


?>
<?php $this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js");?>
<?php //$this->layout->appendFile('javascript',"js/fullCalendar.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/calendar.js");?>
<?php $this->layout->appendFile('css',"css/calendar.css");?>

<?php 


// checks for quarantine users
if($profile['quarantine'] == 1){?>
	<script>
		alert("<?php echo $lQUARANTINE;?>");
		//return false;
	</script>
	<style>
		
		.mod .bd{display:none;}
	</style>
<?php } ?>
<style>
div.tooltip {
  background-color: #037898;
  color: White;
  position: absolute;
  left: 35px;
  top: -15px;
  z-index: 1000000;
  width: 250px;
  border-radius: 5px;
}
div.tooltip:before {
  border-color: transparent #037898 transparent transparent;
  border-right: 6px solid #037898;
  border-style: solid;
  border-width: 6px 6px 6px 0px;
  content: "";
  display: block;
  height: 0;
  width: 0;
  line-height: 0;
  position: absolute;
  top: 40%;
  left: -6px;
}
div.tooltip p {
  margin: 10px;
  color: White;
}
</style>
 <div class="baseBox baseBoxBg clearfix">
        <div class="content_main fr">
        	<div class="main_inner">
                <ul class="student_prof">
                    <?php echo profile_menu('s_private','c_prof',$profile['uid']);?>
                </ul>
                <!--/student_prof-->
                <div id="student_prof_Wp">
			 
					
					<div class="mod">
						<div class="hd">
							<div class="content tle"><h2><?php echo $MysessionBook;?></h2></div>
						</div>
						<div class="bd">
						
							<ul class="ratings_list2">
								<a class="aqua_btn norBtn redRadiusBtn2 w140 f12 vess-btn" href="<?php echo base_url('testveesession/testVeeSession');?>"><?php echo $ltestVeeSession;?></a>
							</ul>
							
							
							<p class="previewbutton"><?php echo $vtext;?><a href="https://www.google.com/intl/en/chrome/browser/?hl=en&brand=CHMA&utm_campaign=en&utm_source=en-IN-ha-bk&utm_medium=ha&utm_term=%2Bchrome" target="_blank" >Chrome</a> and <a href="http://www.mozilla.org/en-US/firefox/new/" target="_blank" >Firefox. <?php echo $clickupgradetext;?></a><?php echo $iesupport; ?></p>
							<ul class="ratings_list">
							 <?php if($classes==array()){?>
							 <p style="padding-top:100px;text-align:center;font-size:17px;color:#FF0000"><?php echo $lunothave;?></p>
							 <?php }?>
								<?php foreach($classes as $k=>$class):?>
								<li>
									<div class="header_pic_L fl">
										<div class="header_pic">
											<a href="<?php echo Base_url("user/profile/uid/".$class['tid']);?>"><img src="<?php echo $class['pic']?Base_url('/uploads/images/thumb/'.$class['pic']):Base_url('images/header.jpg');?>" height="80" width="78" /></a>
										</div>
									</div>
									<div class="rating_ct">
										<div class="agnR c939393"><a href="javascript:void(0)" theClassId='<?php echo $class['id'];?>' class="delClass"><em class="ico_op ico_del2"></em><?php echo $lCANCEL_CLASS ;?></a></div>
										<div class="classes_info clearfix f12 fb">
											<span class="fl">
												<?php echo $lSCHEDULED_SESSION_AT;?> <?php echo hiaOutTime($class['startTime']) ;?>
											</span>
											<span class="c06a0c1">&nbsp;&nbsp;</span>
											
											<span class="c06a0c1" id="join-vee-session">
												
												<?php if($class['locked'] == 1): ?>
												<!--<span class="lockedtip" id="class_t_<?php echo $class['id']; ?>" ><img src="<?php echo base_url().'images/arrow.png';?>" alt""/></span>-->
												<a class="grey-btn disable-join" id="class_d_<?php echo $class['id']; ?>"  href="javascript:void(0);"><span class="lockedtip" id="class_t_<?php echo $class['id']; ?>" ><?php echo $lLOCKED;?></span></a>
												<a class="red-btn enable-join" style="display:none;" id="class_e_<?php echo $class['id']; ?>"  href="<?php echo base_url('classroom/index/cid/'.$class['id']);?>"><?php echo $ljoinvsession;?></a>
												<?php else: ?>
												<!--<span class="lockedtip" id="class_t_<?php echo $class['id']; ?>" style="display:none;"><img src="<?php echo base_url().'images/arrow.png';?>" alt""/></span>-->
												<a class="grey-btn disable-join" id="class_d_<?php echo $class['id']; ?>" style="display:none;"  href="javascript:void(0);"><span class="lockedtip" id="class_t_<?php echo $class['id']; ?>" style="display:none;"><?php echo $lLOCKED;?></span></a>
												<a class="red-btn enable-join" id="class_e_<?php echo $class['id']; ?>"  href="<?php echo base_url('classroom/index/cid/'.$class['id']);?>"><?php echo $ljoinvsession;?></a>
												
												<?php endif; ?>
											</span>
											

											<span class="fr c06a0c1"><?php echo $class['firstName'],'',$class['lastName'];?> - <?php echo $class['lang'];?></span>
										</div>
									</div>
								</li>
								<?php endforeach;?>
							</ul>
							<!--
							<div class="set_up_alerts fr">
								<div class="alters_tle">Set up Alerts</div>
								<div class="addBtn_Wp">
									<select class="raduisSelect w160 noMg fb alMin">
										<option value="15" <?php if($profile['alerts'] == '15') {echo "selected";}?> >15 Minutes prior</option>
										<option value="30" <?php if($profile['alerts'] == '30') {echo "selected";}?> >30 Minutes prior</option>
										<option value="60" <?php if($profile['alerts'] == '60') {echo "selected";}?> >60 Minutes prior</option>
									</select>
									<a class="norBtn blackRadiusBtn w55 setAlert" href="javascript:;">Set</a>
								</div>
								<?php
									$sendType1 = @$profile['alertType'][0];
									$sendType2 = @$profile['alertType'][1];
								?>
								<input type="checkbox" name="send_type" <?php if($sendType1==1) {echo 'checked';}?> class="vAgn_m"  value="1"/> Email
								&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="checkbox" name="send_type" <?php if($sendType2==1) {echo 'checked';}?> class="vAgn_m"  value="2"/> Text
							</div>
							-->
							<div class="spc10c"></div>
						</div>
					</div>
 
                </div>
                <!--/student_prof_Wp-->
            </div>
        </div>
        <!--/content_main-->
		<?php include dirname(__FILE__).'/../leftSide.php';?>
    </div>
	
	<div id="calendarEventDialog" class="er_arr" style="display:none">
		
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
	<textarea id="eventDialogTemplate" style="display:none"  rows="0" cols="0">
		
		<!--
			<div id="calanderdialogclose"> <a href="javascript:closewin();" class="dclose"><img src="<?php echo Base_url('images/cm_cross.png'); ?>" alt="close" /></a></div>
			<ul id="eventList">
				{#foreach $T.rows as row}
				<li>
					<div class="event_tle">{$T.row.title} </div> 
					<div class="event_time">{$T.row.start} - {$T.row.end} </div>
				</li>
				{#else}
				<li>
					<?php echo $vnoevent; ?>
				</li>
				{#/for}
			</ul>
			<div class="event_arr"></div>
		-->
	</textarea>
	<script>
	
	
	
	function closewin()
	{
		//alert('hi');
		$('#calendarEventDialog').hide();
	}
	$(function(){
		/*
		$('#calendarEventDialog').hover(function(){
				$(this).data('in',1)
			},
			function(){
				$(this).data('in',0);
				$(this).hide();
			}
		)
		*/
		
		$('.setAlert').click(function(){
			var _minute = $('.alMin').val();
			var _type = '';
			$('[name=send_type]').each(function(){
				if($(this).is(':checked')){
					_type += '1' ;
				}
				else{
					_type += '0' ;
				}
			})
			if(_type == '00'){
				alert('<?php echo $lSELECT_ON_TYPE;?>');
				return;
			}
			$.post('<?php echo base_url('user/editProfile');?>',{alerts:_minute,alertType:_type},function(){
				alert('Alert confirmed.');
			})
		})
		Calendar.getInstance().eventCallback = function(){
			$('.event a').toggle(function(){
				var day = $(this).attr('day');
				//createTimeSlotList(day);
				$('#calendarEventDialog').show();
				$('.statusBar').show();
				$.getJSON('<?php echo Base_url("user/ajax_eventDetail");?>',{start:day,rand:Math.random()},function(msg){
				//alert(msg.constructor):
					if (String == msg.constructor) {      
						eval ('var s = ' + msg);
					} else {
					
					
						var s = msg;
					}
					
					//alert(s):
					
					$('#calendarEventDialog').setTemplateElement('eventDialogTemplate').processTemplate(s);
				})
				$('#calendarEventDialog').data('in',1);
				if($(this).offset().left + $('#calendarEventDialog').width() >document.documentElement.clientWidth){
					_pos = 'right';
					$('#calendarEventDialog').css('left' ,'');
					$('#calendarEventDialog').css('right' ,document.documentElement.clientWidth-$(this).offset().left-50);
				}
				else{
					$('#calendarEventDialog').css('right' ,'');
					$('#calendarEventDialog').css('left' ,$(this).offset().left);
				}
				//$('#calendarEventDialog').css('top',$(this).offset().top);
				var _bottomHeight = $('#calendarEventDialog').height() + $(this).offset().top;
				
				var _height = _bottomHeight - ( document.documentElement.clientHeight + $(window).scrollTop() );
				if(_height > 0 ) {
					$('#calendarEventDialog').css('top',$(this).offset().top - _height - 30);
				}
				else{
					$('#calendarEventDialog').css('top',$(this).offset().top);
				}
			},function(){
				$(this).trigger('click');
				if($('#calendarEventDialog').data('in')){
					return;
				}
				else{
					$('#calendarEventDialog').hide();
				}
			})
			
			
		}
		Calendar.getInstance().setEventUrl('<?php echo Base_url("user/ajax_events");?>').render();
		$('.delClass').hide();
		$('.ratings_list li').hover(function(){
			$('.delClass',this).show();
		},function(){
			$('.delClass',this).hide();
		})

		$('.delClass').click(function(){
            if(window.confirm('<?php echo $lDELETE_SESSION_MSG;?>')){
                var _id = $(this).attr('theClassid');
                var _delObj = $(this);
                $.getJSON("<?php echo base_url('user/studentdelclass');?>",{id:_id},function(msg){
 
                });
				 
			      	alert('<?php echo $lDELETE_SUCCESS;?>');
					_delObj.parents('li').remove(); 
					window.location.href="<?php echo base_url();?>user/calendar/uid/<?php echo $profile['uid']; ?>/Join";
                    
            }

        })

	})
	
	 $("span.lockedtip").hover(function () {
		$(this).append('<div class="tooltip2"><p><?php echo $lLOCKED_TIP;?></p></div>');
	  }, function () {
		$("div.tooltip2").remove();
	  });
	  
	 $("span.ltimez").hover(function () {
		$(this).append('<div class="tooltip3"><p><?php echo $llocaltimezonetool ; ?></p></div>');
	  }, function () {
		$("div.tooltip3").remove();
	  });
	  
	// skvirja - 05 Oct 2013  - checks for class locked
	var _noClasses = <?php echo count($classes); ?>;
	if(_noClasses > 0)
	{
		
		checkLockedClass();
	}
	function checkLockedClass()
	{
		//alert('hi');
		var classLockedTimer;
		var _id = 0;
		$.getJSON('<?php echo base_url('user/checkLockedClass');?>',{id:_id},function(msg){
		    mTimerClass = setTimeout('checkLockedClass();',5000);
			if (String == msg.constructor) {
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			var lockedclasses = json.classes;
			var lockedclass = '';
			var classId = '';
			var numClass =  json.count; 
			//alert(numClass)
			for(var i=0;i<numClass+1;i++)
			{
				//alert(lockedclasses[0])
				if (typeof(lockedclasses[i]) != "undefined")
				{
					
					lockedclass = lockedclasses[i];
					classId = lockedclass['id'];
					//alert(classId)
					var tooltipid = '#class_t_'+classId;
					var enableid = '#class_e_'+classId;
					var disableid = '#class_d_'+classId;
					
					$(tooltipid).show();
					$(disableid).show();
					$(enableid).hide();
				}
			}
			
		})	
							
						  
	}
	
	//--Set Language for Booking
	$( document ).ready(function() {
		$( '#bNote' ).html('');
		$( '#bNote' ).html('<img src="http://thetalklist.com/images/orange-dot.png"> = <?php echo $lBOOKING;?>');
	});
	//--Set Language for Booking

	</script>
    
    
    <style>
.lockedtip{margin-left:0px !important;}
span.lockedtip{
  cursor: pointer;
  display: inline-block;
  color: White;
  font-size: 13px;
  font-weight: bold;
  border-radius: 8px;
  text-align: center;
  
}

div.tooltip2 {
  background-color: #037898;
  color: White;
  position: absolute;
  left:358px !important;
  top: -50px !important;
  z-index: 1000000;
  width: 250px; 
  border-radius: 5px;
  line-height:15px;
}
div.tooltip2:before {
  border-color: transparent #037898 transparent transparent;
  border-right: 6px solid #037898;
  border-style: solid;
  border-width: 6px 6px 6px 0px;
  content: "";
  display: block;
  height: 0;
  width: 0;
  line-height: 0;
  position: absolute;
  top: 40%;
  left: -6px;
}
div.tooltip2 p {
  margin: 10px;
  color: White;
}
span.ltimez{
  cursor: pointer;
  display: inline-block;
}

div.tooltip3 {
  background-color: #037898;
  color: White;
 /* position: absolute;
   margin-left:510px !important;
  top: 245px !important;*/
  z-index: 1000000;
  width: 250px; 
  border-radius: 5px;
  line-height:15px;  position: relative;  margin-top:-85px !important;  margin-left:145px !important;
}
span.ltimez{float:left; width:350px;}

div.tooltip3:before {
  border-color: transparent #037898 transparent transparent;
  border-right: 6px solid #037898;
  border-style: solid;
  border-width: 6px 6px 6px 0px;
  content: "";
  display: block;
  height: 0;
  width: 0;
  line-height: 0;
 /* position: absolute;
  top: 40%; left:-6px;*/
  float:left;  margin-top:28px !important;
}
div.tooltip3 p {
  margin: 10px;
  color: White;
  font-weight: normal;
  font-size:12px;
  text-decoration:none;   padding:5px 0;
}
.ratings_list li{ height:100px; overflow:visible;}
</style>
