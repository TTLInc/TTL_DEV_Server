<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multi extends TL_Controller {
	
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
	public function index(){
	  
		$apiKey = $data['apiKey'] = '23275932' ;
		$api_secret = "b5aa20702348f20f74465950ead140ccbd4f770c";
		$this->load->model(array('multi_model','user_model'));
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
		$data['cid'] = $this->input->_request('id');
		$class = $this->multi_model->getNearClassById($data['cid']);
		$userId=$this->session->userdata['uid'];
		$Alldata=$this->multi_model->getAllDetail($userId);
		 $UserId=$this->session->userdata['uid'];
		 $rid=$this->session->userdata('roleId');
		$first='none';
		$first1=$this->multi_model->Checkisnew($userId);
		 
		if($first1['GroupSession']=='0' &&  $rid >=1 && $rid<=3)
			{
				$first='newtutor';
			}
			
			else if($first1['GroupSession']=='0' &&  $rid==0)
			{
				$first='nestu';
			}
			else
			{
					$first='none';
			}
			
			/* code on 6 april */
			$first1=$this->multi_model->CheckIsnewstudent($userId);
			 
			$cdate=date('Y-m-d');
			if($first1['exp_session'] > $cdate && $first1['is_eligible']==1)
				{
					$first='nestu';
				}
				 
			/* end code */
			
			$this->layout->setData('isFirst',$first);
	 
		
		 $roleId= $this->session->userdata['roleId'];
		 $TutorId=$UserId;
		  
		 if($UserId==@$class['isprimary'])
		 {
			$type='t';
			$this->UpdateGroup();
		 }
		else
		{
			$type='s';
			$this->UpdateGroup();
		}
		//echo "<pre>"; print_r($class);die;
		if(!empty($class) && $Alldata !=''){
			
			$TutorId=$class['isprimary'];
			 
			$tutorDetail=$this->multi_model->GetTutorDetail($TutorId);
			$this->load->library('OpenTokSDK',array('api_key'=>$apiKey,'api_secret'=>$api_secret));
			$users['uid'] = array('pic'=>$Alldata['pic'],'name'=>$Alldata['firstName'],'uid'=>$Alldata['uid']);
			$user = array('pic'=>$Alldata['pic'],'name'=>$Alldata['firstName'],'uid'=>$Alldata['uid'],'type'=>$type);
				$otherPic = $tutorDetail['pic'];
				$otherName = $tutorDetail['firstName']; 
				$user['classId']=$class['gropsessionId'];
		  
			//$this->multi_model->upSession($class,'','','');
 	
		 $claid=$class['gropsessionId'];
		 $multiSessionDetail=$this->multi_model->getByCid($claid);
		 //echo "<pre>"; print_r($multiSessionDetail);die;
		if($multiSessionDetail == array()) {  
				$session = $this->opentoksdk->createSession( $_SERVER["REMOTE_ADDR"], array(SessionPropertyConstants::P2P_PREFERENCE=> "Disabled") );
				$sessionId = $session->getSessionId();
				
				
				$tokent='';
				if($userId == $TutorId)
				{
					$token=$this->opentoksdk->generateToken($sessionId, RoleConstants::PUBLISHER, strtotime($class['endTime']), md5(json_encode($Alldata['uid'])));
					$sql="update multisession set  tokent='{$token}' where groupsessionId={$claid}";
					$this->db->query($sql);
				} 
				else
				{
					$token = $this->opentoksdk->generateToken($sessionId, RoleConstants::SUBSCRIBER, strtotime($class['endTime']), md5(json_encode($Alldata['uid'])));
				}
					$sql="update multisession set session_id='{$sessionId }'  where groupsessionId={$claid}";
					$this->db->query($sql);
		 
		}else
		{

			$cdate=date('Y-m-d h:i:s');
					
			if($class['endTime'] > $cdate)
			{
						 
				$sessionId = $multiSessionDetail['session_id'];
				if($userId == $TutorId)
					{
						
						$token =$multiSessionDetail['tokent'];
						if($token=='')
						{
							$token=$this->opentoksdk->generateToken($sessionId, RoleConstants::PUBLISHER, strtotime($class['endTime']), md5(json_encode($Alldata['uid'])));
							$sql="update multisession set  tokent='{$token}' where groupsessionId={$claid}";
							$this->db->query($sql);
						}	
					}
					else
					{
						$token = $this->opentoksdk->generateToken($sessionId, RoleConstants::SUBSCRIBER, strtotime($class['endTime']), md5(json_encode($Alldata['uid'])));
					}		
			}
			else
			{
				$sessionId ='';
				$token='';
			}
		} 
		/* added by haren */
		$seData=$this->session->userdata('gsession');
		if($seData=='')
		{
			$this->multi_model->UpdatePaticipant($claid);
			$this->session->set_userdata('gsession','never');	
		}
		
		if($UserId!=@$class['isprimary'])
		 {
			$this->multi_model->Updatelistofjoiner($claid);
			$this->user_model->CheckAttandance($class['gropsessionId'],$uid);
		 }
		/* end haren code */
		$this->multi_model->upSession($class,$sessionId,$token,'');
		
		/*echo $sessionId. "<br>";
		echo $token;die;*/
		
		 
			
			$this->load->model(array('event_model'));
			$studentTimezone = $this->user_model->getLastLocalTimeZone($uid);
			//$student_session_time = $this->event_model->utc_to_local('Y-m-d H:i:s',$dt,$studentTimezone);
			$startTime = strtotime($class['Time']);
			$_startTime = $startTime - time();
			//$_startTime = $startTime;
			$_endTime = strtotime($class['endTime']) - time();
			$data['_startTime']= $_startTime;			
			$data['_endTime']= $_endTime;
			$otherPic = profile_image($otherPic);
			$user['pic'] = profile_image($user['pic']);
			$user['otherPic'] = $otherPic;
			$user['otherName'] = $otherName;
			$data['user']= $user;
			 
		 
			$data['cid'] = $class['gropsessionId'];
			// update class status to unlocked for browser close
			$lockedSession = 'locked_'.$data['cid'];
			$this->session->set_userdata($lockedSession, 'No');
			//update for student attendance history
			if($this->session->userdata('roleId') == 0){
				$this->multi_model->updateAttendance($data['cid']);
			}
		}else{}
		$this->load->model(array('Tool_model','location_model','profile_model'));
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
		$data['sessionId'] = $sessionId ;
		$data['token'] = $token ;
		$this->layout->setData('gImages',$gImages);
		$this->layout->setData('gLangs',$gLangs);
		$this->layout->setData('countries',$countries);
		//$Type=$this->session->userdata('roleId');
		$ssid=$this->session->userdata('uid');
		$this->load->model(array('testveesession_model'));
		
		$Type=$this->session->userdata('roleId');
		 
		if($Type==0)
		{
			$rtype='S';
		}
		else{$rtype='T';}
		
		$testScenario=$this->testveesession_model->GetTestScenario($rtype);
	//	echo "<pre>"; print_r($testScenario);die;
		$this->layout->setData('testScenario',$testScenario);
		//echo "<pre>"; print_r($data);die;
		
		$this->layout->setData('isPrimary',@$TutorId);
		
		$this->layout->view('user/multi',$data);
	}
	
	public function checkSession(){	
		$apiKey = $data['apiKey'] = '45142052' ;
		$api_secret = "a41c4b1eda2cddf9514a5c6f1e4ef546e8a1fa72";
		$this->load->model(array('multi_model','user_model'));
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
			$class = $this->multi_model->getNearClassByUid($uid);
		}else{
			$class = $this->multi_model->getNearClassById($data['cid']);
		}
		if(!empty($class)){
			$feedback = $this->multi_model->getFeedbackByCid($class['id']);
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
				$this->multi_model->upSession($class['id'],$sessionId,$tokenS,$tokenT);//setcookie('_sessionId',$sessionId);
				
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
				$this->multi_model->updateAttendance($data['cid']);
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
		$this->load->model('multi_model');
		$this->load->model('pay_model');
		//echo "<pre>"; print_r($data);die;
		//$data['cid'] = '2505';
		
		if($data['cid'] == '') {
			$result['error'] = 1;
			$result['msg'] = 'Invaid post.';
		}
		else {
			$class = $this->multi_model->getByCid1($data['cid']);
			 
			//if($class['sid']!=$this->session->userdata('uid')) {
			 
			 
				$data['callId'] = $data['cid'];
				unset($data['cid']);
				unset($data['localTimeZone']);
				if($data['sendToAdmin'] && $data['sendToAdmin']==1){
					$this->load->model('user_model');
					$ownUser = $this->user_model->getByUid($this->session->userdata('uid'));
					$toUser = $this->user_model->getByUid($class['isprimary']);

					$ownname = $this->user_model->getnameByUid($this->session->userdata('uid'));
					$toname = $this->user_model->getnameByUid($class['isprimary']);

					$toEmail = 'support@thetalklist.com';
					$this->load->library('email');
	                $this->email->mailtype = 'html';
	                $this->email->from($ownUser['email'],$ownUser['username']);
	                $this->email->to( $toEmail );
	                $this->email->subject("The feedback from {$ownUser['username']} to {$toUser['username']}");
	                $message = $ownname['firstName'].' '.$ownname['lastName'].' student reports inappropriate behaviour with '.$toname['firstName'].' '.$toname['lastName'].' tutor on '.$class['startTime'];
	                $message .= "\r\n";
	                $message .= "<br/>";
	                $message .= $data['msg'];
	                $this->email->message($message);
	                $this->email->send();
	            }
				unset($data['sendToAdmin']);
				$data['callerId'] = $class['isprimary'];
				$data['receiverId'] =$this->session->userdata('uid');
				$data['create_at'] = date('Y-m-d H:i:s');
				$result = $this->multi_model->feedback($data);
				$result['error'] = 0;
			 
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
		//print_r($gTranslate);die;
		echo json_encode($data);
		exit;
		$this->view('classroom/translate');
	}
	public function cancel(){
		$cid = $this->input->_request('cid');
		$this->load->model(array('multi_chat_model','multi_model'));
		$class = $this->multi_model->getNearClassById($cid);
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
				$this->multi_chat_model->save($data);
				$this->multi_model->delById($cid,$data['uid']);
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
		$this->load->model('Tool_model');
		$gImages = $this->Tool_model->getGImage($q);
		//echo "<pre>";print_r($gImages);die();
		$data['error'] = 0;
		$data['rows'] = $gImages;
		echo json_encode($data);
		exit;
		$this->layout->view('classroom/images');
	}

	public function attend(){
		
		$data = $this->input->post();
		$this->multi_model->updateAttendance($data['cid']);
		
		
		exit;
	}
	
	public function UpdateDisp()
	{
		$data = $this->input->post();
		$sql1 = "update disputes set is_completed = 1 where cid = {$data['cid']}";
		$query = $this->db->query($sql1);
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
			$this->load->model(array('multi_chat_model','multi_model'));
			//checks for existing session approved message
			$num = 0;
			if(trim($data['msg']) == 'Session Approved'){
				$cid = $data['classId'];
				$msg1 = trim($data['msg']);
				$this->multi_model->updateAttendance($cid);
				
				$sql = "select count(*) as num from chat where classId = {$cid} AND msg like '{$msg1}'";
				$query = $this->db->query($sql);
				
				$classsql = "select tid, sid, startTime from class where id = {$cid}";
				$classquery = $this->db->query($classsql);				
				$classresult = $classquery->row_array();
				$updatedispute = "Update disputes set approve = 1 where sid = ".$classresult['sid']." AND tid =".$classresult['tid']." AND createAt = '".$classresult['startTime']."'";
				$updatedisputequery = $this->db->query($updatedispute);
				if($query->num_rows() > 0){
					$result = $query->row_array();
					$num = $result['num'];
				}
			}
			$data['uid'] = $this->session->userdata('uid');
			if($num == 0){ 
				$this->multi_chat_model->save($data);
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
			$tid = $this->input->_request('tid');
			
			$this->load->model(array('multi_chat_model','multi_model') );
			
			$checkPrimary=$this->multi_model->checkprimary($cid,$tid); 
			$checkConnected=$this->multi_model->checkConnected($cid); 
			 
			$class = $this->multi_model->getByCid($cid); //if vee-sesson already canceled
			if(!$class){
				$isCanceled = true;
			}else{
				$this->load->model(array('multi_chat_model','multi_model') );
				$feedback = $this->multi_model->getFeedbackByCid($cid); //if vee-sesson already canceled
				if($feedback){
					$isCanceled = true;
				}else{
					$isCanceled = false;
				}
				
			}
			$rows = $this->multi_chat_model->getByCid($cid,$time);
			if($rows != array())
			{
				for($i=0;$i<count($rows);$i++)
				{		
					$rows[$i]['pic'] =profile_image($rows[$i]['pic']);
				}	
			}
			$error = 0;
		}
		echo json_encode(compact('error','msg','rows','isCanceled','checkPrimary','checkConnected'));
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
			$student_session_time = date("g:i A, Y-m-d",$timeAfterOneHour);
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
		$this->email->subject('TheTalklist Vee-session created.');
		$this->email->message($str);
		$this->email->send();
		// email to tutor as per his local timezone
		$tutotTimezone = $this->user_model->getLastLocalTimeZone($users[$fUid]['uid']);

		$tutor_session_time = $this->event_model->utc_to_local('g:i A, Y-m-d',$dt,$tutotTimezone);
		if($tutotTimezone == 'America/Boise'){
			$oldTime 			= time($tutor_session_time);
			$timeAfterOneHour 	= $oldTime+60*60*4.6;
			$tutor_session_time = date("g:i A, Y-m-d",$timeAfterOneHour);
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
		$this->email->subject('TheTalklist Vee-session created.');
		$this->email->message($str);
		$this->email->send();
	}
	 
	//skvirja get news feeds 
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

			$i++;
		}
		 
		$html='';
		for($i=0;$i<count($feeds);$i++)
		{
				$title = str_replace(' & ', ' &amp; ', $feeds[$i]['title']);
				$link = $feeds[$i]['link'];
				$description = $feeds[$i]['story'];
				//$date = date('l F d, Y', strtotime($feed[$i]['date']));
				$html.='<div class="nw-feed">';
				$html.='<p id="allfields" class="nw-ttl"><strong><a  href="'.$link.'" target="_blank" title="'.$title.'">'.$title.'</a></strong><br />';
				 
				$html.='<p class="nw-dcr" >'.$description.'</p>';
				$html.='</div>';
		}	
		 
		$return['html'] = $html;
		echo json_encode($return);
	}
	public function updateClassAction(){
		$this->load->model(array('multi_model','user_model'));
		$_data = $this->input->_requestAll();
		$cid   = @$_data['classId'];
		$updateData = $this->multi_model->getClassAction($cid);
		if(@$_data['studentconnected']){
			$updateData['studentconnected'] = $_data['studentconnected'];
		}
		if(@$_data['tutorconnected']){
			$updateData['tutorconnected'] = $_data['tutorconnected'];
			$feeSql = "update gropsession set tutorPresent = 1  where gropsessionId={$cid}";
				$query = $this->db->query($feeSql);
		}
		 
		if(@$_data['sTimerSynced']){
			$updateData['sTimerSynced'] = $_data['sTimerSynced'];
		}
		if(@$_data['tTimerSynced']){
			$updateData['tTimerSynced'] = $_data['tTimerSynced'];
		}
		$this->multi_model->updateClassAction($updateData,$cid);
	}
	/**
	* @author skvirja 23 Oct 2013
	* @param get class updated status
	**/
	public function getConnectedStatus(){
	 
		
		$cid = $this->input->post('cid');
		$sql = "SELECT action from multisession WHERE groupsessionId = {$cid} ";
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
		$this->load->model(array('multi_model'));
		$cid = $this->input->post('cid');
		$actionData = $this->multi_model->getClassAction($cid);
		$return['sTimerSynced'] = 0;
		if(@$actionData['sTimerSynced']){
			$return['sTimerSynced'] = $actionData['sTimerSynced'];
		}
		if(@$actionData['tTimerSynced']){
			$return['tTimerSynced'] = $actionData['tTimerSynced'];
		}
		echo json_encode($return);
	}

	 
 
	
  public function UpdateGroup()
  {
		$data = $this->input->post();
		$uid=$this->session->userdata('uid');
		$sql="update user set GroupSession=1 where id={$uid}";
		$this->db->query($sql);
  }
	
	public function removedispute(){
		$data = $this->input->post();
		$cid = $data['classId'];
		exit;
	}
	
	public function delveeclass(){
		$this->load->model('multi_model');
		$this->multi_model->delveeById($data['cid']);
		$success = 'true';
		echo json_encode(compact('success'));
	}	
	
	public function delveeclassH(){
		$Dleclass=$this->input->post('clsid');
		$this->load->model('multi_model');
		$sql="update class set Is_early=1 where id={$Dleclass}";
		$this->db->query($sql);
		$success = 'true';
		echo json_encode(compact('success'));
	}
	
		
	public function GetTeacherResponse()
	{
		$data = $this->input->post();
		$cid=$data['clsid'];
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
		$sql="update class set Intent=2 where id={$Dleclass}";
		$this->db->query($sql);
		$success = 'true';
		echo json_encode(compact('success'));
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
	
		public function GetconnectedUser(){
	 
		
		$cid = $this->input->post('cid');
		 
		$this->load->model('multi_model');
		$result=$this->multi_model->GetConnectedstu($cid);
		$profile=array();
		if($result['listofjoiner'] !='')
		{
			$particaipants = explode(',',$result['listofjoiner']);
			 
			 	if(count($particaipants)>0)
			{	
				$i = 0;
				foreach($particaipants as $stu)
				{
				 
					$detail=$this->multi_model->Getnamebyid($stu);
					$profile[$i]['fname'] = $detail['firstName'].$detail['uid'];
					$profile[$i]['pic'] = $detail['pic'];
					$i++;
				}
			}
						
		}	
		echo json_encode($profile);
		die();
		 
	}
	public function checkisSent()
	{
		$cid= $_POST['classId'];
		$sql="select isChatSent from gropsession where gropsessionId='{$cid}'";
		$query=$this->db->query($sql);
		if($query->num_rows() > 0){
					$result = $query->row_array();
					if($result['isChatSent'] ==0)
					{
						
						$sql="update gropsession set isChatSent=1 where gropsessionId='{$cid}'";
						$query=$this->db->query($sql);
						echo json_encode(array('success'=>true));
						die;
					}	
					else
					{
							echo json_encode(array('success'=>false));
							die;
					}
		}
		else
		{
							echo json_encode(array('success'=>false));
							die;
		}	
	}
	 
}
/* End of file classroom.php */
/* Location: ./application/controllers/classroom.php */