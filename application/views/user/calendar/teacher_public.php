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

$arrVal = $this->lookup_model->getValue('65', $multi_lang);
$lcalender = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('182', $multi_lang);
$lavailabletimeslot = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('183', $multi_lang);
$lmyevents = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('184', $multi_lang);
$ltimeslot = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('186', $multi_lang);
$lstatus = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('187', $multi_lang);
$lsubmit = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('185', $multi_lang);
$lminutes = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('947', $multi_lang);
$vclicktutorsession = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('948', $multi_lang);
$vbooktimeslot = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('382', $multi_lang);
$vtimes = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('383', $multi_lang);
$vslot = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('461', $multi_lang);	$lSPEAKING_LEVEl_TIP   				= $arrVal[$multi_lang];

//--R&D@Oct-31-2013 : Set Language Variables
$arrVal 	= $this->lookup_model->getValue('421', $multi_lang);	$lLOCAL_TIMEZONE   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('405', $multi_lang);	$lTOPIC   		= $arrVal[$multi_lang];
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
$arrVal 	= $this->lookup_model->getValue('459', $multi_lang);	$lCLICK_TO_OPEN   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('462', $multi_lang);	$lSLEAKING_LEVEL   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('463', $multi_lang);	$lENTER_TOPIC   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('464', $multi_lang);	$lBEGINNER   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('465', $multi_lang);	$lINTERMEDIATE   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('466', $multi_lang);	$lADVANCED   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('467', $multi_lang);	$lBOOK_NOW   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('468', $multi_lang);	$lOPENED   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('469', $multi_lang);	$lBOOKED   		= $arrVal[$multi_lang];


$arrVal 	= $this->lookup_model->getValue('470', $multi_lang);	$lEMAIL   				= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('471', $multi_lang);	$lPASSWORD   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('472', $multi_lang);	$lFIRSTNAME   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('473', $multi_lang);	$lIM_STUDENT   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('474', $multi_lang);	$lIM_TUTOR   			= $arrVal[$multi_lang];
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
$arrVal 	= $this->lookup_model->getValue('495', $multi_lang);	$lBOOKING_SUMMARY   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('496', $multi_lang);	$lREADY_TALK_OP   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('497', $multi_lang);	$lINSUFFICIENT_CREDITS  = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('498', $multi_lang);	$lPLEASE   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('499', $multi_lang);	$lRECHARGE   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('500', $multi_lang);	$lACCOUNT   			= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('501', $multi_lang);	$lNO_SESSION_SELECTED   = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('502', $multi_lang);	$lQUARANTINE		    = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('503', $multi_lang);	$lSELECT_PAYPAL_POPUP	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('504', $multi_lang);	$lSESSION_RECURRENCE	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('505', $multi_lang);	$lLOADING				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('506', $multi_lang);	$lSESSION_TIME			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('507', $multi_lang);	$lSTART			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('508', $multi_lang);	$lEND			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('509', $multi_lang);	$lRECURRENCE_PATTERN			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('522', $multi_lang);	$thetimeshowntooltip = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('790', $multi_lang);	$lcredit			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('791', $multi_lang);	$lyour			= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('792', $multi_lang);	$rslot			= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('793', $multi_lang);	$abooked			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('923', $multi_lang);	$sessioncost			= $arrVal[$multi_lang];
//--R&D@Oct-31-2013 : Set Language Variables







?>
<?php $this->layout->appendFile('css',"css/search.css");?>
<?php $this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/calendar.js");?>
<?php $this->layout->appendFile('css',"css/calendar.css");?>
<script>
function chngurl(id)
{
//alert(id);
var sid='<?php echo $this->uri->segment(6); ?>';
if(isNaN(sid))
	{
		sid=0;
	}
	
var a=document.getElementById("schoolid").value;

if(id==1)
	{
	document.getElementById("schoolid").value=0;
	}
	else
	{
		document.getElementById("schoolid").value=sid;
	}

}
</script>

<script type="text/javascript" src="http://wcs.naver.net/wcslog.js"> </script> 
 <div class="baseBox baseBoxBg clearfix">
    	 
		
		<?php include dirname(__FILE__).'/../leftSide.php';?>		 
        <div class="content_main fr">
        	<div class="main_inner">
                <ul class="student_prof teacher_prof">
                    <?php echo profile_menu('t_public','c_prof',$profile['uid']);?>
                </ul>
				<?php echo mailAptBtn($chkfreesession,$profile['uid']);?>
              
			  <!--/student_prof--> 
                <div id="teacher_prof_Wp" class="cld-txt">
                	<div class="mod clndr-pg">
                        <div class="hd">
                            <div class="content tle"><h2><span class="ltimez"><?php echo $lcalender;?> (<?php echo $lLOCAL_TIMEZONE;?>)</span><span style="padding-right:10px;float:right;"></span></h2></div>
							<div class="click-ttr-sec">
								<div class="clk-btn">
									<span>1</span> <a href="#"><?php echo $vclicktutorsession; ?></a>
								</div>
								<div class="clk-btn">
									<span>2</span> <a href="#"><?php echo $vbooktimeslot; ?></a>
								</div>
							</div><br>
                        </div>
 
						<!--<div class="bd">
							<input type="text" id="fromTime" class="raduisSelect w105 timezoneCal"/>
							<?php echo timezone_menu('UTC',  "raduisSelect w140 timezoneCal timezoneFrom",'timezoneFrom');?>
							To
 
							<?php echo timezone_menu('UTC',  "raduisSelect w140 timezoneCal timezoneTo",'timezoneTo');?>
							Is<input type="text" id="toTime"  class="raduisSelect w105 timezoneCal"/>
						
                        </div>-->
                        <div class="bd">
                            <div id="calendar"  class="fc" uid="<?php echo $profile['uid'];?>"></div>
                        </div>
						
						
						
						<!--R&D@Sept-20-2013 : IE popup message -->
                        <div id="messageIe" style="display:none;">
							<div class="pro_tle tle">
							<p id="ieMainMessage">
							<h4><span id="ieMessageText"><p>To get lightning fast performance with our Video conference, 
							you should use Chrome.  Do you have chrome?</p></span></h4>
							
							<p id ="ieCloseOption" style="display:none;"><a style="color:white;" class="blu-btn" href="javascript:void(0);" id="ieCloseOptionLink">Ok</a></p>
							
							
							<p id ="ieMainOption">
								<a style="color:white;" class="blu-btn" href="javascript:void(0);" id="browserChromeYes">Yes</a>
								<a style="color:white;" class="blu-btn" href="javascript:void(0);" id="browserChromeNo">No</a>
							</p>
							
							</p>
	
							<p id="ieSubMessage" style="display:none;">
							<a style="color:white;" class="blu-btn" href="javascript:void(0);"  id="browserChromeDownloadYes">Yes</a>
							<a style="color:white;" class="blu-btn" href="javascript:void(0);"  id="browserChromeDownloadNo">No</a>
							</p>
							
							</div>
                        </div>
						<!--R&D@Sept-20-2013 : IE popup message -->

						
						
						
						
						
                    </div>                  
                </div>
                <!--/student_prof_Wp-->
            </div>
        </div>
        <!--/content_main-->
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
				<a style="cursor:pointer;color:black;"  onclick="disptslot({$T.day.day},{$T.day.month});">	<div class="title day_{$T.day.month}_{$T.day.day}">
						<span class="weekday">{$T.day.weekDay}</span>
						<span class="event"></span>
					</div>
					<div class="day">{$T.day.day}</div>  </a>
				</td>
				{#/for}
			</tr>
			{#/for}
		</table>
		-->
	</textarea>
	<div id="calendarEventDialog" class="er_arr" style="display:none">
		<div id="calanderdialogclose"><a href="javascript:void(0);"><img src="<?php echo Base_url('images/close-gray.png'); ?>" alt="close" /></a></div>
		
		<div>
			<span class="fl createTs " ><?php echo $lavailabletimeslot;?></span>
			<span class="statusBar" style="margin-left:10px;display:none"><?php echo $lLOADING;?>...</span>
			<span class="fr myList" style="display:none" ><?php echo $lMY_SESSIONS;?></span>
		</div>
		
		<!--R&D@Oct-10-2013 : IE popup message -->
		<div class="clear"></div>
		<div class="sessionTopic" style="font-size: 14px;color: #077289;text-align: left;margin-top:5px; margin-bottom:10px"><span style="width:200px;"><?php echo $lTOPIC ;?>:</span><span style="float:right;width:252px;"><input placeholder="<?php echo $lENTER_TOPIC;?>" type="text" name="sessionTopicText" id="sessionTopicText" class="sessionTopicText">
		<input type="hidden" id="schoolid" value="<?php echo $school_id; ?>">
		</span></div>
		<div class="sessionSpeakingLevel" style="font-size: 14px;color: #077289;text-align: left;"><span style=" float:left;width:98px;"><?php echo $lSLEAKING_LEVEL;?>:</span><span style="float:right;width:252px;"><select id="sessionLevelType" name="sessionLevelType"><option value="Beginner"><?php echo $lBEGINNER;?></option><option value="Intermediate"><?php echo $lINTERMEDIATE;?></option><option value="Advanced"><?php echo $lADVANCED;?></option></select>
		<sqan class="payment" style="float:right; margin:-3px 9px 0 0;"><img class="speakingLevelToolTip" src="<?php echo base_url('images/arrow.png');?>" alt="ed"></span>
		</span>
		</div>
		<!--R&D@Oct-10-2013 : IE popup message -->
		
		<div class="clear"></div>
		<div class="dayStr">Tuesday 19 2012</div>
		

		
		
		<div style="height: 240px; overflow-y: auto;display:none" class="slotList">
			<table width="100%" cellpadding="10" border="0">
				<thead>
					<th width="30%"></th>
					<th width="40%" style="text-align:right"><?php echo $ltimeslot;?></th>
					<th width="30%" style="text-align:right"><?php echo $lminutes;?></th>
				</thead>
				<tbody>
				
				</tbody>
			</table>
		</div>
		<div class="myEvent" style="height: 240px; overflow-y: auto; display:block">
			<table width="100%" border="0">
				<thead>
					<th width="25%"><?php echo $vtimes;?></th>
					<th width="20%" style="text-align:left"><?php echo $vslot;?></th>
					<th width="25%" style="text-align:left"><?php echo $lminutes;?></th>
					<!--<th width="30%" style="text-align:left"><?php echo $lstatus;?></th>--->
				</thead>
				<tbody>
				
				</tbody>
			</table>
		</div>
		
		<?php //if($this->session->userdata('roleId') == 0): ?>
		<div class="fr"><a href="javascript:void(0)" class="norBtn blackRadiusBtn w96 none"><?php echo $lsubmit;?></a></div>
		<?php //endif; ?>
		
		<div class="event_arr"></div>
	</div>
	<table id="timeSlotListTemp" style="display:none"  rows="0" cols="0">
		<tbody>
		<tr>
			<td valign="top">__TIME__:00 __AP__</td>
				<td>
					<div class="timeSlot" id="Request timeslot" key="__TIME__:00 __AP__" eregKey="__EREGKEY__"><?php echo $rslot; ?></div>
					<div class="break"><?php echo $lBREAK;?></div>
					<div class="timeSlot" id="Request timeslot" key="__TIME__:30 __AP__" eregKey="__EREGKEY1__"><?php echo $rslot; ?></div>
					<div class="break"><?php echo $lBREAK;?></div>
				</td>
				<td>
					<div class="minuts">25</div>
					<div class="minuts">5</div>
					<div class="minuts">25</div>
					<div class="minuts">5</div>
				</td>
		</tr>
		</tbody>
	</table>
	<table id="MyEventListTemp" style="display:none"  rows="0" cols="0">
		<tbody>
		<tr key="__KEY__" class="__STATUS__">
			<td valign="top">__TIME__</td>
			<td class="minuts">
				__INDEX__
			</td>
			<td class="minuts">
				25
			</td>
			<td  class="tl">
				__STATUSSTR__
			</td>
		</tr>
		</tbody>
	</table>
	
<style type="text/css">
.hover{ display:block !important;}
span.payment {cursor: pointer;display: inline-block;width: 16px;height: 16px;line-height: 16px;color: White;font-size: 13px;font-weight: bold;border-radius: 8px;text-align: left;position: relative;}
span.payment img {vertical-align : middle;}
div.tooltip-payment {background-color: #037898;color: White;position: absolute;left: -260px;top: -42px;z-index: 1000000;width: 250px;border-radius: 5px; text-shadow:none; font-weight:normal;}
div.tooltip-payment:before {border-color: transparent #037898 transparent transparent;border-left: 6px solid #037898;border-style: solid;border-width: 6px 0px 6px 6px;content: "";display: block;height: 0;width: 0;line-height: 0;position: absolute;top: 40%;left: 250px;}
div.tooltip-payment p {margin: 10px;color: White;}
.clickdisplay{width:147px !important;height:133px;}
</style>	
	
	
	
	
	
	<script>
	 
	function disptslot(tid,mon)
	{	
	if(tid < 10)
	{
		tid= "0"+tid;
	}
	if(mon < 10)
	{
		mon= "0"+mon;
	}
	var tt="tst"+tid+mon;
	//alert(tt);
	//alert(tt);
/*$('.calendarEventDialog').click(function(){
		})*/
			//var day = $(this).attr('day');
			//alert(day);
		/*$('.event a').toggle(function(){
		})*/
		var day=document.getElementById(tt).value;	
		//var day = $(#tt).val();
			//var day = $(this).attr('day');
			//alert(day);
			//return false;
				createTimeSlotList(day);
				$('#calendarEventDialog').show();
				$.getJSON('<?php echo Base_url("user/ajax_eventDetail");?>',{start:day,uid:<?php echo $profile['uid'];?>,rand:Math.random()},function(msg){
					//console.info(s);
					
				//	alert(JSON.stringify(msg));
					
					$('.statusBar').hide();
					if (String == msg.constructor) {      
						eval ('var s = ' + msg);
					} else {
						var s = msg;
					}
					if(typeof(s.status)!='undefined' &&!s.status){
						alert(s.msg);
						return;
					}
					var str = '';
					var strTemp = $('#MyEventListTemp tbody').html();
					$.each(s.rows,function(k,v){
						var _k = v.start;
						_k = _k.replace(' ','');
						_k = _k.replace(':','');
						if(_k.substr(0,1) == '0'){
							_k = _k.substr(1);
						}
						var status = '';
						var statusStr = '';
						
						if(typeof(v.sid)!='undefined'){
							//status = '<?php echo $lBOOKED;?>';
							$('.timeSlot[eregkey='+_k+']').addClass('Booked');
							status = '<?php echo $lBOOKED;?>';
							//statusStr = '<?php echo $lBOOKED;?>';
							
						}
												
						if(s.rows[k].stid!='undefined' && typeof(v.sid)=='undefined' ){
							//status = '<?php echo "alredy request ";?>';
							//status = '<?php echo "already request ";?>';
							$('.timeSlot[eregkey='+_k+']').addClass('requested');
							status = '<?php echo $abooked;?>';
							
							//$
						}
                         //if(s.rows[k].stid=='undefined' && typeof(v.sid)=='undefined' && s.rows[k].openby==1 )
						   if(s.rows[k].openby==0 ){
							//status = '<?php //echo $lOPENED;?>';
							//status = '<?php echo 'book';?>';
							status = '<?php echo $lOPEN;?>';
							//$('.[eregkey='+_k+']').addClass(status);
							$('.timeSlot[eregkey='+_k+']').removeClass('requested');
							$('.timeSlot[eregkey='+_k+']').addClass('Open_tp');
							$('.timeSlot[eregkey='+_k+']').addClass('Opened');
							$(this).css("font-weight","900");
						}
										
						
					//	else{
							//status = '<?php echo $lOPENED;?>';
						//	status = '<?php echo "Opened";?>';
							//statusStr = '<?php echo $lBOOK_NOW;?>';
					//	}
						str += strTemp.replace('__TIME__',v.start).replace('__KEY__',v.start).replace('__INDEX__',(k+1)).replace('__STATUSSTR__',statusStr).replace('__STATUS__',status);
						//console.info('.timeSlot[eregkey='+_k+']');
						//$('.timeSlot[eregkey='+_k+']').addClass('setted');
						
						//$('.timeSlot[eregkey='+_k+']').addClass(status);
						// $('.timeSlot[eregkey='+_k+']').addClass('setted');
						$('.timeSlot[eregkey='+_k+']').html(status);
						
						$('.timeSlot[eregkey='+_k+']').addClass(status);
						
					})
					
					//$('.myEvent tbody').html(str);
					//_dayStr = $('.dayStr').html();
					//$('.myEvent tr').each(function(){
					
					$('.timeSlot tbody').html(str);
					_dayStr = $('.dayStr').html();
					$('.timeSlot').each(function(){
						
						var currentDT = new Date();
						var timeZoneOffset = currentDT.getTimezoneOffset() / 60;

						var currentUTCdtStr1 = <?php echo strtotime(date('Y-m-d H:i:s',time() + (24*60*60))); ?>;

						var currentUTCdtStr = <?php echo strtotime(date('Y-m-d H:i:s',time())); ?>;
						
						// alert(currentUTCdtStr);
						var loopDT = new Date( _dayStr + ' ' + $(this).attr('key') );
							 //alert(loopDT);
						var loopUTCdtStr = Date.parse(loopDT)/1000;
						//alert(loopUTCdtStr);
						
						if(loopUTCdtStr  < currentUTCdtStr1){
						//if(new Date( _dayStr + ' ' + $(this).attr('key') )  < new Date()){
						$(this).addClass('Ended');
						//$(this).children('.tl').html('<?php echo $lENDED;?>');
						 $(this).html('<?php echo $lENDED;?>');
						}
						
						
						//if(loopUTCdtStr  < currentUTCdtStr1 ){
						//if(new Date( _dayStr + ' ' + $(this).attr('key') )  < new Date()){
						//$(this).addClass('Ended');
						//$(this).children('.tl').html('<?php echo $lENDED;?>');
						// $(this).html('<?php echo "can not";?>');
						//}
						
						
						
						
					})
				})
				$('#calendarEventDialog').data('in',1);
				//console.info($(this).offset().left + $('#calendarEventDialog').width())
				if($(this).offset().left + $('#calendarEventDialog').width() >document.documentElement.clientWidth){
					_pos = 'right';
					$('#calendarEventDialog').css('left' ,'');
					$('#calendarEventDialog').css('right' ,document.documentElement.clientWidth-$(this).offset().left-50);
				}
				else{
					$('#calendarEventDialog').css('right' ,'');
					$('#calendarEventDialog').css('left' ,$(this).offset().left);
				}
				var _bottomHeight = $('#calendarEventDialog').height() + $(this).offset().top;
				
				var _height = _bottomHeight - ( document.documentElement.clientHeight + $(window).scrollTop() );
				if(_height > 0 ) {
					$('#calendarEventDialog').css('top',$(this).offset().top - _height - 30);
				}
				else{
					$('#calendarEventDialog').css('top',$(this).offset().top);
				}
				//$('.statusBar').show();
				
	}
	 
	 
	var _hRate = parseFloat('<?php echo $profile['hRate'];?>');
	function createTimeSlotList(day){
		var _day = day.replace('-','/').replace('-','/').replace('-','/');
		var _date = new Date(_day);
		_date = _date.toString();
		var _dateArray = _date.split(' ');
		_dateArray = _dateArray.slice(0,4);
		_dateStr = _dateArray.join(' ');
		$('.dayStr','#calendarEventDialog').html(_dateStr);
		$('.dayStr','#calendarEventDialog').data('day',_day);
		var i = 0;
		var _str = '';
		var _strTemp = $('#timeSlotListTemp tbody').html();
		for(i;i<24;i++){
			if(i==0){
				_ap = 'am';
				_hour = 12;
			}
			else if(i==12){
				_ap = 'pm';
				_hour = 12;
			}
			else if(i>12){
				_ap = 'pm';
				_hour = i%12;
			}
			else{
				_ap = 'am';
				_hour = i;
			}
			var _eregkey = _hour+'00'+_ap;
			var _eregkey1 = _hour+'30'+_ap;
			_str += _strTemp.replace('__TIME__',_hour).replace('__TIME__',_hour).replace('__TIME__',_hour).replace('__AP__',_ap).replace('__AP__',_ap).replace('__AP__',_ap).replace('__EREGKEY__',_eregkey).replace('__EREGKEY1__',_eregkey1);
			
		}
		//$('.slotList tbody').html(_str);
		$('.myEvent tbody').html(_str);
	}
	$(function(){
		$('.blackRadiusBtn','#calendarEventDialog').click(function(){			
			//if($('.timeSlot.setted','#calendarEventDialog').text()=='Request timeslot')
			var rslot = $('.timeSlot.setted','#calendarEventDialog').attr('id');
			 //alert(rslot);
			<!--R&D@Oct-10-2013 : Check Topic and Speaking Level -->
			var sessionTopic =  $('#sessionTopicText').val();
			var schoolid =  $('#schoolid').val();
			
			var sessionLevel =  $('#sessionLevelType :selected').val();
			if(sessionTopic == "") { 
				alert('<?php echo $lENTER_TOPIC;?>');
				sessionTopic = '---';
				return false; 
			}else{
				//return true;
			}
			
			<!--R&D@Oct-10-2013 : Check Topic and Speaking Level -->

			
			$('#calendarEventDialog').hide();
			
			var _day = $('.dayStr','#calendarEventDialog').data('day');
			var _seletedSlot = [];
			//console.info($('.timeSlot.setted','#calendarEventDialog'));
			//alert('ol');
			//alert($('.timeSlot.setted','#calendarEventDialog').attr('key'));
			//alert($('.timeSlot.setted','#calendarEventDialog').text());
			$('.timeSlot.setted','#calendarEventDialog').each(function(){
				_seletedSlot.push($(this).attr('key'));
			})
			
			//$('.timeSlot tr.setted','#calendarEventDialog').each(function(){
				//_seletedSlot.push($(this).attr('key'));
			//})

			//console.info(_seletedSlot.length);
			var _data = {};
			var schoolid =  $('#schoolid').val();
			_data['day'] = _day;
			_data['seletedSlot'] = _seletedSlot;
			_data['schoolval'] = schoolid;
			//  alert(_data['day']+_data['seletedSlot']);
			var _price = parseInt((_seletedSlot.length)*_hRate*100)/100;
			if(_seletedSlot.length == 0 ){
				alert('No session selected.');
				return;
			}
			//if(!window.confirm('Class rate is $' + _price + '.  Click OK to confirm this booking.')){
			//
			//	return;
			//}
			
			$.post('<?php echo Base_url('user/checkClass/uid/'.$profile["uid"]);?>',_data,function(msg){
			/*alert(msg);
			return false;*/
				if (String == msg.constructor) {
					eval ('var json = ' + msg);
				} else {
				/* Otherwise assume it is a hash already. */
					var json = msg;
				}
				//alert(json.classTimes);
				//console.info(json.success);
				if(json.success == 'false' || json.success == false){
					alert(json.msg);
				}
				 
				else if(!json.enough){
					//alert('You do not have enough money to create this class.Please recharge first!');
					//alert('Insufficient credits to buy a session.  Please recharge account.');
					var rechargeURL = '<?php echo base_url(); ?>user/account/';
					//var alertHTML = '<?php echo $lINSUFFICIENT_CREDITS;?>  <?php echo $lPLEASE;?> <div class="blue" ><a href="'+rechargeURL+'" ><?php echo $lRECHARGE;?></a></div> <?php echo $lACCOUNT;?>.';
					var alertHTML = '<?php echo $lINSUFFICIENT_CREDITS;?>  <?php echo $lPLEASE;?>&nbsp;<a href="'+rechargeURL+'" ><?php echo $lRECHARGE;?></a>&nbsp;<?php echo $lACCOUNT;?>.';
					$( "#dialog p").html(alertHTML);
					$( "#dialog" ).dialog({
						//modal: true
						//show: "blind",
						//hide: "explode"
						close: function() {
                 window.location.href = "<?php echo base_url(); ?>user/account/";
					}
					});
					
					return;
				}
				//checks for time 24 
				else if(!json.timeCheck24)
				//else if(json.timeCheck24)
				{
					var alertHTML = '<?php echo $lREADY_TALK_OP;?>';
					$( "#dialog p").html(alertHTML);
					$( "#dialog" ).dialog({
						modal: true
					});
					
					return;
				}
				else {
					var slott = $('.timeSlot.setted','#calendarEventDialog').text();
					
					var _showstr = '<?php echo $lBOOKING_SUMMARY;?> \r\n';
					var _str = '<?php echo $sessioncost;?>';
					$.each(json.classTimes,function(k,v){
						 _showstr += v +  "\r\n";
						//_showstr += v +  json.cost + "\r\n";
						 _showstr += _str + json.cost + " credits.\r\n";
						
						
					})
					
					//_showstr += '<?php echo $lYOUR_TOTAL_CHARGE;?> '+parseFloat(json.cost).toFixed(2)+' credits. \r\n<?php echo $lOK_TO_CONFIRM;?>\r\n';
					
					if($('.timeSlot.setted','#calendarEventDialog').text()!='Request timeslot')
					{
						/*if(!window.confirm(_showstr)){
							return;
						}*/
					}
					
					//Calendar.getInstance().getEvent();
					$.post('<?php echo Base_url('user/buyClasses/uid/'.$profile["uid"]);?>',{seletedSlot:json.classTimes,sTopic : sessionTopic , sLevel : sessionLevel},function(msg){
					/*alert(msg);
					return false;*/
						if (String == msg.constructor) {      
							eval ('var json = ' + msg);
						} else {
						/* Otherwise assume it is a hash already. */
							var json = msg;
						}
						//console.info(json.success);
						
						//--Detect IE browser
						if ( $.browser.msie || $.browser.mozilla) {
							var userAgentIe = true; 
						}else{
							var userAgentIe = false;
						}

						if(json.success == 'false' || json.success == false){
							alert(json.msg);
						}
						else {
							Calendar.getInstance().getEvent();
							//alert(json.status);
							return false;
							alert('<?php echo $lBOOKED_SUCCESS;?>');

							var _nasa={};
							 _nasa["cnv"] = wcs.cnv("4","10"); // ÀüÈ¯À¯Çü, ÀüÈ¯°¡Ä¡ ¼³Á¤ÇØ¾ßÇÔ. ¼³Ä¡¸Å´º¾ó Âü°í

							//alert('Is First-Time :' + json.firsttime);
							//if(userAgentIe === true){
							if(userAgentIe === true  && json.firsttime === true){
								$('#messageIe').dialog({modal: true});
								$('#messageIe').css('display','block');
							}else{
								document.location.href="<?php echo base_url('user/calendar');?>";
							}
							//document.location.href="<?php echo base_url('user/calendar');?>";
						}
					})
				}
			})
			
			//console.info(_data);
			
			if($('.timeSlot.setted','#calendarEventDialog').text()=='can not')
			{
				alert('request sessions less than the 24-hours not allowed');
				return;
			}
			/*
			alert($('.timeSlot.setted','#calendarEventDialog').text());
			return false;
			*/
			///''''''''''''''////////Request for schedule by student start //////////////////////
			 if($('.timeSlot.setted','#calendarEventDialog').text()=='Request timeslot' || $('.timeSlot.setted','#calendarEventDialog').text()=='Solicitar horário' || $('.timeSlot.setted','#calendarEventDialog').text()=='요청 슬롯' || $('.timeSlot.setted','#calendarEventDialog').text()=='请求上课时间' || $('.timeSlot.setted','#calendarEventDialog').text()=='希望の時間帯' || $('.timeSlot.setted','#calendarEventDialog').text()=='請求時隙' || $('.timeSlot.setted','#calendarEventDialog').text()=='Solicitar espacio')
			//if(rslot!='undifineed' &&  !$(this).hasClass('Opened') && rslot=='Request timeslot')
			{
			  //alert(rslot);
			  //alert('hererk');
			 ////////////
			 
			 var _day = $('.dayStr','#calendarEventDialog').data('day');
			var _seletedSlot = [];
			//console.info($('.timeSlot.setted','#calendarEventDialog'));
			//alert('ol');
			//alert($('.timeSlot.setted','#calendarEventDialog').attr('key'));
			//alert($('.timeSlot.setted','#calendarEventDialog').text());
			$('.timeSlot.setted','#calendarEventDialog').each(function(){
				_seletedSlot.push($(this).attr('key'));
			})

			
			$.post('<?php echo Base_url('user/checkClass/uid/'.$profile["uid"]);?>',_data,function(msg){
				if (String == msg.constructor) {
					eval ('var json = ' + msg);
				} else {
				/* Otherwise assume it is a hash already. */
					var json = msg;
				}
				
				//console.info(json.success);
				if(json.success == 'false' || json.success == false){
					alert(json.msg);
				}
				
				else if(!json.enough){
					//alert('You do not have enough money to create this class.Please recharge first!');
					//alert('Insufficient credits to buy a session.  Please recharge account.');
					var rechargeURL = '<?php echo base_url(); ?>user/account/';
					//var alertHTML = '<?php echo $lINSUFFICIENT_CREDITS;?>  <?php echo $lPLEASE;?> <div class="blue" ><a href="'+rechargeURL+'" ><?php echo $lRECHARGE;?></a></div> <?php echo $lACCOUNT;?>.';
					var alertHTML = '<?php echo $lINSUFFICIENT_CREDITS;?>  <?php echo $lPLEASE;?>&nbsp;<a href="'+rechargeURL+'" ><?php echo $lRECHARGE;?></a>&nbsp;<?php echo $lACCOUNT;?>.';
					$( "#dialog p").html(alertHTML);
					$( "#dialog" ).dialog({
						modal: true
						//show: "blind",
						//hide: "explode"
					});
					
					return;
				}
				//checks for time 24 
				else if(!json.timeCheck24)
				//else if(json.timeCheck24)
				{
					var alertHTML = '<?php echo $lREADY_TALK_OP;?>';
					$( "#dialog p").html(alertHTML);
					$( "#dialog" ).dialog({
						modal: true
					});
					
					return;
				}
				else {
					var _showstr = '<?php echo $lBOOKING_SUMMARY;?>';
					$.each(json.classTimes,function(k,v){
						_showstr += v + "";
					})
					//alert(_showstr);
					_showstr += '<?php echo $lcredit ?> '+parseFloat(json.cost).toFixed(2)+'<?php echo $lyour ?>.<?php echo $lOK_TO_CONFIRM;?>\r\n';
					if(!window.confirm(_showstr)){
						return;
					}
					//Calendar.getInstance().getEvent();
				 
				// sendMessage();
					var _sid = '<?php echo $this->session->userdata('uid');?>';
		            var _uidurl =  <?php echo $profile['uid']?>
					//alert(json.classTimes);
					var _days = {};
					
			_days['day'] = _day;
			var schoolid =  $('#schoolid').val();
			
			
			//alert(_days['day']);
					$.post('<?php echo Base_url('user/addSlotTimebyst');?>',{seletedSlot:_data['seletedSlot'],sTopic : sessionTopic , sLevel : sessionLevel,sid:_sid,tid:_uidurl,day:_days['day'],schoolId:schoolid},function(msg){
					  //alert(JSON.stringify(msg));return false;
					if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
					
			//$.post('<?php echo Base_url('user/buyClasses/uid/'.$profile["uid"]);?>',{seletedSlot:json.classTimes,sTopic : sessionTopic , sLevel : sessionLevel},function(msg){
			 //alert(json);
			//alert('add slot');
			
			///////////msg send start////////////
			var _uidurl = <?php echo $profile["uid"];?>;
			selected_slot = _data['seletedSlot'];
			days_date=_days['day'];

			var _data1 = {subject:'Request schedule',message:' is requesting '+days_date+' at '+selected_slot+' ',uidurl:_uidurl,sTopic : sessionTopic , sLevel : sessionLevel,eventdat:days_date,eventtime:json.start_time};
 
			$.post('<?php echo base_url("user/message_send_schedule_request");?>',_data1,function(msg){
					/*alert(JSON.stringify(msg));
					return false;*/
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			//return false;
			if(json.status){
				//$('#dialog').html('Send Success..');
				  //alert('<?php echo $lBOOKED_SUCCESS; ?>');
				//$('#dialog').dialog({modal:true});
				$('#username').val('');
				$('#subject').val('');
				$('#message').val('');
				//document.location.href = '<?php echo base_url('user/inbox');?>';
				document.location.href="<?php echo base_url('user/calendar/uid/'.$profile["uid"]);?>";
			}
			else{				
				$('#dialog').html(json.msg);
				$('#dialog').dialog({modal:true});
			}
			$('#send').attr('buttontype','done');
		})
		////////////msg end//////////////

			//sendMessage(_data['seletedSlot'],_days['day']);
			 // return false;
				if (String == msg.constructor) {      
					eval ('var json = ' + msg);
				} else {
				/* Otherwise assume it is a hash already. */
					var json = msg;
				}
				//console.info(json.success);
				
				//--Detect IE browser
				if ( $.browser.msie || $.browser.mozilla) {
					var userAgentIe = true; 
				}else{
					var userAgentIe = false;
				}

				if(json.success == 'false' || json.success == false){
					alert(json.msg);
				}
				else {
				
				
					Calendar.getInstance().getEvent();
					//alert('<?php echo $lBOOKED_SUCCESS;?>');
			 
					var _nasa={};
					 _nasa["cnv"] = wcs.cnv("4","10"); // ÀüÈ¯À¯Çü, ÀüÈ¯°¡Ä¡ ¼³Á¤ÇØ¾ßÇÔ. ¼³Ä¡¸Å´º¾ó Âü°í

					//alert('Is First-Time :' + json.firsttime);
					//if(userAgentIe === true){
					if(userAgentIe === true  && json.firsttime === true){
						$('#messageIe').dialog({modal: true});
						$('#messageIe').css('display','block');
					}else{
						//document.location.href="<?php echo base_url('user/calendar');?>";
						//document.location.href="<?php echo base_url('user/calendar/uid/'.$profile["uid"]);?>";
					}
					//document.location.href="<?php echo base_url('user/calendar');?>";
				}
				
				
				
			})
					
					////////////
					//alert('msg');
					
					function sendMessage(selected_slot,days_date){
		 //  alert('msg ss here');
		var _uidurl = <?php echo $profile["uid"];?>;
		 //alert(_uidurl);
		//alert(selected_slot);
		//return false;
		var _data = {subject:'Request schedule',message:' is requesting '+days_date+' at '+selected_slot+' ',uidurl:_uidurl,sTopic : sessionTopic , sLevel : sessionLevel,eventdat:days_date,eventtime:selected_slot};
		//alert(_data.uname);return false;
		 
		$.post('<?php echo base_url("user/message_send_schedule_request");?>',_data,function(msg){
		  //alert(JSON.stringify(msg));
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			//return false;
			if(json.status){
				//$('#dialog').html('Send Success..');
				  alert('<?php echo $lBOOKED_SUCCESS; ?>');
				//$('#dialog').dialog({modal:true});
				$('#username').val('');
				$('#subject').val('');
				$('#message').val('');
				//document.location.href = '<?php echo base_url('user/inbox');?>';
				document.location.href="<?php echo base_url('user/calendar/uid/'.$profile["uid"]);?>";
			}
			else{				
				$('#dialog').html(json.msg);
				$('#dialog').dialog({modal:true});
			}
			$('#send').attr('buttontype','done');
		})
	}
	/////////////////
					
					
				}
			})			
			
			
			
			
			}
			///////////Request for schedule by student end //
		///	if close
			
			
			
			//////click close/////////''''''''''''''''///////////////////////////////
			
		})
		
		
		/////////
		
		

		//----IE Message Radio Button
		$('#browserChromeYes').click(function(){
			$('#ieMessageText').html('<?php echo $lLOGIN_CHROME;?>');
			$('#ieMainOption').css('display','none');
			$('#ieCloseOption').css('display','block');
		});
		$('#ieCloseOptionLink').click(function(){
			$( "#messageIe" ).dialog( "destroy" );
		});
		
		
		
		$('#browserChromeNo').click(function(){
			$('#ieMessageText').html('<?php echo $lDW_CHROME;?>');
			$('#ieSubMessage').css('display','block');
			$('#ieMainOption').css('display','none');
		});
		$('#browserChromeDownloadNo').click(function(){
			$('#ieMessageText').html('<?php echo $lIE_WARNING;?>');
			$('#ieSubMessage').css('display','none');
		});
		$('#browserChromeDownloadYes').click(function(){
			var targetUrl = "https://www.google.com/intl/en/chrome/browser/?hl=en&brand=CHMA&utm_campaign=en&utm_source=en-IN-ha-bk&utm_medium=ha&utm_term=%2Bchrome";
			$( "#messageIe" ).dialog( "destroy" );
			window.open(targetUrl);
		});
		//----IE Message Radio Button

		$('.myEvent tr.Opened').live('click',
			function(){
				if($(this).hasClass('Booked') || $(this).hasClass('Ended')){
					return;
				}
				
			 
				if(!$(this).hasClass('setted')){
					$(this).addClass('setted');
					//$(this).removeClass('Opened');
				}
				else{
					$(this).removeClass('setted');
					//$(this).removeClass('Opened');
				}
			}
		)
		var howMany = 0;
		$('.timeSlot').live('click',
			function(){
			if($(this).hasClass('Booked') ||  $(this).hasClass('requested') || $(this).hasClass('Ended')){
					return;
				}
				 howMany += 1;
				// alert(howMany);
				
				if(!$(this).hasClass('setted')){ 
					$(this).addClass('setted');
					$(this).css("font-weight","900");
					 $(this).css("background-color", "#3399c9");
				}
				if($(this).hasClass('Open')){
				 //alert('okk');
				$(this).removeClass('Open');
					//$(this).addClass('setted');
					$(this).css("background-color", "#84c022");
				}
				  if(!$(this).hasClass('Open')){
				$(this).removeClass('Open');
					$(this).addClass('Open_tp');
				}
				 
				  

				if (howMany %2 != 0){
					$(this).css("font-weight","900");
				}else{
					$(this).css("font-weight","500");
					_seletedSlot.length = 0;
					
				}


				
  //if($(this).css("font-weight","900")){
  //alert('56');
  //$(this).css("font-weight","100");
			//	$(this).removeClass('setted');
				//$(this).removeClass('Open_tp');
				//$(this).css("font-weight","100");
					//$(this).addClass('Open_tp');
				 //}
				
				//else{
				 
					//$(this).removeClass('setted');
					//$(this).addClass('setted');
					// $(this).removeClass('Opened');
				//}
			}
		)
		
 
		
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
		$('#calanderdialogclose a').click(function(){
			$('#calendarEventDialog').hide();
		})
		
		Calendar.getInstance().eventCallback = function(){
			
			$('.event a').toggle(function(){  
				var day = $(this).attr('day');
				createTimeSlotList(day);
				$('#calendarEventDialog').show();
				 
				$('.statusBar').show();
				$.getJSON('<?php echo Base_url("user/ajax_eventDetail");?>',{start:day,uid:<?php echo $profile['uid'];?>,rand:Math.random()},function(msg){
					//console.info(s);
					
				//	alert(JSON.stringify(msg));
					
					$('.statusBar').hide();
					if (String == msg.constructor) {      
						eval ('var s = ' + msg);
					} else {
						var s = msg;
					}
					if(typeof(s.status)!='undefined' &&!s.status){
						alert(s.msg);
						return;
					}
					var str = '';
					var strTemp = $('#MyEventListTemp tbody').html();
					$.each(s.rows,function(k,v){
						var _k = v.start;
						_k = _k.replace(' ','');
						_k = _k.replace(':','');
						if(_k.substr(0,1) == '0'){
							_k = _k.substr(1);
						}
						var status = '';
						var statusStr = '';
						
						if(typeof(v.sid)!='undefined'){
							//status = '<?php echo $lBOOKED;?>';
							$('.timeSlot[eregkey='+_k+']').addClass('Booked');
							status = '<?php echo $lBOOKED;?>';
							//statusStr = '<?php echo $lBOOKED;?>';
							
						}
												
						if(s.rows[k].stid!='undefined' && typeof(v.sid)=='undefined' ){
							//status = '<?php echo "alredy request ";?>';
							//status = '<?php echo "already request ";?>';
							$('.timeSlot[eregkey='+_k+']').addClass('requested');
							status = '<?php echo $abooked;?>';
							
							//$
						}
                         //if(s.rows[k].stid=='undefined' && typeof(v.sid)=='undefined' && s.rows[k].openby==1 )
						   if(s.rows[k].openby==0 ){
							//status = '<?php //echo $lOPENED;?>';
							//status = '<?php echo 'book';?>';
							status = '<?php echo $lOPEN;?>';
							//$('.[eregkey='+_k+']').addClass(status);
							$('.timeSlot[eregkey='+_k+']').removeClass('requested');
							$('.timeSlot[eregkey='+_k+']').addClass('Open_tp');
							$('.timeSlot[eregkey='+_k+']').addClass('Opened');
							$(this).css("font-weight","900");
						}
										
						
					//	else{
							//status = '<?php echo $lOPENED;?>';
						//	status = '<?php echo "Opened";?>';
							//statusStr = '<?php echo $lBOOK_NOW;?>';
					//	}
						str += strTemp.replace('__TIME__',v.start).replace('__KEY__',v.start).replace('__INDEX__',(k+1)).replace('__STATUSSTR__',statusStr).replace('__STATUS__',status);
						//console.info('.timeSlot[eregkey='+_k+']');
						//$('.timeSlot[eregkey='+_k+']').addClass('setted');
						
						//$('.timeSlot[eregkey='+_k+']').addClass(status);
						// $('.timeSlot[eregkey='+_k+']').addClass('setted');
						$('.timeSlot[eregkey='+_k+']').html(status);
						
						$('.timeSlot[eregkey='+_k+']').addClass(status);
						
					})
					
					//$('.myEvent tbody').html(str);
					//_dayStr = $('.dayStr').html();
					//$('.myEvent tr').each(function(){
					
					$('.timeSlot tbody').html(str);
					_dayStr = $('.dayStr').html();
					$('.timeSlot').each(function(){
						
						var currentDT = new Date();
						var timeZoneOffset = currentDT.getTimezoneOffset() / 60;

						var currentUTCdtStr1 = <?php echo strtotime(date('Y-m-d H:i:s',time() + (24*60*60))); ?>;

						var currentUTCdtStr = <?php echo strtotime(date('Y-m-d H:i:s',time())); ?>;
						
						// alert(currentUTCdtStr);
						var loopDT = new Date( _dayStr + ' ' + $(this).attr('key') );
							 //alert(loopDT);
						var loopUTCdtStr = Date.parse(loopDT)/1000;
						//alert(loopUTCdtStr);
						
						if(loopUTCdtStr  < currentUTCdtStr1){
						//if(new Date( _dayStr + ' ' + $(this).attr('key') )  < new Date()){
						$(this).addClass('Ended');
						//$(this).children('.tl').html('<?php echo $lENDED;?>');
						 $(this).html('<?php echo $lENDED;?>');
						}
						
						
						//if(loopUTCdtStr  < currentUTCdtStr1 ){
						//if(new Date( _dayStr + ' ' + $(this).attr('key') )  < new Date()){
						//$(this).addClass('Ended');
						//$(this).children('.tl').html('<?php echo $lENDED;?>');
						// $(this).html('<?php echo "can not";?>');
						//}
						
						
						
						
					})
				})
				$('#calendarEventDialog').data('in',1);
				//console.info($(this).offset().left + $('#calendarEventDialog').width())
				if($(this).offset().left + $('#calendarEventDialog').width() >document.documentElement.clientWidth){
					_pos = 'right';
					$('#calendarEventDialog').css('left' ,'');
					$('#calendarEventDialog').css('right' ,document.documentElement.clientWidth-$(this).offset().left-50);
				}
				else{
					$('#calendarEventDialog').css('right' ,'');
					$('#calendarEventDialog').css('left' ,$(this).offset().left);
				}
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
			
			getNowDateAndShow();
		}
		Calendar.getInstance().setEventUrl('<?php echo Base_url("user/ajax_events");?>').render();
		$('#addClassTime').click(function(){
			var _start = $('#startDay').val() + ' ' + $('#startTime').val();
			var _end = $('#endDay').val() + ' ' + $('#endTime').val();
			if ( new Date(_start) == 'Invalid Date'){
				alert('<?php echo $lINVALID_START_DATE;?>');
				return;
			}
			if(new Date(_end) == 'Invalid Date'){
				alert('<?php echo $lINVALID_END_DATE;?>');
				return;
			}
			start = new Date(_start);
			end = new Date(_end);
			$.post('<?php echo Base_url('user/addClass/uid/'.$profile['uid']);?>',{start:start.toString(),end:end.toString()},function(msg){
				if (String == msg.constructor) {
					eval ('var json = ' + msg);
				} else {
				/* Otherwise assume it is a hash already. */
					var json = msg;
				}
				if(json.success == 'false' || json.success == false){
					alert(json.msg);
				}
				else {
					Calendar.getInstance().getEvent();
					alert('<?php echo $lADD_SUCCESS;?>');
				}
			})
		})
		
		
	  $("span.ltimez").hover(function () {
		//$(this).append('<div class="tooltip3"><p>The times shown on your calendar and messaging are calculated based on the IP address where you are currently logged in. A booking message that occurs while you are on travel will be based on the timezone of last login.</p></div>');
		$(this).append('<div class="tooltip3"><p><?php echo $thetimeshowntooltip;?></p></div>');
	  }, function () {
		$("div.tooltip3").remove();
	  });
		
	})

	$(document).ready(function () {
			//$("td.abc").addClass("clickdisplay");
			  $(".speakingLevelToolTip").hover(function () {
				//alert('Hello');
				$('.payment').append("<div class='tooltip-payment'><p><?php echo $lSPEAKING_LEVEl_TIP;?></p></div>");
			  }, function () {
				$("div.tooltip-payment").remove();
			  });
			  
		$( '#bNote' ).html('');
		$( '#bNote' ).html('<img src="http://thetalklist.com/images/orange-dot.png"> = <?php echo $lBOOKING;?>');
		  
	});
	</script>
	
	 <script>
	var attempts = 0;
function addToPotential(id){
 
	<?php if($roleIdn != 0) {?>
		alert('Bookings are reserved for student accounts');
		return false;
	<?php } else { ?>
	$('#dialog').html('updating');
	$('#dialog').attr('buttonType','doing');
	$('#dialog').dialog({modal:true});
	$.post('<?php echo base_url('user/addPotentialTeachers');?>',{id:id},function(result){
		if (String == result.constructor) {
			//eval ('var result = ' + result);
			var result;
			//result = eval('(' + msg + ')');
			eval('result = ' + result);
		}
		$('#dialog').attr('buttonType','done');
		if(result.error){
			$('#dialog').html(result.msg);
		}
		else {
			$('#dialog').html('updated');
			//$('#dialog').attr('buttonType','done');
		}
	})
	<?php
	}
	?>
}
	</script>
	<script>
	function bookNow(tid,username)
{

//alert(tid);

var lastClickedOnBook = false;
	//prevent multiple clicks
	if(lastClickedOnBook == true){return false;}
	lastClickedOnBook = true;
	
	//if(_uid == '')
	//{
		//alert('Login First!');
		//return false;
	//}
	var _data = {};
	<?php if($this->session->userdata('uid')): ?>
	_data['sid'] = <?php echo $this->session->userdata('uid'); ?>;
	<?php else: ?>
	_data['sid'] = 0;
	<?php endif; ?>
	_data['tid'] = tid;
	//window.returnvar = true;
	
	$.post('<?php echo Base_url('user/checkClassBookNow');?>',_data,function(msg){
	/*alert(msg);
	return false;*/
		if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
		if(json.success == 'false' || json.success == false){
			alert(json.msg);
		}else if(!json.enough){
			window.returnvar = false;
			window.avl = true;
			window.profileComplete = true;
			
		}else if(!json.availabletobook){
			window.returnvar = false;
			window.avl = false;
			window.profileComplete = true;
			
		}else if(!json.profileCompletion){
			window.returnvar = false;
			window.avl = true;
			window.profileComplete = false;
			
		}else{
			window.returnvar = true;
		}
		if(!json.firstBookNow ){
			window.firstBookNow = false;
		}else{
			window.firstBookNow = true;
			window.profileComplete = true;
		}
		if(json.totalNumSess > 1){
			window.totalNumSess = false;
		}else{
			window.totalNumSess = true;
		}
		
		
		//alert(json.enough);
		
		if(json.enough)
		{
		window.enough=true;
		}
		else
		{
		window.enough=false;
		}
		
		
	})
	setTimeout(function(){
		lastClickedOnBook = false;
		if(window.returnvar == false)
		{
			lastClickedOnBook = false;
			if(window.avl == false)
			{
				//var alertHTML = 'You have alredy booked.';
				if(window.firstBookNow == false){
					var alertHTML = 'You have already booked your Session.';
				}else{
					var alertHTML = 'You have already booked your Free Session.';
				}
				
				
				$( "#dialog").html(alertHTML);
				$( "#dialog").dialog({modal: true});
				return false;
			}else if(window.profileComplete == false){
				alert('Please complete your personal profile before your booking');
				window.location.href = "<?php echo base_url(); ?>user/registeredit/";
				return false;
			}
			
			else if(window.enough==true){
				var message = "Tutor will be sent invitation and will have 5 minutes to join your tutoring session.  You will be sent to Dashboard page with a countdown timer.  When tutor arrives, you will be automatically launched into your session.";
			      var conf = confirm(message);
				 if(conf == true)
			{
			 	// send message to tutor
				$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid},function(msg){
					//redirect to student dashboard page
						window.location.href = '<?php echo Base_url("user/dashboard");?>';
				});
			}else{
				return false;
			}
			  
			}
			 
			else{
				var rechargeURL = '<?php echo base_url(); ?>user/account/';
				var alertHTML = 'Insufficient credits to buy a session.  Please <a href="'+rechargeURL+'" >recharge</a> account.';
				$( "#dialog").html(alertHTML);
				$( "#dialog").dialog({modal: true});
				return false;
			}
		}else{
			if(window.firstBookNow == false){
				var message = "Tutor will be sent invitation and will have 5 minutes to join your tutoring session.  You will be sent to Dashboard page with a countdown timer.  When tutor arrives, you will be automatically launched into your session and your account will be debited.";
			          
			}else{
				var message = "Tutor will be sent invitation and will have 5 minutes to join your tutoring session.  You will be sent to Dashboard page with a countdown timer.  When tutor arrives, you will be automatically launched into your session.";
			   
			
			}
			//var message = "You are booking a class with "+username+" right now. If they confirm this booking then you will automatically be launched into the Vee-session. If they haven’t entered your classroom within the 3minute countdown timer, then feel free to exit the session and your account will be credited.";
			//var message = "Tutor will be sent invitation and will have 5 minutes to join your tutoring session.  You will be sent to Dashboard page with a countdown timer.  When tutor arrives, you will be automatically launched into your session and your account will be debited.";
			
			 var conf = confirm(message);
			if(conf == true)
			{
			 
				// send message to tutor
				$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid},function(msg){
				
						//redirect to student dashboard page
						window.location.href = '<?php echo Base_url("user/dashboard");?>';
				});
			}else{
				return false;
			}
			lastClickedOnBook = false;
		}
		
		
	},2500);
	//lastClickedOnBook = false;
}
	</script>
	
<style>
span.ltimez{
  cursor: pointer;
  display: inline-block;
}

div.tooltip3 {
  background-color: #037898;
  color: White;
  position: absolute;
  left:709px !important;
  top: 245px !important;
  z-index: 1000000;
  width: 250px; 
  border-radius: 5px;
  line-height:15px;
}
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
  position: absolute;
  top: 40%;
  left: -6px;
}
div.tooltip3 p {
  margin: 10px;
  color: White;
  font-weight: normal;
  font-size:12px;
  text-decoration:none;
}

 
	 .teacher_prof li a.prof_on span{ background-position:-310px -333px !important;}
	 .wrap {
    margin-top: 210px;
}
	</style>
</style>