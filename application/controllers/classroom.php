<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classroom extends TL_Controller {
	
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
	return true;
		$username = $this->session->userdata('username');
		if($username == false) {
			echo json_encode(array('error'=>1,'msg'=>'Must login first.'));
			exit;
		}else {
			return true;
		}
	}
	public function index(){
		
		//$apiKey = $data['apiKey'] = '21029512' ;
		//$api_secret = "ea40167d9c3b010598d37be3565276b2e1b2c488";
		
		$apiKey = $data['apiKey'] = '23275932' ;
		$api_secret = "b5aa20702348f20f74465950ead140ccbd4f770c";

		$this->load->model(array('class_model','user_model'));
		$uid = $this->session->userdata('uid');//$_SESSION['uid'];
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin){
			redirect('user/login');
		}
		$data['sessionId'] = '' ;
		$data['token'] = '' ;
		$data['_startTime'] = 100000;
		$data['_endTime']= 100000;
		$data['user'] = array();
		$data['uid'] = $uid;
		$data['cid'] = $this->input->_request('cid');
		$data['feedback'] = false;

		if($data['cid'] < 1){
			$class = $this->class_model->getNearClassByUid($uid);
		}else{
			$class = $this->class_model->getNearClassById($data['cid']);
		}
		if(!empty($class)){
			$feedback = $this->class_model->getFeedbackByCid($class['id']);
			if(isset($feedback['callId'])) {
				$data['feedback'] = true;;
			}
			$this->load->library('OpenTokSDK',array('api_key'=>$apiKey,'api_secret'=>$api_secret));
			$users['t'] = array('pic'=>$class['tp'],'name'=>$class['tf'],'uid'=>$class['tid']);
			$users['s'] = array('pic'=>$class['sp'],'name'=>$class['sf'],'uid'=>$class['sid']);
			if($class['tid'] == $uid){
				$type = 'tid';
				$user = array('pic'=>$class['tp'],'name'=>$class['tf'],'uid'=>$class['tid'],'type'=>'t');
				$otherPic = $class['sp'];
				$otherName = $class['sf'].$class['sid'];
			}else if($class['sid'] == $uid){
				$type = 'sid';
				$user = array('pic'=>$class['sp'],'name'=>$class['sf'],'uid'=>$class['sid'],'type'=>'s');
				$otherPic = $class['tp'];
				$otherName = $class['tf'].$class['tid'];
			}else{
				$class['session_id'] = 'wrong';
			}
			$user['classId']=$class['id'];
			$sessionId = $this->input->_request('_sessionId');

			if(!$class['session_id'] ) {
				$session = $this->opentoksdk->createSession( $_SERVER["REMOTE_ADDR"], array(SessionPropertyConstants::P2P_PREFERENCE=> "enabled") );
				$sessionId = $session->getSessionId();
				$tokenS = $this->opentoksdk->generateToken($sessionId, RoleConstants::MODERATOR, strtotime($class['endTime']), md5(json_encode($users['s'])));
				$tokenT = $this->opentoksdk->generateToken($sessionId, RoleConstants::MODERATOR, strtotime($class['endTime']), md5(json_encode($users['t'])) );
				$this->class_model->upSession($class['id'],$sessionId,$tokenS,$tokenT);//setcookie('_sessionId',$sessionId);
				if($type == 'sid'){
					$token = $tokenS;
				}else {
					$token = $tokenT;
				}
			}else {
				$sessionId = $class['session_id'];
				if($type == 'sid'){
					$token = $class['tokenS'];
				}else {
					$token = $class['tokenT'];
				}
			}
			$startTime = strtotime($class['startTime']);
			//echo $_startTime = $startTime - time() - 60*2;
			//$_startTime = $startTime - time(); //- Date 30/04/2015 For server time
			$_startTime = $startTime;
			$_endTime = strtotime($class['endTime']) - time();
			$data['_startTime']= $_startTime;
			$data['_endTime']= $_endTime;
			$otherPic = profile_image($otherPic);
			$user['pic'] = profile_image($user['pic']);
			$user['otherPic'] = $otherPic;
			$user['otherName'] = $otherName;
			$data['user']= $user;
			$data['sessionId'] = $sessionId ;
			$data['token'] = $token ;
			$data['cid'] = $class['id'];
			// update class status to unlocked for browser close
			$lockedSession = 'locked_'.$data['cid'];
			$this->session->set_userdata($lockedSession, 'No');
			//update for student attendance history
			/*if($_startTime == -365){
				if($this->session->userdata('roleId') == 0){
					$this->class_model->updateAttendance($data['cid']);
				}
			}*/
			
		}else{}
		$this->load->model(array('Tool_model','location_model'));
		$countries= $this->location_model->getCountries();
		$country = array();
		foreach($countries as $cnt)
		{
			foreach($cnt as $key => $value)
			{
				$country[$key] = $value;
			}
		}
		$countries = $country; 
		//get action for class for process class
		$action = unserialize($class['action']);
		$this->layout->setData('action',$action);
		$gImages = array();//$this->Tool_model->getGImage();
		$gLangs = $this->Tool_model->getLangs();
		$this->layout->setLayout('none');
		$this->layout->setData('gImages',$gImages);
		$this->layout->setData('gLangs',$gLangs);
		$this->layout->setData('countries',$countries);
		
		
		//$checkdismiss = $userModel->checkdismiss($uid);

		//$this->layout->setData('checkdismiss',$checkdismiss);

		
		$clsId=$this->input->_request('cid');
		$q= "SELECT session_type from class where  id='{$clsId}'";
		$classquery = $this->db->query($q);
		$classresult = $classquery->row_array();

		if($classresult['session_type']=='free'){
			$free='y';
		}
		else{
			$free='n';
		}
		//--Test Scenario widget code start----
		
		$Type=$this->session->userdata('roleId');
		if($Type==0)
		{
			$rtype='S';
		}
		else{$rtype='T';}
		$this->load->model(array('testveesession_model','tresources_model'));
		$cat=$this->tresources_model->GetCatagory();
		$this->layout->setData('cat',$cat);
		$testScenario=$this->testveesession_model->GetTestScenario($rtype);
		$this->layout->setData('testScenario',$testScenario);
		$this->layout->view('classroom/index',$data);
	
		/* code added by haren to detect device type */
	 
		$agent = $_SERVER['HTTP_USER_AGENT'];
		
		if (preg_match("/iPhone/", $agent)) { // Apple iPhone Device
		
		} else if (preg_match("/android/", $agent)) { // Google Device using Android OS
		
		}
		/* code ended  */	
		/*
		$this->load->model(array('testveesession_model'));
		$testScenario=$this->testveesession_model->GetTestScenario($rtype);
		$this->layout->setData('testScenario',$testScenario);
		//--Test Scenario widget code end----
		
		$this->layout->view('classroom/index',$data);*/
	}
	
	public function checkSession(){
		$apiKey = $data['apiKey'] = '21029512' ;
		$api_secret = "ea40167d9c3b010598d37be3565276b2e1b2c488";
		$this->load->model(array('class_model','user_model'));
		$uid = $this->session->userdata('uid');//$_SESSION['uid'];
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin){
			redirect('user/login');
		}
		$data['sessionId'] = '' ;
		$data['token'] = '' ;
		$data['_startTime'] = 100000;
		$data['_endTime']= 100000;
		$data['user'] = array();
		$data['uid'] = $uid;
		$data['cid'] = $this->input->_request('cid');
		$data['feedback'] = false;
		if($data['cid'] < 1){
			$class = $this->class_model->getNearClassByUid($uid);
		}else{
			$class = $this->class_model->getNearClassById($data['cid']);
		}
		if(!empty($class)){
			$feedback = $this->class_model->getFeedbackByCid($class['id']);
			if(isset($feedback['callId'])) {
				$data['feedback'] = true;;
			}
			$this->load->library('OpenTokSDK',array('api_key'=>$apiKey,'api_secret'=>$api_secret));
			$users['t'] = array('pic'=>$class['tp'],'name'=>$class['tf'],'uid'=>$class['tid']);
			$users['s'] = array('pic'=>$class['sp'],'name'=>$class['sf'],'uid'=>$class['sid']);
			if($class['tid'] == $uid){
				$type = 'tid';
				$user = array('pic'=>$class['tp'],'name'=>$class['tf'],'uid'=>$class['tid'],'type'=>'t');
				$otherPic = $class['sp'];
				$otherName = $class['sf'];
			}else if($class['sid'] == $uid){
				$type = 'sid';
				$user = array('pic'=>$class['sp'],'name'=>$class['sf'],'uid'=>$class['sid'],'type'=>'s');
				$otherPic = $class['tp'];
				$otherName = $class['tf'];
			}else{
				$class['session_id'] = 'wrong';
			}
			$user['classId']=$class['id'];
			$sessionId = $this->input->_request('_sessionId');
			if(!$class['session_id'] ) {
				$session = $this->opentoksdk->createSession( $_SERVER["REMOTE_ADDR"], array(SessionPropertyConstants::P2P_PREFERENCE=> "enabled") );
				$sessionId = $session->getSessionId();
				$tokenS = $this->opentoksdk->generateToken($sessionId, RoleConstants::MODERATOR, strtotime($class['endTime']), md5(json_encode($users['s'])));
				$tokenT = $this->opentoksdk->generateToken($sessionId, RoleConstants::MODERATOR, strtotime($class['endTime']), md5(json_encode($users['t'])) );
				$this->class_model->upSession($class['id'],$sessionId,$tokenS,$tokenT);//setcookie('_sessionId',$sessionId);
				if($type == 'sid'){
					$token = $tokenS;
				}else {
					$token = $tokenT;
				}
			}else {
				$sessionId = $class['session_id'];
				if($type == 'sid'){
					$token = $class['tokenS'];
				}else {
					$token = $class['tokenT'];
				}
			}
			$startTime = strtotime($class['startTime']);
			//echo $_startTime = $startTime - time() - 60*2;
			$_startTime = $startTime;
			$_endTime = strtotime($class['endTime']) - time();
			$data['_startTime']= $_startTime;
			$data['_endTime']= $_endTime;
			$otherPic = profile_image($otherPic);
			$user['pic'] = profile_image($user['pic']);
			$user['otherPic'] = $otherPic;
			$user['otherName'] = $otherName;
			$data['user']= $user;
			$data['sessionId'] = $sessionId ;
			$data['token'] = $token ;
			$data['cid'] = $class['id'];
			// update class status to unlocked for browser close
			$lockedSession = 'locked_'.$data['cid'];
			$this->session->set_userdata($lockedSession, 'No');
			//update for student attendance history
			if($this->session->userdata('roleId') == 0){
				$this->class_model->updateAttendance($data['cid']);
			}
		}else{}
		$this->load->model(array('Tool_model','location_model'));
		$countries= $this->location_model->getCountries();
		$country = array();
		foreach($countries as $cnt)
		{
			foreach($cnt as $key => $value)
			{
				$country[$key] = $value;
			}
		}
		$countries = $country; 
		//get action for class for process class
		$action = unserialize($class['action']);
		$this->layout->setData('action',$action);
		$gImages = array();//$this->Tool_model->getGImage();
		$gLangs = $this->Tool_model->getLangs();
		$this->layout->setLayout('none');
		$this->layout->setData('gImages',$gImages);
		$this->layout->setData('gLangs',$gLangs);
		$this->layout->setData('countries',$countries);
		$this->layout->view('classroom/checkSession',$data);
	}
	
	public function feedback(){
		$this->not_login_out_json();
		$data = $this->input->post();
		$this->load->model('class_model');
		$this->load->model('pay_model');
		if($data['cid'] == '') {
			$result['error'] = 1;
			$result['msg'] = 'Invalid post.';
		}
		else {
			$class = $this->class_model->getByCid($data['cid']);
			// techno-sanjay 13 aug 2013 update tutor fees
			/*$updatedclassfee = number_format($class['fee'] / 1.33, 2);
			$this->class_model->update_tutor_fee($class['tid'],$updatedclassfee);*/
			if($class['sid']!=$this->session->userdata('uid')) {
				$result['error'] = 1;
				$result['msg'] = 'Invalid post.';
			}
			else{
				$data['callId'] = $data['cid'];
				unset($data['cid']);
				unset($data['localTimeZone']);
				if($data['sendToAdmin'] && $data['sendToAdmin']==1){
					$this->load->model('user_model');
					$ownUser = $this->user_model->getByUid($this->session->userdata('uid'));
					$toUser = $this->user_model->getByUid($class['tid']);
					$ownname = $this->user_model->getnameByUid($this->session->userdata('uid'));
					$toname = $this->user_model->getnameByUid($class['tid']);
					$toEmail = 'support@thetalklist.com';
					$this->load->library('email');
	                $this->email->mailtype = 'html';
	                $this->email->from($ownUser['email'],$ownUser['username']);
	                $this->email->to( $toEmail );
	                $this->email->subject("The feedback from {$ownUser['username']} to {$toUser['username']}");
	                //$message = 'Student '.$ownUser['username'].' has reported inappropriate behavior for their Vee-session with Tutor '.$toUser['username'].' that was conducted at 2013-01-21 23:00:00 UTC time';
					$message = $ownname['firstName'].' '.$ownname['lastName'].' student reports inappropriate behaviour with '.$toname['firstName'].' '.$toname['lastName'].' tutor on '.$class['startTime'];
	                $message .= "\r\n";
	                $message .= "<br/>";
	                $message .= $data['msg'];
	                $this->email->message($message);
	                $this->email->send();
	                //techno-sanjay added for disputes 12 Aug 2013
	                $this->pay_model->update_disputes($class['tid'],$class['sid']);
					//techno-sanjay added for inappropriate content disputes update on user
					$dpup['disputes'] = 1;
					$this->user_model->user_edit($dpup,$class['tid']);
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
		if(!$class){}
		else{
			$data['uid'] = $this->session->userdata('uid');
			if($data['uid'] != $class['tid'] && $data['uid'] != $class['sid']){
			}else{
				if($data['uid'] == $class['tid']){
					$user['otherName'] = $class['tf'];
				}else{
					$user['otherName'] = $class['sf'];
				}
				if($class['startTime'] < time() + 60*5 +10){
					if($this->session->userdata('roleId') == 0){						
						$data['msg'] = 'Due to technical difficulties, '.$user['otherName'].' has chosen to cancel this session within the grace period. Therefore this will not qualify as a paid session. Please beep a message to '.$user['otherName'].' if you want to clarify or reschedule.';
					}else{
						$data['msg'] = 'Due to technical difficulties, '.$user['otherName'].' has chosen to cancel this session early. The good news is that your credits will be redeposited into your account. So please schedule again on a better connection.';
					}
				}else{
					$data['msg'] =  'Tutor has elected to end the session early.  Your account will be refunded.';
				}
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
		
		$sURL = "https://api.cognitive.microsoft.com/bing/v7.0/images/search?q='".$query."'&count=25&mkt=en-US";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $sURL); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: multipart/form-data',
            'Ocp-Apim-Subscription-Key: 5a53bdaa157b412793025b25ab1ed3f9'
        ));
        $contents = curl_exec($ch);
		$myContents = json_decode($contents);
		$data['error'] = 0;
		$data['rows'] = $myContents->value;
		echo json_encode($data);
		exit;
       
		/*
		if(count($myContents->value) > 0) {
            foreach ($myContents->value as $imageContent) { 
				echo $imageContent->thumbnailUrl;
		}
        }
		exit;
		
		$this->load->model('Tool_model');
		$gImages = $this->Tool_model->getGImage($q);
		
		$data['error'] = 0;
		$data['rows'] = $gImages;
		echo json_encode($data);
		exit;
		$this->layout->view('classroom/images');
	}
	
	public function attend(){
		$this->load->model(array('class_model'));
		$data = $this->input->post();
		$this->class_model->updateAttendance($data['cid']);
		/*$this->refund($data['cid']);
		$error = 0;
		echo json_encode(compact('error'));*/
		exit;
	}
	
	public function tutorearlyleave(){
		$this->load->model(array('class_model'));
		$data = $this->input->post();
		$this->class_model->tutorearlyleave($data['cid']);		
		$ClsId=$data['cid'];
		$ClassInfo = $this->class_model->GetClassDetail($ClsId);
		if($ClassInfo !=array())
		{
			$studId=$ClassInfo['sid'];
			$sql = "update user set is_eligible=1 where id='".$studId."'";
			$this->db->query($sql);
		}
		$this->refund($data['cid']);
		$error = 0;
		echo json_encode(compact('error'));
		exit;
	}
	
	public function studentattend(){
		$data = $this->input->post();
		$sql1 = "update disputes set is_completed = 1 where cid = ".$data['cid'];
		$query1 = $this->db->query($sql1);
		/* Added by Ilyas */
		$this->load->model(array('class_model'));
		$ClsId=$data['cid'];
		$ClassInfo = $this->class_model->GetClassDetail($ClsId);
		if($ClassInfo !=array())
		{
			$studId=$ClassInfo['sid'];
			
			if(strtolower($ClassInfo['session_type'])=='free')
			{
				$sql = "update user set is_eligible=0 where id='".$studId."'";
				$this->db->query($sql);
			}
		}
		/* end */
		//$this->class_model->updateStudentAttendance($data['cid']);
		exit;
	}

	
	public function updatefree(){
		
		$data = $this->input->post();
		//$sql1 = "update disputes set is_completed = 1 where cid = ".$data['cid'];
		//$data['cid'] = '3554';
		$getusersql = "select sid from class where id=".$data['cid'];
		
		$getuserquery = $this->db->query($getusersql);
		$getuserresult = $getuserquery->row_array();
		//print_r($getuserresult['sid']);
		//exit;
		$sql1 = "update profile set free_session='y' where uid = ".$getuserresult['sid'];
		$query1 = $this->db->query($sql1);

		//$this->class_model->updateStudentAttendance($data['cid']);
		exit;
	}
	
	public function UpdateDisp()
	{
		$data = $this->input->post();
		$sql1 = "update disputes set is_completed = 1 where cid = {$data['cid']}";
		$query = $this->db->query($sql1);
		
		/* Added by Ilyas */
		$this->load->model(array('class_model'));
		$ClsId=$data['cid'];
		$ClassInfo = $this->class_model->GetClassDetail($ClsId);
		if($ClassInfo !=array())
		{
			$studId=$ClassInfo['sid'];
			if(strtolower($ClassInfo['session_type'])=='free')
			{
				$sql = "update user set is_eligible=0 where id='".$studId."'";
				$this->db->query($sql);
			}
		}
		/* end */
		exit;
	}

	
	public function chatSend(){
		$this->not_login_out_json();
		$data = $this->input->post();
		/*$data['classId'] = '2094';
		$data['msg'] = 'Session Approved';*/
		if($data['classId'] == ''){
			$error = 1;
			$msg = 'Invalid Post.';
		}
		else{
			$this->load->model(array('chat_model','class_model'));
			//checks for existing session approved message
			$num = 0;
			if(trim($data['msg']) == 'Session Approved'){
				$cid = $data['classId'];
				$msg1 = trim($data['msg']);
				$this->class_model->updateAttendance($cid);
				
				$sql = "select count(*) as num from chat where classId = {$cid} AND msg like '{$msg1}'";
				$query = $this->db->query($sql);
				
				$classsql = "select tid, sid, startTime from class where id = {$cid}";
				$classquery = $this->db->query($classsql);				
				$classresult = $classquery->row_array();
				//$updatedispute = "Update disputes set approve = 1 where sid = ".$classresult['sid']." AND tid =".$classresult['tid']." AND createAt = '".$classresult['startTime']."'";
				/*$updatedispute = "Update disputes set approve = 1 where cid = {$cid}";
				$updatedisputequery = $this->db->query($updatedispute);*/
				if($query->num_rows() > 0){
					$result = $query->row_array();
					$num = $result['num'];
				}
			}
			$data['uid'] = $this->session->userdata('uid');
			if($num == 0){
				$this->chat_model->save($data);
			}
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
			$msg = 'the vee-session is null.';
		}
		else {
			$time = $this->input->_request('time');
			$this->load->model(array('chat_model','class_model') );
			$class = $this->class_model->getByCid($cid); //if vee-sesson already canceled
			if(!$class){
				$isCanceled = true;
			}else{
				$this->load->model(array('chat_model','class_model') );
				$feedback = $this->class_model->getFeedbackByCid($cid); //if vee-sesson already canceled
				if($feedback){
					$isCanceled = true;
				}else{
					$isCanceled = false;
				}
				
			}
			$rows = $this->chat_model->getByCid($cid,$time);
			$error = 0;
		}
		echo json_encode(compact('error','msg','rows','isCanceled'));
		exit;
	}
	public function updateToSessionStarted(){
		$cid = $this->input->_request('classId');
		$this->load->model(array('class_model'));
		$this->class_model->updateToSessionStarted($cid);
		$success = 1;
		$msg = "Session updated to started!";
		echo json_encode(compact('success','msg'));
		exit;
	}
	public function sendScuessEmail($fUid,$tUid,$time) {
		$sql = "SELECT user.email,user.username,profile.* from profile left join user on user.id = profile.uid WHERE (uid={$fUid} OR uid={$tUid})";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		$users = array();
		foreach ($result as $key => $value) {
			$users[$value['uid']] = $value;
		}
		$usernameFid = $users[$fUid]['firstName'].' '.$users[$fUid]['lastName'];
		$usernametUid = $users[$tUid]['firstName'].' '.$users[$tUid]['lastName'];
		$dt = date(' H:i:s Y-m-d',$time);
		$this->load->model(array('event_model','user_model'));
		$studentTimezone = $this->user_model->getLastLocalTimeZone($users[$fUid]['uid']);

		$student_session_time = $this->event_model->utc_to_local('g:i A, Y-m-d',$dt,$studentTimezone);
		if($studentTimezone == 'America/Boise'){
			$oldTime 			= time($student_session_time);
			$timeAfterOneHour 	= $oldTime+60*60*4.6;
			$student_session_time = date("h:i a",$timeAfterOneHour);
		}else{
			$student_session_time = $this->event_model->utc_to_local('g:i A, Y-m-d',$dt,$studentTimezone);
		}

		//$dateInLocal = date("g:i A, Y-m-d", $this->event_model->outTime($dt));
		$sTopic = @$_POST['sTopic'];
		$sLevel = @$_POST['sLevel'];
		// email to student as per his local requested time
		$str = "A learning Vee-session was booked by {$usernameFid} with  {$usernametUid}";
		$str .= "\r\n<br/>";
		if($this->session->userdata('free_session') == 'y'){
			$str .= "This is a new student booking their FREE session. \r\n<br/>";
		}
		$str .= "The Vee-session start time is at your local time  ". $student_session_time . " \r\n<br/>";
		$str .="{$usernameFid} is an {$sLevel} speaker and would like to talk about {$sTopic}."; 
		$str .= "If you have any problems please email the support team at:  support@thetalklist.com\r\n<br/>";
		$str .= "Thank you,           TheTalkList Support Team";
		$toStudent = $users[$fUid]['email'];
		$this->load->library('email');
		$this->email->mailtype = 'html';
		$this->email->from('no-reply@thetalklist.com','TalkMaster BlueBob');
		$this->email->to($toStudent);
		$this->email->subject('TheTalklist Veesession created.');
		$this->email->message($str);
		$this->email->send();
		// email to tutor as per his local timezone
		$tutotTimezone = $this->user_model->getLastLocalTimeZone($users[$fUid]['uid']);

		$tutor_session_time = $this->event_model->utc_to_local('g:i A, Y-m-d',$dt,$tutotTimezone);
		if($tutotTimezone == 'America/Boise'){
			$oldTime 			= time($tutor_session_time);
			$timeAfterOneHour 	= $oldTime+60*60*4.6;
			$tutor_session_time = date("h:i a",$timeAfterOneHour);
		}else{
			$tutor_session_time = $this->event_model->utc_to_local('g:i A, Y-m-d',$dt,$tutotTimezone);
		}

		//$tutor_session_time = $this->event_model->utc_to_local('g:i A, Y-m-d',$dt,$tutotTimezone);
		$str = "A learning Vee-session was booked by {$usernameFid} with  {$usernametUid}";
		$str .= "\r\n<br/>";
		if($this->session->userdata('free_session') == 'y'){
			$str .= "This is a new student booking their FREE session. \r\n<br/>";
		}
		$str .= "The Vee-session start time is at your local time  ". $tutor_session_time . " \r\n<br/>";
		$str .="{$usernameFid} is an {$sLevel} speaker and would like to talk about {$sTopic}."; 
		$str .= "If you have any problems please email the support team at:  support@thetalklist.com\r\n<br/>";
		$str .= "Thank you,           TheTalkList Support Team";
		$toTutor = $users[$tUid]['email'];
		$this->email->clear();
		$this->email->mailtype = 'html';
		$this->email->from('no-reply@thetalklist.com','TalkMaster BlueBob');
		$this->email->to($toTutor);
		$this->email->subject('TheTalklist Veesessions created.');
		$this->email->message($str);
		$this->email->send();
	}
	public function usersUpdteManipulationByClass($updatedClass){
		$this->load->model('myTeacher_model');
		$this->myTeacher_model->creatMyTeacher($updatedClass['tid'],$updatedClass['sid'],0);
		$this->session->set_userdata('free_session', 'n');
		$this->session->set_userdata('firstTime', 'n');
		$this->session->set_userdata('sessionbooked', 'y');
		$this->session->set_userdata('usermanipulation', 'y');
		$fsid = $updatedClass['sid'];
		$ftid = $updatedClass['tid'];
		$creatAt = @$updatedClass['createAt'];
		$fee  = @$updatedClass['fee'];
		$start = @$updatedClass['startTime'];
		$feeSql = "update profile set money=money-{$fee} , frMoney=frMoney+{$fee} where uid={$fsid}";
		$query = $this->db->query($feeSql);
		$this->sendScuessEmail($fsid,$ftid,strtotime($start));
		// TECHNO-SANJAY added below code new registered user to normal user
		$updateSessionSql = "UPDATE user SET free_session = 'n' ,user_firsttime = 'n' WHERE id = {$fsid}";
		$query = $this->db->query($updateSessionSql);
		$updateSessionSql1 = "UPDATE profile SET free_session = 'n' WHERE uid = {$fsid}";
		$query1 = $this->db->query($updateSessionSql1);
		//Techno-Sanjay added for disputes resolution
		$sql = "insert into disputes (`sid`,`createAt`,`tid`,`fee`,`approve`,`paymentstatus`,`postpone`) values ({$fsid},'{$creatAt}',{$ftid},{$fee},'1','Unpaid','0')";
		$query = $this->db->query($sql);
	}
	//skvirja get news feeds 
	/*public function getnewsfeed(){
		$_data = $this->input->_requestAll();
		$country = trim($_data['country']);
		$rss = new DOMDocument();
		$rssURL = "http://news.search.yahoo.com/news/rss?p=india";
		$rss->load($rssURL);
		$feed = array();
		foreach ($rss->getElementsByTagName('item') as $node) {
			$item = array (
				'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
				'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
				'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
				'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
			array_push($feed, $item);
		}
		$numberoffeeds = count($feed);
		//sort by date
		$newFeed = array();
		if($numberoffeeds > 1){
			foreach($feed as $f)
			{
				$newKey = strtotime($f['date']);
				$newFeed[$newKey] = $f;
			}
		}else{
			$newFeed = $feed;
		}
		krsort($newFeed);
		$feeds = $newFeed;
		if($numberoffeeds == '' || $numberoffeeds == 0){
			$numberoffeeds = 0;
		}
		$limit = 10;
		$html='';
		$return = array();
		if($numberoffeeds > 0){
			foreach($feeds as $feedl)
			{
				$title = str_replace(' & ', ' &amp; ', $feedl['title']);
				$link = $feedl['link'];
				$description = $feedl['desc'];
				$date = date('l F d, Y', strtotime($feedl['date']));
				$html.='<div class="nw-feed">';
				$html.='<p id="allfields" class="nw-ttl"><strong><a  href="'.$link.'" target="_blank" title="'.$title.'">'.$title.'</a></strong><br />';
				$html.='<small><em>Posted on '.$date.'</em></small></p>';
				$html.='<p class="nw-dcr" >'.$description.'</p>';
				$html.='</div>';
			}
		}
		$return['html'] = $html;
		echo json_encode($return);
	}*/
	
	public function getnewsfeed(){
		$_data = $this->input->_requestAll();
		$country = trim($_data['country']);
		$rss = new DOMDocument();
	//	$rssURL = "http://news.search.yahoo.com/news/rss?p=$country";
		$rssURL = "http://news.google.com/news?q=".$country."&output=rss";
		$news =simplexml_load_file($rssURL);
		 
		$feeds = array();
		$i=0;
		foreach ($news->channel->item as $item) 
		{
			preg_match('@src="([^"]+)"@', $item->description, $match);
			$parts = explode('<font size="-1">', $item->description);

			$feeds[$i]['title'] = (string) $item->title;
			$feeds[$i]['link'] = (string) $item->link;
			$feeds[$i]['image'] = @$match[1];
			$feeds[$i]['site_title'] = strip_tags($parts[1]);
			$feeds[$i]['story'] = strip_tags($parts[2]);
			$feeds[$i]['image'] = @$match[1];
			$feeds[$i]['pubDate'] = (string) $item->pubDate;
			
			$i++;
		}
		 
		$html='';
		for($i=0;$i<count($feeds);$i++)
		{
				$title = str_replace(' & ', ' &amp; ', $feeds[$i]['title']);
				$link = $feeds[$i]['link'];
				$description = $feeds[$i]['story'];
				$date = date('l F d, Y', strtotime($feeds[$i]['pubDate']));
				$html.='<div class="nw-feed">';
				$html.='<p id="allfields" class="nw-ttl"><strong><a  href="'.$link.'" target="_blank" title="'.$title.'">'.$title.'</a></strong><br />';
				
				$html.='<p class="nw-dcr" >'.$description.'</p>';
				$html.='<small><em>Posted on '.$date.'</em></small></p>';
				$html.='</div>';
		}	
		 
		$return['html'] = $html;
		echo json_encode($return);
	}
	
	
	public function updateClassAction(){
		$this->load->model(array('class_model','user_model'));
		$_data = $this->input->_requestAll();
		$cid   = @$_data['classId'];
		$updateData = $this->class_model->getClassAction($cid);
		if(@$_data['tutorConnected']){
			$updateData['tutorConnected'] = $_data['tutorConnected'];
		}
		if(@$_data['studentConnected']){
			$updateData['studentConnected'] = $_data['studentConnected'];
		}
		if(@$_data['sTimerSynced']){
			$updateData['sTimerSynced'] = $_data['sTimerSynced'];
		}
		if(@$_data['tTimerSynced']){
			$updateData['tTimerSynced'] = $_data['tTimerSynced'];
		}
		$this->class_model->updateClassAction($updateData,$cid);
	}
	/**
	* @author skvirja 23 Oct 2013
	* @param get class updated status
	**/
	public function getConnectedStatus(){
		$cid = $this->input->post('cid');
		$sql = "SELECT action from class WHERE id = {$cid} ";
		$query = $this->db->query($sql);
		$return['studentConnected'] = 0;
		$return['tutorConnected'] = 0;
		if($query->num_rows()>0){
			$result = $query->row_array();	
			$action = $result['action'];
			if($action != ''){
				$action = unserialize($action);
				if(@$action['studentConnected'] != ''){
					$return['studentConnected'] = $action['studentConnected'];
				}
				if(@$action['tutorConnected'] != ''){
					$return['tutorConnected'] = $action['tutorConnected'];
				}
			}
		}
		$return['status'] = 'success';
		echo json_encode($return);
	}
	public function getClassAction(){
		$this->load->model(array('class_model'));
		$cid = $this->input->post('cid');
		$actionData = $this->class_model->getClassAction($cid);
		$return['sTimerSynced'] = 0;
		if(@$actionData['sTimerSynced']){
			$return['sTimerSynced'] = $actionData['sTimerSynced'];
		}
		if(@$actionData['tTimerSynced']){
			$return['tTimerSynced'] = $actionData['tTimerSynced'];
		}
		echo json_encode($return);
	}

	public function GetTeacherResponse()
	{
		$data = $this->input->post();
		$cid=$data['clsid'];
		/*print_r($data);
		return false;*/
		if($data['classId']==1)
		{
			$sql="update class set is_Running=1 where id={$cid}";
			$this->db->query($sql);
			$this->session->set_userdata('tleave','yes');
		}

		$sql = "SELECT is_Running FROM class  WHERE id={$cid}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		
		if($result['is_Running'] == 0)
		{
				echo json_encode(array('success'=>false));
				die();
		}
		else
		{
			echo json_encode(array('success'=>true));
					die();
		}
	}

	public function testvee(){
		$apiKey = $data['apiKey'] = '21029512' ;
		$api_secret = "ea40167d9c3b010598d37be3565276b2e1b2c488";
		$this->load->model(array('class_model','user_model'));
		$uid = $this->session->userdata('uid');//$_SESSION['uid'];
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin){
			redirect('user/login');
		}
		$data['sessionId'] = '' ;
		$data['token'] = '' ;
		$data['_startTime'] = 100000;
		$data['_endTime']= 100000;
		$data['user'] = array();
		$data['uid'] = $uid;
		$data['cid'] = $this->input->_request('cid');
		$data['feedback'] = false;
		if($data['cid'] < 1){
			$class = $this->class_model->getNearClassByUid($uid);
		}else{
			$class = $this->class_model->getNearClassById($data['cid']);
		}
		if(!empty($class)){
			$feedback = $this->class_model->getFeedbackByCid($class['id']);
			if(isset($feedback['callId'])) {
				$data['feedback'] = true;;
			}
			$this->load->library('OpenTokSDK',array('api_key'=>$apiKey,'api_secret'=>$api_secret));
			$users['t'] = array('pic'=>$class['tp'],'name'=>$class['tf'],'uid'=>$class['tid']);
			$users['s'] = array('pic'=>$class['sp'],'name'=>$class['sf'],'uid'=>$class['sid']);
			if($class['tid'] == $uid){
				$type = 'tid';
				$user = array('pic'=>$class['tp'],'name'=>$class['tf'],'uid'=>$class['tid'],'type'=>'t');
				$otherPic = $class['sp'];
				$otherName = $class['sf'];
			}else if($class['sid'] == $uid){
				$type = 'sid';
				$user = array('pic'=>$class['sp'],'name'=>$class['sf'],'uid'=>$class['sid'],'type'=>'s');
				$otherPic = $class['tp'];
				$otherName = $class['tf'];
			}else{
				$class['session_id'] = 'wrong';
			}
			$user['classId']=$class['id'];
			$sessionId = $this->input->_request('_sessionId');
			if(!$class['session_id'] ) {
				$session = $this->opentoksdk->createSession( $_SERVER["REMOTE_ADDR"], array(SessionPropertyConstants::P2P_PREFERENCE=> "enabled") );
				$sessionId = $session->getSessionId();
				$tokenS = $this->opentoksdk->generateToken($sessionId, RoleConstants::MODERATOR, strtotime($class['endTime']), md5(json_encode($users['s'])));
				$tokenT = $this->opentoksdk->generateToken($sessionId, RoleConstants::MODERATOR, strtotime($class['endTime']), md5(json_encode($users['t'])) );
				$this->class_model->upSession($class['id'],$sessionId,$tokenS,$tokenT);//setcookie('_sessionId',$sessionId);
				if($type == 'sid'){
					$token = $tokenS;
				}else {
					$token = $tokenT;
				}
			}else {
				$sessionId = $class['session_id'];
				if($type == 'sid'){
					$token = $class['tokenS'];
				}else {
					$token = $class['tokenT'];
				}
			}
			$startTime = strtotime($class['startTime']);
			//echo $_startTime = $startTime - time() - 60*2;
			$_startTime = $startTime;
			$_endTime = strtotime($class['endTime']) - time();
			$data['_startTime']= $_startTime;
			$data['_endTime']= $_endTime;
			$otherPic = profile_image($otherPic);
			$user['pic'] = profile_image($user['pic']);
			$user['otherPic'] = $otherPic;
			$user['otherName'] = $otherName;
			$data['user']= $user;
			$data['sessionId'] = $sessionId ;
			$data['token'] = $token ;
			$data['cid'] = $class['id'];
			// update class status to unlocked for browser close
			$lockedSession = 'locked_'.$data['cid'];
			$this->session->set_userdata($lockedSession, 'No');
			//update for student attendance history
			if($this->session->userdata('roleId') == 0){
				$this->class_model->updateAttendance($data['cid']);
			}
		}else{}
		$this->load->model(array('Tool_model','location_model'));
		$countries= $this->location_model->getCountries();
		$country = array();
		foreach($countries as $cnt)
		{
			foreach($cnt as $key => $value)
			{
				$country[$key] = $value;
			}
		}
		$countries = $country; 
		//get action for class for process class
		$action = unserialize($class['action']);
		$this->layout->setData('action',$action);
		$gImages = array();//$this->Tool_model->getGImage();
		$gLangs = $this->Tool_model->getLangs();
		$this->layout->setLayout('none');
		$this->layout->setData('gImages',$gImages);
		$this->layout->setData('gLangs',$gLangs);
		$this->layout->setData('countries',$countries);
		$this->layout->view('classroom/testvee',$data);
	}
	
	
	
	
	
	
	
	public function testVeeSessionv1(){
		$apiKey = $data['apiKey'] = '21029512' ;
		$api_secret = "ea40167d9c3b010598d37be3565276b2e1b2c488";
		$this->load->model(array('class_model','user_model'));
		$uid = $this->session->userdata('uid');//$_SESSION['uid'];
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin){
			redirect('user/login');
		}
		$data['sessionId'] = '' ;
		$data['token'] = '' ;
		$data['_startTime'] = 100000;
		$data['_endTime']= 100000;
		$data['user'] = array();
		$data['uid'] = $uid;
		$data['cid'] = $this->input->_request('cid');
		$data['feedback'] = false;
		if($data['cid'] < 1){
			$class = $this->class_model->getNearClassByUid($uid);
		}else{
			$class = $this->class_model->getNearClassById($data['cid']);
		}
		if(!empty($class)){
			$feedback = $this->class_model->getFeedbackByCid($class['id']);
			if(isset($feedback['callId'])) {
				$data['feedback'] = true;;
			}
			$this->load->library('OpenTokSDK',array('api_key'=>$apiKey,'api_secret'=>$api_secret));
			$users['t'] = array('pic'=>$class['tp'],'name'=>$class['tf'],'uid'=>$class['tid']);
			$users['s'] = array('pic'=>$class['sp'],'name'=>$class['sf'],'uid'=>$class['sid']);
			if($class['tid'] == $uid){
				$type = 'tid';
				$user = array('pic'=>$class['tp'],'name'=>$class['tf'],'uid'=>$class['tid'],'type'=>'t');
				$otherPic = $class['sp'];
				$otherName = $class['sf'];
			}else if($class['sid'] == $uid){
				$type = 'sid';
				$user = array('pic'=>$class['sp'],'name'=>$class['sf'],'uid'=>$class['sid'],'type'=>'s');
				$otherPic = $class['tp'];
				$otherName = $class['tf'];
			}else{
				$class['session_id'] = 'wrong';
			}
			$user['classId']=$class['id'];
			$sessionId = $this->input->_request('_sessionId');
			if(!$class['session_id'] ) {
				$session = $this->opentoksdk->createSession( $_SERVER["REMOTE_ADDR"], array(SessionPropertyConstants::P2P_PREFERENCE=> "enabled") );
				$sessionId = $session->getSessionId();
				$tokenS = $this->opentoksdk->generateToken($sessionId, RoleConstants::MODERATOR, strtotime($class['endTime']), md5(json_encode($users['s'])));
				$tokenT = $this->opentoksdk->generateToken($sessionId, RoleConstants::MODERATOR, strtotime($class['endTime']), md5(json_encode($users['t'])) );
				$this->class_model->upSession($class['id'],$sessionId,$tokenS,$tokenT);//setcookie('_sessionId',$sessionId);
				if($type == 'sid'){
					$token = $tokenS;
				}else {
					$token = $tokenT;
				}
			}else {
				$sessionId = $class['session_id'];
				if($type == 'sid'){
					$token = $class['tokenS'];
				}else {
					$token = $class['tokenT'];
				}
			}
			$startTime = strtotime($class['startTime']);
			//echo $_startTime = $startTime - time() - 60*2;
			$_startTime = $startTime;
			$_endTime = strtotime($class['endTime']) - time();
			$data['_startTime']= $_startTime;
			$data['_endTime']= $_endTime;
			$otherPic = profile_image($otherPic);
			$user['pic'] = profile_image($user['pic']);
			$user['otherPic'] = $otherPic;
			$user['otherName'] = $otherName;
			$data['user']= $user;
			$data['sessionId'] = $sessionId ;
			$data['token'] = $token ;
			$data['cid'] = $class['id'];
			// update class status to unlocked for browser close
			$lockedSession = 'locked_'.$data['cid'];
			$this->session->set_userdata($lockedSession, 'No');
			//update for student attendance history
			if($this->session->userdata('roleId') == 0){
				$this->class_model->updateAttendance($data['cid']);
			}
		}else{}
		$this->load->model(array('Tool_model','location_model'));
		$countries= $this->location_model->getCountries();
		$country = array();
		foreach($countries as $cnt)
		{
			foreach($cnt as $key => $value)
			{
				$country[$key] = $value;
			}
		}
		$countries = $country; 
		//get action for class for process class
		$action = unserialize($class['action']);
		$this->layout->setData('action',$action);
		$gImages = array();//$this->Tool_model->getGImage();
		$gLangs = $this->Tool_model->getLangs();
		$this->layout->setLayout('none');
		$this->layout->setData('gImages',$gImages);
		$this->layout->setData('gLangs',$gLangs);
		$this->layout->setData('countries',$countries);
		$this->layout->view('classroom/testvee',$data);
	}
	
	public function testVeeSessionv2(){
		$apiKey = $data['apiKey'] = '21029512' ;
		$api_secret = "ea40167d9c3b010598d37be3565276b2e1b2c488";
		$this->load->model(array('class_model','user_model'));
		$uid = $this->session->userdata('uid');//$_SESSION['uid'];
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin){
			redirect('user/login');
		}
		$data['sessionId'] = '' ;
		$data['token'] = '' ;
		$data['_startTime'] = 100000;
		$data['_endTime']= 100000;
		$data['user'] = array();
		$data['uid'] = $uid;
		$data['cid'] = $this->input->_request('cid');
		$data['feedback'] = false;
		if($data['cid'] < 1){
			$class = $this->class_model->getNearClassByUid($uid);
		}else{
			$class = $this->class_model->getNearClassById($data['cid']);
		}
		if(!empty($class)){
			$feedback = $this->class_model->getFeedbackByCid($class['id']);
			if(isset($feedback['callId'])) {
				$data['feedback'] = true;;
			}
			$this->load->library('OpenTokSDK',array('api_key'=>$apiKey,'api_secret'=>$api_secret));
			$users['t'] = array('pic'=>$class['tp'],'name'=>$class['tf'],'uid'=>$class['tid']);
			$users['s'] = array('pic'=>$class['sp'],'name'=>$class['sf'],'uid'=>$class['sid']);
			if($class['tid'] == $uid){
				$type = 'tid';
				$user = array('pic'=>$class['tp'],'name'=>$class['tf'],'uid'=>$class['tid'],'type'=>'t');
				$otherPic = $class['sp'];
				$otherName = $class['sf'];
			}else if($class['sid'] == $uid){
				$type = 'sid';
				$user = array('pic'=>$class['sp'],'name'=>$class['sf'],'uid'=>$class['sid'],'type'=>'s');
				$otherPic = $class['tp'];
				$otherName = $class['tf'];
			}else{
				$class['session_id'] = 'wrong';
			}
			$user['classId']=$class['id'];
			$sessionId = $this->input->_request('_sessionId');
			if(!$class['session_id'] ) {
				$session = $this->opentoksdk->createSession( $_SERVER["REMOTE_ADDR"], array(SessionPropertyConstants::P2P_PREFERENCE=> "enabled") );
				$sessionId = $session->getSessionId();
				$tokenS = $this->opentoksdk->generateToken($sessionId, RoleConstants::MODERATOR, strtotime($class['endTime']), md5(json_encode($users['s'])));
				$tokenT = $this->opentoksdk->generateToken($sessionId, RoleConstants::MODERATOR, strtotime($class['endTime']), md5(json_encode($users['t'])) );
				$this->class_model->upSession($class['id'],$sessionId,$tokenS,$tokenT);//setcookie('_sessionId',$sessionId);
				if($type == 'sid'){
					$token = $tokenS;
				}else {
					$token = $tokenT;
				}
			}else {
				$sessionId = $class['session_id'];
				if($type == 'sid'){
					$token = $class['tokenS'];
				}else {
					$token = $class['tokenT'];
				}
			}
			$startTime = strtotime($class['startTime']);
			//echo $_startTime = $startTime - time() - 60*2;
			$_startTime = $startTime;
			$_endTime = strtotime($class['endTime']) - time();
			$data['_startTime']= $_startTime;
			$data['_endTime']= $_endTime;
			$otherPic = profile_image($otherPic);
			$user['pic'] = profile_image($user['pic']);
			$user['otherPic'] = $otherPic;
			$user['otherName'] = $otherName;
			$data['user']= $user;
			$data['sessionId'] = $sessionId ;
			$data['token'] = $token ;
			$data['cid'] = $class['id'];
			// update class status to unlocked for browser close
			$lockedSession = 'locked_'.$data['cid'];
			$this->session->set_userdata($lockedSession, 'No');
			//update for student attendance history
			if($this->session->userdata('roleId') == 0){
				$this->class_model->updateAttendance($data['cid']);
			}
		}else{}
		$this->load->model(array('Tool_model','location_model'));
		$countries= $this->location_model->getCountries();
		$country = array();
		foreach($countries as $cnt)
		{
			foreach($cnt as $key => $value)
			{
				$country[$key] = $value;
			}
		}
		$countries = $country; 
		//get action for class for process class
		$action = unserialize($class['action']);
		$this->layout->setData('action',$action);
		$gImages = array();//$this->Tool_model->getGImage();
		$gLangs = $this->Tool_model->getLangs();
		$this->layout->setLayout('none');
		$this->layout->setData('gImages',$gImages);
		$this->layout->setData('gLangs',$gLangs);
		$this->layout->setData('countries',$countries);
		$this->layout->view('classroom/testvee',$data);
	}
	
	function refund(){
		$data = $this->input->post();
		$cid = $data['cid'];
		
		$cquery = "select is_completed from disputes where cid=".$cid;
		$csquery = $this->db->query($cquery);
		$result = $csquery->row_array();

		if($result['is_completed'] == 0){
			$classsql = "select tid, sid, startTime,fee,createAt from class where id = {$cid}";
			$classquery = $this->db->query($classsql);
			$classresult = $classquery->row_array();

			$studentid = $classresult['sid'];		
			$revertfee = $classresult['fee'];
			$checkfreesession = "select is_eligible from user where id = {$studentid}";
			$checkquery = $this->db->query($checkfreesession);
			
			$this->load->model(array('pay_model','class_model'));
			if ($checkquery->num_rows() > 0) {
				$resultTeachers = $checkquery->result_array();
				if($resultTeachers[0]['is_eligible'] != '1'){
					$feeSql = "update profile set money=money+{$revertfee}, purchased_credits=purchased_credits+{$revertfee}, frMoney=frMoney-{$revertfee} where uid={$studentid}";
					$query = $this->db->query($feeSql);
				}
				$this->pay_model->cancel_disputes($cid);
				//$this->class_model->deleterefundclass($cid);
			}
		}
		exit;
	}
	
	public function UpdateIntendYes()
	{
		$Dleclass=$this->input->post('clsid');
		$sql="update class set Intent=1 where id={$Dleclass} and Intent=0";
		$this->db->query($sql);
		$success = 'true';
		echo json_encode(compact('success'));
	}
	
	public function UpdateIntendNo()
	{
		$Dleclass=$this->input->post('clsid');
		
		$cquery = "select is_completed from disputes where cid=".$Dleclass;
		$query = $this->db->query($cquery);
		$result = $query->row_array();

		if($result['is_completed'] == 0){
			$sql="update class set Intent=2 where id={$Dleclass}";
			$this->db->query($sql);
			$success = 'true';
			echo json_encode(compact('success'));
		}
	}
	
	public function updatestudentamount(){
		$data = $this->input->post();
		//$data['cid'] = '3570';
		
		$getusersql = "select sid,fee from class where id=".$data['cid'];		
		$getuserquery = $this->db->query($getusersql);
		$getuserresult = $getuserquery->row_array();
		$hrate = $getuserresult['fee'];
		
		//echo $getuserresult['sid'];
		//exit;
		$sql1 = "update profile set money=money+{$hrate},purchased_credits=purchased_credits+{$hrate} where uid = ".$getuserresult['sid'];
		$query1 = $this->db->query($sql1);

		//$this->class_model->updateStudentAttendance($data['cid']);
		exit;
	}
	
	public function checkStuPresent()
	{
		$cid = $this->input->_request('classId');
		$sql = "SELECT sleaveEarly FROM class  WHERE id={$cid}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			if($result['sleaveEarly']==1)
			{
				echo json_encode(array('success'=>true));
				die;
			}
			
			else
			{
				echo json_encode(array('success'=>false));
				die;
			}
		}
		else{
		echo json_encode(array('success'=>false));die;
		
		}
	}
	
	public function updateLeaveStatus()
	{
		$clasId=$this->input->post('clsid');
		$sql="update class set sleaveEarly=1 where id={$clasId}";
		$this->db->query($sql);
		die; 
	}
	
	public function FreeBack()
	{
		$clasId=$this->input->post('clsid');
		 $sql="select session_type,sid from class  where id={$clasId}";
		$query =$this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->row_array();
			if($result['session_type']=='free' ||  $result['session_type']=='Free' || $result['session_type']=='FREE')
			{ 
				$uid=$result['sid'];
				$sql="update user set is_eligible=1, `free_session`='y' where id={$uid}";
				$this->db->query($sql);
			}
		}
	}
	
	public function updatedismiss()
	{
		$uid = $this->input->post('uid');
		$sql="update user set dismissforever=1 where id={$uid}";
		$this->db->query($sql);
	}
}
/* End of file classroom.php */
/* Location: ./application/controllers/classroom.php */