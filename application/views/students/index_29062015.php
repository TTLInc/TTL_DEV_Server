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

$arrVal 	= $this->lookup_model->getValue('234', $multi_lang);
$lspeak_english = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('239', $multi_lang);
$lfree_session = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('211', $multi_lang);
$lflexible_pricing = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('212', $multi_lang);
$lalways = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('213', $multi_lang);
$lhuge_selection = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('214', $multi_lang);
$lthousand_selection = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('215', $multi_lang);
$lregistration_now = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('216', $multi_lang);
$lrisk_free = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('217', $multi_lang);
$lplay_sample_video = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('218', $multi_lang);
$lplay_how_it_works = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('219', $multi_lang);
$lwe_welcome = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('220', $multi_lang);
$ltutors = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('221', $multi_lang);
$lsign_up = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('222', $multi_lang);
$lsearch = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('223', $multi_lang);
$lschedule = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('224', $multi_lang);
$ltalk = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('225', $multi_lang);
$lchoose_tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('226', $multi_lang);
$llook_tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('227', $multi_lang);
$lcustom_video = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('228', $multi_lang);
$lamerican_tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('229', $multi_lang);
$lyou_get_tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('230', $multi_lang);
$lno_contracts = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('231', $multi_lang);
$lyou_get_flexible = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('232', $multi_lang);
$lyour_topic = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('233', $multi_lang);
$lyou_get_customize = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('240', $multi_lang);
$li_am_student = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('241', $multi_lang);
$li_am_tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('4', $multi_lang);
$lhow_it_works = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('237', $multi_lang);
$lwhy = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('232', $multi_lang);
$lyour_topic = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('242', $multi_lang);
$lor = $arrVal[$multi_lang];
//---R&D@Oct-31-2013 : Set Language Variables
$arrVal 	= $this->lookup_model->getValue('470', $multi_lang);	$lEMAIL   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('471', $multi_lang);	$lPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('472', $multi_lang);	$lFIRSTNAME   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('473', $multi_lang);	$lIM_STUDENT   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('474', $multi_lang);	$lIM_TUTOR   	= $arrVal[$multi_lang];
//---R&D@Oct-31-2013 : Set Language Variables

/** added 25 Nov 13 */
$arrVal = $this->lookup_model->getValue('111', $multi_lang);$student =  $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('110', $multi_lang);$tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('540', $multi_lang);	$lCPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('541', $multi_lang);	$lIAMA   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('618', $multi_lang);	$lSTUDENT_DETAILS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('554', $multi_lang);	$lSELECTING_TUTOR   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('555', $multi_lang);	$lBUYING_CREDITS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('556', $multi_lang);	$lGUARANTEE   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('544', $multi_lang);	$lSPEAK_EN_LIKE_NATIVE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('619', $multi_lang);	$lTUTOR_DESC   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('620', $multi_lang);	$lMY_NEEDS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('621', $multi_lang);	$lTHE_TALKLIST_CHOICES   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('622', $multi_lang);	$lMY_SELECTIONS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('623', $multi_lang);	$lAFFORD_TWICE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('624', $multi_lang);	$lCOST   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('625', $multi_lang);	$lSESSION   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('626', $multi_lang);	$lSTUDY_AT_NIGHT   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('627', $multi_lang);	$lAVAILABILITY   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('628', $multi_lang);	$l1100PM   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('629', $multi_lang);	$lSTUDY_MARKETING   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('630', $multi_lang);	$lBIOGRAPHY   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('631', $multi_lang);	$lBUSS_MAJOR   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('632', $multi_lang);	$lWILL_ATTEND_UCLA   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('633', $multi_lang);	$lLOCATION   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('634', $multi_lang);	$lLOS_ANGELES   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('635', $multi_lang);	$lMY_EXCELLENT_TUTOR   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('636', $multi_lang);	$lBUYING_CREDITS_DESC1   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('637', $multi_lang);	$lBUYING_CREDITS_DESC2   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('638', $multi_lang);	$l5VIDEOS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('639', $multi_lang);	$l7LESSONS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('640', $multi_lang);	$lVIRTUAL_CREDITS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('641', $multi_lang);	$lGUARANTEE_DESC   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('642', $multi_lang);	$lNEW_TO_OUR_PLANTFORM   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('643', $multi_lang);	$lFIRST_SESSION_FREE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('644', $multi_lang);	$lTECH_PROBLEMS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('645', $multi_lang);	$l3_MIN_GRACE_PERIOD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('646', $multi_lang);	$lHAVE_BAD_TUTOR   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('647', $multi_lang);	$lCREDIT_REFUND   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('648', $multi_lang);	$lWORLDS_BEST_TUTORING_GUARANTEE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('663', $multi_lang);	$lSIGN_UP   	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('726', $multi_lang);$school = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('816', $multi_lang);$affiliate = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('909', $multi_lang);$stutorbase = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('910', $multi_lang);$brnlevel = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('911', $multi_lang);$slevel = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('912', $multi_lang);$glavel = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('946', $multi_lang);$readyto = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('940', $multi_lang);$findtutor = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('941', $multi_lang);$browsetutor = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('953', $multi_lang);$lessionseven = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('954', $multi_lang);$fiverecorded = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('955', $multi_lang);$mineach = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('956', $multi_lang);$creativetopic = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1016', $multi_lang);	$selectuser   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1017', $multi_lang);	$enterfname   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1018', $multi_lang);	$emailTaken  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1019', $multi_lang);	$enteremail   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1020', $multi_lang);	$entervalidemail   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1021', $multi_lang);	$enterpass   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1022', $multi_lang);	$sixmin   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1023', $multi_lang);	$confpass   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1024', $multi_lang);	$passmissmatch   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1035', $multi_lang);	$GracePeriod   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1177', $multi_lang);	$TutorAreFree   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1178', $multi_lang);	$HareIsthe   	= $arrVal[$multi_lang];
?>
 <script src="<?php echo base_url('js/home/selectbox.js');?>"></script>
<script src="<?php echo base_url('js/home/clearinputs.js');?>"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
  //$('#text4').rotate(-24);
  $('.cu_dds').selectbox('', 'searchbox');
});
</script>

<style>
.class_two
{
	border:1px solid red;
	border-radius: 10px;
}
</style>
<script>
$(function(){
	
	
	$('input[placeholder]').placeholder();
});

function frmvalidate()
{

//alert($('#fake_confirm_password1').val());
if( $('#roleId1').val() == '9')
{
	document.getElementById('rselect').className += ' class_two';	
	// document.getElementById("rselect").style.border="1px solid red";
	document.getElementById('rid1').style.display = 'block';
	return false;
}
else
{
	document.getElementById("rselect").style.border="none";
	document.getElementById('rid1').style.display = 'none';
	
}
if( $('#firstName1').val() == '')
{
	//document.getElementById("fnamered").style.border="1px solid red";
	document.getElementById('fnamered').className += ' class_two';
	document.getElementById('fname1').style.display = 'block';
	return false;
}
else
{
	document.getElementById("fnamered").style.border="none";
	document.getElementById('fname1').style.display = 'none';
	
}

if( $('#email1').val() == '')
{
	document.getElementById('ered').className += ' class_two';
	//document.getElementById("ered").style.border="1px solid red";
	document.getElementById('remail1').style.display = 'block';
	return false;
}
else
{
	document.getElementById("ered").style.border="none";
	document.getElementById('remail1').style.display = 'none';
	
}
var mail=($('#email1').val());
var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(! re.test(mail))
    {
	 document.getElementById('ered').className += ' class_two';	
	 //document.getElementById("ered").style.border="1px solid red";
	 document.getElementById('vremail1').style.display = 'block';
	return false;
	
	}
	else
	{
		$.getJSON('<?php echo Base_url("user/ajax_check");?>',{id:'email',value:mail},function(msg){
			//alert(msg.success)
			//alert(msg.success)
			if(msg.success){
				 
				   document.getElementById("ered").style.border="none";
					document.getElementById('vremail1').style.display = 'none';
					document.getElementById('email_taken').style.display = 'none';
			}
			else 
			{
				document.getElementById('ered').className += ' class_two';	
				document.getElementById('vremail1').style.display = 'none';
				document.getElementById('email_taken').style.display = 'block';
				//$('#email1').val()='';
				//document.getElementById('email1').value = '';
				
				return false;
					
			}	
	
		//return true;
		
		});
		
	}
if( $('#password1').val() == '')
{
	document.getElementById('passred').className += ' class_two';
	//document.getElementById("passred").style.border="1px solid red";
	document.getElementById('passlong').style.display = 'none';
	document.getElementById('pass1').style.display = 'block';
	return false;
}
else
{
	//document.getElementById("passred").style.border="none";
	document.getElementById('pass1').style.display = 'none';
	
}
var k=$('#password1').val().length;
if(k < 6)
{
	document.getElementById('passred').className += ' class_two';
	//document.getElementById("passred").style.border="1px solid red";
	document.getElementById('passlong').style.display = 'block';
	return false;

}

else
{
	document.getElementById('passlong').style.display = 'none';
}
if( $('#fake_confirm_password1').val() == '')
{
	document.getElementById('cpassred').className += ' class_two';
	//document.getElementById("cpassred").style.border="1px solid red";
	document.getElementById('cpassconf').style.display = 'block';
	return false;
}
else
{
	document.getElementById("cpassred").style.border="none";
	document.getElementById('cpassconf').style.display = 'none';
	
}
var a=$('#password1').val();
var b=$('#fake_confirm_password1').val();

if(a != b)
{
	document.getElementById('cpassred').className += ' class_two';
	//document.getElementById("cpassred").style.border="1px solid red";
	document.getElementById('cpassconf1').style.display = 'block';
	return false;
}
else
{
	document.getElementById("cpassred").style.border="none";
	document.getElementById('cpassconf1').style.display = 'none';
	
}
$('#registerForm1').submit();
 

		return true;
}
</script>


<!--SIGNUP FORM START -->
	<?php if(!$login):?>
    <div class="floating_form" id="signup_form_floating">
        <div class="signup_form" id="signup_form1">
            <div class="sf_padding">
	    		<div class="sf_txt"><?php echo $lsign_up;?></div>
	            <form style="display:block;" action="<?php echo Base_url('user/registerDo');?>" method="POST" id="registerForm1">
	            	<div class="sf_select" id="rselect">
		            	<span class="select_box_holder sel_width_215">
		                    <select id="roleId1" name="roleId" class="cu_dds">
		                        <option value="9"><?php echo $lIAMA;?></option><!--I am a...-->
		                        <option value="0"><?php echo $student;?></option><!--Student-->
		                        <option value="1"><?php echo $tutor;?></option><!--Tutor-->
								<option value="4"><?php echo $school;?></option>
								<option value="5"><?php echo $affiliate;?></option>
		                    </select>
		                </span>
						<span id="roleId_required" style="color:red;display:none;"><b><?php echo $selectuser; ?></b></span>
						<span style="color:red;display:none;font-size:14px;margin-top:40px;" id="rid1"><?php echo $selectuser; ?></span>
					</div>
		            <div class="sf_input" id="fnamered">
		            	<!--<input name="username" type="text" value="First Name" size="25" class="txtbox">-->
		            	<input id="firstName1" type="text" value="<?php echo $lFIRSTNAME;?>" name="firstName" placeholder="<?php echo $lFIRSTNAME;?>" size="25" class="txtbox" />
						<span id="firstName_required" style="color:red;display:none;"><b><?php echo $enterfname;?></b></span>
						<span style="color:red;display:none;font-size:14px;margin-top:10px;" id="fname1"><?php echo $enterfname;?></span>	

					</div>
		            <div class="sf_input" id="ered">
		            	<!--<input name="username" type="text" value="Email" size="25" class="txtbox">-->
		            	<input id="email1" type="text" value="<?php echo $lEMAIL;?>" name="email" placeholder="<?php echo $lEMAIL;?>" size="25" class="txtbox"/>
            		<span id="email_required" style="color:red;display:none;"><b>Email is required</b></span>
            		<span id="email_invalid" style="color:red;display:none;"><b><?php echo $enteremail;?></b></span>
					<span style="color:red;display:none;font-size:14px;margin-top:10px;" id="remail1"><?php echo $enteremail;?></span>
					<span style="color:red;display:none;font-size:14px;margin-top:10px;" id="vremail1"><?php echo $entervalidemail;?></span>	
					<span id="email_taken" style="color:red;display:none;font-size:14px;margin-top:10px;"><b><?php echo $emailTaken;?></b></span>
					</div>
		            <div class="sf_input sf_input_pass" id="passred">
	                  	<input autocomplete="off" type="text" value="<?php echo $lPASSWORD;?>" name="password" placeholder="<?php echo $lPASSWORD;?>" size="25" class="txtbox iposition fake_password"/>
		            	<!--<input name="username" type="text" value="Password" size="25" class="txtbox iposition fake_password">-->
		                <input autocomplete="off" id="password1" name="password" type="password" size="25" class="txtbox iposition password" style="display:none;">
						<span style="color:red;display:none;font-size:14px;margin-top:40px;" id="pass1"><?php echo $enterpass;?></span>
						<span style="color:red;display:none;font-size:14px;margin-top:40px;" id="passlong"><?php echo $sixmin;?></span>
				   </div>
		            <div class="sf_input sf_input_pass" id="cpassred">		            	
									
						<input autocomplete="off" type="password" value="" name="cpassword" placeholder="<?php echo $lCPASSWORD;?>" size="25" class="txtbox iposition" id="fake_confirm_password1"/>
						<input autocomplete="off" name="cpassword" type="password" size="25" class="txtbox iposition" id="fake_confirm_passwordstu" style="display:none;">
		            	
						<span style="color:red;display:none;font-size:14px;margin-top:42px;" id="cpassconf"><?php echo $confpass;?></span>
						<span style="color:red;display:none;font-size:14px;margin-top:42px;" id="cpassconf1"><?php echo $passmissmatch;?></span>
		            </div>
		            <!--<a class="signup_btn" id="registerButton" href="javascript:void(0)"><!--Sign Up--><?php //echo $lsign_up;?></a>-->
		            <input name="signup" onclick="return frmvalidate();" type="button" value="<?php echo $lsign_up;?>" class="signup_btn" id="registerButton1" >
				<input type="hidden" name="regPage"   value="ppc">
				<input type="hidden" name="regReturn" value="<?php echo Base_url();//echo Base_url('index/index');?>">

				
				</form>
                <a href="#" class="close_btn" id="close_btn"></a>
	        </div>
        </div>
        
    </div>
	<?php endif;?>
    <!--SIGNUP FORM END -->
    
    <!--PAGE TITLE START -->
    <div class="page_title wht-ttl">
    	<div class="wrapper"><h1><!--Student Details--><?php echo $lSTUDENT_DETAILS?></h1></div>
    </div>
    <!--PAGE TITLE END -->
    
    <!--CONTENT START -->
    <div class="content">
    	<div class="wrapperinner">
        	<h2 id="select_tutor"><!--Selecting a Tutor--><?php echo $lSELECTING_TUTOR;?></h2>
            <p><!--There is nothing better than having a choice to meet your current learning needs.  Select various tutors based on your goals.--><?php echo $lTUTOR_DESC;?></p>
            
            <div class="selecting_tutor_table clearfix">
            
            	<div class="st_row st_row_header clearfix">
                	<div class="st_col_1">
                    	<!--My Needs--><?php echo $lMY_NEEDS;?>
                    </div>
                	<div class="st_col_2">
                    	&nbsp;
                    </div>
                	<div class="st_col_3">
                    	<!--TheTalkList Choices--><?php echo $lTHE_TALKLIST_CHOICES;?>
                    </div>
                	<div class="st_col_4">
                    	<!--My Selections--><?php echo $lMY_SELECTIONS;?>
                    </div>
                </div>
                
            	<div class="st_row clearfix">
                	<div class="st_col_1">
                    	<!--I can afford twice/week.--><?php echo $lAFFORD_TWICE;?>
                    </div>
                	<div class="st_col_2">
                    	<img src="<?php echo Base_url("images/main/arrow.png");?>" alt="">
                    </div>
                	<div class="st_col_3">
                    	<div class="plus_sign" style="background:none;"><!--Cost--><?php echo $lCOST;?></div>
                    </div>
                	<div class="st_col_4">
                    	<div class="cell_padding"><!--$12/session--><?php echo $lSESSION;?></div>
                    </div>
                </div>
                
            	<div class="st_row clearfix">
                	<div class="st_col_1">
                    	<!--I study at night.--><?php echo $lSTUDY_AT_NIGHT;?>
                    </div>
                	<div class="st_col_2">
                    	<img src="<?php echo Base_url("images/main/arrow.png");?>" alt="">
                    </div>
                	<div class="st_col_3">
                    	<div class="plus_sign"><!--Availability--><?php echo $lAVAILABILITY;?></div>
                    </div>
                	<div class="st_col_4">
                    	<div class="cell_padding"><!--11:00 pm--><?php echo $l1100PM;?></div>
                    </div>
                </div>
                
                <div class="st_row clearfix">
                	<div class="st_col_1">
                    	<!--I am studying marketing.--><?php echo $lSTUDY_MARKETING;?>
                    </div>
                	<div class="st_col_2">
                    	<img src="<?php echo Base_url("images/main/arrow.png");?>" alt="">
                    </div>
                	<div class="st_col_3">
                    	<div class="plus_sign"><!--Biography--><?php echo $lBIOGRAPHY;?></div>
                    </div>
                	<div class="st_col_4">
                    	<div class="cell_padding"><!--Business Major--><?php echo $lBUSS_MAJOR;?></div>
                    </div>
                </div>
                
                <div class="st_row clearfix">
                	<div class="st_col_1">
                    	<!--I will attend UCLA.--><?php echo $lWILL_ATTEND_UCLA;?>
                    </div>
                	<div class="st_col_2">
                    	<img src="<?php echo Base_url("images/main/arrow.png");?>" alt="">
                    </div>
                	<div class="st_col_3">
                    	<div class="plus_sign"><!--Location--><?php echo $lLOCATION;?></div>
                    </div>
                	<div class="st_col_4">
                    	<div class="cell_padding"><!--Los Angeles--><?php echo $lLOS_ANGELES;?></div>
                    </div>
                </div>
                
                <div class="st_row clearfix">
                	<div class="tutor_box" style="width:517px;">
                    	<span><!--My excellent tutor--><?php echo $lMY_EXCELLENT_TUTOR?></span>
                    </div>
					<div class="brows-twt"><div id="text4" class="brw-ttl"><p style="font-family:Shadows Into Light Two",cursive><?php echo $readyto?><br><?php echo $findtutor;?></p></div><a href="<?php echo Base_url("search/search");?>"><span class="brw-tutr1" style="margin-top:91px;"><?php echo $browsetutor;?></span><img class="himg" src="<?php echo base_url('images/students-pg-img.png')?>"></a></div>					
                </div>
				
            </div>
            
				                	<div class="st_col_1">
				<p><?php echo $stutorbase;?></p><br>
								</div>
                                <div class="clearfix level-main-str">
			      <div class="level-str"><img class="himg" src="<?php echo base_url('images/bronze.png')?>"> 
                  <h3><?php echo $brnlevel;?></h3>
                  </div>
				   <div class="level-str"><img class="himg" src="<?php echo base_url('images/silver.png')?>">
                   <h3><?php echo $slevel;?></h3>
                    </div>
					<div class="level-str"><img class="himg" src="<?php echo base_url('images/gold.png')?>">
                    <h3><?php echo $glavel;?></h3>
                    </div>	
                    </div>
								
			<div style="margin-top:50px;"></div> 
            <h2 id="buying_credit"><!--Buying Credits--><?php echo $lBUYING_CREDITS?></h2>
            
            <div class="buying_credits byd-cdt-sm">
            	<div class="buying_crdt-txt">
                <p><!--TheTalkList operates using virtual credits.  You purchase a credit package and then use them whenever you like.  The more you buy, the more you save.  With these credits you can pay for 1 to 1 live lessons or tutor videos.  Stay active and the credits don't expire.--><?php echo $lBUYING_CREDITS_DESC1;?></p>
				<p><?php echo $TutorAreFree;?><br><?php echo $HareIsthe?></p><br>
                </div>
                <div class="buying_credit_table">
                    <div class="bc_row_1 clearfix">
                    	<div class="bc_col_1">&nbsp;</div>
                        <div class="bc_col_2"><!--7 lessons--><?php echo $lessionseven;?></div>
                        <div class="bc_col_3"><!--5 videos--><?php echo $fiverecorded;?></div>
                        <!--<div class="sig-col">&nbsp;</div>-->
                    </div>
                    <div class="bc_row_2 clearfix">
                    	
                        <div class="bc_col_1"><!--100 Virtual Credits<br>($100)--><?php echo $lVIRTUAL_CREDITS;?></div>
                        <div class="bc_col_2"><img src="<?php echo Base_url("images/main/credit_icons2.png");?>" alt=""></div>
                        <div class="sig-col"><a href="javascript:void(0)" class="sign-btn-stn"><?php echo $lsign_up;?> >></a></div>
                        
                    </div>
                     <div class="bc_row_1 by-cdt-txt clearfix">
                    	<div class="bc_col_1">&nbsp;</div>
                        <div class="bc_col_2">(<?php echo $mineach; ?>)</div>
                        <div class="bc_col_3">(<?php echo $creativetopic;?>)</div>
                    </div>
                    
                </div>
            </div>
            
            <h2 id="guarantee"><!--Guarantee--><?php echo $lGUARANTEE;?></h2>
            <p><!--We have a 100% guarantee that you will be satisfied.  Here are all the ways we ensure that you get the best value out of your membership.--><?php echo $lGUARANTEE_DESC;?></p>
            
            <div class="guarantee_table clearfix">
            	<div class="gt_row clearfix">
                	<div class="gt_col_1"><!--New to our platform?--><?php echo $lNEW_TO_OUR_PLANTFORM;?></div>
                	<div class="gt_col_2"><img src="<?php echo Base_url("images/main/arrow.png");?>" alt=""></div>
                	<div class="gt_col_3"><div class="plus_sign" style="background:none;"><!--First session FREE--><?php echo $lFIRST_SESSION_FREE;?></div></div>
                </div>
            	<div class="gt_row clearfix">
                	<div class="gt_col_1"><!--Technical problems?--><?php echo $lTECH_PROBLEMS;?></div>
                	<div class="gt_col_2"><img src="<?php echo Base_url("images/main/arrow.png");?>" alt=""></div>
                	<div class="gt_col_3"><div class="plus_sign"> <?php echo $GracePeriod;?> </div></div>
                </div>
            	<div class="gt_row clearfix">
                	<div class="gt_col_1"><!--Have a bad tutor?--><?php echo $lHAVE_BAD_TUTOR;?></div>
                	<div class="gt_col_2"><img src="<?php echo Base_url("images/main/arrow.png");?>" alt=""></div>
                	<div class="gt_col_3 gt_border"><div class="plus_sign"><!--Credit refund--><?php echo $lCREDIT_REFUND;?></div></div>
                </div>
                <div class="gt_row_last"><!--The Worlds Best Tutoring Guarantee--><?php echo $lWORLDS_BEST_TUTORING_GUARANTEE;?></div>
            	
            </div>
            
            
        </div>
    </div>
    <!--CONTENT END -->
