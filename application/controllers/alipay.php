<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Alipay extends TL_Controller {
	var $alipayId;
	var $aliPaymoney;	//--Total amount
	var $testMode 		= false;
	var $alipay_config 	= array();
	var $pay 			= array();
	var $payInfo 		= array();
	var $creditA;
	var $amount;
	var $desc;
	var $token;

	public function __construct() {
		@session_start();
		parent::__construct();
		$this->load->model(array('profile_model','pay_model'));
		//--Set configuration variables for alipay api request
		$this->alipay_config = array(
			'partner' 			=> "2088901505517595",
			'key' 				=> 'sf1ttlbnwah0y1h8g83pdpo55i4ybw9t',
			'seller_email' 		=> 'aabeyta@thetalklist.com',
			'return_url'		=>	base_url('alipay/actionReturnAlipay'),  
			'notify_url'		=>	base_url('alipay/actionNotifyAlipay')
		);
		//--include all libraries related to alipay api
		require_once(FCPATH.'/alipay/vendor/alipay/APBootStrap.php');
		
		$this->alipayId 		= $this->input->_request('alipayId');
		$this->aliPaymoney 		= $this->input->_request('aliPaymoney');
		$roleId 		= $this->session->userdata('roleId');
		$this->token 	= 'EZ-345ef534sg46'.$roleId;
	}

	public function index(){
		$this->_config['charset'] = 'utf-8';
		$this->pay_by_alipay();
	}

	//--Initiate api request	
	public function pay_by_alipay(){
		//echo '<pre>';print_r($_POST);exit;
		$this->amount = $this->aliPaymoney;
		//--Set Amount and Month/Creadit
		$roleId 		= $this->session->userdata('roleId');
		$this->creditA 	= 1;
		//---For Student
		if($roleId == 0){
			if($this->amount == 300){$this->creditA = 310; }
			else if($this->amount == 500){$this->creditA = 520; }
			else if($this->amount == 1000){$this->creditA = 1030; }
			else if($this->amount == 100){$this->creditA = 100; }
			else if($this->amount == 30){$this->creditA = 25; }
			else{$this->creditA = $amount;}
			$this->desc = $creditA . ' Credits on TheTalklist';
		//---For Tutor
		}else{
			if($this->amount == 30){$this->creditA = 1; }
			else if($this->amount == 50){$this->creditA = 2; }
			else if($this->amount == 70){$this->creditA = 3; }
			$this->desc = $this->creditA . ' month Premium Tutor Membership';
		}
		//--Set Amount and Month/Creadit
		$this->pay['uid'] 		= $this->session->userdata('uid');
		$this->pay['money'] 	= $this->amount;
		//--Set Month only for Tutors
		if($roleId == 0){$this->pay['month'] 	= 0;}
		else{$this->pay['month'] 	= $this->creditA;}

		$this->pay['status'] 	= false;
		
		$_SESSION['alipayToken'] = substr(number_format(time() * rand(),0,'',''),0,10);
		$this->pay['token'] 	= $_SESSION['alipayToken'];
		//--Save pay but set the status to false
		$this->pay_model->save($this->pay);
		//exit;
		$alipay 					= new AlipayProxy();
		$request 					= new AlipayDirectRequest();		
		//$request->out_trade_no      = substr(number_format(time() * rand(),0,'',''),0,10);
		$request->out_trade_no      = $_SESSION['alipayToken'];
		$request->subject 			= "TheTalkList payment - ".$this->desc;
		$request->body 				= "Buy " . $this->aliPaymoney. "  ".$this->desc;
		$request->total_fee 		= $this->aliPaymoney;
		$request->partner 			= $this->alipay_config['partner'];
		$request->seller_email 		= $this->alipay_config['seller_email'];
		$request->return_url 		= $this->alipay_config['return_url'];
		$request->notify_url 		= $this->alipay_config['notify_url'];
		$form 						= $alipay->buildForm($request);
		echo $form;
		exit();
	}

	public function actionNotifyAlipay() {
		$alipay  = new AlipayProxy();
		if ($alipay->verifyNotify()) {
			$order_id 		= $_POST['out_trade_no'];
			$order_fee 		= $_POST['total_fee'];
			$_GET['trade_status'] = 'TRADE_SUCCESS';///--Static
			if($_POST['trade_status'] == 'TRADE_FINISHED' || $_POST['trade_status'] == 'TRADE_SUCCESS') {
				//----Charge Amount Code
				echo 'Charge Amount from user';exit;
				//----Charge Amount Code
				echo "Success";
			}else {
				echo "Success";
			}
		} else {
			echo "Fail";
			exit();
		}
	}

	public function actionReturnAlipay() {
		$alipay 		= new AlipayProxy();
		if ($alipay->verifyReturn()) {
			$order_id 		= $_GET['out_trade_no'];
			$order_fee 		= $_GET['total_fee'];
			
			$_GET['trade_status'] = 'TRADE_SUCCESS';///--Static
			if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
				//----Charge Amount Code
				//$this->payInfo = $this->pay_model->findByToken($this->token);
				$this->payInfo = $this->pay_model->findByToken($_SESSION['alipayToken']);
				$this->payInfo['status'] 		= 1;
				$this->payInfo['Payer'] 		= $payer;
				$this->payInfo['profileId'] 	= $profileId;
				$this->pay_model->update($this->payInfo);
				$this->session->set_userdata(array('payment'=>'success'));
				$this->pay_model->updateProofileMoney(@$this->payInfo['money']);
				unset($_SESSION['alipayToken']);
				header('location:'.base_url('user/account'));
				//----Charge Amount Code					
			}else {
				echo "trade_status=".$_GET['trade_status'];
			}
		} else {
			echo "fail";
			exit();
		}
	}
}
/* End of file alipay.php */
/* Location: ./application/controllers/alipay.php */