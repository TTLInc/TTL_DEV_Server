<style>.errMsg{
    color: #FF0000;
    font-size: 11px;
    padding-bottom: 27px;
	
}
.pro-settg .tab-cnt .sub-cnt .cnt-rw {float:left; clear:both; width:100%; margin:0 0 10px 0; padding:0 0 13px 0; border-bottom:none !important;}
.pro-settg .tab-cnt .sub-cnt .cnt-rw input[type="text"]{ float:left; background:none; border: 1px solid #F0F1F2 !important;font-size:18px; border-radius: 5px!important; width:430px !important; height:30px;}


}

</style>
<script>
$(document).ready(function(){
    $(".numbersonly").keypress(function(e){
      var unicode=e.charCode? e.charCode : e.keyCode
     if ((unicode!=8) && (unicode!=9)){ 
        if (unicode<48||unicode>57&&unicode!=65) //if not a number
           return false //disable key press
        }
    });
	
	$("#trnCardNumber_old").keyup(function () {
		var a = $("#trnCardNumber_old").val();
		$("#trnCardNumber").val(a);
	});
	
	$("#trnExpMonth_old").keyup(function () {
		var a = $("#trnExpMonth_old").val();
		$("#trnExpMonth").val(a);
	});
	
	$("#trnExpYear_old").keyup(function () {
		var a = $("#trnExpYear_old").val();
		$("#trnExpYear").val(a);
	});
	
	$("#trnCardCvd_old").keyup(function () {
		var a = $("#trnCardCvd_old").val();
		$("#trnCardCvd").val(a);
	});
	
});
function cancelForm()
{
	window.location.href='<?php echo Base_url('user/account');?>';
}
</script>
<?php
$multi_lang = 'en';
if(!isset($_SESSION)) 
{
    session_start();
} 
if(!empty($_SESSION['postData'])) {$data = $_SESSION['postData'];}
?>

	<div class="baseBox baseBoxBg clearfix">
		<div class="content_main fr">
        	<div class="main_inner">
                <?php echo profile_menu($linkType,'');?>
                <!--/student_prof-->
                <div id="student_prof_Wp">
                    <div class="mod">
                        <div class="hd">
                            <div class="content tle"><h2>Account</h2></div>	
							<?php if(isset($errorMsg)):?>
							<div class="errMsg"><?php echo $errorMsg;?></div>
							<?php endif;?>
                            <!--raxa 16-01-14 strat-->
                            <div class="pro-settg">
                            	<div class="tab-nav" style="margin-bottom:-9px;" >
                                	<ul style="width:36% !important;">
                                    	<li class="active">TheTalkList Payment</li>
									</ul>
									<div style="width:33% !important; float:left;position:relative;
top:-20px"><img src="<?php echo base_url(); ?>images/visa.jpeg" alt="03" height="40" width="170"/></div>
									<div style="width:12% !important;float:right;position:relative; top:-6px"><a style="text-decoration: none;" href="https://www.beanstream.com/scripts/valid_merchant.asp?merchantId=306300000" target="_new"><img src="<?php echo base_url(); ?>images/beanstream.jpeg" alt="03" height="40" width=""/></a></div>
                                </div>
								
                                <div class="tab-cnt">
									<div class="sub-cnt" id="con1" style="display:block;">
										<form action="https://www.beanstream.com/scripts/process_transaction.asp" method="post"  >
										<div class="cnt-rw">
												<label>Amount:</label>
												<label style="color:#037898;">
												$<?php echo $data['money']."&nbsp;";
												
												if($data['month']) { echo ' ('.$data['month'].' months)';}else if($data['credit']){echo ' ('.$data['credit'].' credits)';}?>
												</label>
												<input  autocomplete="off"  type="hidden" name="trnAmount" value="<?php echo $data['money']?>"/>
										</div>
											<div class="cnt-rw">
												<label>Card Owner:</label>
												<input type="hidden" name="merchant_id" value="306300000" />
												<!-- client merchant id-->
												<!-- <input type="hidden" name="merchant_id" value="306300000" />-->
															
												<input type="hidden" name="paymentMethod" value="CC" />
												<input autocomplete="off"  type="text" name="trnCardOwner"  />
												<input type="hidden" name="errorPage" value="<?php echo Base_url('user/paymentForm');?>" />
												<input type="hidden" name="approvedPage" value="<?php echo Base_url('user/bs_success');?>" />
												<!-- <input type="hidden" name="trnCardType" value="VI" /><br>-->
											</div>
											<div class="cnt-rw">
												<label>Card No:</label>
												 <input autocomplete="off" placeholder="xxxxxxxxxxxxxxxx" type="text" name="trnCardNumber_old" id="trnCardNumber_old" value=""  maxlength="16" class="numbersonly"/>
												 <input type="hidden" name="trnCardNumber" id="trnCardNumber" maxlength="16" class="numbersonly"/>
											</div>
											<div class="cnt-rw">
												<label>Card Expiry Month:</label>
											   	<input autocomplete="off" type="text" name="trnExpMonth_old" id="trnExpMonth_old" value="" class="numbersonly" placeholder="xx" maxlength="2" /><br>
												<input type="hidden" name="trnExpMonth" id="trnExpMonth" maxlength="16" class="numbersonly"/>
											</div>
										  	<div class="cnt-rw">
												<label>Card Expiry Year:</label>
												<input  autocomplete="off" type="text" name="trnExpYear_old" id="trnExpYear_old" value="" class="numbersonly" placeholder="xx" maxlength="2"/>
												<input type="hidden" name="trnExpYear" id="trnExpYear" maxlength="16" class="numbersonly"/>
										    </div>
																			   						
											<div class="cnt-rw">
												<label>Card Code (CVV):</label>
												<input  autocomplete="off"  type="text" name="trnCardCvd_old" id="trnCardCvd_old" value="" class="numbersonly" maxlength="4" placeholder="xxxx"/><br>
												<input type="hidden" name="trnCardCvd" id="trnCardCvd" maxlength="16" class="numbersonly"/>
											</div>
											<div class="cnt-rw no-brd">
												<label>&nbsp;</label>
												<input type="hidden" name="ref1" value="<?php echo $this->user['uid'];?>" />
												<input type="hidden" name="ref2" value="<?php echo $data['money']?>" />
												<input type="submit" id="submitButton" value="Submit" class="st-btn"> 
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
