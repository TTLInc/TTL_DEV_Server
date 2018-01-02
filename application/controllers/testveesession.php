<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testveesession extends TL_Controller {
	
	public $multi_lang;
	public function __construct() {
		parent::__construct();
		$this->load->model(array('lookup_model'));
		if(!isset($_SESSION)) {
			 session_start();
		}
		if(isset($_SESSION['multi_lang'])){
			$this->multi_lang = $_SESSION['multi_lang'];
		}else{
			$this->multi_lang = 'en';	
		}
	}
	private function not_login_out_json(){
		$username = $this->session->userdata('username');
		if($username == false) {
			echo json_encode(array('error'=>1,'msg'=>'Must login first.'));
			exit;
		}else {
			return true;
		}
	}
	public function testVeeSession(){
	
		$apiKey = $data['apiKey'] = '21029512' ;
		$api_secret = "ea40167d9c3b010598d37be3565276b2e1b2c488";
		$this->load->model(array('testveesession_model'));
		$uid = $this->session->userdata('uid');//$_SESSION['uid'];
		
		$data['sessionId'] = '' ;
		$data['token'] = '' ;
		$data['endTime']= 100000;		
		$data['user'] = array();
		$data['uid'] = $uid;
		$this->load->model(array('profile_model','user_model','tresources_model'));
		$userModel =  $this->user_model;
		if($uid=='')
		{
			$data['uid'] = 0;
		//echo "here";die();
		$this->load->model('Tool_model');
				$gImages = array();
		$gLangs = $this->Tool_model->getLangs();
		$this->layout->setLayout('none');
		$this->layout->setData('gImages',$gImages);
		$this->layout->setData('gLangs',$gLangs);
		$rtype='T';
		$testScenario=$this->testveesession_model->GetTestScenario($rtype);
		$cat=$this->tresources_model->GetCatagory(); 
		$this->layout->setData('testScenario',$testScenario);		
		$this->layout->setData('cat',$cat);
		$this->layout->view('classroom/testVeeSession',$data);
		}
		else
		{ 
		//$islogin = $userModel->islogin();
		/*if(!$islogin){
			redirect('user/login');
		//$this->layout->view('classroom/testVeeSession',$data);
		}*/
		$userInfo = $this->profile_model->getProfile($uid);
		
		$users['ts'] = array('pic'=>$userInfo['pic'],'name'=>$userInfo['firstName'].' '.$userInfo['lastName'],'uid'=>$userInfo['id']);
		$user  = $users['ts'];
		
		//$testClass = $this->testveesession_model->getMySessionId($data['uid'],$apiKey,$api_secret);
		
		//$sessionId = $testClass['session_id'];
		/*$this->load->library('OpenTokSDK',array('api_key'=>$apiKey,'api_secret'=>$api_secret));
		if(!isset($_SESSION['test_token'] ))
			$token = $this->opentoksdk->generateToken($sessionId, RoleConstants::MODERATOR, null, md5(json_encode($users['ts'])));
		else
			$token = $_SESSION['test_token'] ;*/ 
		
		$data['user']= $user;
		$data['sessionId'] = $sessionId ;
		$data['token'] = $token ;
		$this->load->model('Tool_model');
		$gImages = array();
		$gLangs = $this->Tool_model->getLangs();
		$this->layout->setLayout('none');
		$this->layout->setData('gImages',$gImages);
		$this->layout->setData('gLangs',$gLangs);
		//echo "<pre>";print_r($gLangs);die();
		$Type=$this->session->userdata('roleId');
		if($Type==0)
		{
			$rtype='S';
		}
		else{$rtype='T';}
		
		$lang=$_SESSION['multi_lang'];
		$testScenario=$this->testveesession_model->GetTestScenario($lang);
		 //echo "<pre>"; print_r($testScenario);die;
		$cat=$this->tresources_model->GetCatagory(); 		
		$this->layout->setData('testScenario',$testScenario);
		$this->layout->setData('cat',$cat);
		
		$this->layout->view('classroom/testVeeSession',$data);
		/*
		$testScenario=$this->testveesession_model->GetTestScenario($rtype);
		$this->layout->setData('testScenario',$testScenario);
		$this->layout->view('classroom/testVeeSession',$data);*/
		}
	}
	
	///////////viplove testvsession start/////
	public function testVeeSessionv(){
		$apiKey = $data['apiKey'] = '21029512' ;
		$api_secret = "ea40167d9c3b010598d37be3565276b2e1b2c488";
		$this->load->model(array('testveesession_model'));
		$uid = $this->session->userdata('uid');//$_SESSION['uid'];
		$data['sessionId'] = '' ;
		$data['token'] = '' ;
		$data['endTime']= 100000;		
		$data['user'] = array();
		$data['uid'] = $uid;
		$this->load->model(array('profile_model','user_model'));
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin){
			redirect('user/login');
		}
		$userInfo = $this->profile_model->getProfile($uid);
		$users['ts'] = array('pic'=>$userInfo['pic'],'name'=>$userInfo['firstName'].' '.$userInfo['lastName'],'uid'=>$userInfo['id']);
		$user  = $users['ts'];
		$testClass = $this->testveesession_model->getMySessionId($data['uid'],$apiKey,$api_secret);
		$sessionId = $testClass['session_id'];
		$this->load->library('OpenTokSDK',array('api_key'=>$apiKey,'api_secret'=>$api_secret));
		if(!isset($_SESSION['test_token'] ))
			$token = $this->opentoksdk->generateToken($sessionId, RoleConstants::MODERATOR, null, md5(json_encode($users['ts'])));
		else
			$token = $_SESSION['test_token'] ;
		
		$data['user']= $user;
		$data['sessionId'] = $sessionId ;
		$data['token'] = $token ;
		$this->load->model('Tool_model');
		$gImages = array();
		$gLangs = $this->Tool_model->getLangs();
		$this->layout->setLayout('none');
		$this->layout->setData('gImages',$gImages);
		$this->layout->setData('gLangs',$gLangs);
		$this->layout->view('classroom/testVeeSessionv',$data);
	}
	///////////End  testvsession//////
	
	public function testVee(){
		$apiKey = $data['apiKey'] = '21029512' ;
		$api_secret = "ea40167d9c3b010598d37be3565276b2e1b2c488";
		$this->load->model(array('testveesession_model'));
		$uid = $this->session->userdata('uid');//$_SESSION['uid'];
		$data['sessionId'] = '' ;
		$data['token'] = '' ;
		$data['endTime']= 100000;		
		$data['user'] = array();
		$data['uid'] = $uid;
		$this->load->model(array('profile_model','user_model'));
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin){
			redirect('user/login');
		}
		$userInfo = $this->profile_model->getProfile($uid);
		$users['ts'] = array('pic'=>$userInfo['pic'],'name'=>$userInfo['firstName'].' '.$userInfo['lastName'],'uid'=>$userInfo['id']);
		$user  = $users['ts'];
		$testClass = $this->testveesession_model->getMySessionId($data['uid'],$apiKey,$api_secret);
		$sessionId = $testClass['session_id'];
		$this->load->library('OpenTokSDK',array('api_key'=>$apiKey,'api_secret'=>$api_secret));
		if(!isset($_SESSION['test_token'] ))
			$token = $this->opentoksdk->generateToken($sessionId, RoleConstants::MODERATOR, null, md5(json_encode($users['ts'])));
		else
			$token = $_SESSION['test_token'] ;
		
		$data['user']= $user;
		$data['sessionId'] = $sessionId ;
		$data['token'] = $token ;
		$this->load->model('Tool_model');
		$gImages = array();
		$gLangs = $this->Tool_model->getLangs();
		$this->layout->setLayout('none');
		$this->layout->setData('gImages',$gImages);
		$this->layout->setData('gLangs',$gLangs);
		$this->layout->view('classroom/testVee',$data);
	}
	
	
	public function feedback(){
		$this->not_login_out_json();
		$data = $this->input->post();
		$this->load->model('class_model');
		if($data['cid'] == '') {
			$result['error'] = 1;
			$result['msg'] = 'Invaid post.';
		}else {
			$class = $this->class_model->getByCid($data['cid']);
			if($class['sid']!=$this->session->userdata('uid')) {
				$result['error'] = 1;
				$result['msg'] = 'Invaid post.';
			}else{
				$data['callId'] = $data['cid'];
				unset($data['cid']);
				unset($data['localTimeZone']);
				if($data['sendToAdmin'] && $data['sendToAdmin']==1){
					$this->load->model('user_model');
					$ownUser = $this->user_model->getByUid($this->session->userdata('uid'));
					$toUser = $this->user_model->getByUid($class['tid']);
					$toEmail = 'moderator@thetalklist.com';
					$this->load->library('email');
	                $this->email->mailtype = 'html';
	                $this->email->from($ownUser['email'],$ownUser['username']);
	                $this->email->to( $toEmail );
	                $this->email->subject("The feedback from {$ownUser['username']} to {$toUser['username']}");
	                $message = 'Student '.$ownUser['username'].' has reported inappropriate behavior for their Vee-session with Tutor '.$toUser['username'].' that was conducted at 2013-01-21 23:00:00 UTC time';
	                $message .= "\r\n";
	                $message .= "<br/>";
	                $message .= $data['msg'];
	                $this->email->message($message);
	                $this->email->send();
				}
				unset($data['sendToAdmin']);
				$data['callerId'] = $class['tid'];
				$data['receiverId'] = $class['sid'];
				$data['create_at'] = date('Y-m-d H:i:s');
				$result = $this->class_model->feedback($data);
				$result['error'] = 0;
			}
		}
		echo json_encode($result);
		exit;
	}
	public function translate(){
		$this->not_login_out_json();
		$q = $this->input->_request('q');
		$from = $this->input->_request('from');
		$to = $this->input->_request('to');
		$this->load->model('Tool_model');
		$gTranslate = $this->Tool_model->gTranslate($q,$to,$from);
		$data['error'] = 0;
		$data['rows'] = $gTranslate;
		echo json_encode($data);
		exit;
		$this->view('classroom/translate');
	}
	public function cancel(){
		$cid = $this->input->_request('cid');
		$this->load->model(array('chat_model','class_model'));
		$class = $this->class_model->getNearClassById($cid);
		if(!$class){
		}else{
			$data['uid'] = $this->session->userdata('uid');
			if($data['uid'] != $class['tid'] && $data['uid'] != $class['sid']){
			}else{
				if($data['uid'] == $class['tid']){
					$user['otherName'] = $class['sf'];
				}else{					
					$user['otherName'] = $class['tf'];
				}
				$data['msg'] = 'Due to technical difficulties, '.$user['otherName'].' has chosen to cancel this session.  Please Beep a message to  '.$user['otherName'].' if you want to clarify or reschedule.';
				$data['classId'] = $cid;
				$this->chat_model->save($data);
				$this->class_model->delById($cid,$data['uid']);
			}
		}//exit;
		header('location:'.base_url('user/calendar'));
	}
	public function wiki(){
		$this->layout->view('classroom/wiki');
	}
	public function dictionary(){
		$this->layout->view('classroom/dictionary');
	}
	public function images(){
		$this->not_login_out_json();
		$q = $this->input->_request('q');
		$query = str_replace(' ','_',$q);
		
		$sURL = "https://api.cognitive.microsoft.com/bing/v5.0/images/search?q='".$query."'&count=25&mkt=en-US";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $sURL); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: multipart/form-data',
            'Ocp-Apim-Subscription-Key: 897a371fbb314391b5cbf18eed75c199'
        ));
        $contents = curl_exec($ch);
        $myContents = json_decode($contents);
		$data['error'] = 0;
		$data['rows'] = $myContents->value;
		echo json_encode($data);
		exit;
	/*	$this->load->model('Tool_model');
		$gImages = $this->Tool_model->getGImage($q);
		$data['error'] = 0;
		$data['rows'] = $gImages;
		echo json_encode($data);
		exit; 
		$this->layout->view('classroom/images'); */
	}
	public function chatSend(){
		$this->not_login_out_json();
		$data = $this->input->post();
		if($data['classId'] == ''){
			$error = 1;
			$msg = 'Invalid Post.';
		}else{
			$this->load->model('chat_model');
			$data['uid'] = $this->session->userdata('uid');
			$this->chat_model->save($data);
			$error = 0;
		}
		echo json_encode(compact('error','msg'));
		exit;
	}
	public function chatGet(){
		$this->not_login_out_json();
		$cid = $this->input->_request('classId');
		if($cid == ''){
			$error = 0;
			$msg = 'the ve-session is null.';
		}else {
			$time = $this->input->_request('time');
			$this->load->model('chat_model');
			$rows = $this->chat_model->getByCid($cid,$time);
			$error = 0;
		}
		echo json_encode(compact('error','msg','rows'));
		exit;
	}
	
	/*public function update(){
		$sql="select ipaddress from profile where id BETWEEN 2243 AND 2274";
		
		$query = $this->db->query($sql);
		$result = $query->result_array();	
		
		foreach($result as $k=>$v):
			//print_r($v['ipaddress']);
			//exit;
			
			$ip = $v['ipaddress'];
			$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
		
			$data = $details->country;
			
			$cname = $data;
			$sql = "Select id from countries where iso2 = '{$cname}'";
			
			$query = $this->db->query($sql);
			$cresult = $query->result_array();
			
			$cid = $cresult[0]['id'];

			$update = "Update profile set country = '{$cid}' where ipaddress = '{$ip}'";
			$updatequery = $this->db->query($update);
		endforeach;
	}*/
	
	public function usermsg(){
		$sql="select email from user where id BETWEEN 2501 AND 2700";
		
		$query = $this->db->query($sql);
		$result = $query->result_array();
		foreach($result as $k=>$v):
			$to = $v['email'];
			//$to = 'virang@technoinfonet.com';
			$str = "Dear Talk-ists.";
			$str .= "\r\n<br/>";
			$str .= "\r\n<br/>";
			$str .= "We wanted to inform you that we are performing server upgrades over the Thanksgiving Holiday. We will be back online on Friday morning USA time. Thanks for your understanding.\r\n<br/>";
			$str .= "\r\n<br/>";			
			$str .= "Thanks for being a part of our community. \r\n<br/>";
			$str .= "\r\n<br/>";		
			$str .= "TheTalkList Team";
			$this->load->library('email');
			$this->email->mailtype = 'html';
			$this->email->from('admin@thetalklist.com','TalkMaster Bluebob');
			$this->email->to($to);
			$this->email->subject('TheTalklist Updates');
			$this->email->message($str);
			$this->email->send();
			echo '<br/><br/>';
			//exit;
		endforeach;
	}
	
	
	function unconfirmed(){
	//exit;
		$this->load->model('user_model');
		$this->load->model('inbox_model');
		$this->load->model('messaging_model');
		$result = $this->user_model->GetUnconfirmedClass();

		/*
		echo "<pre>";
		print_r($result);
		exit;*/
		foreach($result as $k=>$v):
			//$to = $v['email'];
			$tid = $v['tid'];
			//$sid = $v['sid'];
			
			$stuid = $v['sid'];
			$mny = $v['fee'];
			$sql12 = "update profile set money=money+'{$mny}',frMoney=frMoney-'{$mny}' where uid='{$stuid}'";
			$query = $this->db->query($sql12);
			//$Name = $v['firstName'].' '.$v['lastName'];
			$Name = $v['firstName'].''.$v['tid'];
			$date = date("Y-m-d", strtotime($v['startTime']));
			
			$namesql = "Select firstName,lastName,email from profile where uid =".$stuid;
			$namequery = $this->db->query($namesql);
			$nameresult = $namequery->result_array();
//print_r($nameresult);
			//$studentName = $nameresult[0]['firstName'].' '.$nameresult[0]['lastName'];
			$studentName = $nameresult[0]['firstName'].''.$stuid;

			$newslettertemplate = array();
			
			$ns = $this->messaging_model->getAllNewsletter();
			$newslettertemplate['n10'] = $ns[0]['n10'];
			$newslettertemplate['n11'] = $ns[0]['n11'];

			$str .= str_replace('{$name}',$Name,nl2br($newslettertemplate['n10']));
			$str1 .= str_replace('{$date}',$date,$str);
			
			$sstr .= str_replace('{$name}',$studentName,nl2br($newslettertemplate['n11']));
			$sstr1 .= str_replace('{$date}',$date,$sstr);

			$subject = "Request Session Timeout";
			//-- send message to student
			$send = $this->inbox_model->send($v['sid'],1,$subject,$str1);
			
			$this->load->library('email');
			$this->email->mailtype = 'html';
			$this->email->from('admin@thetalklist.com','TheTalklist');
			//$this->email->to($user[$i]['email']);
			$this->email->to($nameresult[0]['email']);
			$this->email->subject($subject);
			$this->email->message($str1);
			//$this->email->send();

			//-- send message to tutor
			$send = $this->inbox_model->send($v['tid'],1,$subject,$sstr1);
			
			$this->email->mailtype = 'html';
			$this->email->from('admin@thetalklist.com','TheTalklist');
			//$this->email->to($user[$i]['email']);
			$this->email->to($v['email']);
			$this->email->subject($subject);
			$this->email->message($sstr1);
			//$this->email->send();

			
			$sql="delete from class where id=".$v['id'];
			$query = $this->db->query($sql);
			
			/* Update Transaction Entry By Ilyas */		
			
			/* change made by haren */
		 	$sttime=$v['startTime'];
			$endtime=$v['endTime'];
			$tid=$v['tid'];
			$sid=$v['sid'];
			$sql = "delete from `timeSlot` where uid='$tid' and `stid` = '$sid' and startTime='$sttime' AND endTime='$endtime'";
			$query = $this->db->query($sql);			 
			/* end */
			
			$result = $this->user_model->fnSelectTransaction("id",array('ref_table'=>'class','ref_id'=>$v['id']));
			foreach ($result as $row)
			{
				$nw = date("Y-m-d H:i:s");
				$this->user_model->fnUpdateTransaction(array("payment_status"=>"Refund","payment_date"=>$nw,"status"=>"Deleted","status_comment"=>"Request Session Timeout, Deleted by Cron"),array('ref_table'=>'class','ref_id'=>$v['id']));
				$this->user_model->fnUpdateTransaction(array("payment_status"=>"None","payment_date"=>$nw,"status"=>"Deleted","status_comment"=>"Request Session Timeout, Deleted by Cron"),array('inner_rel_id'=>$row->id));
			}
			/* End */
		endforeach;
		exit;
		/*if(count($Session)>0)
		{
			$subject='Request Session Timeout';
			for($i=0;$i<count($Session);$i++)
			{
				
				//$sql="delete from class where id='{$Session[$i]['id']}'";
				//$query = $this->db->query($sql);
				$stuid=$Session[$i]['sid'];
				$mny=$Session[$i]['fee'];
				$sql12="update profile set money=money+'{$mny}',frMoney=frMoney-'{$mny}' where uid='{$stuid}'";
				$query = $this->db->query($sql12);
				$Name=$Session[$i]['firstName'].'  '.$Session[$i]['lastName'];
				$date=date("Y-m-d", strtotime($Session[$i]['startTime']));
				$str .= str_replace('{$name}',$Name,nl2br($newslettertemplate['n10']));
				$str1 .= str_replace('{$date}',$date,$str);
				$sql="select email from profile where uid={$Session[$i]['sid']}";
				$query = $this->db->query($sql);
				$result = $query->row_array();
				//$send = $this->inbox_model->send($Session[$i]['sid'],1,$subject,$str1);
				$this->load->library('email');
				$this->email->mailtype = 'html';
				$this->email->from('admin@thetalklist.com','TheTalklist');
				//$this->email->to($user[$i]['email']);
				$this->email->to('virang@technoinfonet.com');
				$this->email->subject($subject);
				$this->email->message($str1);
				$this->email->send();
				$str='';
				$str1='';
			}
		}*/
	}
	
	function video(){
		$this->layout->view('video/index');
	}
	
	public function getDynamicscenario()
	{
		$this->load->model('testveesession_model');
		$lang=$_POST['lang'];
		$cat=$_POST['cat'];
		$Alldata=$this->testveesession_model->Getdynamicscenario($lang,$cat);
		
		echo json_encode($Alldata);
		die();
	}
}
/* End of file testveesession.php */
/* Location: ./application/controllers/testveesession.php */