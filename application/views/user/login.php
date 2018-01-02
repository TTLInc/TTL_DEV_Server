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
$arrVal = $this->lookup_model->getValue('5', $multi_lang);
$vlogin = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('6', $multi_lang);
$forget_password = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('371', $multi_lang);
$vregister = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('20', $multi_lang);
$vpassword = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('35', $multi_lang);
$vemail = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('888', $multi_lang);
$or = $arrVal[$multi_lang];
?>
<?php $this->layout->appendFile('css',"css/contact.css");?>
<div class="contact_us">
	<div class="contact_us_top"><?php echo $vlogin; ?></div>
	<div class="contact_us_mid login-frm">
		<p style="color:Red"><?php if(isset($error)) print_R($error);?></p>
		
		<?php if(isset($errorMsg)){ ?>
		<p style="color:green"><?php if(isset($error));echo $errorMsg;?></p>
		<?php } ?>
		<span style="color:red;font-size:16px;"><?php echo $this->session->userdata('RegLink');$this->session->set_userdata('RegLink','') ?></span>
		<form method="post" action="">
		<!-- remove username and add email address BY TECHNO-SANJAY -->
		<!--<p>Username:<input type="text" name="username" value="" id="username" /></p>-->
		<p><span><?php echo $vemail; ?>:</span><input type="text" name="email" value="" id="email" /></p>
		<p><span><?php echo $vpassword; ?>:</span><input type="password" name="password" value="" id="password" /></p>

		<!--<p class="login-button">
		<input class="login-btn" type="submit" value="<?php echo $vlogin; ?>" name="submit" />
		<input type='hidden' name="confacc" value="<?php echo $this->session->userdata('isnew1') ?>" >
		<input class="reg-btn" type="button" value="<?php echo $vregister; ?>" name="register" onclick="document.location.href='<?php echo base_url('');?>'"/>
		<p><?php echo $or;?></p>-->
		<p class="login-button">
		<input class="login-btn" type="submit" value="<?php echo $vlogin; ?>" name="submit" />
		<input type='hidden' name="confacc" value="<?php echo $this->session->userdata('isnew1') ?>" >
		<!--<input class="reg-btn" type="button" value="<?php echo $vregister; ?>" name="register" onclick="document.location.href='<?php echo base_url('');?>'"/>--><span><?php echo $or;?></p>
		

<?php  if($multi_lang != 'ch'){?>
<a href="<?php echo $fblogin_url; ?>" class="reg-btn" style="background:url('<?php echo base_url('images/main/fb_connect.png');?>');height: 47px;width: 170px;float:left;margin-left:100px;"></a>
<?php } else { ?>
<?php include_once("weibo/index.php");?>
<?php } ?>
        <p class="fget"><a  href="forget"><?php echo $forget_password; ?></a></p>
		</form>
		
	</div>
</div>
