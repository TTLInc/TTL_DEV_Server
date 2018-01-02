<?php 
$arrVal 	= $this->lookup_model->getValue('546', $multi_lang);		$SIGN_IN   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('470', $multi_lang);		$lEMAIL   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('471', $multi_lang);		$lPASSWORD   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('5', $multi_lang);			$llogin				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('238', $multi_lang);		$lforget			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1236', $multi_lang);		$BE_A   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('926', $multi_lang);		$stu   				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('554', $multi_lang);		$lSELECTING_TUTOR   = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('555', $multi_lang);		$lBUYING_CREDITS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('556', $multi_lang);		$lGUARANTEE   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('140', $multi_lang);        $lsearch			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('414', $multi_lang);		$lFAQ   			= @$arrVal[$multi_lang];
$arrVal		= $this->lookup_model->getValue('110', $multi_lang);		$tutor 				= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('557', $multi_lang);		$lOVERVIEW   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('558', $multi_lang);		$lBECOME_TUTOR   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('559', $multi_lang);		$lLEVELS   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('560', $multi_lang);		$lMAKE_MONEY   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('561', $multi_lang);		$lMARKET_YOURSELF   = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1015', $multi_lang);		$schoolProgram  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('840', $multi_lang);		$comunity   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('547', $multi_lang);		$lSIGN_IN   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('221', $multi_lang);		$lsign_up 			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('939', $multi_lang);		$cnglang			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('472', $multi_lang);		$lFIRSTNAME   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1017', $multi_lang);		$enterfname   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1019', $multi_lang);		$enteremail   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1020', $multi_lang);		$entervalidemail   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1018', $multi_lang);		$emailTaken  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1021', $multi_lang);		$enterpass   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1022', $multi_lang);	$sixmin   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('540', $multi_lang);	$lCPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1023', $multi_lang);	$confpass   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1024', $multi_lang);	$passmissmatch   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('314', $multi_lang);		$lwelcome 			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('315', $multi_lang);		$llogout 			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('323', $multi_lang); 		$videotext 			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('420', $multi_lang);		$lSUPPORT   		= @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('387', $multi_lang);		$lFORUM   			= @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('417', $multi_lang);		$lSTUDENT_RESOURCES = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('388', $multi_lang);		$lTUTOR_RESOURCES   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('721', $multi_lang);		$lteacher_learning = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('140', $multi_lang); 		$search 			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('330', $multi_lang);		$profile    		= $arrVal[$multi_lang];

?>
<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<?php 
	if(!$this->session->userdata('uid')):
?>
		<div class="logintop_form_main01 cf" id="header_login">
			<div class="container cf">
				<form action="<?php echo Base_url("user/login");?>" method="post" id="formLogin" >
					<div class="logintop_form_left01">
						<?php echo $SIGN_IN;?>
					</div>
					<div class="logintop_form_left02">
						<input name="email" type="text" placeholder="<?php echo $lEMAIL;?>">
					</div>
					<div class="logintop_form_left03">
						<input name="password" type="password" placeholder="<?php echo $lPASSWORD;?>">
					</div>
					<div class="logintop_form_left04">
						<input name="login" type="submit" value="<?php echo $llogin;?>">
					</div>
					<div class="logintop_form_left05">
						<a href="<?php echo base_url('user/forget');?>"><?php echo $lforget;?></a>
					</div>
					<div class="login_close_icon"><a id="close_btn" href="#"></a></div>
				</form>	
			</div>
		</div>
<?php 
	endif;
?>
<?php 
	if(!$this->session->userdata('uid')):
?>
		<div class="logintop_form_main01 cf" id="header_register">
			<div class="container cf">
				<form action="<?php echo Base_url('user/registerDo');?>" method="post" id="registerForm123" >
					<input type="hidden" name="roleId" id="roleId2" value='0'>
					<div class="logintop_form_left01">
						<?php echo $lsign_up;?> 
					</div>
					<div class="logintop_form_left02">
						<input name="firstName" id="firstName2" placeholder="<?php echo $lFIRSTNAME;?>" size="25" type="text">
						<span id="firstName_required" style="color:red;display:none;"><b><?php echo $enterfname;?></b></span>
                        <span style="color:red;display:none;font-size:14px;margin-top:5px;" id="fname2"><?php echo $enterfname;?></span>
					</div>
					<div class="logintop_form_left03">
						<input id="email2" type="text" value="" name="email" placeholder="<?php echo $lEMAIL;?>" size="25">
						<span id="email_required" style="color:red;display:none;"><b><?php echo $enteremail;?></b></span>
						<span id="email_invalid" style="color:red;display:none;"><b><?php echo $entervalidemail;?></b></span>
						<span style="color:red;display:none;font-size:14px;margin-top:5px;" id="remail2"><?php echo $enteremail;?></span>
						<span style="color:red;display:none;font-size:14px;margin-top:5px;" id="vremail2"><?php echo $entervalidemail;?></span>
						<span id="email_taken2" style="color:red;display:none;font-size:14px;margin-top:10px;"><b><?php echo $emailTaken;?></b></span>
					</div>
					<div class="logintop_form_left03">
						<input autocomplete="off" type="password"  value="" name="password" id="mpass" placeholder="<?php echo $lPASSWORD;?>" size="25" class="txtbox iposition fake_password"/>
		                <input autocomplete="off" id="password2" name="password" type="password" size="25" class="txtbox iposition password" style="display:none;">
		                <span style="color:red;display:none;font-size:14px;margin-top:5px;" id="mpass1"><?php echo $enterpass;?></span> 
						<span style="color:red;display:none;font-size:14px;margin-top:5px;" id="passlongs"><?php echo $sixmin;?></span>
						<input autocomplete="off" style="margin-top:5px;" type="password" id="cpassword" value="" name="cpassword" placeholder="<?php echo $lCPASSWORD;?>" size="25" class="txtbox iposition" id="fake_confirm_password"/>
		                <input autocomplete="off" id="cpassword2" name="cpassword " type="password" size="25" class="txtbox iposition" id="confirm_password2" style="display:none;">
		                <span style="color:red;display:none;font-size:14px;margin-top:5px;" id="cpass2"><?php echo $confpass;?></span>
						<span style="color:red;display:none;font-size:14px;margin-top:5px;" id="fcpass2"><?php echo $passmissmatch;?></span>					
					</div>
					<div class="logintop_form_left04">
						<input name="signup" type="button" onClick="frmvalidate1();"  value="<?php echo $lsign_up;?>" class="signup_btn" id="registerButton21" >
						<input type="hidden" name="regPage"   value="ppc">
						<input type="hidden" name="regReturn" value="<?php  echo Base_url();// echo Base_url('index/index');?>">
						<input type="hidden" name="redirect" value="<?php echo $_SERVER['PATH_INFO'];?>" >
					</div>
					<div class="login_close_icon"><a id="close_btn_register" href="#"></a></div>
				</form>	
			</div>
		</div>
<?php 
	endif;
?>
<div class="top_header cf">
	<div class="container cf <?php if($this->session->userdata('uid')) echo 'after_login' ?>">
		<div class="top_header_left01"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('images/angular_search/logo.jpg');?>" width="182" height="68" alt="logo"></a></div>
		<div class="top_header_left02">
			<ul id="menu" class="cf">
				<?php 
					if(!$this->session->userdata('uid')):
				?>
					<li>
						<a href="<?php echo Base_url("students/index");?>"><?php echo $BE_A; ?><span><?php echo $stu;?></span></a>
						<ul>
							<li><a href="<?php echo Base_url("students/index#select_tutor");?>"><?php echo $lSELECTING_TUTOR;?></a></li>
							<li><a href="<?php echo Base_url("students/index#buying_credit");?>"><?php echo $lBUYING_CREDITS;?></a></li>
							<li><a href="<?php echo Base_url("students/index#guarantee");?>"><?php echo $lGUARANTEE?></a></li>
							<li><a href="<?php echo Base_url("search/search");?>"><?php echo $lsearch;?></a></li>
							<li><a href="<?php echo Base_url("support/faqs");?>"><?php echo $lFAQ;?></a></li>
						</ul>
					</li>
					<li>
						<a href="<?php echo Base_url("tutor/index");?>"><?php echo $BE_A; ?><span><?php echo $tutor;?></span></a>
						<ul>
							<li><a href="<?php echo Base_url("tutor/index#overview");?>"><?php echo $lOVERVIEW;?></a></li>
							<li><a href="<?php echo Base_url("tutor/index#become_trust");?>"><?php echo $lBECOME_TUTOR;?></a></li>
							<li><a href="<?php echo Base_url("tutor/index#levels");?>"><?php echo $lLEVELS;?></a></li>
							<li><a href="<?php echo Base_url("tutor/index#make_money");?>"><?php echo $lMAKE_MONEY;?></a></li>
							<li><a href="<?php echo Base_url("tutor/index#market_yourself");?>"><?php echo $lMARKET_YOURSELF;?></a></li>
							<li><a href="<?php echo Base_url("support/faqs");?>"><?php echo $lFAQ;?></a></li>
						</ul>
					</li>
					<li>
						<a href="<?php echo Base_url("school/index");?>"> <span><?php echo $schoolProgram;?></span></a>
						<ul>
							<li><a href="<?php echo Base_url("school/index#soverview");?>"><?php echo $lOVERVIEW;?></a></li>
							<li><a href="<?php echo Base_url("school/index#sbecome_trust");?>"><?php echo $comunity;?></a></li>       
							<li><a href="<?php echo Base_url("school/index#slevels");?>"><?php echo $lMAKE_MONEY;?></a></li>
						</ul>
					</li>
				<?php endif;?>
				<?php 
					if($this->session->userdata('uid')):
				?>
						<?php 
							if($this->session->userdata('roleId')==4) 
							{
						?>
								<li><a href="<?php echo Base_url("user/organization");?>"><?php echo $profile;?></a></li>
			 
						<?php 
							} 
							else if($this->session->userdata('roleId')==5)
							{ 
						?>
								<li><a href="<?php echo Base_url("user/Affiliate");?>"><?php echo $profile;?></a></li>
						<?php 		
							}
							else
							{
						?>
								<li><a href="#"><?php echo $profile;?></a>
										<?php 
											if ($this->session->userdata('roleId')==0) 
											{
												echo profile_menu_search_page('s_private','p_dasb',$this->session->userdata('uid'),true);
											} 
											else if (($this->session->userdata('roleId') > 0) and  ($this->session->userdata('roleId') < 4)) 
											{
												echo profile_menu_search_page('t_private','p_dasb',$this->session->userdata('uid'),true);
											}
										?>	
								</li>
				
						<?php 
							}
						?>
						<li class="active">
							<a href="<?php echo Base_url("search/search");?>"> <?php echo $search;?></a>
						</li>
						<li>
							<a href="<?php echo Base_url("search/videosearch");?>"><?php echo $videotext;?></a>
						</li>	
						<li>
							<a href="#"><?php echo $lSUPPORT;?></a>
							<ul>
								<li><a href="<?php echo Base_url("support/faqs");?>"><?php echo $lFAQ;?></a></li>
								<li><a href="<?php echo base_url('forum');?>"><?php echo $lFORUM;?></a></li>
								<?php 
									if($this->session->userdata('roleId') <4) {?>
										<?php 
											if($this->session->userdata('roleId') == '' || $this->session->userdata('roleId') == 0): 
										?>
												<li><a href="<?php echo base_url('support/resources');?>"><?php echo $lSTUDENT_RESOURCES;?></a></li>
										<?php 
											else: 
												if($this->session->userdata('universal_roleId') == 1)
												{
										?>
													<li><a href="<?php echo base_url('support/resources/student');?>"><?php echo $lSTUDENT_RESOURCES;?></a></li>
										<?php 
												}
										?>
										<li><a href="<?php echo base_url('support/resources');?>"><?php echo $lTUTOR_RESOURCES;?></a></li>
										<?php 
											if($this->session->userdata('roleId')==1) 
											{
										?>
												<li><a href="<?php echo base_url('support/tutor_training');?>"><?php echo $lteacher_learning;?></a></li>
										<?php 
											}
										?>
										<?php 
											endif;
										?>
								<?php 
									}
								?>
							</ul>
						</li>	
				<?php 
					endif;
				?>
			</ul>
		</div>
		<div class="top_header_left03">
			<ul>
				<?php 
					if($this->session->userdata('uid')):
				?>
						<li class="signin_top01 welcome_button"><?php echo $lwelcome;?>, <?php echo ucfirst($this->session->userdata['welcomeuser']);?></li>
						<?php if($this->session->userdata('roleId') <= 3) {?>
						<!--<a class="owner-settings dash-setting" href="<?php echo base_url('user/AffiliateInfo');?>"><span class="setting-icon"></span></a>	-->
					<?php //} else { ?>
						<a class="owner-settings dash-setting" href="<?php echo base_url('user/changeInfo');?>"><span class="setting-icon"></span></a>	
					<?php } else if ($this->session->userdata('roleId') == 4) {?>
						<a class="owner-settings dash-setting" href="<?php echo base_url('user/myInfo');?>"><span class="setting-icon"></span></a>	
					<?php } else if ($this->session->userdata('roleId') == 5) {?>
						<a class="owner-settings dash-setting" href="<?php echo base_url('user/AffiliateInfo');?>"><span class="setting-icon"></span></a>	
					<?php } ?>
						<li class="signup_top02 logout_button"><a href="<?php echo Base_url("user/slogout");?>"><?php echo $llogout;?></a></li>
				<?php 
					endif;
				?>
				<?php 
					if(!$this->session->userdata('uid')):
				?>
						<li class="signin_top01"><a href="javascript:void(0)" id="signin_btn"><?php echo $lSIGN_IN;?></a></li>
						<li class="signup_top02"><a href="javascript:void(0)" id="register_btn"><?php echo $lsign_up;?> >></a></li>
				<?php 
					endif;
				?>
				<li class="change_language_top03"><a href="javascript:void(0)"><?php echo $cnglang;?> ></a>
					<ul>
						<li><a onclick="changeLanguage('en');" class="multi_lang_change">English</a></li>
						<li><a onclick="changeLanguage('es');" class="multi_lang_change">Español</a></li>
						<li><a onclick="changeLanguage('fr');" class="multi_lang_change">Français</a></li>
						<li><a onclick="changeLanguage('ch');" class="multi_lang_change">简体中文</a></li>
						<li><a onclick="changeLanguage('tw');" class="multi_lang_change">繁體中文</a></li>
						<li><a onclick="changeLanguage('jp');" class="multi_lang_change">日本語</a></li>
						<li><a onclick="changeLanguage('kr');" class="multi_lang_change">한국어</a></li>
						<li><a onclick="changeLanguage('pt');" class="multi_lang_change">Português</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<div class="cf"></div>
		<div class="cf mobile_menu"></div>
	</div>
</div>
<div class="grey_bg_top"></div>

