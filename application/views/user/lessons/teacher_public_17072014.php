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
$arrVal 		= $this->lookup_model->getValue('206', $multi_lang);
$lpurchasevideo		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('207', $multi_lang);
$llesson		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('202', $multi_lang);
$lrecorded		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('203', $multi_lang);
$llength		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('47', $multi_lang);
$lprice			= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('208', $multi_lang);
$lbuyclass		= $arrVal[$multi_lang];
$arrVal 		= $this->lookup_model->getValue('87', $multi_lang);
$ldescription	= $arrVal[$multi_lang];
?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.blockUI.js"); ?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
 <div class="baseBox baseBoxBg clearfix">
    	 
        <div class="content_main fr">
        	<div class="main_inner">
                <ul class="student_prof teacher_prof">
                    <?php echo profile_menu('t_public','l_prof',$profile['uid']);?>
                </ul>
				<?php echo mailAptBtn($chkfreesession,$profile['uid']);?>
                <!--/student_prof-->
                <div id="teacher_prof_Wp">
                    <div class="mod">
                       
                            <div class="content"><h2><?php echo $llesson;?></h2></div>
                     
                        <div class="video_intro_desc"><?php echo $lpurchasevideo;?></div>
                        <div class="bd">
                            <ul class="archivedList lessonsPubList">
                                <?php foreach($lessons as $k=>$lesson):?> <!--
                                <li class="lesson">
                                	<div class="video_pic_163x90 posR fl">
                                    	<a href="javascript:void(0)">
                                        	<img src="<?php echo profile_video($lesson['source']);?>" width="163" height="90" />
                                            <span class="video_ic video_ic_s"></span>
                                        </a>
                                    </div>
                                    <div class="video_pic_intro c666">
                                    	<div class="video_hd clearfix">
                                        	<h3 class="c424242 f14 fl">
                                            	<a href="javascript:void(0)" class="lname"><?php echo $lesson['name'];?></a> - <span class="c047d9e"><a href="<?php echo tl_url('user/profile',$lesson['uid']);?>" class="tname"><?php echo $lesson['firstName'],' ',$lesson['lastName'];?></a></span>
                                                 - Price <span class="cbd0000 lprice">$<?php echo round($lesson['price'] * (1+$config['LES_PRICE_PERCENT']['value']) *100) /100;?></span>
                                            </h3>
                                        </div>
                                        <div class="archived_desc">
                                        	<strong>Description: </strong> 
                                            <?php echo $lesson['desc'];?> 
                                       	</div>

                                        <div class="archived_info clearfix">
                                        	<span class="fl">Recorded: <?php echo $lesson['creat_at'];?></span>
                                        	<span class="fr">Length: <?php echo $lesson['length'];?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="set_price">
                                    	New Price<br />
                                        $ <input type="text" class="new_prize_ipt price"  value="<?php echo $lesson['price'];?>"/>
										<input type="hidden" value="<?php echo $lesson['id'];?>" class="lesson_id"/>
                                        <div class="addBtn_Wp">
                                        	<a href="javascript:void(0)" class="norBtn yellowRadiusBtn w96 setPrice">Set Price</a>
                                        </div>
                                    </div>
                                </li>-->
								<li  class="lesson">
                                	<div class="video_pic_163x90 posR fl">
                                    	<a href="javascript:void(0)"><img src="<?php echo profile_video($lesson['source']);?>" width="163" height="90" /><span class="video_ic video_ic_s"></span></a>
                                    </div>
                                    <div class="video_pic_intro c666">
                                    	<div class="video_hd clearfix">
                                        	<h3 class="c424242 f14 fl" style="margin-top:15px;">
                                            	<?php echo $lprice;?> <span class="cbd0000 price">$<?php echo number_format(round($lesson['price'] * (1+$config['LES_PRICE_PERCENT']['value']) *100) /100,2,'.','');?></span>
												-<a href="javascript:void(0)"><?php echo $lesson['name'];?></a>
												-<span class="c047d9e">
													<a href="<?php echo tl_url('user/profile',$lesson['uid']);?>"><?php echo $lesson['firstName'],' ',$lesson['lastName'];?></a>
												</span>
												<input type="hidden" value="<?php echo $lesson['id'];?>" class="lesson_id"/>
                                            </h3>
                                            <span class="fr"><a class="addmore_v_btn yellowRadiusBtn w96 buyClass" href="javascript:void(0)"><?php echo $lbuyclass;?></a></span>
                                        </div>
                                        <div class="archived_desc">
											<strong><?php echo $ldescription;?>: </strong> 
											<?php echo $lesson['desc'];?> 
                                        </div>
                                        <div class="archived_info clearfix">
                                        	<span class="fl"><?php echo $lrecorded;?>: <?php echo date( 'h:i a, M d, Y' , outTime($lesson['creat_at']));?></span>
                                        	<span class="fr"><?php echo $llength;?>: <?php echo sec2min($lesson['length']);?></span>
                                        </div>

                                        <!--<div id="" class="ratings_score_2b"><s class="ratings_score_yellow star4"></s></div>-->
                                    </div>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div><!--/mod-->
                    
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
	<script>
	$(function(){
		$('.buyClass').click(function(){
			var _data = {};
			var _button = $(this);
			var _li = $(this).parents('li.lesson');
			_data['id'] = _li.find('.lesson_id').val();
			_data['price'] = _li.find('.price').html();
			_button.html('Updating..').attr('buttontype','doing');
			$.post('<?php echo base_url("user/buy_lesson");?>',_data,function(msg){
				if (String == msg.constructor) {      
					eval ('var json = ' + msg);
				} else {
					var json = msg;
				}
				if(json.status == true || json.status == 'true'){
					$('#dialog').html('Successfully purchased.');
					$('#dialog').dialog({
						modal: true,
						buttons: {
							"Ok": function() {
								document.location.href='<?php echo base_url('user/lessons');?>';
							}
						}
					});
				}
				else {
					alert(json.msg);
					$.blockUI({ message: '<img src="<?php echo base_url();?>images/loading26.gif" />' });
					$.unblockUI();
					/*$('#dialog').html(json.msg);
					$('#dialog').dialog({modal: true});*/
				}
				_button.attr('buttontype','done').html('Buy Class');
			});
		})
		
	})
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
	 .teacher_prof li a.prof_on span{ background-position:-310px -333px !important;}
	 .wrap {
    margin-top: 210px;
}
	</style>