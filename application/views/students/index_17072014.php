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

?>
<script>

</script>

<!--SIGNUP FORM START -->
	<?php if(!$login):?>
    <div class="floating_form" id="signup_form_floating">
        <div class="signup_form">
            <div class="sf_padding">
	    		<div class="sf_txt"><!--Sign Up--><?php echo $lsign_up;?>:</div>
	            <form style="display:block;" action="<?php echo Base_url('user/registerDo');?>" method="POST" id="registerForm">
	            	<div class="sf_select">
		            	<span class="select_box_holder sel_width_215">
		                    <select id="roleId" name="roleId" class="cu_dds">
		                        <option value="0"><?php echo $lIAMA;?></option><!--I am a...-->
		                        <option value="0"><?php echo $student;?></option><!--Student-->
		                        <option value="1"><?php echo $tutor;?></option><!--Tutor-->
								<option value="4"><?php echo $school;?></option>
								<option value="5"><?php echo $affiliate;?></option>
		                    </select>
		                </span>
						<span id="roleId_required" style="color:red;display:none;"><b>Select</b></span>

					</div>
		            <div class="sf_input">
		            	<!--<input name="username" type="text" value="First Name" size="25" class="txtbox">-->
		            	<input id="firstName" type="text" value="" name="firstName" placeholder="<?php echo $lFIRSTNAME;?>" size="25" class="txtbox" />
						<span id="firstName_required" style="color:red;display:none;"><b>Firstname is required</b></span>

					</div>
		            <div class="sf_input">
		            	<!--<input name="username" type="text" value="Email" size="25" class="txtbox">-->
		            	<input id="email" type="text" value="" name="email" placeholder="<?php echo $lEMAIL;?>" size="25" class="txtbox"/>
            		<span id="email_required" style="color:red;display:none;"><b>Email is required</b></span>
            		<span id="email_invalid" style="color:red;display:none;"><b>Email is invalid</b></span>

					</div>
		            <div class="sf_input sf_input_pass">
	                  	<input autocomplete="off" type="text" value="" name="password" placeholder="<?php echo $lPASSWORD;?>" size="25" class="txtbox iposition fake_password"/>
		            	<!--<input name="username" type="text" value="Password" size="25" class="txtbox iposition fake_password">-->
		                <input autocomplete="off" id="password" name="password" type="password" size="25" class="txtbox iposition password" style="display:none;">
		            </div>
		            <div class="sf_input sf_input_pass">
		            	<input autocomplete="off" type="text" value="" name="cpassword" placeholder="<?php echo $lCPASSWORD;?>" size="25" class="txtbox iposition" id="fake_confirm_password"/>
		            	<!--<input name="username" type="text" value="Confirm Password" size="25" class="txtbox iposition" id="fake_confirm_password">-->
		                <input autocomplete="off" name="cpassword" type="password" size="25" class="txtbox iposition" id="confirm_password" style="display:none;">
		            </div>
		            <!--<a class="signup_btn" id="registerButton" href="javascript:void(0)"><!--Sign Up--><?php //echo $lsign_up;?></a>-->
		            <input name="signup" type="submit" value="<?php echo $lSIGN_UP;?>" class="signup_btn" id="registerButton" >
				<input type="hidden" name="regPage"   value="ppc">
				<input type="hidden" name="regReturn" value="<?php echo Base_url('index/index');?>">

				
				</form>
	        </div>
        </div>
    </div>
	<?php endif;?>
    <!--SIGNUP FORM END -->
    
    <!--PAGE TITLE START -->
    <div class="page_title">
    	<div class="wrapper"><h1><!--Student Details--><?php echo $lSTUDENT_DETAILS?></h1></div>
    </div>
    <!--PAGE TITLE END -->
    
    <!--CONTENT START -->
    <div class="content">
    	<div class="wrapperinner">
        	<h2 id="select_tutor"><!--Selecting a Tutor--><?php echo $lSELECTING_TUTOR?></h2>
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
                	<div class="tutor_box">
                    	<span><!--My excellent tutor--><?php echo $lMY_EXCELLENT_TUTOR?></span>
                    </div>
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
								
            
            <h2 id="buying_credit"><!--Buying Credits--><?php echo $lBUYING_CREDITS?></h2>
            
            <div class="buying_credits">
                <p><!--TheTalkList operates using virtual credits.  You purchase a credit package and then use them whenever you like.  The more you buy, the more you save.  With these credits you can pay for 1 to 1 live lessons or tutor videos.  Stay active and the credits don't expire.--><?php echo $lBUYING_CREDITS_DESC1;?></p>
                <p><!--Prices of tutors and videos vary, but here is the type of value a student gets.--><?php echo $lBUYING_CREDITS_DESC2;?></p>
                
                <div class="buying_credit_table">
                    <div class="bc_row_1 clearfix">
                        <div class="bc_col_1"><!--5 videos--><?php echo $l5VIDEOS;?></div>
                        <div class="bc_col_2"><!--7 lessons--><?php echo $l7LESSONS;?></div>
                    </div>
                    <div class="bc_row_2 clearfix">
                        <div class="bc_col_1"><!--100 Virtual Credits<br>($100)--><?php echo $lVIRTUAL_CREDITS;?></div>
                        <div class="bc_col_2"><img src="<?php echo Base_url("images/main/credit_icons.jpg");?>" alt=""></div>
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
                	<div class="gt_col_3"><div class="plus_sign"><!--3 minute grace period--><?php echo $l3_MIN_GRACE_PERIOD;?></div></div>
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
