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
$arrVal = $this->lookup_model->getValue('195', $multi_lang);
$lprofile = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('40', $multi_lang);
$lratings = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('54', $multi_lang);
$lsessions = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('55', $multi_lang);
$loverallrating = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('281', $multi_lang);
$lmp4avi = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('49', $multi_lang);
$lbiography = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('50', $multi_lang);
$lskiing = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('51', $multi_lang);
$lbackpacking = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('52', $multi_lang);
$arrVal 	= $this->lookup_model->getValue('649', $multi_lang);	$laddtopotential  	= $arrVal[$multi_lang];
$lreading = $arrVal[$multi_lang];

if($roleIdn == 0)
{
	$apointmentbutton = $lcreateappointment;
	$potentialbutton  = $laddtopotential;
}else{
	$apointmentbutton = $lcreateappointment;
	$potentialbutton  = $laddtopotential;
}
?>
<?php $this->layout->appendFile('css',"css/search.css");?>
<?php $this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js");?>
<?php $this->layout->appendFile('javascript',"js/fullCalendar.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/projekktor-1.1.00r107.min.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/calendar.css");?>
<?php $this->layout->appendFile('css',"css/palyerTheme/style.css");?>
 <div class="baseBox baseBoxBg clearfix">
     
	 <?php // echo $chkfreesession;?>
     
     <!--<div class="tutrpg-icon">
     	<a class="icon-msg icon-popup"  onclick="sendBeepBoxMessage(<?php echo $criterias['uid'] ;?>)">&nbsp;<span class="classic">Send Message</span></a>
        <a class="icon-sedl icon-popup"  href="<?php echo base_url('/user/calendar/uid/'.@$criterias['uid']); ?>">&nbsp;<span class="classic">Schedule</span></a>
        <a class="icon-tk-nw icon-popup" onclick="bookNow(<?php echo $criterias['uid'] ;?>,'<?php echo $criterias['firstName'];?>')">&nbsp;<span class="classic">Talk Now</span></a>
        <a class="icon-fav icon-popup" href="#">&nbsp;<span class="classic">Favorites</span></a>
     </div>-->
     
        <div class="content_main fr">
        	<div class="main_inner">
                <ul class="student_prof teacher_prof">
                    <?php echo profile_menu('t_public','p_prof',$profile['uid']);?>
                </ul>
				
				<?php 
								
				 echo mailAptBtn($chkfreesession,$profile['uid']);
					
				  ?>
                <!--/student_prof-->
				<div class="btn_group">
                
				</div>
                <div id="teacher_prof_Wp">
                    <div class="mod">
                        <div class="hd">
                            <div class="content"><h2><?php echo $lprofile;?></h2></div>
                        </div>
                        <div class="bd">
                          	<div class="bd" id="player_b" style="height:418px">
								<div class="video_Wp posR projekktor"  id="player_a">
									<!--<a href="#">
										<img src="<?php echo Base_url('images/base/video_pic.jpg');?>" width="719" height="397" />
										<span class="video_ic"></span>
									</a>
									-->
									<a class="upload_hdpic" id="profile_vedio_upload" href="javascript:void(0)">   </a>
								</div>
							</div>
                        </div>
                    </div><!--/mod-->
                    
                    
                    <div class="mod">
					
					
                        
                            <div class="content"><h2><?php echo $lbiography;?></h2></div>
                        
						
						
						
						
						
                        <div class="bd">
                        	<dl class="biog_info">
                            	<!--<dt><span class="u_edit_ic"></span>1.  Skiing</dt>-->
           						<dd><p><?php echo $profile['skill'];?> </p></dd>

								<!--<dt><span class="u_edit_ic"></span>2.  Backpacking</dt>-->
           						<dd><p><?php echo $profile['backpack'];?></p></dd>

								<!--<dt><span class="u_edit_ic"></span>3.  Reading</dt>-->
           						<dd><p><?php echo $profile['read'];?> </p></dd> 
								
                            </dl>
                        </div>
                    </div><!--/mod-->
                    
                    
                    <div class="mod">
                        <div class="hd">
                            <div class="content tle rating">
                            	<h2><?php echo $lratings;?>
                            		<div class=" fr"><span style="margin-right: 40px"><?php echo $lsessions;?>: <?php echo $sessionCount;?></span><span><?php echo $loverallrating;?>:</span><div class="ratings_score_b fr" id="" style="margin-top: 13px;"><s class="ratings_score_yellow star<?php echo $profile['avgRate'];?>"></s></div></div>
                            	</h2>
                            </div>
                        </div>
                        	
                        <div class="bd">
                          	<ul class="ratings_list">
								<?php foreach ($ratings as $k=>$rate):?>
								<li>
                                	<div class="header_pic_L fl">
                                    	<div class="header_pic">
                                        	<img src="<?php echo profile_image($rate['pic']);?>" width="78" height="80" />
                                        </div>
                                        <div class="hd_pic_name"><?php echo $rate['firstName'],' ',$rate['lastName'];?></div>
                                    </div>
                                    <div class="rating_ct">
										<?php
											$rateScore = intval( ($rate['onTime']+$rate['clearReception'])/2 );
										?>
                                    	<div class="ratings_score" id=""><s class="ratings_score_yellow star<?php echo $rateScore;?>"></s></div>
                                		<div class="ratings_txt"><?php echo $rate['msg'];?></div>
                                        <div class="rating_date">
                                        	<em><?php echo date( 'h:i a, M d, Y' , outTime($rate['create_at']));?></em>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach;?>
                          	</ul>
                        </div>
                    </div><!--/mod-->
                </div>
            </div>
        </div>
        <!--/content_main-->
		<?php include dirname(__FILE__).'/../leftSide.php';?>
    </div>
	<textarea id="biog_info_template" style="display:none">
		<!--
		<dt><span class="u_edit_ic"></span><span class="blog_title changeme input" index="{$T.keyIndex-1}" style="width:150px;" id="{$T.title}">{$T.title}</span></dt>
		<dd><p id="skill" class="blog_desc changeme textarea" index="{$T.keyIndex-1}">
		{$T.desc.replace(/\r\n|\r|\n/g, "<br />");}	
		</p><span class="u_edit_ic">
		</span></dd>

	-->
	</textarea>

	<script>
	function processBiogInfo(data){
		$('.biog_info').html('');
		$.each(data,function(k,v){
			//console.info(v);
			var _tempDiv = $('<div></div>');
			v.keyIndex = parseInt(k)+1;
			_tempDiv.setTemplateElement('biog_info_template').processTemplate(v);
			$('.biog_info').append(_tempDiv.html());
		})
		$('.u_edit_ic').hide();
	}
	proje = '';
	function createVideo(poster,videoPath){
		if(videoPath.search(".3gp")>0)
		{
			videoPath = videoPath + '.mp4';
		}
		if(videoPath.search(".avi")>0)
		{
			videoPath = videoPath + '.mp4';
		}
		if(videoPath.search(".wmv")>0)
		{
			videoPath = videoPath + '.mp4';
		}
		$('#player_a').parent('#player_b').empty().append($('<div id="player_a" class="video_Wp posR projekktor"></div>')); 
		proje = '';
		proje = projekktor('#player_a', {
			title: "<?php //echo $profile['username'];?>'Guest Member’s video",
			debug: false,
			poster: poster,
			width: 719,
			height: 397,
			playerFlashMP4:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
			playerFlashMP3:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
			controls: true,
			playlist: [
				{
					0: {src:videoPath+'', type:'video/mp4'}
				}
			] 
		});
	}
	$(function(){
		$('.u_edit_ic').hide();
		<?php //var_dump($profile['skill']==''?htmlspecialchars  ($profile['skill'], ENT_NOQUOTES  ):'\'\'');var_dump( htmlspecialchars  ($profile['skill'], ENT_NOQUOTES  ));?>
		try{
			var _blogInfo = <?php echo $profile['skill']!=''?htmlspecialchars  ($profile['skill'], ENT_NOQUOTES  ):'""';?>;
			if(typeof(_blogInfo) == 'undefined' || _blogInfo =='' || _blogInfo==null){
				_blogInfo = [];
			}
			//_blogInfo = JSON.parse(_blogInfo);
		}
		catch(e){
			_blogInfo = [];
		}
		processBiogInfo(_blogInfo);
		createVideo('<?php echo profile_video($profile["vedio"]);?>','<?php echo profile_video($profile["vedio"],"");?>');
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
#sendMessageView .baseBoxBg{ background:none;}
#sendMessageView .baseBox{ display:inline-block;}
#sendMessageView.sendMessageView{ margin:0 auto; top:15%; width:771px; left:20%;}
.wrap{ margin-top:210px;}
#sendMessageView.sendMessageView{ top:29% !important;}
.textarea{ border-radius:5px; padding:2px 5px; line-height:18px; height:auto; width:auto; border:0; margin:0; font-size:14px; color:#666666;background:000;}
#Educational
{
background:url(<?php echo base_url();?>images/main/step_2.png) 0 4px no-repeat;
padding:13px 0 9px 87px;
font-size:1.5em;;
font-weight:300;
color:#DFC964;
}
#Personal
{
background:url(<?php echo base_url();?>images/main/step_1.png) 0 4px no-repeat;
padding:13px 0 9px 87px; 
font-size:1.5em;;
font-weight:300;
color:#84C022;
}
#Professional
{
background:url(<?php echo base_url();?>images/main/step_3.png) 0 4px no-repeat;; 
padding:13px 0 9px 87px; 
font-size:1.5em;;
font-weight:300;
color:#3399CC;
}

#sendMessageView .content_main{ border-radius:0 !important; border:4px solid #0087D0;}

</style>