<?php

/*Test */
require_once(APPPATH.'paymentwall-php/lib/paymentwall.php');
Paymentwall_Config::getInstance()->set(array(
			'api_type' => Paymentwall_Config::API_VC,
			'public_key' => '85bbb2db528ac112efbc48fca34ba12a',
			'private_key' => '4b3f92b55ea670d915f29b3785caa970'
		));
$pingback = new Paymentwall_Pingback($_GET, $_SERVER['REMOTE_ADDR']);
//$pingback = new Paymentwall_Pingback($_GET, "174.37.14.28");

if ($pingback->validate(true)) {
  $virtualCurrency = $pingback->getVirtualCurrencyAmount();
   if ($pingback->isDeliverable()) {
		// deliver the virtual currency
		$payinfo = array();
		//if($_GET['uid']==$this->session->userdata('uid')){
			$payinfo['uid'] = $_GET['uid'];
			$payinfo['money'] = $_GET['currency'];
			//$payinfo['money'] = $_GET['credit'];
			$credit = $_GET['currency'];
			$creditwithoutdiscount = $_GET['Withoutdiscount'];
			$payinfo['coupon_credits'] = $credit - $creditwithoutdiscount;
			$payinfo['purchased_credits'] = $creditwithoutdiscount;
			$payinfo['status'] = 1;
			$payinfo['token'] = $_GET['sig'];
			$this->pay_model->save($payinfo);
			$this->pay_model->updatepaywallMoney(@$payinfo);
  } else if ($pingback->isCancelable()) {
	  // Deduct Amount
	  if($_GET['type']== 2){
			$payinfo['uid'] = $_GET['uid'];
			$payinfo['money'] = $_GET['currency'];
			$payinfo['status'] = 1;
			$payinfo['token'] = $_GET['sig'];
			//$this->pay_model->save($payinfo);
			$this->pay_model->deductpaywallMoney(@$payinfo);
		} 
	// withdraw the virual currency
  }
  echo 'OK'; // Paymentwall expects response to be OK, otherwise the pingback will be resent
} else {
  echo $pingback->getErrorSummary();
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
$arrVal = $this->lookup_model->getValue('1305', $multi_lang); $lngTransComplete = $arrVal[$multi_lang];
?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<link rel="stylesheet" href="<?php echo base_url();?>css/popup-css.css">
<style>
.ui-widget-content{/*border: 4px solid #0087d0;    border-radius: 0 !important;*/ background:#fff; padding:15px;}
.ui-widget-header{ background:none; border:0 none !important;}
.ui-widget-header{ float:right;}
.transMsg {font-size: 15px;line-height:18px;color:}
</style>
<div class="transMsg" style="display:none;">
<?php 
echo $lngTransComplete;
?>
</div>
<script type="text/javascript">
$(document).ready(function(){	
	// Transaction Alert
	$('.transMsg').dialog({
		modal:true,
		buttons: {
			Ok: function() {
				$( this ).dialog( "close" );
			}
		}
	}); 
});
</script>