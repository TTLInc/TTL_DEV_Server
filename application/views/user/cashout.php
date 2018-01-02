<?php
$multi_lang = 'en';
if(!isset($_SESSION)) 
{
    session_start();
} 
?>
<?php
$arrVal = $this->lookup_model->getValue('96', $multi_lang);$lcurrentbalance = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1272', $multi_lang);$lngCashout = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1273', $multi_lang);$lngAlertStatus = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('101', $multi_lang);$lngAmount = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1274', $multi_lang);$lngAmtWrng = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1275', $multi_lang);$lngAlertfailed = $arrVal[$multi_lang];
?>
<style type="text/css">
.error{border:1px solid #FF0000 !important;}
.errMsg {color: #FF0000;font-size: 11px;padding-bottom: 27px;}
.pro-settg .tab-cnt .sub-cnt .cnt-rw {float:left; clear:both; width:100%; margin:0 0 10px 0; padding:0 0 13px 0; border-bottom:none !important;}
.pro-settg .tab-cnt .sub-cnt .cnt-rw input[type="text"]{ float:left; background:none; border: 1px solid #F0F1F2;font-size:18px; border-radius: 5px!important; width:430px !important; height:30px;}
</style>
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
		if ($("#trnAmount").val()*1 > $("#balance").val()*1) {
			alert('<?php echo $lngAmtWrng;?>');
			$("#trnAmount").addClass("error").select();
			return false;
		}
		else if ($("#trnAmount").val()>0) {
			$("#frmCashout").submit();
			return true;
		} 
		else {
			$("#trnAmount").addClass("error").focus();
			return false;
		}
	});
});
function cancelForm()
{
	window.location.href='<?php echo Base_url('user/account');?>';
}
</script>
<div class="baseBox baseBoxBg clearfix">
	<div class="content_main fr">
		<div class="main_inner">
			<?php echo profile_menu($linkType,'');?>
			<!--/student_prof-->
			<div id="student_prof_Wp">
				<div class="mod">
					<div class="hd">
						<div class="content tle"><h2><?php echo $lngCashout;?></h2></div>	
						<?php 
						if($this->session->userdata('alertstatus')):?>
						<div class="errMsg">
							<?php echo ($this->session->userdata('alertstatus')==2) ? $lngAlertStatus : $lngAlertfailed;
							$this->session->unset_userdata('alertstatus');
							?>
						</div>
						<?php endif;?>
						<!--raxa 16-01-14 strat-->
						<div class="pro-settg">
							<div class="tab-cnt">
								<div class="sub-cnt" id="con1" style="display:block;">
									<form action="" method="post" id="frmCashout">
									<div class="cnt-rw">
										<label><?php echo $lcurrentbalance;?>:</label>
										<label><?php if($profile['money'] < 0){ echo "0.00";}else{ echo $profile['money']; }?></label>
									</div>
									<div class="cnt-rw">
										<label><?php echo $lngAmount;?>($):</label>
										<input type="text" id="trnAmount" name="trnAmount" value="<?php echo $data['money']?>" class="numbersonly" autocomplete="off" />
									</div>
									<div class="cnt-rw no-brd">
										<label>&nbsp;</label>
										<input type="hidden" name="ref1" value="<?php echo $this->user['uid'];?>" />
										<input type="hidden" name="balance" id ="balance" value="<?php echo $profile['money']?>" />
										<input type="button" id="submitButton" value="Submit" class="st-btn"> 
										<input type="button" value="Cancel" class="st-btn" onclick="cancelForm();">
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/student_prof_Wp-->
		</div>
	</div>
	<!--/content_main-->
	<?php include dirname(__FILE__).'/leftSide.php';?>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
