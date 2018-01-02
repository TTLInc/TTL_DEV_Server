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
$arrVal 	= $this->lookup_model->getValue('95', $multi_lang);
$lcumulative	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('97', $multi_lang);
$lconductpayment = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('98', $multi_lang);
$lfuturedduration = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('99', $multi_lang);
$lmonth = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('337', $multi_lang);
$lmonths = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('100', $multi_lang);
$lpremiummembership	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('101', $multi_lang);
$lamount	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('109', $multi_lang);
$lpaymentoption	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('102', $multi_lang);
$lpaypalrecurring = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('103', $multi_lang);
$lpaypalmajorcards = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('252', $multi_lang);
$lpaypalemail = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('253', $multi_lang);
$lgetpaidpaypal = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('135', $multi_lang);
$lsave = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('320', $multi_lang);
$upgradeaccounttext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('321', $multi_lang);
$credittext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('322', $multi_lang);
$freetext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('334', $multi_lang);
$getpaidtext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('335', $multi_lang);
$totalearnings = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('336', $multi_lang);
$selectpaidtext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('35', $multi_lang);
$emailtext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('338', $multi_lang);
$upgradepopuptext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('340', $multi_lang);
$upgradestudentpopuptext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('339', $multi_lang);
$lrecommends = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('341', $multi_lang);
$lloadaccount = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('376', $multi_lang);
$lbuynow = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('813', $multi_lang);
$one_free = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('814', $multi_lang);
$two_free = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('552', $multi_lang);
$tutors = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('551', $multi_lang);
$students1 = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('825', $multi_lang);
$addnew = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('105', $multi_lang);
$lmonthly = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('106', $multi_lang);
$lannually = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('107', $multi_lang);
$ltotal = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('826', $multi_lang);
$youhaveno = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('827', $multi_lang);
$tsessions = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('828', $multi_lang);
$welcome = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('829', $multi_lang);
$asyou = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('830', $multi_lang);
$youraff = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('831', $multi_lang);
$adv = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('832', $multi_lang);
$clicks = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('833', $multi_lang);
$yourright = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('834', $multi_lang);
$youpaid = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('56', $multi_lang);
$nm = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('423', $multi_lang);
$Sessions = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('835', $multi_lang);
$tarning = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('836', $multi_lang);
$stutorearning = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('837', $multi_lang);
$sstudenteraning = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('902', $multi_lang);
$statement = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('913', $multi_lang);
$deleteTutor = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('919', $multi_lang);
$rusure = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('920', $multi_lang);
$delsucc = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('924', $multi_lang);
$transactions= $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('200', $multi_lang);
$plession= $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('951', $multi_lang);
$oneusd= $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1085', $multi_lang);
$Activity= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1086', $multi_lang);
$MonthStatement= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1087', $multi_lang);
$stuName = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1088', $multi_lang);
$PurDate = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1089', $multi_lang);
$AffiCommi = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1090', $multi_lang);
$CommisonDue = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1091', $multi_lang);
$TotalCOMMI = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1020', $multi_lang);
$ValidEmail = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1021', $multi_lang);
$EnetrPayment = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1152', $multi_lang);
$AffiLearning = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1153', $multi_lang);
$ShareYour = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1154', $multi_lang);
$StepSix = $arrVal[$multi_lang];


$arrVal = $this->lookup_model->getValue('1159', $multi_lang);
$Earnings = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1160', $multi_lang);
$EnterYourPaypal = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1161', $multi_lang);
$PaymentOccur = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('1151', $multi_lang);
$Stepfive = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('755', $multi_lang);
$Credits = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1150', $multi_lang);
$PayCredits = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1151', $multi_lang);
$StepFive = $arrVal[$multi_lang];


/*add haren*/
$arrVal 	= $this->lookup_model->getValue('1171', $multi_lang);
$ThanksForFrees = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('483', $multi_lang);
$Yess = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1172', $multi_lang);
$MayBeLater = $arrVal[$multi_lang];


/* 12/2/15-*/

$arrVal 	= $this->lookup_model->getValue('552', $multi_lang);
$trs = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1184', $multi_lang);
$ttlsession = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1185', $multi_lang);
$mututorearning = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1186', $multi_lang);
$mystuearning = $arrVal[$multi_lang];


$arrVal 	= $this->lookup_model->getValue('551', $multi_lang);
$stus = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('472', $multi_lang);
$fnames = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('533', $multi_lang);
$lnames = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('533', $multi_lang);
$sttearnings = $arrVal[$multi_lang];

/* Milestone 2 */

$arrVal 	= $this->lookup_model->getValue('1213', $multi_lang);	$Thkforgroup  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('483', $multi_lang);	$Yess  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('484', $multi_lang);	$Noo  	= $arrVal[$multi_lang];

/* end milestone2 */
$arrVal 	= $this->lookup_model->getValue('1299', $multi_lang); $rcvpaymentpopuptext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1300', $multi_lang); $lngEntPaypalAct = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1301', $multi_lang); $lngEntCashAmt = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1302', $multi_lang); $lngPhEmail = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1303', $multi_lang); $lngPhCash = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1304', $multi_lang); $lngVldAmt = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('482', $multi_lang); $lngOk = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('96', $multi_lang);$lcurrentbalance = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1272', $multi_lang);$lngCashout = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1273', $multi_lang);$lngAlertStatus = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('101', $multi_lang);$lngAmount = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1274', $multi_lang);$lngAmtWrng = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1275', $multi_lang);$lngAlertfailed = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1308', $multi_lang);$lngAlertTrans = $arrVal[$multi_lang];
?>
<?php $this->layout->appendFile('javascript',"js/jquery.mtz.monthpicker.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/search.css");?>
<?php //$this->layout->appendFile('css',"css/admin.css");?>
<style type="text/css">
.error{border:1px solid #FF0000 !important;}
.ui-dialog{top:20% !important; right:16% !important; left:auto !important;}
.transMsg {font-size: 15px;line-height:18px;}
.pro-settg .tab-cnt .sub-cnt .cnt-rw {float:left; clear:both; width:100%; margin:0 0 10px 0; padding:0 0 13px 0; border-bottom:none !important;}
.pro-settg .tab-cnt .sub-cnt .cnt-rw input[type="text"]{ float:left; background:none; border: 1px solid #F0F1F2;font-size:18px; border-radius: 5px!important; width:430px !important; height:30px;}
.ui-button {background: url("<?php echo base_url();?>/images/test-vs-btn.png") no-repeat scroll 0 0 !important;border:none;cursor: pointer;font-size: 15px;outline:  none;text-align: center;text-decoration: none;width: 107px ; color: #FFFFFF !important; height:34px; line-height:32px; margin-top:4px !important; box-shadow:none !important;}
#join-vee-session{ margin-top:7px !important;}

</style>
<?php
if($this->session->userdata('payment')): 
$payMsg = '';
$roleId = $this->session->userdata('roleId');
if($roleId == 0)
{
	$payMsg = 'Thank you for purchasing credits to your account. Your current balance has been refreshed.';
}else{
	$payMsg = 'Thank you for your purchase of your premium tutor membership. You can find yourself in the Featured Tutor Listings and start posting and selling video lessons today!';
}
?>

<!-- Naver conversion code -->
<script type="text/javascript" src="http://wcs.naver.net/wcslog.js"> </script> 
 <script type="text/javascript">
var _nasa={};
 _nasa["cnv"] = wcs.cnv("1","10"); // ????, ???? ?????. ????? ??
</script>
<script>alert('<?php echo $payMsg; ?>');</script>
<?php $this->session->unset_userdata('payment');
endif; 
?>
<?php
//echo $paymentsuccess;
if(@$paymentsuccess == '1'){

if($roleId == 0)
{
	$beanpayMsg = 'Thank you for purchasing credits. See your new balance on this Payment Options page.';
}else{
	$beanpayMsg = 'Transaction successful. You are a Gold Tutor!';
}
?>
<script>alert('<?php echo $beanpayMsg; ?>');</script>
<?php
}
?>
<!-- End Naver conversion code -->
<?php 
// checks for quarantine users
if($profile['quarantine'] == 1){?>
<script>alert("Your account has been made invisible to the membership. Either you have an incomplete profile (photo, video greeting, bio, rate, and open calendar sessions) or you have inappropriate content. Please edit so we can maintain a complete and professional profile for all visible tutors. Once updated, your profile may automatically become visible or else send an email to support@thetalklist.com.");</script>
<style>
.mod 
{
	display:none;
}
</style>
<?php } ?>
<script type="text/javascript">

function checkPaypal()
{
	/*var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var paymail=$('#payment_account').val();
	if( $('#payment_account').val() == '')
	{
		alert('Enter payment account to continue.');
		return false;
	}
	else if(! re.test(paymail))
	{
		alert('Enter valid paypal email');
		return false;
	}
	else
	{*/
		window.location.href="<?php echo base_url('user/profile');?>";
	//}
}


function CheckAccount()
{
	/*var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var paymail=$('#payment_account').val();
	if( $('#payment_account').val() == '')
	{
		alert('Enter payment account to continue.');
		return false;
	}
	else if(! re.test(paymail))
	{
		alert('Enter valid paypal email');
		return false;
	}
	else
	{*/
		window.location.href="<?php echo base_url('user/changeInfo?step=6');?>";
		window.location.href="<?php echo base_url('user/dashboard?step=final');?>";
	//}
}



window.onload = function() { 
$('#extraCredit').val("0");
			var x='<?php echo $this->session->userdata('firstTimeRegister'); ?>'; 
			 var a="<?php echo $_GET["step"];?>";
			 var rollId='<?php echo $this->session->userdata('roleId'); ?>'; 
			 if(a==5 && a!='' && rollId==0 && x !='')
			 {
			 
				$('#firstTour').dialog({
					modal:true,
					width:'300px',
					resizable:false
				});
				$('.ui-dialog').wrap('<div class="main_student-popupdiv5"></div>' );
				$('.hight-student').addClass('highlight5');	
				//$('.email-rw12').addClass('highlight5-a');
				$("html,body").scrollTop(600);
				 $("body").scrollTop(600);
				 return false;
			 }
			 
			if(a ==4 && rollId >=1 && rollId <=3 && x !='')
			 {
				window.scrollTo(200,250);
				$('#SecondTour').dialog({
					modal:true,
					width:'750px',
					resizable:false
				});
				$('.hightlight-emailtemp').addClass('highlight5');	
				$('.ui-dialog').wrap('<div class="main_popupdiv4 new4popu"></div>' );
			}
		var newstu='<?php echo $this->session->userdata('isFree'); ?>'; 
		var RoleId='<?php echo $this->session->userdata('roleId'); ?>'; 
		
		 
			if(newstu=='yes' && RoleId==0)
			{
				
				<?php echo $this->session->set_userdata('isFree','no');?>
				 $('#purchaseDialog').dialog({
					modal:true,
					width:'450px',
					resizable:false,
				}); 
			}

			var isFirst="<?php echo $_GET['first'];?>";
			var IsComplte_groupSession='<?php echo $this->session->userdata('isGroup'); ?>'; 
			if(isFirst == 'yes' && RoleId==0 && IsComplte_groupSession=='yes')
			{ 
				<?php echo $this->session->set_userdata('isGroup','no');?>
				 $('#GroupSessionDialog').dialog({
						modal:true,
						width:'450px',
						resizable:false,
					}); 
			}
};
function closeMe(){

$('#purchaseDialog').dialog('close');
window.location.href="<?php echo base_url('user/dashboard');?>";
}
function stayon()
{
$('#purchaseDialog').dialog('close');
}
function CloseCheck()
{
	window.location.href="<?php echo base_url('support/tutor_training');?>";
}

</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/popup-css.css">
<div class="baseBox baseBoxBg clearfix">
    	<?php
if($profile['roleId'] < 4){?>
    <div class="content_main fr">
    	<div class="main_inner">
			<?php //echo profile_menu($linkType,'account',$profile['uid']); ?>
            <!--/student_prof-->
            <div id="student_prof_Wp">
            	<div class="mod">
                    <?php if(($profile['roleId'] == 1 || $profile['roleId'] == 2 || $profile['roleId'] == 3)){?>
                    <!--<div class="hd">
                        <div class="pro_tle tle"><h3>Cumulative Earnings: (<?php echo $profile['money'];?> credits)  </h3></div>
						<span style="padding-left: 140px">Get paid via Paypal</span><br />
						Paypal Email:<input class="raduisSelect" type="text" id="payment_account" name="payment_account" value="<?php echo @$profile['payment_account']?>" />
						<a href="javascript:void(0)" class="norBtn blackRadiusBtn w96" id="savepayment">Save</a>
						</div>-->
                    <?php } /*elseif($profile['roleId']==0){*/?>
                    
                    <div class="content tle" style="padding-top:0px;">
						<h2>
							<?php echo $lcurrentbalance;?>: (<?php if($profile['money'] < 0){ echo "0.00";}else{ echo $profile['money'] = $profile['money'];/* + $profile['earned_credits'] + $profile['coupon_credits']; */}?> <?php //echo $credittext; ?>)<span style="font-size:18px;margin-left:304px;"><?php echo $oneusd; ?></span>
							<?php /*<span class="btncashout">
								<?php
								$arrVal = $this->lookup_model->getValue('1272', $multi_lang);
								$lngCashout = $arrVal[$multi_lang];?>
								<input class="ftinputcls" type="button" id='cashout' value="<?php echo $lngCashout;?>" <?php if($profile['money'] <= 0){ echo "disabled";} ?> />
							</span>*/?>
							<?php
							if(($this->session->userdata('successpayment')) and ($this->session->userdata('successpayment')=="1")){
								$this->session->unset_userdata('successpayment');
							$arrVal = $this->lookup_model->getValue('1305', $multi_lang); $lngTransComplete = $arrVal[$multi_lang];
							?>
							<div class="transMsg" style="display:none;">
							<?php 
							echo $lngTransComplete;
							?></div>
							<?php }?>
						</h2> 

								 <?php 
								 $arrVal=$this->lookup_model->getValue('1252', $multi_lang); $lblPur=$arrVal[$multi_lang];
								 $arrVal=$this->lookup_model->getValue('1253', $multi_lang); $lblSubPur=$arrVal[$multi_lang];
								 ?>
								 <p style="font-size:20px;color:#555;font-weight:400;" align="center"><?php echo "<b>".$lblPur." <br> ".$lblSubPur."</b>";?></p>
								<p style="font-size:14px;" align="center"><?php echo $loadaccount;?></p>
					</div>
					<?php /*} else{?>
					<div class="content tle"><h2><?php echo $tutors;?></h2></div>
					<?php }*/?>
                </div><?php if(!empty($msg)) echo $msg;?>
				<?php if($profile['roleId'] != 0){ ?>
                <div class="mod hightlight-emailtemp">
					<div class="hd">
						<!--<div class="content tle"><h2><?php echo $lpaymentoption;?><span class="receivepayment" style="float:right; margin:0px 25px 0 0;"><img src="<?php echo base_url('images/arrow.png');?>" alt="ed"></span></h2></div>-->
						<div class="content tle"><h2><?php echo $lpaymentoption;?><span class="receivepayment" style="float:right; margin:0px 25px 0 0;"><a href='#'>Rules</a></span></h2></div>
					</div>
					<div class="bd">
						<!--<table style="width: 100%" class="cart_table">
							<tr>
								<td><a class="purchasebypaypal" href="javascript:void(0);"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" align="left" style="margin-left:30px;"></a> </td>
								<td>Pay for one time or recurring payments with your PayPal account.</td>
							</tr>
							<tr>
								<td><table border="0" cellpadding="10" cellspacing="0" align="left">
										<tr><td align="left"></td></tr>
										<tr><td align="left"><a class="purchasebypaypal" href="javascript:void(0);" ><img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg"  height="69" width="200" border="0" alt="PayPal Acceptance Mark"></a></td></tr></table></td>
								<td>PayPal also accepts major credit cards.</td>
							</tr>
						</table>-->
						<?php 
						if($this->session->userdata('alertstatus')):?>
						<div class="transMsg" style="display:none;">
							<?php
							echo ($this->session->userdata('alertstatus')==2) ? $lngAlertStatus : $lngAlertfailed;
							$this->session->unset_userdata('alertstatus');
							?>
						</div>
						<?php endif;?>
						<form action="<?php echo base_url("user/cashout");?>" method="post" name="frmCashout" id="frmCashout">
                        <div class="email-rw12">
							<table width="100%" border="1" cellspacing="0" cellpadding="0" class="for-desktop">
                            	<tr>
                                	<td>
                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tbody>
                                            <tr>
                                              <td align="center" style="font-size: 18px;padding:10px;color: black;font-weight:bold;"><?php echo $lngEntPaypalAct;?></td>
                                            </tr>
                                            <tr>
                                              <td align="center" style="font-size: 18px;padding:10px;color: black;">
										<input class="raduisSelect" type="text" id="payment_account" name="payment_account" value="<?php echo @$profile['payment_account']?>" placeholder="<?php echo $lngPhEmail;?>" />
									</td>
                                            </tr>
                                          </tbody>
                                        </table>
                                    </td>
                                    <td>
                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tbody>
                                            <tr>
                                              <td align="center" style="font-size: 18px;padding:10px;color: black;font-weight:bold;"><?php echo $lngEntCashAmt;?></td>
                                            </tr>
                                            <tr>
                                              <td align="center" style="font-size: 18px;padding:10px;color: black;">
										<input class="raduisSelect numbersonly" autocomplete="off" type="text" id="trnAmount" name="trnAmount" value="" style="" placeholder="<?php echo $lngPhCash;?>" />
											  </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                    </td>
                                </tr>
								<tr>
									<td align="right" colspan="2" style="font-size: 18px;padding:10px;color: black;">
										<input type="hidden" name="ref1" value="<?php echo $this->user['uid'];?>" />
										<?php
										$availableprofilemoney = $profile['money'] - $profile['purchased_credits'];
										//$availableprofilemoney = $profile['earned_credits'] + $profile['affiliate_credits'];
										$availablePurchasedCredits = ($profile['purchased_credits'] * 85)/100;
										$totalCredits = $availablePurchasedCredits + $availableprofilemoney;										
										?>
										<input type="hidden" name="balance" id ="balance" value="<?php echo $totalCredits;?>" />
										<input class="aqua_btn" type="button" id='submitButton' value="<?php echo $lngCashout;?>" />
									</td>
								</tr>
							</table>
						</div>
						</form>
					</div>
				</div>
				<?php } ?>
				
				<!--added by haren -->
				
				<div id="purchaseDialog" title="" style="display:None;">
			<div class="ratelist">
				<span class="" style="float:left; font-size: 131.5%;"><?php echo $ThanksForFrees;?></span>  <br><br>
			</div>
			<p>&nbsp;&nbsp;</p> 
			<p><input type="button" value="<?php echo $Yess;?>"  id="purchaseYes" class="blu-btn" onclick="stayon();"/>
			<input type="button" value="<?php echo $MayBeLater;?>" onclick="closeMe();" class="blu-btn"/>
			</p>
		</div>
                <div class="mod hight-student">
					<?php /*if($profile['roleId'] == 0){ */?>
                    <div class="content tle"><h2><?php /*if($roleId != 0){ echo $upgradeaccounttext; } else {*/ echo $lloadaccount; //} ?> <span class="payment" style="float:right; margin:0px 25px 0 0;"><img src="<?php echo base_url('images/arrow.png');?>" alt="ed"></span> </h2></div>
                    <?php //} ?>
					<!-- Paymentwall Start-->
					<div class="bd">
					<?php 
					/*Test */
					if (isset($purCrTransLimit)) { 
						echo '<div align="center" style="font-size:18px;"><strong>'.$lngAlertTrans.'</strong></div>';
					} else {
						require_once(APPPATH.'paymentwall-php/lib/paymentwall.php');
						Paymentwall_Config::getInstance()->set(array(
							'api_type' => Paymentwall_Config::API_VC,
							'public_key' => '85bbb2db528ac112efbc48fca34ba12a',
							'private_key' => '4b3f92b55ea670d915f29b3785caa970'
						));
						$widget = new Paymentwall_Widget(
							$this->session->userdata['uid'], // id of the end-user who's making the payment
							($deviceType=="phone") ? 'm2_1' : 'p10_1', // widget code, e.g. p1; can be picked inside of your merchant account
							array(), // array of products - leave blank for Virtual Currency API
							array(
								"email" 				=> 	$this->session->userdata['email'],
								"customer[sex]"			=> 	$profile['gender'],
								"customer[username]"	=> 	$this->session->userdata['email'],
								"customer[firstname]"	=>	$profile['firstName'],
								"customer[lastname]"	=>	$profile['lastName'],
								"customer[city]"		=>	$profile['city'],
								"customer[state]"		=>	@$province[@$profile['province']],
								"customer[country]"		=>	@$countries[@$profile['country']],
								"success_url"			=>	base_url("user/successpayment")
							) // additional parameters
						);
						echo $widget->getHtmlCode(array('width' => '750px','height' => '500px'));
					}
					?>
					</div>
					<!--Paymentwall End-->
                    <div class="bd" style="display:none;">
                      <!--<div class="createSchedule">
                            <form action="<?php echo base_url('pay/index');?>" method="post" name="payform" target="_blank">
                                <table class="cart_table" width="100%">
									<tr>
                                    	<td>
                                            <?php if(($profile['roleId'] == 1 || $profile['roleId'] == 2) ) :?>
                                            Premium Membership:
                                            <?php else:?>
                                            Amount:
                                            <?php endif;?>
                                        </td>
                                        <td>
                                        	
                                            <select name="money"  class="raduisSelect">                                                
                                                <?php if(($profile['roleId'] == 1 || $profile['roleId'] == 2) ) :?>
                                                <option value="<?php echo $config['MON_PRICE']['value'];?>">$<?php echo $config['MON_PRICE']['value'];?> /Month</option>
                                                <?php else:?>
                                                <option value="100">$100</option>
                                                <option value="300">$300(1% free credit)?</option>
                                                <option value="500">$500(2% free credit)?</option>
												<option value="1000">$1000(3% free credit)?</option>
                                                <?php endif;?>
                                            </select>
                                            <input type="hidden" value="" name="payId" id="payId" class="raduisSelect" >
                                        </td>
                                    </tr>
                                </table>
                            </form>
                      </div>-->
					  <?php /*if($profile['roleId'] == 0){ */?>
						<form action="<?php echo base_url('pay/index');?>" method="post" name="payform" target="_blank">
						<input type="hidden" value="" name="payId" id="payId" class="raduisSelect" >
						<input type="hidden" value="" name="money" id="money" class="raduisSelect" >
						 <input type="hidden" value="0" name="extraCredit" id="extraCredit" class="raduisSelect" >		
						 <div class="load-acc">
							<ul>
								<li>
									
									<p class="credit"><span><?php echo $buyCredits['credit']['credit_4'];?></span><?php echo $credittext; ?></p>
									<p class="price"><?php echo "$".$buyCredits['price']['price_4'];?> <span>&nbsp;</span></p>
									<p class="by-btn"><a href="javascript:void(0);" onclick="sbtform('30');"><?php echo $lbuynow; ?></a></p>
								</li>
								<li>
									<p class="credit"><span><?php echo $buyCredits['credit']['credit_1'];?></span><?php echo $credittext; ?></p>
									<p class="price"><?php echo "$".$buyCredits['price']['price_1'];?> <span>&nbsp;</span></p>
									<p class="by-btn"><a href="javascript:void(0);" onclick="sbtform('100');" ><?php echo $lbuynow; ?></a></p>
								</li>
								<li>
									<p class="credit"><span><?php echo $buyCredits['credit']['credit_2'];?></span><?php echo $credittext; ?></p>
									<p class="price"><?php echo "$".$buyCredits['price']['price_2'];?> <span><?php echo $one_free;?></span></p>
									<p class="by-btn"><a href="javascript:void(0);" onclick="sbtform('300');"><?php echo $lbuynow; ?></a></p>
								</li>
								<li class="active">
									<h1>TheTalkList <?php echo $lrecommends; ?></h1>
									<p class="credit"><span><?php echo $buyCredits['credit']['credit_3'];?></span><?php echo $credittext; ?></p>
									<p class="price"><?php echo "$".$buyCredits['price']['price_3'];?> <span><?php echo $two_free;?></span></p>
									<p class="by-btn"><a href="javascript:void(0);" onclick="sbtform('500');"><?php echo $lbuynow; ?></a></p>
								</li>
								
							</ul>
                        </div> 
                        </form>
						<!--R&D@Oct-28-2013 : Alipay Payment Student-->
						<form action="<?php echo base_url('alipay/index');?>" method="post" class="pay-mthd" name="alipayform" target="_blank">
						<input type="hidden" value="" name="alipayId" id="alipayId" class="raduisSelect" >
						<input type="hidden" value="" name="aliPaymoney" id="aliPaymoney" class="raduisSelect" >
						<input type="hidden" name="aliType"  class="raduisSelect" value="CREDITS">
						</form>
						<!--R&D@Oct-28-2013 : Alipay Payment Student-->
                       <?php //} ?>
                    </div>
                </div>  
				
				<?php if($profile['roleId'] == 0){ ?>
                <div class="mod hightlight-emailtemp">
					<div class="hd">
						<div class="content tle"><h2><?php echo $lpaymentoption;?><span class="receivepayment" style="float:right; margin:0px 25px 0 0;"><a href='#'>Rules</a></span></h2></div>
					</div>
					<div class="bd">
						<!--<table style="width: 100%" class="cart_table">
							<tr>
								<td><a class="purchasebypaypal" href="javascript:void(0);"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" align="left" style="margin-left:30px;"></a> </td>
								<td>Pay for one time or recurring payments with your PayPal account.</td>
							</tr>
							<tr>
								<td><table border="0" cellpadding="10" cellspacing="0" align="left">
										<tr><td align="left"></td></tr>
										<tr><td align="left"><a class="purchasebypaypal" href="javascript:void(0);" ><img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg"  height="69" width="200" border="0" alt="PayPal Acceptance Mark"></a></td></tr></table></td>
								<td>PayPal also accepts major credit cards.</td>
							</tr>
						</table>-->
						<?php 
						if($this->session->userdata('alertstatus')):?>
						<div class="transMsg" style="display:none;">
							<?php
							echo ($this->session->userdata('alertstatus')==2) ? $lngAlertStatus : $lngAlertfailed;
							$this->session->unset_userdata('alertstatus');
							?>
						</div>
						<?php endif;?>
						<form action="<?php echo base_url("user/cashout");?>" method="post" name="frmCashout" id="frmCashout">
                        <div class="email-rw12">
							<table width="100%" border="1" cellspacing="0" cellpadding="0" class="for-desktop">
                            	<tr>
                                	<td>
                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tbody>
                                            <tr>
                                              <td align="center" style="font-size: 18px;padding:10px;color: black;font-weight:bold;"><?php echo $lngEntPaypalAct;?></td>
                                            </tr>
                                            <tr>
                                              <td align="center" style="font-size: 18px;padding:10px;color: black;">
										<input class="raduisSelect" type="text" id="payment_account" name="payment_account" value="<?php echo @$profile['payment_account']?>" placeholder="<?php echo $lngPhEmail;?>" />
									</td>
                                            </tr>
                                          </tbody>
                                        </table>
                                    </td>
                                    <td>
                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tbody>
                                            <tr>
                                              <td align="center" style="font-size: 18px;padding:10px;color: black;font-weight:bold;"><?php echo $lngEntCashAmt;?></td>
                                            </tr>
                                            <tr>
                                              <td align="center" style="font-size: 18px;padding:10px;color: black;">
										<input class="raduisSelect numbersonly" autocomplete="off" type="text" id="trnAmount" name="trnAmount" value="" style="" placeholder="<?php echo $lngPhCash;?>" />
											  </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                    </td>
                                </tr>
								<tr>
									<td align="right" colspan="2" style="font-size: 18px;padding:10px;color: black;">
										<input type="hidden" name="ref1" value="<?php echo $this->user['uid'];?>" />
										<input type="hidden" name="balance" id ="balance" value="<?php echo $profile['money']?>" />
										<input class="aqua_btn" type="button" id='submitButton' value="<?php echo $lngCashout;?>" />
									</td>
								</tr>
							</table>
						</div>
						</form>
					</div>
				</div>
				<?php } ?>
        </div>
    </div>
	<?php }
	elseif($profile['roleId'] ==5)
	{?>
	<div class="content_main fr">
    	<div class="main_inner">
		<?php
			echo Affiliate_menu($linkType,'account');
		?>
        <div id="student_prof_Wp">
            <div class="mod">
				<div class="content tle" style="margin-bottom:8px;"><h2><?php echo $Activity;?></h2></div>
				<div class="bd">
					<?php if(count($affiliate) > 0){ ?>
				<div style="float:right;margin-top:-22px;">
					<span style="font-size:18px;"><?php echo $MonthStatement;?>&nbsp;&nbsp;</span>
					<input type="text" name="stre" id="events_widget"  class="adm_box1"/>
					<a target="_blank" onclick="sturecord()";><img src="<?php echo base_url('images/pdf.png'); ?>" width="20px;"></a>
					</div>
					<div class="search_rt_mid_t_rt">
						<div class="v_ajax_page"><?php echo $pagination;?></div>
					</div>
					<table class="history_table f14" id="ttest">
						<thead>
							<tr>
								<th> <?php echo $stuName;?></th>
								<th><?php echo $PurDate;?></th>
								<th><?php echo $AffiCommi;?></th>
								<th><?php echo $CommisonDue;?></th>
							</tr>
						</thead>
						<tbody id="nbmesg">
					   
						<?php $sid=$this->session->userdata['uid'];?>
						<?php for($i=0;$i<count($affiliate);$i++){?>
						<tr>
							<td><?php echo $affiliate[$i]['firstName']."&nbsp;". '  '.$affiliate[$i]['lastName'];?></td>
							<td><?php echo date('Y-m-d',strtotime($affiliate[$i]['createAt']));?></td>
							<td>$<?php echo  number_format($affiliate[$i]['purchaseamount'],2,'.','')?></td>
							<td>$<?php echo $affiliate[$i]['amount'];?></td>
					   </tr>
					   <?php $cmn = $cmn+$affiliate[$i]['amount'];}?>
					   </tbody>
					</table>
					 <span class="due" style="float:left;font-size:2.2em;font-weight:300;"><?php echo $CommisonDue;?> $<?php if($affiliate[0]['paid']==1) echo "0.00";else echo number_format($cmn,2,'.','');?></span>
					 <span class="due" style="float:right;font-size:2.2em;font-weight:300;margin-top:-4px;"><?PHP echo $TotalCOMMI;?> $<?php echo number_format($cmn,2,'.','');?></span>
				<?php }else {?>
				<br><br><br><br><p  align="center"  style="font-size:14px;">
				<?php echo $welcome;?></p>
				<p style="font-size:14px;"><?php echo $asyou;?></p>
                  <p style="font-size:14px;"><?php echo $youraff;?></p>
				   <p style="font-size:14px;"><?php echo $adv;?></p>
					<p style="font-size:14px;"><?php echo $clicks; ?>
					</p><p style="font-size:14px;"><?php echo $yourright;?></p>
					<p style="font-size:14px;"><?php echo $youpaid; ?>
				</p>
				<?php } ?>
				</div>
			</div>
			<!--raxa 03-08-13 end-->              
        </div>
    </div>
	<?php }else {?>
	<div class="content_main fr" style="float:left; width:100%;">
    	<div class="main_inner">
		          <?php //echo organization_menu($linkType,'account');?>
                  <div id="student_prof_Wp">
				 
					 <?php 
					$schoolStuearning= $StuEarnings['spayment'];
					 ?>	
				   <?php if(count($schoolEarings) > 0){ 
				   $TotalSession=  $schoolEarings[0]['total'];
				   $TutotrEarning=number_format(($schoolEarings[0]['tutorEarning']),2,'.','');
				 
				    } else {
					$TotalSession='0';
					$TutotrEarning='0.00';
					 
					 }?>
				  
            	<div class="mod" id="test">
                    <div class="content tle" style="">
					<h2 style="padding-bottom:15px; font-size:32px;"><?php echo $trs;?></h2>
					<h2 style="padding-top:5px;">
					<span style="margin-right:14px;font-size:16px;font-weight: bold;"><?php echo $ttlsession;?>&nbsp;: &nbsp;<span style="color:black;"> <?php echo  $TotalSession; ?></span> </span>
					<span style="margin-right:14px;font-size:16px;font-weight: bold;"> <?php echo $mututorearning;?>&nbsp;: &nbsp;&nbsp;<span style="color:black;"><?php echo "$". $TutotrEarning; ?></span></span>
					<span style="font-size:16px;font-weight: bold;"><?php echo $mystuearning;?>:&nbsp:&nbsp;&nbsp;<span style="color:black;"><?php echo "$". $schoolStuearning;?></span></span>
					<!--<span style="float:right;margin-top:5px;">Private Use Balance(<?php echo $pbal[0]['pbalance'];?>)</h2></span>-->
					</h2> </div>
					<a style="float:left;" class="adbtn" href="<?php echo base_url('user/tsearch') ?>"><?php echo $addnew;?></a>
					 <?php //if(count($tutor) > 0){ ?>
					  
				<!--	 <table class="history_table f14" style="margin:0px;" id="ttest">
								<thead>
									<tr><th><?php echo $nm;?></th><th> </th></tr>
								</thead>
					       <tbody id="nbmesg">
						   
						   <?php for($i=0;$i<count($tutor);$i++){?>
						   
						   <?php $sid=$this->session->userdata['uid'];?>
						   <tr>
						   <td><a href="<?php echo base_url('user/history/uid/'.$tutor[$i]['uid']); ?>"> <?php echo $tutor[$i]['firstName']."&nbsp;". '  '.$tutor[$i]['lastName'];?></a></td>
						  
							<?php if($tutor[$i]['firstName'] !=''){?>
							<td style="text-align:right;"><a class="dicon" href="#" style="cursor:pointer;" onclick="deltutor(<?php echo $tutor[$i]['uid'] ?>,<?php echo $sid;?>);"><img src="<?php echo base_url('images/cbtn.jpg')?>"></a></td>
						   <?php }?>	
						   </tr>
						   <?php }?>
						   </tbody>
						   </table>
						   <br>
						   
					<?php //}else {?>
					<br><br><br><br><p  align="center"  style="font-size:14px;color:red;"><?php echo $youhaveno;?></p> -->
					<?php //} ?>    
				</div>
				 <!--raxa 03-08-13 start-->
         <!--    <div class="mod">
					<div class="content tle"><h2><?php echo $transactions;?></h2></div>
                    <div class="bd">
                    <?php if(count($students) > 0 || $filterType=='month'){ ?>
					 <div class="history_tle f18 agnC">
                               <a href="?type=month" <?php if($filterType=='month'):?>class="history"<?php endif;?> ><?php echo $lmonthly;?></a> / 
                               <a href="?type=year" <?php if($filterType=='year'):?>class="history"<?php endif;?> ><?php echo $lannually;?></a> / 
                               <a href="?type=all" <?php if($filterType=='all'):?>class="history"<?php endif;?> ><?php echo $ltotal;?></a>
							    <a class="pdf" target="_blank" onclick="generate();"><img src="<?php echo base_url('images/pdf.png'); ?>" width="20px;"></a>
							   </div>
					 <table class="history_table f14" id="ttest">
								<thead>
									<tr><th><?php echo $students1;?></th><th><?php echo $tutors;?></th><th><?php echo $tsessions; ?></th></tr>
								</thead>
					       <tbody id="nbmesg">
						   
						   <?php for($i=0;$i<count($students);$i++){?>
						   <tr>
						   <td><?php echo $students[$i]['sFN']."&nbsp;". '  '.$students[$i]['sLN'];?></td>
						   <td><?php echo $students[$i]['tFN']."&nbsp;". '  '.$students[$i]['tLN'];?></td>
						   <td><?php echo "1";?></td>
						  </tr>
						   <?php }?>
						   </tbody>
						   </table>
					<?php }else {?>
					<br><br><br><br><p  align="center"  style="font-size:14px;color:red;">You have no student added to your school.</p>
					<?php } ?>
					</div>
				</div>  -->
				
		<!--		<div class="mod">
					<div class="content tle"><h2><?php echo $stus;?></h2></div>
                    <div class="bd">
                  
					 <table class="history_table f14" id="ttest">
								<thead>
									<tr><th><?php echo $fnames;?></th><th><?php echo $lnames;?></th><th><?php echo $sttearnings; ?></th></tr>
								</thead>
					       <tbody id="nbmesg">
						   
						   <?php for($i=0;$i<count($StudIncome);$i++){?>
						   <tr>
						   <td><?php echo $StudIncome[$i]['fname']."&nbsp;";?></td>
						   <td><?php echo $StudIncome[$i]['lname'];?></td>
						   <td><?php echo $StudIncome[$i]['income'];?></td>
						  </tr>
						   <?php }?>
						   </tbody>
						   </table>
					
					</div>
				</div>  -->
<!--raxa 03-08-13 end-->              
        </div>
    </div>
	<?php } ?>
    </div>
    <!--/content_main-->
	<?php// include dirname(__FILE__).'/leftSide.php';?>
	<form action="<?php echo base_url('user/paymentForm');?>" method="post" class="pay-mthd" name="bspayform" target="_blank">
						<input type="hidden" value="" name="bs_money" id="bs_money" class="raduisSelect" >
						<input type="hidden" value="" name="bs_month" id="bs_month" class="raduisSelect" >
						<input type="hidden" value="" name="bs_credit" id="bs_credit" class="raduisSelect" >		
						
						</form>
					
                    	
		<div id="firstTour" title="" style="display:None;">
			<div class="popup-step student-step5">
            	<div class="step-div-bg">
                	<span class="popup-no">4</span>
                    <div class="ratelist popup-row">
                        <span class="title" style="float:left"><?php echo $Credits;?></span>  
                    </div>
                    <div class="ratelist popup-row">
                    	
                        <p><span class="title" style="float:left;line-height:15px;"><?php echo $PayCredits;?></span>  </p>
                        <p class="clearer"></p>
                    </div>
                	<div class="pop-pagin">
                    	<ul>
                        	<li><span><a href="<?php echo base_url('search/search?step=1');?>">1</a></span></li>
                            <!--<li><span><a href="<?php echo base_url('user/profile/uid/12512?step=2');?>">2</a></span></li>-->
                            <li><span><a href="<?php echo base_url('user/profile/uid/12512?step=3');?>">3</a></span></li>
                            <li><span><a href="<?php echo base_url('testveesession/testVeeSession?step=4');?>">4</a></span></li>
                            <li class="active"><span><a href="">5</a></span></li>
                           <!-- <li><span><a href="<?php echo base_url('user/changeInfo?step=6');?>">6</a></span></li>-->
                        </ul>
                    </div>
            		<a  onclick="CheckAccount();"> <?php //echo $StepSix;?>Next</a>
                </div>
            </div>
		</div>	

<div id="SecondTour" title="" style="display:None;">
			
            
            <div class="hight-cnt4">&nbsp;</div>
			<!--<div class="ratelist popup-row">
				<span class="title" style="float:left"><?php echo $Earnings;?></span>  
			</div>-->
			
            <div class="popup-step tutoe-step4">
            <span class="popup-no">4</span>
            	<div class="step-div-bg">
                	<div class="ratelist popup-row">
                    	<h2 class="poupttl martoppl">Get paid</h2>
                        <p><span class="title" style="float:left"><?php echo $EnterYourPaypal;?><br><br> <?php echo $PaymentOccur;?></span>  </p>
                        <p class="clearer"></p>
					</div>
                	<div class="pop-pagin">
                    	<ul>
                        	<li><span><a href="<?php echo base_url('user/profile?step=1');?>">1</a></span></li>
                        	<li><span><a href="<?php echo base_url('user/calendar/uid/'.$this->session->userdata('uid').'?step=2');?>">2</a></span></li>
                            <li><span><a href="<?php echo base_url('testveesession/testVeeSession?step=3');?>">3</a></span></li>
                            <li class="active"><span><a href="<?php echo base_url('user/account?step=4');?>">4</a></span></li>
                            <!--<li><span><a href="<?php echo base_url('user/changeInfo?step=5');?>">5</a></span></li>-->
                        </ul>
                    </div>
            		<a onclick="checkPaypal();"><?php //echo $Stepfive;?>Next</a>
                </div>
            </div>
		</div>		
		
		
		<div id="typeupdate" title="" style="display:None;border:2px solid #8EC7E3 !important;">
			<div class="ratelist">
				<span class="" style="float:left; font-size: 131.5%;line-height: 21px;"><?php echo "Before attaining Gold status, you must first pass the Silver Tutor certification.";?></span>  <br><br>
			</div>
			<p>&nbsp;&nbsp;</p> 
			<p><input type="button" value="<?php echo "Ok";?>"  id="silverf" class="blu-btn" onclick="CloseCheck();"/>
			</p>
		</div>	

		<div id="GroupSessionDialog" title="" style="display:None;background-color:white !important">
			<div class="ratelist">
				<span class="" style="float:left; font-size: 137.5%;line-height:22px;"><?php echo $Thkforgroup;?></span>  <br><br>
			</div>
			<p>&nbsp;&nbsp;</p> 
			<p><input type="button" value="<?php echo $Yess;?>"  id="groupSe" class="blu-btn" onclick="CloseIt();"/>
			<input type="button" value="<?php echo $Noo;?>" onclick="closeMe();" class="blu-btn"/>
			</p>
		</div>
		
	<script>
	function CloseIt(){
		$('#extraCredit').val("10");
		$('#GroupSessionDialog').dialog('close');
	}
	</script>
	
</div>
<script type="text/javascript">
      if (RegExp('multipage', 'gi').test(window.location.search)) {
        introJs().start();
      }
    </script>
<script>
function paymentForm()
{
	window.location.replace("<?php echo base_url('user/paymentForm')?>");
}
function sturecord()
{
var a=document.getElementById('events_widget').value;
var url="<?php echo base_url('user/genpdf')?>"+"/"+a;
window.open(
  url,
  '_blank' 
);
}
function generate()
{
var url="<?php echo base_url('user/tutorpdf')?>";
window.open(
  url,
  '_blank' 
);
}
function deltutor(uid,sid)
{
var a= confirm("<?php echo $rusure;?>");
if(a)
{
   var cupdate = uid;
   cupdate ='uid='+cupdate;
				$.ajax({
					  type:'POST',
					  data:cupdate,
					  url:'<?php echo base_url('user/DeleteTutorAjax/');?>',
					  success:function(msg){
					  
					  if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
					  if(json.success){
alert('<?php echo $delsucc;?>');
 location.reload(); 
         }
					  else
					  {
					  alert('Problem with deleting tutor');
					  }
					  
					  } 
				});
}
}
window.delClickData = '';//save the param del data
function checkSubmit(){
    if($('#paypalType:checked').get(0)){
        return true;
    }
    var cardNumber = $('[name=cardNumber]').val();
    var zip = $('[name=zip]').val();
    var secNumber = $('[name=secNumber]').val();
    var date_year = $('[name=date_year]').val();
    var date_month = $('[name=date_month]').val();
    var date_day = $('[name=date_day]').val();
    var patrn=/^([0-9]{16})$/;
    if (!patrn.exec(cardNumber)){
        alert('The Card Number was incorrectly entered.');
        return false;
    }
    var patrn=/^([0-9]{3})$/;
    if (!patrn.exec(secNumber)){
        alert('The Security number was incorrectly entered.');
        return false;
    }
    var patrn=/^([0-9]{5,6})$/;
    if (!patrn.exec(zip)){
        alert('The Zip code was incorrectly entered.');
        return false;
    }
    if (isNaN(date_year) || date_year > 2050 || date_month >12 || date_month<1 || date_day >31 || date_day<1){
        alert('The Expiration Date  was incorrectly entered.');
        return false;
    }
    return true;
}
function editCard(id){
    document.location.href = '<?php echo base_url('user/account/');?>/id/'+id;
}
function delCard(id){
    if(window.confirm('Are you sure want to delete this?')){
        $.get('<?php echo base_url('user/delCard');?>/id/'+id,function(msg){
            if (String == msg.constructor) {      
                eval ('var json = ' + msg);
            } else {
                var json = msg;
            }
            if(json.success){
                $('#dialog').html('Delete Success..');
                $('#dialog').dialog({modal:true});
                $('.card_odd'+id).remove();
            }
            else{               
                $('#dialog').html(json.msg);
                $('#dialog').dialog({modal:true});
            }
        })
    }
}
$(function(){
	$('a@[href=#]').attr('href','javascript:void(0)');
	$('[name=cardType]').change(function(){
		var _value = $(this).val();
		if(_value == 0){
			$('.paypalInput').show();
			$('.cardInput').hide();
		}
		else{
			$('.paypalInput').hide();
			$('.cardInput').show();
		}
	})
    //$('[name=cardType]').trigger('change');
    $('#moneys').change(function(){
        $('[name=money]').val($(this).val());
    })
$('.purchasebypaypal').click(function(){

		$('#payId').val('paypal');
		document.payform.submit();
        
    })
    $("#savepayment").click(function(){
		var payment_account = $("#payment_account").val();
		
		var patrn = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/i;
		if(payment_account==''){
			alert('<?php echo $EnetrPayment; ?>');
			return false;
		}else if(!patrn.exec($.trim(payment_account))){
			alert('<?php echo $ValidEmail;?>');
			return false;
		}else{
			$.post('<?php echo base_url("user/editProfile");?>',{payment_account:payment_account},function(data){
				if(data=='Successfully saved'){
					alert('<?php echo $susscesssaved;?>');
				}else{
				
					alert(data);
				}
				return false;
			});
		}
	});
$('.del').click(function(){
		var _tr = $(this).parents('tr');
		var _delId = _tr.attr('inboxId');
		var _data = {id:_delId}; 
		window.delTrObj = _tr;
		$('#dialog1').dialog({
			modal:true,
			buttons: {
				"Delete the item": function() {
					delDo();
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		})
	})
})
function sbtform(money, month){
	var roleId="<?php echo $profile['roleId'];?>";
	if (roleId  ==1 ) {
		$('#typeupdate').dialog({modal:true});
		$('.mod').removeClass('hig-acc');
		$('.ui-widget-overlay').addClass('tyupdate');
		return false;
	} 
	if ($('#id_radio2').is(':checked')) { 
		$('#alipayId').val('alipay');
		$('#aliPaymoney').val(money);
		document.alipayform.submit();
	} else if ($('#id_radio3').is(':checked')) { 
		$('#bs_money').val(money);
		$('#bs_month').val(month);
		document.bspayform.submit();
	} else if ($('#bs_payment').is(':checked')) { 
		$('#bs_money').val(money);
		var credit = 100;
		if(money == 30) credit = 25;
		if(money == 300) credit = 310;
		if(money == 500) credit = 520;
		if(money == 1000) credit = 1030;
		$('#bs_credit').val(credit);
		document.bspayform.submit();
	} else {
		$('#payId').val('paypal');
		$('#money').val(money);
		$('#UpgradeMonthsTutor').val(month);		
		document.payform.submit();
	}
}
function delDo(){
			
	var _delId = window.delTrObj.attr('inboxId');
	var _data = {id:_delId}; 
	
	$.post('<?php echo base_url("user/del_message");?>',_data,function(msg){
		if (String == msg.constructor) {      
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
		if(json.status){
			$('#dialog').html('Del Success..');
			$('#dialog').dialog({modal:true});
			resizable:false;
			window.delTrObj.remove();
		}
		else{				
			$('#dialog').html(json.msg);
			$('#dialog').dialog({modal:true});
			resizable:false;
		}
	})		
}
$(document).ready(function () {
			//$("td.abc").addClass("clickdisplay");
			  $("span.receivepayment").hover(function () {			  
				$(this).append("<div class='tooltip-payment'><p><?php echo $rcvpaymentpopuptext;?><br>Redeeming paid credits is subject to 15% service fee.<br>Coupon or incentive credits are not cashable.</p></div></p></div>");
			  }, function () {
				$("div.tooltip-payment").remove();
			  });
			  
			  $("span.payment").hover(function () {
			  <?php if($roleId != 0){ ?>
				$(this).append("<div class='tooltip-payment'><p><?php echo $upgradepopuptext;?></p></div>");
			  <?php } else if($roleId == 0){ ?>
				$(this).append("<div class='tooltip-payment'><p><?php echo $upgradestudentpopuptext; ?></p></div>");
				<?php } ?>
			  }, function () {
				$("div.tooltip-payment").remove();
			  });
			  $("span.due").hover(function () {
			  
				$(this).append("<div class='tooltip-payment'><p><?php echo "Commissions paid to PayPal account on the first of each month";?></p></div>");
			  
			  }, function () {
				$("div.tooltip-payment").remove();
			  });
			  
			   $("a.dicon").hover(function () {
			 	$(this).append("<div class='tooltip-payment tooltip-payment2'><p><?php echo $deleteTutor; ?></p></div>");
				}, function () {
				$("div.tooltip-payment").remove();
			  });
			  
			  $("a.pdf").hover(function () {
			 	$(this).append("<div class='tooltip-payment'><p><?php echo $statement; ?></p></div>");
				}, function () {
				$("div.tooltip-payment").remove();
			  });
			  
			});
		function closehs()
		{
			$('#hihid').val('1');
		}
		$(document).ready(function () {
    $('#id_radio1').click(function () {
	
        $('#div4, #div5, #div6').hide('slow');
        $('#div1, #div2, #div3').show('slow');
		$('#dollar4, #dollar5, #dollar6').hide('slow');
		$('#dollar1, #dollar2, #dollar3').show('slow');
		$('.email-rw').show('slow');
		$('#paytext').show('slow');
		$('#alitext').hide('slow');
    });
	$('#id_radio3').click(function () {
        $('#div4, #div5, #div6').hide('slow');
        $('#div1, #div2, #div3').show('slow');
		$('#dollar4, #dollar5, #dollar6').hide('slow');
		$('#dollar1, #dollar2, #dollar3').show('slow');
		$('.email-rw').hide('slow');
    });
	$('#bs_payment').click(function () {
		$('#paytext').hide('slow');
		$('#alitext').hide('slow');
		$('.email-rw').hide('slow');
    });
    $('#id_radio2').click(function () {
        $('.email-rw').show('slow');
		$('#paytext').hide('slow');
		$('#alitext').show('slow');
    });
});


</script>
<style>
.tyupdate
{
	opacity:0 !important;
}
.ui-widget-content{/*border: 4px solid #0087d0;    border-radius: 0 !important;*/ background:#fff; padding:15px;}
.ui-widget-header{ background:none; border:0 none !important;}
.ui-widget-header{ float:right;}
.history
{
color:#03566D;
}
.hover{ display:block !important;}
span.payment,span.receivepayment {cursor: pointer;display: inline-block;width: 16px;height: 16px;line-height: 16px;color: White;font-size: 13px;font-weight: bold;border-radius: 8px;text-align: center;position: relative;}
span.payment img {vertical-align : middle;}

.hover{ display:block !important;}
span.due {cursor: pointer;display:inline-block;height: 16px;line-height: 16px;font-size: 13px;font-weight: bold;border-radius: 8px;text-align: center;position: relative;}
span.due img {vertical-align : middle;}

a.dicon {cursor: pointer;display: inline-block;width: 16px;height: 16px;line-height: 16px;color: White;font-size: 13px;font-weight: bold;border-radius: 8px;text-align: center;position: relative;}
a.dicon img {vertical-align : middle;}
a.pdf {cursor: pointer;display: inline-block;width: 10px;height: 10px;line-height: 10px;color: White;font-size: 13px;font-weight: bold;border-radius: 4px;text-align: center;position: relative; float:right;}
a.pdf img {vertical-align : middle;}
div.tooltip-payment {background-color: #037898;color: White;position: absolute;left: -245px;top: -8px;z-index: 1000000;width: 250px;border-radius: 5px; text-shadow:none; font-weight:normal;}
div.tooltip-payment:before {border-color: transparent #037898 transparent transparent;border-left: 6px solid #037898;border-style: solid;border-width: 6px 0px 6px 6px;content: "";display: block;height: 0;width: 0;line-height: 0;position: absolute;top: 40%;left: 250px;}
div.tooltip-payment p {margin: 10px;color: White;}
.clickdisplay{width:147px !important;height:133px;}
.adbtn{background: url(<?php echo base_url(); ?>images/main/details_btn.png) no-repeat 0 0;border:0 none;color: #FFFFFF;cursor: pointer;float:left;font-size: 14px;font-weight: bold; font-style:normal; height: 40px !important;line-height: 30px !important;outline:0 none;text-align: center;text-decoration: none;width:115px;margin-right:0px; border-radius:0px;}
div.tooltip-payment2{ top:-15px; left: -255px;}
</style>
<div id="dialog1" title="Comfirm" style="display:none">
	<p>Are you sure to delete it??.</p>
</div>
<!-- Naver Analytics code -->
<script type="text/javascript" src="http://wcs.naver.net/wcslog.js">
</script> <script type="text/javascript"> if (!wcs_add) var
 wcs_add={}; wcs_add["wa"] = "s_15f3d51a6740"; if (!_nasa) var
 _nasa={}; wcs.inflow(); wcs_do(_nasa); </script>
 <script type="text/javascript">
$("#expDate").datepicker({ dateFormat: 'yy-mm-dd' } );
setTimeout('showmenu("ad1",0)',1000);
$('#events_widget').monthpicker();
$('#events_widget').monthpicker().bind('monthpicker-click-month', function (e, month) {
}).bind('monthpicker-change-year', function (e, year) {
}).bind('monthpicker-show', function () {
}).bind('monthpicker-hide', function () {
});
setTimeout('showmenu("ad1",0)',1000);
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('.numbersonly').keypress(function (event) {
        return isNumber(event, this)
    });
});
// THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
function isNumber(evt, element) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if ((charCode != 45 || $(element).val().indexOf('-') != 0) && (charCode != 46 || $(element).val().indexOf('.') != -1) && ((charCode < 48 && charCode != 8) || charCode > 57)){
		return false;
	}
	else {
		return true;
	}
}
$(document).ready(function(){
	$("#submitButton").click(function(){
		$("#frmCashout").find(".error").removeClass("error");
		if($("#payment_account").val()=="") {
			alert('<?php echo $ValidEmail;?>');
			$("#payment_account").addClass("error").select();
			return false;
		} else if(!(/(.+)@(.+){2,}\.(.+){2,}/.test($("#payment_account").val()))) {
			alert('<?php echo $ValidEmail;?>');
			$("#payment_account").addClass("error").select();
			return false;
		} else if ($("#trnAmount").val()*1 > $("#balance").val()*1) {
			//alert('<?php echo $lngAmtWrng;?>');
			alert('<?php //echo $lngAmtWrng;?>You have exceeded your maximum cashout value. Maximum cashout is <?php echo $profile['money'];?>. Paid Credits have a 15% service fee. Coupon credits are not cashable.');
			$("#trnAmount").addClass("error").select();
			return false;
		}
		else if ($("#trnAmount").val()>0) {
			$("#frmCashout").submit();
			return true;
		} 
		else {
			alert('<?php echo $lngVldAmt;?>');
			$("#trnAmount").addClass("error").focus();
			return false;
		}
	});
	
	// Transaction Alert
	$('.transMsg').dialog({
		modal:true,
		buttons: {
			OK: function() {
				$( this ).dialog( "close" );
			}
		}
	}); 
});
</script>
</div>