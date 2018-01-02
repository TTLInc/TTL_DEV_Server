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

$arrVal 	= $this->lookup_model->getValue('221', $multi_lang);	$lsign_up = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('541', $multi_lang);	$lIAMA   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1232', $multi_lang);	$member = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1231', $multi_lang);	$lIM_MEMBER  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('726', $multi_lang);	$school   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('816', $multi_lang);	$affiliate   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1016', $multi_lang);	$selectuser   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1017', $multi_lang);	$enterfname   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1018', $multi_lang);	$emailTaken  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1019', $multi_lang);	$enteremail   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1020', $multi_lang);	$entervalidemail   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1021', $multi_lang);	$enterpass   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1022', $multi_lang);	$sixmin   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1023', $multi_lang);	$confpass   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1024', $multi_lang);	$passmissmatch   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('470', $multi_lang);	$lEMAIL   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('471', $multi_lang);	$lPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('472', $multi_lang);	$lFIRSTNAME   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('540', $multi_lang);	$lCPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1309', $multi_lang);	$lngAlready   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('546', $multi_lang);		$SIGN_IN   			= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('547', $multi_lang);		$lSIGN_IN   		= $arrVal[$multi_lang];

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
$this->layout->appendFile('css',"css/contact.css");?>
<div class="contact_us">
	<div class="signup-formpage">
		<div class="left-form">
		<?php if (!$this->session->userdata("uid")) {?>		
		<div class="signup-title"><?php echo $lsign_up; ?></div>
		<!--<p style="color:Red"><?php if(isset($error)) print_R($error);?></p>-->
		<?php if(isset($errorMsg)){ ?>
			<p style="color:green"><?php if(isset($error));echo $errorMsg;?></p>
		<?php } ?>
		<span style="color:red;font-size:16px;">
			<?php echo $this->session->userdata('RegLink');$this->session->set_userdata('RegLink','') ?>
		</span>
		<form style="display:block;" action="<?php echo Base_url('user/registerDo');?>" method="POST" id="registerForm1">
		<div class="frm-row" id="rselect">
			<span><?php echo $lIAMA;?></span>
			<select id="roleId1" name="roleId">
				<option value="9"><?php echo $lIAMA;?></option>
				<option value="0"><?php echo $member;?></option>
				<option value="4"><?php echo $school;?></option>
				<option value="5"><?php echo $affiliate;?></option>
			</select>
			<label class="lblerror" id="rid1"><?php echo $selectuser; ?></label>
		</div>
		<div class="frm-row" id="fnamered">
			<span><?php echo $lFIRSTNAME;?></span>
			<input id="firstName1" type="text" value="" name="firstName" placeholder="" size="25" class="txtbox" />
			<label class="lblerror" id="fname1"><?php echo $enterfname;?></label>
		</div>
		<div class="frm-row" id="ered">
			<span><?php echo $lEMAIL;?></span>
			<input id="email1" type="text" value="" name="email" placeholder="" size="25" class="txtbox"/>
			<label id="email_taken" class="lblerror"><?php echo $emailTaken;?></label>
			<label class="lblerror" id="remail1"><?php echo $enteremail;?></label>
			<label class="lblerror" id="vremail1"><?php echo $entervalidemail;?></label>
		</div>
		<div class="frm-row" id="passred">
			<span><?php echo $lPASSWORD;?></span>
			<input autocomplete="off" id="password" name="password" type="password" size="25" class="txtbox" />
			<label class="lblerror" id="pass1"><?php echo $enterpass;?></label>
			<label class="lblerror" id="passlong"><?php echo $sixmin;?></label>
		</div>		
        <div class="frm-row">
			<span><?php echo $lCPASSWORD;?></span>
			<input autocomplete="off" type="password" name="cpassword" size="25" class="txtbox" id="cpassword1"/>
			<label class="lblerror" id="cpassconf"><?php echo $confpass;?></label>
			<label class="lblerror" id="cpassconf1"><?php echo $passmissmatch;?></label>
		</div>
		<div class="frm-row">
        <span>&nbsp;</span>
			<input name="signup" onClick="return frmvalidate();" type="button" value="<?php echo $lsign_up;?>" id="registerButton1" />
			<input type="hidden" name="regPage"   value="ppc">
			<input type="hidden" name="regReturn" value="">
			<input type="hidden" name="refid"   value="<?php echo $this->uri->segment(2);?>">
            <div class="all-acc">
                <p><?php echo $lngAlready;?></p>
                <p>
                    <a href="javascript:void(0);" name="signin" class="signin_btn" id="signin_btn">
                    <?php echo $SIGN_IN;?></a>
                </p>
            </div>
		</div>
        <!--<p class="fget"><a  href="forget"><?php echo $forget_password; ?></a></p>-->
		</form>
	<?php }?>
		</div>
   		<div class="right-fbimage">
			<?php 
            if ($contests) {?>
				<div class="signup-title"><?php echo $contests[0]['text']; ?></div>
                <img src="<?php echo base_url("uploads/images/".$contests[0]['image']);?>" />
            <?php }	?>
        </div>
	</div>
</div>

<script type="text/javascript">
function frmvalidate()
{
	$('#roleId1, #firstName1, #email1, #password, #cpassword1').css("border","");
	$('#rid1, #fname1, #vremail1, #email_taken, #pass1, #passlong, #cpassconf, #cpassconf1').hide();
	if( $('#roleId1').val() == '9')
	{
		$('#roleId1').css("border","1px solid red").focus();
		$("#rid1").show();	
		return false;
	}
	if($('#firstName1').val() == '')
	{
		$('#firstName1').css("border","1px solid red").focus();	
		$("#fname1").show();		
		return false;
	}
	var mail=($('#email1').val());
	var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if( $('#email1').val() == '')
	{
		$('#email1').css("border","1px solid red").focus();	
		$('#vremail1').show();
		return false;
	}
	if(!re.test(mail))
	{
		$('#email1').css("border","1px solid red").focus();	
		$('#vremail1').show();	
		return false;
	} else {
		$.getJSON('<?php echo Base_url("user/ajax_check");?>',{id:'email',value:mail},function(msg){
			if(msg.success){
				/*document.getElementById("ered").style.border="none";
				document.getElementById('vremail1').style.display = 'none';
				document.getElementById('email_taken').style.display = 'none';*/
				passCheck();
			} else {
				$('#email1').css("border","1px solid red").show();
				$('#email_taken').show();
			}
		});
		return true;
	}
}

function passCheck()
{
	if( $('#password').val() == '') {
		$('#password').css("border","1px solid red").focus();	
		$('#pass1').show();
		return false;
	}
	var k=$('#password').val().length;
	if(k < 6)
	{
		$('#password').css("border","1px solid red").focus();	
		$('#passlong').show();
		return false;
	}
	if($('#cpassword1').val() == "")
	{
		$("#cpassword1").css("border","1px solid red").focus();
		$('#cpassconf').show();
		return false;
	}
	var a=$('#password').val();
	var b=$('#cpassword1').val();
	if(a != b)
	{
		$('#cpassword1').css("border","1px solid red").focus();
		$('#cpassconf1').show();
		return false;
	}
	$('#registerForm1').submit();
}
</script>
<script type="text/javascript">
$(function(){
    $('input').keydown(function(e){
        if (e.keyCode == 13) {
			frmvalidate()
             
        }
    });
	//SIGNUP OPEN
	$('.signin_btn').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 800);
		$('#header_login').slideDown(300);
		return false;
	});
}); 
</script>
