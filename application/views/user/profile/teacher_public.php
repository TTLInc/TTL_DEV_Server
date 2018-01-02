<?php
$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
	$device = 'mobile';
}

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
$arrVal = $this->lookup_model->getValue('649', $multi_lang);	$laddtopotential  	= $arrVal[$multi_lang];
$lreading = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('464', $multi_lang);	$lBEGINNER   		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('465', $multi_lang);	$lINTERMEDIATE   		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('466', $multi_lang);	$lADVANCED   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('974', $multi_lang);    $morning            = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('975', $multi_lang);    $afternoon          = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('976', $multi_lang);    $night              = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('978', $multi_lang);    $sun                = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('979', $multi_lang);    $mon                = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('980', $multi_lang);    $tue                = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('981', $multi_lang);    $wed                = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('982', $multi_lang);    $thu                = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('983', $multi_lang);    $fri                = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('984', $multi_lang);    $sat                = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('986', $multi_lang);    $closed             = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('799', $multi_lang);    $close              = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('458', $multi_lang);    $open               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('468', $multi_lang);    $opened             = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('469', $multi_lang);    $booked             = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('987', $multi_lang);    $book               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('804', $multi_lang);    $request               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('985', $multi_lang);    $requested               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('988', $multi_lang);    $confirm               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('989', $multi_lang);    $selecttopic               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('990', $multi_lang);    $bookslot               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('991', $multi_lang);    $confirmsession               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('992', $multi_lang);    $tutoravailable     = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1002', $multi_lang);    $selecttopictext   = $arrVal[$multi_lang];
//echo $close." : ".$closed;
$arrVal 	= $this->lookup_model->getValue('993', $multi_lang);    $bookopentimeslotsadvance   = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1003', $multi_lang);    $requestslot               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('998', $multi_lang);    $freesession               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('997', $multi_lang);    $successrequest               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('996', $multi_lang);    $successbooking               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1001', $multi_lang);    $nopermission               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1000', $multi_lang);    $firstlogin               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('999', $multi_lang);    $enoughmoney               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1039', $multi_lang);    $YouMust               = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1057', $multi_lang);	$PleaseComplete 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1061', $multi_lang);	$thanksforreg 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('421', $multi_lang);	$lLOCAL_TIMEZONE   		= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('755', $multi_lang);	$Credits   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1100', $multi_lang);	$Videos   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1101', $multi_lang);	$SeeTutorV   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1102', $multi_lang);	$Waybook   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1103', $multi_lang);	$SelectSlevel   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1104', $multi_lang);	$OpenSlot   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1105', $multi_lang);	$SelectTopic   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1106', $multi_lang);	$MoreAvail   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1107', $multi_lang);	$Talkif  		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1108', $multi_lang);	$BookOpen  		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1109', $multi_lang);	$requestAsk  		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('741', $multi_lang);	$TalkNowa  		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('987', $multi_lang);	$Books  		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('804', $multi_lang);	$Requests  		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1116', $multi_lang);	$speakLeval  		= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1005', $multi_lang);	$tutorwillsend 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1006', $multi_lang);	$tutotwillsendnoamount 	= $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1127', $multi_lang);
$YouAreTryingTo = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('987', $multi_lang);	$BookTour 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1138', $multi_lang);	$SelectTutor 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1139', $multi_lang);	$BookOropen 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1141', $multi_lang);	$Ors 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1142', $multi_lang);	$StepThree 	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1143', $multi_lang);	$LiveVideo 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1145', $multi_lang);	$PracitsOr 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1147', $multi_lang);	$ChromeBrowser 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1149', $multi_lang);	$Stepfour 	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1166', $multi_lang);	$YouMustHave 	= $arrVal[$multi_lang];


$arrVal = $this->lookup_model->getValue('1135', $multi_lang);
$ViewProf = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1136', $multi_lang);
$ViewVideo= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1137', $multi_lang);
$secondStep= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('321', $multi_lang);
$creditstext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1393', $multi_lang);
$confirmyourbooking = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1394', $multi_lang);
$tutorwillbesent = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1395', $multi_lang);
$whentutorarrives = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1224', $multi_lang);    $GsessionRating               = $arrVal[$multi_lang];

$languageArray = array(
        "morning"=>$morning,"afternoon"=>$afternoon,'night'=>$night,
        'sun'=>$sun,'mon'=>$mon,'tue'=>$tue,'wed'=>$wed,'thu'=>$thu,'fri'=>$fri,'sat'=>$sat,
        'close'=>$close,'closed'=>$closed,'open'=>$open,'opened'=>$opened,
        'book'=>$book,'booked'=>$booked,'request'=>$request,'requested'=>$requested,'confirm'=>$confirm,
        'selecttopic'=>$selecttopic,'bookslot'=>$bookslot,'confirmsession'=>$confirmsession,'selecttopictext'=>$selecttopictext,'requestslot'=>$requestslot,
        'bookopentimeslotsadvance'=>$bookopentimeslotsadvance,'requestslot'=>$requestslot,'freesession'=>$freesession,'successrequest'=>$successrequest,
        'successbooking'=>$successbooking,'nopermission'=>$nopermission,'firstlogin'=>$firstlogin,'enoughmoney'=>$enoughmoney,'speakLeval'=>$speakLeval,
		'youMustHave'=>$YouMustHave
        );

if($roleIdn == 0)
{
	$apointmentbutton = $lcreateappointment;
	$potentialbutton  = $laddtopotential;
}else{
	$apointmentbutton = $lcreateappointment;
	$potentialbutton  = $laddtopotential;
}

$arrVal 	= $this->lookup_model->getValue('1084', $multi_lang);	$insuuffi	= $arrVal[$multi_lang];
?>
<?php $this->layout->appendFile('css',"css/search.css");?>
<?php //$this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js");?>
<?php $this->layout->appendFile('javascript',"js/mycalendar/mycalendar.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/projekktor-1.1.00r107.min.js");?>
<?php //$this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/mycalendar/mycalendar.css");?>
<?php $this->layout->appendFile('css',"css/palyerTheme/style.css");?>
<?php $this->layout->appendFile('javascript',"js/jquery.blockUI.js"); ?>
<link rel="stylesheet" href="<?php echo base_url();?>css/popup-css.css">
<script type="text/javascript">


$.blockUI({ message: '<img src="<?php echo base_url();?>images/loading51.gif" />' });
$(window).ready(function(){
	
	
		<?php 
		
		if($device == 'mobile' && $_GET['g'] == 'tutorpro'){
		?>
		alert('<?php echo "You’ve selected a great tutor! Test your webcam and mic by clicking HERE. Then Scroll down to complete booking.";?>');
			//$('html,body').animate({scrollTop: $(".mod").offset().top},'slow');
		<?php }else{
			
		
		if($_GET['g'] == 'tutorpro'){
		?>
		$('#dialog2').dialog({
			modal:true,
			width:'430px',
			resizable:false,
			buttons: {
				"Ok": function() {
					//window.location.href = '<?php echo Base_url("user/dashboard");?>';
					//$('html,body').animate({scrollTop: $(".mod").offset().top},'slow');
				},
				"Cancel": function() { $(this).dialog("close");}
			}
		});
		
	<?php
		}
	}
	?>
	$.unblockUI();
});
</script>
<script>
 function closeFunc()
{
	$('#dialog1').dialog('destroy');
}
	function CloseAlert()
{
	$('#BookingAlert').dialog('close');
	$('#RequestAlert').dialog('close');
	
}
function CloseAlertPop(){
	$('#dialog1').dialog('close');
}

function checkBookTip()
{
	 
	window.scrollTo(600,330);
	$('#BookingAlert').dialog({
					modal:true,
					width:'280px',
					
			});
			$('.ui-widget-overlay').hide();	
}
function checkRequestTip()
{
window.scrollTo(600,330);
	
				 $('#RequestAlert').dialog({
					modal:true,
					width:'250px'
			});
}
</script>

<script>
	$(document).ready(function(){
	$(".SchoolDisc").hover(function () {
	 
	var a = $("#sdisc").val();
	
	$(this).append('<div class="TipCal"><p>' + a +'</p></div>');
	}, function () {
		$("div.TipCal").remove();
	});
	
	$("span.ToolCal").hover(function () {
	<?php // $markup= "Tutor rate is"; ?>
		$(this).append('<div class="TipCal"><p><?php echo $Talkif."<br>".$BookOpen." <br>". $requestAsk;?></p></div>');
	}, function () {
		$("div.TipCal").remove();
	});
	
	});
	</script>
<script>
function div_hide()
{
    document.getElementById("vdiv").style.display = 'block';
    document.getElementById("ishow").style.display = 'block';
    document.getElementById("ihide").style.display = 'none';
}
function div_show()
{
    document.getElementById("vdiv").style.display = 'none';
    document.getElementById("ishow").style.display = 'none';
    document.getElementById("ihide").style.display = 'block';
}
function divcalendar_hide()
{
    //alert(a);
    document.getElementById("technocalendarmtd").style.display = 'none';
    document.getElementById("calendarimgshow").style.display = 'block';
    document.getElementById("calendarimghid").style.display = 'none';
}
function divcalendar_show()
{
    //alert(a);
    document.getElementById("technocalendarmtd").style.display = 'block';
    document.getElementById("calendarimgshow").style.display = 'none';
    document.getElementById("calendarimghid").style.display = 'block';
}
</script>
<script language="Javascript" type="text/javascript">
    $(document).ready(function() {
        var base_url = '<?php echo base_url();?>';
        var languageArray = '<?php echo json_encode($languageArray); ?>';		
        var uid = '<?php echo $this->session->userdata['uid']; ?>';
        var coded = Project.modules.customcalendar.mycalendersetting('technocalendar','',base_url,'student','<?php echo $profile['uid'];?>',languageArray,1,uid);
        });
</script>
<div id="customcalendar"></div>
<script>
window.onload = function() {
 var alrt="<?php echo $this->uri->segment(7);?>";
  if(alrt == 'reg')
  {
		$('#dialog').attr('buttonType','doing');
		$('#dialog').dialog({modal:true});
		$('#dialog').attr('buttonType','done');
		$('#dialog').html('<?php echo $thanksforreg;?>');
		resizable:false;
  }
  var a="<?php echo $_GET["step"];?>";
  if(a==3)
  {
	CheckStep();
  }
  var x='<?php echo $this->session->userdata('firstTimeRegister'); ?>'; 
  var rollId='<?php echo $this->session->userdata('roleId'); ?>'; 
 /*if(a==2 && a!=''&& rollId==0 && x !='')
  {
		
	  window.scrollTo(200,0);	
	$('#firstTour').dialog({
					modal:true,
					width:'440px',
					resizable:false
			});
		$('.ui-dialog').wrap('<div class="main_student-popupdiv2"></div>' );
		$('.biog_info').addClass('highlight2');	
	}*/
};
</script>
<script>
function CheckStep()
{
$("#firstTour").dialog('close');	

window.scrollTo(300,30);			
  $('#SecondTour').dialog({
					modal:true,
					width:'240px',
					resizable:false
			});
			$('.ui-dialog').wrap('<div class="main_student-popupdiv3"></div>' );
			$('.biog_info').removeClass('highlight2');	
			$('.cl-bking').addClass('highlight3');	
			
}	
 
function NextstepTetsVeeSession()
{
	window.location.href="<?php echo base_url('testveesession/testVeeSession?step=4');?>";
}
</script>
<div id="tempscroll"></div>
 <div class="baseBox baseBoxBg clearfix">
     
	 
     
     <!--<div class="tutrpg-icon">
     	<a class="icon-msg icon-popup"  onclick="sendBeepBoxMessage(<?php echo $criterias['uid'] ;?>)">&nbsp;<span class="classic">Send Message</span></a>
        <a class="icon-sedl icon-popup"  href="<?php echo base_url('/user/calendar/uid/'.@$criterias['uid']); ?>">&nbsp;<span class="classic">Schedule</span></a>
        <a class="icon-tk-nw icon-popup" onclick="bookNow(<?php echo $criterias['uid'] ;?>,'<?php echo $criterias['firstName'];?>')">&nbsp;<span class="classic">Talk Now</span></a>
        <a class="icon-fav icon-popup" href="#">&nbsp;<span class="classic">Favorites</span></a>
     </div>-->
        <div class="content_main fr">
			<?php
			if($device == 'mobile'){
				include dirname(__FILE__).'/../leftSide.php';
			}
			?>
        	<div class="main_inner">
                <ul class="student_prof teacher_prof">
                    <?php echo  profile_menu('t_public','p_prof',$profile['uid']);?>
                </ul>
				<?php //echo mailAptBtn($chkfreesession,$profile['uid']); ?>
                <!--/student_prof-->
				<div class="btn_group">
				</div>
                <div id="teacher_prof_Wp" class="tutor-cal">
                    <div class="mod">
                       <!--<div class="hd">
                          <div class="content"><h2><?php echo $lprofile;?></h2></div>
                        	</div>-->
						<div class="content"><h2 class="vid-sh-hd"><?php echo $lbiography;?>
						<span style="margin-left:160px;font-size: 16px;" class='creditcls'>
						<?php //------RD @ JULY 02 2016----// ?>
						<?php  //echo (number_format($SessionCost['tutorcost'],2,'.','')). "  ". $Credits;?>  
						<?php if(isset($SessionCost['schooltutorcost']) && $SessionCost['schooltutorcost'] != ''  && $SessionCost['schooltutorcost'] > 0):?>
						<?php echo (number_format($SessionCost['schooltutorcost'],2,'.','')). "  ". $Credits;?>
						<?php else: ?>
						<?php echo (number_format($SessionCost['tutorcost'],2,'.','')). "  ". $Credits;?>  
						<?php endif; ?>
						<?php //------RD @ JULY 02 2016----// ?>
						
						
						
						
						</span>
							<a style="font-size: 16px;" class="icon-popup st-vd-icon">
							<span class="txt"><?php echo $Videos;?>  &nbsp;</span><img id="ihide" onclick="div_hide();" style="float:right;cursor:pointer;" src="<?php echo base_url('images/blue.jpg');?>" width="30px">
							<img id="ishow" onclick="div_show();" style="float:right; display:none;"src="<?php echo base_url('images/blue.jpg');?>" width="30px">					<span class="classic"> <?php echo $SeeTutorV;?></span>
							</a>
							</h2>
						</div>
					
                       <div class="bd" id="vdiv" style="display:none;">
						<?php
						if($profile['vid_upload'] == '0'){
						?>
						<img src="<?php echo Base_url('images/notuploadvideo.png');?>">
						<?php
						}else{
							?>
						
                          	<div class="bd" id="player_b" style="height:418px">
								<div class="video_Wp posR projekktor"  id="player_a">
									<a href="#">
										<img src="<?php echo Base_url('images/base/video_pic.jpg');?>" width="719" height="397" />
										<span class="video_ic"></span>
									</a>
									
									<!--<a class="upload_hdpic" id="profile_vedio_upload" href="javascript:void(0)">   </a>-->
								</div>
							</div>
						<?php
						}
						?>
                        </div>
                    </div><!--/mod-->
                    
                    
                    <div class="mod">
					
					
                        
                            
						
                        <div class="bd">
						<?php if($schtut > 0 ) {?>
						<p><span style="font-size:14px;">This tutor is endorsed to teach structured curriculum for this Language School Community.</span></p>
						<?php }?>
						<p>
						
						<?php if($schtut > 0 ) {?>
						   <?php if($logo == '')
						   { ?>
								<img width="50px;"  style="margin-left:300px;"  src="<?php echo base_url('images/header.jpg');?>">
						   <?php }
						   else{?>
						   
									
										<span <?php if($disc !=''){?> class="SchoolDisc" <?php } ?>><img width="100px;" height="100px;" style="margin-left:300px;" src="<?php echo base_url('/uploads/images/thumb/'.$logo);?>"></span>
										<input type="hidden" id="sdisc"  value="<?php echo $disc;?>">
									
						  <?php }?>
							
						<?php }?>
						</p>
                        	<dl class="biog_info">
                            	<!--<dt><span class="u_edit_ic"></span>1.  Skiing</dt>-->
           						<dd><p><?php //echo $profile['skill'];?> </p></dd>

								<!--<dt><span class="u_edit_ic"></span>2.  Backpacking</dt>-->
           						<dd><p><?php //echo $profile['backpack'];?></p></dd>

								<!--<dt><span class="u_edit_ic"></span>3.  Reading</dt>-->
           						<dd><p><?php //echo $profile['read'];?> </p></dd> 
								
                            </dl>
                        </div>
                    </div><!--/mod-->
                    
                    <div class="mod">
                        <div class="hd">
                            <div class="content tle rating">
                                <h2>
                                    <?php echo $lcalender;?>(<?php echo $lLOCAL_TIMEZONE;?>)
                                    <span style="float:right;cursor:pointer;"><img id="calendarimghid" src="<?php echo site_url('images/decrease.jpg')?>" onclick="divcalendar_hide();"/></span> 
                                    <span style="float:right;cursor:pointer;"><img id="calendarimgshow" style=" display:none;" src="<?php echo site_url('images/expand.jpg')?>" onclick="divcalendar_show();"/></span> 
									<span class="ToolCal"><img style="float:right;" src="<?php echo Base_url('images/arrow.png') ?>" /></span>	
								</h2>
                                
                                <span class="three-why mrbt"><?php echo $Waybook;?></span>
                                <div class="cl-new-why stu-cl-why" >
							  <div class="cl-bking">
                              	<span class="bking-tooltip">
									<?php if($readyTalk == 1) {
									$current_uri4 = $this->uri->segment(4);
									?>
                                	<a class="bkclass" style="cursor:pointer;" onClick="bookNow(<?php echo $current_uri4 ;?>);"><img src="<?php echo site_url('images/tlk-nw-icon-hv.png')?>"/></a>
                                    <div class="bking-tooltip-cnt">
									<?php
									$arrVal = $this->lookup_model->getValue('1366', $multi_lang);
									echo $lngTalkNow = $arrVal[$multi_lang]; // Click to join a session in 5 min.
									?>
									</div>
									<?php } else {?>
									<img src="<?php echo site_url('images/gary-video-icon.png')?>" /><?php }?><p><?php echo $TalkNowa;?></p>
                                </span>	
                              </div>
                              <div class="cl-tmlot" id="bookTip" style='cursor:pointer' onclick='checkBookTip()'>
                              	<span class="tmlot-tooltip"><a><?php echo $Books; ?></a> <div class="tmlot-tooltip-cnt">
								<?php
									$arrVal = $this->lookup_model->getValue('1367', $multi_lang);
									echo $lngBook = $arrVal[$multi_lang]; 
									?>
								</div></span>
                              	<p><?php echo $OpenSlot;?></p>
                              </div>
                              <div class="cl-resession" style='cursor:pointer' onclick='checkRequestTip()'> 
                              	<span class="request-tooltip"><a><?php echo $Requests;?></a>
								<div class="request-tooltip-cnt">
									<?php
									$arrVal = $this->lookup_model->getValue('1368', $multi_lang);
									echo $lngReq = $arrVal[$multi_lang]; 
									?>
								</div>
								</span>
                              	<p><?php echo $MoreAvail;?></p>
                              </div>
								<!--<div class="clk-btn">
									<span>1</span> <a href="#"><?php echo $clickday; ?></a>
								</div>
								<div class="clk-btn">
									<span>2</span> <a href="#"><?php echo $bookorrequest; ?></a>
								</div>
								<div class="clk-btn">
									<span>3</span> <a href="#"><?php echo $clickreccur; ?></a>
								</div>-->
							</div>
                            
                            
                                <!--<div class="click-ttr-sec">
                                        <div class="clk-btn">
                                                <span>1</span> <a href="#"><?php echo $tutoravailable; ?></a>
                                        </div>
                                        <div class="clk-btn">
                                                <span>2</span> <a href="#"><?php echo $bookopentimeslotsadvance; ?></a>
                                        </div>
                                </div>-->
                                <div id="technocalendarmtd" class="mrg-top">
                                    <div class="selectboxtest">
                                        <form>
                                            <select name="sspeakinglevel" id="sspeakinglevel">
                                                <option value="naval"><?php echo $SelectSlevel;?></option>
												<option value="Beginner" <?php echo (isset($selTopic[0]['speaklevel']) and $selTopic[0]['speaklevel']=="Beginner") ? "selected" :"";?>><?php echo $lBEGINNER;?></option>
                                                <option value="Intermediate" <?php echo (isset($selTopic[0]['speaklevel']) and $selTopic[0]['speaklevel']=="Intermediate")? "selected" :"";?>><?php echo $lINTERMEDIATE;?></option>
                                                <option value="Advanced" <?php echo (isset($selTopic[0]['speaklevel']) and $selTopic[0]['speaklevel']=="Advanced") ? "selected" :"";?>><?php echo $lADVANCED;?></option>
                                            </select>
                                            <select name="conversationtopic" id="conversationtopic">
												<?php
												if ($categories) {
													foreach ($categories as $cat) {?>
														<option value='<?php echo $cat["id"];?>' <?php echo (isset($selTopic[0]['topic']) and $selTopic[0]['topic']==$cat['id']) ? "selected" :"";?>>
															<?php echo $cat["category"];?></option>
													<?php }
												}?>
                                            </select>
                                            <span class="cln-sel"><input name="txtconversationtopic" id="txtconversationtopic" value="Enter topic" type="text" class="textbox" style="display:none;"/></span>
											<input type="hidden" value='0' id="sessiontype" name="sessiontype">
											<input type="hidden" id="Isschool" name="Isschool" value="<?php echo $schtut;?>"> 
											<input type="hidden" id="isFreesession" name="isFreesession" value="<?php echo $chkfreesession;?>"> 
											<input id="UserType" name="UserType" value="<?php echo $this->session->userdata['roleId'];?>" style="display:none;"> 
                                            <!-- Added by Ilyas -->
                                            <input type="hidden" id="universal_roleId" name="universal_roleId" value="<?php echo $this->session->userdata['universal_roleId'];?>" style="display:none;"> 
                                            <!-- End -->
                                            <span class="cln-sel"><input value="Submit" type="submit" class="submit"  style="display:none;"/></span>
                                        </form>
                                    </div>
                                    <?php
                                        $uri=$this->uri->segment(5);
                                        //print_r($uri=$this->uri->segment(5));
                                        //echo isset($uri);
                                        //echo $SessionCost;
                                        //echo "asdasd";
                                        //print_r($SessionCost);
										//echo "d".$SessionCost['affiliate'];
                                        foreach ($SessionCost as $key => $values)
                                        {
                                    ?>   
                                            <input type="hidden" name="hdn<?php echo $key; ?>" id="hdn<?php echo $key; ?>" value="<?php echo $values; ?>">
                                    <?php
                                        }
                                    ?>    
                                    <input type="hidden" name="hdncost" id="hdncost" value="<?php echo $SessionCost;?>">
                                    <input type="hidden" name="hdnSessionType" id="hdnSessionType" value="<?php echo $SessionType;?>">
									<input type="hidden" name="isaffi" id="isaffi" value="<?php echo $SessionCost['affiliate'];?>">
									<input type="hidden" name="pbalance" id="pbalance" value="<?php echo $SessionCost['pbalance'];?>">
                                    <div id="technocalendar"  class="fc fc-ltr"></div>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <div class="mod">
                        <div class="hd">
                            <div class="content tle rating">
                            	<h2><?php echo $lratings;?>
                            		<div class=" fr">
										<span style="margin-right: 40px"><?php echo $lsessions;?>: <?php echo $sessionCount;?></span>
										<span><?php echo $loverallrating;?>: </span>
										<div class="ratings_score_b fr" id="" style="margin-top: 13px;">
											<s class="ratings_score_yellow star<?php echo $profile['avgRate'];?>"></s>
										</div>
									</div>
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
											$rateScore = intval(($rate['onTime']+$rate['clearReception'])/2 );
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
					
					
					<!-- Added by haren for group session -->
					<!--
					   <div class="mod">
                        <div class="hd">
						
                            <div class="content rating">
                            	<h2><?php echo $GsessionRating;?>

                            		 <div class="fr"><span style="margin-right: 40px"><?php echo $lsessions;?>: <?php echo $GroupsessionCount;?></span><span><?php echo $loverallrating;?></span><div class="ratings_score_b fr" id="" style="margin-top: 5px; margin-right: 10px;"><s class="ratings_score_yellow star<?php echo $GetGroupRating;?>"></s>
									 
									 </div>
									 
									 </div>
									 
                            	</h2>
						
                            </div>
							
                        </div>
                          <div class="bd" id="groupRateId">
                          	<ul class="ratings_list">
                                <?php foreach ($GroupRating as $k=>$rate):?>
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
                                        	<em> <?php echo date( 'h:i a, M d, Y' , outTime($rate['create_at']));?></em>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach;?>
                                
                          	</ul>
                        </div>
                    </div>
					-->
				<!-- haren code end -->
					 
                </div>
            </div>
        </div>
		
		
		<?php include dirname(__FILE__).'/../session_type.php';?>
		
        <!--/content_main-->
		<?php 
		if($device != 'mobile'){
			include dirname(__FILE__).'/../leftSide.php';
		}
		?>
		
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
    
     <div id="firstTour" title="" style="display:None;">
			<div class="popup-step student-step2">
            	<div class="step-div-bg">
                	<span class="popup-no">2</span>
                    <div class="ratelist popup-row">
                        <span class="title" style="float:left"><?php echo $ViewProf;?></span>  
                    </div>
                    <div class="ratelist popup-row">
                        <p><span class="title" style="float:left;line-height:15px;"><?php echo $ViewVideo;?></span>  </p>
                    </div>
                    
                	<div class="pop-pagin">
                    	<ul>
                        	<li><span><a href="<?php echo base_url('search/search?step=1');?>">1</a></span></li>
                            <!--<li class="active"><span><a href="<?php echo base_url('user/profile/uid/12512?step=2');?>">2</a></span></li>-->
                            <li><span><a href="<?php echo base_url('user/profile/uid/12512?step=3');?>">3</a></span></li>
                            <li><span><a href="<?php echo base_url('testveesession/testVeeSession?step=4');?>">4</a></span></li>
                            <li><span><a href="<?php echo base_url('user/account?step=5');?>">5</a></span></li>
                            <!--<li><span><a href="<?php echo base_url('user/changeInfo?step=6');?>">6</a></span></li>-->
                        </ul>
                    </div>
            		<a  onclick="CheckStep();"><?php //echo $StepThree;?>Next</a>
                </div>
            </div>
           <!-- <div class="student-hight-cnt2">&nbsp;</div>-->
		</div>
        
       
		
		<div id="SecondTour" title="" style="display:None;">
			<div class="popup-step student-step3">
            	<div class="step-div-bg">
                    <span class="popup-no">2</span>
                    <div class="ratelist popup-row">
                        <span class="title" style="float:left"><?php echo $BookTour;?></span>  
                    </div>
                    <div class="ratelist popup-row">
                        <p><span class="title" style="float:left;line-height:15px;"><?php echo $SelectTutor;?>.</span>  </p>
                        <p><?php echo $Ors;?></p>
                        <p><?php echo $BookOropen;?>.</p>
                    </div>
                    <div class="ratelist popup-row"><img src="<?php echo Base_url('images/step3-arrow.png') ?>" /></div>
                	<div class="pop-pagin">
                    	<ul>
                        	<li><span><a href="<?php echo base_url('search/search?step=1');?>">1</a></span></li>
                            <!--<li><span><a href="<?php echo base_url('user/profile/uid/12512?step=2');?>">2</a></span></li>-->
                            <li class="active"><span><a href="<?php echo base_url('user/profile/uid/12512?step=3');?>">2</a></span></li>
                            <li><span><a href="<?php echo base_url('testveesession/testVeeSession?step=4');?>">4</a></span></li>
                            <li><span><a href="<?php echo base_url('user/account?step=5');?>">5</a></span></li>
                            <!--<li><span><a href="<?php echo base_url('user/changeInfo?step=6');?>">6</a></span></li>-->
                        </ul>
                    </div>
            		<a  onclick="NextstepTetsVeeSession();"><?php //echo $StepThree;?>Next</a>
                </div>
            </div>
		</div>
	<script>
//});
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
			      
	    
		<?php
	$psn = addcslashes($profile['personal'],"\\\'\"\n\r");
	$edu = addcslashes($profile['academic'],"\\\'\"\n\r");
	$prof = addcslashes($profile['professional'],"\\\'\"\n\r");
      ?>
	  
        //_blogInfo = [{"title":"Personal","desc":""},{"title":"Educational","desc":""},{"title":"Professional","desc":""}];		 
		_blogInfo = [{"title":"Personal","desc":"<?php echo ($psn);?>"},{"title":"Educational","desc":"<?php echo $edu;?>"},{"title":"Professional","desc":"<?php echo $prof;?>"}];

			if(typeof(_blogInfo) == 'undefined' || _blogInfo =='' || _blogInfo==null){
				_blogInfo = [];
			}
			//_blogInfo = JSON.parse(_blogInfo);
		}
		catch(e){
			_blogInfo = [];
		}
		processBiogInfo(_blogInfo);
		createVideo('<?php echo Base_url('uploads/video/'.$profile["vedio"].'.jpg');?>','<?php echo Base_url('uploads/video/'.$profile["vedio"]);?>');
	})
	</script>
    <script>
	var attempts = 0;
function addToPotential(id){ 
 
  
	<?php if($roleIdn != 0) {?>
		alert('Bookings are reserved for student accounts');
		return false;
	<?php } else { ?>
	//$('#dialog').html('updating');
	//$('#dialog').attr('buttonType','doing');
	//$('#dialog').dialog({modal:true});
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
			   $( ".floating_form" ).show();
			   			
			// $( ".signup_form" ).show();
			  //$('#signup_form_floating').slideDown();
		}
		else {
			<?php
			$arrVal = $this->lookup_model->getValue('1245', $multi_lang);
			$updated = $arrVal[$multi_lang];
			?>
			$('#dialog').html('<?php echo $updated;?>');
			$( "#dialog").dialog({modal: true, buttons: { "Ok": function() { $(this).dialog("close"); } }}); 
			//$('#dialog').attr('buttonType','done');
		}
	})
	<?php
	}
	?>
}
	</script>
	
	<script>
var dg =0;		 
function bookNow(tid,username,schoolId,hrate)
{
	if($(".bkclass").hasClass("loadingBk")){
		return;
	}
	bookNow1(tid,username,schoolId);
}
function bookNow1(tid,username)
{$.blockUI({ message: '<img src="<?php echo base_url();?>images/loading51.gif" />' });
var mu_uid = $("#uid").val();
 
if(mu_uid=='')
 {
	$('#dialog').attr('buttonType','doing');
	$('#dialog').dialog({modal:true});
	$('#dialog').attr('buttonType','done');
	$('#dialog').html('<?php echo $YouMust;?>');
	$( ".floating_form" ).show();
 }
 else
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
	var refid ="<?php echo $Refid; ?>";
	var sessiontype=$('input[name=amex]:checked').val();
	if (sessiontype == 1)
	{
	_data['schoolid']="<?php echo $schtut; ?>"
	 }
	 else
	 {
		_data['schoolid']=0;
	 }
	/*if(refid != _data['schoolid'])
	{
			alert('You are not associated with this Tutor’s School Community.  You may book a conversation session with this tutor at the listed price or you may pick another school community tutor.');
			return false;
	}*/
	//window.returnvar = true;
	
	$.post('<?php echo Base_url('user/checkClassBookNow');?>',_data,function(msg){
		
		if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
		window.cost = json.cost;
		$('#bookingamount').val(window.cost);
		if(json.success == 'false' || json.success == false){
			alert(json.msg);
		}else if(json.enough == false || json.enough == 'false'){
			window.returnvar = false;
			window.avl = true;
			window.profileComplete = true;
			
		}else if(!json.availabletobook){
			window.returnvar = false;
			window.avl = false;
			window.profileComplete = true;
			
		}else if(json.profileCompletion==false || json.profileCompletion=='false'){
			window.returnvar = false;
			window.avl = true;
			window.profileComplete = false;
			
		}else{
			window.returnvar = true;
		}
		if(json.firstBookNow == false || json.firstBookNow == 'false'){
			window.firstBookNow = false;
		}else{
			window.firstBookNow = true;
			window.profileComplete = false;
		}
		if(json.totalNumSess > 1){
			window.totalNumSess = false;
		}else{
			window.totalNumSess = true;
		}
		
		if(json.enough)
		{
		window.enough=true;
		}
		else
		{
		window.enough=false;
		}
		setBookTimeout();
		
	})
	function setBookTimeout(){
		$(".bkclass").removeClass("loadingBk");
		$.unblockUI();
		lastClickedOnBook = false;
		if(window.returnvar == false)
		{
			lastClickedOnBook = false;
			if(window.avl == false)
			{
				//var alertHTML = 'You have alredy booked.';
				if(window.firstBookNow == false){
					var alertHTML = '<?php echo $YouAreTryingTo;?>';
				}else{
					var alertHTML = '<?php echo $YouAreTryingTo;?>';
				}
				
				
				$( "#dialog").html(alertHTML);
				$( "#dialog").dialog({modal: true,title:" ",  close: function( event, ui ) {self.location = self.location.href;}});
				return false;
			}else if(window.profileComplete == false){
				alert('<?php echo $PleaseComplete;?>');
				window.location.href = "<?php echo base_url(); ?>user/registeredit/";
				return false;
			}
			
			else if(window.enough==true){
				
				var message ="<?php echo $tutotwillsendnoamount;?>";
			      var conf = confirm(message);
				  var classcost = window.cost;
					if(conf == true)
					{
					// send message to tutor
						$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid, cost:classcost,schoolId:_data['schoolid']},function(msg){
							
							//redirect to student dashboard page
								window.location.href = '<?php echo Base_url("user/dashboard");?>';
						});
					}else{
						return false;
					}
			}
			else{
				var rechargeURL = '<?php echo base_url(); ?>user/account/';
				var alertHTML = '<?php echo $insuuffi;?>';
				$( "#dialog").html(alertHTML);
				$( "#dialog").dialog({modal: true,resizable:false,  buttons: [
					{
						text: "Ok",
						"class": 'saveButtonClass',
						click: function() {
							window.location.href = rechargeURL;
						}
					}
				],
				close: function() {
				}});
				return false;
			}
		}else{
			$.unblockUI();
			/*alert(_data['schoolid']);
			return false;*/
			if(window.firstBookNow == false){
				
				var message ="<?php echo $tutorwillsend;?>";
			}else{
				
				var message ="<?php echo $tutotwillsendnoamount;?>";
			}
			//var message = "You are booking a class with "+username+" right now. If they confirm this booking then you will automatically be launched into the Vee-session. If they haven’t entered your classroom within the 3minute countdown timer, then feel free to exit the session and your account will be credited.";
			//var message = "Tutor will be sent invitation and will have 5 minutes to join your tutoring session.  You will be sent to Dashboard page with a countdown timer.  When tutor arrives, you will be automatically launched into your session and your account will be debited.";
			
			var classcost = window.cost;
			$('#dialog1').dialog({
				modal:true,
				width:'430px',
				resizable:false,
				buttons: {
					"Ok": function() {
						$.getJSON('<?php echo Base_url("user/sendBookNowMessage");?>',{tid:tid, cost:classcost,schoolId:_data['schoolid']},function(msg){
					
					//redirect to student dashboard page
					window.location.href = '<?php echo Base_url("user/dashboard");?>';
					});
					return;callback(false);
					$(this).dialog("close");},
					"Cancel": function() { $(this).dialog("close");}
				}
			});
			lastClickedOnBook = false;
		}
		
		return false
	}//,4000);callback(false);
	//lastClickedOnBook = false;
}

 

}
	</script>
	
<style>
.ui-button-text{background-color: #0089D1 !important;color:white}
#sendMessageView .baseBoxBg{ background:none;}
#sendMessageView .baseBox{ display:inline-block;}
#sendMessageView.sendMessageView{ margin:0 auto; top:15%; width:771px; left:20%;}
.wrap{ margin-top:210px;}
#sendMessageView.sendMessageView{ top:29% !important;}
.textarea{ border-radius:5px; padding:2px 5px; line-height:18px; height:auto; width:auto; border:0; margin:0; font-size:14px; color:#666666;background:000;}
#Educational
{

padding:13px 0 9px 15px;
font-size:1.5em;;
font-weight:300;
color:#E8B800;
}
#Personal
{
	
padding:13px 0 9px 15px; 
font-size:1.5em;
font-weight:300;
color:#84C022;
}
#Professional
{

padding:13px 0 9px 15px; 
font-size:1.5em;;
font-weight:300;
color:#3399CC;
}

#sendMessageView .content_main{ border-radius:0 !important; border:4px solid #0087D0;}

span.ToolCal {
  cursor: pointer;
  position: relative;
   
}

div.TipCal {
  background-color: #037898;
  color: White;
  position: absolute;
  left: 145px;
  top: 0px;
  z-index: 1000000;
  width: 250px;
  border-radius: 5px;
  margin-top:-11px;
  font-size:11px;
}
div.TipCal:before {
  border-color: transparent #037898 transparent transparent;
  border-right: 6px solid #037898;
   
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
div.TipCal p {
  margin: 10px;
  color: White;
  font-size:14px;
  font-weight:normal;
  line-height:16px;
  
}
.SchoolDisc
{
  
  position: relative;
}

div.Mytool {
  background-color: #037898;
  color: White;
  position: absolute;
  left: 145px;
  top: 0px;
  z-index: 1000000;
  width: 250px;
  border-radius: 5px;
  margin-top:-11px;
  font-size:11px;
}
div.Mytool:before {
  border-color: transparent #037898 transparent transparent;
  border-right: 6px solid #037898;
   
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
div.Mytool p {
  margin: 10px;
  color: White;
  font-size:14px;
  font-weight:normal;
  line-height:16px;
  
}
.biog_info, #biog_info_template{ display:none;}

.ui-widget-content{/*border: 4px solid #0087d0 !important;    border-radius: 0 !important;*/ background:#fff; padding:15px;}
.ui-widget-header{ background:none; border:0 none !important;}
.ui-widget-header{ float:right;}
 
</style>
<?php
$arrVal = $this->lookup_model->getValue('1417', $multi_lang);	$req_pop_txt_01  	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1418', $multi_lang);	$req_pop_txt_02  	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1419', $multi_lang);	$book_pop_txt_01  	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1420', $multi_lang);	$book_pop_txt_02  	= $arrVal[$multi_lang];
?>
<script type = "text/javascript">  
$(document).ready(function() {
    $(".biog_info").delay(1000).fadeIn(500);
	
	
$( ".fc-sun" ).on('click',function() {
  var innertxtdialog = $(this).html();
  if(innertxtdialog == 'Request'){
	  $('#popmsgline1').html('');
	  $('#popmsgline2').html('');
	  $('#popmsgline1').html('<?php echo $req_pop_txt_01;?>');
	  $('#popmsgline2').html('<?php echo $req_pop_txt_02;?>');
	  
  }else{
	  $('#popmsgline1').html('');
	  $('#popmsgline2').html('');
	  $('#popmsgline1').html('<?php echo $book_pop_txt_01;?>');
	  $('#popmsgline2').html('<?php echo $book_pop_txt_02;?>');
  }
});
	
});
</script>

<?php //------RD @ JULY 02 2016----// ?>
<?php  //echo (number_format($SessionCost['tutorcost'],2,'.','')). "  ". $Credits;?>  
<?php if(isset($SessionCost['schooltutorcost']) && $SessionCost['schooltutorcost'] != ''  && $SessionCost['schooltutorcost'] > 0):?>
<?php $popup_cost =  (number_format($SessionCost['schooltutorcost'],2,'.',''));?>
<?php else: ?>
<?php $popup_cost =  (number_format($SessionCost['tutorcost'],2,'.',''));?>  
<?php endif; ?>
<?php //------RD @ JULY 02 2016----// ?>


<div id="dialog1" title="CostPopup" style="display:None;">
	<div class="ratelist">
		<span class="title" style="float:left"><?php echo $confirmyourbooking;?> <input type='text' align="center" name='bookingamount' id='bookingamount' value='<?php echo $popup_cost;?>' style="color: #3399cc; font-size: 20px; font-weight: normal; margin-bottom: 8px; margin-left: 10px; width:60px; border:0px;" readonly	><?php echo $creditstext;?></span>
	</div>
	<div class="ratelist">
		<br><p><span class="title" style="float:left; color:black;" id="popmsgline1"><?php echo $tutorwillbesent;?></span>  </p>
		<br>
		<p><span class="title" style="float:left; color:black;" id="popmsgline2"><?php echo $whentutorarrives;?></span>  </p>
		<p class="clearer"></p>
		<!--<p><input type="button" class="blu-btn" onclick="CloseAlertPop();" value="OK" style="cursor:pointer;float:right"></p>-->

	</div>
</div>
<div id="dialog2" title="" style="display:None;">
	<div class="ratelist">
		<span class="title" style="float:center"><center><?php echo "You've selected a great tutor! <br>Test your webcam and mic by clicking <a href=".base_url('testveesession/testVeeSession').">HERE</a>. <br>Then Scroll down to complete booking.";?> </center></span>
	</div>
</div>