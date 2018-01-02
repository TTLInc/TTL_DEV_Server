<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends TL_Controller {
	public $user = array();
	public function __construct() {
		parent::__construct();
		session_start();
		$this->load->model(array('user_model','profile_model','langs_model'));
		$this->load->model(array('lookup_model'));
		if($this->input->uri->segments[2] != 'login' && $this->input->uri->segments[2] != 'register'){
			$this->user = $this->check_login(false);
		}
		@$this->uid = $this->input->_request('uid') ? $this->input->_request('uid') : $this->user['uid'];		//var_dump($this->user);
       if(isset($this->user['uid']) && $this->user['uid'] !=null && $this->uid == $this->user['uid']){
			$this->own = true;
			if($this->session->userdata['roleId'] != 0){
				$this->session->sess_expiration = '28800';// expires in 8 hours
				$this->session->set_userdata($this->session->userdata['username']);
			}
			if($this->session->userdata['roleId'] == 0){
				$this->session->sess_expiration = '3600';// expires in 1 hour
				$this->session->set_userdata($this->session->userdata['username']);
			}
		}else{
			$this->own = false;
		}
         
		$this->layout->setData(array('own'=>$this->own));		
		$this->layout->setLayoutData('linkAttr','user');
		
		$addata=$this->user_model->getAdevertise();
		if($addata)
		$this->layout->setData('adcon',$addata);			
		$addata1=$this->user_model->getAdevertise1();	
		if($addata1)
		$this->layout->setData('adcon1',$addata1);
		$addata2=$this->user_model->getAdevertise2();			
		if($this->session->userdata['roleId']==5)
		{
			$pr = $this->profile_model->getProfile($this->session->userdata['uid']);
			if($pr['payment_account'] != '')
			{
				$encode =  $this->user_model->encode($this->session->userdata['uid'],"This is a key"); 
				$this->layout->setData('encode',base_url().'af'.'/'.$encode);
			}
		}
		if($addata2)
			$this->layout->setData('adcon2',$addata2);
		if($this->uri->segment(4)!='')
		{
			$current_uri4 = $this->uri->segment(4);
			$uid = $this->user_model->getByprofileUid($current_uri4);
			$this->layout->setData('uid',$uid);
			$this->layout->setData('tutorfreesession',$uid['free_session']);

			$uid_readytalk = $this->user_model->checkreadytalk($current_uri4);
			$this->layout->setData('uid_readytalk',$uid_readytalk);
		}
		if($this->session->userdata['roleId']<=5)
		{
		if($this->session->userdata['uid'] !='')
			{
				$kuid=$this->session->userdata['uid'];
				$pinfo = $this->user_model->getByprofileUid($kuid);
				$this->layout->setData('pinfo',$pinfo);
				
				$chkOpenslot=$this->user_model->CheckOpenSlot($kuid);
				$this->layout->setData('openedslot',$chkOpenslot);
			}
		}
		if($this->session->userdata['roleId']==4)
		{
			$pr = $this->profile_model->getProfile($this->session->userdata['uid']);
			if($pr['payment_account'] != '')
			{
				$fn = $pr['firstName'];
				$encode =  $this->user_model->encode($this->session->userdata['uid'],"This is a key"); 
				$this->layout->setData('encode',base_url().'sc/'.$fn.'.'.$encode);
			}
		}
		if($this->session->userdata['roleId']==1 || $this->session->userdata['roleId']==2 || $this->session->userdata['roleId']==3){
			$permission = $this->getPermission($this->session->userdata['uid']);
			if($permission =='teacher_public'){
				$otheruser = '1';
				$this->layout->setData('otheruser',$otheruser);
			}
		}
		}
	private function getViewTemp($uid,$temp){
	$permisson = $this->getPermission($uid);
		if( $permisson == '' ) {
			return 'user/invalidUser';
		}
		else {
			$view = $temp . '/' .$permisson;
		}
        return $view;
	}
	public function RotateImage()
	{
		$addata=$this->user_model->getAdevertise();
		echo json_encode($addata);
		die();
	}
	// to update teacher role like gold,silver
	public function UpdateResult()
	{
		$id=$this->input->post('uid');
		//$id = '597';
		$result=$this->user_model->UpdateTeacherRole($id);
		echo json_encode($result);
		die();
	}
		//to update number of count of advertisement
	public function UpdateCounter()
	{
		$id=$this->input->post('cid');
		$result=$this->user_model->Updatecounter($id);
		json_encode($result);
		die();
	}
	public function getPermission($uid){
		$userInfo = $this->user_model->getByUid($uid);
		if(!isset($userInfo['roleId'])){
			return 'invalidUser';
		}
		$role = 'student';
		switch($userInfo['roleId']){
			case 0 : $role = 'student';break;
			case 1 : $role = 'teacher';break;
			case 2 : $role = 'teacher';break;
			case 3 : $role = 'teacher';break;
			case 4 : $role = 'organization';break;
			case 5 : $role = 'affiliate';break;
			default : $role = 'teacher';break;
		}
		$type = 'private';
		if($uid != $this->user['uid']) {
			$type = 'public';
		}
		return  $role.'_'.$type;
	}
	public function index() {
		$this->profile();
		
	}
	public function ajax_check(){
	$checkType = $this->input->_request('id');
		switch($checkType){
			case  'username':$result = $this->user_model->checkUserName($this->input->_request('value'));break;
			case  'password':$result = $this->user_model->checkPassword($this->input->_request('value'));break;
			case  'email':$result = $this->user_model->checkEmail($this->input->_request('value'));break;
			default:$result = $this->user_model->checkUserName($this->input->_request('value'));break;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	public function paypalcheck(){
		$checkType = $this->input->_request('id');
		switch($checkType){
			case  'email':$result = $this->user_model->chkpayemail($this->input->_request('value'));break;
			default:$result = $this->user_model->checkUserName($this->input->_request('value'));break;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	public function gettime()
	{ 
		//$this->load->model('event_model');
		$this->load->model(array('class_model','event_model','user_model'));
		$cid=$this->input->_request('cid');
		if($cid != '')
		{
			
		
		$sql="select * from class where id={$cid}";
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$a=$result['type'];
			/*if($a=='now')
			{*/
				$user_currentTime = $this->event_model->getactualtime();
				echo $user_currentTime;	
			/*}
			else
			{
				echo $user_currentTime='deleted';	
			}*/
		}
		else
		{;
			//echo $user_currentTime='deleted';
			echo $this->CheckGroup();
		}
		}
		else
		{
				  
				  $this->CheckGroup();
		}
	}
	
	public function CheckGroup()
	{
		$Class = $this->user_model->GetNextSession();
		//echo "<pre>"; print_r($Class);die;			
		if($Class !=array())
		{
			$start=$Class['Time'];
			$timeNow = date('Y-m-d H:i:s');
			$timeNowStr = strtotime($timeNow);
			$classTimeStr = strtotime($start);
			$classDiffInMin = round(($classTimeStr - $timeNowStr) / 60,2);
			$Diff=round(abs($classTimeStr - $timeNowStr) / 60,2);
			
			 $dt= date('Y-m-d H:i:s');
			$end= strtotime($start);
			$end=$end+(60*25);

			$end=date("Y-m-d H:i:s", $end);
			 
			if($Diff <=15 && $Diff >0)
			{
				echo $Diff; 
			}
			else if($dt >= $start && $dt<=$end)
			{ 
				if($Diff <= 25)
				{
					echo 1;
				}
				else
				{
					echo $Diff;
				}
			}
			else
			{
				echo '0';
			}
		}
		else
			{
				echo '0';
			}
	}
	
	public function dashboard(){
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		
		if(!$islogin){
			redirect('user/login');
		}
		if($this->session->userdata('roleId') == '0')
		{
		$currenttime = date('Y-m-d');
		$sid = $this->session->userdata('uid');
	    $sql = "SELECT user.exp_session  from user  where  user.id = {$sid} AND user.exp_session <'{$currenttime}' "  ;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
		 $this->user_model->updatefreesession($this->uid);
		}
		}
	
	
		$this->_profile();
	
		$this->load->model(array('class_model','location_model','ad_model','dashboardmessages_model','dchatmodel','event_model'));
		$aldata = $this->profile_model->getProfile($this->uid);
		
	   $rid=$this->session->userdata['roleId'];
	   /*
		if($aldata['lastName']=='' && $aldata['age']=='' && $aldata['city']=='' && $rid >=1 && $rid <=3)
		{
		  $this->profile_model->DelProfile($this->uid);	
		  $this->logout();
		}*/
		/*$user_currentTime = $this->event_model->getactualtime();
		$this->layout->setData('user_currentTime',$user_currentTime);*/
		/*$chart_data = $this->profile_model->getAllProfile();	
		$this->layout->setData('chart_data',$chart_data);
		$chart_number_data = $this->profile_model->getAllCountProfile();
		$this->layout->setData('chart_number_data',$chart_number_data);*/
		$criteria = $this->profile_model->getcriteria($this->uid);

		$this->layout->setData('criteria',$criteria);
		$ads= $this->ad_model->getAllAds('user-dashboard');
		if($ads)
			$this->layout->setData('ads',$ads);
		
		$config = $this->location_model->getConfig();
		$this->layout->setData('configdefault',$config);
		// get messages for tutor dashboard
		$tmessages= $this->dashboardmessages_model->getAllMessages('active');
		if($tmessages)
			$this->layout->setData('tmessages',$tmessages);
		/*$tutorsIds = $this->user_model->getTutorsDashnoard();
		
		$newtutors = array();
		if($tutorsIds):
			foreach($tutorsIds as $tutorsId):
					$newtutors[] = $this->profile_model->getTutorProfile($tutorsId['id']);
			endforeach;
		endif;
		$this->layout->setData('newtutors',$newtutors);
		*/
		/* added by haren to display new tutor on dahsboard */ 
			$Suggest = array();	
			$Suggest1=array();
			$Allnew=array();
			$goldTutor=array();
			$Suggest2 =array();
			$Suggest = $this->user_model->GetSuggestedTutor();
			$goldTutor=$this->user_model->GetGoldTutor();
			$Allnew=$this->user_model->GetDahboardNewTutor();
			//echo "<pre>"; print_r($Allnew);die;
			if($Suggest !=array())
			{
				for($i=0;$i<count($Suggest);$i++)
				{
				  $Suggest1[] = $this->profile_model->getTutorProfile($Suggest[$i]['id']);
				}
			}
			$Suggest2 = array_merge($goldTutor,$Allnew,$Suggest1);
			$this->layout->setData('newtutors',$Suggest2);
		 
		 
		/* new tutor on dahsboard end */
		$langApp=array();
		$langApp=$this->user_model->GetAllApps();
		
		$this->layout->setData('langApp',$langApp);
		
		/*print_r($newtutors);
		exit;*/
		$numberofstudents = $this->user_model->getNumberofstudents();
       /* getting advertisement data and set into layout */	
	   $addata=$this->user_model->getAdevertise();
		if($addata)
			$this->layout->setData('adcon',$addata);
			$addata1=$this->user_model->getAdevertise1();	
				if($addata1)
			$this->layout->setData('adcon1',$addata1);
  $addata2=$this->user_model->getAdevertise2();			
		if($addata2)
			$this->layout->setData('adcon2',$addata2);
		$this->layout->setData('numberofstudents',$numberofstudents);
		$top8Country = $this->user_model->getTop8Country();
		$this->layout->setData('top8Country',$top8Country);
		$i = 0;
		// add manual contry id if not reach 8
		if(count($top8Country)<8)
		{if(count($top8Country) == 6)
			{
				//$top8Country[] = 
			}
		}
		foreach($top8Country as $top8)
		{
			$cntId = $top8['country'];
			@$countryData = $this->location_model->getCountryById($cntId);
			$countryName = str_replace(',','',@$countryData['country']);
			if($countryName == ''){$countryName = 'Others';}
			$tutorChatData[$i]['countryid'] = $cntId;
			$tutorChatData[$i]['country'] = $countryName;
			$countryRecord =  $this->user_model->getCountUsersByCountry($cntId);
			$tutorChatData[$i]['numofst'] = $countryRecord[0]['numberofusers'];
			$i++;		
		}
		
		$this->layout->setData('tutorChatData',$tutorChatData);
		$userGroups = $this->dchatmodel->getGroups($this->uid);
		if($userGroups == 0)
		{
			$userGroups = '';	
		}
		$this->layout->setData('userChatGroups',$userGroups);
		$sql1 = "select userid,chatid from dchat_group_user where invitedbyuid = ".$this->uid." or userid = ".$this->uid." AND status = 'accepted'";
		$query1 = $this->db->query($sql1);
		$result1 = $query1->result_array();
		$this->layout->setData('result1',$result1);
		$permisson = $this->getPermission($this->uid);
		$classes = array();
		$lTid = "tid";
		$lSid = "sid";
		switch($permisson) {
			case 'invalidUser':break;
			case 'student_private':$classes = $this->class_model->getNextSession($this->uid,$lSid);break;
			case 'teacher_private':$classes = $this->class_model->getNextSession($this->uid,$lTid);break;
			case 'studdent_public':break;

		}
/*
		$msql = "select count(id) as number1 from inbox where fId = ".$this->uid." AND isRead = 0";
		$mquery = $this->db->query($msql);
		$mresult = $mquery->result_array();
		*/
		$msql2 = "select count(id) as number2 from inbox where toId = ".$this->uid." AND isRead = 0";
		$mquery2 = $this->db->query($msql2);
		$mresult2 = $mquery2->result_array();
		$completedSessions = $this->class_model->completedSessions($this->uid);
		$completedSessions = $completedSessions['cnt'];
		$this->layout->setData('completedSessions',$completedSessions);
		$this->layout->setData('msgcnt',$mresult2[0]['number2']);
		$this->layout->setData('classes',$classes);
		
			/*addde by haren */
		$nextSession= $this->user_model->GetNextSession();
		
		if($classes !=0 || $nextSession !=array())
		{ 
				$classes[0]['startTime']. "<br>";
				$nextSession['Time']. "<br>";
				$currentDate = strtotime($classes[0]['startTime']);
				$futureDate = $currentDate+(60*5);
				$formatDate = date("Y-m-d H:i:s", $futureDate);
				if(($nextSession['Time']  < @$classes[0]['startTime']) and  ($nextSession['Time']!=''))
					{ 
						$nextTOdISP='group';
					}
					else if(@$classes[0]['startTime'] < $formatDate  && $classes!=0 )
					{ 
						$nextTOdISP='class';
					}
					else if($nextSession['Time']=='')
					{
						$nextTOdISP='class';
					}
					else if(@$classes==0)
					{
						$nextTOdISP='group';
					}
					else if($nextSession['Time'] !='')
					{
						$nextTOdISP='group';
					}
					else
					{	
						$nextTOdISP='group';
					} 
		}
		else if(classes!= 0)
		{
			$nextTOdISP='class';
		}
		else
		{
			$nextTOdISP='group';
		}
		$this->layout->setData('nextSession',$nextSession);
		$this->layout->setData('nextTOdISP',$nextTOdISP);
		
		/* added by haren */
		if($nextSession !=array())
		{
			$Participant=$nextSession['NoofParticipant'];
		}
		else
		{
			$Participant='0';
		}
		$this->layout->setData('Participant',$Participant);	

			$AdvanceSession= $this->user_model->GetAdvanceSession();
		if($AdvanceSession !=array())
		{
			$this->layout->setData('AdvanceSession',$AdvanceSession);
		}
		else
		{
			$this->layout->setData('AdvanceSession',"None");
		}	
		/* haren code end */
		$this->load->helper('date');
		
		$this->layout->view($this->getViewTemp($this->uid,'user/dashboard'));		
	}	
	
//--R&D@Jan-02-2013 : Check if next session is available (for Student)
public function chkNextClsStudentAjax(){
	$this->load->model(array('class_model','location_model','ad_model','dashboardmessages_model','dchatmodel'));
	$classes 	= array();
	$lSid 		= "sid";
	$classes 	= $this->class_model->getNextSession($this->uid,$lSid);
	if(count($classes) > 0){
		echo json_encode(array('classes'=>strtotime($classes[0]['startTime'])));exit;
	}else{
	$classes[0]['startTime'] = 0;
		echo json_encode(array('classes'=>$classes[0]['startTime']));exit;
	}
	
}
//--R&D@Jan-02-2013 : Check if next session is available (for Tutor)
public function chkNextClsTutorAjax(){
	$this->load->model(array('class_model','location_model','ad_model','dashboardmessages_model','dchatmodel'));
	$classes 	= array();
	$lTid 		= "tid";
	$classes 	= $this->class_model->getNextSession($this->uid,$lTid);
	if(count($classes) > 0){
		echo json_encode(array('classes'=>strtotime($classes[0]['startTime'])));exit;
	}else{
	$classes[0]['startTime'] = 0;
		echo json_encode(array('classes'=>$classes[0]['startTime']));exit;
	}
}
	function live_chat(){
		$this->layout->setLayout('none');
		$this->load->model(array('class_model','location_model','ad_model','dashboardmessages_model','dchatmodel'));
		$tmessages= $this->dashboardmessages_model->getAllMessages('active');
		if($tmessages)
			$this->layout->setData('tmessages',$tmessages[0]);
		$tutorsIds = $this->user_model->getTutorsDashnoard();
		$newtutors = array();
		if($tutorsIds):
			foreach($tutorsIds as $tutorsId):
					$newtutors[] = $this->profile_model->getTutorProfile($tutorsId['id']);
			endforeach;
		endif;
		$this->layout->setData('newtutors',$newtutors);
		$numberofstudents = $this->user_model->getNumberofstudents();
		$this->layout->setData('numberofstudents',$numberofstudents);
		$userGroups = $this->dchatmodel->getGroups($this->uid);
		$acceptedGroupsids = $this->dchatmodel->acceptedGroups($this->uid);
		if($acceptedGroupsids != 0 )
		{
			foreach($acceptedGroupsids as $agid)
			{
				$chtid = $agid['chatid'];
				$userGroupsAccepted = $this->dchatmodel->getGroupsByGid($chtid);
				$userGroups[] = $userGroupsAccepted[0];
			}
		}
		if($userGroups == 0)
		{
			$userGroups = '';	
		}
		$this->layout->setData('userChatGroups',$userGroups);
		$this->load->helper('date');
		// DELETE CHAT RECORDS OUT OF THREE DAY'S 
		$this->dchatmodel->deleteChatRecords3();
		$this->layout->view('user/dashboard/livechat');
	}
	
	/**
	* @author TECHNO-SANJAY
	* @contains chat functions **///chat update function
	public function chat_update()
	{
		$this->load->model(array('profile_model','user_model','dchatmodel'));
		$error = false;
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		$localTimeZone = $this->input->_request('localTimeZone');
		if(!$islogin)
		{
			redirect('user/login');
		}else{
			if($this->session->userdata('uid'))
			{
				$user_id = $this->session->userdata('uid');
				$user_name = $this->session->userdata('welcomeuser');
				$block = $this->chat_check_blocked_user();
				if($block == 0)
				{
					$blockedResult['blocked'] = 'blocked';
					$this->output->set_content_type('application/json')->set_output(json_encode($blockedResult));
					$error = true;
				}
			}
		}
		if($error == false)
		{
			foreach($_GET AS $key => $value) {
				// sanitize for SQL Injection
				${$key} = mysql_real_escape_string($value);
			}
			if($message != ""){
				// check for banded words
				$wordArray = explode(' ',$message);
				$banded = $this->chat_check_banded_words($wordArray);
				if($banded == 1)
				{
					$bandedResult['banded'] = 'banded';
					$this->output->set_content_type('application/json')->set_output(json_encode($bandedResult));
					$error = true;
					
				}else{
					
					/*
					$localTimeZone = $this->input->_request('localTimeZone');
					$current = date('Y-m-d H:i:s');	
					//$_time = strtotime($current);
					$_time = time();
					$time = $_time + $localTimeZone*3600;
					$current1 = date('Y-m-d H:i:s',$time);	
					*/
					$current = date('Y-m-d H:i:s');
					//$current = $this->dchatmodel->inTimeChat($current);
					$this->dchatmodel->insertMsg($chat, $user_id, $user_name ,$message ,$current );		
				}
			}
		}
	}
	// chat get message
	public function chat_get_message()
	{
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
		header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
		header("Cache-Control: no-cache, must-revalidate" ); 
		header("Pragma: no-cache" );
		header("Content-Type: text/xml; charset=utf-8");
		$xml = ob_get_contents();
		$xml = '<?xml version="1.0" encoding="utf-8"?>';
		$this->load->model(array('profile_model','user_model','dchatmodel','location_model','event_model'));
		$last = (isset($_GET['last']) && $_GET['last'] != '') ? $_GET['last'] : 0;
		$cht = $_GET['chat'];
		$query = $this->dchatmodel->getMsg($last,$cht);
		$data = $query->result_array();
		 
		$cname = '';
		
		$onlineUsersData = $this->getOnlineUsers();
		if(isset($data) && $data !='')
		{
			$xml .='<root>';
			foreach($data as $msg)
			{
				$posttime = $msg['post_time'];
				// Working date as perr local request
				//$localTimeZone =