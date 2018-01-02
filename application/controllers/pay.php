<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pay extends TL_Controller {
	public function __construct() {
        parent::__construct();
    }
    
	public function transaction(){
		$this->load->model('pay_model');
    	$this->load->view('user/transaction');
    }
	
	// call Function After Paymentwall Payment Success
	public function successpayment(){
		$this->load->model(array('lookup_model','pay_model'));
    	$this->layout->view('user/successpayment');
    }
	
    public function index(){
	 
    	$this->load->model('card_model');
    	$payId = $this->input->_request('payId');
    	$money = $this->input->_request('money');
    	$UpgradeMonthsTutor = $this->input->_request('UpgradeMonthsTutor');
    	if($payId=='paypal'){
    		$this->pay_by_paypal_simple();
    	}
    	else{
    		$this->creditCard();
    	}
    }
    public function vars(){
    	echo '<pre>';
    	var_dump($_GET);
    }
	/*privacy*/
	public function returnUrl(){
		$get = $_GET;
		$post = $_POST;
		$data = array_merge($post,$get);
		$str = file_get_contents('./ipn.txt');
		file_put_contents('./ipn.txt',$str . "\r\n" .var_export($data,true));
		var_dump($data );
	}
	public function paypal_ipn(){
		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval) {
		  $keyval = explode ('=', $keyval);
		  if (count($keyval) == 2)
		     $myPost[$keyval[0]] = urldecode($keyval[1]);
		}
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		if(function_exists('get_magic_quotes_gpc')) {
		   $get_magic_quotes_exists = true;
		} 
		foreach ($myPost as $key => $value) {        
		   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
		        $value = urlencode(stripslashes($value)); 
		   } else {
		        $value = urlencode($value);
		   }
		   $req .= "&$key=$value";
		}
		$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
		if( !($res = curl_exec($ch)) ) {
		    curl_close($ch);
		    file_put_contents('./paypal_ipn_not2.txt', file_get_contents('paypal_ipn_not2.txt')."\r\n".var_export($_POST,true) .$res);
			exit;
		}
		curl_close($ch);
		file_put_contents('./paypal_ipn.txt', file_get_contents('paypal_ipn.txt')."\r\n".var_export($_POST,true) .$res);
		if (strcmp ($res, "VERIFIED") == 0) {
		    // check whether the payment_status is Completed
		    // check that txn_id has not been previously processed
		    // check that receiver_email is your Primary PayPal email
		    // check that payment_amount/payment_currency are correct
		    // process payment
		 
		    // assign posted variables to local variables
		    $this->load->model(array('profile_model','pay_model'));
		    $profileId = $_POST['recurring_payment_id'];
		    $txn_type = $_POST['txn_type'];
		    $money = $_POST['payment_gross'];
		    //payment_gross
			if($txn_type == 'recurring_payment'){
		    	$payInfo = $this->pay_model->findByProfileId($profileId);
		    	file_put_contents('./paypal_ipn_recurring_payment.txt', file_get_contents('./paypal_ipn_recurring_payment.txt')."\r\n".var_export($_POST,true) .$res);
	
		    	if(isset($payInfo['status']) && $payInfo['status'] != 1){
		   			$payInfo['status'] = 1;
		    		$payInfo['Payer'] = $payer;
		    		$this->pay_model->update($payInfo);
		    		$profile = $this->profile_model->getProfile($payInfo['uid']);
		    		$money = floor($money,$payInfo['money']);
		    		if($money >= 300){
		    			$money = $money * (1+0.02);
		    		}
		    		else if($money >= 200){
		    			$money = $money * (1+0.01);
		    		}
		    		$profileNew['money'] = $profile['money'] + $money;
		    		$profileNew['uid'] = $profile['uid'] ;
		    		$this->profile_model->updateMoney($profileNew);
					////TECHNO-VIPLOVE added below code for affiliate////////
			$uid = $this->session->userdata('uid');
			$getrow = "select uid from pay where uid = {$uid}";
		    $queryget = $this->db->query($getrow);	
           if ($queryget->num_rows() >= 0)  
		   {
			$sqlrefid = "select refid from user where id = {$uid}";
		    $queryrefid = $this->db->query($sqlrefid);
		    $resultrefid = $queryrefid->result_array();
			$ref_id = $resultrefid[0]['refid'];
			
			$sqlrole = "select roleId from user where id = {$ref_id}";
		    $queryrole = $this->db->query($sqlrole);
		    $resultrole = $queryrole->result_array();
			$role_id = $resultrole[0]['roleId'];
			//print_r($role_id);die;
			
			if($role_id <=3)
			{
			$sqlpercentage = "select value from config where id = 7";
		    $querypercentage = $this->db->query($sqlpercentage);
		    $resultpercentage = $querypercentage->result_array();
			$percentage = $resultpercentage[0]['value'];
			$fee =  $money*($percentage/100);
			}
			
						
			if($role_id ==4)
			{			
			$sqlpercentage = "select value from config where id = 8";
		    $querypercentage = $this->db->query($sqlpercentage);
		    $resultpercentage = $querypercentage->result_array();
			$percentage = $resultpercentage[0]['value'];
			$fee =  $money*($percentage/100);
			}

			if($role_id ==5)
			{			
			$sqlpercentage = "select value from config where id = 6";
		    $querypercentage = $this->db->query($sqlpercentage);
		    $resultpercentage = $querypercentage->result_array();
			$percentage = $resultpercentage[0]['value'];
			$fee =  $money*($percentage/100);
			}
			
			
			
			$sql = "insert into affiliate (`refid`,`sid`,`amount`,`createAt`) values ({$ref_id},{$uid},'{$fee}',NOW())";
			$query = $this->db->query($sql);
			}
				////TECHNO-VIPLOVE added above code for affiliate////////
		    	}
		    }
		    
		} else if (strcmp ($res, "INVALID") == 0) {
		    file_put_contents('./paypal_ipn_not.txt', file_get_contents('paypal_ipn_not.txt')."\r\n".var_export($_POST,true) .$res);
		}
		file_put_contents('./paypal_ipn.txt', file_get_contents('paypal_ipn.txt')."\r\n".var_export($_POST,true) .$res);
	}
	public function ipn(){
		$data = $this->input->_requestAll();
		file_put_contents('./ipn.txt', file_get_contents('ipn.txt').'\r\n'.var_export($data,true));
	}
	public function recurring(){
		require_once(FCPATH.'/paypal/samples/PPBootStrap.php');
		$token = $this->input->get('token');
		$this->load->model('pay_model');
		$payInfo = $this->pay_model->findByToken($token);
		$currencyCode = "USD";
		$amount = $payInfo['money'];
		$amount = ceil($amount * 100) /100;
		$month = $payInfo['month'];
		$roleId = $this->session->userdata('roleId');
		$creditA = 1;
		if($roleId == 0){
			if($amount == 300){
				$creditA = 310; 
			}else if($amount == 500){
				$creditA = 520; 
			}else if($amount == 1000){
				$creditA = 1030; 
			}else if($amount == 100){
				$creditA = 100;
			}else if($amount == 30){
				$creditA = 30; 
			}else{
				$creditA = $amount;
			}
			$desc = $creditA . ' Credits on TheTalklist';
		}else{
			if($amount == 30){
				$creditA = 1; 
			}else if($amount == 50){
				$creditA = 2; 
			}else if($amount == 70){
				$creditA = 3; 
			}
			$desc = $creditA . ' month Premium Tutor Membership';
		}
		$shippingAddress = new AddressType();
		$RPProfileDetails = new RecurringPaymentsProfileDetailsType();
		$RPProfileDetails->BillingStartDate = date(DATE_ATOM );
		$activationDetails = new ActivationDetailsType();
		$activationDetails->FailedInitialAmountAction = 'CancelOnFailure';
		$paymentBillingPeriod =  new BillingPeriodDetailsType();
		$paymentBillingPeriod->BillingFrequency = 1;
		$paymentBillingPeriod->BillingPeriod = 'Month';
		$paymentBillingPeriod->TotalBillingCycles = $month;//total count
		$paymentBillingPeriod->Amount = new BasicAmountType($currencyCode, $amount);
		$scheduleDetails = new ScheduleDetailsType();
		$scheduleDetails->Description = $desc;
		$scheduleDetails->ActivationDetails = $activationDetails;
		$scheduleDetails->PaymentPeriod = $paymentBillingPeriod;
		$createRPProfileRequestDetail = new CreateRecurringPaymentsProfileRequestDetailsType();
		$createRPProfileRequestDetail->Token  = $token;
		$createRPProfileRequestDetail->ScheduleDetails = $scheduleDetails;
		$createRPProfileRequestDetail->RecurringPaymentsProfileDetails = $RPProfileDetails;
		$createRPProfileRequest = new CreateRecurringPaymentsProfileRequestType();
		$createRPProfileRequest->CreateRecurringPaymentsProfileRequestDetails = $createRPProfileRequestDetail;
		$createRPProfileReq =  new CreateRecurringPaymentsProfileReq();
		$createRPProfileReq->CreateRecurringPaymentsProfileRequest = $createRPProfileRequest;
		$paypalService = new PayPalAPIInterfaceServiceService();
		try {
			$createRPProfileResponse = $paypalService->CreateRecurringPaymentsProfile($createRPProfileReq);
		} catch (Exception $ex) {
			var_dump($ex);
			exit;
		}
		if(isset($createRPProfileResponse)) {
			if($createRPProfileResponse->Ack == 'Failure' ){
				echo $createRPProfileResponse->Errors[0]->LongMessage;
			}
			else{
				$profileId = $createRPProfileResponse->CreateRecurringPaymentsProfileResponseDetails->ProfileID;
				//skvirja 01 july 2013 changes
				if($payInfo['money'] == 300){
					$payInfo['money'] = 310;
				}else if($payInfo['money'] == 500){
					$payInfo['money'] = 520;
				}else if($payInfo['money'] == 1000){
					$payInfo['money'] = 1030;
				}else if($payInfo['money'] == 30){
					$payInfo['money'] = 25;
				}
				if($profileId != ''){
					$payInfo['profileId'] = $profileId;
					$this->pay_model->update($payInfo);
					$this->session->set_userdata(array('payment'=>'success'));
					$this->pay_model->updateProofileMoney(@$payInfo['money']);

					$this->pay_model->updateTutorMonths(@$creditA ,$payInfo['profileId'] );
					
					
					
					
					header('location:'.base_url('user/account'));
				}
				else{
					var_dump($createRPProfileResponse);
				}
			}
		}
	}
	public function returnaccount(){
		require_once(FCPATH.'/paypal/samples/PPBootStrap.php');
		$token = $this->input->get('token');
		$PayerID = $this->input->get('PayerID');
		$paymentAction = urlencode('Sale');
		$this->load->model('pay_model');
		$payInfo = $this->pay_model->findByToken($token);
		$currencyCode = "USD";
		$amount = $payInfo['money'];
		$amount = ceil($amount * 100) /100;
		
		$month = $payInfo['month'];
		$roleId = $this->session->userdata('roleId');
		$creditA = 1;
		if($roleId == 0){
			if($amount == 300)
			{
				$creditA = 310; 
			}else if($amount == 500)
			{
				$creditA = 520; 
			}else if($amount == 1000)
			{
				$creditA = 1030; 
			}else if($amount == 100)
			{
				$creditA = 100;
			}else if($amount == 30)
			{
				$creditA = 30; 
			}else{
				$creditA = $amount;
			}
			$desc = $creditA . ' Credits on TheTalklist';
		}else{
			if($amount == 30)
			{
				$creditA = 1; 
			}else if($amount == 50)
			{
				$creditA = 2; 
			}else if($amount == 70)
			{
				$creditA = 3; 
			}
			$desc = $creditA . ' month Premium Tutor Membership';
		}
		
		//$profileId = $createRPProfileResponse->CreateRecurringPaymentsProfileResponseDetails->ProfileID;
		//skvirja 01 july 2013 changes
		if($payInfo['level'] == 1){
			$payInfo['money'] = 30;
		}else if($payInfo['level'] == 2){
			$payInfo['money'] = 100;
		}else if($payInfo['level'] == 3){
			$payInfo['money'] = 300;
		}else if($payInfo['level'] == 4){
			$payInfo['money'] = 500;
		}
/*		
		if($payInfo['money'] == 300)
		{
			$payInfo['money'] = 310;
		}else if($payInfo['money'] == 500)
		{
			$payInfo['money'] = 520;
		}else if($payInfo['money'] == 30)
		{
			$payInfo['money'] = 30;
		}else if($payInfo['money'] == 100)
		{
			$payInfo['money'] = 100;
		}else{
			$payInfo['money'] = 30;
		}
		*/
		
		$logger = new PPLoggingManager('DoExpressCheckout');
		
		// below commented code is optional
		/*
		$getExpressCheckoutDetailsRequest = new GetExpressCheckoutDetailsRequestType($token);
		$getExpressCheckoutReq = new GetExpressCheckoutDetailsReq();
		$getExpressCheckoutReq->GetExpressCheckoutDetailsRequest = $getExpressCheckoutDetailsRequest;		
		$paypalService = new PayPalAPIInterfaceServiceService();
		try {
			$getECResponse = $paypalService->GetExpressCheckoutDetails($getExpressCheckoutReq);
		} catch (Exception $ex) {
			include_once("../Error.php");
			exit;
		}
		*/	
			
		$paypalService = new PayPalAPIInterfaceServiceService();
		$orderTotal = new BasicAmountType();
		$orderTotal->currencyID = 'USD';
		$orderTotal->value = $payInfo['money'];
		//$orderTotal->value = '0.01';
		
/*echo "test12345";
		exit;*/
		$PaymentDetails= new PaymentDetailsType();
		$PaymentDetails->OrderTotal = $orderTotal;

		$DoECRequestDetails = new DoExpressCheckoutPaymentRequestDetailsType();
		$DoECRequestDetails->PayerID = $PayerID;
		$DoECRequestDetails->Token = $token;
		$DoECRequestDetails->PaymentAction = $paymentAction;
		$DoECRequestDetails->PaymentDetails[0] = $PaymentDetails;

		$DoECRequest = new DoExpressCheckoutPaymentRequestType();
		$DoECRequest->DoExpressCheckoutPaymentRequestDetails = $DoECRequestDetails;


		$DoECReq = new DoExpressCheckoutPaymentReq();
		$DoECReq->DoExpressCheckoutPaymentRequest = $DoECRequest;
		
		try {
			$DoECResponse = $paypalService->DoExpressCheckoutPayment($DoECReq);
		} catch (Exception $ex) {
			//include_once("../Error.php");
			exit;
		}
	
		if(isset($DoECResponse)) {
			
			if($DoECResponse->Ack == 'Success')
			{
				if($payInfo['level'] == 1){
					$payInfo['money'] = 25;
				}else if($payInfo['level'] == 2){
					$payInfo['money'] = 100;
				}else if($payInfo['level'] == 3){
					$payInfo['money'] = 310;
				}else if($payInfo['level'] == 4){
					$payInfo['money'] = 520;
				}
				/*if($payInfo['money'] == 300)
				{
					$payInfo['money'] = 310;
				}else if($payInfo['money'] == 500)
				{
					$payInfo['money'] = 520;
				}else if($payInfo['money'] == 1000)
				{
					$payInfo['money'] = 1030;
				}else if($payInfo['money'] == 30)
				{
					$payInfo['money'] = 25;
				}else{
					$payInfo['money'] = 25;
				}*/

				$uid = $this->session->userdata('uid');
				$getrow = "select uid from pay where uid = {$uid}";
				$queryget = $this->db->query($getrow);	
				if ($queryget->num_rows() >= 0) 
				{
					$sqlrefid = "select refid from user where id = {$uid}";
					$queryrefid = $this->db->query($sqlrefid);
					$resultrefid = $queryrefid->result_array();
					$ref_id = $resultrefid[0]['refid'];

					$sqlrole = "select roleId from user where id = {$ref_id}";
					$queryrole = $this->db->query($sqlrole);
					$resultrole = $queryrole->result_array();
					$role_id = $resultrole[0]['roleId'];
					  
					//print_r($role_id);die;
					$amount = $payInfo['money'];
					if($role_id <=3)
					{			
						$sqlpercentage = "select value from config where id = 7";
						$querypercentage = $this->db->query($sqlpercentage);
						$resultpercentage = $querypercentage->result_array();
						$percentage = $resultpercentage[0]['value'];
						$fee =  $payInfo['money']*($percentage/100);
					}

					if($role_id ==4)
					{			
						$sqlpercentage = "select value from config where id = 8";
						$querypercentage = $this->db->query($sqlpercentage);
						$resultpercentage = $querypercentage->result_array();
						$percentage = $resultpercentage[0]['value'];
						$fee =  $payInfo['money']*($percentage/100);
					}

					if($role_id ==5)
					{			
						$sqlpercentage = "select value from config where id = 6";
						$querypercentage = $this->db->query($sqlpercentage);
						$resultpercentage = $querypercentage->result_array();
						$percentage = $resultpercentage[0]['value'];
						$fee =  $payInfo['money']*($percentage/100);
					}
					
					if($role_id == 1 || $role_id == 2){
						$this->pay_model->updateTutorGold($payInfo['uid']);
					}
					$sql = "insert into affiliate (`refid`,`sid`,`purchaseamount`,`amount`,`createAt`) values ({$ref_id},{$uid},'{$amount}','{$fee}',NOW())";
					$query = $this->db->query($sql);
				}
					
				//$payInfo['profileId'] = $profileId;
				$this->pay_model->update($payInfo);
				$this->session->set_userdata(array('payment'=>'success'));
				$this->pay_model->updateProofileMoney(@$payInfo['money']);
				
				//$this->pay_model->updateTutorMonths(@$creditA ,$payInfo['uid'] );
				
				header('location:'.base_url('user/account'));
			}
		}
	}
	
	public function creditCard(){
		require_once(FCPATH.'/paypal/samples/PPBootStrap.php');
		$this->load->model('card_model');
    	$payId = $this->input->_request('payId');
		$pay = $this->card_model->getOne($payId);
		$paypalAccount = $pay['paypalAccount'];
		$this->load->model('pay_model');
		
		//$this->load->model('pay_model');
		//$payInfo = $this->pay_model->findByToken($token);
		$currencyCode = "USD";
		$amount = $this->input->_request('money',10);
		$amount = ceil($amount * 100) /100;
		//$desc = $payInfo['desc'];
		$month = $this->input->_request('month',1);
		if($month==1)
		{
			//$desc = 'Recurring payment of $' .$amount . ' for ' .$month . ' Month to TheTalkList';
			//$desc = 'Payment of $' .$amount . ' for ' .$month . ' Month to TheTalkList';
			$desc = $amount . ' Credits on The Talklist';
		}else{	
			//$desc = 'Recurring payment of $' .$amount . ' for ' .$month . ' Months to TheTalkList';
			//$desc = 'Payment of $' .$amount . ' for ' .$month . ' Months to TheTalkList';
			$desc = $amount . ' Credits on The Talklist';
		}	
		//echo $desc;exit;
		$payinfo = array();
		$payinfo['uid'] = $this->session->userdata('uid');
		if($payinfo['uid'] < 1){
			echo $error =  'You must login first.';
			exit;
		}
		$payinfo['money'] = $amount;
		$payinfo['status'] = false;
		//$payinfo['token'] = $token;
		$payinfo['month'] = $month;

		$shippingAddress = new AddressType();

		$RPProfileDetails = new RecurringPaymentsProfileDetailsType();
		$RPProfileDetails->BillingStartDate = date(DATE_ATOM );

		$activationDetails = new ActivationDetailsType();
		$activationDetails->FailedInitialAmountAction = 'CancelOnFailure';
		//$activationDetails->InitialAmount

		$paymentBillingPeriod =  new BillingPeriodDetailsType();
		$paymentBillingPeriod->BillingFrequency = 1;
		$paymentBillingPeriod->BillingPeriod = 'Month';
		$paymentBillingPeriod->TotalBillingCycles = $month;//total count
		$paymentBillingPeriod->Amount = new BasicAmountType($currencyCode, $amount);

		$scheduleDetails = new ScheduleDetailsType();
		$scheduleDetails->Description = $desc;
		$scheduleDetails->ActivationDetails = $activationDetails;

		$scheduleDetails->PaymentPeriod = $paymentBillingPeriod;
		/*if($_REQUEST['maxFailedPayments'] != "") {
			$scheduleDetails->MaxFailedPayments =  $_REQUEST['maxFailedPayments'];
		}
		if($_REQUEST['autoBillOutstandingAmount'] != "") {
			$scheduleDetails->AutoBillOutstandingAmount = $_REQUEST['autoBillOutstandingAmount'];
		}*/

		$createRPProfileRequestDetail = new CreateRecurringPaymentsProfileRequestDetailsType();
		
		$creditCard = new CreditCardDetailsType();
		$creditCard->CreditCardNumber = $pay['cardNumber'];
		$types = array('paypal','','MasterCard','Visa','Amex', 'Discover');
		$creditCard->CreditCardType = $types[$pay['type']];
		$creditCard->CVV2 = $pay['secNumber'];
		$date = $pay['date'];
		$date  = explode('-',$date);
		$creditCard->ExpMonth = $date[1];
		$creditCard->ExpYear = $date[0];
		$createRPProfileRequestDetail->CreditCard = $creditCard;
		
		$createRPProfileRequestDetail->ScheduleDetails = $scheduleDetails;
		$createRPProfileRequestDetail->RecurringPaymentsProfileDetails = $RPProfileDetails;
		$createRPProfileRequest = new CreateRecurringPaymentsProfileRequestType();

		$createRPProfileRequest->CreateRecurringPaymentsProfileRequestDetails = $createRPProfileRequestDetail;


		$createRPProfileReq =  new CreateRecurringPaymentsProfileReq();
		$createRPProfileReq->CreateRecurringPaymentsProfileRequest = $createRPProfileRequest;

		$paypalService = new PayPalAPIInterfaceServiceService();
		try {
			/* wrap API method calls on the service object with a try catch */
			$createRPProfileResponse = $paypalService->CreateRecurringPaymentsProfile($createRPProfileReq);
		} catch (Exception $ex) {
			//include_once("../Error.php");
			var_dump($ex);
			exit;
		}

		if(isset($createRPProfileResponse)) {
			if($createRPProfileResponse->Ack == 'Failure' ){
				echo $createRPProfileResponse->Errors[0]->LongMessage;
			}
			else{
				$profileId = $createRPProfileResponse->CreateRecurringPaymentsProfileResponseDetails->ProfileID;
				$payInfo['profileId'] = $profileId;
				
				$this->pay_model->save($payInfo);
				header('location:'.base_url('user/account'));
			}
		}
	}
	public function pay_by_paypal1(){
		require_once(FCPATH.'/paypal/samples/PPBootStrap.php');
		
		//$this->load->model('card_model');
    	//$payId = $this->input->_request('payId');
		//$pay = $this->card_model->getOne($payId);
		//$paypalAccount = $pay['paypalAccount'];

		define('PAYPAL_REDIRECT_URL', 'https://www.paypal.com/webscr&cmd=');
		//define('PAYPAL_REDIRECT_URL', 'https://www.paypal.com/webscr&cmd=');
		define('DEVELOPER_PORTAL', 'https://developer.paypal.com');
		
		$url = dirname('http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI']);
		//$returnUrl = base_url('pay/recurring');
		$returnUrl = base_url('pay/returnaccount');
		$cancelUrl = base_url('user/account');
		$ipn_url = base_url('pay/paypal_ipn');
		$month = $this->input->_request('month',1);
		//$returnUrl = base_url('paypal/samples/ExpressCheckout/GetExpressCheckout.php');
		//$cancelUrl = base_url('paypal/samples/ExpressCheckout1/GetExpressCheckout.php');
		
		$currencyCode = 'USD';
		$itemAmount = new BasicAmountType($currencyCode, $this->input->_request('money'));
		$itemTotalValue = $this->input->_request('money') * 1;
		$taxTotalValue = $this->input->_request('money') * 0;
		$amount = $orderTotalValue = $itemTotalValue + $taxTotalValue; 

		$itemDetails = new PaymentDetailsItemType();
		$itemDetails->Name = 'Account Credits';//$this->input->_request('name');
		$itemDetails->Amount = $itemAmount;
		$itemDetails->Quantity = 1;
		$itemDetails->ItemCategory = 'Physical';
		//$itemDetails->Tax = new BasicAmountType($currencyCode, $this->input->_request('amount') * 0.01);

		$PaymentDetails = new PaymentDetailsType();
		$PaymentDetails->PaymentDetailsItem[0] = $itemDetails;
		//$PaymentDetails->ShipToAddress = $address;
		$PaymentDetails->ItemTotal = new BasicAmountType($currencyCode, $itemTotalValue);
		$PaymentDetails->OrderTotal = new BasicAmountType($currencyCode, $orderTotalValue);
		//$PaymentDetails->TaxTotal = new BasicAmountType($currencyCode, $taxTotalValue);
		$PaymentDetails->PaymentAction = 'Sale';
		$PaymentDetails->NotifyURL = $ipn_url;

		//$PaymentDetails->HandlingTotal = $handlingTotal;
		//$PaymentDetails->InsuranceTotal = $insuranceTotal;
		//$PaymentDetails->ShippingTotal = $shippingTotal;
		$setECReqDetails = new SetExpressCheckoutRequestDetailsType();
		$setECReqDetails->PaymentDetails[0] = $PaymentDetails;
		$setECReqDetails->CancelURL = $cancelUrl;
		$setECReqDetails->ReturnURL = $returnUrl;
		//$setECReqDetails->BuyerEmail = $paypalAccount;
		//$setECReqDetails->ipnNotificationUrl = $ipn_url;
		$setECReqDetails->NoShipping = 1;
		//$setECReqDetails->AddressOverride = $_REQUEST['addressOverride'];
		//$setECReqDetails->ReqConfirmShipping = $_REQUEST['reqConfirmShipping'];


		// Billing agreement
		$billingAgreementDetails = new BillingAgreementDetailsType('RecurringPayments');
		
		// if($month==1)
			// $desc = $amount . ' Credits on TheTalklist';
			
		// else
		$roleId = $this->session->userdata('roleId');
		if($roleId == 0)
		{
			if($amount == 300)
			{
				$creditA = 310; 
			}else if($amount == 500)
			{
				$creditA = 520; 
			}else if($amount == 1000)
			{
				$creditA = 1030; 
			}else if($amount == 100)
			{
				$creditA = 100;
			}else if($amount == 30)
			{
				$creditA = 25; 
			}else{
				$creditA = $amount;
			}
			$desc = $creditA . ' Credits on TheTalklist';
		}else{
			if($amount == 30)
			{
				$creditA = 1; 
			}else if($amount == 50)
			{
				$creditA = 2; 
			}else if($amount == 70)
			{
				$creditA = 3; 
			}
			$desc = $creditA . ' month Premium Tutor Membership';
		}
		
		
		$billingAgreementDetails->BillingAgreementDescription = $desc;
		$setECReqDetails->BillingAgreementDetails = array($billingAgreementDetails);

		$setECReqDetails->AllowNote = 1;
		$setECReqType = new SetExpressCheckoutRequestType();
		$setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;
		$setECReq = new SetExpressCheckoutReq();
		$setECReq->SetExpressCheckoutRequest = $setECReqType;

		$paypalService = new PayPalAPIInterfaceServiceService();
		
		try {
			/* wrap API method calls on the service object with a try catch */
			$setECResponse = $paypalService->SetExpressCheckout($setECReq);
		} catch (Exception $ex) {
			var_dump($ex);
			exit;
		}

		
		if(isset($setECResponse)) {
			if($setECResponse->Ack =='Success') {
				$token = $setECResponse->Token;
				//$token = $response->payKey;
				if(!$token){
					//var_dump($response->error[0]);
					echo $error =  $setECResponse->error[0]->message;
				}
				else {
					$payPalURL = PAYPAL_REDIRECT_URL . '_express-checkout&token=' . $token;
					$this->load->model('pay_model');
					$pay = array();
					$pay['uid'] = $this->session->userdata('uid');
					if($pay['uid'] < 1){
						echo $error =  'You must login first.';
						exit;
					}
					
					////TECHNO-VIPLOVE added below code for affiliate////////
			$uid = $this->session->userdata('uid');
			$getrow = "select uid from pay where uid = {$uid}";
		    $queryget = $this->db->query($getrow);	
           if ($queryget->num_rows() >= 0) 
		   {
			$sqlrefid = "select refid from user where id = {$uid}";
		    $queryrefid = $this->db->query($sqlrefid);
		    $resultrefid = $queryrefid->result_array();
			$ref_id = $resultrefid[0]['refid'];
			
			
			$sqlrole = "select roleId from user where id = {$ref_id}";
		    $queryrole = $this->db->query($sqlrole);
		    $resultrole = $queryrole->result_array();
			$role_id = $resultrole[0]['roleId'];
			//print_r($role_id);die;
			
			if($role_id <=3)
			{			
			$sqlpercentage = "select value from config where id = 7";
		    $querypercentage = $this->db->query($sqlpercentage);
		    $resultpercentage = $querypercentage->result_array();
			$percentage = $resultpercentage[0]['value'];
			$fee =  $amount*($percentage/100);
			}
			
						
			if($role_id ==4)
			{			
			$sqlpercentage = "select value from config where id = 8";
		    $querypercentage = $this->db->query($sqlpercentage);
		    $resultpercentage = $querypercentage->result_array();
			$percentage = $resultpercentage[0]['value'];
			$fee =  $amount*($percentage/100);
			}

			if($role_id ==5)
			{			
			$sqlpercentage = "select value from config where id = 6";
		    $querypercentage = $this->db->query($sqlpercentage);
		    $resultpercentage = $querypercentage->result_array();
			$percentage = $resultpercentage[0]['value'];
			$fee =  $amount*($percentage/100);
			}
			
			
			 
			$sql = "insert into affiliate (`refid`,`sid`,`amount`,`createAt`) values ({$ref_id},{$uid},'{$fee}',NOW())";
			$query = $this->db->query($sql);
			}
				////TECHNO-VIPLOVE added above code for affiliate////////
					
					$pay['money'] = $amount;
					$pay['status'] = false;
					$pay['token'] = $token;
					$pay['month'] = $month;
					$this->pay_model->save($pay);
					header('location:'.$payPalURL);
				}
				// Redirect to paypal.com here
				//$payPalURL = 'https://www.paypal.com/webscr?cmd=_express-checkout&token=' . $token;
				//echo" <a href=$payPalURL><b>* Redirect to PayPal to login </b></a><br>";
			}
			else{
				echo $setECResponse->Errors[0]->LongMessage;;
				var_dump($setECResponse);
			}
		}

	}
	public function pay_by_paypal_simple() {
		require_once(FCPATH.'/paypal/samples/PPBootStrap.php');
		
		//$this->load->model('card_model');
    	//$payId = $this->input->_request('payId');
		//$pay = $this->card_model->getOne($payId);
		//$paypalAccount = $pay['paypalAccount'];

		define('PAYPAL_REDIRECT_URL', 'https://www.paypal.com/webscr&cmd=');
		//define('PAYPAL_REDIRECT_URL', 'https://www.paypal.com/webscr&cmd=');
		define('DEVELOPER_PORTAL', 'https://developer.paypal.com');
		
		$url = dirname('http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI']);
		$returnUrl = base_url('pay/returnaccount');
		$cancelUrl = base_url('user/account');
		$ipn_url = base_url('pay/paypal_ipn');
		$month = $this->input->_request('month',1);
		//$returnUrl = base_url('paypal/samples/ExpressCheckout/GetExpressCheckout.php');
		//$cancelUrl = base_url('paypal/samples/ExpressCheckout1/GetExpressCheckout.php');
		$itemTotalValue = $this->input->_request('money') * 1;
		$taxTotalValue = $this->input->_request('money') * 0;
		$amount = $orderTotalValue = $itemTotalValue + $taxTotalValue; 
		
		$extraCredit = $this->input->_request('extraCredit');
		$extraBonus='0';
		
		$roleId = $this->session->userdata('roleId');
		if($roleId == 0)
		{
			if($amount == 300)
			{
				$creditA = 310; 
				$level = 3;
			}else if($amount == 500)
			{
				$creditA = 520; 
				$level = 4;
			}else if($amount == 1000)
			{
				$creditA = 1030; 
				$level = 5;
			}else if($amount == 100)
			{
				$creditA = 100; 
				$level = 2;
			}else if($amount == 30)
			{
				$creditA = 25; 
				$level = 1;
			}else{
				$creditA = $amount;
			}
			
			if($extraCredit == 10)
			{
				$extraBonus=(($creditA*$extraCredit)/100);
			}
			$creditA= ($creditA+$extraBonus);

			$desc = $creditA . ' Credits on TheTalklist';
		}else{
			if($amount == 30)
			{
				$creditA = 1; 
			}else if($amount == 50)
			{
				$creditA = 2; 
			}else if($amount == 70)
			{
				$creditA = 3; 
			}
			$desc = $creditA . ' month Premium Tutor Membership';
		}
		//echo $desc;exit;

		$currencyCode = 'USD';
		$itemAmount = new BasicAmountType($currencyCode, $this->input->_request('money'));
		$itemTotalValue = $this->input->_request('money') * 1;
		$taxTotalValue = $this->input->_request('money') * 0;
		$amount = $orderTotalValue = $itemTotalValue + $taxTotalValue;
		$itemDetails = new PaymentDetailsItemType();
		$itemDetails->Name = 'Account Credits';//$this->input->_request('name');
		$itemDetails->Amount = $itemAmount;

		$itemDetails->Quantity = 1;
		$itemDetails->ItemCategory = 'Physical';
		$itemDetails->Description = $desc;
		//$itemDetails->Tax = new BasicAmountType($currencyCode, $this->input->_request('amount') * 0.01);

		$PaymentDetails = new PaymentDetailsType();
		$PaymentDetails->PaymentDetailsItem[0] = $itemDetails;
		
		//$PaymentDetails->ShipToAddress = $address;
		$PaymentDetails->ItemTotal = new BasicAmountType($currencyCode, $itemTotalValue);
		$PaymentDetails->OrderTotal = new BasicAmountType($currencyCode, $orderTotalValue);
		//$PaymentDetails->TaxTotal = new BasicAmountType($currencyCode, $taxTotalValue);
		$PaymentDetails->PaymentAction = 'Sale';
		$PaymentDetails->NotifyURL = $ipn_url;
		$PaymentDetails->OrderDescription = 'OrderDescription';
		
		$setECReqDetails = new SetExpressCheckoutRequestDetailsType();
		$setECReqDetails->PaymentDetails[0] = $PaymentDetails;
		$setECReqDetails->CancelURL = $cancelUrl;
		$setECReqDetails->ReturnURL = $returnUrl;
		
		$setECReqDetails->NoShipping = 1;
		
		$billingAgreementDetails = new BillingAgreementDetailsType('None');
		$billingAgreementDetails->BillingAgreementDescription = $desc;
		$setECReqDetails->BillingAgreementDetails = array($billingAgreementDetails);

		$setECReqDetails->AllowNote = 1;
		
		//$setECReqDetails->NoteText = 'this is cbt note';
		
		$setECReqType = new SetExpressCheckoutRequestType();
		$setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;
		$setECReq = new SetExpressCheckoutReq();
		$setECReq->SetExpressCheckoutRequest = $setECReqType;

		$paypalService = new PayPalAPIInterfaceServiceService();
		
		try {
			/* wrap API method calls on the service object with a try catch */
			$setECResponse = $paypalService->SetExpressCheckout($setECReq);
		} catch (Exception $ex) {
			echo '<pre>';
			print_r($ex);
			//var_dump($ex);
			exit;
		}

		
		if(isset($setECResponse)) {
			if($setECResponse->Ack =='Success') {
				$token = $setECResponse->Token;
				//$token = $response->payKey;
				if(!$token){
					//var_dump($response->error[0]);
					echo $error =  $setECResponse->error[0]->message;
				}
				else {
					$payPalURL = PAYPAL_REDIRECT_URL . '_express-checkout&token=' . $token;
					$this->load->model('pay_model');
					$pay = array();
					$pay['uid'] = $this->session->userdata('uid');
					if($pay['uid'] < 1){
						echo $error =  'You must login first.';
						exit;
					}
					
							////TECHNO-VIPLOVE added below code for affiliate////////
					/*$uid = $this->session->userdata('uid');
					$getrow = "select uid from pay where uid = {$uid}";
					$queryget = $this->db->query($getrow);	
					if ($queryget->num_rows() >= 0) 
					{
						$sqlrefid = "select refid from user where id = {$uid}";
						$queryrefid = $this->db->query($sqlrefid);
						$resultrefid = $queryrefid->result_array();
						$ref_id = $resultrefid[0]['refid'];

						$sqlrole = "select roleId from user where id = {$ref_id}";
						$queryrole = $this->db->query($sqlrole);
						$resultrole = $queryrole->result_array();
						$role_id = $resultrole[0]['roleId'];
						  
						//print_r($role_id);die;
						  
						if($role_id <=3)
						{			
							$sqlpercentage = "select value from config where id = 7";
							$querypercentage = $this->db->query($sqlpercentage);
							$resultpercentage = $querypercentage->result_array();
							$percentage = $resultpercentage[0]['value'];
							$fee =  $amount*($percentage/100);
						}

						if($role_id ==4)
						{			
							$sqlpercentage = "select value from config where id = 8";
							$querypercentage = $this->db->query($sqlpercentage);
							$resultpercentage = $querypercentage->result_array();
							$percentage = $resultpercentage[0]['value'];
							$fee =  $amount*($percentage/100);
						}

						if($role_id ==5)
						{			
							$sqlpercentage = "select value from config where id = 6";
							$querypercentage = $this->db->query($sqlpercentage);
							$resultpercentage = $querypercentage->result_array();
							$percentage = $resultpercentage[0]['value'];
							$fee =  $amount*($percentage/100);
						}
						$sql = "insert into affiliate (`refid`,`sid`,`purchaseamount`,`amount`,`createAt`) values ({$ref_id},{$uid},'{$amount}','{$fee}',NOW())";
						$query = $this->db->query($sql);
					}*/
				////TECHNO-VIPLOVE added above code for affiliate////////
					
					//$pay['money'] = $amount;
					$pay['money'] = '0';
					$pay['level'] = $level;
					$pay['status'] = false;
					$pay['token'] = $token;
					$pay['month'] = $month;
					$this->pay_model->save($pay);
					header('location:'.$payPalURL);
				}
				
			}
			else{
				echo $setECResponse->Errors[0]->LongMessage;;
				var_dump($setECResponse);
			}
		}
	}
	public function pay_by_paypal() {
		$path = 'paypal1/lib';
		set_include_path(get_include_path() . PATH_SEPARATOR . FCPATH . $path);

		define('PAYPAL_REDIRECT_URL', 'https://www.paypal.com/webscr&cmd=');
		define('DEVELOPER_PORTAL', 'https://developer.paypal.com');
		require_once('services/AdaptivePayments/AdaptivePaymentsService.php');
		require_once('PPLoggingManager.php');
		$this->load->model('card_model');
    	$payId = $this->input->_request('payId');
		$pay = $this->card_model->getOne($payId);
		$paypalAccount = $pay['paypalAccount'];
		$amount = $this->input->_request('money',100);

		$logger = new PPLoggingManager('Pay');

		$receiver[0] = new Receiver();
		$receiver[0]->email = 'matjum_1353997746_biz_1358744981_biz@163.com';
		$receiver[0]->email = 'info-facilitator@thetalklist.com';
		$receiver[0]->amount = $amount;
		$receiver[0]->primary = false;
		$actionType = 'PAY';
		$cancelUrl = base_url('user/account');
		$returnUrl = base_url('user/account');
		$receiverList = new ReceiverList($receiver);
		$payRequest = new PayRequest(new RequestEnvelope("en_US"), $actionType, $cancelUrl, 'USD', $receiverList, $returnUrl);
		$ipnNotificationUrl = base_url('pay/paypal_ipn');
		$payRequest->ipnNotificationUrl = $ipnNotificationUrl ;
		$payRequest->senderEmail  = $paypalAccount;
		$payRequest->feesPayer = 'SENDER';
		$service = new AdaptivePaymentsService();
		try {
			$response = $service->Pay($payRequest);

			$token = $response->payKey;
			if(!$token){
				//var_dump($response->error[0]);
				echo $error =  $response->error[0]->message;
			}
			else {
				$payPalURL = PAYPAL_REDIRECT_URL . '_ap-payment&paykey=' . $token;
				$this->load->model('pay_model');
				$pay = array();
				$pay['uid'] = $this->session->userdata('uid');
				if($pay['uid'] < 1){
					echo $error =  'You must login first.';
					exit;
				}
				////TECHNO-VIPLOVE added below code for affiliate////////
			$uid = $this->session->userdata('uid');
			$getrow = "select uid from pay where uid = {$uid}";
		    $queryget = $this->db->query($getrow);	
           if ($queryget->num_rows() == 0) 
		   {
			$sqlrefid = "select refid from user where id = {$uid}";
		    $queryrefid = $this->db->query($sqlrefid);
		    $resultrefid = $queryrefid->result_array();
			$ref_id = $resultrefid[0]['refid'];
			
			$sqlrole = "select roleId from user where id = {$ref_id}";
		    $queryrole = $this->db->query($sqlrole);
		    $resultrole = $queryrole->result_array();
			$role_id = $resultrole[0]['roleId'];
			 
			 if($role_id <=3)
			{			
			$sqlpercentage = "select value from config where id = 7";
		    $querypercentage = $this->db->query($sqlpercentage);
		    $resultpercentage = $querypercentage->result_array();
			$percentage = $resultpercentage[0]['value'];
			$fee =  $amount*($percentage/100);
			}
			
						
			if($role_id ==4)
			{			
			$sqlpercentage = "select value from config where id = 8";
		    $querypercentage = $this->db->query($sqlpercentage);
		    $resultpercentage = $querypercentage->result_array();
			$percentage = $resultpercentage[0]['value'];
			$fee =  $amount*($percentage/100);
			}

			if($role_id ==5)
			{			
			$sqlpercentage = "select value from config where id = 6";
		    $querypercentage = $this->db->query($sqlpercentage);
		    $resultpercentage = $querypercentage->result_array();
			$percentage = $resultpercentage[0]['value'];
			$fee =  $amount*($percentage/100);
			}
			
			
			
			 
			$sql = "insert into affiliate (`refid`,`sid`,`amount`,`createAt`) values ({$ref_id},{$uid},'{$fee}',NOW())";
			$query = $this->db->query($sql);
			}
				////TECHNO-VIPLOVE added above code for affiliate////////
				$pay['money'] = $amount;
				$pay['status'] = false;
				$pay['token'] = $token;
				$this->pay_model->save($pay);
				header('location:'.$payPalURL);
			}
			//echo "<pre>";
			//var_dump($response);
		} catch(Exception $ex) {
			var_dump($ex);
			require_once 'samples/Common/Error.php';
			//exit;
		}
		$logger->log("Received payResponse:");
	}
	public function terms() {
		$article = $this->article_model->get(2);
		$this->layout->setData('article',$article);
		$this->layout->view('article/terms');
	}
}
/* End of file pay.php */
/* Location: ./application/controllers/pay.php */