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
$arrVal = $this->lookup_model->getValue('192', $multi_lang);
$lcurrenttutor = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('193', $multi_lang);
$lhourlyrate = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('194', $multi_lang);
$lremove = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('195', $multi_lang);
$lprofile = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('196', $multi_lang);
$lappointment = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('197', $multi_lang);
$lpotentialtutor = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('324', $multi_lang);
$sessionratetext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('321', $multi_lang);
$creditstext = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('731', $multi_lang);
$scheudle = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('740', $multi_lang);
$smessage = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('741', $multi_lang);
$tnow = $arrVal[$multi_lang];

?>
<?php $this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js");?>
<?php $this->layout->appendFile('javascript',"js/fullCalendar.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/calendar.js");?>
<?php $this->layout->appendFile('css',"css/calendar.css");?>
 <div class="baseBox baseBoxBg clearfix">
 <div id="sendMessageView" class="sendMessageView" style="display:none;"></div>
        <div class="content_main fr">
        	<div class="main_inner">
                <ul class="student_prof">
					<?php echo profile_menu('s_private','t_prof',$profile['uid']);?>
                </ul>
                <!--/student_prof-->
                <div id="student_prof_Wp">
                	<div class="mod">
                        
                            <div class="content tle"><h2><?php 	echo $lcurrenttutor;?></h2></div>
                       
                        <div class="bd">
                        	<ul class="teacher_list clearfix">
                                <?php

//print_r($teachers);die();
								
								foreach($teachers as $k=>$teacher):?>
								<?php if($teacher['type']==0):?>
								<li class="teacher_box">
                                    <div class="techer_box_t"></div>
                                    <div class="techer_box_c">
                                    	<div class="teacher_info fl">
                                        	<div><a href="javascript:void(0)"  tid="<?php echo $teacher['id'];?>" class="c939393 delTeacher"><em class="ico_op ico_del2"></em><?php echo $lremove;?></a></div>
                                            <p class="c437a86"><?php echo $sessionratetext;?>:</p>
											<p><?php echo number_format(round($teacher['hRate'] * (1+$config['VEE_PRICE_PERCENT']['value']) * 100) /100,2,'.','');?> <?php echo $creditstext;?></p>
                                        </div>
                                        <div class="teacher_header fr">
                                        	<p><a href="<?php echo tl_url('user/profile',$teacher['tid']);?>" title=""><img src="<?php echo profile_image($teacher['pic']);?>" width="111"  alt="" style="max-height:125px"/></a></p>
                                           
                                        </div>
                                        <div class="spc10c"></div>
                                        <div class="teacher_name"><?php echo $teacher['firstName'],' ',$teacher['lastName'];?></div>
                                        <div class="agnC ">
                                        	<!--<a href="<?php echo tl_url('user/profile',$teacher['tid']);?>" class="norBtn grayRadiusBtn w96 f12"><?php echo $lprofile;?></a>
                                            <a href="<?php echo tl_url('user/calendar',$teacher['tid']);?>" class="norBtn redRadiusBtn2 w96 f12"><?php echo $lappointment;?></a>--->
											
											<div class="nw-tutr-btn">
                                                                <a class="icon1 icon-popup"  onclick="sendBeepBoxMessage(<?php echo $teacher['tid'] ;?>)">&nbsp;<span class="classic"><?php echo $smessage; ?></span></a>
                                                                <!---<a class="icon2 icon-popup" href="<?php echo base_url('/user/calendar/uid/'.@$newtutor['uid']); ?>">&nbsp;<span class="classic">Appointment</span></a>-->
<a class="icon2 icon-popup" href="<?php echo tl_url('user/calendar',$teacher['tid']);?>">&nbsp;<span class="classic"><?php echo $scheudle; ?></span></a>
															   <?php  if($teacher['readytotalk'] == 1)
																{?>
																<a class="icon3 icon-popup" onclick="bookNow(<?php echo $teacher['tid'] ;?>,'<?php echo $teacher['firstName'];?>')">&nbsp;<span class="classic"><?php echo $tnow; ?></span></a>
                                                                <?}else{?>
																<a class="icon3 icon-popup icon3-gray" >&nbsp;<span class="classic"><?php echo $tnow;?></span></a>
																<?}?>
                                                            </div>
											
                                        </div>
                                    </div>
                                </li>
								<?php endif;?>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mod">
                       
                            <div class="content tle"><h2><?php echo $lpotentialtutor;?></h2></div>
                        
                        <div class="bd">
                        	<ul class="teacher_list clearfix">
                                <?php foreach($teachers as $k=>$teacher):?>
								<?php if($teacher['type']==1):?>
								<li class="teacher_box">
                                    <div class="techer_box_t"></div>
                                    <div class="techer_box_c">
                                    	<div class="teacher_info fl">
                                        	<div><a href="javascript:void(0)" class="c939393 delTeacher" tid="<?php echo $teacher['id'];?>"><em class="ico_op ico_del2"></em><?php echo $lremove;?></a></div>
                                            <p class="c437a86"><?php echo $sessionratetext;?>:</p>
											<!--<p><?php // echo @$teacher['hRate'];?> credits</p>-->
											<p><?php echo number_format(round($teacher['hRate'] * (1+$config['VEE_PRICE_PERCENT']['value']) * 100) /100,2,'.','');?> <?php echo $creditstext;?></p>
                                        </div>
                                        <div class="teacher_header fr">
                                        	<p><a href="<?php echo tl_url('user/profile',$teacher['tid']);?>" title=""><img src="<?php echo profile_image($teacher['pic']);?>" width="111"  alt="" style="max-height:125px"/></a></p>
                                           
                                        </div>
                                        <div class="spc10c"></div>
                                        <div class="teacher_name"><?php echo $teacher['firstName'],' ',$teacher['lastName'];?></div>
                                        <div class="agnC ">
                                        	<!--<a href="<?php echo tl_url('user/profile',$teacher['tid']);?>" class="norBtn grayRadiusBtn w96 f12"><?php echo $lprofile;?></a>
                                            <a href="<?php echo tl_url('user/calendar',$teacher['tid']);?>" class="norBtn redRadiusBtn2 w96 f12"><?php echo $lappointment;?></a>-->
                                        </div>
										
										
										<div class="nw-tutr-btn">
                                                                <a class="icon1 icon-popup"  onclick="sendBeepBoxMessage(<?php echo $teacher['tid'] ;?>)">&nbsp;<span class="classic"><?php echo $smessage; ?></span></a>
                                                                <!---<a class="icon2 icon-popup" href="<?php echo base_url('/user/calendar/uid/'.@$newtutor['uid']); ?>">&nbsp;<span class="classic">Appointment</span></a>-->
<a class="icon2 icon-popup" href="<?php echo tl_url('user/calendar',$teacher['tid']);?>">&nbsp;<span class="classic"><?php echo $scheudle;?></span></a>
															   <?php  if($teacher['readytotalk'] == 1)
																{?>
																<a class="icon3 icon-popup" onclick="bookNow(<?php echo $teacher['tid'] ;?>,'<?php echo $teacher['firstName'];?>')">&nbsp;<span class="classic"><?php echo $tnow; ?></span></a>
                                                                <?}else{?>
																<a class="icon3 icon-popup icon3-gray"  >&nbsp;<span class="classic"><?php echo $tnow; ?></span></a>
																<?}?>
                                                            </div>
										
                                    </div>
                                </li>
								<?php endif;?>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                <!--/student_prof_Wp-->
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
	<script>
	$(function(){
		$('.delTeacher').hide();
		$('.teacher_box').hover(function(){
			$('.delTeacher',this).show();
		},function(){
			$('.delTeacher',this).hide();
		})
        $('.delTeacher').click(function(){
            if(window.confirm('Are you sure you want to delete this tutor?')){
                var _id = $(this).attr('tid');
                var _delObj = $(this);
                $.get('<?php echo base_url('user/delTeacher');?>',{id:_id},function(msg){
                    
                    if (String == msg.constructor) {      
                        eval ('var json = ' + msg);
                    } else {
                        var json = msg;
                    }
                    if(json.success == 'false' || json.success == false){
                        alert(json.msg);
                    }
                    else {
                        //Calendar.getInstance().getEvent();
                        //alert('Delete success!');
                        _delObj.parents('.teacher_box').remove();
                    }

                })

            }

        })
	})
	</script>
	
	<script>
function sendBeepBoxMessage(uid)
{  //alert(uid);
	if(uid == '')
	{
		alert('Login First!');
		return false;
	}
	var lodUrl = '<?php echo base_url(); ?>user/load_send_message/uid/'+ uid;
	$('#sendMessageView').load(lodUrl);
	$('#sendMessageView').show();
}

 function bookNow(tid,username)
{
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
		}
		if(json.totalNumSess > 1){
			window.totalNumSess = false;
		}else{
			window.totalNumSess = true;
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
			}else{
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
  #sendMessageView .content_main{ border-radius:0 !important; border:4px solid #0087D0;}
</style>