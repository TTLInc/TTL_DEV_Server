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
			/*if($pr['payment_account'] != '')
			{*/
				$encode =  $this->user_model->encode($this->session->userdata['uid'],"This is a key"); 
				$this->layout->setData('encode',base_url().'af'.'/'.$encode);
			//}
		}
		if($addata2)
			$this->layout->setData('adcon2',$addata2);
		/*if($this->uri->segment(4)!='')
		{
			$current_uri4 = $this->uri->segment(4);
			$uid = $this->user_model->getByprofileUid($current_uri4);
			$this->layout->setData('uid',$uid);
			$this->layout->setData('tutorfreesession',$uid['free_session']);

			$uid_readytalk = $this->user_model->checkreadytalk($current_uri4);
			$this->layout->setData('uid_readytalk',$uid_readytalk);
		}*/
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
			/*if($pr['payment_account'] != '')
			{*/
				$fn = $pr['firstName'];
				$encode =  $this->user_model->encode($this->session->userdata['uid'],"This is a key"); 
				$this->layout->setData('encode',base_url().'sc/'.$fn.'.'.$encode);
			//}
		}
		if($this->session->userdata['roleId']==1 || $this->session->userdata['roleId']==2 || $this->session->userdata['roleId']==3){
			$permission = $this->getPermission($this->session->userdata['uid']);
			if($permission =='teacher_public'){
				$otheruser = '1';
				$this->layout->setData('otheruser',$otheruser);
			}
		}
		
		$multi_lang = $this->geolocater->getlocation();

		if(!isset($_SESSION["multi_lang"])){
			$lang = 'en';
		}else{
			$lang = $_SESSION['multi_lang'];
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
		$grpTime = $this->CheckGroup(); //Check Group Time Remaining
		if($cid != '')
		{
			$sql="select * from class where id={$cid}";
			$query = $this->db->query($sql);
			$userTime = 0;
			if ($query->num_rows() > 0) {
				$result = $query->row_array();
				$a=$result['type'];
				if($a=='now')
				{
					$user_currentTime = $this->event_model->getactualtime();
					$userTime = $user_currentTime;	
					
				} else if($a=='general') {
					$user_currentTime = $this->event_model->getactualtime();
					$userTime = $user_currentTime;	
				}
				/*else
				{
					echo $user_currentTime='deleted';	
				}*/
			}
			if(($grpTime < $userTime) and  ($userTime == 0))
			{
				 $grpTime;
			}
			else
			{
				echo $userTime;
			}
		}
	}
	public function gettimeold()
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
	
		//$this->load->model(array('class_model','location_model','ad_model','dashboardmessages_model','dchatmodel','event_model'));
		$this->load->model(array('class_model','location_model','ad_model','dashboardmessages_model','dchatmodel','event_model','category_model','notifications_model','languageandculture_model'));
		
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
		
		/* Suggest Tutor Start */
		$Suggest = array();	
		$Suggest1=array();
		$Suggest = $this->user_model->GetSuggestedTutor();
		$talkNowTut = $this->user_model->fnGetReadyToTalkNowUsers();
		if($Suggest !=array())
		{
			for($i=0;$i<count($Suggest);$i++)
			{
				if ($this->uid!=$Suggest[$i]['id']) {
					$Suggest1[] = $this->profile_model->getTutorProfile($Suggest[$i]['id']);
				}
			}
		}
		// Get Recent Tutor Search Data
		//$recentSearch = $this->user_model->fnGetUserByRecentSearch($this->uid);
		$suggTutors = array_merge($talkNowTut,$Suggest1);
		$this->load->model(array('search_model'));
		$suggTutors = $this->search_model->filterBookedTutors($suggTutors);
		$this->layout->setData('newtutors',$suggTutors);
		/* End Suggest Tutor */
		 
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
		
		// Get Category
		$categories = $this->category_model->GetCategories(0,10,"desc","id");
		$this->layout->setData('categories',$categories);
		
		// Get User Selected Topic
		$selTopic = $this->user_model->fnGetRecentSearch($this->session->userdata('uid'));
		$this->layout->setData('selTopic',$selTopic);
		
		// Get notifications
		$notifications = $this->notifications_model->selectData("*","`status` = 'Active'","order","Asc");
		$this->layout->setData('notifications',$notifications);
		
		// Get language and culture
		$languageandculture = $this->languageandculture_model->selectData("*","`status` = 'Active'");
		$this->layout->setData('languageandculture',$languageandculture);
		
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
				//$localTimeZone = $this->input->_request('localTimeZone');
				//$_time = strtotime($posttime);
				//$time = $_time - $localTimeZone*3600;
				$dateInLocal = date("Y-m-d g:i A", $this->event_model->outTime($posttime));
				//$dateInLocal = date("Y-m-d g:i A",strtotime($posttime));
				if($msg['user_id'] != '')
				{
					$profile = $this->profile_model->getProfile($msg['user_id']);
					$getreadytotalk = $this->profile_model->CheckIsonline($msg['user_id']);
					//checks for online user
					if (in_array($msg['user_id'], $onlineUsersData)) {
						$msg['online'] = 1;
					}else{
						$msg['online'] = 0;
					}
					$msg['roleId'] = $this->profile_model->getRoleId($msg['user_id']);
					
					$msg['hiddenRole'] = $this->profile_model->GetHiddenRole($msg['user_id']);
					
					if(isset($profile['pic']) && $profile['pic'] == '')
					{
						$msg['pic'] = base_url().'images/base/hd-pic.png';
					}else{
						//$msg['pic'] = $profile['pic'];
						@$msg['pic'] = base_url().'uploads/images/thumb/'.@$profile['pic'];
					}

					//create display username
					if(@$profile['lastName'] != '')
					{
						$lfist = substr($profile['lastName'],0,1);
					}else{
						$lfist = '';
					}
					if(@$profile['country'] != '')
					{
						$userCountryData = $this->location_model->getCountryById($profile['country']);
						if($userCountryData)
						{
							$cname = $userCountryData['country'];
						}
					}
					$userDisplayName = ucfirst(@$profile['firstName']).@$profile['uid'].', '.$cname;
				}else
				{
					$msg['pic'] = base_url().'images/base/hd-pic.png';
				}
				$xml .= '<message id="' . $msg['message_id'] . '">';
				$xml .= '<msgid>' . $msg['message_id'] . '</msgid>';
				$xml .= '<messageid>' . $msg['message_id'] . '</messageid>';
				$xml .= '<user>' . htmlspecialchars($userDisplayName) . '</user>';
				$xml .= '<text>' . htmlspecialchars($msg['message']) . '</text>';
				$xml .= '<time>' . $dateInLocal . '</time>';
				$xml .= '<user_id>' . $msg['user_id'] . '</user_id>';
				$xml .= '<user_img>' . htmlspecialchars($msg['pic']) . '</user_img>';
				$xml .= '<user_roleId>' . $msg['roleId'] . '</user_roleId>';
				$xml .= '<online>' . $msg['online'] . '</online>';
				$xml .= '<readytotalk>' . $getreadytotalk['readytotalk'] . '</readytotalk>';				
				$xml .= '<roleid>' .$msg['roleId'] . '</roleid>';
				$xml .= '<hiddenRole>' .$msg['hiddenRole']  . '</hiddenRole>'; 
				
				$xml .= '</message>';
			}
		}
		$xml .= '</root>';
		ob_end_clean();
		echo $xml;
	}
	public function chat_get_invitation()
	{
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
		header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
		header("Cache-Control: no-cache, must-revalidate" ); 
		header("Pragma: no-cache" );
		header("Content-Type: text/xml; charset=utf-8");
		$xml = ob_get_contents();
		$xml = '<?xml version="1.0" encoding="utf-8"?><root>';
		$this->load->model(array('profile_model','user_model','dchatmodel','location_model'));
		$cname = '';
		$query = $this->dchatmodel->getInvitation($this->uid);
		$data = $query->result_array();
		if(isset($data) && $data !='')
		{
			foreach($data as $msg)
			{
				if($msg['userid'] != '')
				{
					$profile = $this->profile_model->getProfile($msg['invitedbyuid']);
					if(isset($profile['pic']) && $profile['pic'] == '')
					{
						$msg['pic'] = base_url().'images/base/hd-pic.png';
					}else{
						$msg['pic'] = base_url().'uploads/images/thumb/'.$profile['pic'];
					}
					//create display username
					if($profile['lastName'] != '')
					{
						$lfist = substr($profile['lastName'],0,1);
					}else{
						$lfist = '';
					}
					if($profile['country'] != '')
					{
						$userCountryData = $this->location_model->getCountryById($profile['country']);
						if($userCountryData)
						{
							$cname = $userCountryData['country'];
						}
					}
					$userDisplayName = ucfirst($profile['firstName']).ucfirst($lfist).', '.$cname;
				}else
				{
					$msg['pic'] = base_url().'images/base/hd-pic.png';
				}
				$xml .= '<message id="' . $msg['id'] . '">';
				$xml .= '<invid>' . $msg['id'] . '</invid>';
				$xml .= '<user>' . htmlspecialchars($userDisplayName) . '</user>';
				$xml .= '<chatid>' . $msg['chatid'] . '</chatid>';
				$xml .= '<user_id>' . $msg['userid'] . '</user_id>';
				$xml .= '<user_img>' . htmlspecialchars($msg['pic']) . '</user_img>';
				$xml .= '</message>';
			}
		}
		$xml .= '</root>';
		ob_end_clean();
		echo $xml;
	}
	public function chat_invite_user()
	{
		$this->load->model(array('profile_model','user_model','dchatmodel'));
		$error = false;
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin)
		{
			redirect('user/login');
		}
		$uid = $this->session->userdata('uid');
		
		$delquery = "DELETE FROM dchat_group_user where userid = ".$uid." OR invitedbyuid = ".$uid;
		$dlq = $this->db->query($delquery);	

		foreach($_GET AS $key => $value) {
			// sanitize for SQL Injection
			${$key} = mysql_real_escape_string($value);
		}
		if($chat != ""){
			$current = date('Y-m-d h:i:s');	
			$this->dchatmodel->inviteUser($chat,$userid,$uid,$current);		
			$status['status'] = 'success';
			$this->output->set_content_type('application/json')->set_output(json_encode($status));
		}
	}
	function chat_check_blocked_user()
	{
		$this->load->model(array('dchatmodel'));
		$uid = $this->session->userdata('uid');
		$query = $this->dchatmodel->checkBlocked($uid);
		$data = $query->result_array();
		return $data[0]['chat'];
	}
	function chat_update_invitation()
	{
		$this->load->model(array('dchatmodel'));
		$uid = $this->session->userdata('uid');
		$cht = $_GET['chat'];
		$query = $this->dchatmodel->updateInvitation($uid,$cht);
		//echo $this->uid;
		// create a group for same user on
		/*
		$query1 = $this->dchatmodel->getInviteGroup($cht);
		$data = $query1->result_array();
		$nwgroup = $data[0];
		$nwgroup['uid'] = $uid;
		
		$queryc = $this->dchatmodel->create_group($nwgroup);
		*/
		//return $data[0]['chat'];
	}
	function chat_check_to_start()
	{
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
		header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
		header("Cache-Control: no-cache, must-revalidate" ); 
		header("Pragma: no-cache" );
		$this->load->model(array('dchatmodel'));
		$uid = $this->session->userdata('uid');
		$chtstatus = $_GET['chatstarted'];
		$rs = array();
		$query = $this->dchatmodel->getAcceptedInvitation($uid,$chtstatus);
		$result = $query->result_array();
		if($result)
		{
			$gid = $result[0]['chatid'];
		}else{
			$gid = '';
		}
		$rs['status'] = 'true';
		$rs['gid'] = $gid;
		$this->output->set_content_type('application/json')->set_output(json_encode($rs));
	}
	function chat_check_exists_group()
	{
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
		header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
		header("Cache-Control: no-cache, must-revalidate" ); 
		header("Pragma: no-cache" );
		$this->load->model(array('dchatmodel'));
		$uid = $this->session->userdata('uid');
		$chtid = $_GET['chat'];
		$rs = array();
		$check = $this->dchatmodel->checkExistsGroup($uid,$chtid);
		$rs['status'] = $check;
		$this->output->set_content_type('application/json')->set_output(json_encode($rs));
	}
	function chat_check_to_start_update()
	{
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
		header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
		header("Cache-Control: no-cache, must-revalidate" ); 
		header("Pragma: no-cache" );
		$this->load->model(array('dchatmodel'));
		$uid = $this->session->userdata('uid');
		$chatid = $_GET['chatid'];
		$query = $this->dchatmodel->getAcceptedInvitation_update($uid,$chatid);
	}
	function chat_check_banded_words($wordArray)
	{
		$this->load->model(array('dchatmodel'));
		$found = 0;
		$bandWordsArray = $this->dchatmodel->checkBandedWords();
		$bandWords = $bandWordsArray[0]['banded_words'];
		if(isset($wordArray) && count($wordArray)>0)
		{	
			foreach($wordArray as $word)
			{
				if(trim($word) != '' && strlen($word)>3):
					$pos = strpos($bandWords, $word);
					if($pos !== false)
					{
						$found = 1;
					}
				endif;
			}
		}
		return $found;
	}
	function check_porn_word()
	{
		$word = $this->input->_request('gid');
		$wordarray = explode(' ',$word);
		$return = $this->chat_check_banded_words($wordarray);
		echo json_encode(array('status'=>$return));
	}
	function chat_create_group()
	{
		if(!$this->user){
			redirect('user/login');
		}
		$this->_profile();
		$permission = $this->getPermission($this->uid);
		$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
		$this->layout->setData('linkType',$type);
		$chat_name = '';
		$owner_message = '';
		$this->layout->setData('chat_name',$chat_name);
		$this->layout->setData('owner_message',$owner_message);
		$this->layout->view('user/dashboard/createGroup');
	}
	function chat_delete_group()
	{
		$dchatmodel = $this->load->model('dchatmodel');
		$formData['gid'] = $this->input->_request('gid');
		$formData['uid'] = $this->uid;
		if($formData)
		{
			$gid = $this->dchatmodel->delete_group($formData);
			$msg['result'] = 'success';
		}
		echo json_encode(array('status'=>true,'result'=>'success'));
	}
	
	function chat_delete_invitation()
	{
		$dchatmodel = $this->load->model('dchatmodel');
		$formData['gid'] = $this->input->_request('gid');
		$formData['uid'] = $this->uid;
		if($formData)
		{
			$gid = $this->dchatmodel->delete_invitations($formData);
			$msg['result'] = 'success';
		}
		echo json_encode(array('status'=>true,'result'=>'success'));
	}
	function chat_save_group()
	{
		$dchatmodel = $this->load->model('dchatmodel');
		
		$formData['groupname'] = $this->input->_request('groupname');
		$formData['ownermessage'] = $this->input->_request('ownermessage');
		$formData['uid'] = $this->uid;
		if($formData)
		{
			$gid = $this->dchatmodel->create_group($formData);
			$msg['success'] = true;
		}
		echo json_encode(array('status'=>true,'msg'=>'Group Created!','gid'=>$gid));		
	}
	function chat_group()
	{
		$this->layout->setLayout('none');
		if(!$this->user){
			redirect('user/login');
		}
		$gid = $this->input->_request('gid');
		$uid = $this->uid;
		$this->load->model(array('dchatmodel','profile_model'));
		$this->layout->setData('gid',$gid);
		if($gid == '')
		{
			$gid = 1;
		}
		if($gid == '' || $gid == 1)
		{
			$myGroups = $this->dchatmodel->getGroups($uid);
			$this->layout->setData('myGroups',$myGroups);
		}
		$onlineUsersData = $this->getOnlineUsers();
		$onlineUsers = array();
			if($onlineUsersData)
			{
				$u = 0;
				foreach($onlineUsersData as $udataid)
				{
					if($udataid == $uid)
					{
						continue;
					}else{
						$onlineUserDataRecord = $this->profile_model->getProfile($udataid);
						$onlineUsers[$u]['uid'] = $udataid;
						$onlineUsers[$u]['pic'] = $onlineUserDataRecord['pic'];
						$onlineUsers[$u]['welcomeuser'] = $onlineUserDataRecord['firstName'].' '.$onlineUserDataRecord['lastName'];
						$queryInv = $this->dchatmodel->getInvitationByGroup($udataid,$gid);
						if($queryInv){
							if ($queryInv->num_rows() > 0) {
								$onlineUsers[$u]['invitationStatus'] = 1;
							}else{
								$onlineUsers[$u]['invitationStatus'] = 0;
							}
						}
						//$queryInvStatus = $this->dchatmodel->getInvitationStatus($udataid);
						$queryInvStatus = $this->dchatmodel->getInvitationStatusByGroup($udataid,$gid);
						if($queryInvStatus){
							$onlineUsers[$u]['chatInvitationStatus'] = $queryInvStatus[0]['status'];
						}
					}
					$u++;
				}
				$this->layout->setData('onlineUsers',$onlineUsers);
			}
		
		$this->_profile();
		$permission = $this->getPermission($this->uid);
		$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
		$this->layout->setData('linkType',$type);
		$chat_name = '';
		$owner_message = '';
		$this->layout->view('user/dashboard/chatgroup');
	}
	function invite()
	{
		if(!$this->user){
			redirect('user/login');
		}
		$sql1 = "select userid, invitedbyuid from dchat_group_user where invitedbyuid = ".$this->uid ." OR userid = ".$this->uid." ORDER BY invitedbyuid DESC";;
		$query1 = $this->db->query($sql1);
		$result1 = $query1->result_array();
		if($this->uid == $result1[0]['userid']){ 
			$thirduserid1 = $result1[0]['invitedbyuid'];
		}elseif($this->uid == $result1[0]['invitedbyuid']){
			 $thirduserid1 = $result1[0]['userid'];
		}
		$sql = "select chat_id from dchat where user_id = ".$this->uid." OR user_id = ".$thirduserid1." ORDER BY chat_id DESC";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		$seconduserid = $result[0]['chat_id'];
		$gid = $seconduserid;
		$uid = $this->uid;
		$privateUser = $this->profile_model->getProfile($thirduserid1);	
		$this->layout->setData('privateUser',$privateUser);
		$this->load->model(array('dchatmodel','profile_model'));
		$this->layout->setData('gid',$gid);
		if($gid == '')
		{
			$gid = 6;
		}
		if($gid == '' || $gid == 1)
		{
			$myGroups = $this->dchatmodel->getGroups($uid);
			$this->layout->setData('myGroups',$myGroups);
		}
		$onlineUsersData = $this->getOnlineUsers();
			$onlineUsers = array();
			if($onlineUsersData)
			{
				$u = 0;
				foreach($onlineUsersData as $udataid)
				{
					if($udataid == $uid)
					{
						continue;
					}else{
						$onlineUserDataRecord = $this->profile_model->getProfile($udataid);
						$onlineUsers[$u]['uid'] = $udataid;
						$onlineUsers[$u]['pic'] = $onlineUserDataRecord['pic'];
						$onlineUsers[$u]['welcomeuser'] = $onlineUserDataRecord['firstName'].' '.$onlineUserDataRecord['lastName'];
						$queryInv = $this->dchatmodel->getInvitationByGroup($udataid,$gid);
						if($queryInv){
							if ($queryInv->num_rows() > 0) {
								$onlineUsers[$u]['invitationStatus'] = 1;
							}else{
								$onlineUsers[$u]['invitationStatus'] = 0;
							}
						}
						$queryInvStatus = $this->dchatmodel->getInvitationStatusByGroup($udataid,$gid);
						if($queryInvStatus){
							$onlineUsers[$u]['chatInvitationStatus'] = $queryInvStatus[0]['status'];
						}
					}
					$u++;
				}
				$this->layout->setData('onlineUsers',$onlineUsers);
			}
		
		$this->_profile();
		$permission = $this->getPermission($this->uid);
		$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
		$this->layout->setData('linkType',$type);
		$chat_name = '';
		$owner_message = '';
		
		$this->layout->view('user/dashboard/invite');
	}
	
	function chat_groups()
	{
		if(!$this->user){
			redirect('user/login');
		}
		$gid = $this->input->_request('gid');
		$uid = $this->uid;
		$this->load->model(array('dchatmodel'));
		$myGroups = $this->dchatmodel->getGroups($uid);
		$this->_profile();
		$permission = $this->getPermission($this->uid);
		$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
		$this->layout->setData('linkType',$type);
		$chat_name = '';
		$owner_message = '';
		$this->layout->setData('chat_name',$chat_name);
		$this->layout->setData('owner_message',$owner_message);
		$this->layout->view('user/dashboard/createGroup');
	}
	
	public function getOnlineUsers()
	{
		//$sql = "select DISTINCT uid from ci_sessions where uid!=''";
		$sql = "select DISTINCT id from user where is_login=1 ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			foreach($result as $k=>$v){
				$results[] = $v['id'];
			}
			$results = array_unique($results);
		}
		return $results;
	}
	/**
	* @author SKVIRJA
	* @function hiddenRoleUpdate on 05 July 2013
	**/
	function hiddenRoleUpdate()
	{
		$this->user_model->user_edit(array('hiddenRole'=>$this->input->post('hiddenRole')), $this->uid);
		echo json_encode(array('status'=>'success'));
	}
	/**
	* @author SKVIRJA* @function ready to talk update on 20 Sep 2013**/
	function readytotalkUpdate()
	{
		$readToTalk = $this->input->post('readytotalk');
		$this->load->model(array('profile_model'));
		$this->user_model->user_edit(array('readytotalk'=>$this->input->post('readytotalk')), $this->uid);
		$nowdate = date('Y-m-d H:i:s',time());
		if($readToTalk == 1)
		{
			$expTimeDate = date('Y-m-d H:i:s',time());
			$expTime = strtotime($expTimeDate) + 7200;
			$this->session->set_userdata(array('booknowexp'=>$expTime));
			$sql = "SELECT id FROM class WHERE startTime = '0000-00-00 00:00:00' AND endTime = '0000-00-00 00:00:00' AND type = 'now' and tid = {$this->uid}";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$existingEmptyClass = $query->row_array();			
			}else{
				$existingEmptyClass = '';
			}
			if($existingEmptyClass)
			{
				$cid = $existingEmptyClass['id'];
			}else{
				$profile = $this->profile_model->getProfile($this->uid);
				$config = $this->profile_model->getConfig();
				$fee = round($profile['hRate'] * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
				}
			/*$apiKey = $data['apiKey'] = '21029512' ;
			$api_secret = "ea40167d9c3b010598d37be3565276b2e1b2c488";
			$this->load->library('OpenTokSDK',array('api_key'=>$apiKey,'api_secret'=>$api_secret));
			$this->load->model(array('class_model'));
			$session = $this->opentoksdk->createSession( $_SERVER["REMOTE_ADDR"], array(SessionPropertyConstants::P2P_PREFERENCE=> "enabled") );
			$sessionId = $session->getSessionId();
			$tokenS = '';
			$tokenT = '';*/
		}else{
			$unset_items = array('booknowexp' => '');
			$this->session->unset_userdata($unset_items);
		}
		echo json_encode(array('status'=>'success'));
	}
	public function getInstantOnlineUsers()
	{
		$_SESSION['queryString'];
		$allsql = "select uid from profile where firstName LIKE '%".$_SESSION['queryString']."%'";
		$allquery = $this->db->query($allsql);
		$allresult = $allquery->result_array();
		foreach($allresult as $all):
			@$test .= $all['uid'].", ";
		endforeach;
		$finaltest = substr(@$test,0, -2);

		//$sql = "select DISTINCT uid from ci_sessions where uid IN (".$finaltest.")";
		$sql = "select DISTINCT id from user where id IN (".$finaltest.") and is_login=1 ";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			foreach($result as $k=>$v){
				//$results[] = $v['uid'];
				$results[] = $v['id'];
			}
		}
		return @$results;
	}

	public function profile(){
	if($this->uid == '')
		{
			redirect('user/login');
		}
		$permisson = $this->getPermission($this->uid);
		if(strpos($permisson,'student') > -1){
			if($this->uid == $this->user['uid']){
			
				redirect('user/calendar');
			}
			else {
			
				redirect('user/calendar/uid/'.$this->uid);
			}
		}
		else {
				//echo $this->uid;die();
				//echo "hiren" .$this->uid;die();
			 $this->_profile();
			if($permisson == 'teacher_public'){
				$this->layout->setLayoutData('linkAttr','publicuser');
			}
			$this->load->model(array('search_model'));
			$chkfreesession = $this->search_model->chkfreesession($this->uid);
			$ratings = $this->profile_model->getRatings($this->uid);
			$GroupRating = $this->profile_model->GroupRating($this->uid);
			
			$this->layout->setData('GroupRating',$GroupRating);
			
			$ReadyTalk = $this->profile_model->CheckIsonline($this->uid);
			$this->layout->setData('readyTalk',$ReadyTalk['readytotalk']);
			$schoolTut = $this->profile_model->CheckIsSchoolTutor($this->uid);
			
			$Ismarkset=0;
			if($schoolTut['school_id'] > 0)
			{
				$sql="select pic,curriculum,s_disc from profile where uid={$schoolTut['school_id']}";
				$query = $this->db->query($sql);
				 $result = $query->row_array();
				 $this->layout->setData('logo',$result['pic']);
				 $this->layout->setData('disc',$result['s_disc']);
				 $Ismarkset=$result['curriculum'];
			}

			$this->layout->setData('Ismarkset',$Ismarkset);
			$this->layout->setData('schtut',$schoolTut['school_id']);

			$sessionCount = $this->profile_model->sessionCount($this->uid);
			
			$GroupsessionCount = $this->profile_model->GroupsessionCount($this->uid);
			$GetGroupRating = $this->profile_model->GetGroupRating($this->uid);
		 
			$this->layout->setData('GetGroupRating',$GetGroupRating);
			$this->layout->setData('GroupsessionCount',$GroupsessionCount);

			$this->layout->setData('ratings',$ratings);
			$this->load->model("class_model");
			$completedSessions = $this->class_model->completedSessions($this->uid);
			$completedSessions = $completedSessions['cnt'];
			$this->layout->setData('sessionCount',$completedSessions);
			//$this->layout->setData('sessionCount',$sessionCount);
			$this->layout->setData('chkfreesession',$chkfreesession);
                        $uri=$this->uri->segment(5);
                        $this->load->model("user_model");
                        $config = $this->profile_model->getConfig();
                        $configvalues = ((1+$config['VEE_PRICE_PERCENT']['value']) *100);
                        //echo $this->uid." : ".$uri." : ".$this->session->userdata('uid');
						  if($this->session->userdata('uid') =='')
						  {
							  $q = "Select hRate,school_id from profile where uid = ".$this->uid;
								$query = $this->db->query($q);
								$resultmoney = 0;
								if ($query->num_rows() > 0) 
								{
									$result = $query->result_array();
									foreach($result as $key => $values)
									{
										$resultmoney = $values["hRate"];
									}
								}
								$tutorcost = round($resultmoney * $configvalues)/100;
								$this->layout->setData('SessionCost',array('tutorcost' =>  $tutorcost));
						  }
						  else
						  {
						   
							$this->layout->setData('SessionCost',$this->user_model->getsesstioncostnew($this->session->userdata('uid'),$configvalues,$this->uid));
							
						}
						$this->layout->setData('SessionType',$uri);
						// Get Category
						$this->load->model('category_model');
						$categories = $this->category_model->GetCategories(0,10,"desc","id");
						$this->layout->setData('categories',$categories);
						
						// Get User Selected Topic
						$selTopic = $this->user_model->fnGetRecentSearch($this->session->userdata('uid'));
						$this->layout->setData('selTopic',$selTopic);						
                        $this->layout->view($this->getViewTemp($this->uid,'user/profile'));
		}
	}
	/**
	 *
	 *  show user profile page.
	 */
	public function _profile() {
		
		//check session
		$userModel =  $this->user_model;
		$profileModel = $this->profile_model;
		$uid = $this->uid;//$this->session->userdata('uid');
		$user = $userModel->getByUid($uid);
		$this->load->model('search_model');
		$user = $this->search_model->filterBookedTutors(array($user));
		$user = $user[0];
		$profile = $profileModel->getProfile($uid);
        $data['free_session'] = $profile['free_session'];
		$profile = array_merge($profile,$user);
		$langs = $this->langs_model->getLangs();
		$this->load->model('location_model');
		$countries= $this->location_model->getCountries(0);
		$timezone= $this->location_model->GetTimezone();
		$profile['country'] = isset($profile['country'])?$profile['country']:0;
		$province[$profile['country']] = $this->location_model->getProvices($profile['country']);
		$data['personal1'] = str_replace( "<br />", "\n",$profile['personal']);
		$data['profile'] = $profile;
		$data['langs'] = json_encode($langs);
		$data['countries'] = $countries;
		$data['timezone'] = $timezone;
		$data['province'] = $province;
		// get unread messages of this user
		
		  $home_profile = $this->session->userdata('uid');
		  if($home_profile !="")
		  {
		$unreadMessages = $this->unread_message_counter();
		}
		$data['unreadMessages'] = $unreadMessages;
		// get training requirements
		if($profile['roleId'] == 1 || $profile['roleId'] == 2 || $profile['roleId'] == 3)
		{
			/*$this->load->model('lms_model');
			if($profile['lms_complete'] == 0)
			{
				
				$documents = $this->lms_model->getAll();
				if($documents)
				{
					$data['documents'] = $documents;
				}
				//get read document ids
				$documentsReadIds = $this->lms_model->read_doc_ids($this->uid);
				if($documentsReadIds)
				{
					$i = 0;
					$readDocIds = array();
					foreach($documentsReadIds as $documentsReadId)
					{
						$readDocIds[$i] = $documentsReadId['docid'];
						$i++;
					}
					$data['readDocIds'] = $readDocIds;
				}
			}
			$re_test = $this->lms_model->getReTestCheck($this->uid);
			$data['re_test'] = $re_test;*/
		}	
		
		//checks for has opened session
		$data['hasSession'] = $this->search_model->hasSession($uid);
		
		$permission = $this->getPermission($uid);
		$data['permission'] = $permission;
		
		$this->layout->setData($data);
		$config = $this->location_model->getConfig();
		$this->layout->setData('config',$config);
	}
	public function changeInfo(){
		if(!$this->user){
			redirect('user/login');
		}
		$this->load->helper('form');
		$langs= $this->langs_model->getLangs();
		$this->_profile();
		$permission = $this->getPermission($this->user['uid']);
		$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
		$this->layout->setData('linkType',$type);

		if($data =$this->input->post()){
			$error 			= false;
			$user 			= $this->user_model->getByUid($this->user['uid']);
			$_data['uid'] 	= $this->user['uid'] ;
			if($data['profile_tab'] == 'personal'){
				if(isset($data['name'])   && $data['name'] != ""){
					$fullName = $data['name'];
					$fullNameArray = explode(' ', $data['name']);
					if($fullNameArray[0] != ""){
						$_data['firstName'] = $fullNameArray[0];
						$this->profile_model->update($_data);
					}
					if($fullNameArray[1] != ""){
						$_data['lastName'] = $fullNameArray[1];
						$this->profile_model->update($_data);
					}
				}

				//--FOR PERSONAL INFO
				$_data['age'] 			= $data['age'];
				$_data['gender'] 		= $data['gender'];
				$_data['address'] 		= $data['address'];
				$_data['city'] 			= $data['city'];
				$_data['province'] 		= $data['provinceid'];
				$_data['country'] 		= $data['country'];
				//$_data['timezone'] 		= $data['timezone'];
				 if($data['timezone'] !='')
				 {
					// echo "here"; die();
					$this->profile_model->updateTimezone($data['timezone'],$this->user['uid']);
				 }
				$this->profile_model->update($_data);
				redirect('user/changeInfo?tab=personal');
			}elseif($data['profile_tab'] == 'password'){
				//--FOR ACCOUNT INFO
				if($data['new_password']	!=	""){
				//--Check for current password
					if($data['new_password'] == ''){
						//$this->layout->setData('error',$error['message']);
					}elseif($data['new_password'] != ''	&& $data['new_password']	!= $data['new_password2']){
					
					}else{
						$_data['password'] 			= $data['new_password'];
					}
					$this->user_model->changePassword($_data['uid'] , $_data['password']);
				}
				if($data['cell_number']	!=	""){
					$_data['cell'] 			= $data['cell_number'];
					$this->profile_model->update($_data);
				}
				
				redirect('user/changeInfo?tab=password');
			}elseif($data['profile_tab'] == 'contact'){
				//--FOR CONTACT INFO
				if($data['email']	!=	""){
					$_data['email'] 			= $data['email'];
					$this->profile_model->update($_data);
				}
				/*if($data['cell']	!=	""){
					$_data['cell'] 			= $data['cell'];
					$this->profile_model->update($_data);
				}*/
				if($data['cell']	!=	""){
					$data['cell']=preg_replace("/[^0-9+-]/", '', $data['cell']);
					$_data['cell'] 			= $data['cell'];
					$this->profile_model->update($_data);
				}
				if($data['zipcode']	!=	""){
					$_data['zipcode'] 			= $data['zipcode'];
					$this->profile_model->update($_data);
				}
				if($data['networkPage']	!=	""){
					$_data['networkPage'] 			= $data['networkPage'];
					$this->profile_model->update($_data);
				}
				redirect('user/changeInfo?tab=contact');
				
				
			}elseif($data['profile_tab'] == 'financial'){
				//--FOR FINANCIAL INFO
				if($data['payment_account']	!=	""){
					$_data['payment_account'] 			= $data['payment_account'];
					$this->profile_model->update($_data);
					
                    }
				if($data['hRate']	!=	""){
					$_data['hRate'] 			= $data['hRate'];
					$this->profile_model->update($_data);
				}
				if($data['free_session']!=	""){
					$_data['free_session'] = $data['free_session'];
					//$this->profile_model->update($_data);
					$this->profile_model->updateFsession($this->uid,$_data['free_session']);
					$this->profile_model->updateFsessionpro($this->uid,$_data['free_session']);
				}
				if($data['payment_type']	!=	""){
					$_data['payment_type'] 			= $data['payment_type'];
					$this->profile_model->update($_data);
				}
				redirect('user/changeInfo?tab=financial');
			}elseif($data['profile_tab'] == 'language'){
				//--FOR TUTORING INFO
				if($data['nativeLanguage']	!=	""){
					$_data['nativeLanguage'] 			= $data['nativeLanguage'];
					$_data['otherLanguage'] 			= $data['otherLanguage'];
					$this->profile_model->update($_data);
				}
				redirect('user/changeInfo?tab=language');
			}/* Added By Ilyas */ 
			elseif($data['profile_tab'] == 'role'){
				$this->user_model->fnUpdateUser(array("roleId"=>$data['universal_roleId'],"universal_roleId"=>$data['universal_roleId']),array("id"=>$this->user['uid']));
				$this->session->set_userdata(array('roleId'=>$data['universal_roleId']));
				if($data['universal_roleId']=='1')
				{
					//redirect('user/dashboard?chng=br');
					$this->session->set_userdata('upAct', 1);
					redirect('user/upgradeaccount');
				}
				else
				{
					redirect('user/changeInfo?tab=role');
				}
			}/* End */
			
			//redirect('user/changeInfo');
		}

		$user = $this->user_model->getByUid($this->user['uid']);
		//--R&D@JAN-29-2014
		
		if($this->input->post('profile_tab')){
			$currentTab = $this->input->post('profile_tab');
		} else if($_GET['tab']){
			$currentTab = $_GET['tab'];
		} else {
			$currentTab = 'personal';
		}
		$this->layout->setData('currentTab',$currentTab);
		//--R&D@JAN-29-2014
       $tid=$this->user['uid'];
		 
		 
	  $profileModel = $this->profile_model;
		
		$pr = $profileModel->getProfile($tid);
 
		$sid= $pr['school_id'];
		//echo $tid;
		if($sid >0)
		{
		$alldata = $profileModel->getUserName($sid,$tid);

        if($alldata >0)
		  $school=$alldata[0]['firstName'].' '. $alldata[0]['lastName'];
		  else
		  $school='';
		}
		else
		{
		 $school='';
		}
		if($user['roleId']==0)
		{
		$link='st';
		}
		if($user['roleId']==1 || $user['roleId']==2 || $user['roleId']==3 )
		{
		$link='tu';
		}
		if($user['roleId']==4)
		{
		$link='sc';
		}
		if($user['roleId']==5)
		{
		$link='af';
		}
		 
		/*if($pr['payment_account']!=	"")
		{*/
		   $encode =  $this->user_model->encode($this->session->userdata['uid'],"This is a key"); 
		   $this->layout->setData('encode',base_url().$link.'/'.$encode);
		//}
		$this->layout->setData('langs',$langs);
		$this->layout->setData('sname',$school);
		$this->layout->setData('email',$user['email']);
		$this->layout->setData('roleid',$user['roleId']);
		$this->layout->view('user/changeInfo');
	}
	/*** profile_image update theuser's profile's image **/
	public function profile_image(){
		$this->load->library('media','upload');
		$upConfig['upload_path'] = FCPATH.'uploads/images/';
		//$config['upload_path'] = './';
		$upConfig['allowed_types'] = 'gif|jpg|png|jpeg';
		$upConfig['encrypt_name'] = true;
		$resizeConfig['image_library'] = 'gd2';
		//$resizeConfig['source_image'] = '/path/to/image/mypic.jpg';
		$resizeConfig['new_image'] = FCPATH.'uploads/images/thumb/';
		$resizeConfig['maintain_ratio'] = TRUE;
		/*$resizeConfig['width'] = 240;
		$resizeConfig['height'] = 200;*/
		$this->image_lib->resize();
		$this->media->upload($upConfig)->resize($resizeConfig);
		if(!$this->media->error){
			$this->profile_model->updateProfileImage($this->media->sqlAddress,$this->user['uid']);
		}
		if($this->media->error){
			echo json_encode($this->media->error);
		}
		else {
			$this->load->model('media_model');
			$mediaInfo = $this->media->data['upload_data'];
			$mediaInfo['uid'] = $this->user['uid'];
			$mediaInfo['address'] = $this->media->sqlAddress;
			$this->media_model->save($mediaInfo);
			$this->session->set_userdata(array('pic'=>$this->media->sqlAddress));
			echo json_encode( array('address'=>Base_url('/uploads/images/thumb/'.$this->media->sqlAddress ),'addressoriginal'=>$this->media->sqlAddress ) );
		}
		$basePath =  substr(BASEPATH,0,-7);
		@$filename = $basePath.'uploads/images/'.$this->media->sqlAddress;
		if(file_exists($filename))
		{
			@$size = getimagesize($filename);
			if($size[0]>1180 || $size[1]>550)
			{
				if($size[0]>1180 && $size[1]>550)
				{
					$nwidth = 1180;
					$nheight = 550;
				}else if($size[0]>1180 && $size[1]<=550)
				{
					$nwidth = 1180;
					$nheight = $size[1];
				}else{
					$nwidth = $size[0];
					$nheight = 550;
				}
				
			}else{
				$nheight = $size[1];
				$nwidth = $size[0];
			}
			$resizeConfig_resize['image_library'] = 'gd2';
			$resizeConfig_resize['new_image'] = FCPATH.'uploads/images/resized/';
			$resizeConfig_resize['maintain_ratio'] = TRUE;
			$resizeConfig_resize['width'] = $nwidth;
			$resizeConfig_resize['height'] = $nheight;
			$this->image_lib->resize();
			$this->media->resize($resizeConfig_resize);
			
			$tresizeConfig_resize['new_image'] = FCPATH.'uploads/images/thumb/';
			$tresizeConfig_resize['maintain_ratio'] = TRUE;
			$tresizeConfig_resize['width'] = $nwidth;
			$tresizeConfig_resize['height'] = $nheight;
			$this->image_lib->resize();
			$this->media->resize($tresizeConfig_resize);
		}
		$userId=$this->user['uid'];
		$sql="update profile set pic_upload=1 where uid='{$userId}'";
		$this->db->query($sql);
	}
	
	public function profile_video(){
		//echo 11;exit;
		$this->load->library('media','upload');
		$upConfig['upload_path'] = FCPATH.'uploads/video/';
		$upConfig['allowed_types'] = '*';
		$upConfig['encrypt_name'] = true;
		$translateConfig['image_library'] = 'gd2';
		//$resizeConfig['source_image'] = '/path/to/image/mypic.jpg';
		$translateConfig['image'] = FCPATH.'uploads/video/images/';
		$translateConfig['path'] = FCPATH.'uploads/video/';
		$translateConfig['maintain_ratio'] = TRUE;
		$translateConfig['width'] = 706;
		$translateConfig['height'] = 399;
		$this->media->upload($upConfig);
		//$this->media->upload($upConfig)->translate($translateConfig);
		if(!$this->media->error){
			$this->profile_model->updateProfileVideo($this->media->sqlAddress,$this->user['uid']);
		}
		if($this->media->error){
			echo json_encode($this->media->error);
		}
		else {
			$this->load->model('media_model');
			$mediaInfo = $this->media->data['upload_data'];
			$mediaInfo['uid'] = $this->user['uid'];
			$mediaInfo['address'] = $this->media->sqlAddress;
			$this->media_model->save($mediaInfo);
			$userId=$this->user['uid'];
			$sql="update profile set vid_upload=1,`video_status`=100 where uid='{$userId}'";
			$this->db->query($sql);
			
			echo json_encode(
								array('video'=>Base_url('/uploads/video/'.$this->media->sqlAddress),
									'videoname'=>$this->media->sqlAddress,					
									'image'=>Base_url('/uploads/video/images/'.$this->media->sqlAddress )
								)
							);
		}
	}
	public function profile_video_old(){
		//echo 11;exit;
		$this->load->model('media_model');
		 $this->load->model('profile_model');
		$this->load->library('media','upload');
		$upConfig['upload_path'] = FCPATH.'uploads/video/';
		$upConfig['allowed_types'] = '*';
		$upConfig['encrypt_name'] = true;
		$translateConfig['image_library'] = 'gd2';
		//$resizeConfig['source_image'] = '/path/to/image/mypic.jpg';
		$translateConfig['image'] = FCPATH.'uploads/video/images/';
		$translateConfig['path'] = FCPATH.'uploads/video/';
		$translateConfig['maintain_ratio'] = TRUE;
		$translateConfig['width'] = 706;
		$translateConfig['height'] = 399;
		$translateConfig['i'] = 399;
		$this->media->upload($upConfig);
		//$this->media->upload($upConfig)->translate($translateConfig);
		if(!$this->media->error){
			$date_dir = date('Y').'/'.date('m').'/'.date('d').'/';
			$this->profile_model->updateProfileVideo($date_dir.$this->media->sqlAddress,$this->user['uid']);
		}
		if($this->media->error){
			echo json_encode($this->media->error);
		}
		else {
			//$this->load->model('media_model');
			$mediaInfo = $this->media->data['upload_data'];
			$mediaInfo['uid'] = $this->user['uid'];
			$mediaInfo['address'] = $this->media->sqlAddress;
			$this->media_model->save($mediaInfo);
			$userId=$this->user['uid'];
			//$sql="update profile set vid_upload=1 where uid='{$userId}'";
			$sql="update profile set vid_upload=1,`video_status`=100 where uid='{$userId}'";
			$this->db->query($sql);
			
			echo json_encode(
								array('video'=>Base_url('/uploads/video/'.$this->media->sqlAddress),
									'image'=>Base_url('/uploads/video/images/'.$this->media->sqlAddress )
								)
							);
		}
	}
	public function upgrade(){
		if(!isset($this->user['uid'])){
			echo json_encode(array('status'=>false,'msg'=>'Must login first!'));
			return;
		}
		$roleId = $this->session->userdata('roleId');
		if($roleId != 1){
			echo json_encode(array('status'=>false,'msg'=>'You can`t upgrade!not teacher or allready be upgraded teacher!'));
			return;
		}
		$permission = $this->getPermission($this->uid);
		if($permission!='teacher_private'){
			echo json_encode(array('status'=>false,'msg'=>'You can`t upgrade!It can only upgrade with teacher by self!'));
			return;
		}
		$this->user_model->upgrade($this->user['uid']);
		$this->session->set_userdata(array('roleId'=>2));
		echo json_encode(array('status'=>true));

		//var_dump($this->session);
		return;

	}
	/**
	 * OLD CODE BEFORE COMMTI @WDC
	 *
	 * register and process
	 
	
	*/
	/*
	*
	* NEW COMMIT FILE @WDC
	* public function register() 
	* public function registerDo()
	*/
	public function register() {
	if(isset($_REQUEST['code'])){// $this->weiboRegister(); 
	$get = $this->input->post();
	$errorMsg = array();
	$this->config->load('timezones',true);
	$timezones = $this->config->item('timezones','timezones');
	$this->load->model(array('location_model','langs_model'));
	$countries= $this->location_model->getCountries();
	$langs= $this->langs_model->getLangs();
	$outputVar = compact('countries','errorMsg','timezones','langs','get');
	$this->load->helper('form');
	$this->load->helper('date');
	$this->layout->view('user/register',$outputVar);
	}
	else
	{
	//--R&D@Oct-2013 : Check if from Weibo
	$userModel =  $this->user_model;
	$profileModel = $this->profile_model;
	$uid = 0;
	$islogin = $userModel->islogin();
	if($islogin) {
		redirect('user/profile');
	}

	$get = $this->input->post();
	$errorMsg = array();
	$this->config->load('timezones',true);
	$timezones = $this->config->item('timezones','timezones');
	//var_dump($timezones);
	$this->load->model(array('location_model','langs_model'));
	$countries= $this->location_model->getCountries();
	$langs= $this->langs_model->getLangs();
	$outputVar = compact('countries','errorMsg','timezones','langs','get');
	$this->load->helper('form');
	$this->load->helper('date');
	$this->layout->view('user/register',$outputVar);
	}
}
	// Check Registration Process
	public function registerDo(){
		if ($this->input->post()) {			
			$formData = $this->input->post();			
			if ( $formData['password']=='' && $formData['cpassword'] !='') {
				$formData['password'] = $formData['cpassword'];
			}
			if ($formData['roleId'] == '-1') { $formData['roleId'] =0; }
			$refid ='';
			$diffurl='';
			
			if (preg_match("/([.]+)/", $formData['refid'], $matches)) {
				$pieces = explode(".",$formData['refid']);
				$decode =  $this->user_model->decode($pieces[1],"This is a key");
				$formData['refid'] = $this->session->userdata('decode');
				$refid = $this->session->userdata('decode');
				$refid  = $decode;
			} else {
				$decode =  $this->user_model->decode($formData['refid'],"This is a key");
				$formData['refid'] = $this->session->userdata('decode');
				$refid = $this->session->userdata('decode');
				$refid  = $decode;
			}
			
			if ($refid !='') {
				$refdata=$this->user_model->getByUid($refid);
			}
			
			if ($refdata['roleId']==4 && $formData['roleId'] <=1) {
				$formData['refid'] = $refid;
				$diffurl='yes';
			} else if ($refdata['roleId']!=4) {
				$formData['refid'] = $refid;
			} else {
				$formData['refid'] = 0;
			}
			$this->session->unset_userdata('decode');
			$_SESSION['isRegError'] = TRUE;
			$_SESSION['regError']   = $errorMsg;
			if (isset($_POST['regPage']) && $_POST['regPage'] =='ppc') {
				$formData['username'] = $formData['email'];
			}
			$errorMsg = $this->user_model->checkEmail($formData['email']);
			if($errorMsg['success']) {
				$errorMsg = $this->user_model->checkPassword($formData['password']);
			}
			$this->session->set_userdata('firstTimeRegister','yes');
			$this->session->set_userdata('sturegister','yes');
			$arrVal = $this->lookup_model->getValue('815', $multi_lang);
			$selecType = $arrVal[$multi_lang];
			if ($formData['roleId']==9) {
				$errorMsg['message'] = $selecType;
				$errorMsg['success'] = false;
			}  
			if ($errorMsg['success'] == false) {
				if(!isset($_POST['regPage'])){
					echo json_encode($errorMsg);
					exit;
				} else {
					$_SESSION['isRegError'] = TRUE;
					$_SESSION['regError']   = $errorMsg['message'];
					$this->session->set_userdata('RegLink',$errorMsg['message']);
					redirect($_POST['regReturn']);
					exit;
				}
			} else {
				if ($formData['roleId']  == 0) {
					$formData['free_session'] = 'y';
					$formData['is_eligible'] = 1;
				} else {
					$formData['free_session'] = 'y';
				}
				
				/* Added By Ilyas */	
				$formData['universal_roleId'] = 0;
				if($formData['roleId']  == 1 or $formData['roleId']  == 0)
				{
					$formData['universal_roleId'] = $formData['roleId'];
					$formData['free_session'] = 'y';
					$formData['is_eligible'] = 1;
				}
				/* end */
				$testAccount=$_POST['email'];
				$domain = substr(strrchr($testAccount, "@"), 1);
				$domain = mb_strtolower($domain,'UTF-8');
				if($domain == 'ttlmail.com')
				{
					 $formData['testAccount']='1';	
				}	 
				else
				{
					 $formData['testAccount']='0';
				}

				// Get Location Details
				$ipInfoSESSION = $this->geolocater->getMaxMindlocation();
				/* Add Timezone */
				$formData['timezone'] = $ipInfoSESSION['time_zone'];
				$uid = $this->user_model->register($formData);
			}
			
			if ($uid) {
				$formData['uid'] = $uid;
				$formData['new'] = 1;
				//default setting for message box
				$formData['alerts'] = 30;
				$formData['textalert'] = 30;
				$formData['alertType'] = '11';
				$formData['country'] = $ipInfoSESSION['countryId'];
				$formData['city'] = $ipInfoSESSION['geocity'];
				$formData['ipaddress'] = $ipInfoSESSION['remoteIp'];
				$formData['Lng'] = $ipInfoSESSION['longitude'];
				$formData['Lat'] = $ipInfoSESSION['latitude'];
				if ($refdata['roleId']==4) {
					$formData['school_id'] = $refid;
				} else {
					$formData['school_id'] = '0';
				}
				
				if ($formData['roleId']  <= 1) {
					 $formData['hRate'] = '3.76';
				}
				
				$formData['nativeLanguage'] = "English";
				if (isset($ipInfoSESSION['multi_lang_name'])) { 
					$formData['nativeLanguage'] = $ipInfoSESSION['multi_lang_name'];
				}
				$this->profile_model->save($formData);
				$profile = $this->profile_model->getProfile($uid);
				
				if (($formData['roleId']  == 0) and ($formData['universal_roleId'] = 0)) {
					$str = "<b>Welcome to TheTalkList.com, where real people teach real language!</b> We have worked hard at building the best 1 to 1 learning environment. Learning a language will be more convenient than ever.  \r\n<br/>";
					$str .= "\r\n<br/>";
					
					/*$str .= "Please click on below link to activate your account: <a target='_blank' href='".base_url('user/confirm?confrim='.$uid)."'>Confirmation Link</a>\r\n<br/>";
					$str .= "<a>".base_url('user/confirm?confrim='.$uid)."</a>\r\n<br/>";
					$str .= "\r\n<br/>";*/
					
					$str .= "Your login email:\r\n<br/>";
					$str .= "Email: {$formData['email']}\r\n<br/>";
					//$str .= "Password: {$formData['password']}\r\n<br/>";
					$str .= "Password: XXXXXX\r\n<br/>";
					$str .= "\r\n<br/>";
					$str .= "New Member Tips: \r\n<br/>";
					$str .= "<ul>";
					$str .= "<li>Schedule your first Free Session.</li>";
					$str .= "<li>Test our Video Session tools using a high speed connection (greater than 1 mbps).</li>";
					$str .= "<li>Live text chat with other members.</li>";
					$str .= "<li>Like our Facebook and Instagram pages.</li>";
					$str .= "</ul>";
					
				} else if($formData['roleId'] == 0) {
					$str = "<b>Welcome to TheTalkList.com, where real people teach real language!</b> We have worked hard at building the best 1 to 1 learning environment. Learning a language will be more convenient than ever.  \r\n<br/>";
					$str .= "\r\n<br/>";
					
					/*$str .= "Please click on below link to activate your account: <a target='_blank' href='".base_url('user/confirm?confrim='.$uid)."'>Confirmation Link</a>\r\n<br/>";
					$str .= "<a>".base_url('user/confirm?confrim='.$uid)."</a>\r\n<br/>";
					$str .= "\r\n<br/>";*/
					
					$str .= "Your login email:\r\n<br/>";
					$str .= "Email: {$formData['email']}\r\n<br/>";
					//$str .= "Password: {$formData['password']}\r\n<br/>";					
					$str .= "Password: XXXXXX\r\n<br/>";
					$str .= "\r\n<br/>";
					$str .= "New Member Tips: \r\n<br/>";
					$str .= "<ul>";
					$str .= "<li>Schedule your first Free Session.</li>";
					$str .= "<li>Test our Video Session tools using a high speed connection (greater than 1 mbps).</li>";
					$str .= "<li>Live text chat with other members.</li>";
					$str .= "<li>Like our Facebook and Instagram pages.</li>";
					$str .= "</ul>";
				} else if ($formData['roleId'] == 1) {
					$str = "<b>Welcome to TheTalkList.com, where you will earn money helping people speak like a native!</b>   We have worked hard at building the best 1 to 1 learning environment. Learning a language will be more convenient than ever.  \r\n<br/>";
					$str .= "\r\n<br/>";
					
					
					$str .= "Please click on below link to activate your account: <a target='_blank' href='".base_url('user/confirm?confrim='.$uid)."'>Confirmation Link</a>\r\n<br/>";
					$str .= "<a>".base_url('user/confirm?confrim='.$uid)."</a>\r\n<br/>";
					$str .= "\r\n<br/>";
					
					$str .= "Your login information:\r\n<br/>";
					$str .= "Email: {$formData['email']}\r\n<br/>";
					//$str .= "Password: {$formData['password']}\r\n<br/>";					
					$str .= "Password: XXXXXX\r\n<br/>";
					$str .= "\r\n<br/>";
					
					/*$str .= "New Tutor Tips:\r\n<br/>";
					$str .= "<ul>";
					$str .= "<li>Test our Video Session tools using a high speed connection (greater than 1 mbps).</li>";
					$str .= "<li>Make yourself appealing with a completed profile.</li>";
					$str .= "<li>Post to our Facebook page to get more exposure (<a href='www.facebook.com/thetalklist' >www.facebook.com/thetalklist</a>).</li>";
					//$str .= "<li> Open up a wide range of calendar sessions.</li>";
					$str .= "</ul>";*/
				} else if($formData['roleId'] == 4)	{
					$str = "<b>Welcome to TheTalkList.com, where you will help learners speak like a native!</b> We have worked hard at building the best 1 to 1 learning environment. Learning a language will be more convenient than ever.  \r\n<br/>";
					$str .= "\r\n<br/>";

					$str .= "New School Tips:\r\n<br/>";
					$str .= "<ul>";
					$str .= "<li>Get your tutors to enroll in TheTalkList.</li>";
					$str .= "<li>Login and add your tutors to your School Community.</li>";
					$str .= "<li>Advertise by emailing out your School Link and posting our linkable ad to your website.</li>";
					$str .= "<li>Monitor transactions and earnings through your account page.</li>";
					$str .= "</ul>";
				} else if($formData['roleId'] == 5)	{
					$str = "<b>Welcome to TheTalkList.com, where you will earn money as your referrals learn to speak like a native!</b> We have worked hard at building the best 1 to 1 learning environment. Learning a language will be more convenient than ever.\r\n<br/>";
					$str .= "\r\n<br/>";
					$str .= "New Affiliate Tips: \r\n<br/>";
					$str .= "<ul>";
					$str .= "<li>Login and view your custom affiliate URL link.</li>";
					$str .= "<li>Download advertisements for distribution </li>";
					$str .= "<li>Advertise by posting our linkable ads to your marketing channels.</li>";
					$str .= "<li>Monitor transactions and earnings through your account page.</li>";
					$str .= "</ul>";
				}
				
				if($formData['roleId'] > 3) 
				{	
					/*$str .= "Please click on below link to activate your account: <a target='_blank' href='".base_url('user/confirm?confrim='.$uid)."'>Confirmation Link</a>\r\n<br/>";
					$str .= "<a>".base_url('user/confirm?confrim='.$uid)."</a>\r\n<br/>";
					$str .= "\r\n<br/>";
					$str .= "\r\n<br/>";*/
					$str .= "Your login information:\r\n<br/>";
					$str .= "Email: {$formData['email']}\r\n<br/>";
					$str .= "Password: {$formData['password']}\r\n<br/>";
					$str .= "\r\n<br/>";
					
				}
				$str .= "If you have any problems please email the support team at: <a href='mailto:support@thetalklist.com'>support@thetalklist.com</a>\r\n<br/>";
				$str .= "By Signing in you agree to these <a href='".base_url('article/terms')."'>terms</a> and <a href='".base_url('article/terms')."'>conditions</a>.\r\n<br/>";
				$str .= "Thank you,\r\n<br/>";
				$str .= "TheTalkList Support Team";
				$this->load->library('email');
				$this->email->mailtype = 'html';
				$this->email->from('admin@thetalklist.com','TheTalklist');
				$this->email->to($formData['email']);
				//$this->email->subject('Sign-Up with TheTalkList.com by '.$formData['firstName']);
				$this->email->subject('Signup confirmation details on TheTalkList');
				$this->email->message($str);
				$this->email->send();
				
				if ($formData['frmmodule']=="mockinterview") {
					$this->email->clear();
					$this->email->mailtype = 'html';
					$this->email->from('admin@thetalklist.com','TheTalklist');
					$this->email->to("mockinterview@thetalklist.com");
					$this->email->subject('Sign-Up with TheTalkList.com by '.$formData['firstName']);
					$this->email->message("A new mockinterview registration was submitted by: <br/>".$formData['firstName'].", ".$formData['email']);
					$this->email->send();
				}
				// End email function code
				if($formData['roleId'] == 4){
					$uinfo = array(
						'username'=>$formData['username'],
						'welcomeuser'=>$profile['firstName'] ,
						'email'=>$formData['email'],
						'uid'=>$uid,
						'use'=>$uid,
						'user_type' => '',
						'free_session'=> 'y',					
						'pic'=>'',
						'roleId'=>'4',
						'firstTime'=>'y',
						'universal_roleId'=>'0'
					);
					
					$this->session->set_userdata($uinfo);
					redirect('user/account');
					//redirect(base_url('user/account'));
					exit;
				}
				else if ($formData['roleId'] == 5) {
					$uinfo = array(
						'username'=>$formData['username'],
						'welcomeuser'=>$profile['firstName'] ,
						'email'=>$formData['email'],
						'uid'=>$uid,
						'use'=>$uid,
						'user_type' => '',
						'free_session'=> 'y',					
						'pic'=>'',
						'roleId'=>'5',
						'firstTime'=>'y',
						'universal_roleId'=>'0'
					);
					
					$this->session->set_userdata($uinfo);
					redirect('user/registeredit');
					//redirect(base_url('user/account'));
					exit;
				} else {
					$uinfo = array(
						'username'=>$formData['username'],
						'welcomeuser'=>$profile['firstName'] ,
						'email'=>$formData['email'],
						'uid'=>$uid,
						'use'=>$uid,
						'user_type' => '',
						'free_session'=> 'y',					
						'pic'=>'',
						'roleId'=>'0',
						'firstTime'=>'y',
						'universal_roleId'=>'0'
					);
					$query = $this->db->query("update user set  is_login=1 where id='{$uid}'");
					$this->session->set_userdata($uinfo);
					redirect(base_url('user/studentPopup'));
					exit;
				}
				if (isset($_POST['regPage']) && $_POST['regPage'] =='ppc'  && $errorMsg['success'] == true) {
					 if ($formData['roleId'] == 0) {
						redirect (base_url('user/studentPopup'));
					 }else{
						redirect('user/registeredit');								 
					 }
					 exit;	
				 }else{
					if ($formData['roleId'] == 0) {
						echo json_encode(array('success'=>true,'redirect'=>Base_url('user/dashboard')));
					} else {
						echo json_encode(array('success'=>true,'redirect'=>Base_url('user/profile')));
					}
				 }
				 exit;
			}
			else {
				echo json_encode(array('success'=>false,'message'=>'Something wrong ,Please contact to admin please!'));
				exit;
			}
		}
		else {
			echo json_encode(array('success'=>false,'message'=>'Not corect!'));
			exit;
		}
	}
//---R&D@Oct-18-2013 : Weibo Connect
function weiboRegister(){
	$this->load->model(array('user_model','profile_model','langs_model'));
	$userModel =  $this->user_model;
	$profileModel = $this->profile_model;
	//---Weibo API configuration
	define( "WB_AKEY" , '2032830805' );
	define( "WB_SKEY" , 'b28e91c657cf385a5f979c0e32c20033' );
	define( "WB_CALLBACK_URL" , 'http://techno-sanjay/dev.thetalklist.com/user/register' );
	//--Include Weibo library
	include(APPPATH . '/third_party/Weibo.php');
	$this->load->library('session');
	$o 			= new SaeTOAuthV2( WB_AKEY , WB_SKEY );
	if (isset($_REQUEST['code'])) {
		$keys 					= array();
		$keys['code'] 			= $_REQUEST['code'];
		$keys['redirect_uri'] 	= WB_CALLBACK_URL;
			try {
				$token = $o->getAccessToken( 'code', $keys ) ;
			} catch (OAuthException $e) {
			}
	}
	if ($token) {
		$_SESSION['token'] = $token;
			setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
			$c 				= new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
			$ms  			= $c->home_timeline(); // done
			$uid_get 		= $c->get_uid();
			$uid 			= $uid_get['uid'];
			$weiboData 		= $c->show_user_by_id( $uid);//??ID?????????
			$weiboData['password'] = $weiboData['id'];
			$weiboData['email'] = strtolower($weiboData['screen_name']."@mail.com");
			$weiboData['username'] = $weiboData['screen_name'];

			$weiboUser 		= $userModel->check_weibo_user($weiboData);
			if($weiboUser['id'] == ""){
				$formData							= array();
				$formData['roleId']					=0;
				$formData['firstName']				=$weiboData['name'];
				$formData['lastName']				=$weiboData['name'];
				$formData['age']					=30;
				$formData['country']				=1;
				$formData['province']				=$weiboData['province'];
				$formData['city']					=$weiboData['city'];
				$formData['networkPage']			='http://weibo.com/'.$weiboData['profile_url'];
				$formData['email']					=$weiboData['email'];
				$formData['confirmEmail']			=strtolower($weiboData['screen_name']);
				$formData['password']				=$weiboData['id'];
				$formData['confirmPassword']		=$weiboData['id'];
				$formData['hRate']					=20;
				if($weiboData['gender'] == 'm'){$gen = 1;}else{$gen = 0;}
				$formData['gender']					=$gen;
				$formData['cell']					=04545454545;
				$formData['nativeLanguage']			=null;
				$formData['username']			=$weiboData['username'];
				
				$userModel 					=  $this->user_model;
				$profileModel 				= $this->profile_model;
				$errorMsg['success'] 		= true;
				$formData['timezone'] 		= $this->config->item('local_timezone');
				$formData['free_session'] 	= 'y';
				$uid 						= $userModel->weibo_register($formData);
			
				if($uid) {
						$formData['uid'] 		= $uid;
						$formData['new'] 		= 1;
						$formData['alerts'] 	= 30;
						$formData['textalert'] 	= 30;
						$formData['alertType'] 	= '11';
						$profileModel->save($formData);
						$uinfo = array(
							'username'		=>$formData['email'],
							'welcomeuser'	=>$formData['firstName'] ,
							'email'			=>$formData['email'],
							'uid'			=>$formData['uid'],
							'roleId'		=>$formData['roleId'],
							'firstTime'		=>'y',
							'free_session'	=> 'y',
							'ancode'		=> 'y',
							'new'			=>'1'
						);
						$this->session->set_userdata($uinfo);
						$profile 			= $this->db->query("SELECT uid,firstName,lastName,hRate,pic,Lat,Lng,user.username,countries.country ,provices.provice ,city FROM profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id where user.id=".$uid);		
						$profile->result_array();
						$profile_res 		= $profile->result_array();
						$address = '';
						if($profile_res[0]['city'] != ''){$address = $address.$profile_res[0]['city'].' ';}
						if($profile_res[0]['provice'] != ''){$address = $address.$profile_res[0]['provice'].' ';}
						if($profile_res[0]['country'] != ''){$address = $address.$profile_res[0]['country'];}
						if($address != ''){}
						if($formData['roleId'] == 0){
								$str = "<b>Welcome to TheTalkList.com, where you will speak like a native!</b>   We have worked hard at building the best 1 to 1 learning environment.  Learning a language will be more convenient than ever.  \r\n<br/>";
								$str .= "\r\n<br/>";
								$str .= "New Member Tips: \r\n<br/>";
								$str .= "<ul>";
								$str .= "<li> Schedule your first Free Session.</li>";
								$str .= "<li> Test our Video Session tools using a high speed connection (greater than 1 mbps).</li>";
								$str .= "<li> Make yourself appealing with a completed profile.</li>";
								$str .= "<li> Post to our Facebook page to interact with many other users.</li>";
								$str .= "<li> Post to our Facebook page to get more exposure (<a href='www.facebook.com/thetalklist' >www.facebook.com/thetalklist</a>).</li>";
								$str .= "</ul>";
						}else{
								$str = "<b>Welcome to TheTalkList.com, your social e-learning network!</b>   We have worked hard at building the best 1 to 1 learning environment.  Teaching a language will be more convenient than ever.  \r\n<br/>";
								$str .= "\r\n<br/>";
								$str .= "New Member Tips: \r\n<br/>";
								$str .= "<ul>";
								$str .= "<li> Make yourself appealing with a completed profile.</li>";
								$str .= "<li> Test our Video Session tools using a high speed connection (greater than 1 mbps).</li>";
								$str .= "<li> Post to our Facebook page to get more exposure (<a href='www.facebook.com/thetalklist' >www.facebook.com/thetalklist</a>).</li>";
								$str .= "<li> Open up a wide range of calendar sessions.</li>";
								$str .= "</ul>";
						}
						$str .= "\r\n<br/>";
						$str .= "Your login information:\r\n<br/>";
						$str .= "Email: {$formData['email']}\r\n<br/>";
						$str .= "Password: {$formData['password']}\r\n<br/>";
						$str .= "\r\n<br/>";
						$str .= "If you have any problems please email the support team at: <a href='mailto:support@thetalklist.com'>support@thetalklist.com</a>\r\n<br/>";
						$str .= "Thank you,\r\n<br/>";
						$str .= "TheTalkList Support Team";
						$this->load->library('email');
						$this->email->mailtype = 'html';
						$this->email->from('admin@thetalklist.com','TheTalklist');
						$this->email->to($formData['email']);
						$this->email->subject('Sign-Up with TheTalkList.com by '.$formData['firstName']);
						$this->email->message($str);
						$this->email->send();	
						echo '<script type="text/javascript"> var parent = window.opener;parent.location ="http://techno-sanjay/dev.thetalklist.com/user/dashboard";window.close();</script>';exit;						
				}
			}else{
				$user = $userModel->weibo_login($weiboData);
				if($user){
					$profile = $this->profile_model->getProfile($user['id']);
						$uinfo = array(
							'username'=>$user['username'],
							'welcomeuser'=>$profile['firstName'] ,
							'email'=>$user['email'],
							'uid'=>$user['id'],
							'use'=>$user['id'],
							'user_type' => $user['user_type'],
							'free_session'=> $user['free_session'],
							'pic'=>$profile['pic'],
							'roleId'=>$user['roleId'],
							'firstTime'=>$user['user_firsttime']
						);
						$this->session->set_userdata($uinfo);
						//redirect('user/dashboard');
						echo '<script type="text/javascript"> var parent = window.opener;parent.location ="http://techno-sanjay/dev.thetalklist.com/user/dashboard";window.close();</script>';exit;
				}else{
						echo '<script type="text/javascript"> var parent = window.opener;parent.location ="http://techno-sanjay/dev.thetalklist.com/user/register";window.close();</script>';exit;
				}
			}
	}else{
		echo '<script type="text/javascript"> var parent = window.opener;parent.location ="http://techno-sanjay/dev.thetalklist.com/user/register";window.close();</script>';exit;
	}
}
//---R&D@Oct-18-2013 : Weibo Connect

//---R&D-@Oct-19-2013	: Social Promote
public function socialpromote($uid){
	$uid = 430;
	$this->load->model(array('user_model','profile_model','langs_model'));
	$userModel 				=  $this->user_model;
	$profileModel 			= $this->profile_model;
	
	if($uid != ""){
		$promoteData = $userModel->checkSocialPromote($uid);
			if($promoteData['sid'] != ""   && $promoteData['tid'] != ""){
				$tutorProfile 		= $profileModel->getTutorProfile($promoteData['tid']);
				$userProfile  		= $profileModel->getProfile($promoteData['sid']);
				
				$promote 			= TRUE;
				$imageurl 			= 'http://techno-sanjay/dev.thetalklist.com/uploads/images/thumb/'.$tutorProfile['pic'];
				
				//$netPage  		= $userProfile['networkPage'];
				$netPage  			= 'http://www.facebook.com';
				if($netPage != ""){
					$netPage  	= str_replace('http://', '', strtolower( $netPage));
					$netPage  	= str_replace('www.', '', strtolower( $netPage));
					$domain 	= parse_url('http://www.'.$netPage, PHP_URL_HOST);
					
					if($domain == 'www.facebook.com') 	{ $network = "FACEBOOK";}
					if($domain == 'www.twitter.com')  	{ $network = "TWITTER";}
					if($domain == 'www.linkedin.com') 	{ $network = "LINKEDIN";}
					if($domain == 'www.weibo.com') 	  	{ $network = "SINAMICROBLOGGING";}
					if($domain == 'www.kaixin001.com') 	{ $network = "KAIXIN";}
					if($domain == 'www.qq.com') 		{ $network = "QQSPACE";}
				}else{
					$network  = '';
				}
			}else{
				$promote 			= FALSE;
				$imageurl			= null;
				$network			= "";
			}
	}else{
		$promote 			= FALSE;
		$imageurl			= null;
		$network			= "";
	}
	if(!isset($network)) { $network  = '';}
	echo json_encode(compact('promote','imageurl','network'));
}
//---R&D-@Oct-19-2013	: Social Promote/** WDC Commit complete*/
	public function addPotentialTeachers(){
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
			$arrVal = $this->lookup_model->getValue('1039', $multi_lang);
			$mustLogin = $arrVal[$multi_lang];
			$data['error'] = 0;
			if(!$this->user){
			$data['error'] = 1;
			$data['msg'] = $mustLogin;
		 
		}
		else{
			$id = $this->input->_request('id');
			$this->load->model(array('myTeacher_model'));
			$this->myTeacher_model->creatMyTeacher($this->user['uid'],$id,1);
		}
		echo json_encode($data);
	}
	/*public function login() {
		
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		
		if($islogin){
			redirect('user/dashboard');
		}
		
		$this->load->helper('email');
		
		$user = array();
		$errorMsg = array();
		if($this->input->post()){
			$formData = $this->input->post();
			//print_r($formData);die;
			if($formData['email']==''){
				$errorMsg['error'] = 'email cannot empty';
			}else if(!valid_email($formData['email'])){
				$errorMsg['error'] = 'email is invalid';
			}else if($formData['password']==''){
				$errorMsg['error'] = 'password cannot empty';
			}else{
				$user = $userModel->loginByEmail($formData);
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
	
			$this->load->model(array('lookup_model'));
			$arrVal = $this->lookup_model->getValue('887', $multi_lang);
			$emsg = $arrVal[$multi_lang];
			//insert to  the profile table
			
			if($user){
				
				$profile = $this->profile_model->getProfile($user['id']);
				$cdate=date('Y-m-d');
				
				if($user['exp_session'] > $cdate && $user['is_eligible']==1)
				{
					$user['free_session']='y';
				}
				else{$user['free_session']='n';}
				$uinfo = array(
                    'username'=>$user['username'],
					'welcomeuser'=>$profile['firstName'] ,
                    'email'=>$user['email'],
                    'uid'=>$user['id'],
					'use'=>$user['id'],
					'user_type' => $user['user_type'],
					'free_session'=> $user['free_session'],					
					'pic'=>$profile['pic'],
				    'roleId'=>$user['roleId'],
					'firstTime'=>$user['user_firsttime']
				);

				 // update hiiden status when use login 
				
				/// added by haren to update login status when user log in
				
				$this->session->set_userdata($uinfo);
				//skvirja 1 Nov 2013 attempt to user login history 
				$userModel->saveLogin($profile);

				$uId=$user['id'];
				 $sql="update user set is_login=1 where id='{$uId}'";
				 $query = $this->db->query($sql);

				//--R&D@Dec-09-2013	
				if($user['roleId'] == 0 || $user['roleId'] == 1 || $user['roleId'] == 2 || $user['roleId'] == 3){
					
					redirect('user/dashboard');
				}
				if($user['roleId'] == 4){
					redirect('user/account');
				}
				if($user['roleId'] == 5){
					redirect('user/account');
				}
				
				//redirect('user/dashboard');
				//--R&D@Dec-09-2013
			}else{
				$errorMsg['error'] = $emsg;
			}
		}
		$this->layout->view('user/login',$errorMsg);
	}*/
	public function login() {
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		 
		if($islogin){
			redirect('user/dashboard');
		}
		$this->load->helper('email');
		$user = array();
		$errorMsg = array();
		
		if($this->input->post()){
			/* march scope */
			$formData = $this->input->post();
			 $newreg =@$formData['confacc'];
			 
			 /*end scope */
			$groupval=$formData['isgroup'];
			 unset($formData['isgroup']);
			if($formData['email']==''){
				$errorMsg['error'] = 'email cannot empty';
			}else if(!valid_email($formData['email'])){
				$errorMsg['error'] = 'email is invalid';
			}else if($formData['password']==''){
				$errorMsg['error'] = 'password cannot empty';
			}else{
				$user = $userModel->loginByEmail($formData);
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
	
			$this->load->model(array('lookup_model'));
			$arrVal = $this->lookup_model->getValue('887', $multi_lang);
			$emsg = $arrVal[$multi_lang];
			//insert to  the profile table
			
			if($user){ 
				
				$profile = $this->profile_model->getProfile($user['id']);
				 
				$cdate=date('Y-m-d');
				
				if($user['exp_session'] > $cdate && $user['is_eligible']==1)
				{
					$user['free_session']='y';
				}
				else{$user['free_session']='n';}
				
				$uinfo = array(
                    'username'=>$user['username'],
					'welcomeuser'=>$profile['firstName'] ,
                    'email'=>$user['email'],
                    'uid'=>$user['id'],
					'use'=>$user['id'],
					'user_type' => $user['user_type'],
					'free_session'=> $user['free_session'],					
					'pic'=>$profile['pic'],
				    'roleId'=>$user['roleId'],
					'firstTime'=>$user['user_firsttime'],
					'universal_roleId'=>$user['universal_roleId'] // Added By Ilyas
				);
				$sql="update user set  is_login=1 where id=".$user['id'];				
				 $query = $this->db->query($sql);
				
				$this->session->set_userdata($uinfo);
				if($groupval=='yes')
				 {
					 $nextSession= $this->user_model->GetNextSession();
					 	
					if($nextSession !=array())
						{ 
							 
							$start=$nextSession['Time'];
							$timeNow = date('Y-m-d H:i:s');
							$timeNowStr = strtotime($timeNow);
							$classTimeStr = strtotime($start);
							$classDiffInMin = round(($classTimeStr - $timeNowStr) / 60,2);
							$Diff=round(abs($classTimeStr - $timeNowStr) / 60,2);
							if($Diff <=25)
							{
								redirect('multi?id='.$nextSession['gropsessionId']); 
							}	
							else
							{
								 
							} 
						}		
				 }
				 
				/// added by haren to update login status when user log in
				
						


				if($newreg == 'new1' && $user['roleId'] == 0)
				{
					//redirect (base_url('user/studentPopup'));
					redirect (base_url('user/registeredit'));
				}
				else if($newreg == 'new1' && $user['roleId'] > 0)
				{
							redirect (base_url('user/registeredit'));
							 								 
				}
				else
				{
					redirect('user/dashboard');
				}
				 
			
				 
				/*if($user['roleId'] == 0 || $user['roleId'] == 1 || $user['roleId'] == 2 || $user['roleId'] == 3){
					redirect('user/dashboard');
				}
				if($user['roleId'] == 4){
					redirect('user/account');
				}
				if($user['roleId'] == 5){
					redirect('user/account');
				}*/
				
				//redirect('user/dashboard');
				//--R&D@Dec-09-2013
			}else{
				$errorMsg['error'] = $emsg;
			}
		}
		
		/* Facebook Login Start */
		$this->load->library('facebook');
		$fblogin_url = $this->facebook->getLoginUrl(array('redirect_uri' => site_url('user/studentPopup'), 
			'scope' => array("email")));
		$this->layout->setData('fblogin_url',$fblogin_url);
		/* End */
		$this->layout->view('user/login',$errorMsg);
	}
	
	/**
	 * edit profile
	 */
	public function editProfile() {
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
			$arrVal = $this->lookup_model->getValue('1120', $multi_lang);
			$susscesssaved = $arrVal[$multi_lang];
			$arrVal = $this->lookup_model->getValue('1122', $multi_lang);
			$MustLogin = $arrVal[$multi_lang];
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin) {
			//redirect('user/login');
			echo $MustLogin;
			exit;
		}
		$profileModel = $this->profile_model;
		$uid = $this->session->userdata('uid');
		if($this->input->post() && $uid)
		{
			$formData = $this->input->post();
			unset( $formData['localTimeZone'] );
			$formData['uid'] = $uid;
			$profileModel->update($formData);
			
			echo $susscesssaved;
		}
	}
public function editProfileSingle() {
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin)
		{
			echo 'must login first!';

		}
		else {
			$profileModel = $this->profile_model;

			$uid = $this->session->userdata('uid');
			
			$profileUser = $profileModel->getProfile($uid);
			if( ($data = $this->input->post()) && $uid ) {
				$formData = array();
				if(!isset($data['value'])){
					echo '';
					return;
				}
				$dataTmpVal = $data['value'];
		
				if($data['id'] == 'skill' || $data['id'] == 'interests' ){
				
			     for($i=0;$i<sizeof($data);$i++)
				 {
				   if($data['value'][$i]['desc']=='' && $data['value'][$i]['title']=='Personal')
				   {
				   $a="My teaching philosophy is...\nMy favorite sport is...\nMy favorite thing to do is...\nMy favorite movie is...";
				    // $data['value'][$i]['desc']="My favorite sport is...";
					$data['value'][$i]['desc']=$a;
				   }
				   if($data['value'][$i]['desc']=='' && $data['value'][$i]['title']=='Educational')
				   {
				     $data['value'][$i]['desc']="I went to school at...";
				   }
				   if($data['value'][$i]['desc']==''&& $data['value'][$i]['title']=='Professional')
				   {
				     $data['value'][$i]['desc']="I have worked at...";
				   }
				  
				  $data['value'][$i]['desc']=strip_tags($data['value'][$i]['desc']);
				  
				 //$data['value'][$i]['desc']=str_replace( "...", '/n',$data['value'][$i]['desc']);
				// $data['value'][$i]['desc']=str_replace( '<br>', '\n',$data['value'][$i]['desc']);
                 //$data['value'][$i]['desc']=$data['value'][$i]['desc'].replace('<br>', "/\r\n|\r|\n/g");
				 // $data['value'][$i]['desc']=  htmlspecialchars($data['value'][$i]['desc'], ENT_QUOTES, 'UTF-8', false);
				 }

				  $data['value'] = json_encode($data['value']);
				  
				}
				if($data['id'] == 'age')
				{
					if($data['value']<13)
					{
						$newage = $data['value'];
						
						$data['value'] = @$profileUser['age'];
					}
				}
				if($data['id'] == 'free_session')
				{
					
					$data['value'] = strtolower(substr($data['value'],0,1));
				}
				$formData['uid'] = $uid;
				$formData[$data['id']] = $data['value'] ;
				//print_r($data);exit;
				$profileModel->update($formData);
				
				if($data['id'] == 'skill' || $data['id'] == 'interests'){
					$data['value'] = $data['value'];
				}else{
					$data['value'] = $dataTmpVal;
				}
				if($data['id'] == 'gender'){
					if($data['value'] == 1){ echo "Male"; }else{ echo "Female"; }
				}elseif($data['id'] == 'age')
				{
					if($data['value']<13)
					{
						echo $newage; 
					}else{
						echo $data['value'];
					}
				}
				else{
					echo $data['value'];
				}
			    return;
			}
		}

	}
	public function editNames() {
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin) {
			echo 'must login first!';
		}
		else {
			$profileModel = $this->profile_model;

			$uid = $this->session->userdata('uid');
			if( ($data = $this->input->post()) && $uid ) {
				$formData = array();
				$names = explode('-',$data['value']);
				$formData['uid'] = $uid;
				$formData['firstName'] = trim($names[0]);
				if($formData['firstName'] == 'First'){$formData['firstName'] = '';}
				//$formData['midname'] = $names[1];
				$formData['lastName'] = $names[1];
				if($formData['lastName'] == 'Last'){$formData['lastName'] = '';}
				$profileModel->update($formData);
				echo str_replace('-',' ',$data['value']);
				return;
			}
		}

	}
	public function editScore() {
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin) {
			echo 'must login first!';
		}
		else {
			$profileModel = $this->profile_model;
		
			$uid = $this->session->userdata('uid');
			if( ($data = $this->input->post()) && $uid ) {
				$formData = array();
				
				$names = explode('-',$data['value']);
				$formData['uid'] = $uid;
				//print_r($data['value']);exit;
				$formData['last_toiec_score'] = $names[0];
				$formData['last_toefl_score'] = $names[1];
				$formData['last_oplc_score'] = $names[2];
				$formData['current_tolec_score'] = $names[3];
				$formData['current_toefl_score'] = $names[4];
				$formData['current_oplc_score'] = $names[5];
				$profileModel->update($formData);
				echo str_replace('-',' ',$data['value']);
				
				return;
			}
		}

	}
public function editLocation() {
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin) {
			echo 'must login first!';
		}
		else {
			$profileModel = $this->profile_model;

			$uid = $this->session->userdata('uid');
			
			if( ($data = $this->input->post()) && $uid ) {
				$formData = array();
				$names = explode(',',$data['value']);
				$formData['uid'] = $uid;
				$formData['city'] = $names[0];
				$formData['province'] = $names[1];
				$formData['country'] = $names[2];
				if($formData['city'] == 'City')
				{
					$formData['city'] = '';
				}
				if($formData['province'] == 'provience')
				{
					$formData['province'] = '';
					$proviceres[0]['provice'] = 'provience';
				}
				$profileModel->update($formData);
				//echo str_replace('-',' ',$data['value']);
				$data['value'];

				$countryq = $this->db->query("SELECT country from countries where id =".$formData['country']);
				$countryq->result_array();
				$countryqres = $countryq->result_array();
				$countryqres[0]['country'];
				
				if($formData['province'] != '')
				{
					$proviceq = $this->db->query("SELECT provice from provices where id =".$formData['province']);
					$proviceq->result_array();
					$proviceres = $proviceq->result_array();
					@$proviceres[0]['provice'];
				}else{
					$proviceres[0]['provice'] = '';
				}
				
				echo @$formData['city'].", ".@$proviceres[0]['provice'].", ".@$countryqres[0]['country'];
				$profile = $this->db->query("SELECT uid,firstName,lastName,hRate,pic,Lat,Lng,user.username,countries.country ,provices.provice ,city FROM profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id where user.id=".$uid);		
				$profile->result_array();
				$profile_res = $profile->result_array();
			
				if($profile_res[0]['Lat'] == '' && $profile_res[0]['Lng'] == '')
				{
					 $address = '';
			
					if($profile_res[0]['city'] != '')
					{
						$address = $address.$profile_res[0]['city'].' ';
					}
					if($profile_res[0]['provice'] != '')
					{ 
						$address = $address.$profile_res[0]['provice'].' ';
					}
					if($profile_res[0]['country'] != '')
					{
						$address = $address.$profile_res[0]['country'];
						
					}
					if($address != '')
					{
						$this->getFirstLatLong($profile_res[0]['uid'],$address);
						
					}
				}
				else{
					$address = '';
					if($profile_res[0]['city'] != '')
					{
						$address = $address.$profile_res[0]['city'].' ';
					}
					if($profile_res[0]['provice'] != '')
					{ 
						$address = $address.$profile_res[0]['provice'].' ';
					}
					if($profile_res[0]['country'] != '')
					{
						$address = $address.$profile_res[0]['country'];
					}
					if($address != '')
					{
						$this->getLatLong($profile_res[0]['uid'],$address);
					}
				}
				
				return;
			}
		}
	}
	
	public function getFirstLatLong($id , $address){
	
	    if (!is_string($address))die("All Addresses must be passed as a string");
	    $_url = sprintf('http://maps.google.com/maps?output=js&q=%s',rawurlencode($address));
	    $_result = false;
	    if($_result = file_get_contents($_url)) {
	        if(strpos($_result,'errortips') > 1 || strpos($_result,'Did you mean:') !== false) return false;
	        preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_result, $_match);

			$_coords['lat'] = $_match[1];
			$_coords['long'] = $_match[2];

			$sql = "SELECT Lat,Lng FROM profile where Lat = ".$_coords['lat']."AND Lng=".$_coords['long'];

			$query 			= $this->db->query($sql);
			$resultProfile  = $query->result_array();

			if(count($resultProfile)>0){
				$random1 = rand(1,10);
				$update_random1 = "0.".$random1;
				
				$random2 = rand(2,11);
				$update_random2 = "0.".$random2;

				$update_match[1] = substr($_match[1], 0, 9);
				$update_match[2] = substr($_match[2], 0, 9);
				
				$finalMatch_lat = '';
				$finalMatch_long = '';

				$finalMatch_lat = $update_match[1] + $update_random1;
				$finalMatch_long = $update_match[2] + $update_random2;

				$sql = "UPDATE profile set Lat =".$finalMatch_lat." , Lng=".$finalMatch_long." WHERE uid= '{$id}'";
				$query = $this->db->query($sql);
				
				$timeZN = $this->user_model->getTimeZone($finalMatch_lat,$finalMatch_long,$id);
			}
			else
			{
				$sql = "UPDATE profile set Lat ='{$_coords['lat']}' , Lng='{$_coords['long']}' WHERE uid= '{$id}'";
				$query = $this->db->query($sql);
				$timeZN = $this->user_model->getTimeZone($_coords['lat'],$_coords['long'],$id);
			}
	    }
	}

	public function getLatLong($id , $address){
	
	//echo $id;
	    if (!is_string($address))die("All Addresses must be passed as a string");
	    $_url = sprintf('http://maps.google.com/maps?output=js&q=%s',rawurlencode($address));
	    $_result = false;
	    if($_result = file_get_contents($_url)) {
		
	        if(strpos($_result,'errortips') > 1 || strpos($_result,'Did you mean:') !== false) return false;
	        preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_result, $_match);

			$_coords['lat'] = $_match[1];
			$_coords['long'] = $_match[2];
			$sql = "SELECT Lat,Lng FROM profile where Lat = ".$_coords['lat']."AND Lng=".$_coords['long'];
		
			$query 			= $this->db->query($sql);
			$resultProfile  = $query->result_array();

			if(count($resultProfile)>0){
				$random1 = rand(1,10);
				$update_random1 = "0.".$random1;
				
				$random2 = rand(2,11);
				$update_random2 = "0.".$random2;

				$update_match[1] = substr($_match[1], 0, 9);
				$update_match[2] = substr($_match[2], 0, 9);
				
				$finalMatch_lat = '';
				$finalMatch_long = '';

				$finalMatch_lat = $update_match[1] + $update_random1;
				$finalMatch_long = $update_match[2] + $update_random2;

				$sql = "UPDATE profile set Lat =".$finalMatch_lat." , Lng=".$finalMatch_long." WHERE uid= '{$id}'";
				$query = $this->db->query($sql);
				$timeZN = $this->user_model->getTimeZone($finalMatch_lat,$finalMatch_long,$id);
				
			}
			else
			{
				$sql = "UPDATE profile set Lat ='{$_coords['lat']}' , Lng='{$_coords['long']}' WHERE uid= '{$id}'";
				$query = $this->db->query($sql);
				$timeZN = $this->user_model->getTimeZone($_coords['lat'],$_coords['long'],$id);
				
			}
	    }
	}

	/*
	public function getLatLong($id , $address){
	//echo $id;
	    if (!is_string($address))die("All Addresses must be passed as a string");
	    $_url = sprintf('http://maps.google.com/maps?output=js&q=%s',rawurlencode($address));
	    $_result = false;
	    if($_result = file_get_contents($_url)) {
		
	        if(strpos($_result,'errortips') > 1 || strpos($_result,'Did you mean:') !== false) return false;
	        preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_result, $_match);

		$_coords['lat'] = $_match[1];
		$_coords['long'] = $_match[2];
		
	    }
		
		$sql 		= "UPDATE profile set Lat ='{$_coords['lat']}' , Lng='{$_coords['long']}' WHERE uid= '{$id}'";
		$query 		= $this->db->query($sql);
	    
	}*/

	public function getProvices(){
		$cid =  $this->input->_request('cid');
		$this->load->model('location_model');
		$data = $this->location_model->getProvices($cid);
		echo json_encode($data);
	}
/*
 * Country_Code 2013.2.20 ???�??? Country_Code
 */
	public function ajaxCountryCode(){
		$cid =  $this->input->_request('cid');
		$this->load->model('location_model');
		$countryCode = $this->location_model->getCountryCode($cid);

		echo $countryCode;
	}
	/*
	 *  Area_Code 2013.2.20 ???????? Area_Code
	 */
	public function ajaxAreaCode(){
		$pid =  $this->input->_request('pid');		
		$this->load->model('location_model');
		$areaCode = $this->location_model->getAreaCode($pid);
		echo $areaCode;
	}

	/*????*/
	public function uploadImage() {

	}
	/*????*/
	public function uploadVedio() {

	}
	/*public function slogout() {
		//echo "here";die();
		$uid = $this->uid;
		$this->load->model(array('search_model'));
		 
		 if(!$this->uid){
			redirect('user/login');
			}
		 
		if($this->session->userdata('roleId') != 0)
		{
			$this->search_model->removeNow($uid);
		}
		$this->session->sess_destroy();
		redirect('user/logout');		
	}*/
	
	/*
	public function slogout() {
		if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
		{
			clearstatcache() ;
		}	
		else { }

		$uid = $this->uid;
		$this->load->model(array('search_model'));
		 
		 if(!$this->uid){
			redirect('user/login');
			}
		 
		if($this->session->userdata('roleId') != 0)
		{
			$this->search_model->removeNow($uid);
		}
		$this->session->set_userdata('Continue','');
		$this->session->sess_destroy();
		redirect('user/logout');
	}*/
	
	
	public function slogout() {
		$uid = $this->uid;
		$this->load->model(array('search_model'));
		 
		 if(!$this->uid){
			redirect('user/login');
			}
		 $sql = "update user set is_login = 0 where id = {$uid}";
		$query = $this->db->query($sql);
		if($this->session->userdata('roleId') != 0)
		{
			$this->search_model->removeNow($uid);
		}
		$this->session->set_userdata('Continue','');
		$this->session->sess_destroy();
		redirect('user/logout');
	}
	
	public function logout() {
		//$this->_profile();
		$this->load->library('Mobile_Detect');
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? 'phone' : 'computer');
		$this->layout->setLayoutData('deviceType',$deviceType);
		$this->layout->setLayoutData('linkAttr','facebook');
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		
		if($islogin){
			redirect('user/dashboard');
		}
		/* Facebook Login Start */
		$this->load->library('facebook');
		$fblogin_url = $this->facebook->getLoginUrl(array('redirect_uri' => base_url('user/fblogin'), 
			'scope' => array("email")));
		$this->layout->setData('fblogin_url',$fblogin_url);
		/* End */	
	$this->layout->view('user/facebook');
	}
	public function history(){
		$this->layout->setLayoutData('linkAttr','history');
		if(!$this->user){
			redirect('user/login');
		}
		$this->_profile();
		//$this->load->model('class_model');
		$permission = $this->getPermission($this->uid);

		$type = $this->input->_request('type');

		if($type == 'month'){
			$filterType = $this->input->_request('type','month'); 
		}else if($type == 'year'){
			$filterType = $this->input->_request('type','year'); 
		}else if($type == 'all'){
			$filterType = $this->input->_request('type','all'); 
		}else{
			$filterType = $this->input->_request('type','month'); 
		}
	//	echo $filterType;
		
		$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
		$this->load->model('class_model');
		$history = $this->class_model->getHistory($this->uid,$filterType);
		
		$historyCounter = count($history);
		$this->layout->setData('historyCounter',$historyCounter);
		$this->layout->setData('history',$history);
		$this->layout->setData('filterType',$filterType);

		$this->layout->setData('roleId',$this->layout->data['profile']['roleId']);
		$this->layout->setData('linkType',$type);
		$this->layout->view('user/history');
		
	}
	public function export($myval=""){
		if(!$this->user){
			redirect('user/login');
		}
		$this->_profile();
		//$this->load->model('class_model');
		$permission = $this->getPermission($this->uid);
		$filterType = $this->input->_request('type','all'); 
		$type=substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
		$this->load->model('class_model');
		$data['rptTitle'] =	date("F Y",strtotime("01-".$myval));
		$data['transactions'] = $this->class_model->getMemberTransaction($this->uid, $myval);		
		$this->load->helper(array('file','download'));
		$this->load->library('mpdf/mpdf');                
		$pdfFilePath = "MemberTransaction".$myval.".pdf";
        $mpdf=new mPDF();
		ob_start();
		$this->load->view('user/export_history', $data);
		$content = ob_get_contents();
		ob_end_clean();
		$mpdf->WriteHTML($content); 
        $mpdf->Output($pdfFilePath, "D");
		//$data = pdf_create($content, 'MemberTransaction'.$myval, true);
		/*$filename = "MemberTransaction.pdf";
		write_file($filename, $data);
		$data = file_get_contents($filename);
		force_download($filename, $data);*/
		exit();
	}
	public function payments(){
		//Under Construction.
		if(!$this->user){
			redirect('user/login');
		}
		$this->_profile();

		$permission = $this->getPermission($this->uid);
		if(strpos($permission,'public') > -1){
			$this->layout->view('user/invalid');
		}
		else{
			$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));

			$this->layout->setData('linkType',$type);
		}
		$this->layout->view('user/payments');
	}
	public function errorPayment()
	{
		if(!$this->user){
			redirect('user/login');
		}
		$this->load->helper('form');
		$this->_profile();
     	$permission = $this->getPermission($this->user['uid']);
		$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
		$this->layout->setData('linkType',$type);
		$user = $this->user_model->getByUid($this->user['uid']);
		//--R&D@JAN-29-2014
		if($this->input->post('profile_tab')){
			$currentTab = $this->input->post('profile_tab');
		}else{
			$currentTab = 'col1';
		}
		$this->layout->setData('errorMsg',$_REQUEST['errorMessage']);
		$this->layout->view('user/bs_error');
		///
		//die;
	}
	public function bs_success()
	{
		if(empty($_REQUEST))
		{	
			$this->session->set_flashdata('message', 'Benstream payment');
			redirect(site_url('user/account/'), 'refresh'); 
		}//echo $this->user['uid'];die;
		$data['uid'] = $this->user['uid'];		
		$data['money'] = $_REQUEST['ref2'];
		$this->load->model('pay_model');

		if($this->pay_model->bs_save($data))
		{
			$this->load->helper('form');
			$this->_profile();

			$csql = "SELECT money FROM profile where uid = ".$data['uid'];
			$cquery = $this->db->query($csql);
			$cresult = $cquery->row_array();
			$cmoney = $cresult['money'];
			if($data['money'] == 30){
				$ccredit = 25;
			}else if($data['money'] == 100){
				$ccredit = 100;
			}else if($data['money'] == 300){
				$ccredit = 310;
			}else if($data['money'] == 500){
				$ccredit = 520;
			}
			$umoney = $cmoney + $ccredit;
			$usql = "Update profile set money = {$umoney} where uid = ".$data['uid'];
			$uquery = $this->db->query($usql);

			$permission = $this->getPermission($this->user['uid']);
			$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
			$this->layout->setData('linkType',$type);

			$user = $this->user_model->getByUid($this->user['uid']);

			/*$paymentsuccess = '1';
			$this->layout->setData('paymentsuccess',$paymentsuccess);*/
			//$this->layout->view('user/account');
			$this->session->set_flashdata('message', 'Beanstream payment');
			redirect(site_url('user/account/'), 'refresh');
		}
	}
	public function paymentForm()
	{
		//echo $this->user['uid'];
		if(!empty($_REQUEST['errorMessage']))
		{
			$this->layout->setData('errorMsg',$_REQUEST['errorMessage']);
			$this->layout->setData('sess',$sess);
		}

		if((!$_POST['bs_money']) && !$_REQUEST['errorMessage'])
		{
			redirect('user/account');
		}
		$data['money'] = $_POST['bs_money'];
		$data['month'] = $_POST['bs_month'];
		$data['credit'] = $_POST['bs_credit'];
		if($_POST['bs_money']) 
		{
			$_SESSION['postData'] = $data;
		}
		if(!$this->user){
			redirect('user/login');
		}
		$this->load->helper('form');
		$this->_profile();
     	$permission = $this->getPermission($this->user['uid']);
		$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
		$this->layout->setData('linkType',$type);
		$user = $this->user_model->getByUid($this->user['uid']);
		//--R&D@JAN-29-2014
		
		$this->layout->setData('data',$data);
		$this->layout->view('user/pay_form');
	
		
	}
	public function account(){
		$_SESSION['postData'] = '';
		//Under Construction.
		if(!$this->user){
			redirect('user/login');
		}
		$this->_profile();
		$this->_upgradeAccount();
		$this->_buyCredits();
		$filterType = $this->input->_request('type','all');
		$permission = $this->getPermission($this->uid);
		$this->load->library('pagination');
		$config['enable_query_strings'] = true;
		$config['uri_segment'] = 3;
		$config['page_query_string'] = false;
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = base_url('user/account');
		$config['num_links'] = 4;
		$config['total_rows'] = $this->user_model->countTutor($this->user['uid']);
		$config['per_page'] = 20;
		$config['cur_tag_open'] = '<span class="current"><b>';
		$config['last_link'] = '&gt;&gt;';
		$config['first_link'] = '&lt;&lt;';

		$config['cur_tag_close'] = '</b></span>';
		$this->pagination->initialize($config);
		$page = (int)$this->uri->segment(3);
		if(!$page){
			$page = 1;
		}
	$tsch='';
    /*$tutor=$this->user_model->GetSchoolTutor($this->uid,$page);
	$schoolEarings=$this->user_model->GetSchoolEarning($this->uid);
	$this->layout->setData('schoolEarings',$schoolEarings);*/
	
	$tutor=$this->user_model->GetSchoolTutor($this->uid,$page);
	$schoolEarings=$this->user_model->GetSchoolEarning($this->uid);
	$this->layout->setData('schoolEarings',$schoolEarings);
	
	$StuEarnings=$this->user_model->GetStuEarnings($this->uid);
	 
	$this->layout->setData('StuEarnings',$StuEarnings);
	
	//echo "<pre>"; print_r($schoolEarings);die;
	$pbal=$this->user_model->getPrivateBalanace($this->uid);
	$tutorforaccount=$this->user_model->GetSchoolTutorfordashboard($this->uid,$page);
	if(count($tutor)>0)
	{
		$sid=$tutor[0]['school_id'];
		$tsch=$this->user_model->Gettmarkup($this->uid);
		//print_r($tsch);die();
		$tsch=$tsch['tutor_markup'];
	}
		
	if($filterType=='all')
	{
			$students=$this->user_model->GetSchoolStudent($this->uid,$page);
	}
	if($filterType=='month')
	{
		$students=$this->user_model->GetSchoolStudentmnth($this->uid,$page);
	}
	if($filterType=='year')
	{
			$students=$this->user_model->GetSchoolStudentyr($this->uid,$page);
	}
	//echo	 "<pre>"; print_r($students);die;
	$afii_student = $this->user_model->GetAffiliateStu($this->uid);
	$schoolAmount=  $this->user_model->GetSchoolAmount($this->uid);

		if(strpos($permission,'public') > -1){
			$this->layout->view('user/invalidUser');
		}
		else{
			$this->load->model(array('card_model'));
			$this->load->model(array('user_model'));
			$account = array('type'=>0);
			if($this->input->post()){
				$data = $this->input->post();
				$data['type'] = $data['cardType'];
				unset($data['cardType']);
				$data['date'] = $data['date_year'] . '-' . $data['date_month'] . '-' . $data['date_day'];
				unset($data['date_year']);
				unset($data['date_month']);
				unset($data['date_day']);
				$data['uid'] = $this->user['uid'];
				$this->card_model->save($data);

			}
			if($this->input->_request('id')){
				$account = $this->card_model->getOne($this->input->_request('id'));	
				$dates =  explode('-',$account['date']);	
				$account['date_year'] = @$dates[0];	
				$account['date_month'] = @$dates[1];
				$account['date_day'] = @$dates[2];	
			}
			$cards = $this->card_model->getAll($this->uid);
			$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
			$this->layout->setData('cards',$cards);
			$this->layout->setData('linkType',$type);
			$this->layout->setData('tutor',$tutor);
			$this->layout->setData('pbal',$pbal);
			//print_r($pbal);die();
			$this->layout->setData('tutorforaccount',$tutorforaccount);
			
			$this->layout->setData('account',$account);
			$this->layout->setData('sch',$tsch);
			$this->layout->setData('affiliate',$afii_student);
			$this->layout->setData('filterType',$filterType);
			$this->layout->setData('students',$students);
			$this->layout->setData('samout',$schoolAmount);
			
			$this->layout->setData('pagination',$this->pagination->create_links());
		}
		
		 if($this->session->userdata('roleId')==4)
		 {
					$SchoolsTU = array();	
					$SchoolsTU = $this->user_model->GetAllSchoolStu($this->uid);
					//echo "<pre>"; print_r($SchoolsTU);die;
					$i = 0;
					foreach ($SchoolsTU as $payf)
					{
						$Stud[$i]['id'] = $payf['id'];
						$Stud[$i]['fname'] = $payf['firstName'];
						$Stud[$i]['lname'] = $payf['lastName'];
						$data=$this->user_model->getStudentPurchase($payf['id']);
						$Stud[$i]['income']= $data['total'];
						$i++;
					}	
			
			$this->layout->setData('StudIncome',$Stud);
		 }
		
		$this->layout->setData('pagination',$this->pagination->create_links());
		@$message = $this->session->flashdata('message');
		if($message == 'Beanstream payment'){
			$paymentsuccess = '1';
			$this->layout->setData('paymentsuccess',$paymentsuccess);
		}
		$tranTimeDiff = $this->user_model->fnCrPurchaseTmDiff($this->uid);
		if ($tranTimeDiff <= 24 and $tranTimeDiff!="") {
			$this->layout->setData('purCrTransLimit',1);
		}
		$this->load->library('Mobile_Detect');
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? 'phone' : 'computer');	
		$this->layout->setData('deviceType',$deviceType);
		$this->layout->view('user/account');
	}
	public function delCard(){
		if(!$this->user['uid']){
			$success = false;
			$msg = 'You must login first!';
		}
		else {
			$this->load->model('card_model');
			$this->card_model->delById($this->input->_request('id'),$this->user['uid']);
			$success = true;
			$msg = '';
		}
		echo json_encode(compact('success','msg'));	
	}
	/**
	 *
	 * calendar
	 */
	public function calendar(){
	
	if(!$this->uid){
			redirect('user/login');
		}
		//added by haren to bi-forget join v-session and calender
		 $uri=$this->uri->segment(5);
		 
		 if($uri == 'Join')
		 {
 	     $this->layout->setData('uri',$uri);
		 }
		 else
		 {
			$this->layout->setData('uri','');
		 }
		$this->_profile();
		$this->load->model('class_model');
		$permisson = $this->getPermission($this->uid);
		 
		 if($permisson=='teacher_public')
		 {
			$this->layout->setData('school_id',$uri);
			$this->layout->setLayoutData('linkAttr','calender');
		 }
		$classes = array();
		switch($permisson) {
			case 'invalidUser':break;
			case 'student_private':$classes = $this->class_model->getBySid($this->uid);break;
			case 'teacher_private':$classes = $this->class_model->getByTid($this->uid);break;
			case 'studdent_public':break;

		}
		/*
		print_r($classes);
		exit;*/
		$timeNow = date('Y-m-d H:i:s',time());
		//echo "<pre>"; print_r($classes);die();
		$timeNowStr = strtotime($timeNow);
		if(count($classes)>0)
		{
			$i = 0;
			foreach($classes as $class)
			{
				$classTimeStr = strtotime($class['startTime']);
				$classDiffInMin = round(($classTimeStr - $timeNowStr) / 60,2);
				
				//checks for existing locked users
				$existsLocked = 0;
				if($class['action'] != '')
				{
					$action = unserialize($class['action']);
					if($this->session->userdata('roleId') == 0)
					{
						if(@$action['studentConnected'] == 1)
						{
							continue;
						}
					}else{
						if(@$action['tutorConnected'] == 1)
						{
							continue;
						}
					}
					
					if($this->session->userdata('roleId') == 0)
					{
						if(@$action['slocked'] == 1)
						{
							$existsLocked = 1;
						}
					}else{
						if(@$action['tlocked'] == 1)
						{
							$existsLocked = 1;
						}
					}
				}
				
				//checks for user enters on class
				$lockedSession = 'locked_'.$class['id'];
				if($this->session->userdata($lockedSession))
				{
					if($this->session->userdata($lockedSession) == 'No')
					{
						$sessionUser = 'No';
					}else{
						$sessionUser = 'Yes';
					}
				}else{
					$sessionUser = 'Yes';
				}
				
				if($classDiffInMin < -3 && $sessionUser == 'Yes' && $existsLocked == 1)
				{
					$classes[$i]['locked'] = 1;
				}else{
					$classes[$i]['locked'] = 0;
				}
				
			 
				if($classes[$i]['Is_early'] == 1)
				{
					$classes[$i]['locked'] = 1;
				}
				
				
				$i++;
			}
		}
			
			$schoolTut = $this->profile_model->CheckIsSchoolTutor($this->uid);
			$Ismarkset=0;
			if($schoolTut['school_id'] > 0)
			{
				$sql="select pic,curriculum,s_disc from profile where uid={$schoolTut['school_id']}";
				$query = $this->db->query($sql);
				$result = $query->row_array();
				$Ismarkset=$result['curriculum'];	
			}
			$this->layout->setData('schtut',$schoolTut['school_id']);
			$this->layout->setData('Ismarkset',$Ismarkset); 

		$ReadyTalk = $this->profile_model->CheckIsonline($this->uid);
		$this->layout->setData('readyTalk',$ReadyTalk['readytotalk']);
		//print_r($classes);die;
		$chkfreesession = $this->search_model->chkfreesession($this->uid);
        $this->layout->setData('chkfreesession',$chkfreesession);
		
		$this->layout->setData('classes',$classes);
        //$this->layout->setData('SessionCost','test');
		$uri=$this->uri->segment(5);
		$this->load->model("user_model");
		$config = $this->profile_model->getConfig();
		$configvalues = ((1+$config['VEE_PRICE_PERCENT']['value']) *100);
		//echo $this->uid." : ".$uri." : ".$this->session->userdata('uid');
		if($this->session->userdata('uid') =='')
		{
		}
		else
		{
			$this->layout->setData('SessionCost',$this->user_model->getsesstioncostnew($this->session->userdata('uid'),$configvalues,$this->uid));
		}
		
		$abcresult = $this->user_model->getsesstioncostnew($this->session->userdata('uid'),$configvalues,$this->uid);
		
		$this->load->helper('date');
		// Get Category
		$this->load->model('category_model');
		$categories = $this->category_model->GetCategories(0,10,"desc","id");
		$this->layout->setData('categories',$categories);
		
		// Get User Selected Topic
		$selTopic = $this->user_model->fnGetRecentSearch($this->session->userdata('uid'));
		$this->layout->setData('selTopic',$selTopic);
		$this->layout->view($this->getViewTemp($this->uid,'user/calendarnew'));
	}
	public function calendar_new(){
		//$this->layout->setLayoutData('linkAttr','calender');
		if(!$this->uid){
			redirect('user/login');
		}
		//added by haren to bi-forget join v-session and calender
		 $uri=$this->uri->segment(5);
		 
		 if($uri == 'Join')
		 {
 	     $this->layout->setData('uri',$uri);
		 }
		 else
		 {
			$this->layout->setData('uri','');
		 }
		$this->_profile();
		$this->load->model('class_model');
		$permisson = $this->getPermission($this->uid);
		 
		 if($permisson=='teacher_public')
		 {
			$this->layout->setData('school_id',$uri);
			$this->layout->setLayoutData('linkAttr','calender');
		 }
		$classes = array();
		switch($permisson) {
			case 'invalidUser':break;
			case 'student_private':$classes = $this->class_model->getBySid($this->uid);break;
			case 'teacher_private':$classes = $this->class_model->getByTid($this->uid);break;
			case 'studdent_public':break;

		}
		//print_r($classes);die;
		//date_default_timezone_set() ;
		$timeNow = date('Y-m-d H:i:s',time());
		$timeNowStr = strtotime($timeNow);
		if(count($classes)>0)
		{
			$i = 0;
			foreach($classes as $class)
			{
				$classTimeStr = strtotime($class['startTime']);
				$classDiffInMin = round(($classTimeStr - $timeNowStr) / 60,2);
				
				//checks for existing locked users
				$existsLocked = 0;
				if($class['action'] != '')
				{
					$action = unserialize($class['action']);
					if($this->session->userdata('roleId') == 0)
					{
						if(@$action['studentConnected'] == 1)
						{
							continue;
						}
					}else{
						if(@$action['tutorConnected'] == 1)
						{
							continue;
						}
					}
					
					if($this->session->userdata('roleId') == 0)
					{
						if(@$action['slocked'] == 1)
						{
							$existsLocked = 1;
						}
					}else{
						if(@$action['tlocked'] == 1)
						{
							$existsLocked = 1;
						}
					}
				}
				
				//checks for user enters on class
				$lockedSession = 'locked_'.$class['id'];
				if($this->session->userdata($lockedSession))
				{
					if($this->session->userdata($lockedSession) == 'No')
					{
						$sessionUser = 'No';
					}else{
						$sessionUser = 'Yes';
					}
				}else{
					$sessionUser = 'Yes';
				}
				
				if($classDiffInMin < -3 && $sessionUser == 'Yes' && $existsLocked == 1)
				{
					$classes[$i]['locked'] = 1;
				}else{
					$classes[$i]['locked'] = 0;
				}
				$i++;
			}
		}
		
		//print_r($classes);die;
		$chkfreesession = $this->search_model->chkfreesession($this->uid);
        $this->layout->setData('chkfreesession',$chkfreesession);
		
		$this->layout->setData('classes',$classes);

		$this->load->helper('date');
		//$this->layout->view('user/calendar');
		$this->layout->view($this->getViewTemp($this->uid,'user/calendarnew'));
	}
	
	public function ajax_eventDetail(){
		if(!$this->uid){
			echo json_encode(array('status'=>false,'msg'=>'Must login first!'));
			return;
		}
		$start = $this->input->_request('start');
		$end = $start . ' 23:59:59';
		$start .= ' 00:00:00';
		$this->load->model('event_model');
		$eventData = $this->event_model->getEventsByDate($this->uid,$start,$end);
		
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
		$arrVal = $this->lookup_model->getValue('803', $multi_lang);
		$bslot = $arrVal[$multi_lang];
		$arrVal = $this->lookup_model->getValue('424', $multi_lang);
		$booking = $arrVal[$multi_lang];
		$arrVal = $this->lookup_model->getValue('804', $multi_lang);
		$request = $arrVal[$multi_lang];
		$arrVal = $this->lookup_model->getValue('452', $multi_lang);
		$sclass = $arrVal[$multi_lang];
		
		foreach($eventData as $k=>$v){
			$eventData[$k]['startTime'] = date('Y-m-d H:i:s',$this->event_model->outTime($v['startTime']));
			$eventData[$k]['start'] = date('h:i a',$this->event_model->outTime($v['startTime']));
			$eventData[$k]['end'] = date('h:i a',$this->event_model->outTime($v['endTime']));
			//$eventData[$k]['start'] = str_replace('12:','00:',$eventData[$k]['start']);
			//$eventData[$k]['end'] = str_replace('12:','00:',$eventData[$k]['end']);
			if(isset($v['sid'])){
				$eventData[$k]['title'] = $sclass;
			}
			
			if(isset($v['stid'])){
				$eventData[$k]['title'] =$request;
			}
			
			if($v['confirmby']==1){
				$eventData[$k]['title'] = $booking;
			}
			
			else {
				//$eventData[$k]['title'] = 'Open Time Bracket';
				$eventData[$k]['title'] = $bslot;
			}
		}
		echo json_encode(array('rows'=>$eventData));

	}
	public function ajax_events() {
		if(!$this->uid){
			echo json_encode(array('status'=>false,'msg'=>'Must login first!'));
			return;
		}
		$start = $this->input->_request('start');
		$end = $this->input->_request('end');
		$start .= ' 00:00:00';
		$end .= ' 23:59:59';
		$this->load->model('event_model');
		$eventData 		 = $this->event_model->getEventsCountByDate($this->uid,$start,$end);
		$start = strtotime($start);
		$end = strtotime($end);
		$days = ($end - $start  ) / (3600*24);
		$eventCount = rand(1,10);
		$events = array();
		$i = 0;

		for($i;$i<=$days;$i++) {
			$date = $start + 3600*24*$i;
			$data = array();
			$dataDate = date('Y-m-d',$date);

			if(isset($eventData[$dataDate])) {
				//--R&D@Sept-18-2013 : Check if session is booked.
				$eventDataBooked = $this->event_model->getBookedClassByDate($this->uid,date('d',$date),date('m',$date), date('Y',$date));
				//--R&D@Sept-18-2013 : Check if session is booked.
				$data = $eventData[$dataDate];
				$data['booked'] = $eventDataBooked;
			}
			else {

				$data['date'] 	= $dataDate;
				$data['year'] 	= date('Y',$date);
				$data['month'] 	= date('m',$date);
				$data['day'] 	= date('d',$date);
				$data['count'] 	= 0;
				$data['booked'] = 0;
			}
			$events[$i] = $data;
		}/**/
		echo json_encode($events);
	}
	public function addSlotTime(){
		$permisson = $this->getPermission($this->uid);
		$success = 'false';
		$msg = strtotime(time());
		if($permisson !='teacher_private'){
			$success = 'false';
			$msg = 'You do not have permisson!';
		}
		else {
			$this->load->model('event_model');
			$day = $this->input->_request('day');
			$times = $this->input->_request('seletedSlot');
				//print_r($times);die;
			$times = $this->event_model->checkSlotTime($day,$times,$this->user['uid']);
			$firsttime = $this->event_model->isFirstTimeTeacher($this->user['uid']);
			foreach ($times as $key => $value) {
				$msg .= $value .'__';
				$this->event_model->creatTimeSlot($value,0,$this->user['uid']);
			}
			
			$success = 'true';
		}
		echo json_encode(compact('success','msg','firsttime'));

	}
	function get_weeks($year, $month){

		$days_in_month = date("t", mktime(0, 0, 0, $month, 1, $year));
		$weeks_in_month = 1;
		$weeks = array();

		//loop through month
		for ($day=1; $day<=$days_in_month; $day++) {

			$week_day = date("w", mktime(0, 0, 0, $month, $day, $year));//0..6 starting sunday

			$weeks[$weeks_in_month][$week_day] = $day;

			if ($week_day == 6) {
				$weeks_in_month++;
			}

		}

		return $weeks;

	}
	public function addSlotTimeRecurring(){
                //echo "test";
		$permisson = $this->getPermission($this->uid);
		$success = 'false';
		$msg = strtotime(time());
		if($permisson !='teacher_private'){
			$success = 'false';
			$msg = 'You do not have permisson!';
		}
		else {
                        //echo "a";
			$this->load->model('event_model');
			$rstartTime = $this->input->_request('rstartTime');
			$rendTime = $this->input->_request('rendTime');
			$r_sunday = $this->input->_request('r_sunday');
			$r_monday = $this->input->_request('r_monday');
			$r_tuesday = $this->input->_request('r_tuesday');
			$r_wednesday = $this->input->_request('r_wednesday');
			$r_thursday = $this->input->_request('r_thursday');
			$r_friday = $this->input->_request('r_friday');
			$r_saturday = $this->input->_request('r_saturday');
			$c_month = $this->input->_request('c_month');
			$c_year = $this->input->_request('c_year');
			
			
			$weekdays = array();
			if($r_sunday == 'true')
			{
				$weekdays[] = 0;
				
			}
			if($r_monday == 'true')
			{
				$weekdays[] = 1;
				
			}
			if($r_tuesday == 'true')
			{
				$weekdays[] = 2;
				
			}
			if($r_wednesday == 'true')
			{ 
				$weekdays[] = 3;
				
			}
			if($r_thursday == 'true'){$weekdays[] = 4;}
			if($r_friday == 'true'){$weekdays[] = 5;}
			if($r_saturday == 'true'){$weekdays[] = 6;}	
			
			
			//loop thru for get time blocks
			//echo $rstartTime.'<br/>';
			//echo $rendTime.'<br/>';
			
			$rstartTimeOriginal = $rstartTime;
			$rendTimeOriginal = $rendTime;
			
			$rstartTime = explode(':',$rstartTime);
			
			$startTime = $rstartTime[0];
			$rendTime = explode(':',$rendTime);
			$endTime = $rendTime[0];
			
			$blocks  = 0;
			$blocks = $endTime - $startTime;
			$blocks = $blocks*2;
			//echo 'main blocks- '.$blocks;
			if($rstartTime[1] == 30)
			{
				$blocks = $blocks - 1;
				//echo 'blocks 1- '.$blocks;
			}
			if($rendTime[1] == 30)
			{
				$blocks = $blocks + 1;
				//echo 'blocks 2- '.$blocks;
			}
			if($rstartTimeOriginal == '23:30' && $rendTimeOriginal == '0:00')
			{
				$dayDiff = 1;
				$blocks = 1;
				
			}else{
				$dayDiff = 0;
			}
			
			
			$time   = strtotime($rstartTimeOriginal);
                        //echo $time;
			$times      = array();
			$halfHour   = 60 * 30;
                        //echo $blocks;
			if($blocks>0)
			{
				while ($blocks) 
				{
					//$times[]  = date('h:i', $time) . ' - ' . date('h:i', ($time += $halfHour)); 
					
					$startTimeIns = date('h:i a', $time);
					$endTimeIns = date('h:i a', ($time + (60*25)));
					$time += $halfHour;
					$blocks--;
                    if(count($weekdays)>0)
					{
						foreach($weekdays as $weekday)
						{
							// get the weeks in selected month
							$weeksInMonths  = $this->get_weeks($c_year, $c_month);
							foreach($weeksInMonths as $weeksInMonth)
							{
								foreach($weeksInMonth as $key => $value )
								{
									if($key == $weekday)
									{
										$dateForThisDay = $value;
										$todayDay = date('d',time());
										$todayMonth = date('m',time());
										if($todayMonth == $c_month)
										{
											if($dateForThisDay >= $todayDay)
											{
												$startDateIns = $c_year.'-'.$c_month.'-'.$dateForThisDay.' '.$startTimeIns;
												$endDateIns = $c_year.'-'.$c_month.'-'.$dateForThisDay.' '.$endTimeIns;
												//echo "<br/>".$startDateIns." : ".$endTimeIns;
                                                                                                $uid = $this->user['uid'];
												$creatAt = date('Y-m-d H:i:s',time());
												
												//checks for existing entry
												//---------------------------
												//checks for first time user
												$firsttime = $this->event_model->isFirstTimeTeacher($this->user['uid']);
												
												// insert a new timeslot entry
												$this->event_model->creatTimeSlotRecurring($startDateIns,$endDateIns,$uid,$creatAt);
											}
										}else{
												$startDateIns = $c_year.'-'.$c_month.'-'.$dateForThisDay.' '.$startTimeIns;
												$endDateIns = $c_year.'-'.$c_month.'-'.$dateForThisDay.' '.$endTimeIns;
												//echo "<br/>a".$startDateIns." : ".$endTimeIns;
                                                                                                $uid = $this->user['uid'];
												$creatAt = date('Y-m-d H:i:s',time());
												
												//checks for existing entry
												//---------------------------
												//checks for first time user
												$firsttime = $this->event_model->isFirstTimeTeacher($this->user['uid']);
												
												// insert a new timeslot entry
												$this->event_model->creatTimeSlotRecurring($startDateIns,$endDateIns,$uid,$creatAt);
										}
									}
								}
							}
						}
					}

				}
			} 
			$success = 'true';
			
			// checks for last opened session for this month
			$this->lastOpenedSessionRecurring($c_month,$c_year);
		}
		echo json_encode(compact('success','msg','firsttime','weekdays'));
	}
	public function lastOpenedSessionRecurring($c_month,$c_year){
		$weekdays = array('0','1','2','3','4','5','6');
		$blocks = 48;
		$rstartTimeOriginal = '0:00';
		$time   = strtotime($rstartTimeOriginal);
		$halfHour   = 60 * 30;
		$status = 1;
		$sendEmail = 1;
		while ($blocks) 
		{
			$startTimeIns = date('h:i a', $time);
			$endTimeIns = date('h:i a', ($time + (60*25)));
			$time += $halfHour;
			$blocks--;
			foreach($weekdays as $weekday)
			{
				$weeksInMonths  = $this->get_weeks($c_year, $c_month);
				foreach($weeksInMonths as $weeksInMonth)
				{
					foreach($weeksInMonth as $key => $value )
					{
						if($key == $weekday)
						{
							$dateForThisDay = $value;
							$todayDay = date('d',time());
							if($dateForThisDay >= $todayDay)
							{
								$startDateIns = $c_year.'-'.$c_month.'-'.$dateForThisDay.' '.$startTimeIns;
								$endDateIns = $c_year.'-'.$c_month.'-'.$dateForThisDay.' '.$endTimeIns;
								$uid = $this->user['uid'];
								
								$status = $this->event_model->checkTimeSlotRecurring($startDateIns,$endDateIns,$uid);
								if($status == 0)
								{
									$sendEmail = 0;
									break;
								}
							}
						}
					}
				}
			}
		}
		if($sendEmail == 1)
		{
			//echo 'sendmail';exit;
			$user = $this->user_model->getByUid($uid);
			$profile = $this->profile_model->getProfile($uid);
			$username = $profile['firstName'].' '.$profile['lastName'];
			$to = $user['email'];
			
			
			$str = "Hello {$username}.";
			$str .= "\r\n<br/>";
			$str .= "TheTalkList Tutor Coordinator noticed that your tutoring calendar is not open for new sessions, please login and open more sessions so students can find you. \r\n<br/>";
			$str .= "\r\n<br/>";
			$str .= "You can review our tutorial, 'Preparing to be a Tutor', to see how you can maximize your exposure to our large English learning audience. \r\n<br/> ";	
			$str .= "\r\n<br/>";
			$str .= "Thanks for being a part of our community. \r\n<br/>";
			$str .= "TheTalkList Team";

			$this->load->library('email');
			$this->email->mailtype = 'html';
			$this->email->from('admin@thetalklist.com','TheTalklist');
			$this->email->to($to);
			$this->email->subject('TheTalklist open new sessions');
			$this->email->message($str);
			$this->email->send();
		}
		
	}
	
	public function addSlotTime2(){
		$permisson = $this->getPermission($this->uid);
		$success = 'false';
		$msg = strtotime(time());
		if($permisson !='teacher_private'){
			$success = 'false';
			$msg = 'You do not have permisson!';
		}
		else {
			$this->load->model('event_model');
			$day = $this->input->_request('day');
			$times = $this->input->_request('seletedSlot');
			$slots = $this->event_model->getEventsByDate($this->uid,$day. ' 00:00:00',$day. ' 23:59:59');
			$count = 0;
			foreach($times as $k=>$v){
				$start = $day.' '.$v;
				$added = false;
				$slotsTemp = $slots;
				foreach($slotsTemp as $slotK => $slot){
					$_start = date('g:i a',$this->event_model->outTime($slot['startTime']));
					if( $v == $_start){
						$added = true;
						unset($slots[$slotK]);
						continue;
					}
				}
				//var_dump($added);
				if(!$added){
					$msg .= 'add '.$start.'__';
					$end = date('Y-m-d H:i:s',strtotime($start)+ 1500);//25*60
					$this->event_model->creatTimeSlot($start,$end,$this->uid);
					$count++;
				}
			}
			foreach($slots as $k=>$v){
				$msg .= $v['startTime'].'__';
				$this->event_model->delTimeSlot($v['id'],$this->uid);
			}
			$insert = true;
			//$insert  = $this->event_model->creatTimeSlot($start,$end,$this->uid);
			if($insert){
				$success = 'true';
				//$success = 'false';
				$msg .= "add {$count} new time slot";
			}
			else {
				$success = 'false';
				$msg = 'Please check if the time is allready set to by Availability Time Slots!If not please contact to admin';
			}
		}
		echo json_encode(compact('success','msg'));
	}
	public function addSlotTime1(){
		$permisson = $this->getPermission($this->uid);
		if($permisson !='teacher_private'){
			$success = 'false';
			$msg = 'You do not have permisson!';
		}
		else {
			$this->load->model('event_model');
			$start = $this->input->_request('start');
			$end = $this->input->_request('end');
			$insert  = $this->event_model->creatTimeSlot($start,$end,$this->uid);
			if($insert){
				$success = 'true';
			}
			else {
				$success = 'false';
				$msg = 'Please check if the time is allready set to by Availability Time Slots!If not please contact to admin';
			}
		}
		echo json_encode(compact('success','msg'));
	}
    public function forget(){
        if($postData = $this->input->post()) {
		
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
			$arrVal = $this->lookup_model->getValue('962', $multi_lang);
			$passsent = $arrVal[$multi_lang];
			$arrVal = $this->lookup_model->getValue('963', $multi_lang);
			$incorrectmail = $arrVal[$multi_lang];
			$postData['username'] = $postData['email'];
			$corect = $this->user_model->checkForgetInfo($postData);
            if($corect){
                $info = $this->user_model->makeMd5Str($postData);
                $link = Base_url("user/changepw?email=".base64_encode($info['email'])."&str=".base64_encode($info['str'])."&time={$info['time']}");
                //$str = "A change of password has been requested for your account with Thetalklist.com.  If you initiated this, then click this link or copy it into a new browser:<a href='{$link}'>".$link."</a>\r\n<br/>";
				$str = "A change of password has been requested for your account with TheTalkList. If you initiated this, then click this link or copy it into a new browser:<a href='{$link}'>".$link."</a>\r\n<br/>";
                $str .= "\r\n<br/>";
                $str .= "This change request is good for 24 hours and applies to your account:\r\n<br/>";
                //$str .= "Username:{$info['username']}\r\n<br/>";
                $str .= "Email:{$info['email']}\r\n<br/>";
                $str .= "Request Time:".date('Y-m-d H:i:s',$info['time'])."\r\n<br/>";
                $str .= "\r\n<br/>";
                $str .= "If you have any problems please email the support team at:  support@thetalklist.com\r\n<br/>";
                $str .= "Thank you,           TheTalkList Support Team";
				$this->load->library('email');
                $this->email->mailtype = 'html';
                $this->email->from('admin@thetalklist.com','TheTalklist');
                $this->email->to($postData['email']);
                //$this->email->subject('Forget password in thetalklsit.com by '.$info['username']);
				$this->email->subject('Forgot password on TheTalkList.com by '.$info['username']);
                $this->email->message($str);
                $this->email->send();
                //$errorMsg = "We have sent you an email.please get it for change password.If you can not get it,please put admin@thetalklist.com into your white list.";
				$errorMsg = $passsent;
            }
            else{
                $errorMsg = $incorrectmail;
            }
            $this->layout->setData('errorMsg',$errorMsg);
        }
        $this->layout->view('user/forget');
    }

    public function changepw(){
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
		$arrVal = $this->lookup_model->getValue('972', $multi_lang);
		$pchanged = $arrVal[$multi_lang];
		
		$arrVal = $this->lookup_model->getValue('973', $multi_lang);
		$swrong = $arrVal[$multi_lang];
		
    	$forgetError = '';
    	if(isset($_GET['str']) && $_GET['str']!=''){
			$_GET['username'] = $_GET['email'];
    		$infoStatus = $this->user_model->checkMd5Str($_GET);
    		if($infoStatus){
    			$forgetError = '';
    		}
    		else{
    			$forgetError = 'The Link is nott correct.';
    		}
    		$this->layout->setData('infoStatus',$infoStatus);
    	}
		if( isset($_POST['password']) && $_POST['cpassword'] == '')
		{
			$forgetError='Please confirm password';
		}
		else if(isset($_POST['password']) && $_POST['password'] !='' && $_POST['cpassword'] !='' ){
			
			
    		$status = $this->user_model->changeFPassword($_POST);
			
    		if($status){
    			$forgetError = $pchanged;
				redirect('user/relogin');
			}
    		else{
    			$forgetError = $swrong;
    		}
    	}
    	$this->layout->setData('errorMsg',$forgetError);
        $this->layout->view('user/changepw');
    }

	public function delTeacher(){
		//$permisson = $this->getPermission($this->uid);
		if(!$this->user['uid']){
			$success = 'false';
			$msg = 'You must login first!';
		}
		else {
			$this->load->model('myTeacher_model');
			$this->myTeacher_model->delById($this->input->_request('id'),$this->user['uid']);
			$success = 'true';
			$msg = '';
		}
		echo json_encode(compact('success','msg'));
	}

	public function delClass(){
		if(!$this->user['uid']){
			$success = 'false';
			$msg = 'You must login first!';
		}
		else {
		
			$this->load->model('class_model');
			$this->load->model('pay_model');
			/*$rs = $this->class_model->getBySid($this->user['uid']);			
			$revertfee = $rs[0]['fee'];
			$studentid = $rs[0]['sid'];*/
			$rs = $this->class_model->getByCid($this->input->_request('id'));
			$revertfee = $rs['fee'];
			$studentid = $rs['sid'];
			
			if (strtolower($rs['session_type']) == 'free') {
				$this->class_model->RegenerateCoupon($studentid);
			} else {
				$feeSql = "update profile set money=money+{$revertfee} , frMoney=frMoney-{$revertfee} where uid={$studentid}";
				$query = $this->db->query($feeSql);
			}
			$this->message_send_cancel_class($this->input->_request('id'));
			$this->class_model->delById($this->input->_request('id'),$this->user['uid']);
			if($rs)
			{
				$this->pay_model->calcel_disputes($rs);
			}
			$success = 'true';
			$msg = '';
		}
		echo json_encode(compact('success','msg'));
	}
	
	public function studentdelclass(){
		$this->delClass();
	}
	public function buyClasses(){
	$permisson = $this->getPermission($this->uid);
		if($permisson !='teacher_public'){
			$success = 'false';
			$msg = 'You do not have permisson!';
		}
		else if(!$this->user['uid']){
			$success = 'false';
			$msg = 'You must login first!';
		}
		else {
			$this->load->model(array('event_model','myTeacher_model','profile_model'));
			$times = $this->input->_request('seletedSlot');
			if($times == ''){
				$times = array();
			}
			$tutorProfile = $this->profile_model->getProfile($this->uid);
			$profile = $this->profile_model->getProfile($this->user['uid']);
			$config = $this->profile_model->getConfig();
			$tutorProfile['t_hRate'] = $tutorProfile['hRate'];
			$tutorProfile['hRate'] = round($tutorProfile['hRate'] * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
			if($profile['money'] < count($times) * $tutorProfile['hRate']){
				$success = false;
				$msg = "You do not have enough money.";
				$firsttime = $this->event_model->isFirstTimeStudent($this->user['uid']);
				//skvirja accept for new student
				if($profile['new'] == '1' || $this->session->userdata('free_session') == 'y')
				{
					$success = true;
					$msg = "";
					$tutorProfile['hRate'] = 0;
					foreach ($times as $key => $value) {
						$this->event_model->creatClass($value,0,$this->user['uid'],$this->uid,$tutorProfile['hRate'],$tutorProfile['t_hRate']);
					}
					$this->myTeacher_model->creatMyTeacher($this->user['uid'],$this->uid,0);
					$success = true;
					//$firsttime = $this->event_model->isFirstTimeStudent($this->user['uid']);
				}
				//$firsttime = $this->event_model->isFirstTimeStudent($this->user['uid']);
			}
			else{
				$firsttime = $this->event_model->isFirstTimeStudent($this->user['uid']);
				foreach ($times as $key => $value) {
					$this->event_model->creatClass($value,0,$this->user['uid'],$this->uid,$tutorProfile['hRate'],$tutorProfile['t_hRate']);
				}
				$this->myTeacher_model->creatMyTeacher($this->user['uid'],$this->uid,0);
				$success = true;
			}
		}
		// TECHNO-SANJAY added below code for update user free session status
		if($success == true)
		{
			$this->session->set_userdata('free_session', 'n');
			$this->session->set_userdata('firstTime', 'n');
		}
		$this->session->set_userdata('sessionbooked', 'y');
		echo json_encode(compact('success','msg','firsttime'));
}
	public function checkClass() {
		$permisson = $this->getPermission($this->uid);
		if($permisson !='teacher_public'){
			$success = 'false';
			$msg = 'You do not have permisson!';
		}
		else if(!$this->user['uid']){
			$success = 'false';
			$msg = 'Please Sign Up to engage tutors.';
		}
		else {
			$this->load->model(array('event_model','myTeacher_model','profile_model'));
			$day = $this->input->_request('day');
			$times = $this->input->_request('seletedSlot');
			$secondtimes = array_count_values($times);
			$length  = count(array_keys( $secondtimes, "1" ));
			$schoolid = $this->input->_request('schoolval');
			$times = $this->input->_request('seletedSlot');
			$classTimes = $this->event_model->checkClassTime($day,$times,$this->uid,$this->user['uid']);
			$tutorProfile = $this->profile_model->getProfile($this->uid);
			$profile = $this->profile_model->getProfile($this->user['uid']);
			$config = $this->profile_model->getConfig();
			if($schoolid > 0 && $schoolid !='')
			{
				$tutor_markup=$this->profile_model->GetSchoolMarkup($schoolid);
				$markup=$tutor_markup[0]['tutor_markup'];
				
				$total=$tutorProfile['hRate']+$markup;
				$total+=$total*33/100;
				$tutorProfile['hRate']=number_format($total,2,'.','');
				
			}
			else
			{
				$tutorProfile['hRate'] = number_format(round($tutorProfile['hRate'] * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100,2,'.','');
			}
			
			
			$cost =  $length * $tutorProfile['hRate'];
			if($this->session->userdata('free_session') == 'y')
			{ $cost = 0; } else { $cost; }
			
			//echo (int)$profile['money'].'----'.int$cost;exit;
			$profile['money'] = (int)$profile['money'];

			if($profile['money'] >= $cost){
				$enough = true;
			}
			else{
				$enough = false;
			}
			// for free session available
			if($this->session->userdata('free_session') == 'y')
			{
				$enough = true;
			}
			/*
			if(count($cresult) != '0')
			{  
				$enough = false;
			}else{
				$enough = true;
			}
			*/
			//echo $enough;exit; 
			$nowTime = date('Y-m-d H:i:s ',time());
			$nowTime = date('Y-m-d H:i:s',$this->event_model->outTime($nowTime));
			$hours = 24;
			foreach ($classTimes as $key => $value) {
				$classTimes[$key] = date('Y-m-d g:i:s a',strtotime($value));
				
				//skvirja checks for book before 24 Hour
				$total_time = strtotime($value) - strtotime($nowTime);
				$hours      = floor($total_time /3600);  
				
			}
			//echo $hours;exit;
			if($hours<24)
			{
				$timeCheck24 = false;
			}else{
				$timeCheck24 = true;
			}
			$return = json_encode( compact('classTimes','cost','enough','timeCheck24') );
			echo $return;
			exit;
			foreach ($classTimes as $key => $value) {
				$this->event_model->creatClass($value,0,$this->user['uid'],$this->uid);
			}
			/*$slots = $this->event_model->getEventsByDate($this->uid,$day. ' 00:00:00',$day. ' 23:59:59');

			foreach($times as $k=>$v){
				$start = $day.' '.$v;
				$added = false;
				$slotsTemp = $slots;
				foreach($slots as $slotK => $slot){
					if(isset($slot['sid'])){
						continue;
					}
					$_start = date('g:i a',$this->event_model->outTime($slot['startTime']));
					if( $v == $_start){
						$added = true;
						unset($slots[$slotK]);
						continue;
					}
				}
				if(!$added){
					//$end = date('Y-m-d H:i:s',strtotime($start)+ 1500);//25*60
					$end = 0;
					$this->event_model->creatClass($start,$end,$this->user['uid'],$this->uid);
				}
			}*/
			$insert = true;
			if($insert){
				$success = 'true';
				$this->myTeacher_model->creatMyTeacher($this->user['uid'],$this->uid,0);
				//$msg = 'Success.';
			}
			else {
				$success = 'false';
				$msg = 'Please check if the time is allready set to by Availability Time Slots!If not please contact to admin';
			}
			$insert  = 1;
			if($insert){
				$success = 'true';

			}
			else {
				$success = 'false';
				$msg = 'Please check if the time is  Availability Time Slots?If yes please contact to admin';
			}
		}
		echo json_encode(compact('success','msg'));
	}
	public function addClass1(){
		$permisson = $this->getPermission($this->uid);
		if($permisson !='teacher_public'){
			$success = 'false';
			$msg = 'You do not have permisson!';
		}
		else {
			$this->load->model(array('event_model','myTeacher_model'));
			$start = $this->input->_request('start');
			$end = $this->input->_request('end');
			$insert  = $this->event_model->creatClass($start,$end,$this->user['uid'],$this->uid);
			if($insert){
				$success = 'true';
				$this->myTeacher_model->creatMyTeacher($this->user['uid'],$this->uid,0);
			}
			else {
				$success = 'false';
				$msg = 'Please check if the time is  Availability Time Slots?If yes please contact to admin';
			}
		}
		echo json_encode(compact('success','msg'));
	}

	public function teachers(){
		$this->_profile();
		$permisson = $this->getPermission($this->uid);
		//$schoolTut = $this->profile_model->CheckIsSchoolTutor($this->uid);
		//$this->layout->setData('schtut',$schoolTut['school_id']);
		if(strpos($permisson,'student') > -1){ 
			$this->load->model('myTeacher_model');
			$teachers = $this->myTeacher_model->getAll($this->uid);
			$sql="select refid from user where id={$this->uid}";
			$query = $this->db->query($sql);
			$result = $query->row_array();
			$this->layout->setData('Refid',$result['refid']);
			
			//added by haren for free student session 
		$q= "SELECT exp_session,is_eligible from user where  user.id='{$this->uid}'";
		$classquery = $this->db->query($q);				
		$classresult = $classquery->row_array();
		$cdate=date('Y-m-d');
			$free='';	
				if($classresult['exp_session'] > $cdate && $classresult['is_eligible']==1)
				{
			 
				 
				for($i=0;$i<count($teachers);$i++)
				{
					$teachers[$i]['hRate']="0.00";
				}
			}
			else
			{
			} 
			$teachers = $this->search_model->filterBookedTutors($teachers);
			$this->layout->setData('teachers',$teachers );
			$this->layout->view($this->getViewTemp($this->uid,'user/teachers'));
		}
		else{
			$this->layout->view('user/teachers/noTeachers');
		}
	}

	public function lessons(){
		$this->layout->setLayoutData('linkAttr','videolessons');
		$this->load->model(array('lesson_model','search_model'));
		$r = $this->input->_request('uid');
		$home_search = $this->session->userdata('uid');
        $this->_profile();
		if($home_search=='')
		{
			$lessons = $this->lesson_model->getAll($r);
		}
		else{
			$this->_profile();
			$this->load->model(array('lesson_model','search_model'));
			$permission = $this->getPermission($this->uid);
		
			/*if(strpos($permission,'student') > -1){
				$lessons = $this->lesson_model->getAllBySid($this->uid);
			}
			else {
				
				if($this->session->userdata('roleId') == 1)
				{
					$lessons = array();
				}else{
					
					if($this->search_model->checkPremiumTutorlessons($this->uid) == 1)
					{*/
					
						// Get List of Sale Video
						$lessonsforsale = $this->lesson_model->getAll($this->uid);
						// Get List of Purchased Video						
						$lessons = $this->lesson_model->getAllBySid($this->uid);
						
					/*}else{
						$lessons = array();
					}
				}
			} 	*/
		}
		$this->layout->setData('lessonsforsale',$lessonsforsale);
		$this->layout->setData('lessons',$lessons);
		if($home_search=='')
	 {  
	 $this->layout->view($this->getViewTemp($r,'user/lessons'));
	 }else
	 {
		$this->layout->view($this->getViewTemp($this->uid,'user/lessons'));
		
	}
	}
	public function updateLession(){
		$postData = $this->input->post();
		$postData['uid'] = $this->user['uid'];
		$this->load->model('lesson_model');
		if($this->lesson_model->update($postData)){
			$status = true;
		}
		else {
			$status = false;
		}
		$id = $this->input->_request('id');
		$lesson = $this->lesson_model->getOne( $id );
		$lesson['source'] =  profile_video($lesson['source']);
		$lesson['length'] = sec2min($lesson['length']);
		echo json_encode(array('status'=>$status,'lesson'=>$lesson));
	}

	public function buy_lesson(){
		$this->load->model('lesson_model');
		$lid = $this->input->_request('id');
		$return = $this->lesson_model->buy_lesson($lid,$this->user['uid']);
		echo json_encode($return);
	}
	public function delete_lesson(){
		$this->load->model('lesson_model');
		if(!isset($this->user['uid'])){
			echo json_encode(array('status'=>false,'msg'=>'Must login first!'));exit;
		}
		$lid = $this->input->_request('id');
		$return = $this->lesson_model->delLession($lid,$this->user['uid']);
		echo json_encode($return);
	}
	public function lesson_video(){
		$this->load->library('media','upload');
		$upConfig['upload_path'] = FCPATH.'uploads/video/';
		//$config['upload_path'] = './';
		//$upConfig['allowed_types'] = 'mp4|avi|flv|swf|rm|wma|3gp|wmv';
		$upConfig['allowed_types'] = '*';
		$upConfig['encrypt_name'] = true;

		$translateConfig['image_library'] = 'gd2';
		//$resizeConfig['source_image'] = '/path/to/image/mypic.jpg';
		$translateConfig['image'] = FCPATH.'uploads/video/images/';
		$translateConfig['path'] = FCPATH.'uploads/video/';
		$translateConfig['maintain_ratio'] = TRUE;
		$translateConfig['width'] = 706;
		$translateConfig['height'] = 399;
		$infos = $this->media->upload($upConfig)->translate($translateConfig)->getInfo();
		if($this->media->error){
			//var_dump($this->media->error);
			echo json_encode($this->media->error);
		}
		else {

			$lesson_id = $this->input->_request('lesson_id');
			$this->load->model(array('media_model','lesson_model'));
			$mediaInfo = $this->media->data['upload_data'];
			$mediaInfo['uid'] = $this->user['uid'];
			$mediaInfo['address'] = $this->media->sqlAddress;
			$this->media_model->save($mediaInfo);
			//$lesson_id = $this->lesson_model->lessonVedio($lesson_id , $this->user['uid'],$this->media->sqlAddress,$infos['seconds']);
			$lesson_id = $this->lesson_model->lessonVedio($lesson_id , $this->user['uid'],$this->media->sqlAddress,$infos['play_time']);
			echo json_encode(
								array('video'=>Base_url('/uploads/video/'.$this->media->sqlAddress),
									'image'=>Base_url('/uploads/video/images/'.$this->media->sqlAddress ),
									'lesson_id'=>$lesson_id
								)
							);
		}
	}

	public function inbox(){
		header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
		header('Pragma: no-cache'); // HTTP 1.0.
		header('Expires: 0'); // Proxies.
		
		/*print_r($this->user);
		exit;*/
		if(!$this->user){
			redirect('user/login');
		}

		$permission = $this->getPermission($this->uid);
		
		if(strpos($permission,'public') > -1){
			$this->layout->view('user/invalid');
		}
		else{
			$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
     		 
			$this->layout->setData('linkType',$type);
		}
		$this->load->model(array('inbox_model'));
		$this->_profile();
		$this->load->library('pagination');

		$config['enable_query_strings'] = true;
		$config['uri_segment'] = 3;
		$config['page_query_string'] = false;
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = base_url('user/inbox');
		$config['num_links'] = 4;
		$config['total_rows'] = $this->inbox_model->getCount($this->user['uid']);
		$config['per_page'] = 10;
		$config['cur_tag_open'] = '<span class="current"><b>';
		$config['last_link'] = '&gt;&gt;';
		$config['first_link'] = '&lt;&lt;';

		$config['cur_tag_close'] = '</b></span>';
		$this->pagination->initialize($config);
		$page = (int)$this->uri->segment(3);
		if(!$page){
			$page = 1;
		}
		
		//$rs = $this->inbox_model->getResult($this->user['uid'],'1');
		
		/*$unreadMessages = $this->unread_message_counter();
		$this->layout->setData('unreadMessages',$unreadMessages);*/
		
		$this->layout->setData('inboxs',$this->inbox_model->getResult($this->user['uid'],$page));
		//var_dump($page);
		$this->layout->setData('pagination',$this->pagination->create_links());
		$this->layout->view('user/inbox');
	}
	public function unread_message_counter(){
		if(!$this->user){
			redirect('user/login');
		}
		
		$this->load->model(array('inbox_model'));
		$uid = $this->user['uid'];
		$unread = $this->inbox_model->getUnreadMessages($uid);
		$unreadMessages = 0;
		if($unread)
		{
			$unreadMessages = $unread['num'];
		}
		//echo $unreadMessages;
		return $unreadMessages; 
	}
	
	public function message_send(){		
		 
		if(!isset($this->user['uid'])){
			echo json_encode(array('status'=>false,'msg'=>'Must login first!'));
			return;
		}
		if($_POST==array())
		{
			$this->inbox();return;
		}
		
		$_POST['message']=nl2br($_POST['message']);
		$this->load->model(array('inbox_model'));
		
		$toUsername =$_POST['email'];
		$file=$_FILES;

		if($toUsername == '')
		{			 
			$toUid = $_POST['uidurl'];
		}else{			 
			$toUid = $this->inbox_model->getUidByUsername($toUsername);			
		}

		if($toUsername == '')
		{
			$Concatresult = $this->inbox_model->getconcatSearch($_POST['keyword']);	
			 if($Concatresult != array())
			 {
				$toUid=$Concatresult['uid']	;
			 }
			else
			{
					$this->session->set_userdata('succsend', 'Message sending  failed.');
					$this->inbox();
					return;
			}		
		}
		
		$personal = "SELECT forwardemail FROM user where id =".$toUid;
		$perquery = $this->db->query($personal);
		$perresult = $perquery->row_array();
		if($toUid ==1){
			 
			$toUid = $_post['uidurl'];
		}
		if(!$toUid){
			echo json_encode(array('status'=>false,'msg'=>'Member not found.  Please check.'));
			return;
		}
		$attachment='';
		$attachDoc='';	
		//for forwars message :Added by haren
		
		if($_POST['isAttached'] !='' ||  $_POST['isAttached'] !=0)
		{
			
			
			$url=FCPATH."attachment/".$toUid;
			If(file_exists($url))
			{ 
			}
			else
			{
				 mkdir($url,0777,true); 
			}
			// create seprate directory -to keep sent record 
			$url1=FCPATH."attachment/".$this->user['uid'];
			If(file_exists($url1))
			{ 
			}
			else
			{
				 mkdir($url1,0777,true); 
			}
				
			
			$sample = $this->foldersize($url);
			$useSpace = number_format($sample[0] / 1048576, 2) . ' MB';
			$roleId=$this->inbox_model->GetByRoleId($toUid);
			if($roleId['roleId']== 3 && $useSpace >= 50)
			{
				$this->sendInboxRemindMail($toUid);
				$this->session->set_userdata('succsend', 'Error in sending message.');
				$this->inbox();return;
			}
			
		

			
			if($roleId['roleId'] < 3 && $useSpace >=20)
			{
				$this->sendInboxRemindMail($toUid);
				$this->session->set_userdata('succsend', 'Error in sending message.');
				$this->inbox();return;
			}
			
			
			
			
			
				$sample1 = $this->foldersize($url);
			$useSpace = number_format($sample[0] / 1048576, 2) . ' MB';
			$rids=$this->inbox_model->GetByRoleId($this->user['uid']);
			if($rids['roleId']== 3 && $useSpace >= 50)
			{
				$this->sendInboxRemindMail($this->user['uid']);
				$this->session->set_userdata('succsend', 'Error in sending message.');
				$this->inbox();return;
			}
			
		

			
			if($rids['roleId'] < 3 && $useSpace >=20)
			{
				$this->sendInboxRemindMail($this->user['uid']);
				$this->session->set_userdata('succsend', 'Error in sending message.');
				$this->inbox();return;
			}
			
			
			$inboxId=$_POST['isAttached'];
			$qry="select attach,toId from inbox where id={$inboxId}";
			$RES= $this->db->query($qry);
			$AllData = $RES->row_array();
			$source_url=FCPATH."attachment/".$AllData['toId']."/".$AllData['attach'];
			$Dest_url=$url."/".$AllData['attach'];
			$AllData['attach']=$AllData['attach']."f";
			$ext = pathinfo($Dest_url, PATHINFO_EXTENSION);
			$newName=rand().".".$ext;
			$Dest_url=$url."/".$newName;
			//echo $Dest_url;die;
			copy($source_url ,$Dest_url);
			$attachment=$newName;
			$attachDoc= chunk_split(base64_encode(file_get_contents($Dest_url)));
		
		}
		
		else{}
		//for send new message Added by haren
		if(isset($_FILES) && $_FILES['attach']['tmp_name'] !='')
		{
			$url=FCPATH."attachment/".$toUid;
		 
			If(file_exists($url))
			{ 
				
			}
			else
			{
				 mkdir($url,0777,true); 

			}
			
			$url1=FCPATH."attachment/".$this->user['uid'];
			//echo $url1;die;
			If(file_exists($url1))
			{ 
			}
			else
			{
				 mkdir($url1,0777,true); 
			}
			
			$sample = $this->foldersize($url);
			 
			//echo "Folder Size : " . $sample[0] . " Bytes </br>" ;
			//echo "File Count : " . $sample[1] . " Files </ br>" ;
			 $useSpace = number_format($sample[0] / 1048576, 2) . ' MB';
			$roleId=$this->inbox_model->GetByRoleId($toUid);
			 
			if($roleId['roleId']== 3 && $useSpace >= 50)
			{
				$this->sendInboxRemindMail($toUid);
				$this->session->set_userdata('succsend', 'Error in sending message.');
				$this->inbox();return;
			}
			
			if($roleId['roleId'] < 3 && $useSpace >=20)
			{
				$this->sendInboxRemindMail($toUid);
				$this->session->set_userdata('succsend', 'Error in sending message.');
				$this->inbox();return;
			}
			
			
			$sample1 = $this->foldersize($url);
			$useSpace = number_format($sample[0] / 1048576, 2) . ' MB';
			$rids=$this->inbox_model->GetByRoleId($this->user['uid']);
			if($rids['roleId']== 3 && $useSpace >= 50)
			{
				$this->sendInboxRemindMail($this->user['uid']);
				$this->session->set_userdata('succsend', 'Error in sending message.');
				$this->inbox();return;
			}
			
		

			
			if($rids['roleId'] < 3 && $useSpace >=20)
			{
				$this->sendInboxRemindMail($this->user['uid']);
				$this->session->set_userdata('succsend', 'Error in sending message.');
				$this->inbox();return;
			}
			 
			$data['attach'] = time().'_attach'.strrchr($_FILES['attach']['name'],'.');
			move_uploaded_file($_FILES['attach']['tmp_name'],$url."/".$data['attach']);
			$source=$url."/".$data['attach'];
			$dest=$url1."/".$data['attach'];
			copy($source,$dest); 
			 
			$attachment=$data['attach'];
			$attachDoc= chunk_split(base64_encode(file_get_contents($url."/".$data['attach'])));
			
		}
		 
	 
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$email   = $_POST['email'];
		$message=str_replace("'", "", $message);
		$pattern = "/\"/";
		$replace = "";
		$message = preg_replace($pattern,$replace,$message); 
		$send = $this->inbox_model->send($toUid,$this->user['uid'],$subject,$message,$attachment);
		$messId=mysql_insert_id();
		
		//added by haren -> january scope
		$sentItem = $this->inbox_model->SentItem($toUid,$this->user['uid'],$subject,$message,$attachment,$messId);
		
		$inbid = $message;
		//--R&D@Sept-18-2013 : SEND EMAIL FOR BEEP MESSAGE
		/*
		$fromName ='TalkMaster BlueBob'; 
		$str = 'TalkMaster BlueBob sends this message to you from TheTalkList:<br/><br/>';
		$str .= $message;
		$str.=$attachment;
		$this->load->library('email');
		$this->email->mailtype = 'html';
		$this->email->from('no-reply@thetalklist.com',$fromName);
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($str);
		$this->email->send();*/
		//--SEND EMAIL FOR BEEP MESSAGE
		if($perresult['forwardemail'] == 1){		
			$email = $this->forward_message($toUid,$inbid, $subject);
		}$this->session->set_userdata('succsend', 'Message sent.');
		if($this->input->post("popup")==1) {
			echo json_encode(array('status'=>$send,'msg'=>'Please contact to admin!'));
		} else {			
			return $this->inbox();			
		}
	}
	
	public function message_tutor_send(){
		if(!isset($this->user['uid'])){
			echo json_encode(array('status'=>false,'msg'=>'Must login first!'));
			return;
		}
		$this->load->model(array('inbox_model'));
		$toUsername = $this->input->_request('uname');
		//echo $toUsername;exit;
		if($toUsername == '')
		{
			//echo '1-in';
			$toUid = $this->input->_request('uidurl');
		}else{
			//echo '2-in';
			$toUid = $this->inbox_model->getUidByUsername($toUsername);			
		}
		 
		$personal = "SELECT forwardemail FROM user where id =".$toUid;
		$perquery = $this->db->query($personal);
		$perresult = $perquery->row_array();
		
		if($toUid ==1){
			$toUid = $this->input->_request('uidurl');
		}
		
		if(!$toUid){
			echo json_encode(array('status'=>false,'msg'=>'Member not found.  Please check.'));
			return;
		}
		$subject = $this->input->_request('subject');
		$message = $this->input->_request('message');
		$email   = $this->input->_request('email');
		$message=str_replace("'", "", $message);
		$pattern = "/\"/";
		$replace = "";
		$message = preg_replace($pattern,$replace,$message); 
		$send = $this->inbox_model->send($toUid,$this->user['uid'],$subject,$message);
		$inbid = $message;
		//--R&D@Sept-18-2013 : SEND EMAIL FOR BEEP MESSAGE
		$fromName ='TalkMaster BlueBob'; 
		$str = 'TalkMaster BlueBob sends this message to you from TheTalkList:<br/><br/>';
		$str .= $message;
		$this->load->library('email');
		$this->email->mailtype = 'html';
		$this->email->from('no-reply@thetalklist.com',$fromName);
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($str);
		//$this->email->send();
		//--SEND EMAIL FOR BEEP MESSAGE
		if($perresult['forwardemail'] == 1){		
			$email = $this->forward_message($toUid,$inbid, $subject);
		}
		echo json_encode(array('status'=>$send,'msg'=>'Please contact to admin!'));
		return;
	}
	public function send_message(){
	
		if(!$this->user){
		
			redirect('user/login');
		}
		
		$urluidnew = urldecode($this->input->_request('uid'));
		
		if($this->uri->segment(4) != '' || $urluidnew != '' && $_GET["message"]=='')
		{ 
			$fsql = "SELECT u.email,p.firstName,p.lastName,p.uid,u.id FROM user as u,profile as p where u.id = p.uid AND u.id = ".$this->uri->segment(4);
			//$fsql = "SELECT u.email,p.firstName,p.lastName,u.id FROM user as u LETF JOIN profile as p  on p.uid=u.id LEFT JOIN inbox on inbox.toid=u.id  where u.id = p.uid AND u.id = ".$this->uri->segment(4);
			$fquery = $this->db->query($fsql);
			$fresult = $fquery->row_array();
			$this->layout->setData('fresult',$fresult);
		}
		$permission = $this->getPermission($this->uid);
	 
			$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
			
			$this->layout->setData('linkType',$type);
	 
		$this->_profile();
		$subject = urldecode($this->input->_request('subject'));
		$meid = $this->input->_request('message');
		
		
		if($_GET["message"])
		{
		
			 $ClsId=$_GET["message"];
			 $sql ="select sid from class where id={$ClsId}";
			$query = $this->db->query($sql);
			$result = $query->row_array();
			
			if(!empty($result)){
				$fsql = "SELECT u.email,p.firstName,p.lastName,u.id,p.uid FROM user as u,profile as p where u.id = p.uid AND u.id = ".$result['sid'];
				$fquery = $this->db->query($fsql);
				$fresult = $fquery->row_array();
				$this->layout->setData('fresult',$fresult);
				$subject = "Vee-session follow up";
				$message="Please send a message to your student and make them aware of your availability for a future booking.";
				$this->layout->setData('subject',$subject);
				$this->layout->setData('message',$message);
			}
			/*$this->layout->setData('uidurl',$uidurl);
			$this->layout->setData('username',$username);
			
			$this->layout->setData('messId',$messId);
			$this->layout->setData('usersId',$UserId);*/
			
			$this->layout->view('user/send_message');
		
		} 
		else
		{
			$messId=0;
			$message = '';
			if($meid != ''){
				$mesql = "SELECT subject,message,createAt,attach FROM inbox where id = ".$meid;
				$mequery = $this->db->query($mesql);
				$meresult = $mequery->result_array();
				$dt=$meresult[0]['createAt'];
				$dt="Sent : " .date( ' M d, Y, h:i a' , outTime($dt,'a') );
				
				$subject = 'Re: '.$meresult[0]['subject'];
				$message = "<br/><br/><br/>".$dt."<br/><br/>".$meresult[0]['message'];
			}
		
		$username = urldecode($this->input->_request('username'));
		if($this->uid !='' && $this->uid != $this->user['uid']){
			$this->load->model('user_model');
			$user = $this->user_model->getByUid($this->uid);
			$username = $user['username'];
		}
		$messageId = $this->input->_request('mid');
		if($messageId != ''){
			$this->load->model('inbox_model');
			$inbox = $this->inbox_model->getDetail($this->user['uid'],$messageId);
			
			$subject = 'Forward: '.$inbox['subject'];
			$message = $inbox['message'];;
			$attachment = $inbox['attach'];
			$messId=$inbox['id'];
			$UserId = $inbox['toId'];
		}if(urldecode($this->input->_request('email')))
		{
			$uidurl = urldecode($this->input->_request('email'));
		}else{
			$uidurl = 0;
		}
		if(urldecode($this->input->_request('uid')))
		{
			$uidurl = urldecode($this->input->_request('uid'));
		}else{
			$uidurl = 0;
		}
		$this->layout->setData('uidurl',$uidurl);
		$this->layout->setData('username',$username);
		$this->layout->setData('subject',$subject);
		$this->layout->setData('messId',$messId);
		
		$this->layout->setData('attachment',$attachment);
		$this->layout->setData('usersId',$UserId);
		$this->layout->setData('message',$message);
		$this->layout->view('user/send_message');
		}
	}
	// SKVIRJA 01 july 2013 function for auto suggest
	public function auto_user()
	{
		$this->load->model('profile_model');
		$keyword = trim($this->input->_request('data'));
		
		$users = $this->profile_model->getProfileByKeyword($keyword);
		if(count($users)>0)
		{
			echo '<ul class="list">';
			foreach($users as $user)
			{
				//@$str = $user['firstName'].''.$user['uid'];
				@$str = $user['firstName'];
				if(trim($str) != '' && trim($keyword) != '')
				{
					$start = strpos($str,@$keyword); 
				}else{
					$start = 0;
				}
				$end   = similar_text($str,$keyword)+1; 
				//$last = substr($str,$end,strlen($str));
				
				$last = $user['uid'];
				$first = substr($str,$start,$end);
				$img   = $user['pic'];
				if($img =='')
				{
					$img = base_url().'images/base/hd-pic.png';
				}else{
					$img = base_url().'uploads/images/thumb/'.$img;
				}
				$final = '<span class="bold">'.ucfirst($str).'</span>'.$last;
				echo '<li><div class="abc1"><a  onclick=\'javascript:setemail("'.$user['email'].'");\'><img class="space" src="'.$img.'" alt="image" height="30px" width="30px"/><div class="sl-txt">'.$final.'</div></a></div></li>';
				//echo '<li><div class="abc1"><a  href=\'javascript:setemail("'.$user['email'].'");\'><img class="space" src="'.$img.'" alt="image" height="30px" width="30px"/><div class="sl-txt">'.$final.'</div></a></div></li>';
			}
			echo "</ul>";
		}else{
			echo '<li>No results found</li>';
		}
		}
	/**
	* @author skvirja
	* @param forward beepbox messages
	**/
	public function forward_messages(){
		if(!isset($this->user['uid'])){
			echo json_encode(array('status'=>false,'msg'=>'Must login first!'));
			return;
		}
		$this->load->model(array('inbox_model'));
		$id = $this->input->_request('id');
		if(is_array($id)) {
		    foreach($id as $inbid)
			{
				$email = $this->forward_message($this->user['uid'],$inbid);
			}
		}else{
			$email = $this->forward_message($this->user['uid'],$inbid);
		}
		//$del = $this->inbox_model->delMessage($this->user['uid'],$id);
		echo json_encode(array('status'=>true,'msg'=>'message Forwarded to '.$email,'email'=>$email));
		return;
	}
	public function forward_message($uid,$inbId,$subject){		
		$fsql = "SELECT email FROM user where id = ".$uid;
		$fquery = $this->db->query($fsql);
		$fresult = $fquery->result_array();
		$rs = $fresult[0];
		$inboxId = "SELECT id,fid FROM inbox where message=".$this->db->escape($inbId)." AND subject=".$this->db->escape($subject);
		$inboxq = $this->db->query($inboxId);
		$inboxres = $inboxq->result_array();
		$inrs = $inboxres[0];
		$inrsfid = $inboxres[0]['fid'];
		$fidrecord = $this->profile_model->getUserName($inrsfid);

		$ffname = $fidrecord[0]['firstName'];
		//$flname = $fidrecord[0]['lastName'];
		$flname = $fidrecord[0]['uid'];

		$userEmail = $rs['email'];
		$messageId = $inrs['id'];
		
		if($messageId != ''){
			$this->load->model('inbox_model');
			$inbox = $this->inbox_model->getDetail($uid,$messageId);
			//$subject = 'Forward: '.$inbox['subject'];
			$subject = $inbox['subject'];
			$message = $inbox['message'];
			$fromName = $ffname.''.$flname; 
			$str = $ffname.''.$flname.' sends this message to you from TheTalkList:<br/><br/>';
			$str .= $message;
			$this->load->library('email');
			$this->email->mailtype = 'html';
			$this->email->from('no-reply@thetalklist.com',$fromName);
			$this->email->to($userEmail);
			$this->email->subject($subject);
			$this->email->message($str);
			$this->email->send();
			return $userEmail;
		}
	}
	public function del_message(){
		if(!isset($this->user['uid'])){
			echo json_encode(array('status'=>false,'msg'=>'Must login first!'));
			return;
		}
		$this->load->model(array('inbox_model'));
		$id = $this->input->_request('id');
		$del = $this->inbox_model->delMessage($this->user['uid'],$id);

		echo json_encode(array('status'=>$del,'msg'=>'Please contact to admin!'));
		return;
	}
	public function message_view_next(){
	
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
		$arrVal = $this->lookup_model->getValue('1037', $multi_lang);
		$firstmsg = $arrVal[$multi_lang];
		$arrVal = $this->lookup_model->getValue('1038', $multi_lang);
		$lastmsg = $arrVal[$multi_lang];
			
		if(!isset($this->user['uid'])){
			echo json_encode(array('status'=>false,'msg'=>'Must login first!'));
			return;
		}
		$this->load->model(array('inbox_model'));
		$id = $this->input->_request('id');
		$type = $this->input->_request('type');
		$status = true;
		//$return = array();
		if($type == 'prev'){
			$message = $this->inbox_model->getPrev($this->user['uid'],$id);
			$updatereadsql = "update inbox set isRead=1 where id = ".$message['id'];
			$updatereadquery = $this->db->query($updatereadsql);
			if(!$message){
				$message['msg'] = $firstmsg;
				$status = false;
			}
		}
		else{
			$message = $this->inbox_model->getNext($this->user['uid'],$id);
			if(!$message){
				$message['msg'] = $lastmsg;
				$status = false;
			}
		}
		$message['status'] = $status;

		echo json_encode($message);
		return;
	}
	public function view_message(){
		if(!$this->user){
			redirect('user/login');
		}

		$permission = $this->getPermission($this->uid);
		if(strpos($permission,'public') > -1){
			$this->layout->view('user/invalid');
		}
		else{
			$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));

			$this->layout->setData('linkType',$type);
		}
		$this->_profile();
		$this->load->model(array('inbox_model'));
		$id = $this->input->_request('id');
		if(!$id){
			redirect('user/inbox');
		}
		$message = $this->inbox_model->getDetail($this->user['uid'],$id);
		
		$updatereadsql = "update inbox set isRead=1 where id = ".$message['id'];
		$updatereadquery = $this->db->query($updatereadsql);

		//$fsql = "SELECT email FROM user where id = ".$message['fId'];
		$fsql = "SELECT u.email,p.firstName,p.lastName,p.uid,u.id FROM user as u,profile as p where u.id = p.uid AND u.id = ".$message['fId'];
		$fquery = $this->db->query($fsql);
		$fresult = $fquery->row_array();
		
		$url=FCPATH."attachment/".$message['toId']."/".$message['attach'];
		$size=filesize($url); 
		$size=$this->formatBytes($size,'2');
		$this->layout->setData('fresult',$fresult);
		$this->layout->setData('message',$message);
		$this->layout->setData('Size',$size);
		$this->layout->view('user/view_message');
	}
	
	function formatBytes($bytes, $precision = 2) { 
		$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

		$bytes = max($bytes, 0); 
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
		$pow = min($pow, count($units) - 1); 
		
		// Uncomment one of the following alternatives
		$bytes /= pow(1024, $pow);
		// $bytes /= (1 << (10 * $pow)); 


		return round($bytes, $precision) . ' ' . $units[$pow]; 
	} 
	function score_ajax(){
		$this->layout->setLayout('none');
		if($this->input->post()){
			$fname = $this->input->_request('fname');
			//$fname = $this->input->_request('fname');
		
			$updateFields = '';
			/*if($this->input->_request('fname'))
			{*/
				$updateFields .= 'last_toiec_score ="'.$this->input->_request('fname').'",';
			//}
			/*if($this->input->_request('lname'))
			{*/
				$updateFields .= 'last_toefl_score ="'.$this->input->_request('lname').'",';
			//}
			if($this->input->_request('mname'))
			{
				$updateFields .= 'last_oplc_score ="'.$this->input->_request('mname').'",';
			}
			/*if($this->input->_request('age'))
			{*/
				$updateFields .= 'current_tolec_score ="'.$this->input->_request('age').'",';
			//}
			/*if($this->input->_request('phoneno'))
			{*/
				$updateFields .= 'current_toefl_score ="'.$this->input->_request('phoneno').'",';
			//}
			if($this->input->_request('email'))
			{
				$updateFields .= 'current_oplc_score ="'.$this->input->_request('email').'",';
			}
			
			/*if($updateFields != '')
			{*/
				$updateFields = substr($updateFields,0,strlen($updateFields)-1);
				echo $sql = 'UPDATE profile set '.$updateFields.' WHERE uid= '.$this->uid;
				$query = $this->db->query($sql);
			//}
			
		}else{
			$sql = "SELECT * FROM profile where uid = ".$this->uid;
			$query = $this->db->query($sql);

			$result = $query->result_array();
			$this->layout->setData('result',$result);
			$this->layout->view('user/ajaxscore');
			
		}
	}
	/**
	* @author skvirja
	* @param auto suggest users on chat
	**/
	function auto_chat_suggestion(){
		
		$queryString = $_REQUEST['queryString'];
		$_SESSION['queryString'] = $queryString;
		$this->layout->setLayout('none');
		$uid = $this->uid;
		$string = '';
		
		$onlineUsersData = $this->getInstantOnlineUsers();
		$this->load->model(array('dchatmodel','profile_model'));
		
		$onlineUsers = array();
		
		if($onlineUsersData)
		{
			$u = 0;
			
			foreach($onlineUsersData as $udataid)
			{
				if($udataid == $uid)
				{
					continue;
				}else{
					$onlineUserDataRecord = $this->profile_model->getProfile($udataid);
					
					$onlineUsers[$u]['uid'] = $udataid;
					$onlineUsers[$u]['pic'] = $onlineUserDataRecord['pic'];
					$onlineUsers[$u]['welcomeuser'] = $onlineUserDataRecord['firstName'].' '.$onlineUserDataRecord['lastName'];
					$queryInv = $this->dchatmodel->getInvitation($udataid);
					if($queryInv){
						if ($queryInv->num_rows() > 0) {
							$onlineUsers[$u]['invitationStatus'] = 1;
						}else{
							$onlineUsers[$u]['invitationStatus'] = 0;
						}
					}
					
					$queryInvStatus = $this->dchatmodel->getInvitationStatus($udataid);
				
					if($queryInvStatus){
						//echo '<pre>';
						//print_r($queryInvStatus);exit;
						$onlineUsers[$u]['chatInvitationStatus'] = $queryInvStatus[0]['status'];
					}
				}
				$u++;
			}
		//	print_r($onlineUsers);
			$this->layout->setData('onlineUsers',$onlineUsers);
		}
		$this->layout->view('user/dashboard/auto_chat_suggestion');
	}
	
	function private_chat(){
		$this->layout->setLayout('none');
	
		$sql = "select userid from dchat_group_user where invitedbyuid = ".$this->uid;
		$query = $this->db->query($sql);

		$result = $query->result_array();
		$seconduserid = $result[0]['userid'];

		$gid = $seconduserid;
		$uid = $this->uid;
		$this->layout->view('user/dashboard/private_chat');		
	}
	/**
	* @author skvirja
	* @param display uploaded image on cropping tool
	**/
	function browse_image_view(){
		$this->layout->setLayout('none');
		$dataarray = $this->session->CI->layout->data;
		$uid = $this->uid;
		$imgsrc = $dataarray['pinfo']['pic'];
		$this->layout->setData('imgsrc',$imgsrc);
		$this->layout->setData('uid',$uid);
		$this->layout->setData('success','false');
		$this->layout->view('user/browse');		
	}
	/**
	* @author skvirja
	* @param image cropping function for profile image
	**/
	function crop_image(){
		$this->layout->setLayout('none');
		$uid = $this->uid;
		
		$imgsrc = $this->session->userdata('pic');
		$basePath =  substr(BASEPATH,0,-7); 
		$src = $basePath.'/uploads/images/thumb/'.$imgsrc;
		$destpath = $basePath. '/uploads/images/thumb/'.$imgsrc;
	
	
		$data['x'] = $this->input->post('x');
        $data['y'] = $this->input->post('y');
        $data['w'] = $this->input->post('w');
        $data['h'] = $this->input->post('h');

        $config['image_library'] = 'gd2';
        //$path =  'uploads/apache.jpg';
		$config['source_image'] = $src;

		//$config['create_thumb'] = TRUE;
        //$config['new_image'] = $basePath. '/uploads/images/thumb/'.$imgsrc;
        $config['maintain_ratio'] = FALSE;
        $config['width']  = $data['w'];
        $config['height'] = $data['h'];
        $config['x_axis'] = $data['x'];
        $config['y_axis'] = $data['y'];

        $this->load->library('Image_lib', $config); 

        if(!$this->image_lib->crop())
        {
            echo $this->image_lib->display_errors();
        }  
		/*
		
		if(file_exists($destpath))
		{
			unlink($destpath);
		}
		$ext = explode('.',$src);
		$ext = strtolower(end($ext));
		
		$this->layout->setData('imgsrc',$imgsrc);
		$this->layout->setData('uid',$uid);
		
		
		$targ_w = $targ_h = 260;
		$jpeg_quality = 160;
		//print_r($_POST);
		//exit;
		
		$post_x = $_POST['x'];
		$post_y = $_POST['y'];
		$post_w = $_POST['w'];
		$post_h = $_POST['h'];
		/*
		$post_x = $this->input->_request('x');
		$post_y = $this->input->_request('y');
		$post_w = $this->input->_request('w');
		$post_h = $this->input->_request('h');
		*/
		//echo $ext;exit;
		/*if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG')
		{
			$img_r = imagecreatefromjpeg($src);
		}else if($ext == 'png'){
			$img_r = imagecreatefrompng($src);
		}
		$dst_r = ImageCreateTrueColor($targ_w, $targ_h );
		
		imagecopyresampled($dst_r,$img_r,0,0,$post_x,$post_y,$targ_w,$targ_h,$post_w,$post_h);
		//if($ext == 'jpg' || $ext == 'jpeg')
		//{
			imagejpeg($dst_r,$destpath,$jpeg_quality);
		//}else if($ext == 'png'){
			//imagepng($dst_r,$destpath,$jpeg_quality);
		//}
		//imagejpeg($dst_r,$destpath,$jpeg_quality);
		*/
		$this->layout->setData('success','true');
		
		$this->layout->view('user/browse');		
	}
	
	function groupname(){
		$groupid = $_POST['gid'];
		$sql = "select user_id,chat_name from dchat where chat_id = ".$groupid;
		$query = $this->db->query($sql);
		$result = $query->result_array();
		//print_r($result);
	
		$uid = $result[0]['user_id'];
		$chat_name = $result[0]['chat_name'];
		$profile = "SELECT uid,firstName FROM profile LEFT JOIN user ON user.id = profile.uid where user.id=".$uid;
		$profilequery = $this->db->query($profile);
		$profileresult = $profilequery->result_array();
		$sprofile = "SELECT uid,firstName FROM profile LEFT JOIN user ON user.id = profile.uid where user.id=".$chat_name;
		$sprofilequery = $this->db->query($sprofile);
		$sprofileresult = $sprofilequery->result_array();

		//print_r($profileresult[0]['uid']);
		echo json_encode(array('results'=>$profileresult[0],'sresults'=>$sprofileresult[0]));
	}
	function revert_profile_image()
	{
		$uid = $this->session->userdata('uid');
		$img = $this->input->_request('img');
		  
		$this->profile_model->revert_profile_image($uid,$img);
		$this->session->set_userdata(array('pic'=>$img));
		echo json_encode(array('results'=>'success'));
	}
	function browse()
	{
		$this->layout->view('user/browse');
	}

	/**
	* @author skvirja
	* @param Newsletter send function
	**/
	function send_newsletter()
	{
	/*
		$this->load->model(array('messaging_model'));
		$this->load->library('email');
		//get newsletter
		$ns = $this->messaging_model->getAllNewsletter();
		$newslettertemplate = array();
		if(count($ns)>0)
		{
			$newslettertemplate = $ns[0];
		}
		
		$n1 = 0;
		$n2 = 0;
		$n3 = 0;
		$n4 = 0;
		$n5 = 0;
		$n6 = 0;
		$n7 = 0;
		$n9 = 0;
		$n10 = 0;
		$n11 = 0;
		
		$action = $this->input->_request('action');
		//$action = 'n7';
		if($action == ''){$action == 'all';}
		if($action == 'n1'):
			$n1 = 1;
		elseif($action == 'n2'):
			$n2 = 1;
		elseif($action == 'n3'):
			$n3 = 1;
		elseif($action == 'n4'):
			$n4 = 1;
		elseif($action == 'n5'):
			$n5 = 1;
		elseif($action == 'n6'):
			$n6 = 1;
		elseif($action == 'n7'):
			$n7 = 1;
		elseif($action == 'n9'):
			$n9 = 1;		
		elseif($action == 'n10'):
			$n10 = 1;		
		elseif($action == 'n11'):
			$n11 = 1;
		else:
			$n1 = 1;
			$n2 = 1;
			$n3 = 1;
			$n4 = 1;
			$n5 = 1;
			$n6 = 1;
			$n7 = 1;
			$n9 = 1;
			$n10=1;
			$n11=1;
		endif;
		
		// fire emails for each templates
		
		if($n10==1)
		{
				$this->load->model('user_model');
				$this->load->model('inbox_model');
				$Session = $this->user_model->GetUnconfirmedClass(); 
				if(count($Session)>0)
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
						$send = $this->inbox_model->send($Session[$i]['sid'],1,$subject,$str1);
						$this->load->library('email');
						$this->email->mailtype = 'html';
						$this->email->from('admin@thetalklist.com','TheTalklist');
						//$this->email->to($user[$i]['email']);
						$this->email->to($result['email']);
						$this->email->subject($subject);
						$this->email->message($str1);
						$this->email->send();
						$str='';
						$str1='';
					}	
				
				}
			
		}
		
		if($n11==1)
		{
				$this->load->model('user_model');
				$this->load->model('inbox_model');
				$Session = $this->user_model->GetUnconfirmedClassTutor(); 
				if(count($Session)>0)
				{
					$subject='Request Session Timeout';
					for($i=0;$i<count($Session);$i++)
					{
						$sql="delete from class where id='{$Session['id']}'";
						$query = $this->db->query($sql);
						$Name=$Session[$i]['firstName'].'  '.$Session[$i]['lastName'];
						$date=date("Y-m-d", strtotime($Session[$i]['startTime']));
						$str .= str_replace('{$name}',$Name,nl2br($newslettertemplate['n11']));
						$str1 .= str_replace('{$date}',$date,$str);
						$sql="select email from profile where uid={$Session[$i]['tid']}";
						$query = $this->db->query($sql);
						$result = $query->row_array();
						$send = $this->inbox_model->send($Session[$i]['tid'],1,$subject,$str1);
						$this->load->library('email');
						$this->email->mailtype = 'html';
						$this->email->from('admin@thetalklist.com','TheTalklist');
						$this->email->to($result['email']);
						$this->email->subject($subject);
						$this->email->message($str1);
						$this->email->send();
						$str='';
						$str1='';
					}	
				
				}
			
		}
		
		if($n4 == 1)
		{
			$studentsNotPay = $this->messaging_model->getAllStudent();
			if($studentsNotPay)
			{
				foreach($studentsNotPay as $st)
				{
					// checks for student has booked session or not
					if($st['id'])
					{
						$chk = $this->messaging_model->notPayeeStudents($st['id']);
						if($chk == 0)
						{
							$str = "";
							$this->email->mailtype = 'html';
							$this->email->from('no-reply@thetalklist.com','TheTalkList Admin');
							$this->email->subject('Book Free Session');
							$name = $this->messaging_model->getUserName($st['id']);
							$str .= str_replace('{$name}',$name,nl2br($newslettertemplate['n4']));
							//echo $st['email'];exit;
							$this->email->message($str);
							//$this->email->to($st['email']);
							$this->email->to('virang@technoinfonet.com');
							//@$this->email->send();
							
						}
						
					}
				}
				//exit;
			}
			
		}
		if($n1 == 1)
		{
			$tutors = $this->messaging_model->getAllTutor();
			
			if($tutors)
			{
				$emails = array();
				foreach($tutors as $st)
				{
					// checks for student has booked session or not
					if($st['id'])
					{
						$chk = $this->messaging_model->lastOpenedSession($st['id']);
						if($chk == 0)
						{
							$str = "";
							$this->email->mailtype = 'html';
							$this->email->from('no-reply@thetalklist.com','TheTalkList Admin');
							$this->email->subject('Open Calendar Sessions ');
							$name = $this->messaging_model->getUserName($st['id']);
							$str .= str_replace('{$name}',$name,nl2br($newslettertemplate['n1']));
							//echo $st['email'];exit;
							$this->email->message($str);
							//$this->email->to($st['email']);
							$this->email->to('virang@technoinfonet.com');
							//@$this->email->send();
						}
					}
				}
				//exit;
			}
		}
		if($n2 == 1)
		{
			
		}
		if($n3 == 1)
		{
			
		}
		
		//If Student has not booked a session for last 2 weeks, send weekly email reminder
		if($n5 == 1)
		{
			$students = $this->messaging_model->getAllStudent();
			if($students)
			{
				$emails = array();
				foreach($students as $st)
				{
					// checks for student has booked session or not
					if($st['id'])
					{
						$chk = $this->messaging_model->bookSessionCheck($st['id']);
						if($chk == 0)
						{
							$str = "";
							$this->email->mailtype = 'html';
							$this->email->from('no-reply@thetalklist.com','TheTalklist');
							$this->email->subject('Book Free Session');
							$name = $this->messaging_model->getUserName($st['id']);
							$str .= str_replace('{$name}',$name,nl2br($newslettertemplate['n5']));
							//echo $st['email'];exit;
							$this->email->message($str);
							//$this->email->to($st['email']);
							$this->email->to('virang@technoinfonet.com');
							//@$this->email->send();
							
						}
						
					}
				}
				//exit;
			}
		}
		//Send affiliate text message. Affiliate # will be generated using member # as reference 
		if($n6 == 1)
		{
			$users = $this->messaging_model->getAllMember();
			
			$this->email->mailtype = 'html';
			$this->email->from('no-reply@thetalklist.com','TheTalkList Admin');
			$this->email->subject('Affiliate Link');
			
			foreach($users as $user)
			{
				$name = $this->messaging_model->getUserName($user['id']);
				$affiliatelink = "www.thetalklist.com/".$user['id'];
				$aflmsg = '';
				$aflmsg = str_replace('{$name}',$name,$newslettertemplate['n6']);
				$aflmsg = str_replace('{$affiliatelink}',$affiliatelink,$aflmsg);
				$str = "";
				$str .= nl2br($aflmsg);
				
				$this->email->message($str);
				//$this->email->to($user['email']);
				$this->email->to('virang@technoinfonet.com');
				//@$this->email->send();
				
			}
			//exit;
		}
		////viplove 18-2-14 free_session_expiration_alert start//////
		if($n7 == 1)
		{
			$this->load->model('messaging_model');
			$emails = $this->messaging_model->free_session_expiration_alert();
			$template = $this->messaging_model->free_session_expiration_alert_template();
			$this->load->library('email');
			for($i=0; $i<count($emails);$i++)
			{ 
				$name = $this->messaging_model->getUserName($emails[$i]['id']);
				$str = str_replace('{$name}',$name,nl2br($template[0]['n7']));
				$this->email->mailtype = 'html';
				$this->email->from('admin@thetalklist.com','TheTalklist');
				//$this->email->to($emails[$i]['email']);
				$this->email->to('virang@technoinfonet.com');
				$this->email->subject('Free Session Expiration Alert');
				$this->email->message($str);
				$this->email->send();
			}
		}
		////viplove 18-2-14 free_session_expiration_alert end//////

		//send mail to tuor whose profile is incomplete	
		if($n9 == 1)
		{
			$this->load->model('user_model');
		    $user = $this->user_model->GetIncompleteProfile(); 

			if(count($user)>0)
			{
				for($i=0;$i<count($user);$i++)
				{
					//$str = "Hi ".$user[$i]['firstName'] ;
					$str .= str_replace('{$name}',$user[$i]['firstName'],nl2br($newslettertemplate['n9']));
				//	$str .= "<br/>We�ve noticed that your tutor profile is still incomplete. We�d like you to complete it in order for students to<br>";
					//$str .= "<br/>find you! Please fill out your biography, photo, and video greeting as soon as possible. It won�t take more than<br>";
					//$str .= "<br/>15 minutes to get you on your way to earning a tutoring income!<br> <br> <br> <br>";
					//$str .= "<br/>Thank you,<br> <br> <br> ";	
					//$str .= "<br/>TheTalkList Team";	
					
					$this->load->library('email');
					$this->email->mailtype = 'html';
					$this->email->from('admin@thetalklist.com','TheTalklist');
					//$this->email->to($user[$i]['email']);
					$this->email->to('virang@technoinfonet.com');
					$this->email->subject('Hey! You need to complete your profile on TheTalkList!');
					$this->email->message($str);
					$this->email->send();
				}
			}
		}
		
		
		*/
	}
	
	function studentmsg()
	{
		$this->load->model(array('messaging_model'));
		$ns = $this->messaging_model->getAllNewsletter();
		$newslettertemplate = array();
		if(count($ns)>0)
		{
			$newslettertemplate = $ns[0];
		}
		
		/*echo "<pre>";
		print_r($newslettertemplate['n10']);*/
		/*exit;*/
		$this->load->model('user_model');
		$this->load->model('inbox_model');
		$Session = $this->user_model->GetUnconfirmedClass(); 
		
		if(count($Session)>0)
		{
			$subject='Request Session Timeout';
			for($i=0;$i<count($Session);$i++)
			{
				//echo "test";
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
				$studentid .= $Session[$i]['sid'];
			}
			
			$sql="select email from profile where uid={$studentid}";
			$query = $this->db->query($sql);
			$result = $query->row_array();
				//$send = $this->inbox_model->send($Session[$i]['sid'],1,$subject,$str1);
			$this->load->library('email');
			$this->email->mailtype = 'html';
			$this->email->from('admin@thetalklist.com','TheTalklist');
			//$this->email->to($user[$i]['email']);
			//$this->email->to($result['email']);
			$this->email->to('virang@technoinfonet.com');
			$this->email->subject($studentid);
			$this->email->message($str1);
			$this->email->send();
			$str='';
			$str1='';
		}
	}
	// SKV newsletter section end

	/* Start CODE COMMIT BY WDC @07-25-2013 */
	 public function ajaxLang(){
		$_SESSION['multi_lang'] = '';
		$multiLang = $this->input->post('multiLang');
		session_start();
		//unset($_SESSION['multi_lang']);
		$_SESSION['multi_lang'] = $multiLang;
		$arr = $_SESSION['multi_lang'];
		//$this->session->set_userdata(array('multi_lang'=>$multiLang));
		echo json_encode($arr);
		//echo $_SESSION['multi_lang'] = $multiLang;
	}
	
	public function ajaxLang12(){
		
		$_SESSION['multi_lang'] = '';
		$multiLang = $this->input->post('multiLang');
		//unset($_SESSION['multi_lang']);
		session_start();
		
		//$this->session->set_userdata(array('multi_lang'=>$multiLang));
		$_SESSION['multi_lang'] =$_GET['name'];
		 
		//echo json_encode(array('status'=>'success'));
		$obj->name ='';
        $obj->message = 'tst';
         
        echo $_GET['callback']. '(' . json_encode($obj) . ');';
	}
	/* End CODE COMMIT BY WDC @07-25-2013 */

	public function message_setting(){
		if(!$this->user){
			redirect('user/login');
		}
		$permission = $this->getPermission($this->uid);
		if(strpos($permission,'public') > -1){
			$this->layout->view('user/invalid');
		}
		else{
			$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));

			$this->layout->setData('linkType',$type);
		}
		$this->_profile();

		$this->layout->view('user/message_setting');
	}
	
	function forwardpemailUpdate()
	{
		$this->user_model->user_edit(array('forwardemail'=>$this->input->post('forwardpemail')), $this->uid);
		echo json_encode(array('status'=>'success'));
	}
	/**
	* @author skvirja
	* @param LMS - update document as read.
	**/
	public function update_doc_as_read()
	{
		$docid = $this->input->post('docid');
		$uid = $this->uid;
		$data['docid'] = $docid;
		$data['uid'] = $uid;
		$this->load->model(array('lms_model'));
		$this->lms_model->update_doc_as_read($data);
		$statusCompleteAll = $this->checks_for_doc_completed();
		echo json_encode(array('status'=>'success','completeAll'=>$statusCompleteAll));
		
	}
	/**
	* @author skvirja
	* @param checks for LMS all document is readed or not
	**/
	public function checks_for_doc_completed()
	{
		$this->load->model('lms_model');
		$documents = $this->lms_model->getAll();
		$isReadAll = 1;
		if($documents)
		{
			foreach($documents as $document)
			{
				// checks user read for this document
				$status = $this->lms_model->checks_read_doc_complete($document['id'],$this->uid);
				if($status == false)
				{
					$isReadAll = 0;
				}
			}
		}
		// update on user profile as training requirement is complete
		if($isReadAll == 1)
		{
			$this->lms_model->updateForComplete($this->uid);
		}
		return $isReadAll;
	}
	/**
	* @author SKVIRJA  21 Aug 2013
	* @package Taking Test
	* @param test function 
	**/
	public function test(){
		if(!$this->user){
			redirect('user/login');
		}
		$permission = $this->getPermission($this->uid);
		if(strpos($permission,'public') > -1){
			$this->layout->view('user/invalid');
		}
		else{
			$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
			//echo $type;exit;
			$this->layout->setData('linkType',$type);
		}
		$this->_profile();
		$this->load->model('lms_model');
		
		if($this->input->post())
		{
			$post = $this->input->post();
			$data = array();
			if($post)
			{
				$countCorrectAns = 0;
				$countWrongAns = 0;
				$answers = array();
				$i = 0;
				foreach($post as $key => $value )
				{
					$ans = $value;
					$answers[$i] = $ans;
					$key = explode('_',$key);
					$queId = $key[1];
					$getAns = $this->lms_model->get_ans($queId);
					if($getAns)
					{
						$qoAns = $getAns['rans'];
						if($qoAns == $ans)
						{
							$countCorrectAns++;
						}else{
							$countWrongAns++;
						}
					}
					$i++;
				}
				$data['answers'] = serialize($answers);
				$data['CorrectAns'] = $countCorrectAns;
				// calculate test answers
				$totalNumOfQuestion = $this->lms_model->get_total_que();
				$percentage = ($countCorrectAns * 100) / $totalNumOfQuestion;
				if($percentage >= 75)
				{
					$passed = 1;
					$retest = 0;
				}else{
					$passed = 0;
					$retest = 1;
				}
				$data['passed'] = $passed;
				$data['retest'] = $retest;
				$data['score'] = $percentage;
				
				// add this exam to db
				$this->lms_model->update_exam($data,$this->uid);
				
				$this->layout->setData('result',$data);
				$this->layout->view('user/test');
				
			}
			
		}else{
			// get existing test if given 
			$examTest = $this->lms_model->getExam($this->uid);
			$this->layout->setData('existingTest',$examTest);
			$questions = $this->lms_model->getAllQuestion();
			$this->layout->setData('questions',$questions);
			$this->layout->view('user/test');
		}	
		
	}
	public function trainingrequirements(){
		if(!$this->user){
			redirect('user/login');
		}
		$permission = $this->getPermission($this->uid);
		if(strpos($permission,'public') > -1){
			$this->layout->view('user/invalid');
		}
		else{
			$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
			//echo $type;exit;
			$this->layout->setData('linkType',$type);
		}
		$this->_profile();
		$this->load->model('lms_model');
		$docid = $this->input->_request('docid');
		$documenet = $this->lms_model->get($docid);
		
		$this->layout->setData('document',$documenet);
		$this->layout->view('user/trainingrequirements');
	}
	/**
	* @author skvirja
	* @param book now function from search page
	**/

public function sendBookNowMessage(){
	$tid 			=  $this->input->_request('tid');
	$fee 			=  $this->input->_request('cost');
	$schoolid       = $this->input->_request('schoolId');
	
	if($fee == '')
	{
		$fee = 0.00;
	}
	//$tid 			=  '610';
	$this->load->model(array('profile_model','class_model','event_model'));
	$profile 		= $this->profile_model->getProfile($tid);
	
	$this->load->library('twilio');
	$from 			= '+16193774807';
	$to 			= $profile['cell'];
	
	$sid = $this->uid;
	$sid  = $this->session->userdata['uid'];
	if($to !=''){
		$to = '121111' ;
		//$to = '+'.$to;
		//get opened class by this teacher
		//$class = $this->class_model->getBookNowClassByUid($tid);
		//$cid = @$class['id'];
		$cid = '';
		//date('I', time());exit;
		$sid = $this->uid;
		
		//$sid = 555;
		// create a new class if not exists
		if($cid == ''){	
			$cid = $this->createEmptyClass($sid,$tid,$schoolid);
		}
		//update on confirm class with this tutor
		$date = date('Y-m-d H:i:s');
		$this->class_model->updateConfirmClass($cid,$tid,$sid,$date,$to);
		// update class time
		//$start = date('Y-m-d H:i:s',time() + 8*60);
		//date_default_timezone_set('Asia/Dhaka');
		$start 							= date('Y-m-d H:i:s',time() + 5*60);
		$end 							= date('Y-m-d H:i:s',strtotime($start) + 25*60);
		$classUpdate['startTime'] 		= $start;
		$classUpdate['endTime'] 		= $end;
		$classUpdate['sid'] 			= $sid;
		$classUpdate['id'] 				= $cid;
		$this->class_model->updateClass($classUpdate);
		//send success email 
		$this->event_model->sendBookNowScuessEmail($sid,$tid,strtotime($start));
		//update class users tokens
		$apiKey 						= $data['apiKey'] = '21029512' ;
		$api_secret 					= "ea40167d9c3b010598d37be3565276b2e1b2c488";
		$updatedClass 					= $this->class_model->getNearClassById($classUpdate['id']);
		$this->load->library('OpenTokSDK',array('api_key'=>$apiKey,'api_secret'=>$api_secret));
		$usersBook['t'] 				= array('pic'=>$updatedClass['tp'],'name'=>$updatedClass['tf'].' '.$updatedClass['tl'],'uid'=>$updatedClass['tid']);
		$usersBook['s'] 				= array('pic'=>$updatedClass['sp'],'name'=>$updatedClass['sf'].' '.$updatedClass['sl'],'uid'=>$updatedClass['sid']);
		$sessionId_Book 				= $updatedClass['session_id'];

		//send a sms to tutor 
		$tutotTimezone = $this->user_model->getLastLocalTimeZone($tid);
		$dateInLocal = date("h:i a", $this->class_model->outTime($updatedClass['startTime']));
		//$tutotTimezone = 'America/Boise';
		if($tutotTimezone == 'America/Boise'){
			$oldTime 			= time($dateInLocal);			
			$timeAfterOneHour 	= $oldTime+60*60*4.6;
			$dateInLocal = date("h:i a",$timeAfterOneHour);				
		}else{	
			$dateInLocal = $this->event_model->utc_to_local('h:i a',$updatedClass['startTime'],$tutotTimezone);
		}
	

		//$message = $updatedClass['sf'].' is trying to book a session with you on the TheTalkList now. You need to confirm and join the Vee-session by '.$dateInLocal.'. Text: 1=confirm 2=deny';
		
		// Get User Selected Topic
		$selTopic = $this->user_model->fnGetRecentSearch($this->session->userdata('uid'));
		//$this->layout->setData('selTopic',$selTopic);
		$topic = "";
		if ($selTopic[0]['topic']) {
			$this->load->model(array('category_model'));
			$selCat = $this->category_model->selCategory("`id` = '".$selTopic[0]['topic']."'");
			$topic = $selCat['category'];
			$pdfurl = "#";
			if(!empty($selCat['pfile']) and file_exists(FCPATH.'uploads/categories/'.$selCat['pfile'])){
				$pdfurl = base_url("/uploads/categories/".$selCat['pfile']);
			}
		}
		//$message = $updatedClass['sf'].''.$updatedClass['suid'].' is trying to book a '.$topic.' session with you on TheTalkList NOW. Join the Vee-session by ['.$dateInLocal.']. Else this booking will automatically cancel.';		
		$message = $updatedClass['sf'].''.$updatedClass['suid'].' is trying to book a session about '.$topic.' with you on TheTalkList NOW. Join by ['.$dateInLocal.']. Else this booking will auto-cancel.';

		//$to = '+919904665258';
		//$to = '+919998978397';
		$to = $profile['cell'];

		$response = $this->twilio->sms($from, $to, $message);
		if($response->IsError){
			$error = $response->ErrorMessage;
		}else{
			$error = '';
		}			
	}

	 
	//--R&D@JAN-28-2014 Update Free session
	$isEligibleForfreeSession = $this->class_model->updateFreeSession($sid);
	if($isEligibleForfreeSession == true){
		$_data['uid'] 			= $sid;
		$_data['free_session'] 	= 'n';
		$this->profile_model->update($_data);
		$this->session->set_userdata(array('free_session' =>'n'));
	}

	$feeSql = "update profile set money=money-{$fee} , frMoney=frMoney+{$fee} where uid={$sid}";
	$query = $this->db->query($feeSql);

	//--R&D@JAN-28-2014 Update Free session
	echo json_encode(array('status'=>'success','error'=>$error));
	}
	/**
	* @author skvirja 9 Oct 2013
 	* @param  create a empty class
	**/
	public function createEmptyClass($sid,$tid,$shcoolId)
	{
		$this->load->model(array('profile_model','class_model','event_model'));
		$profile = $this->profile_model->getProfile($tid);
		if($shcoolId > 0)
		{
			$tutorProfile = $this->profile_model->getProfile($tid);
			$hrate = $tutorProfile['hRate']; 
			$markup="select tutor_markup from profile where uid={$shcoolId}";
			$sql = $this->db->query($markup);
			$cresult = $sql->row_array();
			$srate=$cresult['tutor_markup'];
			$tutorProfile['hRate']=number_format(($hrate+$srate+(($hrate+$srate)*0.33)),2,'.','');
			$fee = $tutorProfile['hRate'];
			$schoolmarkup=$this->profile_model->GetSchoolMarkup($shcoolId) ;
			$s_markup=$schoolmarkup[0]['tutor_markup']; 
			
			/* added by haren if tutor hrate is 0  then allow free */
			if($hrate <=0)
			{
				$s_markup=0;
				$fee =0;
			}
			
			/* haren code end */
		}
		else
		{
			$config = $this->profile_model->getConfig();
			$fee = round($profile['hRate'] * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
			$s_markup=0;
			$tutorProfile = $this->profile_model->getProfile($tid);
			$hrate = $tutorProfile['hRate']; 
		}
		$nowdate = date('Y-m-d H:i:s',time());
		// create a empty class
		
		$q= "SELECT exp_session,is_eligible from user where  user.id='{$sid}'";
		$classquery = $this->db->query($q);				
		$classresult = $classquery->row_array();
		$cdate=date('Y-m-d');
		$free='';	
		if($classresult['exp_session'] > $cdate && $classresult['is_eligible']==1)
		{
			$rtype='free';
			$fee =0.00;
			$hrate=0.00;
		} 
		else {
			$rtype='requested';
		}
		
		$sql = "INSERT INTO class (tid,sid,createAt,type,fee,school_id,t_hrate,s_markup,session_type,Booking) VALUES ( {$tid},{$sid},'{$nowdate}','now','{$fee}','{$shcoolId}','{$hrate}','{$s_markup}','{$rtype}','Booked')";
		$query = $this->db->query($sql);
		$cid = $this->db->insert_id();
		//$disputesql = "insert into disputes (`sid`,`createAt`,`tid`,`fee`,`approve`,`paymentstatus`,`postpone`,`t_hrate`,`School_id`,`cid`) values ({$sid},'{$nowdate}',{$tid},{$fee},'0','Unpaid','0','{$hrate}','{$shcoolId}','{$cid}')";
		$disputesql = "insert into disputes (`sid`,`createAt`,`tid`,`fee`,`approve`,`paymentstatus`,`postpone`,`t_hrate`,`School_id`,`cid`,`s_markup`) values ({$sid},'{$nowdate}',{$tid},{$fee},'0','Unpaid','0','{$hrate}','{$shcoolId}','{$cid}','{$s_markup}')";
		$disputequery = $this->db->query($disputesql);
		
		/*$Updatesql = "update user set is_eligible=0 where id='{$sid}'";
		$disputequery = $this->db->query($Updatesql);*/
		/*
		$apiKey = $data['apiKey'] = '21029512' ;
		$api_secret = "ea40167d9c3b010598d37be3565276b2e1b2c488";
		$this->load->library('OpenTokSDK',array('api_key'=>$apiKey,'api_secret'=>$api_secret));
		
		$class = $this->class_model->getNearClassById($cid);
		
		$session = $this->opentoksdk->createSession( $_SERVER["REMOTE_ADDR"], array(SessionPropertyConstants::P2P_PREFERENCE=> "enabled") );
		$sessionId = $session->getSessionId();
		
		$tokenS = '';
		$tokenT = '';
		$this->class_model->upSession($class['id'],$sessionId,$tokenS,$tokenT);//setcookie('_sessionId',$sessionId);
		*/
		return $cid;
	}
	/**
	* @author skvirja
	* @param book now checks for confirmed class by tutor via sms reply
	**/
	public function checkClassConfirmed()
	{
		$this->load->model(array('profile_model','class_model','inbox_model'));
		$uid = $this->uid;
		
		$getNotConfirmedClass = $this->class_model->getNotConfirmedClass($uid);
		$redirect = false;
		$tutorNotConfirmed = false;
		$cid = '';
		if(count($getNotConfirmedClass)>0)
		{
			foreach($getNotConfirmedClass as $class)
			{
				$cid = $class['cid'];
				$date = date('Y-m-d H:i:s');
				$classDateStr = strtotime($class['date']);
				$nowDateStr = strtotime($date);
				$differenceMins = ($nowDateStr - $classDateStr) / 60;
				//echo $differenceMins;exit;
				// checks for this class tutor has confirmed or not
				$responseMsg = $this->class_model->checkForSmsReply($class);
				//$responseMsg = trim($responseMsg);
				//new book now flow popup message if tutor is not entered within 5 min.
				if($differenceMins > 5){
					$tutorNotConfirmed = true;
					$this->class_model->updateClassSmsResponse($responseMsg,$class);
					//update to class action
					$action = array();
					$action = $this->class_model->getClassAction($cid);
					$action['tutorConnected'] = 0;
					$this->class_model->updateClassAction($action,$cid);
				}
				//checks for if tutor is entered on class
				$classAction = $this->class_model->getClassAction($cid);
				
				if(@$classAction['tutorConnected'] == 1){
					$redirect = true;
					$this->class_model->updateClassSmsResponse($responseMsg,$class);
				}
				if($responseMsg == '2'){
					$tutorNotConfirmed = true;
					$this->class_model->updateClassSmsResponse($responseMsg,$class);
					$action = array();
					$action = $this->class_model->getClassAction($cid);
					$action['tutorConnected'] = 0;
					$this->class_model->updateClassAction($action,$cid);
				}
				
				// set static value for check further process
				//$responseMsg = '1';
				//$differenceMins = 3;
				/*
				if($responseMsg == '1' && $class['sid'] == $this->uid)
				{	
					// when tutor confirms this class then below procedure
					// student will automatically launched into vee-session
					// send a beepbox message to student, that say tutor has confirmed class
					$toUid = $class['sid'];
					$fromUid = 1;
					$subject = 'Vee-Session';
					$message = 'Tutor is on the way in a few minutes. Please join Vee-session from your calendar page now.';
					$send = $this->inbox_model->send($toUid,$fromUid,$subject,$message);
					
					$this->forward_inbox_message($toUid,$subject,$message);
					
					if($differenceMins <= 5)
					{
						$redirect = true;
						
						//update response to class
						$this->class_model->updateClassSmsResponse($responseMsg,$class);
					}
					
					
				}else if($responseMsg == '2')
				{
					// when tutor unconfirmed class then below procedure
					// send a beepbox message to student, that say tutor has not confirmed class
					$tidProfile = $this->profile_model->getProfile($class['tid']);
					$tutorname = $tidProfile['firstName'].' '.$tidProfile['lastName'];
					$toUid = $class['sid'];
					$fromUid = 1;
					$subject = 'Vee-Session';
					$message = $tutorname.' was not able to confirm appointment. So please find any one of our other tutors available NOW';
					$send = $this->inbox_model->send($toUid,$fromUid,$subject,$message);
					
					$this->forward_inbox_message($toUid,$subject,$message);
					//update response to class
					$this->class_model->updateClassSmsResponse($responseMsg,$class);
					
				}else if($responseMsg == '')
				{
					// when tutor not response in withing 5 mins then below procedure occures
					if($differenceMins > 5)
					{
						//sends response to student's beepbox : NAME cannot confirm this booking on TheTalklist.  Try one of our other wonderful tutors online right now!
						$tidProfile = $this->profile_model->getProfile($class['tid']);
						$tutorname = $tidProfile['firstName'].' '.$tidProfile['lastName']; 
						$toUid = $class['sid'];
						$fromUid = 1;
						$subject = 'Vee-Session';
						$message = $tutorname.' cannot confirm this booking on TheTalklist.  Try one of our other wonderful tutors online right now!';
						$send = $this->inbox_model->send($toUid,$fromUid,$subject,$message);
						
						$this->forward_inbox_message($toUid,$subject,$message);
						//update response to class
						$responseMsg = 0;
						$this->class_model->updateClassSmsResponse($responseMsg,$class);
					}
					
				}
				else
				{
					$responseMsg = 0;
				}*/
				//update response to class
				//$this->class_model->updateClassSmsResponse($responseMsg,$class);
			}
		}
		echo json_encode(array('status'=>'success','redirect'=>$redirect,'cid'=>$cid,'tutorNotConfirmed'=>$tutorNotConfirmed));
	}
	/**
	* @author skvirja
	* @param forward inbox message to user email if checked to forward
	**/
	public function forward_inbox_message($uid,$subject,$message)
	{
		$this->load->library('email');
		
		$personal = "SELECT forwardemail,email FROM user where id =".$uid;
		$perquery = $this->db->query($personal);
		$perresult = $perquery->row_array();
		
		if($perresult['forwardemail'] == 1){		
			$str = "";
			$str .= "TalkMaster BlueBob sends this message to you from TheTalkList:\r\n<br/>";
			$str .= $message;
			$str .= "\r\n<br/>";
			$fromName ='TalkMaster BlueBob'; 
			$subject = 'Forward:'.$subject;
			$this->email->mailtype = 'html';
			$this->email->from('no-reply@thetalklist.com',$fromName);
			$this->email->subject($subject);
			$this->email->message($str);
			$this->email->to($perresult['email']);
			//$this->email->send();
		}
	}
	/**
	* @author skvirja
	* @param upload document function for vee session
	**/
	public function upload_vee_chat_document()
	{
		$this->load->library('media','upload');
		$upConfig['upload_path'] = FCPATH.'uploads/source/';
		//$upConfig['allowed_types'] = 'mp4|avi|flv|swf|rm|wma|3gp|wmv|MP4';
		$upConfig['allowed_types'] = '*';
		$upConfig['encrypt_name'] = true;
		$this->media->upload($upConfig);
		if($this->media->error){
			echo json_encode($this->media->error);
		}
		else {
			$this->load->model('media_model');
			$mediaInfo = $this->media->data['upload_data'];
			$mediaInfo['uid'] = $this->uid;
			$mediaInfo['address'] = $this->media->sqlAddress;
			$this->media_model->save($mediaInfo);
			$ext = '';
			if($this->media->sqlAddress)
			{
				$file = explode('.',$this->media->sqlAddress);
				$ext = trim($file[1]);
			}
			$ext	=	strtolower($ext);
			if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif')
			{
				$fileType = 'image';
			}else{
				$fileType = 'document';
			}
			//echo $fileType;exit;
			echo json_encode(array('source'=>'http://54.215.1.79/uploads/source/'.$this->media->sqlAddress,'ext'=>$ext,'filetype'=>$fileType));
		}
	}
	
	
	public function upload_testvee_chat_document()
	{
		$this->load->library('media','upload');
		$upConfig['upload_path'] = FCPATH.'uploads/source/';
		//$upConfig['allowed_types'] = 'mp4|avi|flv|swf|rm|wma|3gp|wmv|MP4';
		$upConfig['allowed_types'] = '*';
		$upConfig['encrypt_name'] = true;
		$this->media->upload($upConfig);
		if($this->media->error){
			echo json_encode($this->media->error);
		}
		else {
			$this->load->model('media_model');
			$mediaInfo = $this->media->data['upload_data'];
			$mediaInfo['uid'] = $this->uid;
			$mediaInfo['address'] = $this->media->sqlAddress;
			$this->media_model->save($mediaInfo);
			$ext = '';
			if($this->media->sqlAddress)
			{
				$file = explode('.',$this->media->sqlAddress);
				$ext = trim($file[1]);
			}
			$ext	=	strtolower($ext);
			if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif')
			{
				$fileType = 'image';
			}else{
				$fileType = 'document';
			}
			//echo $fileType;exit;
			echo json_encode(array('source'=>'http://54.215.1.79/uploads/source/'.$this->media->sqlAddress,'ext'=>$ext,'filetype'=>$fileType));
		}
	}
	/**
	*  @author skvirja - 05 oct 2013
	*  @ param checks for locked class
	**/
	public function checkLockedClass(){
		$this->_profile();
		$this->load->model(array('class_model','chat_model'));
		
		$permisson = $this->getPermission($this->uid);
		$classes = array();
		switch($permisson) {
			case 'invalidUser':break;
			case 'student_private':$classes = $this->class_model->getBySid($this->uid);break;
			case 'teacher_private':$classes = $this->class_model->getByTid($this->uid);break;
			case 'studdent_public':break;

		}
		$timeNow = date('Y-m-d H:i:s',time());
		$timeNowStr = strtotime($timeNow);
		
		$sessionUser = 'Yes';
		$returnClass = array();
		$s = 0;
		if(count($classes)>0)
		{
			$i = 0;
			
			$newClassesTemp = array();
			
			foreach($classes as $class)
			{
				
				//get existing locked users for skip
				if($class['action'] != '')
				{
					$action = unserialize($class['action']);
					
					if($this->session->userdata('roleId') == 0)
					{
						if(@$action['studentConnected'] == 1)
						{
							continue;
						}
					}else{
						if(@$action['tutorConnected'] == 1)
						{
							continue;
						}
					}
				}
				
				$classTimeStr = strtotime($class['startTime']);
				$classDiffInMin = round(($classTimeStr - $timeNowStr) / 60,2);
				$returnClass['reload']='false';
				
				if($classDiffInMin < 15 && $classDiffInMin > 14.9)
				{
					$returnClass['reload']='true';
				}
				//checks for user enters on class
				//echo $this->session->userdata('locked');
				$lockedSession = 'locked_'.$class['id'];
				if($this->session->userdata($lockedSession))
				{
					if($this->session->userdata($lockedSession) == 'No')
					{
						$sessionUser = 'No';
					}else{
						$sessionUser = 'Yes';	
					}
				}else{
					$sessionUser = 'Yes';
				}
				
				/*echo $sessionUser;
				echo $classDiffInMin;
				exit;*/

				if($classDiffInMin < -3 && $sessionUser == 'Yes')
				{
					$s++;
					$newClassesTemp[$i]['locked'] = 1;
					$newClassesTemp[$i]['id'] = $class['id'];
					//update status locked on class
					$data = $this->class_model->getClassAction($class['id']);
					/*if($this->session->userdata('roleId') == 0)
					{
						$data['slocked'] = 1; 
					}else{
						$data['tlocked'] = 1; 
					}*/
					$data['slocked'] = 1; 
					$data['tlocked'] = 1; 
					
					$this->class_model->updateClassAction($data,$class['id']);
					
					//send message to users when locked
					if($this->session->userdata('roleId') == 0)
					{
						$ups = 's_msg'.$class['id'];
						if(!$this->session->userdata($ups))
						{
							$dataSend['msg'] = "Your student did not show up, please beep him a note saying that you missed him today. The good news is that you still get paid!";
					    }
						$this->session->set_userdata(array($ups=>$class['id']));
					}else{
						$ups = 't_msg'.$class['id'];
						if(!$this->session->userdata($ups))
						{
							//$dataSend['msg'] = "Tutor didn't showup and go choose another wonderful tutor.";
							$dataSend['msg'] = "We are sorry your tutor did not show up. Please beep him a message or choose another wonderful tutor. Your credits will be reimbursed.";
							//exit;
					    }
						$this->session->set_userdata(array($ups=>$class['id']));
					}
					$dataSend['uid'] = $this->session->userdata('uid');
					$dataSend['classId'] = $class['id'];
					
					$this->chat_model->save($dataSend);
				}
				$i++;
			}
		}
		$returnClass['classes'] = $newClassesTemp;
		$returnClass['count'] = $s;
		echo json_encode($returnClass);
	}
	
	public function checksessionLockedClass(){
		$this->_profile();
		$this->load->model(array('class_model','chat_model'));
		
		$cid = $this->input->post('id');
		//$permisson = $this->getPermission($this->uid);
		/*$classes = array();
		switch($permisson) {
			case 'invalidUser':break;
			case 'student_private':$classes = $this->class_model->getBySid($this->uid);break;
			case 'teacher_private':$classes = $this->class_model->getByTid($this->uid);break;
			case 'studdent_public':break;

		}*/
		$timeNow = date('Y-m-d H:i:s',time());
		$timeNowStr = strtotime($timeNow);
		
		$classes = $this->class_model->getByCsessionid($cid);
		//print_r($classes);
		$sessionUser = 'Yes';
		$returnClass = array();
		$s = 0;
		if(count($classes)>0)
		{
			$i = 0;
			
			$newClassesTemp = array();
			
			foreach($classes as $class)
			{
				
				//get existing locked users for skip
				if($class['action'] != '')
				{
					$action = unserialize($class['action']);
					
					if($this->session->userdata('roleId') == 0)
					{
						if(@$action['studentConnected'] == 1)
						{
							continue;
						}
					}else{
						if(@$action['tutorConnected'] == 1)
						{
							continue;
						}
					}
				}
				
				$classTimeStr = strtotime($class['startTime']);
				$classDiffInMin = round(($classTimeStr - $timeNowStr) / 60,2);

				//checks for user enters on class
				//echo $this->session->userdata('locked');
				$lockedSession = 'locked_'.$class['id'];
				if($this->session->userdata($lockedSession))
				{
					if($this->session->userdata($lockedSession) == 'No')
					{
						$sessionUser = 'No';
					}else{
						$sessionUser = 'Yes';	
					}
				}else{
					$sessionUser = 'Yes';
				}
				
				/*echo $sessionUser;
				echo $classDiffInMin;
				exit;*/
				
				if($classDiffInMin < 0 && $sessionUser == 'Yes')
				{
					$s++;
					$newClassesTemp[$i]['locked'] = 1;
					$newClassesTemp[$i]['id'] = $class['id'];
					//update status locked on class
					$data = $this->class_model->getClassAction($class['id']);
					if($this->session->userdata('roleId') == 0)
					{
						$data['slocked'] = 1; 
					}else{
						$data['tlocked'] = 1; 
					}
					
					$this->class_model->updateClassAction($data,$class['id']);
					
					//send message to users when locked
					if($this->session->userdata('roleId') == 0)
					{
						$ups = 's_msg'.$class['id'];
						if(!$this->session->userdata($ups))
						{
							$dataSend['msg'] = "Your student did not show up, please beep him a note saying that you missed him today. The good news is that you still get paid!";
					    }
						$this->session->set_userdata(array($ups=>$class['id']));
					}else{
						$ups = 't_msg'.$class['id'];
						if(!$this->session->userdata($ups))
						{
							//$dataSend['msg'] = "Tutor didn't showup and go choose another wonderful tutor.";
							$dataSend['msg'] = "We are sorry your tutor did not show up. Please beep him a message or choose another wonderful tutor. Your credits will be reimbursed.";
							//exit;
					    }
						$this->session->set_userdata(array($ups=>$class['id']));
					}
					$dataSend['uid'] = $this->session->userdata('uid');
					$dataSend['classId'] = $class['id'];
					
					$this->chat_model->save($dataSend);
				}
				$i++;
			}
		}
		$returnClass['classes'] = $newClassesTemp;
		$returnClass['count'] = $s;
		echo json_encode($returnClass);
	}
	
	public function checkTutorPaymentAccount(){
		$isSet = $this->user_model->getPayPalAccount($this->user['uid']);
		$userId= $this->user['uid'];
		$payPal = array('uId' => $userId, 'uStatus' =>$isSet);
		echo json_encode($payPal);
	}
	//---R&D@Oct-09-2013 : Set Credit anount and account upgration values
	//---Set Variables for Upgrade Account
	public function _upgradeAccount() {
		$profileModel 	= $this->profile_model;
		$upgradeAccount 		= $profileModel->upgradeAccount();
		$this->layout->setData('upgradeAccount',$upgradeAccount);
	}
	//---Set Variables for Buy Credits
	public function _buyCredits() {
		$profileModel 		= $this->profile_model;
		$buyCredits 		= $profileModel->buyCredits();
		$this->layout->setData('buyCredits',$buyCredits);
	}
	//---R&D@Oct-09-2013 : Set Credit anount and account upgration values
	/**
	* @author skvirja 09 Oct 2013
	* @param continue to book now 
	**/
	public function reopenReadyToTalkSession()
	{
		//create a expiry time for this button
		$expTimeDate = date('Y-m-d H:i:s',time());
		$expTime = strtotime($expTimeDate) + 7200;
		//$expTime = strtotime($expTimeDate) + 60;
		$this->session->set_userdata(array('booknowexp'=>$expTime));
	}
	/**
	* @author skvirja 09 Oct 2013
	* @param getCurrentUTCtimeString
	**/
	public function getCurrentUTCtimeString()
	{
		$current = date('Y-m-d H:i:s',time());
		$currentTime = strtotime($current);
		$return = array('time' => $currentTime);
		echo json_encode($return);
	}
	/**
	* @author skvirja
	* @param check class
	* @date 11 Oct 2013 
	**/
	public function checkClassBookNow() {
		 
		$this->load->model(array('event_model','myTeacher_model','profile_model'));
		$tid = $this->input->_request('tid');
		$sid = $this->input->_request('sid');
		$schoolid = $this->input->_request('schoolid');
		
		//if($schoolid > 0)
		if($schoolid > 0)
		{
			$tutorProfile = $this->profile_model->getProfile($tid);
			$profile = $this->profile_model->getProfile($sid);
			$config = $this->profile_model->getConfig();
			/*
			$Alldata=array();
			$Alldata=$this->user_model->Gettmarkup($schoolid);
			$tutorProfile = $this->profile_model->getTutorRates($tid);
			$hrate = $tutorProfile['hRate'];
			//	$Alldata=number_format(round($Alldata['tutor_markup'] * (1+$config['VEE_PRICE_PERCENT']['value']) * 100) /100,2,'.',''); 
			$totalrate = $Alldata['tutor_markup'] + $hrate;
			*/

			$hrate = $tutorProfile['hRate']; 
			$markup="select tutor_markup from profile where uid={$schoolid}";
			$sql = $this->db->query($markup);
			$cresult = $sql->row_array();
			$srate=$cresult['tutor_markup'];
			
			//echo $tutorProfile['hRate'] = ($srate + $hrate) * 1.33;
			
			$costrate = ($hrate+$srate)*1.33;
			$tutorProfile['hRate']=number_format($costrate,2,'.','');
			$cost = $tutorProfile['hRate'];

			//$cost = $totalrate;
			$t_hrate = $hrate;
		}
		else
		{
			$tutorProfile = $this->profile_model->getProfile($tid);
			$profile = $this->profile_model->getProfile($sid);
			$hrate = $tutorProfile['hRate']; 
			$config = $this->profile_model->getConfig();
			$tutorProfile['hRate'] = number_format(round($tutorProfile['hRate'] * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100,2,'.','');
			$cost = $tutorProfile['hRate'];
			$t_hrate = $hrate;
		}
		
		//echo $cost;
		/*if($this->session->userdata('free_session') == 'y')
		{ $cost = 0; } else { $cost; }
		*/
		
		$q= "SELECT exp_session,is_eligible from user where  user.id='{$sid}'";
		$classquery = $this->db->query($q);				
		$classresult = $classquery->row_array();
		 $cdate=date('Y-m-d');
		if($classresult['exp_session'] > $cdate && $classresult['is_eligible']==1)
		{
			$cost=0;
		}
		else{
		}
		
		$csql = "SELECT id FROM class where sid = ".$sid;
		$cquery = $this->db->query($csql);
		$cresult = $cquery->row_array();

		$freesql = "SELECT free_session FROM profile where uid = ".$sid;
		$freequery = $this->db->query($freesql);
		$freeresult = $freequery->row_array();

		
		//if(count($cresult) = 0 AND $freeresult['free_session'] = 'Y' ){ $cost = 0; } else { $cost; }
		//if(count($cresult) == 0 AND $freeresult['free_session'] == 'Y' || $freeresult['free_session'] == 'Y'){ $cost = 0; } 
		/*if(count($cresult) == 0 AND $freeresult['free_session'] == 'y'){
			$cost = 0;
		}elseif($freeresult['free_session'] == 'y'){ 
			$cost = 0;
		}else{
			$cost;
		}*/
		
		$pmoney = explode('$',$profile['money']);
		if(is_array($pmoney)){
			if(@$pmoney[1] != ''){
				$pmoney = $pmoney[1];
			}else{
				$pmoney = $pmoney[0];
			}
		}
		//$pmoney = (int)$pmoney;
		$pmoney = $pmoney;
		
		/*echo $pmoney;
		echo $cost;*/
		if($pmoney >= $cost){
			$enough = true;
		}
		else{
			$enough = false;
		}
		//if($this->session->userdata('free_session') == 'y'){
		if($freeresult['free_session'] == 'y'){
			$enough = true;
			$firstBookNow = TRUE;
		}else{
			$firstBookNow = FALSE;
		}
		
		if($classresult['exp_session'] > $cdate && $classresult['is_eligible']==1)
		{
			$enough = true;
			$firstBookNow = TRUE;
		}else{
			//$enough = FALSE;
			$firstBookNow = FALSE;
		}

		//echo $enough;
		$start = date('Y-m-d H:i:s',time());
		$end = date('Y-m-d H:i:s',strtotime($start) + 25*60);
		//$sql = "select * from class where (startTime BETWEEN '{$start}' AND '{$end}' OR endTime BETWEEN '{$start}' AND '{$end}') AND sid = {$sid} ";
		//$sql = "select * from class where (startTime BETWEEN '{$start}' AND '{$end}' OR endTime BETWEEN '{$start}' AND '{$end}') AND sid = {$sid} AND Intent=0";
		$sql = "select * from class where (startTime BETWEEN '{$start}' AND '{$end}' OR endTime BETWEEN '{$start}' AND '{$end}') AND Intent!='2' AND (sid = {$sid} or tid ={$tid})";
		$query = $this->db->query($sql);
		$numofclasses = 0;
		$result = array();
		
		$availabletobook = true;
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$numofclasses = 1;	
			$availabletobook = false;
		}
/*if(count($result)>0){
		
			foreach($result as $rs){
				if($rs['action'] == ''){
					$numofclasses = $numofclasses + 1;
				}else{
					$actionClass = unserialize($rs['action']);
					if(@$actionClass['tutorConnected'] == 0){
						if(@$actionClass['studentConnected'] == 1){
							$numofclasses = $numofclasses + 1;
						}else{
							continue;
						}
					}else{
						$numofclasses = $numofclasses + 1;	
					}
				}
			}			
		}
		$availabletobook = true;
		if($numofclasses>0){
			$availabletobook = false;
		}*/
		// end checks for existing class
		//skvirja 31 Oct - checks for profile is complete
		$profileCompletion = true;
		if(trim($profile['country']) == '' || trim($profile['city']) == '' || trim($profile['firstName']) == '' || trim($profile['lastName']) == ''){
			$profileCompletion = false;
		}
        $this->myTeacher_model->creatMyTeacher($sid,$tid,0);
		if($firstBookNow == FALSE)
		{
		 /*$sql = "insert into disputes (`sid`,`createAt`,`tid`,`fee`,`approve`,`paymentstatus`,`postpone`,`t_hrate`,`School_id`) values ({$sid},'{$start}',{$tid},{$cost},'0','Unpaid','0','{$t_hrate}','{$schoolid}')";
		 $query = $this->db->query($sql);*/
		}
		echo json_encode( compact('cost','enough','availabletobook','profileCompletion' , 'firstBookNow') );
		exit;
	}
	/**
	* @author skvirja
	* @param logout by close
	**/
	public function logoutByBroserClose() {
		$this->session->set_userdata(array('logout'=>'Yes'));
		$uid = $this->uid;
		$this->load->model(array('search_model'));
		$userSesssions	=	array();
		$userSesssions 	= $this->session->userdata;

		$sql = "update user set is_login = 0 where id = {$uid}";
		$query = $this->db->query($sql);

		if($this->session->userdata('roleId') != 0){
			$this->search_model->removeNow($uid);
			$this->session->set_userdata(array('booknowexp' =>0));
		}
		$this->session->unset_userdata($userSesssions);
		$this->session->sess_destroy();
		$this->layout->view('user/facebook');
	}
	
	public function slogoutByBroserClose() {
		/*$this->session->set_userdata(array('logout'=>'Yes'));
		$uid = $this->uid;
		$this->load->model(array('search_model'));
		
		 $sql = "update user set is_login = 0 where id = {$uid}";
		$query = $this->db->query($sql);
		
		if($this->session->userdata('roleId') > 0){
			$this->search_model->removeNow($uid);
			$this->session->set_userdata(array('booknowexp' =>0));
		}
		//clearstatcache() ;
		$userSesssions	=	array();
		$userSesssions 	= $this->session->userdata;
		$this->session->unset_userdata($userSesssions);
		
		$this->session->sess_destroy();
		$this->layout->view('user/facebook');*/
	}
	
	public function load_send_message(){
		if(!$this->user){
			//redirect('user/login');
		}
		$data = array();
		$urluidnew = $this->input->_request('uid');
		if($this->uri->segment(4) != '' || $urluidnew != ''){
			$fsql = "SELECT u.email,p.firstName,p.lastName,u.id FROM user as u,profile as p where u.id = p.uid AND u.id = ".$this->uri->segment(4);
			$fquery = $this->db->query($fsql);
			$fresult = $fquery->row_array();
			$data['fresult'] = $fresult;
		}
		if(urldecode($this->input->_request('uid'))){
			$uidurl = urldecode($this->input->_request('uid'));
		}else{
			$uidurl = 0;
		}
		$data['uidurl'] = $uidurl;
		$this->load->view("user/send_message_load",$data);
	}
	/**
	* @author skvirja 21 Oct 2013 
	* @param count number of messages are unread for realtime 
	**/
	public function count_unread_messages_real(){/*
		$aj_uid = $lastid = $this->input->post('uid');
		$msql2 = "select inbox.id,inbox.balert,CONCAT(profile.firstName, ' ', profile.lastName) as username from inbox LEFT JOIN profile ON profile.uid = inbox.fid where toId = ".$aj_uid." AND isRead = 0 ORDER BY `id` DESC";
		$mquery2 = $this->db->query($msql2);
		$cnt = $mquery2->num_rows();
		$alert = 0;
		$username = '';
		$titleAlertIds = '';
		$balert = 0;
		if ( $cnt > 0) {
			$mresult2 = $mquery2->result_array();
			$this->load->model(array('profile_model'));
			$username = $mresult2[0]['username'];
			if(trim($username) == 'admin')
			{
				$username = 'TalkMaster BlueBob';
			}
			foreach($mresult2 as $rs)
			{
				//checks for browser alert
				if($rs['balert'] == 0){
					$balert = 1;
					$titleAlertIds = $titleAlertIds.','.$rs['id'];
				}
				$sessionBeep = 'beep'.$rs['id'];
				$s = '';
				$s = $this->session->userdata($sessionBeep);
				if($s != 'Yes'){
					$alert = 1;
					$this->session->set_userdata(array($sessionBeep=>'Yes'));
				}
			}
			
		}else{
			$mresult2 = '';
		}
		if($titleAlertIds != ''){
			$titleAlertIds = substr($titleAlertIds,1,strlen($titleAlertIds));
		}
		$result['ids'] = $mresult2;
		$returnArray['status'] = 'success';
		$returnArray['numMessages'] = $cnt;
		$returnArray['alert'] = $alert;
		$returnArray['username'] = $username;
		$returnArray['titleAlertIds'] = $titleAlertIds;
		$returnArray['balert'] = $balert;
		echo json_encode($returnArray);*/
		//echo json_encode(array('status'=>'success','numMessages'=>$cnt,'alert'=>$alert,'username'=>$username));
	}
	/**
	* @author skvirja 21 Oct 2013 
	* @param get messages are unread for realtime 
	**/
	public function get_unread_messages_real(){
		$lastid = $this->input->post('lastid');
		$aj_uid = $this->input->post('uid');
		$this->load->model(array('inbox_model'));
		$page = $this->input->post('page');
		if(!$page){
			$page = 1;
		}
		if($page == 'uid'){$page = 1;}
		$rs = $this->inbox_model->getResultUnread($aj_uid,$lastid,$page);
		$row = '';
		if(count($rs)>0){
			foreach($rs as $result)
			{
				$row .= '<tr class="read'.$result['isRead'].'" inboxId="'.$result['id'].'">';
				$row .= '<td><input type="checkbox" value="'.$result["id"].'" class="ids"></td>';	
				if($result['isRead']){ 
					$st =  "style='color:#000000;'"; 
				}else{ 
					$st = "style='color:#000000;font-weight:bold;'"; 
				}
				$viewMsgUrl = base_url('user/view_message/id/'.$result['id']);
				$row .= '<td><a href="'.$viewMsgUrl.'" '.$st.'>'.$result['subject'].'</a></td>';	
				$row .= '<td>';
				if($result['fId'] == 1){
					$row .= 'TalkMaster BlueBob';
				}else{
					$profileUrl = base_url('user/profile/uid/'.$result['fId']);
					$row .= '<a href="'.$profileUrl.'" '.$st.'>'.$result['username'].'</a>';
				}
				$row .= '</td>';
				$dateMsg = date( 'M d, Y | h:i a ' , $this->inbox_model->outTime($result['createAt']) );

				if($result['attach'] !='')
				{
					$row.='<td >';
					$id=$result['id'];
					$row.='<img style="width:14px;cursor:pointer" onclick="download('.$id.')" src="'.base_url('images/clip.png').'" />';
					$row.='</td>';
				}
				else				
				{
					$row.='<td >'; $row.='</td>';
				}

				$row .= '<td><div '.$st.'>'.$dateMsg.'</div></td>';
				$row .= '</tr>';
									
			}
		}
		echo json_encode(array('status'=>'success','row'=>$row));
	}
	/**
	* @author skvirja 23 Oct 2013
	* @param update alerted ids of beepbox
	**/
	public function updateTitleAlertIds(){
		$titleAlertIds = $this->input->post('titleAlertIds');
		$aj_uid = $this->input->post('uid');
		if($titleAlertIds != ''){
			$alertIds = explode(',',$titleAlertIds);
			foreach($alertIds as $inbId){
				$sql = "UPDATE inbox set balert = 1 WHERE id = '{$inbId}' ";
				$query = $this->db->query($sql);
			}
		}
	}
	/**
	* @author skvirja 31 Oct 2013
	* @param checks for profile is complete
	**/
	public function checkProfileIsComplete(){
		$uid = $this->uid;
		$profile = $this->profile_model->getProfile($uid);
		$profileCompletion = true;
		if(trim($profile['country']) == '' || trim($profile['city']) == '' || trim($profile['firstName']) == '' || trim($profile['lastName']) == ''){
			$profileCompletion = false;
		}
		echo  json_encode( compact('profileCompletion') );
		exit;
	}
	// Upgrade Account From Student to Tutor
	public function upgradeaccount() 
	{
		$this->layout->setData('upgradeaccount','1');
		$profile = $this->profile_model->getProfile($this->uid);
		if(trim($profile['country']) == '' or trim($profile['city']) == '' or trim($profile['firstName']) == '' or trim($profile['lastName']) == ''){
			$this->registeredit();
		} else {
			$redirect = Base_url('user/profile?chng=br');
			return false;
		}
	}
	/**
	* @author skvirja 31 Oct 2013
	* @param edit profile view call
	**/
	public function registeredit() 
	{
		$this->layout->setLayoutData('linkAttr','registeredit');
		$userModel =  $this->user_model;
		$profileModel = $this->profile_model;
		$uid = $this->uid;

		$islogin = $userModel->islogin();
		if(!$islogin) {
			redirect('user/login');
		}
		$profile = $this->profile_model->getProfile($uid);
		$userInfo = $this->user_model->getUserEmail($uid);		
		$get = $this->input->post();
		$errorMsg = array();
		$this->config->load('timezones',true);
		$timezones = $this->config->item('timezones','timezones');
		$this->load->model(array('location_model','langs_model'));
		$countries= $this->location_model->getCountries();
		$langs= $this->langs_model->getLangs();
		$outputVar = compact('countries','errorMsg','timezones','langs','get','profile','userInfo');
	  
		$this->load->helper('form');
		$this->load->helper('date');
		$this->layout->view('user/registeredit',$outputVar);
		
	}
	
	public function registereditDo()
	{
		$this->load->library('Mobile_Detect');
		$post = $this->input->post();
		$post['cell']=preg_replace("/[^0-9]/", '', $post['cell']);
		$post['cell']=$post['areacode'].'-'.$post['cell'];
		$post['nativeLanguage']='English';
		/* Added By Ilyas */
		$upgradeAct = 0;
		if ($this->session->userdata('roleId') == 1 and $post['upgradeaccount']=='1') {
			$post['universal_roleId'] = 1;
			$upgradeAct = 1;
		}
		$this->user_model->fnUpdateUser(array('universal_roleId'=>$post['universal_roleId'],'roleId'=>$post['universal_roleId']),array('id'=>$this->session->userdata('uid')));
		$this->session->set_userdata(array('roleId'=>$post['universal_roleId']));
		/* End */
		
		if($this->session->userdata('roleId') == 0){
			unset($post['hRate']);
			unset($post['undefined']);
			unset($post['cell']);
			unset($post['email']);
			unset($post['roleId']);
			unset($post['universal_roleId']);
			unset($post['localTimeZone']);
			unset($post['areacode']);
			unset($post['disareacode']);
			unset($post['upgradeaccount']);
		}else{
			unset($post['areacode']);
			unset($post['undefined']);
			unset($post['email']);
			unset($post['roleId']);
			unset($post['universal_roleId']);
			unset($post['localTimeZone']);
			unset($post['disareacode']);
			unset($post['upgradeaccount']);
		}
		
		if($this->session->userdata('roleId') == 1){
		
			$hrole =$this->session->userdata('uid');
			$this->profile_model->setHidden($hrole);
		
		}

		$redirect = $post['httpref'];

		unset($post['httpref']);
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? 'phone' : 'computer');
		if($this->session->userdata('roleId') == 0)
		{
			if ($deviceType == "phone") {
				$redirect=Base_url("user/dashboard");
			} else {
				//$redirect=Base_url("user/studentPopup");
				$this->session->set_userdata('registermsg',"1");
				if(strstr($redirect,"step=final"))
				{
					$redirect=Base_url("user/dashboard");
				} else {
				$redirect = $redirect;
				}
			}
		}
		else if($this->session->userdata('roleId') == 4)
		{
			$redirect=Base_url("user/organization");
		}
		else if($this->session->userdata('roleId') == 5)
		{
			$redirect=Base_url("user/account");
		}
		else
		{
			if ($deviceType == "phone") {
				$redirect=Base_url("user/dashboard");
			} else {
				if ($upgradeAct == 1) {
					$redirect = Base_url('user/profile?chng=br');
				} else if($upgradeAct != 1 and $this->session->userdata('roleId') == 1) {
					$redirect = $redirect;
				} else{
					$redirect=Base_url("user/tutorPopup");
				}
			}
		}

		$post['uid'] = $this->session->userdata('uid');
		$this->profile_model->update($post);
		$profile = $this->db->query("SELECT uid,Lat,Lng,countries.country ,provices.provice ,city FROM profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id where user.id=".$post['uid']);		
		$profile->result_array();
		$profile_res = $profile->result_array();
		$address = '';
		if($profile_res[0]['city'] != ''){
			$address = $address.$profile_res[0]['city'].' ';
		}
		if($profile_res[0]['provice'] != ''){
			$address = $address.$profile_res[0]['provice'].' ';
		}
		if($profile_res[0]['country'] != ''){
			$address = $address.$profile_res[0]['country'];
		}
		if($address != ''){
			$this->getLatLong($post['uid'],$address);
		}
		echo json_encode(array('success'=>true,'redirect'=>$redirect));
	}
	
	public function studentregister()
	{
		$this->load->model(array('class_model','location_model','ad_model','dashboardmessages_model','dchatmodel'));
		$userModel = $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin)
		{
			redirect('user/login');
		}
		
		$criteria = $this->profile_model->getcriteriasearch($this->uid);
		$this->layout->setData('criteria',$criteria);
		$this->layout->view("user/studentregister");
	}
// added by haren for organization private view
	public function organization()
	{
		 
		$userModel = $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin)
		{
			redirect('user/login');
		}
		$this->_profile();
		$this->load->model(array('class_model','location_model','ad_model','dashboardmessages_model','dchatmodel'));
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
		$tmessages= $this->dashboardmessages_model->getAllMessages('active');
		if($tmessages)
			$this->layout->setData('tmessages',$tmessages);
		$numberofstudents = $this->user_model->getNumberofstudents();
     	$this->layout->setData('numberofstudents',$numberofstudents);
		$top8Country = $this->user_model->getTop8Country();
		$this->layout->setData('top8Country',$top8Country);
		// get user groups
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
		switch($permisson) 
		{
			case 'invalidUser':break;
			case 'student_private':$classes = $this->class_model->getNextSession($this->uid,$lSid);break;
			case 'teacher_private':$classes = $this->class_model->getNextSession($this->uid,$lTid);break;
			case 'studdent_public':break;

		}
	    $tutor=$this->user_model->GetSchoolEarning($this->uid,$page);
		//echo "<pre>"; print_r($tutor);die;
		$msql2 = "select count(id) as number2 from inbox where toId = ".$this->uid." AND isRead = 0";
		$mquery2 = $this->db->query($msql2);
		$mresult2 = $mquery2->result_array();
		$completedSessions = $this->class_model->SchoolSession($this->uid);
		$completedSessions = $completedSessions['cnt'];
		
		$this->layout->setData('tutor',$tutor);
		
		$this->layout->setData('completedSessions',$completedSessions);
		$this->layout->setData('msgcnt',$mresult2[0]['number2']);
		$this->layout->setData('classes',$classes);
		$cnt="select count(id) as cnt from profile where school_id={$this->uid}";
		$qry = $this->db->query($cnt);
		$rs = $qry->result_array();
		$this->layout->setData('cnt',$rs);
		$this->load->helper('date');
		$this->layout->view("user/dashboard/organization_private");
	}
	public function tutorsearch()
	{
		$this->_profile();
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin)
		{
			redirect('user/login');
		}
		$this->load->model(array('user_model','profile_model','langs_model'));
		$criteria = $this->profile_model->getcriteriasearch($this->uid);
		$this->layout->setData('criteria',$criteria);
		$this->layout->view("user/tutorsearch");
	}
	
	public function dict()
	{
	//$this->layout->view("user/dict");
	$this->load->library('mpdf/mpdf');                
        $mpdf=new mPDF();
		 $demo =  "<table width = 100% border = '0' cellspacing = '2' cellpadding = '0'>";
$demo .="<td><a href='memberindex.php'></td> ";  
$demo .="</tr> "; 

        $mpdf->WriteHTML($demo); 
        $mpdf->Output();
	}
	public function load_send_message_schedule(){
		if(!$this->user){
			redirect('user/login');
		}
		$data = array();
		$urluidnew = $this->input->_request('uid');
		$st = $this->input->_request('a');
		
		if($this->uri->segment(4) != '' || $urluidnew != ''){
			$fsql = "SELECT u.email,p.firstName,p.lastName,u.id FROM user as u,profile as p where u.id = p.uid AND u.id = ".$this->uri->segment(4);
			$fquery = $this->db->query($fsql);
			$fresult = $fquery->row_array();
			$data['fresult'] = $fresult;
		}
		if(urldecode($this->input->_request('uid'))){
			$uidurl = urldecode($this->input->_request('uid'));
		}else{
			$uidurl = 0;
		}
		$data['uidurl'] = $uidurl;
		$data['st'] = $st;
	 
		$this->load->view("user/send_message_load_schedule",$data);
	}
	
	public function addSlotTimebyst(){
		//$permisson = $this->getPermission($this->uid);
		$success = 'false';
		$msg = strtotime(time());
		//if($permisson !='teacher_private'){
			//$success = 'false';
			//$msg = 'You do not have permisson!';
		//}
		//else {
			$this->load->model('event_model');
			
		 	$day = $this->input->_request('day');
			$times = $this->input->_request('seletedSlot');
			$tid = $this->input->_request('tid');
			$sid = $this->input->_request('sid');
			$stopic = $this->input->_request('sTopic');
			$slevel = $this->input->_request('sLevel');
			$schoolId=$this->input->_request('schoolId');
			$times = $this->event_model->checkSlotTimest($day,$times,$sid);
			foreach ($times as $key => $value) {
				//$msg .= $value .'__';
				$msg = $value;
				$start_time =$this->event_model->creatTimeSlotst($value,0,$tid,$sid,$stopic,$slevel,$schoolId);
			}
			
			$success = true;
			
			if($success == true)
			{
				$this->session->set_userdata('free_session', 'n');
				$this->session->set_userdata('firstTime', 'n');
			}
		//}
		echo json_encode(compact('success','msg','firsttime','start_time'));

	}
	
	public function getconfirm()
	{
	$id = $this->input->_request('id');
	$uid = $this->session->userdata('uid');
	$this->load->model('event_model');
	$data = $this->event_model->getdata($id);
	echo json_encode($data);exit();
	}
	
	 public function buyClassesbytutor()
	 {
	   	$sid = $this->input->_request('sid');
		$this->load->model(array('event_model','myTeacher_model','profile_model'));
		$times = $this->input->_request('seletedSlot');
		
		
			if($times == '')
			{
				$times = array();
			}
		$tutorProfile = $this->profile_model->getProfile($this->uid);
		
		
		$schoolInfo = $tutorProfile['school_id'];
		
		$profile = $this->profile_model->getProfile($sid);
		$config = $this->profile_model->getConfig();
		
		$schoolId = $this->input->_request('school_id');
		$tutorProfile['t_hRate'] = $tutorProfile['hRate'];
		if($schoolId > 0 && $schoolId !='')
		{
				$tutor_markup=$this->profile_model->GetSchoolMarkup($schoolId);
				$markup=$tutor_markup[0]['tutor_markup'];
				
				$total=$tutorProfile['hRate']+$markup;
				//$total+=$total*33/100;
				$tutorProfile['hRate']=($total)*(1+33/100);
				//($resultTeacher[$i]['hRate']+$result[0]['tutor_markup'])*(1+33/100);
				$tutorProfile['hRate']=number_format($tutorProfile['hRate'],2,'.','');
		}
		else
		{
		$tutorProfile['hRate'] = round($tutorProfile['hRate'] * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
		}
		if($profile['money'] < count($times) * $tutorProfile['hRate'])
			{
			 
			  	$success = false;
				$msg = "You do not have enough money.";
				$firsttime = $this->event_model->isFirstTimeStudent($sid);
				 if($profile['new'] == '1' || $this->session->userdata('free_session') == 'y')
				   {
				     
					$success = true;
					$msg = "";
					$tutorProfile['hRate'] = 0;
					
					foreach ($times as $key => $value)
					{
					//$this->event_model->creatClassbytutor($times,0,$sid,$this->uid,$tutorProfile['hRate']);
                    $this->event_model->creatClassbytutor($value,0,$sid,$this->uid,$tutorProfile['hRate'],$tutorProfile['t_hRate']);
					}
					$this->event_model->creatClassbytutor($times,0,$sid,$this->uid,$tutorProfile['hRate'],$tutorProfile['t_hRate']);
					$success = true;
					
				    }
				 
				
			}
			else
			{
			
				$this->event_model->creatClassbytutor($times,0,$sid,$this->uid,$tutorProfile['hRate'],$tutorProfile['t_hRate']);
				$success = true;
			}
				// TECHNO-SANJAY added below code for update user free session status
		if($success == true)
		{
			$this->session->set_userdata('free_session', 'n');
			$this->session->set_userdata('firstTime', 'n');
		}
		$this->session->set_userdata('sessionbooked', 'y');
		echo json_encode(compact('success','msg','firsttime'));
       }
	
		public function message_send_schedule_request()
		{
			$this->load->model(array('inbox_model','user_model','event_model'));
			$toUid = $this->input->_request('uidurl');
			$subject = $this->input->_request('subject');
			$message = $this->input->_request('message');
			$sTopic = $this->input->_request('sTopic');
			$sLevel = $this->input->_request('sLevel');
			$eventdat = $this->input->_request('eventdat');
			$eventtime = $this->input->_request('eventtime');

			$getemail = $this->user_model->getByUid($toUid);
			
			$time = strtotime($eventtime);
			$dt = date('Y-m-d H:i:s',$time);
			$teacherTimezone = $this->user_model->getLastLocalTimeZone($toUid);
			$session_time = $this->event_model->utc_to_local('g:i A, Y-m-d',$dt,$teacherTimezone);

			if($tutotTimezone == 'America/Boise'){
				$oldTime 			= time($session_time);
				$timeAfterOneHour 	= $oldTime-60*60*6.0;
				$session_time = date("g:i A, Y-m-d",$timeAfterOneHour);
			}else{
				$session_time = $this->event_model->utc_to_local('g:i A, Y-m-d',$dt,$teacherTimezone);
			}
			
			$sender_name = $this->user_model->getsendername($this->user['uid']);
			$extmsg ="for a Vee-session. ".ucfirst($sender_name['firstName'])." is a ".$sLevel." speaker and wants to talk about ".$sTopic.". Go to your calendar and click Confirm  for this session. Else you should message them to coordinate another time.";
		   
			$message = "is requesting ".$session_time." ";
		   
			$message = ucfirst($sender_name['firstName']).' ' .$sender_name['lastName'].' '. $message . $extmsg ;
			$send = $this->inbox_model->send($toUid,$this->user['uid'],$subject,$message);
			$inbid = $message;
		   $fromName ='TalkMaster BlueBob'; 
			$str = 'TalkMaster BlueBob sends this message to you from TheTalkList:<br/><br/>';
			$str .= $message;
			$this->load->library('email');
			$this->email->mailtype = 'html';
			$this->email->from('no-reply@thetalklist.com',$fromName);
			$this->email->to($getemail['email']);
			$this->email->subject($subject);
			$this->email->message($str);
			$this->email->send();
			echo json_encode(array('status'=>$send,'msg'=>'Schedule request sent successfully'));
			return;
		}
		/*public function message_send_schedule_request()
		{
		   $this->load->model(array('inbox_model',user_model,event_model));
		   $toUid = $this->input->_request('uidurl');
		   $subject = $this->input->_request('subject');
		   $message = $this->input->_request('message');
		   $sTopic = $this->input->_request('sTopic');
		   $sLevel = $this->input->_request('sLevel');
		    $eventdat = $this->input->_request('eventdat');
			$eventtime = $this->input->_request('eventtime');
			$getemail = $this->user_model->getByUid($toUid);
			$gettutorname    =  $this->user_model->getByprofileUid($toUid);
			//$start = date('Y-m-d H:i:s',time() + 5*60);
			//$tutotTimezone = $this->user_model->getLastLocalTimeZone($toUid);
           // $dateInLocal = $this->event_model->utc_to_local('h:i a',$start,$tutotTimezone);
		$time = strtotime($eventtime);
   $dt = date('Y-m-d H:i:s',$time);
   $teacherTimezone = $this->user_model->getLastLocalTimeZone($toUid);
   $session_time = $this->utc_to_local1('g:i A, Y-m-d',$dt,$teacherTimezone);
		if($tutotTimezone == 'America/Boise'){
			$oldTime 			= time($session_time);
			$timeAfterOneHour 	= $oldTime-60*60*6.0;
			$session_time = date("h:i a",$timeAfterOneHour);
		}else{
			$session_time = $this->utc_to_local1('g:i A, Y-m-d',$dt,$teacherTimezone);
		}
			 $sender_name = $this->user_model->getsendername($this->user['uid']);
		   $extmsg ="for a Vee-session. ".ucfirst($sender_name['firstName'])." is a ".$sLevel." speaker and wants to talk about ".$sTopic.". Go to your calendar and click Confirm  for this session. Else you should message them to coordinate another time.";
		   
		  $message = "is requesting ".$session_time." ";
		   
		   $message = ucfirst($sender_name['firstName']).' ' .$sender_name['lastName'].' '. $message . $extmsg ;
		   $send = $this->inbox_model->send($toUid,$this->user['uid'],$subject,$message);
		     $send = $this->inbox_model->send($this->user['uid'],$this->user['uid'],$subject,"You requested a session on ".$session_time." with ".$gettutorname['firstName']." .  Please wait for an email confirmation from this tutor.");
		   $inbid = $message;
		   
			//--R&D@Sept-18-2013 : SEND EMAIL FOR BEEP MESSAGE
			$fromName ='TalkMaster BlueBob'; 
			$str = 'TalkMaster BlueBob sends this message to you from TheTalkList:<br/><br/>';
			$str .= $message;
			$this->load->library('email');
			$this->email->mailtype = 'html';
			$this->email->from('no-reply@thetalklist.com',$fromName);
			$this->email->to($getemail['email']);
			$this->email->subject($subject);
			$this->email->message($str);
			$this->email->send();
			echo json_encode(array('status'=>$send,'msg'=>'Schedule request sent successfully'));
			return;
		}*/
		public function message_send_cancel_class($cid)
		{
			$this->load->model(array('inbox_model','class_model','deepboxmessage_model'));
			$toUid = $this->getsid($cid);
			//print_r($toUid);
			
			$Uidexpdate = $this->getsidexpdate($toUid[0]['sid']);

			$sender_name = $this->user_model->getsendername($this->user['uid']);		
		
			$currentDate = date("Y-m-d");// current date
			if($Uidexpdate[0][exp_session]> $currentDate)
			{
				$new_date =date('Y-m-d', strtotime($currentDate. ' + 7 days'));
				$this->updatesidexpdate($toUid[0]['sid'],$new_date);
				$subject="Free Session cancelled";
				$msg = "We are sorry that your first Free Session was cancelled.  We are extending your Free Session Coupon for another 7 days so you can find another wonderful tutor.";
			}
			else
			{
				$time = strtotime($toUid[0]['startTime']);
				$dt = date('Y-m-d H:i:s',$time);

				$studentTimezone = $this->user_model->getLastLocalTimeZone($toUid[0]['sid']);
				$student_session_time = $this->class_model->utc_to_local1('g:i A, Y-m-d',$dt,$studentTimezone);

				$datarray = array("datetime"=>$toUid[0]['startTime'],"tutorname"=>$sender_name['firstName'],"studentid"=>$this->user['uid']);
				$studentcontentdata = $this->deepboxmessage_model->cancel_session($datarray);
				
				$subject="Session cancelled";
				$msg = "We are sorry but ".$sender_name['firstName']."".$sender_name['uid']." had to cancel your Vee-session at ".$student_session_time.". Please reschedule.";
			}
			//$TutMsg="We are sorry but ".$sender_name['firstName']." had to cancel Vee-session at ".date('Y-m-d h:i a', strtotime($toUid[0]['startTime'])).".";
			
			$time = strtotime($toUid[0]['startTime']);
			$dt = date('Y-m-d H:i:s',$time);
			$tutorTimezone = $this->user_model->getLastLocalTimeZone($toUid[0]['tid']);
			$tutor_session_time = $this->class_model->utc_to_local1('g:i A, Y-m-d',$dt,$tutorTimezone);
			//exit;	
			$TutMsg="We are sorry but ".$sender_name['firstName']." had to cancel your Vee-session at ".$tutor_session_time.".";
			
			$subjectTut="Session cancelled";
			$send = $this->inbox_model->send($toUid[0]['sid'],$this->user['uid'],$subject,$msg);
			$send = $this->inbox_model->send($toUid[0]['tid'],$this->user['uid'],$subjectTut,$TutMsg);
		   // $send = $this->inbox_model->send($this->user['uid'],$toUid[0]['sid'],$subject,$msg);
		}
		
		public function getsid($classid)
		{
	  	$sql = "SELECT * FROM class  WHERE id={$classid} ";
		$query = $this->db->query($sql);
		 if ($query->num_rows() > 0) 
		  {
			$result = $query->result_array();
		  }
		return $result;
		}
		
		public function getsidexpdate($uid)
		{
	  	$sql = "SELECT * FROM user  WHERE id={$uid} ";
		$query = $this->db->query($sql);
		 if ($query->num_rows() > 0)
		 {
			$result = $query->result_array();
		 }
		 return $result;
		}
		
		public function updatesidexpdate($uid,$nd)
		{
		//`startTime` <='{$start}'
		$sql1 = "UPDATE  user SET `exp_session` = '{$nd}',free_session='y' where id = {$uid}";
		$query1 = $this->db->query($sql1);
		$sql2 = "UPDATE  profile SET  free_session='y' where uid = {$uid}";
		$query2 = $this->db->query($sql2);
		}
		
	public function message_send_confirm_request()
	{
		$this->load->model(array('inbox_model'));
		$toUid = $this->input->_request('uidurl');
		$subject = $this->input->_request('subject');
		$message = $this->input->_request('message');
		$sender_name = $this->user_model->getsendername($this->user['uid']);
		$message = $sender_name['firstName'].' ' .$sender_name['lastName'].'   '. $message ;

		$eventtime = $this->input->_request('eventtime');
		///////////  tutor local time in message functionality ///////
		$time = strtotime($eventtime);
		$dt = date('Y-m-d H:i:s',$time);
		$studentTimezone = $this->user_model->getLastLocalTimeZone($toUid);
		$session_time = $this->utc_to_local1('g:i A, Y-m-d',$dt,$studentTimezone);
		if($tutotTimezone == 'America/Boise'){
			$oldTime 			= time($session_time);
			$timeAfterOneHour 	= $oldTime-60*60*6.0;
			$session_time = date("h:i a",$timeAfterOneHour);
		}else{
			$session_time = $this->utc_to_local1('g:i A, Y-m-d',$dt,$studentTimezone);
		}
		///////////  tutor local time in message functionality ///////
		$name = $this->user_model->getsendername($this->user['uid']);
	   
		$message = 'confirmed your Vee-session request for'.$session_time.'.Have fun';
        $message = $sender_name['firstName'].' ' .$sender_name['lastName'].'   '. $message ;
		$send = $this->inbox_model->send($toUid,$this->user['uid'],$subject,$message);
		//$send = $this->inbox_model->send($this->user['uid'],$toUid,$subject,$message);
		$inbid = $message;
		//--R&D@Sept-18-2013 : SEND EMAIL FOR BEEP MESSAGE
		$fromName ='TalkMaster BlueBob'; 
		$str = 'TalkMaster BlueBob sends this message to you from TheTalkList:<br/><br/>';
		$str .= $message;
		$this->load->library('email');
		$this->email->mailtype = 'html';
		$this->email->from('no-reply@thetalklist.com',$fromName);
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($str);
		$this->email->send();
		echo json_encode(array('status'=>$send,'msg'=>'Schedule request confirm sent successfully'));
		return;
	}
	
	public function autotutor(){
		$sql = "select date from login_history where uid = ".$this->uid." ORDER BY id DESC Limit 1";
		$query = $this->db->query($sql);

		$result = $query->result_array();
		$idate = $result[0]['date'];		
		$effectiveDate = strtotime("+240 minutes", strtotime($idate));
		$logouttime = date("Y-m-d h:i:s",$effectiveDate);
		$currenttime = date('Y-m-d h:i:s');
		echo strtotime($currenttime);
		echo "<br>";
		echo $effectiveDate;
		if($effectiveDate < strtotime($currenttime)){
			$this->logout;
		}
	}
		/* change organization account information added by haren */
	
	public function myInfo()
	{
		if(!$this->user)
		{
			redirect('user/login');
		}
		$this->load->helper('form');
		$langs= $this->langs_model->getLangs();
		$this->_profile();
		$permission = $this->getPermission($this->user['uid']);
		$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
		$this->layout->setData('linkType',$type);
		if($data =$this->input->post())
		{
			$error 			= false;
			$user 			= $this->user_model->getByUid($this->user['uid']);
			$_data['uid'] 	= $this->user['uid'] ;

			if($data['profile_tab'] == 'col1')
			{
					if(isset($data['name'])   && $data['name'] != "")
					{
						$fullName = $data['name'];
						$fullNameArray = explode(' ', $data['name']);
						if($fullNameArray[0] != "")
						{
							$_data['firstName'] = $fullNameArray[0];
							$this->profile_model->update($_data);
						}
						if($fullNameArray[1] != "")
						{
							$_data['lastName'] = $fullNameArray[1];
							$this->profile_model->update($_data);
						}
					}
				
					//--FOR PERSONAL INFO
					$_data['age'] 			= $data['age'];
					$_data['gender'] 		= $data['gender'];
					$_data['address'] 		= $data['address'];
					$_data['city'] 			= $data['city'];
					if(is_numeric($data['province']))
					{
					$_data['province'] 		= $data['province'];
					}
					$_data['country'] 		= $data['country'];
					//$_data['principle_name'] = $data['principle_name'];

					$this->profile_model->update($_data);
					redirect('user/myInfo');
			}
			elseif($data['profile_tab'] == 'col2')
			{
				//--FOR ACCOUNT INFO
				if($data['new_password']	!=	"")
				{
				//--Check for current password
					if($data['new_password'] == '')
					{
						//$this->layout->setData('error',$error['message']);
					}
					elseif($data['new_password'] != ''	&& $data['new_password']	!= $data['new_password2'])
					{
					
					}
					else
					{
						$_data['password'] = $data['new_password'];
					}
					$this->user_model->changePassword($_data['uid'] , $_data['password']);
				}
				if($data['cell_number']	!=	"")
				{
					$_data['cell'] 			= $data['cell_number'];
					$this->profile_model->update($_data);
				}
				
				redirect('user/myInfo');
			}
			elseif($data['profile_tab'] == 'col3')
			{
				if($data['payment_account']	!=	"")
				{
					$_data['payment_account'] 			= $data['payment_account'];
					$this->profile_model->update($_data);
				}
				//--FOR CONTACT INFO
				if($data['email']	!=	"")
				{
					$_data['email'] 			= $data['email'];
					$this->profile_model->update($_data);
				}
				if($data['cell']	!=	"")
				{
					$_data['cell'] 			= $data['cell'];
					$this->profile_model->update($_data);
				}
				if($data['tutor_markup']	!=	"")
				{
					$_data['tutor_markup'] = $data['tutor_markup'];
					
					$_data['tutor_markup']= str_replace('$', "", $_data['tutor_markup']);
					//echo $_data['tutor_markup'];
					//die();
					$this->profile_model->update($_data);
				}
				if($data['principle_name'] !=	""){
					$_data['principle_name'] = $data['principle_name'];
					$this->profile_model->update($_data);
				}
				
				redirect('user/myInfo');
				
			}
			
			elseif($data['profile_tab'] == 'col5')
			{
				if($data['s_disc']	!=	"")
				{
					$_data['s_disc'] = $data['s_disc'];
					$this->profile_model->update($_data);
				}
				
				
				redirect('user/myInfo');
				
			}
			
		}
		$user = $this->user_model->getByUid($this->user['uid']);
		if($this->input->post('profile_tab'))
		{
			$currentTab = $this->input->post('profile_tab');
		}
		else
		{
			$currentTab = 'col1';
		}
		//make link//
		$tid=$this->user['uid'];
		$profileModel = $this->profile_model;
		$pr = $profileModel->getProfile($tid);
 
		$fn = $pr['firstName'];
		$this->session->set_userdata('schoolfn',$fn);
		/*if($pr['payment_account'] != '')
		{*/
		
		$encode =$this->user_model->encode($this->session->userdata['uid'],"This is a key"); 
		$this->layout->setData('encode',base_url().'sc/'.$fn.'.'.$encode);
		//}
		//make link///
		$this->layout->setData('currentTab',$currentTab);
		$this->layout->setData('langs',$langs);
		$this->layout->setData('email',$user['email']);
		
		$this->layout->setData('roleid',$user['roleId']);
		$this->layout->view('user/orginfo');
	}
	
	// organization register haren 
	
	public function orgregister()
	{
		if($this->input->post()) 
		{
		 
			$userModel =  $this->user_model;
			$profileModel = $this->profile_model;
			$formData = $this->input->post();
			$_SESSION['isRegError'] = TRUE;
			$_SESSION['regError']   = $errorMsg;
			$errorMsg ='';
			$formData['timezone'] = $this->config->item('local_timezone');
			$formData['free_session'] = 'n';
			$uid = $userModel->register($formData);
		//insert to  the profile table
			if($uid) 
			{
				$formData['uid'] = $uid;
				$formData['new'] = 1;
				//default setting for message box
				$formData['alerts'] = 30;
				$formData['textalert'] = 30;
				$formData['alertType'] = '11';
				if($formData['roleId']  == 1)
				{
					$formData['hRate'] = '3.76';
				}
				$profileModel->save($formData);
				$uinfo = array(
					'username'=>$formData['email'],
					//'welcomeuser'=>$formData['firstName']." ".$formData['lastName'] ,
					'welcomeuser'=>$formData['firstName'] ,
					'email'=>$formData['email'],
					'uid'=>$formData['uid'],
					'roleId'=>$formData['roleId'],
					'firstTime'=>'y',
					'free_session'=> 'y',
					'ancode'=> 'y',
					'new'=>'1'
				);
				$this->session->set_userdata($uinfo);
				$profile = $this->db->query("SELECT uid,firstName,lastName,hRate,pic,Lat,Lng,user.username,countries.country ,provices.provice ,city FROM profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id where user.id=".$uid);		
				$profile->result_array();
				$profile_res = $profile->result_array();
				$address = '';
				if($profile_res[0]['city'] != '')
				{
					$address = $address.$profile_res[0]['city'].' ';
				}
				if($profile_res[0]['provice'] != '')
				{
					$address = $address.$profile_res[0]['provice'].' ';
				}
				if($profile_res[0]['country'] != '')
				{
					$address = $address.$profile_res[0]['country'];
				}
				if($formData['roleId'] == 4)
				{
					$str = "<b>Welcome to TheTalkList.com, your social e-learning network!</b>   We have worked hard at building the best 1 to 1 learning environment.  Teaching a language will be more convenient than ever.  \r\n<br/>";
					$str .= "\r\n<br/>";
					$str .= "Tips for organization: \r\n<br/>";
					$str .= "<ul>";
					$str .= "<li> .</li>";
					$str .= "<li>Add any tutor to your organization .</li>";
					$str .= "<li>Add any student to organization</li>";
					$str .= "</ul>";
				}

					if($formData['roleId'] == 5)
				{
					$str = "<b>Welcome to TheTalkList.com, your social e-learning network!</b>   We have worked hard at building the best 1 to 1 learning environment.  Teaching a language will be more convenient than ever.  \r\n<br/>";
					$str .= "\r\n<br/>";
					/*$str .= "Tips for organization: \r\n<br/>";
					$str .= "<ul>";
					$str .= "<li> .</li>";
					$str .= "<li>Add any tutor to your organization .</li>";
					$str .= "<li>Add any student to organization</li>";
					$str .= "</ul>";*/
				}

						$str .= "\r\n<br/>";
						$str .= "Your login information:\r\n<br/>";
						$str .= "Email: {$formData['email']}\r\n<br/>";
						$str .= "Password: {$formData['password']}\r\n<br/>";
						$str .= "\r\n<br/>";
						$str .= "If you have any problems please email the support team at: <a href='mailto:support@thetalklist.com'>support@thetalklist.com</a>\r\n<br/>";
						$str .= "Thank you,\r\n<br/>";
						$str .= "TheTalkList Support Team";
						$this->load->library('email');
						$this->email->mailtype = 'html';
						$this->email->from('admin@thetalklist.com','TheTalklist');
						$this->email->to($formData['email']);
						$this->email->subject('Sign-Up with TheTalkList.com by '.$formData['firstName']);
						$this->email->message($str);
						$this->email->send();
						// End email function code
					
					if($formData['roleId'] == 5)
					{
						echo json_encode(array('success'=>true,'redirect'=>Base_url('user/Affiliate')));
						die();
					}
					else
					{
						echo json_encode(array('success'=>true,'redirect'=>Base_url('user/organization')));
						die();
					}
				}
				else
				{
					echo json_encode(array('success'=>false,'message'=>'Something wrong ,Please contact to admin please!'));
					die();
				}
		}
		else 
		{
			echo json_encode(array('success'=>false,'message'=>'Not corect!'));
			die();
		}
	}
		// tutor search added by haren
	public function tsearch()
	{
		$this->load->model('user_model');
		$this->_profile();
		$permission = $this->getPermission($this->user['uid']);
		
		$getpayaccountsql = "Select payment_account from profile where uid=".$this->user['uid'];
		
		$getpayaccountquery = $this->db->query($getpayaccountsql);
		$getpayaccountresult = $getpayaccountquery->result_array();
		$payment_account_rec = $getpayaccountresult[0]['payment_account'];

		$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
		$this->layout->setData('linkType',$type);
		$this->layout->setData('payment_account_rec',$payment_account_rec);
		$this->layout->view('user/AllTutor');
	}
	// add tutor to organization
	public function addTutor()
	{
		$uid=$this->input->post('uid');
		$school_id=$this->session->userdata['uid'];
		$oname=$this->session->userdata['welcomeuser'];
		$fromName ='TalkMaster BlueBob';
		$from=$this->session->userdata['email'];
		$userdata=$this->user_model->getByUid($uid);
		$to=$userdata['email'];
		$result=$this->user_model->AddtoSchool($uid,$school_id);
		if($result)
		{
				$str ="<b>".$oname ."</b>"." has added you as a tutor within their school community.<br/>";
				$str .= "\r\n<br/>";
				$str .= "This gives you the right to use their learning curriculum and the school the right to add a curriculum markup fee to your student's price.\r\n<br/>";
				$str .= "If you want to remove yourself from this school account, you can delete the school from your Profile Settings.\r\n<br/><br/><br/>";
				//$str .= "If you have any problems please email the support team at: <a href='mailto:support@thetalklist.com'>support@thetalklist.com</a>\r\n<br/>";
				$str .= "Thank you,\r\n<br/><br/>";
				$str .= "TheTalkList Support Team";
				$this->load->library('email');
				$this->email->mailtype = 'html';
				$this->email->from('no-reply@thetalklist.com',$fromName);
				$this->email->to($to);
				$this->email->subject('Added to a School Community on TheTalkList');
				$this->email->message($str);
				$this->email->send();
				$subject="Added to school";
				$this->load->model(array('inbox_model'));
				$str=addslashes($str);
				$this->inbox_model->send($uid,$school_id,$subject,$str);
				echo json_encode(array('success'=>true));
				die();
		}
		else
		{
				echo json_encode(array('success'=>false));
				die();
		}
	}	

	// delete tutor from organization
	public function DeleteTutorAjax()
	{
		$uid=$this->input->post('uid');
		$school_id=$this->session->userdata['uid'];
		$oname=$this->session->userdata['welcomeuser'];
		$from=$this->session->userdata['email'];
		$userdata=$this->user_model->getByUid($uid);
		$to=$userdata['email'];
		$result=$this->user_model->deleteFromSchool($uid,$school_id);

		if($result)
		{
				$str ="<b>".$oname."</b>" ." &nbsp;has deleted you from their organizational account.<br/>";
				$str .= "\r\n<br/>";
				$str .= "You no longer have the right to use their learning program or \r\n<br/>";
				$str .= "materials in your tutoring.  Please contact them directly if you have any questions\r\n<br/><br/>";
				//	$str .= "If you have any problems please email the support team at: <a href='mailto:support@thetalklist.com'>support@thetalklist.com</a>\r\n<br/>";
				$str .= "Thank you,\r\n<br/><br/>";
				$str .= "TheTalkList Support Team";
				$this->load->library('email');
				$this->email->mailtype = 'html';
				$this->email->from($from);
				$this->email->to($to);
				$this->email->subject('Deleted from school');
				$this->email->message($str);
				$this->email->send();
				$subject="Deleted from school";
				$this->load->model(array('inbox_model'));
				$this->inbox_model->send($uid,$school_id,$subject,$str);
				echo json_encode(array('success'=>true,'hid'=>$uid));
				die();
		}
		else
		{
				echo json_encode(array('success'=>false));
				die();
		}
	}	

	public function getAjaxsdata()
	{
		$ptn=$this->input->post('sdata');
		$Alldata=array();
		$Alldata=$this->user_model->getAllTutors($ptn);
		//print_r($Alldata);die;
		echo json_encode($Alldata);
		die();
	}		

// added by haren for auto search

	public function AutoSearch()
	{
		$this->load->model('profile_model');
		$keyword = trim($this->input->_request('data'));
		$users = $this->profile_model->get_Auto_School($keyword);
		if(count($users)>0)
		{
			echo '<ul class="list" onkeydown="test();">';
			foreach($users as $user)
			{
				@$str = $user['firstName'].' '.$user['lastName'];
				if(trim($str) != '' && trim($keyword) != '')
				{
					$start = strpos($str,@$keyword); 
				}
				else
				{
					$start = 0;
				}
				$end   = similar_text($str,$keyword)+1; 
				$last = substr($str,$end,strlen($str));
				//$last = ucfirst($user['lastName']);
				$first = substr($str,$start,$end);
				$img   = $user['pic'];
				$uid   = $user['uid'];
				if($img =='')
				{
					$img = base_url().'images/base/hd-pic.png';
				}else
				{
					$img = base_url().'uploads/images/thumb/'.$img;
				}
				$final = '<span class="bold">'.ucfirst($first).'</span>'.$last;
				echo '<li id="tst"   onclick=getuid('.$uid.');><div class="abc1" style="clear:both;"><a><img class="space"  style="float:left;"  src="'.$img.'" alt="image" height="30px" width="30px"/><div class="" style="float:left;padding:0px 0px 0px 10px">'.$final.'</div></a></div><input type="hidden" class="myuid" id="myuid" value='.$uid.'></li>';
				
				
			}
			echo "</ul>";
		}
		else
		{
			echo '<li>No results found</li>';
		}
				
	}
	public function checkSchoolcode()
	{
		$checkType = $this->input->_request('id');
		
		$result = $this->user_model->chkSchoolCode($this->input->_request('value'));
	
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	
	// functiona added by haren for new affiliate view
	
	public function Affiliate()
	{
		$userModel = $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin)
		{
			redirect('user/login');
		}
		$this->_profile();
		$this->load->model(array('class_model','location_model','ad_model','dashboardmessages_model','dchatmodel'));
		//$chart_data = $this->profile_model->getAllProfile();	
		//$this->layout->setData('chart_data',$chart_data);
		//$chart_number_data = $this->profile_model->getAllCountProfile();
		//$this->layout->setData('chart_number_data',$chart_number_data);
		$criteria = $this->profile_model->getcriteria($this->uid);
		$this->layout->setData('criteria',$criteria);
		$ads= $this->ad_model->getAllAds('user-dashboard');
		if($ads)
			$this->layout->setData('ads',$ads);
		
		$config = $this->location_model->getConfig();
		$this->layout->setData('configdefault',$config);
		$tmessages= $this->dashboardmessages_model->getAllMessages('active');
		if($tmessages)
			$this->layout->setData('tmessages',$tmessages);
		$numberofstudents = $this->user_model->getNumberofstudents();
     	$this->layout->setData('numberofstudents',$numberofstudents);
		$top8Country = $this->user_model->getTop8Country();
		$this->layout->setData('top8Country',$top8Country);
		// get user groups
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
		switch($permisson) 
		{
			case 'invalidUser':break;
			case 'student_private':$classes = $this->class_model->getNextSession($this->uid,$lSid);break;
			case 'teacher_private':$classes = $this->class_model->getNextSession($this->uid,$lTid);break;
			case 'studdent_public':break;

		}
		$msql2 = "select count(id) as number2 from inbox where toId = ".$this->uid." AND isRead = 0";
		$mquery2 = $this->db->query($msql2);
		$mresult2 = $mquery2->result_array();
		$completedSessions = $this->class_model->completedSessions($this->uid);
		$completedSessions = $completedSessions['cnt'];
		$this->layout->setData('completedSessions',$completedSessions);
		$this->layout->setData('msgcnt',$mresult2[0]['number2']);
		$this->layout->setData('classes',$classes);
		$cnt="select count(id) as cnt from profile where school_id={$this->uid}";
		$qry = $this->db->query($cnt);
		$rs = $qry->result_array();
		$this->layout->setData('cnt',$rs);
		$this->load->helper('date');
		$this->layout->view("user/dashboard/affiliate_private");
	}
	
	//chnage affiliate acoount info added by haren
	
	public function AffiliateInfo()
	{
		if(!$this->user)
		{
			redirect('user/login');
		}
		$this->load->helper('form');
		$langs= $this->langs_model->getLangs();
		$this->_profile();
		$permission = $this->getPermission($this->user['uid']);
		$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
		$this->layout->setData('linkType',$type);
	
		if($data =$this->input->post())
		{
			$error 			= false;
			$user 			= $this->user_model->getByUid($this->user['uid']);
			$_data['uid'] 	= $this->user['uid'] ;

			if($data['profile_tab'] == 'col1')
			{
					if(isset($data['name'])   && $data['name'] != "")
					{
						$fullName = $data['name'];
						$fullNameArray = explode(' ', $data['name']);
						if($fullNameArray[0] != "")
						{
							$_data['firstName'] = $fullNameArray[0];
							$this->profile_model->update($_data);
						}
						if($fullNameArray[1] != "")
						{
							$_data['lastName'] = $fullNameArray[1];
							$this->profile_model->update($_data);
						}
					}
				
					//--FOR PERSONAL INFO
					$_data['age'] 			= $data['age'];
					$_data['gender'] 		= $data['gender'];
					$_data['address'] 		= $data['address'];
					$_data['city'] 			= $data['city'];
					$_data['province'] 		= $data['province'];
					$_data['country'] 		= $data['country'];
					$_data['principle_name'] = $data['principle_name'];

					$this->profile_model->update($_data);
					redirect('user/AffiliateInfo');
			}
			elseif($data['profile_tab'] == 'col2')
			{
				//--FOR ACCOUNT INFO
				if($data['new_password']	!=	"")
				{
				//--Check for current password
					if($data['new_password'] == '')
					{
						//$this->layout->setData('error',$error['message']);
					}
					elseif($data['new_password'] != ''	&& $data['new_password']	!= $data['new_password2'])
					{
					
					}
					else
					{
						$_data['password'] = $data['new_password'];
					}
					$this->user_model->changePassword($_data['uid'] , $_data['password']);
				}
				if($data['cell_number']	!=	"")
				{
					$_data['cell'] 			= $data['cell_number'];
					$this->profile_model->update($_data);
				}
				redirect('user/AffiliateInfo');
			}
			elseif($data['profile_tab'] == 'col3')
			{
				if($data['payment_account']	!=	"")
				{
					$_data['payment_account'] = $data['payment_account'];
					
					$this->profile_model->update($_data);
				}
				//--FOR CONTACT INFO
				if($data['email']	!=	"")
				{
					$_data['email'] 			= $data['email'];
					$this->profile_model->update($_data);
				}
				if($data['cell']	!=	"")
				{
					$_data['cell'] 			= $data['cell'];
					$this->profile_model->update($_data);
				}
				
				
				redirect('user/AffiliateInfo');
				
			}
			
		}
		$user = $this->user_model->getByUid($this->user['uid']);

		if($this->input->post('profile_tab'))
		{
			$currentTab = $this->input->post('profile_tab');
		}
		else
		{
			$currentTab = 'col1';
		}
		
		$tid=$this->user['uid'];
		$profileModel = $this->profile_model;
		$pr = $profileModel->getProfile($tid);
		/*if($pr['payment_account'] != '')
		{*/
		
		$encode =$this->user_model->encode($this->session->userdata['uid'],"This is a key"); 
		$this->layout->setData('encode',base_url().'af/'.$encode);
		//}
		
		$this->layout->setData('currentTab',$currentTab);
		$this->layout->setData('langs',$langs);
		$this->layout->setData('email',$user['email']);
		$this->layout->setData('roleid',$user['roleId']);
		$this->layout->view('user/AffiliateInfo');
	}
	
	//code for affiliate register haren
	
	public function RegiaterAffiliate()
	{
		if($this->input->post()) 
		{
			$userModel =  $this->user_model;
			$profileModel = $this->profile_model;
			$formData = $this->input->post();
			$_SESSION['isRegError'] = TRUE;
			$_SESSION['regError']   = $errorMsg;
			$errorMsg ='';
			$formData['timezone'] = $this->config->item('local_timezone');
			$formData['free_session'] = 'n';
			$uid = $userModel->register($formData);
		//insert to  the profile table
			if($uid) 
			{
				$formData['uid'] = $uid;
				$formData['new'] = 1;
				//default setting for message box
				$formData['alerts'] = 30;
				$formData['textalert'] = 30;
				$formData['alertType'] = '11';
				if($formData['roleId']  == 1)
				{
					$formData['hRate'] = '3.76';
				}
				$profileModel->save($formData);
				$uinfo = array(
					'username'=>$formData['email'],
					
					'welcomeuser'=>$formData['firstName'] ,
					'email'=>$formData['email'],
					'uid'=>$formData['uid'],
					'roleId'=>$formData['roleId'],
					'firstTime'=>'y',
					'free_session'=> 'y',
					'ancode'=> 'y',
					'new'=>'1'
				);
				$this->session->set_userdata($uinfo);
				$profile = $this->db->query("SELECT uid,firstName,lastName,hRate,pic,Lat,Lng,user.username,countries.country ,provices.provice ,city FROM profile LEFT JOIN user ON user.id = profile.uid LEFT JOIN countries ON profile.country = countries.id LEFT JOIN provices ON profile.province = provices.id where user.id=".$uid);		
				$profile->result_array();
				$profile_res = $profile->result_array();
				$address = '';
				if($profile_res[0]['city'] != '')
				{
					$address = $address.$profile_res[0]['city'].' ';
				}
				if($profile_res[0]['provice'] != '')
				{
					$address = $address.$profile_res[0]['provice'].' ';
				}
				if($profile_res[0]['country'] != '')
				{
					$address = $address.$profile_res[0]['country'];
				}
				if($formData['roleId'] == 4)
				{
					$str = "<b>Welcome to TheTalkList.com, your social e-learning network!</b>   We have worked hard at building the best 1 to 1 learning environment.  Teaching a language will be more convenient than ever.  \r\n<br/>";
					$str .= "\r\n<br/>";
				}
			
						$str .= "\r\n<br/>";
						$str .= "Your login information:\r\n<br/>";
						$str .= "Email: {$formData['email']}\r\n<br/>";
						$str .= "Password: {$formData['password']}\r\n<br/>";
						$str .= "\r\n<br/>";
						$str .= "If you have any problems please email the support team at: <a href='mailto:support@thetalklist.com'>support@thetalklist.com</a>\r\n<br/>";
						$str .= "Thank you,\r\n<br/>";
						$str .= "TheTalkList Support Team";
						$this->load->library('email');
						$this->email->mailtype = 'html';
						$this->email->from('admin@thetalklist.com','TheTalklist');
						$this->email->to($formData['email']);
						$this->email->subject('Sign-Up with TheTalkList.com by '.$formData['firstName']);
						$this->email->message($str);
						$this->email->send();
						// End email function code
					
						echo json_encode(array('success'=>true,'redirect'=>Base_url('user/Affiliate')));
						die();
				}
				else
				{
					echo json_encode(array('success'=>false,'message'=>'Something wrong ,Please contact to admin please!'));
					die();
				}
		}
		else 
		{
			echo json_encode(array('success'=>false,'message'=>'Not corect!'));
			die();
		}
	}
	public function genpdf()
	{
		$dat=$this->uri->segment(3);	
		if($dat=='')
			{
				redirect('user/account');
			}
		$this->load->model(array('user_model','profile_model','langs_model'));
		$this->db->select('u.id,p.firstName,p.lastName,a.purchaseamount,a.amount,a.createAt');
		$this->db->from('user u');
		$this->db->join('profile p', 'u.id = p.uid');
		$this->db->join('affiliate a', 'a.sid =u.id');
		$this->db->where('u.refid',$this->uid);
		$this->db->where('u.roleId',0);
		$this->db->where('MONTH(a.createAt)=',$dat);
		$query = $this->db->get();  
		$result = $query->result_array();
		$this->load->library('mpdf/mpdf');                
        $mpdf=new mPDF();
		if ($query->num_rows() > 0) 
		{
		$img = base_url('images/affiliate.png');
		$pdf =  "<table width = '100%' border = '10' cellspacing='0px' >";
		 $pdf .="<tr>"; 
				 $pdf .= "<td colspan='5'><img src='".$img."'></td>"; 
						
				$pdf .="</tr>"; 
		$pdf .="<tr bgcolor='#3399CC' color='white'><td color='white' cellspacing='0' cell-padding='0' align='center' ><b>Student Name</b></td><td color='white' align='center' cellspacing='0' cell-padding='0' ><b>Purchase Date</b></td> <td color='white' align='center' cellspacing='0' cell-padding='0' ><b>Purchase Amount</b></td> <td color='white' cellspacing='0' cell-padding='0' align='center' ><b>Affiliate Commission</b></td>";  
		$pdf .="</tr> "; 
		foreach($result as $res)
		{
				$dt=date('Y-m-d',strtotime($res['createAt']));
				$pdf .="<tr><td align='center'>".ucfirst($res['firstName']). " ".$res['lastName']."</td><td align='center'>".$dt."</td><td align='center'>$".number_format($res['purchaseamount'],2,'.','')."</td> <td align='center'>$".number_format($res['amount'],2,'.','')."</td> ";  
				$pdf .="</tr>";
				$total=$total+$res['amount'];
		}

		$pdf .="</tr> "; 
		
		$pdf.="<tr><td colspan='5'><hr color='#d7bc4d'></td></tr><tr><td></td><td></td><td></td><td><p text-align='right'>Monthly Total: "."$".number_format($total,2,'.','')."</p></td></tr>";
		$pdf .="</table> ";
		}
		else
		{
			$img = base_url('images/affiliate.png');
		$pdf =  "<table width = '100%' border = '10' cellspacing='0px' >";
		 $pdf .="<tr>"; 
				 $pdf .= "<td colspan='5'><img src='".$img."'></td>"; 
						
				$pdf .="</tr>"; 
		$pdf .="<tr bgcolor='#3399CC' color='white'><td color='white' cellspacing='0' cell-padding='0' align='center' ><b>Student Name</b></td><td color='white' align='center' cellspacing='0' cell-padding='0' ><b>Purchase Date</b></td> <td color='white' align='center' cellspacing='0' cell-padding='0' ><b>Purchase Amount</b></td> <td color='white' cellspacing='0' cell-padding='0' align='center' ><b>Affiliate Commission</b></td>";  
		$pdf .="</tr> "; 
		 
		$pdf.="<tr><td colspan='5'><hr color='#d7bc4d'></td></tr><tr><td></td><td></td><td></td><td><p text-align='right'>No Activity"."</p></td></tr>";
		$pdf .="</table> ";
		}
        $mpdf->WriteHTML($pdf); 

        $mpdf->Output();
	
	}

	public function tutorpdf()
	{
		$dat= date('Y-m-d');
		if($dat=='')
		{
			redirect('user/account');
		}
		$d = date_parse_from_format("Y-m-d", $dat);
		$dat="0".$d["month"];
		$this->load->model(array('user_model','profile_model','langs_model'));
		$id=$this->uid;
		$sql1="select tutor_markup  from profile where uid={$id}";
		$query1 = $this->db->query($sql1);
		$markup= $query1->result_array();
		$sql="SELECT DISTINCT disputes.id, disputes . * ,tProfile.firstName AS tFN, tProfile.hRate AS trate, tProfile.lastName AS tLN, sProfile.firstName AS sFN, sProfile.lastName AS sLN
			FROM disputes
			LEFT JOIN profile AS tProfile ON tProfile.uid = disputes.tid
			LEFT JOIN profile AS sProfile ON sProfile.uid = disputes.sid
			WHERE disputes.School_id ={$id}
			and disputes.schoolPaid=1 
			and disputes.is_completed=1";
		$query = $this->db->query($sql);
		$result= $query->result_array();
		$this->load->library('mpdf/mpdf');                
			$mpdf=new mPDF();
			if ($query->num_rows() > 0) 
			{
					$img = base_url('images/activity.png');
					$pdf =  "<table width = '100%' border = '1'>";
					 $pdf .="<tr>"; 
					 $pdf .= "<td colspan='5'><img src='".$img."'></td>"; 
					$pdf .="</tr>"; 
					 $pdf .="<tr bgcolor='#3399CC' color='white' cellspacing='0' cell-padding='0'><td   color='white' cellspacing='0' cell-padding='0' width='130px' align='center'><b>Tutor Name</b></td><td   color='white' cellspacing='0' cell-padding='0' align='center' width='130px'><b>Student Name</b></td> <td  color='white' cellspacing='0' cell-padding='0' align='center' width='130px'><b>Date</b></td> <td   color='white' cellspacing='0' cell-padding='0' align='center' width='130px'><b>Tutor Rate</b></td> <td  color='white' cellspacing='0' cell-padding='0'  align='center' width='130px'><b>School Earning</b></td>";  
					$pdf .="</tr> "; 
					foreach($result as $res)
					{
						$dt=date('Y-m-d',strtotime($res['createAt']));
						if($res['t_hrate'] == '')
						{
							$res['t_hrate'] ='0';
						}
						$pdf .="<tr><td align='center'>".ucfirst($res['tFN']). " ".$res['tLN']."</td><td align='center'>".$res['sFN']." ".$res['sLN']."</td><td align='center'>".$dt."</td><td align='center'>"."".$a=number_format($res['t_hrate'],2,'.',''). "</td><td align='center'>"."".number_format($res['s_markup'],2,'.','')."</td>";  
						$pdf .="</tr>";
						$total=$total+$res['s_markup'];
					}

			$pdf .="</tr> "; 
			$pdf.="<tr><td colspan='5'><hr color='#d7bc4d'></td></tr><tr><td></td><td></td><td></td><td colspan='2'> Monthly Total:"."$".$$total=number_format($total,2,'.','')."</td></tr>";
			$pdf .="</table> ";
			}
			else
			{
				$pdf="no record found";
			}
			$mpdf->WriteHTML($pdf); 
			$mpdf->Output();
	}
	
	//added by haren
	
	public function exitschool()
	{
		$uid=$this->input->post('uid');
		$result=$this->user_model->exitfromschool($uid);
		if($result)
		{
				echo json_encode(array('success'=>true,'hid'=>$uid));
				die();
		}
		else
		{
				echo json_encode(array('success'=>false));
				die();
		}
	}
	
	public function Advertisements()
	{
	   $this->load->model('user_model');
		$this->_profile();
		
		$permission = $this->getPermission($this->user['uid']);
		$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
		$this->layout->setData('linkType',$type);
		$this->layout->view('user/Advertise');
	}
	public function getAllAdd()
	{
		$ptn=$this->input->post('sdata');
		$Alldata=array();
		$Alldata=$this->user_model->GetAllAdvertise($ptn);
		
		echo json_encode($Alldata);
		die();
	}
	public function download()
	
	{
			$uid=$this->uri->segment(3);
			$Alldata=$this->user_model->DownloadAdd($uid);
			$path=$Alldata[0]['source'];
			$file=FCPATH.'/uploads/images/ad/'.$path;
		    $this->output_file($file,$path);
	}
	
function output_file($file, $name, $mime_type='')
{
		 if(!is_readable($file)) die('File not found or inaccessible!');
		 $size = filesize($file);
		 $name = rawurldecode($name);
		 $known_mime_types=array(
			"pdf" => "application/pdf",
			"txt" => "text/plain",
			"html" => "text/html",
			"htm" => "text/html",
			"exe" => "application/octet-stream",
			"zip" => "application/zip",
			"doc" => "application/msword",
			"xls" => "application/vnd.ms-excel",
			"ppt" => "application/vnd.ms-powerpoint",
			"gif" => "image/gif",
			"png" => "image/png",
			"jpeg"=> "image/jpg",
			"jpg" =>  "image/jpg",
			"php" => "text/plain"
		 );
		 if($mime_type==''){
			 $file_extension = strtolower(substr(strrchr($file,"."),1));
			 if(array_key_exists($file_extension, $known_mime_types)){
				$mime_type=$known_mime_types[$file_extension];
			 } else {
				$mime_type="application/force-download";
			 };
		 };
		 @ob_end_clean(); 
		 if(ini_get('zlib.output_compression'))
		  ini_set('zlib.output_compression', 'Off');
		 header('Content-Type: ' . $mime_type);
		 header('Content-Disposition: attachment; filename="'.$name.'"');
		 header("Content-Transfer-Encoding: binary");
		 header('Accept-Ranges: bytes');
		 header("Cache-control: private");
		 header('Pragma: private');
		 header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		 if(isset($_SERVER['HTTP_RANGE']))
			 {
				list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
				list($range) = explode(",",$range,2);
				list($range, $range_end) = explode("-", $range);
				$range=intval($range);
				if(!$range_end) {
					$range_end=$size-1;
				} else {
					$range_end=intval($range_end);
				}
				$new_length = $range_end-$range+1;
				header("HTTP/1.1 206 Partial Content");
				header("Content-Length: $new_length");
				header("Content-Range: bytes $range-$range_end/$size");
			 } else {
				$new_length=$size;
				header("Content-Length: ".$size);
			 }
			 $chunksize = 1*(1024*1024); //you may want to change this
			 $bytes_send = 0;
			 if ($file = fopen($file, 'r'))
			 {
				if(isset($_SERVER['HTTP_RANGE']))
				fseek($file, $range);
			 
				while(!feof($file) && 
					(!connection_aborted()) && 
					($bytes_send<$new_length)
					  )
				{
					$buffer = fread($file, $chunksize);
					print($buffer); //echo($buffer); // can also possible
					flush();
					$bytes_send += strlen($buffer);
				}
			 fclose($file);
			 
			 } else
			 //If no permissiion
			 die('Error - can not open file.');
			 //die
			die();
}
		public function editpsingle() {	
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if(!$islogin)
		{
			
			echo 'must login first!';

		}
		else {
			$profileModel = $this->profile_model;

			$uid = $this->session->userdata('uid');
			
			$profileUser = $profileModel->getProfile($uid);

			if(($data = $this->input->post()) && $uid ) {
                 
				$formData = array();
				if(!isset($data['value'])){
					echo '';
					return;
				}
				$dataTmpVal = $data['value'];
		
				
				if($data['id'] == 'skill' || $data['id'] == 'interests' ){
				
			     for($i=0;$i<sizeof($data);$i++)
				 {
				   if($data['value'][$i]['desc']=='' && $data['value'][$i]['title']=='Personal')
				   {
				   $a="My teaching philosophy is...\nMy favorite sport is...\nMy favorite thing to do is...\nMy favorite movie is...";
				    // $data['value'][$i]['desc']="My favorite sport is...";
					$data['value'][$i]['desc']=$a;
				   }
				   if($data['value'][$i]['desc']=='' && $data['value'][$i]['title']=='Educational')
				   {
				     $data['value'][$i]['desc']="I went to school at...";
				   }
				   if($data['value'][$i]['desc']==''&& $data['value'][$i]['title']=='Professional')
				   {
				     $data['value'][$i]['desc']="I have worked at...";
				   }
				  
				  $data['value'][$i]['desc']=strip_tags($data['value'][$i]['desc']);

				 }
}
				
				if($data['id'] == 'age')
				{
					if($data['value']<13)
					{
						$newage = $data['value'];
						
						$data['value'] = @$profileUser['age'];
					}
				}
				if($data['id'] == 'free_session')
				{
					
					$data['value'] = strtolower(substr($data['value'],0,1));
				}
				$formData['uid'] = $uid;
				$formData[$data['id']] = $data['value'] ;
				$profileModel->update_profile($formData);
				
				if($data['id'] == 'skill' || $data['id'] == 'interests'){
					$data['value'] = $data['value'];
				}else{
					$data['value'] = $dataTmpVal;
				}
				echo $data['value'] = json_encode($data['value']);
			}
			return;
		}
		}
	public function chkProfileAjax()
	{
		$kuid=$this->session->userdata['uid'];
		$pinfo = $this->user_model->getByprofileUid($kuid);
		$chkOpenslot=$this->user_model->CheckOpenSlot($kuid);
		if($pinfo['pic']!='' && $pinfo['vedio']!='' && $pinfo['personal']!='' && $pinfo['professional']!='' && $pinfo['academic']!=''  && $chkOpenslot['oslot'] > 0 && $pinfo['cmp_profile']==0)
		{
			if(!isset($this->session->userdata['tst']))
			{
			$this->profile_model->removeHidden($kuid);
			$this->profile_model->UpdateProfile($kuid);
			echo json_encode(array('success'=>true));
			$this->session->set_userdata('tst','yes');
			die();
			}
		}
		else if($pinfo['pic_upload']==0 && $pinfo['pic']!='' )
		{
			
			$feeSql = "update profile set pic_upload=1 where uid={$kuid}";
			$query = $this->db->query($feeSql);
			echo json_encode(array('success'=>'pupload'));
			die();
		}
		else if($pinfo['vid_upload']==0 && $pinfo['vedio']!='')
		{
			
			$feeSql = "update profile set vid_upload=1 where uid={$kuid}";
			$query = $this->db->query($feeSql);
			echo json_encode(array('success'=>'vupload'));
			die();
		}
		else if($pinfo['BioGraphy']==0 && $pinfo['personal']!='' && $pinfo['professional']!='' && $pinfo['academic']!='')
		{
			
			$feeSql = "update profile set BioGraphy=1 where uid={$kuid}";
			$query = $this->db->query($feeSql);
			echo json_encode(array('success'=>'bupload'));
			die();
		}
		else if($pinfo['Cal_open']==0 && $chkOpenslot['oslot'] > 0)
		{
			
			$feeSql = "update profile set Cal_open=1 where uid={$kuid}";
			$query = $this->db->query($feeSql);
			echo json_encode(array('success'=>'calopen'));
			die();
		}
		else
		{
			//$this->profile_model->RevertProfile($kuid);
			echo json_encode(array('success'=>false));
			die();
		}

	}
	function df($tutotTimezone)
   {
   date_default_timezone_set($tutotTimezone);
   return date('P');
   }
   
   function utc_to_local1($format_string, $utc_datetime, $time_zone){
		$date = new DateTime($utc_datetime, new DateTimeZone('UTC'));
		$date->setTimeZone(new DateTimeZone($time_zone));
		return $date->format($format_string);
	}
   
   function img_download(){
	echo $file_name = "header.jpg";

		// make sure it's a file before doing anything!
		// required for IE
			if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off');	}

			// get the file mime type using the file extension
			switch(strtolower(substr(strrchr($file_name, '.'), 1))) {
				case 'pdf': $mime = 'application/pdf'; break;
				case 'zip': $mime = 'application/zip'; break;
				case 'jpeg':
				case 'jpg': $mime = 'image/image/jpeg'; break;
				default: $mime = 'application/force-download';
			}
			header('Pragma: public'); 	// required
			header('Expires: 0');		// no cache
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($file_name)).' GMT');
			header('Cache-Control: private',false);
			header('Content-Type: '.$mime);
			header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: '.filesize($file_name));	// provide file size
			header('Connection: close');
			readfile($file_name);		// push it out
			exit();

		}
		
  
		public function getFeedback(){
		
		$uid = $this->input->_request('uid');
		$ratings=array();
		  
		$ratings = $this->profile_model->getRatings($uid);
		$ratings['ratings']=$ratings;
		$avgRate = $this->profile_model->getAvgRating($uid);
                $ratings['avgRate'] = $avgRate;
		$sessionCount = $this->profile_model->sessionCount($uid);
		$ratings['sessionCount']=$sessionCount;
		$this->load->view("user/showfeedback",$ratings);
	}
        public function getSlotData()
        {
             $tmpfromDate = explode(" ",$_POST["startdate"]);
			if (strlen($tmpfromDate[3]) > 4)
			{
				$tmpfromDate = $tmpfromDate[count($tmpfromDate)-1]."-".$tmpfromDate[1]."-".$tmpfromDate[2];
            }
			else
			{
				$tmpfromDate = $tmpfromDate[3]."-".$tmpfromDate[1]."-".$tmpfromDate[2];
			}
			//$tmpfromDate = $tmpfromDate[3]."-".$tmpfromDate[1]."-".$tmpfromDate[2];
            $fromDate = date("Y-m-d",strtotime($tmpfromDate));
            $tmptoDate = explode(" ",$_POST["enddate"]);
            //$tmptoDate = $tmptoDate[3]."-".$tmptoDate[1]."-".$tmptoDate[2];
			if (strlen($tmptoDate[3]) > 4)
			{
				$tmptoDate = $tmptoDate[count($tmptoDate)-1]."-".$tmptoDate[1]."-".$tmptoDate[2];
            }
			else
			{
				$tmptoDate = $tmptoDate[3]."-".$tmptoDate[1]."-".$tmptoDate[2];
			}
			//$tmptoDate = $tmptoDate[3]."-".$tmptoDate[1]."-".$tmptoDate[2];
            $toDate = date("Y-m-d",strtotime($tmptoDate));
            $divid = $_POST["diviid"];
            $divaction = $_POST["divaction"];
            $logintype = $_POST["logintype"];
            $additionalprofileid = $_POST["additionalprofileid"];
			
            $kuid=$this->session->userdata['uid'];
          
            $Alldata=$this->user_model->getSlotData($kuid,$fromDate,$toDate,$divid,$divaction,$logintype,$additionalprofileid);

           if ($divaction == "confirm")
            { 
				$this->load->model("inbox_model");
                $this->load->model("profile_model");
                $this->load->model("deepboxmessage_model");
				
                $tutorProfilenew = $this->profile_model->getProfile($kuid);
                $class = $this->user_model->getClassData($kuid,$divid);
                $profile = $this->profile_model->getProfile($class["sid"]);

				
                $tmpstarttime = explode("_",str_replace("div","",$divid));
                $starttime = $tmpstarttime[0]."-".$tmpstarttime[1]."-".$tmpstarttime[2]." ".$tmpstarttime[3].":".$tmpstarttime[4].":00";
				
                //$datarray = array("datetime"=>$starttime,"studentname"=>$profile["firstName"]." ".$profile["midName"]." ".$profile["lastName"],"tutorname"=>$tutorProfilenew["firstName"]." ".$tutorProfilenew["midName"]." ".$tutorProfilenew["lastName"],"speakinglevel"=>$class["sLevel"],"conversationtopic"=>$class["sTopic"]);               
				$datarray = array("datetime"=>$starttime,"studentname"=>$profile["firstName"]."".$profile["uid"],"tutorname"=>$tutorProfilenew["firstName"]."".$tutorProfilenew["uid"],"speakinglevel"=>$class["sLevel"],"conversationtopic"=>$class["sTopic"]);
				$contentdata = $this->deepboxmessage_model->timeslot_confirm_request__mail($datarray);				
                $toemail = $tutorProfilenew["email"];
                $this->sendmailnew($contentdata["fromemailid"], $contentdata["fromname"], $toemail, $contentdata["subject"], $contentdata["msg"]);
				
				//$datarray = array("datetime"=>$starttime,"studentname"=>$profile["firstName"]." ".$profile["midName"]." ".$profile["lastName"],"tutorname"=>$tutorProfilenew["firstName"]." ".$tutorProfilenew["midName"]." ".$tutorProfilenew["lastName"],"speakinglevel"=>$class["sLevel"],"conversationtopic"=>$class["sTopic"],"studentid"=>$class["sid"]);
				$datarray = array("datetime"=>$starttime,"studentname"=>$profile["firstName"]."".$profile["uid"],"tutorname"=>$tutorProfilenew["firstName"]."".$tutorProfilenew["uid"],"speakinglevel"=>$class["sLevel"],"conversationtopic"=>$class["sTopic"],"studentid"=>$class["sid"]);
				$scontentdata = $this->deepboxmessage_model->timeslot_confirm_request__studentmail($datarray);				
				$toemail = $profile["email"];
                $this->sendmailnew($scontentdata["fromemailid"], $scontentdata["fromname"], $toemail, $scontentdata["subject"], $scontentdata["msg"]);
               
				//$datarray = array("datetime"=>$starttime,"tutorname"=>$tutorProfilenew["firstName"]." ".$tutorProfilenew["midName"]." ".$tutorProfilenew["lastName"],"studentid"=>$class["sid"]);
				$datarray = array("datetime"=>$starttime,"tutorname"=>$tutorProfilenew["firstName"]."".$tutorProfilenew["uid"],"studentid"=>$class["sid"]);
                $contentdata = $this->deepboxmessage_model->timeslot_confirm_request__student($datarray);
                $this->senddeepbox($class["sid"],$kuid, $contentdata["subject"], $contentdata["msg"]);
                //$datarray = array("datetime"=>$starttime,"studentname"=>$profile["firstName"]." ".$profile["midName"]." ".$profile["lastName"],"tutorname"=>$tutorProfilenew["firstName"]." ".$tutorProfilenew["midName"]." ".$tutorProfilenew["lastName"],"speakinglevel"=>$class["sLevel"],"conversationtopic"=>$class["sTopic"]);
				$datarray = array("datetime"=>$starttime,"studentname"=>$profile["firstName"]."".$profile["uid"],"tutorname"=>$tutorProfilenew["firstName"]."".$tutorProfilenew["uid"],"speakinglevel"=>$class["sLevel"],"conversationtopic"=>$class["sTopic"]);
                if ($msg == "freesession")
                {
                    $contentdata = $this->deepboxmessage_model->timeslot_book__mail($datarray,1);
                }
                else
                {
                    $contentdata = $this->deepboxmessage_model->timeslot_book__mail($datarray,0);					
                }
				
                /*$toemail = $profile["email"];
                $this->sendmailnew($contentdata["fromemailid"], $contentdata["fromname"], $toemail, $contentdata["subject"], $contentdata["msg"]);
                $this->senddeepbox($class["sid"],$class["sid"],$contentdata["subject"],$contentdata["msg"]);*/
				
               // $toemail = $tutorProfilenew["email"];
                //$this->sendmailnew($contentdata["fromemailid"], $contentdata["fromname"], $toemail, $contentdata["subject"], $contentdata["msg"]);
                //$this->senddeepbox($tutorProfilenew["uid"],$tutorProfilenew["uid"],$contentdata["subject"],$contentdata["msg"]);
             }
            echo json_encode($Alldata);
            exit();
        }
        public function getconversationtopic()
        {
            $kuid=$this->session->userdata['uid'];
            $Alldata=$this->user_model->getconversationtopic($kuid);
            echo $Alldata;
            exit();
        }
		
		 public function buyClassesnew()
        {
            $kuid=$this->session->userdata['uid'];
			 
            $tutorid = $_POST["tutorid"];
            $divid = $_POST["diviid"];
            //echo $kuid." : ".$tutorid." : ".$divid;
            $permisson = $this->getPermission($tutorid);
            $isrequest = $_POST["isrequest"];
            $bookingtype = $_POST["bookingtype"];
            $SessionCost = $_POST["SessionCost"];
			$isaffi=$_POST["isaffi"];
			$cost = "";
			
			$this->load->model(array('profile_model'));
			$tutorProfile = $this->profile_model->getProfilenew($tutorid,$bookingtype);
			
            if($permisson !='teacher_public')
            {
                $success = 'false';
                $msg = 'nopermission';//You do not have permisson!';
            }
            else 
            {
                if(!$kuid)
                {
					$success = 'false';
					$msg = 'firstlogin';//You must login first!';
				}
				else
                {
                    $this->load->model(array('event_model','myTeacher_model','profile_model','user_model'));
                    $sspeakinglevel = $_POST["sspeakinglevel"];
                    $conversationtopic = $_POST["conversationtopic"];
                    $txtconversationtopic = $_POST["txtconversationtopic"];

                    if (($conversationtopic) == "Other")
                    {
                        $this->user_model->addtxtconversationtopic($kuid,$conversationtopic,$txtconversationtopic);
                    }
                    $times = $this->input->_request('seletedSlot');
                    $tmpstarttime = explode("_",str_replace("div","",$divid));
                    //print_r($tmpstarttime);
                    $starttime = $tmpstarttime[0]."-".$tmpstarttime[1]."-".$tmpstarttime[2]." ".$tmpstarttime[3].":".$tmpstarttime[4].":00";
                    $times = $starttime;
                    if($times == ''){
                        $times = array();
                    }
                    $tutorProfile = $this->profile_model->getProfilenew($tutorid,$bookingtype);

                    $tutorProfilenew = $this->profile_model->getProfile($tutorid);
                    $profile = $this->profile_model->getProfile($this->user['uid']);
                    $config = $this->profile_model->getConfig();
					$tutorProfile['hRate'] = round($tutorProfile['hRate'] * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
					$schoolId=$tutorProfile['school_id'];
					$s_markup=0;
					$s_pbalance=0;
					if($bookingtype==0)
					{
						$schoolId=0;
					}
					if($schoolId > 0)
					{
						$schoolmarkup=$this->profile_model->GetSchoolMarkup($schoolId);
						$s_markup=$schoolmarkup[0]['tutor_markup'];
						$s_pbalance=$schoolmarkup[0]['pbalance'];
					}
					//print_r($schoolmarkup);die();
					$trate=$tutorProfilenew['hRate'];

					if($bookingtype == 1 && $isaffi==1 && $s_pbalance > '10')
					{
						$pvt=1;
					}
					else
					{
						$pvt=0;
					}
					
					if(trim($profile['country']) == '' or trim($profile['city']) == '' or trim($profile['firstName']) == '' or trim($profile['lastName']) == ''){
						$success = false;
						$multi_lang = $_SESSION['multi_lang'];
						$arrVal = $this->lookup_model->getValue('1057', $multi_lang);
						$msg = "incompleteprofile".$arrVal[$multi_lang];//You do not have enough money.";
					} else if($profile['money'] < $tutorProfile['hRate']){
                            //echo "a";
                            $success = false;
                            $msg = "enoughmoney";//You do not have enough money.";
                            
							$sssid=$this->user['uid'];
							$q= "SELECT exp_session,is_eligible from user where  user.id='{$sssid}'";
							$classquery = $this->db->query($q);				
							$classresult = $classquery->row_array();
							$cdate=date('Y-m-d');
								//if($classresult['exp_session'] > $cdate && $classresult['is_eligible']==1)
								if($classresult['exp_session'] > $cdate && $classresult['is_eligible']==1 && $tutorProfilenew['free_session']=='y')
								{ 
								 $success = true;
                                    $tutorProfile['hRate'] = 0;
                                    $msg = "freesession"; 
									  
									$conf=0;
									if ($isrequest == 1)
									{
									}
									else
									{
										$conf=1;
									} 
									$this->session->set_userdata("sspeakinglevel",$sspeakinglevel);
									$this->user_model->fnUpdateSearchData(array("user_id"=>$this->user['uid'],"speaklevel"=>$sspeakinglevel));  
                                    $this->event_model->creatClassnew($times,0,$this->user['uid'],$tutorid,$tutorProfile['hRate'],$sspeakinglevel,$conversationtopic,$txtconversationtopic,$isrequest,$bookingtype,$trate,$s_markup,$pvt,$schoolId,$conf);
                                    $this->myTeacher_model->creatMyTeacher($this->user['uid'],$tutorid,0);
                                    $success = true;
								}
                    }
                    else{
							 
                            $conf=0;
                            if ($isrequest == 1)
                            {
                                $msg = "successrequest";//Slot request has been registered";
                            }
                            else
                            {
                                $msg = "successbooking";//Slot has been booked";
								$conf=1;
                            }
                            //$msg = $msg."\nFrom your account $".$tutorProfile['hRate']." has been diducated";
							if($pvt==1)
							{	
								$tutorProfile['hRate']= 0;
							}
							/* Check Free Session Available */
							$sssid = $this->session->userdata('uid');
							$q = "SELECT `exp_session`, `is_eligible` from `user` where `user`.`id`='{$sssid}'";
							$classquery = $this->db->query($q);
							$classresult = $classquery->row_array();
							$cdate=date('Y-m-d');
							if($classresult['exp_session'] > $cdate && $classresult['is_eligible']==1 && $tutorProfilenew['free_session']=='y') {
								$tutorProfile['hRate'] = 0;
							}
							/* End */
							$this->session->set_userdata("sspeakinglevel",$sspeakinglevel);
							$this->user_model->fnUpdateSearchData(array("user_id"=>$this->user['uid'],"speaklevel"=>$sspeakinglevel)); 
                            $this->event_model->creatClassnew($times,0,$this->user['uid'],$tutorid,$tutorProfile['hRate'],$sspeakinglevel,$conversationtopic,$txtconversationtopic,$isrequest,$bookingtype,$trate,$s_markup,$pvt,$schoolId,$conf);
                            $this->myTeacher_model->creatMyTeacher($this->user['uid'],$tutorid,0);
                            $success = true;
                    }
				}
				$sspeakinglevel = ($sspeakinglevel=='naval') ? "Intermediate" :  $sspeakinglevel;
				if($success == true)
				{
					$this->session->set_userdata('free_session', 'n');
					$this->session->set_userdata('firstTime', 'n');
					$this->load->model("deepboxmessage_model");
					$this->load->model("inbox_model");
					$conversationtopicnew = "";
					if ($conversationtopic == "Other")
					{
						$conversationtopicnew = $txtconversationtopic;
					}
					else
					{
						$conversationtopicnew = $conversationtopic;
					}
					if ($isrequest == 0)
					{
						//echo "booking mail";
						//$datarray = array("datetime"=>$times,"studentname"=>$profile["firstName"]." ".$profile["midName"]." ".$profile["lastName"],"tutorname"=>$tutorProfile["firstName"]." ".$tutorProfile["midName"]." ".$tutorProfile["lastName"],"speakinglevel"=>$sspeakinglevel,"conversationtopic"=>$conversationtopicnew);
						//$tutordatarray = array("datetime"=>$times,"studentname"=>$profile["firstName"]." ".$profile["midName"]." ".$profile["lastName"],"tutorname"=>$tutorProfile["firstName"]." ".$tutorProfile["midName"]." ".$tutorProfile["lastName"],"speakinglevel"=>$sspeakinglevel,"conversationtopic"=>$conversationtopicnew,"tutorid"=>$tutorid);
						$datarray = array("datetime"=>$times,"studentname"=>$profile["firstName"]."".$profile["uid"],"tutorname"=>$tutorProfile["firstName"]."".$tutorProfile["uid"],"speakinglevel"=>$sspeakinglevel,"conversationtopic"=>$conversationtopicnew);
						$tutordatarray = array("datetime"=>$times,"studentname"=>$profile["firstName"]."".$profile["uid"],"tutorname"=>$tutorProfile["firstName"]."".$tutorProfile["uid"],"speakinglevel"=>$sspeakinglevel,"conversationtopic"=>$conversationtopicnew,"tutorid"=>$tutorid);
						if ($msg == "freesession")
						{
							$contentdata = $this->deepboxmessage_model->timeslot_book__mail($datarray,1);
							$tutorcontentdata = $this->deepboxmessage_model->timeslot_book__tutormail($tutordatarray,1);
						}
						else
						{
							$contentdata = $this->deepboxmessage_model->timeslot_book__mail($datarray,0);
							$tutorcontentdata = $this->deepboxmessage_model->timeslot_book__tutormail($tutordatarray,0);
						}
						$toemail = $profile["email"];
						//print_r($contentdata);
						$this->sendmailnew($contentdata["fromemailid"], $contentdata["fromname"], $toemail, $contentdata["subject"], $contentdata["msg"]);
						$toemail = $tutorProfile["email"];
						$this->sendmailnew($tutorcontentdata["fromemailid"], $tutorcontentdata["fromname"], $toemail, $tutorcontentdata["subject"], $tutorcontentdata["msg"]);
						$this->senddeepbox($this->user['uid'],$this->user['uid'],$contentdata["subject"],$contentdata["msg"]);
						$this->senddeepbox($tutorProfilenew["uid"],$this->user['uid'],$contentdata["subject"],$contentdata["msg"]);
					}
					if ($isrequest == 1)
					{
						$tutoruserdata = $this->user_model->getuserData($tutorid);
						$useruserdata = $this->user_model->getuserData($this->user['uid']);
						//echo $tutoruserdata["forwardemail"]." : ".$useruserdata["forwardemail"];
						if ($useruserdata["forwardemail"] == 1)
						{
							//$datarray = array("datetime"=>$starttime,"tutorname"=>$tutorProfilenew["firstName"]." ".$tutorProfilenew["midName"]." ".$tutorProfilenew["lastName"]);
							$datarray = array("datetime"=>$starttime,"tutorname"=>$tutorProfilenew["firstName"]."".$tutorProfilenew["uid"]);
							$contentdata = $this->deepboxmessage_model->timeslot_request__student($datarray);
							//$tutorcontentdata = $this->deepboxmessage_model->timeslot_request__tutor($datarray);
							$this->senddeepbox($this->user['uid'],$this->user['uid'],$contentdata["subject"],$contentdata["msg"]);
							//$datarrays = array("datetime"=>$times,"studentname"=>$profile["firstName"]." ".$profile["midName"]." ".$profile["lastName"],"tutorname"=>$tutorProfile["firstName"]." ".$tutorProfile["midName"]." ".$tutorProfile["lastName"],"speakinglevel"=>$sspeakinglevel,"conversationtopic"=>$conversationtopicnew);
							$datarrays = array("datetime"=>$times,"studentname"=>$profile["firstName"]." ".$profile["midName"]." ".$profile["lastName"],"tutorname"=>$tutorProfile["firstName"]."".$tutorProfile["uid"],"speakinglevel"=>$sspeakinglevel,"conversationtopic"=>$conversationtopicnew);
							if ($msg == "freesession")
							{
								$contentdata = $this->deepboxmessage_model->timeslot_request__student_mail($datarrays,1);
							}
							else
							{
								$contentdata = $this->deepboxmessage_model->timeslot_request__student_mail($datarrays,0);
							}
						}
						if ($tutoruserdata["forwardemail"] == 1)
						{
							$datarray = array("datetime"=>$starttime,"studentname"=>$profile["firstName"]."".$profile["uid"],"tutorid"=>$tutorid);							
							$contentdata = $this->deepboxmessage_model->timeslot_request__tutor($datarray);
							$this->senddeepbox($tutorid,$this->user['uid'],$contentdata["subject"],$contentdata["msg"]);
							//$datarrays = array("datetime"=>$times,"studentname"=>$profile["firstName"]." ".$profile["midName"]." ".$profile["lastName"],"tutorname"=>$tutorProfile["firstName"]." ".$tutorProfile["midName"]." ".$tutorProfile["lastName"],"speakinglevel"=>$sspeakinglevel,"conversationtopic"=>$conversationtopicnew);
							$datarrays = array("datetime"=>$times,"studentname"=>$profile["firstName"]."".$profile["uid"],"tutorname"=>$tutorProfile["firstName"]."".$tutorProfile["uid"],"speakinglevel"=>$sspeakinglevel,"conversationtopic"=>$conversationtopicnew);
							if ($msg == "freesession")
							{
								$contentdata = $this->deepboxmessage_model->timeslot_request__tutor_mail($datarrays,1);
							}
							else
							{
								$contentdata = $this->deepboxmessage_model->timeslot_request__tutor_mail($datarrays,0);
							}
						}
					   
						//$sdatarray = array("datetime"=>$starttime,"tutorname"=>$tutorProfilenew["firstName"]." ".$tutorProfilenew["midName"]." ".$tutorProfilenew["lastName"]);
						$sdatarray = array("datetime"=>$starttime,"tutorname"=>$tutorProfilenew["firstName"]."".$tutorProfilenew["uid"]);
						$studentcontentdata = $this->deepboxmessage_model->timeslot_request__student($sdatarray);
						$tdatarray = array("datetime"=>$starttime,"studentname"=>$profile["firstName"]."".$profile["uid"],"tutorid"=>$tutorid);
						//print_r($tdatarray);
						
						$tutorcontentdata = $this->deepboxmessage_model->timeslot_request__tutor($tdatarray);
						//print_r($tutorcontentdata);
						
						$toemail = $profile["email"];
						$this->sendmailnew($studentcontentdata["fromemailid"], $studentcontentdata["fromname"], $toemail, $studentcontentdata["subject"], $studentcontentdata["msg"]);
						$totutoremail = $tutorProfilenew["email"];
						$this->sendmailnew($tutorcontentdata["fromemailid"], $tutorcontentdata["fromname"], $totutoremail, $tutorcontentdata["subject"], $tutorcontentdata["msg"]);
					}
				}
                $config = $this->profile_model->getConfig();
                $configvalues = ((1+$config['VEE_PRICE_PERCENT']['value']) *100);
				$this->session->set_userdata('sessionbooked', 'y');
                $pdata = $this->user_model->getsesstioncostnew($kuid,$configvalues,$tutorid);				
				echo json_encode(array('success'=>$success,'msg'=>$msg,'firsttime'=>$firsttime,'cost'=>$cost,"isnew"=>$pdata["isnew"],"tutorcost"=>$pdata["tutorcost"],"schooltutorcost"=>$pdata["schooltutorcost"]));
            }
        }
        public function buyClassesnew12()
        {
            $kuid=$this->session->userdata['uid'];
			 
            $tutorid = $_POST["tutorid"];
            $divid = $_POST["diviid"];
            //echo $kuid." : ".$tutorid." : ".$divid;
            $permisson = $this->getPermission($tutorid);
            $isrequest = $_POST["isrequest"];
            $bookingtype = $_POST["bookingtype"];
            $SessionCost = $_POST["SessionCost"];
			$isaffi=$_POST["isaffi"];
			$cost = "";
			
			$this->load->model(array('profile_model'));
			$tutorProfile = $this->profile_model->getProfilenew($tutorid,$bookingtype);
			
            if($permisson !='teacher_public')
            {
                $success = 'false';
                $msg = 'nopermission';//You do not have permisson!';
            }
            else 
            {
                if(!$kuid)
                {
					$success = 'false';
					$msg = 'firstlogin';//You must login first!';
				}
				else
                {
                    $this->load->model(array('event_model','myTeacher_model','profile_model','user_model'));
                    $sspeakinglevel = $_POST["sspeakinglevel"];
                    $conversationtopic = $_POST["conversationtopic"];
                    $txtconversationtopic = $_POST["txtconversationtopic"];

                    if (($conversationtopic) == "Other")
                    {
                        $this->user_model->addtxtconversationtopic($kuid,$conversationtopic,$txtconversationtopic);
                    }
                    $times = $this->input->_request('seletedSlot');
                    $tmpstarttime = explode("_",str_replace("div","",$divid));
                    //print_r($tmpstarttime);
                    $starttime = $tmpstarttime[0]."-".$tmpstarttime[1]."-".$tmpstarttime[2]." ".$tmpstarttime[3].":".$tmpstarttime[4].":00";
                    $times = $starttime;
                    if($times == ''){
                        $times = array();
                    }
                    $tutorProfile = $this->profile_model->getProfilenew($tutorid,$bookingtype);

                    $tutorProfilenew = $this->profile_model->getProfile($tutorid);
                    $profile = $this->profile_model->getProfile($this->user['uid']);
                    $config = $this->profile_model->getConfig();
					$tutorProfile['hRate'] = round($tutorProfile['hRate'] * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
					$schoolId=$tutorProfile['school_id'];
					$s_markup=0;
					$s_pbalance=0;
					if($bookingtype==0)
					{
						$schoolId=0;
					}
					if($schoolId > 0)
					{
						$schoolmarkup=$this->profile_model->GetSchoolMarkup($schoolId);
						$s_markup=$schoolmarkup[0]['tutor_markup'];
						$s_pbalance=$schoolmarkup[0]['pbalance'];
					}
					//print_r($schoolmarkup);die();
					$trate=$tutorProfilenew['hRate'];

					if($bookingtype == 1 && $isaffi==1 && $s_pbalance > '10')
					{
						$pvt=1;
					}
					else
					{
						$pvt=0;
					}

                    //$s_markup=$tutorProfile['hRate']; 
                    if($profile['money'] < $tutorProfile['hRate']){
 
                            $success = false;
                            $msg = "enoughmoney";//You do not have enough money.";
                            $firsttime = $this->event_model->isFirstTimeStudentnew($this->user['uid']);
                            //added by haren new scope
                             $sssid=$this->user['uid'];
							$q= "SELECT exp_session,is_eligible from user where  user.id='{$sssid}'";
							$classquery = $this->db->query($q);				
							$classresult = $classquery->row_array();
							$cdate=date('Y-m-d');
							if($classresult['exp_session'] > $cdate && $classresult['is_eligible']==1)
								{ 
								 $success = true;
                                    $tutorProfile['hRate'] = 0;
                                    $msg = "freesession";//Free session has been booked";
                                    //foreach ($times as $key => $value) {
                                    //        echo $key." : ".$value;
                                    //        $this->event_model->creatClass($value,0,$this->user['uid'],$this->uid,$tutorProfile['hRate']);
                                    //}
									  
									$conf=0;
									if ($isrequest == 1)
									{
									}
									else
									{
										$conf=1;
									} 
									  
                                    $this->event_model->creatClassnew($times,0,$this->user['uid'],$tutorid,$tutorProfile['hRate'],$sspeakinglevel,$conversationtopic,$txtconversationtopic,$isrequest,$bookingtype,$trate,$s_markup,$pvt,$schoolId,$conf);
                                    $this->myTeacher_model->creatMyTeacher($this->user['uid'],$tutorid,0);
                                    $success = true;
								}
                            //$firsttime = $this->event_model->isFirstTimeStudent($this->user['uid']);
                    }
                    else{
							 
                            //echo "c";
                            $firsttime = $this->event_model->isFirstTimeStudentnew($this->user['uid']);
                            //foreach ($times as $key => $value) {
                            //        echo $key." : ".$value;
                            //        $this->event_model->creatClass($value,0,$this->user['uid'],$this->uid,$tutorProfile['hRate']);
                            //}
							$conf=0;
                            if ($isrequest == 1)
                            {
                                $msg = "successrequest";//Slot request has been registered";
                            }
                            else
                            {
                                $msg = "successbooking";//Slot has been booked";
								$conf=1;
                            }
                            //$msg = $msg."\nFrom your account $".$tutorProfile['hRate']." has been diducated";
							if($pvt==1)
							{	
								$tutorProfile['hRate']= 0;
							}
							 
                            $this->event_model->creatClassnew($times,0,$this->user['uid'],$tutorid,$tutorProfile['hRate'],$sspeakinglevel,$conversationtopic,$txtconversationtopic,$isrequest,$bookingtype,$trate,$s_markup,$pvt,$schoolId,$conf);
                            $this->myTeacher_model->creatMyTeacher($this->user['uid'],$tutorid,0);
                            $success = true;
                    }
				}
				if($success == true)
				{
					$this->session->set_userdata('free_session', 'n');
					$this->session->set_userdata('firstTime', 'n');
					$this->load->model("deepboxmessage_model");
					$this->load->model("inbox_model");
					$conversationtopicnew = "";
					if ($conversationtopic == "Other")
					{
						$conversationtopicnew = $txtconversationtopic;
					}
					else
					{
						$conversationtopicnew = $conversationtopic;
					}
					if ($isrequest == 0)
					{
						//echo "booking mail";
						//$datarray = array("datetime"=>$times,"studentname"=>$profile["firstName"]." ".$profile["midName"]." ".$profile["lastName"],"tutorname"=>$tutorProfile["firstName"]." ".$tutorProfile["midName"]." ".$tutorProfile["lastName"],"speakinglevel"=>$sspeakinglevel,"conversationtopic"=>$conversationtopicnew);
						$datarray = array("datetime"=>$times,"studentname"=>$profile["firstName"]."".$profile["uid"],"tutorname"=>$tutorProfile["firstName"]."".$tutorProfile["uid"],"speakinglevel"=>$sspeakinglevel,"conversationtopic"=>$conversationtopicnew);
						if ($msg == "freesession")
						{
							$contentdata = $this->deepboxmessage_model->timeslot_book__mail($datarray,1);
						}
						else
						{
							$contentdata = $this->deepboxmessage_model->timeslot_book__mail($datarray,0);
						}
						$toemail = $profile["email"];
						//print_r($contentdata);
						$this->sendmailnew($contentdata["fromemailid"], $contentdata["fromname"], $toemail, $contentdata["subject"], $contentdata["msg"]);
						$toemail = $tutorProfile["email"];
						$this->sendmailnew($contentdata["fromemailid"], $contentdata["fromname"], $toemail, $contentdata["subject"], $contentdata["msg"]);
						$this->senddeepbox($this->user['uid'],$this->user['uid'],$contentdata["subject"],$contentdata["msg"]);
						$this->senddeepbox($tutorProfilenew["uid"],$this->user['uid'],$contentdata["subject"],$contentdata["msg"]);
					}
					if ($isrequest == 1)
					{
						$tutoruserdata = $this->user_model->getuserData($tutorid);
						$useruserdata = $this->user_model->getuserData($this->user['uid']);
						//echo $tutoruserdata["forwardemail"]." : ".$useruserdata["forwardemail"];
						if ($useruserdata["forwardemail"] == 1)
						{
							//$datarray = array("datetime"=>$starttime,"tutorname"=>$tutorProfilenew["firstName"]." ".$tutorProfilenew["midName"]." ".$tutorProfilenew["lastName"]);
							$datarray = array("datetime"=>$starttime,"tutorname"=>$tutorProfilenew["firstName"]."".$tutorProfilenew["uid"]);
							$contentdata = $this->deepboxmessage_model->timeslot_request__student($datarray);
							//$tutorcontentdata = $this->deepboxmessage_model->timeslot_request__tutor($datarray);
							$this->senddeepbox($this->user['uid'],$this->user['uid'],$contentdata["subject"],$contentdata["msg"]);
							//$datarrays = array("datetime"=>$times,"studentname"=>$profile["firstName"]." ".$profile["midName"]." ".$profile["lastName"],"tutorname"=>$tutorProfile["firstName"]." ".$tutorProfile["midName"]." ".$tutorProfile["lastName"],"speakinglevel"=>$sspeakinglevel,"conversationtopic"=>$conversationtopicnew);
							$datarrays = array("datetime"=>$times,"studentname"=>$profile["firstName"]."".$profile["uid"],"tutorname"=>$tutorProfile["firstName"]."".$tutorProfile["uid"],"speakinglevel"=>$sspeakinglevel,"conversationtopic"=>$conversationtopicnew);
							if ($msg == "freesession")
							{
								$contentdata = $this->deepboxmessage_model->timeslot_request__student_mail($datarrays,1);
							}
							else
							{
								$contentdata = $this->deepboxmessage_model->timeslot_request__student_mail($datarrays,0);
							}
						}
						if ($tutoruserdata["forwardemail"] == 1)
						{
							//$datarray = array("datetime"=>$starttime,"studentname"=>$profile["firstName"]." ".$profile["midName"]." ".$profile["lastName"]);
							$datarray = array("datetime"=>$starttime,"studentname"=>$profile["firstName"]."".$profile["uid"]);
							$contentdata = $this->deepboxmessage_model->timeslot_request__tutor($datarray);
							$this->senddeepbox($tutorid,$this->user['uid'],$contentdata["subject"],$contentdata["msg"]);
							//$datarrays = array("datetime"=>$times,"studentname"=>$profile["firstName"]." ".$profile["midName"]." ".$profile["lastName"],"tutorname"=>$tutorProfile["firstName"]." ".$tutorProfile["midName"]." ".$tutorProfile["lastName"],"speakinglevel"=>$sspeakinglevel,"conversationtopic"=>$conversationtopicnew);
							$datarrays = array("datetime"=>$times,"studentname"=>$profile["firstName"]."".$profile["uid"],"tutorname"=>$tutorProfile["firstName"]."".$tutorProfile["uid"],"speakinglevel"=>$sspeakinglevel,"conversationtopic"=>$conversationtopicnew);
							if ($msg == "freesession")
							{
								$contentdata = $this->deepboxmessage_model->timeslot_request__tutor_mail($datarrays,1);
							}
							else
							{
								$contentdata = $this->deepboxmessage_model->timeslot_request__tutor_mail($datarrays,0);
							}
						}
					   
						//$sdatarray = array("datetime"=>$starttime,"tutorname"=>$tutorProfilenew["firstName"]." ".$tutorProfilenew["midName"]." ".$tutorProfilenew["lastName"]);
						$sdatarray = array("datetime"=>$starttime,"tutorname"=>$tutorProfilenew["firstName"]."".$tutorProfilenew["uid"]);
						$studentcontentdata = $this->deepboxmessage_model->timeslot_request__student($sdatarray);
						//$tdatarray = array("datetime"=>$starttime,"studentname"=>$profile["firstName"]." ".$profile["midName"]." ".$profile["lastName"]);
						$tdatarray = array("datetime"=>$starttime,"studentname"=>$profile["firstName"]."".$profile["uid"]);
						/*print_r($tdataarray);
						return fakl*/
						$tutorcontentdata = $this->deepboxmessage_model->timeslot_request__tutor($tdatarray);
						$toemail = $profile["email"];
						$this->sendmailnew($studentcontentdata["fromemailid"], $studentcontentdata["fromname"], $toemail, $studentcontentdata["subject"], $studentcontentdata["msg"]);
						$totutoremail = $tutorProfile["email"];
						/*print_r($tutorProfile['email']);
			exit;*/
						$this->sendmailnew($tutorcontentdata["fromemailid"], $tutorcontentdata["fromname"], $totutoremail, $tutorcontentdata["subject"], $tutorcontentdata["msg"]);
					}
				}
                $config = $this->profile_model->getConfig();
                $configvalues = ((1+$config['VEE_PRICE_PERCENT']['value']) *100);
				$this->session->set_userdata('sessionbooked', 'y');
                $pdata = $this->user_model->getsesstioncostnew($kuid,$configvalues,$tutorid);				
				echo json_encode(array('success'=>$success,'msg'=>$msg,'firsttime'=>$firsttime,'cost'=>$cost,"isnew"=>$pdata["isnew"],"tutorcost"=>$pdata["tutorcost"],"schooltutorcost"=>$pdata["schooltutorcost"]));
            }
        }
        public function sendmailnew($fromemail,$fromname,$toemail,$subject,$message)
        {
            $this->load->library('email');
            $this->email->mailtype = 'html';
            if (strlen(trim($fromname)) > 0)
            {
                $this->email->from($fromemail,$fromname);
            }
            else
            {
                $this->email->from($fromemail);
            }
            $this->email->to($toemail);
            $this->email->subject($subject);
            $this->email->message($message);
            //print_r($message);
            $this->email->send();
        }
        public function senddeepbox($toUid,$fromId,$subject,$message)
        {
            $create_at = date('Y-m-d H:i:s'); 		
            $sql = "INSERT INTO inbox (`toId`,`fId`,`subject`,`message`,`createAt`) VALUES ({$toUid},{$fromId},'{$subject}','{$message}','{$create_at}')";
            //echo $sql;
            return  $this->db->query($sql);
		}
		public function ajax_checkjp(){
			$checkType = $_GET['name'];
			
				switch($checkType){
					case  'username':$result = $this->user_model->checkUserName($checkType);break;
					case  'password':$result = $this->user_model->checkPassword($checkType);break;
					case  'email':$result = $this->user_model->checkEmail($checkType);break;
					default:$result = $this->user_model->checkUserName($checkType);break;
				}
				//$this->output->set_content_type('application/jsonp')->set_output(json_encode($result));
			echo $_GET['callback']. '(' . json_encode($result) . ');';	
		}
		
	public function LoadSessionType(){
		if(!$this->user){
			//redirect('user/login');
		}
		$data = array();
		$urluidnew = $this->input->_request('uid');
		if($this->uri->segment(4) != '' || $urluidnew != ''){
			$fsql = "SELECT u.email,p.firstName,p.lastName,u.id FROM user as u,profile as p where u.id = p.uid AND u.id = ".$this->uri->segment(4);
			$fquery = $this->db->query($fsql);
			$fresult = $fquery->row_array();
			$data['fresult'] = $fresult;
		}
		if(urldecode($this->input->_request('uid'))){
			$uidurl = urldecode($this->input->_request('uid'));
		}else{
			$uidurl = 0;
		}
		$data['uidurl'] = $uidurl;
		$this->load->view("user/send_message_load",$data);
	}
	public function GetMarkupByTut()
	{
		$ptn=$this->input->post('sdata');
		$tid=$this->input->post('tid');
		$Alldata=array();
		/*echo "test";
		exit;*/
		$Alldata=$this->user_model->Gettmarkup($ptn);
		
		$Alldata['tutor_markup'];

		$tutorProfile = $this->profile_model->getTutorRates($tid);
		$hrate = $tutorProfile['hRate']; 

	//	$Alldata=number_format(round($Alldata['tutor_markup'] * (1+$config['VEE_PRICE_PERCENT']['value']) * 100) /100,2,'.',''); 
		if($hrate == 0){
			$totalrate = 0;
		}else{
			$totalrate = $Alldata['tutor_markup'] + $hrate;
		}

		//echo json_encode($Alldata);
		echo json_encode(array('totalrate'=>$totalrate,'curr'=>$Alldata['curriculum']));
		die();
	}
	public function CheckIsnowSession()
	{
		$this->load->model(array('class_model'));
		$tid="tid";	 
		$classes=array();
		$classes = $this->class_model->GetTutorNext($this->uid,$tid);
		if($classes !=array())
		{
			$onceCall=$classes[0]['Is_Now'];
			if($onceCall==0)
			{ 	 
				$sql="update class set Is_Now=1 where id={$classes[0]['id']}";
				$this->db->query($sql);	
				echo json_encode(array('success'=>true));
			}
			else
			{
					echo json_encode(array('success'=>false));
			}
		}
		else
		{
				
				echo json_encode(array('success'=>false));
		}
	}
	
	public function relogin() {
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if($islogin){
			redirect('user/dashboard');
		}
		$this->load->helper('email');
		$user = array();
		$errorMsg = array();
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
		$arrVal = $this->lookup_model->getValue('1128', $multi_lang);
		$logmess = $arrVal[$multi_lang];	
		$errorMsg['error'] = $logmess;
		if($this->input->post()){
			$formData = $this->input->post();
			
			if($formData['email']==''){
				$errorMsg['error'] = 'email cannot empty';
			}else if(!valid_email($formData['email'])){
				$errorMsg['error'] = 'email is invalid';
			}else if($formData['password']==''){
				$errorMsg['error'] = 'password cannot empty';
			}else{
				$user = $userModel->loginByEmail($formData);
			}
			$arrVal = $this->lookup_model->getValue('887', $multi_lang);
			$emsg = $arrVal[$multi_lang];
			//insert to  the profile table
			if($user){
				
				$profile = $this->profile_model->getProfile($user['id']);

				$uinfo = array(
                    'username'=>$user['username'],
					'welcomeuser'=>$profile['firstName'] ,
                    'email'=>$user['email'],
                    'uid'=>$user['id'],
					'use'=>$user['id'],
					'user_type' => $user['user_type'],
					'free_session'=> $user['free_session'],					
					'pic'=>$profile['pic'],
				    'roleId'=>$user['roleId'],
					'firstTime'=>$user['user_firsttime']
				);
				$this->session->set_userdata($uinfo);
				if($user['roleId'] == 0 || $user['roleId'] == 1 || $user['roleId'] == 2 || $user['roleId'] == 3){
					redirect('user/dashboard');
				}
				if($user['roleId'] == 4){
					redirect('user/account');
				}
				if($user['roleId'] == 5){
					redirect('user/account');
				}
			}else{
				$errorMsg['error'] = $emsg;
			}
		}
		$this->layout->view('user/login',$errorMsg);
		}
		
		function updatefreeSession(){
			$id = $this->input->post('uid');			
			$cid = $this->input->post('clsid');
			//$cid = '3607';
			$cquery = "select is_completed,sid from disputes where cid=".$cid;
			$query = $this->db->query($cquery);
			$result = $query->row_array();

			if($result['is_completed'] == 0){
				$sql="update profile p set p.free_session='y',p.`is_eligible`='1' where p.uid=".$result['sid'];
				$this->db->query($sql);

				$classsql="update class set s_attend=0 where id={$cid}";
				$this->db->query($classsql);
			}
			exit;
		}
		
		public function studentPopup()
		{
			$this->layout->view('user/studentpopup');
		}
		public function tutorPopup()
		{
			//$this->layout->view('user/tutorpopup');
			$this->user_model->fnUpdateUser(array('universal_roleId'=>1,'roleId'=>1),array('id'=>$this->session->userdata('uid')));
			$this->session->set_userdata(array('roleId'=>1,'universal_roleId'=>1));
			$this->session->set_userdata('firstTimeRegister','yes');
			redirect("user/profile?step=1");
		}
		
		public function checkNext()
		{
			$this->load->model(array('class_model'));
			$tid="tid";	 
			$classes=array();
			//$classes = $this->class_model->GetTutorNext($this->uid,$tid);
			$classes = $this->class_model->GetComingSession($this->uid,$tid);
			if($classes !=array())
			{	 
				$start=$classes[0]['startTime'];
				$timeNow = date('Y-m-d H:i:s');
				$timeNowStr = strtotime($timeNow);
				$classTimeStr = strtotime($start);
				$classDiffInMin = round(($classTimeStr - $timeNowStr) / 60,2);
				 $Diff=round(abs($classTimeStr - $timeNowStr) / 60,2). " minute";
				
				if($Diff <=15  && $classes[0]['pageRefresh'] == 0 && $Diff >= 10)
				{ 	 $id=$classes[0]['id'];
					$sql="update class set pageRefresh=1 where id={$id}";
					$this->db->query($sql);	
					echo json_encode(array('success'=>true));
				}
				else
				{
						echo json_encode(array('success'=>false));
				}
			}
			else
			{
					
					echo json_encode(array('success'=>false));
			}
		}
		
	public function Apps()
	{
		$Apps =$this->user_model->getAllApps($uid);
		$this->layout->setData('app',$Apps);
		$this->layout->view('user/Apps');	
		
	}
	
	public function CheckForAbsent()
	{
		/*
		$this->load->model(array('inbox_model'));
		$nowTime = date('Y-m-d H:i:s');
		$new1=$expire_stamp = date('Y-m-d H:i:s', strtotime("+12 min"));
		$dt=date('Y-m-d');
		//$sql="select * from class where date(startTime)>='{$tdate}' and is_absent=0";
		$sql = "SELECT * from class  where  `startTime` >= '{$new1}' and date(startTime)='{$dt}' and is_absent=0 and s_attend=0 order by startTime";
		$query = $this->db->query($sql);
		
		if ($query->num_rows() > 0) 
		{
			$result = $query->result_array();
			for($i=0;$i< count($result);$i++)
			{
			
			
				if($result[$i]['s_attend'] == 0)
				{
					$toUid =$result[$i]['sid'];
					 
					$cid=$result[$i]['id'];
					
					$fromUid = 1;
					$subject = 'Absent from session';
					$message = 'We see you were absent from a session on TheTalkList.  Out of respect for the tutor’s time, your credits will be debited.  If you still wanted tutoring, then you could use Beepbox messaging to request a NOW session if your tutor is still online.';
					$send = $this->inbox_model->send($toUid,$fromUid,$subject,$message);
						
						$sql="update class set is_absent=1 where id='{$cid}'";
						$query = $this->db->query($sql);
						
				}
			}
		}
		*/
	}
	//added by haren to check user login from last 60 days
	public function LoginHistory()
	{
		$result= array();
		 
		$minDate=date('Y-m-d', strtotime('-2 days'));
		 $sql="SELECT uid, max(date) as lastLogin FROM login_history  GROUP BY uid";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
		$result= $query->result_array();
		 
			for($i=0; $i<count($result);$i++)
			{ 
						
				$newDt= date("Y-m-d", strtotime($result[$i]['lastLogin']));
				;
				if($newDt < $minDate )
				{
					$uId=$result[$i]['uid'] ;
					$sql="update user set  hiddenRole=1 where id='{$uId}'";
					$query = $this->db->query($sql);
				}
			}
		}
	
	}
	
	public function DownloadAttachment()
	{
		$uid=$this->uri->segment(3);
		if($uid !='')
		{
			$sql="select attach,toId from inbox where id='{$uid}'";
			$query = $this->db->query($sql);
			if ( $query->num_rows() > 0) {
				$result = $query->row_array();
			}
			if($result != array())
			{
			 
				$path=$result['attach'];
				$file=FCPATH.'attachment/'.$result['toId']."/".$path;
				//echo $file;die;
				$this->output_file($file,$path);
			}
		}
	}
	//count folder size added by haren
	public function foldersize($dir)
	{ 
		 $count_size = 0;
		 $count = 0;
		 $dir_array = scandir($dir);
		foreach($dir_array as $key=>$filename)
		{
				if($filename!=".." && $filename!=".")
				{
						if(is_dir($dir."/".$filename))
						{
							$new_foldersize = foldersize($dir."/".$filename);
							$count_size = $count_size + $new_foldersize[0];
							$count = $count + $new_foldersize[1];
						}
						else if(is_file($dir."/".$filename))
						{
							$count_size = $count_size + filesize($dir."/".$filename);
							$count++;
						}
				}
 
		}
 
		return array($count_size,$count);
	}
	public function sendInboxRemindMail($uid)
	{
				$profile =$this->profile_model->getProfile($uid);
				$str = "Hi, {$profile['firstName']}.{$profile['lastName']}\r\n<br/>";
				$str .= "\r\n<br/><br/><br/>";
				$str .= "You’ve reached your inbox storage capacity on TheTalkList.  Please clear space in your Beepbox under your account with TheTalkList.  In the meantime, we will delete your oldest messages to allow you to receive new messages.<br/>";
				$str .= "<br><br>Thank you,\r\n<br/>";
				$str .= "TheTalkList Support Team";
				$this->load->library('email');
				$this->email->mailtype = 'html';
				$this->email->from('admin@thetalklist.com','TheTalklist');
				$this->email->to($formData['email']);
				$this->email->subject('Sign-Up with TheTalkList.com by '.$formData['firstName']);
				$this->email->message($str);
				$this->email->send();
				
	}
	
	public function sent(){ 
		header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
		header('Pragma: no-cache');
		header('Expires: 0');
		if(!$this->user){
			redirect('user/login');
		}

		$permission = $this->getPermission($this->uid);
		
		if(strpos($permission,'public') > -1){
			$this->layout->view('user/invalid');
		}
		else{
			$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
     		 
			$this->layout->setData('linkType',$type);
		}
		$this->load->model(array('inbox_model'));
		$this->_profile();
		$this->load->library('pagination');

		$config['enable_query_strings'] = true;
		$config['uri_segment'] = 3;
		$config['page_query_string'] = false;
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = base_url('user/sent');
		$config['num_links'] = 4;
		$config['total_rows'] = $this->inbox_model->GetSentCount($this->user['uid']);
		$config['per_page'] = 10;
		$config['cur_tag_open'] = '<span class="current"><b>';
		$config['last_link'] = '&gt;&gt;';
		$config['first_link'] = '&lt;&lt;';

		$config['cur_tag_close'] = '</b></span>';
		//echo "<pre>"; print_r($config)
		$this->pagination->initialize($config);
		$page = (int)$this->uri->segment(3);
		if(!$page){
			$page = 1;
		}
		
		 $this->layout->setData('sents',$this->inbox_model->GetSentItem($this->user['uid'],$page));
		$this->layout->setData('pagination',$this->pagination->create_links());
		$this->layout->view('user/sentbox');
	}
	
	
	public function ViewsentItem(){
		if(!$this->user){
			redirect('user/login');
		}

		$permission = $this->getPermission($this->uid);
		if(strpos($permission,'public') > -1){
			$this->layout->view('user/invalid');
		}
		else{
			$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
			
			$this->layout->setData('linkType',$type);
		}
		$this->_profile();
		$this->load->model(array('inbox_model'));
		$id = $this->input->_request('id');
		 
		if(!$id){
			redirect('user/inbox');
		}
		$message = $this->inbox_model->GetMessageContent($this->user['uid'],$id);
		
		//echo "<pre>"; print_r($message);die;
	
		//$fsql = "SELECT email FROM user where id = ".$message['fId'];
		$fsql = "SELECT u.email,p.firstName,p.lastName,u.id FROM user as u,profile as p where u.id = p.uid AND u.id = ".$message['from'];
		$fquery = $this->db->query($fsql);
		$fresult = $fquery->row_array();
		$url=FCPATH."attachment/".$message['from']."/".$message['attach'];
		$size=filesize($url); 
		$size=$this->formatBytes($size,'2');
		$this->layout->setData('fresult',$fresult);
		$this->layout->setData('message',$message);
		$this->layout->setData('Size',$size);
		$this->layout->view('user/viewsentitem');
	}
	
	public function MessageSentPrev(){
	
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
		$arrVal = $this->lookup_model->getValue('1037', $multi_lang);
		$firstmsg = $arrVal[$multi_lang];
		$arrVal = $this->lookup_model->getValue('1038', $multi_lang);
		$lastmsg = $arrVal[$multi_lang];
			
		if(!isset($this->user['uid'])){
			echo json_encode(array('status'=>false,'msg'=>'Must login first!'));
			return;
		}
		$this->load->model(array('inbox_model'));
		$id = $this->input->_request('id');
		$type = $this->input->_request('type');
		$status = true;
		 
		//$return = array();
		if($type == 'prev'){
			$message = $this->inbox_model->getSentPrev($this->user['uid'],$id);
			 
			if(!$message){
				$message['msg'] = $firstmsg;
				$status = false;
			}
		}
		else{
			$message = $this->inbox_model->getNext($this->user['uid'],$id);
			if(!$message){
				$message['msg'] = $lastmsg;
				$status = false;
			}
		}
		$message['status'] = $status;

		echo json_encode($message);
		return;
	}
	
	
	public function DownloadAttach()
	{
		$uid=$this->uri->segment(3);
		
		if($uid !='')
		{
			$sql="select * from sentbox where sentbox_id='{$uid}'";
			$query = $this->db->query($sql);
			if ( $query->num_rows() > 0) {
				$result = $query->row_array();
			}
			if($result != array())
			{
			 
				$path=$result['attach'];
				$file=FCPATH.'attachment/'.$result['from']."/".$path;
				 
				$this->output_file($file,$path);
			}
		}
	}
	
	
	public function SendMessage(){
	
		if(!$this->user){
		
			redirect('user/login');
		}
		
		$urluidnew = urldecode($this->input->_request('uid'));
		 
		if($this->uri->segment(4) != '' || $urluidnew != '' && $_GET["message"]=='')
		{  
			$fsql = "SELECT u.email,p.firstName,p.lastName,u.id FROM user as u,profile as p where u.id = p.uid AND u.id = ".$this->uri->segment(4);
			//$fsql = "SELECT u.email,p.firstName,p.lastName,u.id FROM user as u LETF JOIN profile as p  on p.uid=u.id LEFT JOIN inbox on inbox.toid=u.id  where u.id = p.uid AND u.id = ".$this->uri->segment(4);
			$fquery = $this->db->query($fsql);
			$fresult = $fquery->row_array();
			$this->layout->setData('fresult',$fresult);
		} 
		$permission = $this->getPermission($this->uid);
	 
			$type = substr($permission,0,1).substr($permission,strpos($permission,'_'),strlen($permission)-strpos($permission,'_'));
			
			$this->layout->setData('linkType',$type);
	 
		$this->_profile();
		$subject = urldecode($this->input->_request('subject'));
		
		 
		$message = '';
		$username = urldecode($this->input->_request('username'));
		if($this->uid !='' && $this->uid != $this->user['uid']){
			$this->load->model('user_model');
			$user = $this->user_model->getByUid($this->uid);
			$username = $user['username'];
		}
		$messageId = $this->input->_request('mid');
		if($messageId != ''){
			$this->load->model('inbox_model');
			$inbox = $this->inbox_model->GetFwdDetail($this->user['uid'],$messageId);
			 
			$subject = 'Forward: '.$inbox['subject'];
			$message = $inbox['message'];;
			$attachment = $inbox['attach'];
			$messId=$inbox['id'];
			$UserId = $inbox['toId'];
		}if(urldecode($this->input->_request('email')))
		{
			$uidurl = urldecode($this->input->_request('email'));
		}else{
			$uidurl = 0;
		}
		if(urldecode($this->input->_request('uid')))
		{
			$uidurl = urldecode($this->input->_request('uid'));
		}else{
			$uidurl = 0;
		}
		$this->layout->setData('uidurl',$uidurl);
		$this->layout->setData('username',$username);
		$this->layout->setData('subject',$subject);
		$this->layout->setData('messId',$messId);
		
		$this->layout->setData('attachment',$attachment);
		$this->layout->setData('usersId',$UserId);
		$this->layout->setData('message',$message);
		$this->layout->view('user/send_message');
		 
	}
	
	
		public function sentNext(){
	
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
		$arrVal = $this->lookup_model->getValue('1037', $multi_lang);
		$firstmsg = $arrVal[$multi_lang];
		$arrVal = $this->lookup_model->getValue('1038', $multi_lang);
		$lastmsg = $arrVal[$multi_lang];
			
		if(!isset($this->user['uid'])){
			echo json_encode(array('status'=>false,'msg'=>'Must login first!'));
			return;
		}
		$this->load->model(array('inbox_model'));
		$id = $this->input->_request('id');
		$type = $this->input->_request('type');
		$status = true;
		 
		//$return = array();
		if($type == 'prev'){
			$message = $this->inbox_model->getSentPrev($this->user['uid'],$id);
			 if(!$message){
				$message['msg'] = $firstmsg;
				$status = false;
			}
		}
		else{
			$message = $this->inbox_model->getSentNext($this->user['uid'],$id);
			if(!$message){
				$message['msg'] = $lastmsg;
				$status = false;
			}
		}
		$message['status'] = $status;

		echo json_encode($message);
		return;
	}
	
	public function DeleteSentItem(){
		if(!isset($this->user['uid'])){
			echo json_encode(array('status'=>false,'msg'=>'Must login first!'));
			return;
		}
		$this->load->model(array('inbox_model'));
		$id = $this->input->_request('id');
		$del = $this->inbox_model->deleteSentItem($this->user['uid'],$id);
		echo json_encode(array('status'=>$del,'msg'=>'Please contact to admin!'));
		return;
	}
		
		public function ReffralPage()
		{
		
				$this->layout->view('user/ReffralPage');
		}
		
	public function CheckDiffrence()
	{
		$this->load->model(array('class_model'));
		$cid=$this->input->_request('cid');
		$result=array();
		$Class = $this->class_model->GetDiffrance($cid);
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
			$end=$end+(60*3);
			//echo $start."<br>";
			$end=date("Y-m-d H:i:s", $end);
			
			if($Diff <=15 && $Diff >=0)
			{
				if($dt >= $start)
				{	
						echo json_encode(array('success'=>true,'NoofParticipant'=>$Class['NoofParticipant'],'diff'=>'-1'));
				}
				else
				{
				
					echo json_encode(array('success'=>true,'NoofParticipant'=>$Class['NoofParticipant'],'diff'=>$Diff));
				}					
			}
			else if($dt >= $start && $dt<=$end)
			{ 
				echo json_encode(array('success'=>true,'NoofParticipant'=>$Class['NoofParticipant'],'diff'=>'-1'));
			}
			else
			{
				echo json_encode(array('success'=>false));
			} 
		}
		
		else
			{
				echo json_encode(array('success'=>false));
			} 
	}

	public function sendReglink($detail)
	{
		$uid=base64_encode($detail['uid']);
		$str = "<b>Welcome to TheTalkList.com, where you will earn money as your referrals learn to speak like a native!</b> We have worked hard at building the best 1 to 1 learning environment. Learning a language will be more convenient than ever.\r\n<br/>";
		$str .= "\r\n<br/>";
		$str .= "\r\n<br/>";
		$str .= "Your login information:\r\n<br/>";
		$str .= "Email: {$detail['email']}\r\n<br/>";
		$str .= "Password: {$detail['password']}\r\n<br/>";
		$str .= "\r\n<br/>";
		$str .= "Please click on below link to activate your account: <a target='_blank' href='".base_url('user/confirm?confrim='.$uid)."'>Confirmation Link</a>\r\n<br/>";
		$str .= "<a>".base_url('user/confirm?confrim='.$uid)."</a>\r\n<br/>";
		$str .= "\r\n<br/>";
		$str .= "Thank you,\r\n<br/>";
		$str .= "TheTalkList Support Team";
		
		$this->load->library('email');
		$this->email->mailtype = 'html';
		$this->email->from('admin@thetalklist.com','TheTalklist');
		$this->email->to($formData['email']);
		$this->email->subject('Sign-Up with TheTalkList.com by '.$formData['firstName']);
		$this->email->message($str);
		$this->email->send();
	}

	public function confirm()
	{
		$this->load->model(array('user_model'));

		if(isset($_GET['confrim']))
		{
			$uid=base64_decode($_GET['confrim']);

			if(is_numeric($uid) && $uid !='')
			{	
				  $detail=$this->user_model->GetDetail($uid);
				 $this->session->set_userdata('RegLink','');
				 
				 $this->session->set_userdata('isnew1','new1');
				 $this->session->set_userdata('ancode','y');			

				 redirect('user/login');
			}
			else
			{
				$this->session->set_userdata('RegLink','Invalid Reference link.');
				redirect(base_url());
			}
		}
		else
		{
			redirect(base_url());
		}		
	
	}
	
	public function getcountrycode()
	{
		$this->load->model(array('location_model'));
		$id=$this->input->post('cid');
		$cdata=$this->location_model->DogetCountrycode($id);
		echo json_encode($cdata);
		die;
	}
	
	/* Added By Ilyas // Cron Job Function*/ 
	public function chkUserIdle()
	{
		$this->load->library('session');
		$qry=$this->db->query("SELECT DISTINCT `uid` FROM `ci_sessions` where  TIMESTAMPDIFF(HOUR, from_unixtime(`last_activity`), now()) > 2 ORDER BY `ci_sessions`.`uid` DESC");
		$result=$qry->result_array();
		foreach($result as $user){
			$query = $this->db->query("update `user` set `is_login` = '0', `readytotalk` = '0' where `id` = '".$user['uid']."'");
		}
	}	 
	/* End */
	
	// If Tutor doesn't have open calendar sessions for last 2 weeks, send weekly email reminder Applies to all Talkist Tutor roles. - Every Monday email will be fired.
		public function calWeeklyEmail()
		{
			$this->load->model(array('messaging_model'));
			$this->load->library(array('session','email'));
			$qry=$this->db->query("SELECT `user`.`id`,`email` from `user` where `roleId` IN (1,2,3) and `id` NOT IN (SELECT `uid` from `timeSlot` JOIN `user` on `timeSlot`.`uid` = `user`.`id` where `roleId` IN (1,2,3) GROUP BY `uid`  HAVING MAX(`startTime`) >= DATE_SUB(now(), INTERVAL 2 WEEK) order by `uid` ASC,`startTime` DESC) order by `id` ASC");
			$result=$qry->result_array();
			
			$ns = $this->messaging_model->getAllNewsletter();
			$newslettertemplate = array();
			if(count($ns)>0)
			{
				$newslettertemplate = $ns[0];
			}
			foreach($result as $user){
				// Send Email
				$this->email->clear();
				$str = "";
				$name = trim($this->messaging_model->getUserName($user['id']));
				$str .= str_replace('{$name}',$name,nl2br(@$newslettertemplate['n1']));
				$this->email->mailtype = 'html';
				$this->email->from('no-reply@thetalklist.com','TheTalkList Admin');
				$this->email->subject('Open Calendar Sessions ');
				$this->email->message($str);
				$this->email->to($user['email']);
				$this->email->send();
			}
		}	

		// If New student has registered but not taken a group session. Applies to Students only. - Every Tuesday email will be fired.
		public function grpSessionEmail()
		{
			$this->load->model(array('messaging_model'));
			$this->load->library(array('session','email'));
			$qry=$this->db->query("SELECT `id`,`email` from `user` where `roleId` = 0 and `id` NOT IN (select DISTINCT `userId` from `groupattandance` order by `userId`) order by `id`");
			$result=$qry->result_array();
			
			$ns = $this->messaging_model->getAllNewsletter();
			$newslettertemplate = array();
			if(count($ns)>0)
			{
				$newslettertemplate = $ns[0];
			}
			foreach($result as $user){
				// Send Email
				$this->email->clear();
				$str = "";
				$name = trim($this->messaging_model->getUserName($user['id']));
				$str .= str_replace('{$name}',$name,nl2br(@$newslettertemplate['n3']));
				$this->email->mailtype = 'html';
				$this->email->from('no-reply@thetalklist.com','TheTalkList Admin');
				$this->email->subject('Book Group Session ');
				$this->email->message($str);
				$this->email->to($user['email']);
				$this->email->send();
			}
		}
		
		// If student has taken free group session but has not loaded their account with credits, send weekly email reminder. Applies to Students only. - Every Wednesday email will be fired.
		public function acCreditEmail()
		{
			$this->load->model(array('messaging_model'));
			$this->load->library(array('session','email'));
			$qry=$this->db->query("SELECT `user`.`id`,`user`.`email` from `user` join `profile` on `uid` = `user`.`id` where `user`.`roleId` = '0'  and `profile`.`money`<='0' and `user`.`id` IN ( select DISTINCT `userId` from `groupattandance` order by `userid`)");
			$result=$qry->result_array();
			
			$ns = $this->messaging_model->getAllNewsletter();
			$newslettertemplate = array();
			if(count($ns)>0)
			{
				$newslettertemplate = $ns[0];
			}
			foreach($result as $user){
				// Send Email
				$this->email->clear();
				$str = "";
				$name = trim($this->messaging_model->getUserName($user['id']));
				$str .= str_replace('{$name}',$name,nl2br(@$newslettertemplate['n4']));
				$this->email->mailtype = 'html';
				$this->email->from('no-reply@thetalklist.com','TheTalkList Admin');
				$this->email->subject('Fill your account with credits ');
				$this->email->message($str);
				$this->email->to($user['email']);
				$this->email->send();
			}
		}	

	//  If Student has not booked a session for last 2 weeks, send weekly email reminder Applies to Students only. - Every Thursday email will be fired.
	public function bookedSessionEmail()
	{
		$this->load->model(array('messaging_model'));
		$this->load->library(array('session','email'));
		$qry=$this->db->query("SELECT `id`,`email` from `user` where `roleId` = '0' and `id` NOT IN (SELECT `sid` from `class` GROUP BY `sid` HAVING MAX(`startTime`) >= DATE_SUB(now(), INTERVAL 2 WEEK) order by `sid` ASC) order by `id` ASC");
		$result=$qry->result_array();
		
		$ns = $this->messaging_model->getAllNewsletter();
		$newslettertemplate = array();
		if(count($ns)>0)
		{
			$newslettertemplate = $ns[0];
		}
		foreach($result as $user){
			// Send Email
			$this->email->clear();
			$str = "";
			$name = trim($this->messaging_model->getUserName($user['uid']));
			$str .= str_replace('{$name}',$name,nl2br(@$newslettertemplate['n5']));
			$this->email->mailtype = 'html';
			$this->email->from('no-reply@thetalklist.com','TheTalkList Admin');
			$this->email->subject('Book Free Session ');
			$this->email->message($str);
			$this->email->to($user['email']);
			$this->email->send();
		}
	}	
	
	//  Accounts created but not validated.
	public function unConfirmUserEmail()
	{
		$this->load->model(array('messaging_model'));
		$this->load->library(array('session','email'));
		$qry = $this->db->query("SELECT `user`.`id`,`user`.`email`,`profile`.`firstName`,`profile`.`lastName` from `user` join `profile` on `profile`.`uid` = `user`.`id` where `user`.`roleId` IN (1,2,3) and `user`.`isconfirmedAccount`='0' order by `user`.`id`");
		$result=$qry->result_array();
		
		$ns = $this->messaging_model->getAllNewsletter();
		$newslettertemplate = array();
		if(count($ns)>0)
		{
			$newslettertemplate = $ns[0];
		}
		foreach($result as $user){
			// Send Email
			$this->email->clear();
			$str = "";
			$name = trim($user['firstName']." ".$user['lastName']);
			$str .= str_replace('{$name}',$name,nl2br(@$newslettertemplate['n12']));
			$this->email->mailtype = 'html';
			$this->email->from('no-reply@thetalklist.com','TheTalkList Admin');
			$this->email->subject('Accounts created but not validated.');
			$this->email->message($str);
			$this->email->to($user['email']);
			$this->email->send();
		}
	}	
		
	//  Message every week when tutor has incomplete profile Applies to all Talkist Tutor roles. - Every Friday email will be fired.
	public function inCompleteProfileEmail()
	{
		$this->load->model(array('messaging_model'));
		$this->load->library(array('session','email'));
		$qry=$this->db->query("SELECT `user`.`id`,`user`.`email`,`profile`.`firstName`,`profile`.`lastName`  from `user` join `profile` on `profile`.`uid` = `user`.`id` where `user`.`roleId` IN (1,2,3) and (`profile`.`pic` ='' or  `profile`.`vedio` ='' or `profile`.`pic` ='' or `profile`.`personal` ='' or `profile`.`professional` ='' or `profile`.`academic` ='') order by `user`.`id`");
		$result=$qry->result_array();
		
		$ns = $this->messaging_model->getAllNewsletter();
		$newslettertemplate = array();
		if(count($ns)>0)
		{
			$newslettertemplate = $ns[0];
		}
		$userEmails = array();
		foreach($result as $user){
			// Send Email
			$this->email->clear();
			$str = "";
			if (!in_array($user['email'],$userEmails)) {
				array_push($userEmails,$user['email']);
				//$name = trim($this->messaging_model->getUserName($user['id']));
				$name = trim($user['firstName']." ".$user['lastName']);
				$str .= str_replace('{$name}',$name,nl2br(@$newslettertemplate['n9']));
				$this->email->mailtype = 'html';
				$this->email->from('no-reply@thetalklist.com','TheTalkList Admin');
				$this->email->subject('Hey! You need to complete your profile on TheTalkList!');
				$this->email->message($str);
				$this->email->to($user['email']);
				//$this->email->to('ilyas.jinia@gmail.com');
				$this->email->send();
			}
		}
	}		

	public function testCron()
	{
		$this->load->model(array('messaging_model'));
		$this->load->library(array('session','email'));
		$qry=$this->db->query("SELECT `user`.`id`,`user`.`email`,`profile`.`firstName`,`profile`.`lastName`  from `user` join `profile` on `profile`.`uid` = `user`.`id` where `user`.`roleId` IN (1,2,3) and (`profile`.`pic` ='' or  `profile`.`vedio` ='' or `profile`.`pic` ='' or `profile`.`personal` ='' or `profile`.`professional` ='' or `profile`.`academic` ='') order by `user`.`id`");
		$result=$qry->result_array();
		
		$ns = $this->messaging_model->getAllNewsletter();
		$newslettertemplate = array();
		if(count($ns)>0)
		{
			$newslettertemplate = $ns[0];
		}
		
		$userEmails = array();
		foreach($result as $user){
			// Send Email
			$this->email->clear();
			$str = "";
			if (!in_array($user['email'],$userEmails)) {
				array_push($userEmails,$user['email']);
				//$name = trim($this->messaging_model->getUserName($user['id']));
				$name = trim($user['firstName']." ".$user['lastName']);
				$str .= str_replace('{$name}',$name,nl2br(@$newslettertemplate['n9']));
				$this->email->mailtype = 'html';
				$this->email->from('no-reply@thetalklist.com','TheTalkList Admin');
				$this->email->subject('Hey! You need to complete your profile on TheTalkList! - '.$user['id']);
				$this->email->message($str);
				$this->email->to('ilyas.jinia@gmail.com');
				//$this->email->to($user['email']);
				$this->email->send();
			}
		}
	}
				
		/* End */
		
	public function delArchive()
	{
		$archiveId = $this->input->post('archiveId');
		if ($archiveId) {
			$this->load->model('lesson_model');
			$this->lesson_model->delArchiveVideo($archiveId);
		}
		return true;
	}	
	
	// Cashout Function - Ilyas
	function cashout()
	{
		if(!$this->user){
			redirect('user/login');
		}
		$uid = $this->session->userdata['uid'];
		$this->load->library('session');
		$this->load->helper('form');
		$this->_profile();
		if ($this->input->post('trnAmount')) {
			$tdate=date("Y-m-d");
			//$this->session->set_userdata('alertstatus', '1');
			/* Insert Transaction Entry By Ilyas */
			$this->load->model(array('user_model'));
			$nw = date("Y-m-d H:i:s");
			$payAmount = $this->input->post('trnAmount');
			$record = array(
				  'user_id' 		=> 	$uid,
				  'amount'		 	=> 	$payAmount,
				  'amount_status' 	=> 	'debit',
				  'type' 			=> 	'Cashout',
				  'payment_status' 	=> 	'Paid',
				  'payment_date' 	=> 	$nw,
				  'summary' 		=> 	"Cashout by User($uid)",
				  'status'			=>	"Pending",
				  'status_comment'	=>	"Cashout pending by Paypal" 
			);
			
			$this->user_model->fnInsertTransaction($record); 	// Insert Transaction Entry
			$this->user_model->fnUpdateProfileCashout($payAmount,array("uid"=>$uid));	//	Update Profile Money
			$this->session->set_userdata('alertstatus', '2');
			// Update Profile Paypal Account
			$formData["payment_account"] = $this->input->post("payment_account");
			$formData['uid'] = $uid;
			$this->profile_model->update($formData);
		}
		redirect("user/account");
	}
	
	// Cashout Cronjob 
	public function cronCashout() 
	{
		$this->load->model(array('pay_model','profile_model','user_model'));
		$results = $this->user_model->fnGetPendingCashout();
		if (sizeof($results)>0) {
			require_once(FCPATH.'/paypal/samples/PPBootStrap.php');	
			foreach($results as $result)
			{
				$uid		= $result['user_id'];					
				$payAmount	= $result['amount'];
				$res = $this->profile_model->getProfile($uid);
				$logger = new PPLoggingManager('MassPay');
				$massPayRequest = new MassPayRequestType();
				$massPayRequest->MassPayItem = array();
				$masspayItem = new MassPayRequestItemType();
				$masspayItem->Amount = new BasicAmountType('USD',  $payAmount);
				$masspayItem->ReceiverEmail = '';//$res['payment_account'];
				$massPayRequest->MassPayItem[] = $masspayItem;
				$massPayReq = new MassPayReq();
				$massPayReq->MassPayRequest = $massPayRequest;
				$paypalService = new PayPalAPIInterfaceServiceService();
				try {
					$massPayResponse = $paypalService->MassPay($massPayReq);
				} catch (Exception $ex) {
					/*include_once("../Error.php");
					exit;*/
				}
				if(isset($massPayResponse)) {
					$nw = date("Y-m-d H:i:s");
					if($massPayResponse->Ack == 'Success'){
						$record = array(
						  'summary' 		=> 	"Cashout by User($uid) and Payment Success by Paypal on Date $nw",
						  'status'			=>	"Done",
						  'status_comment'	=>	"Cashout Done with ".$massPayResponse->CorrelationID." and Date = $nw" 
						);
						//	Update Transaction Entry
						$this->user_model->fnUpdateTransaction($record,array('id'=>$result['id']));
						//	Update Profile Money
						//$this->user_model->fnUpdateProfileCashout($payAmount,array("uid"=>$uid));
						/* End */
					} else {
						$record = array(
						  'summary' 		=> 	"Cashout by User($uid) and Payment Failed by Paypal on Date $nw",
						  'status'			=>	"Failed",
						  'status_comment'	=>	"Cashout Failed by Paypal on Date $nw" 
						);
						//	Update Transaction Entry
						$this->user_model->fnUpdateTransaction($record,array('id'=>$result['id']));
						
						$insRecord = array(
							  'user_id' 		=> 	$uid,
							  'amount'		 	=> 	$payAmount,
							  'amount_status' 	=> 	'credit',
							  'type' 			=> 	'Cashout',
							  'payment_status' 	=> 	'Refund',
							  'payment_date' 	=> 	$nw,
							  'summary' 		=> 	"Cashout by User($uid) and Payment Failed by Paypal on Date $nw",
							  'status'			=>	"Failed",
							  'status_comment'	=>	"Cashout Failed by Paypal on Date $nw and Refund Credits to User Account",
							  'inner_rel_id' 	=> 	$result['id'] 
						);
						// Insert Transaction Entry
						$this->user_model->fnInsertTransaction($insRecord);
						//	Update Profile Money
						$this->user_model->fnUpdateProfileCashout(($payAmount*(-1)),array("uid"=>$uid));
					}					
				}
			}
		}
	}

	public function signup() {
		$userModel =  $this->user_model;
		$islogin = $userModel->islogin();
		if($islogin){
			redirect('user/dashboard');
		}
		$this->layout->view('user/signup');
	}
	
	// call Function After Paymentwall Payment Success
	public function successpayment(){
		$this->session->set_userdata('successpayment', '1');
    	?>
		<script type="text/javascript">
    	window.parent.location.href = '<?php echo base_url("user/account");?>';
		</script>
		<?php
		exit;
    }
	
	// User Monthly Opn Bal Cron Job
	public function cronOpBal(){
		$this->load->model(array('user_model','class_model'));
		$users = $this->user_model->fnGetAllUser();	
		$curdate = date('Y-m-d');
		$prevMonth = date("m-Y",strtotime($curdate.' -1 months'));
		$userdata= array();
		if ($users) {
			$i = 0;
			foreach ($users as $userVal) {
				
				// Opening Balance of Month
				$opBal = $this->user_model->fnGetOpBal($userVal['uid'], $prevMonth); // UserId & CurrMonth&Year
				$userdata[$i]['opBal'] =  ($opBal) ? $opBal : 0;
				
				// Total Amount addition in Month
				$addBal = $this->user_model->fnGetMonthBal($userVal['uid'],$prevMonth,"credit");	
				$userdata[$i]['addBal'] =  ($addBal) ? $addBal : 0;
				
				// Total Amount deduction in Month
				$subBal = $this->user_model->fnGetMonthBal($userVal['uid'],$prevMonth,"debit");
				$userdata[$i]['subBal'] =  ($subBal) ? $subBal : 0;
				
				// End Balance of Month
				$userdata[$i]['endBal'] =  $userdata[$i]['opBal'] + $userdata[$i]['addBal'] - $userdata[$i]['subBal'];
				
				// Insert OpBal of CurMonth
				$this->user_model->fnInsOpBal(array(
					'uid'	=>  $userVal['uid'],
					'month' =>  date("Y-m-d"),
					'op_bal'=> 	$userdata[$i]['endBal']
				));
				
				$this->user_model->fnUpEndBal(array(
					'uid'	=>  $userVal['uid'],
					'month' =>  $prevMonth,
					'end_bal'=> $userdata[$i]['endBal']
				));
				
				$i++; // Increment Data index
			}
		}
	}
	
	/* FB Login Check */
	public function fblogin(){
	    $user = "";
		$this->load->library('session');
	    $this->load->library('facebook');
	    $userId = $this->facebook->getUser();        
        if ($userId) {
            try {
                $user = $this->facebook->api('/me?fields=name,email,first_name,last_name,id');
            } catch (FacebookApiException $e) {
                $user = "";
            }
        }else {
            $this->facebook->destroySession();
        }
        if($user!="") :      
			$userdata = $this->user_model->fnFacebookUser($user['id'], $user['email']);
			if(empty($userdata)) : 
				$formData['isconfirmedAccount'] = '1';
				$formData['firstName'] = $user['first_name']; 
				$formData['lastName'] = $user['last_name']; 
				$formData['username'] = $user['email']; 
				$formData['email'] = $user['email']; 
				$formData['facebook_id'] = $user['id'];		
				$formData['universal_roleId'] = '0';
				$formData['free_session'] = 'y';
				$formData['is_eligible'] = '1';
				$formData['testAccount'] = '0';
				$formData['roleId'] = '0';
				$ipInfoSESSION = $this->geolocater->getMaxMindlocation();
				/* Add Timezone */
				$formData['timezone'] = $ipInfoSESSION['time_zone'];
				// Insert User Data
				$uid = $this->user_model->register($formData);
				
				$formData['uid'] = $uid;
				$formData['new'] = 1;
				$formData['alerts'] = 30;
				$formData['textalert'] = 30;
				$formData['alertType'] = '11';
				
				/*$ip = "122.170.115.66, 204.246.166.85";
				$Ip = explode(",",$ip);
				$realIp=$Ip[0];
				$cname ='IN';
				$sql = "Select id from countries where iso2 = '{$cname}'";
				$query = $this->db->query($sql);
				$cresult = $query->result_array();
				$cid = $cresult[0]['id'];*/
				$formData['country'] = "";
				$formData['ipaddress'] = $_SERVER['REMOTE_ADDR'];
				$formData['school_id'] = '0';
				$formData['hRate'] = '3.76';
				$formData['nativeLanguage'] = "English";
				if (isset($_SESSION['multi_lang_name'])) { 
					$formData['nativeLanguage'] = $_SESSION['multi_lang_name'];
				}
				$this->profile_model->save($formData); // Insert Profile Data
				$uinfo = array(
					'username'=>$formData['username'],
					'welcomeuser'=>$formData['firstName'] ,
					'email'=>$formData['email'],
					'uid'=>$uid,
					'use'=>$uid,
					'user_type' => '',
					'free_session'=> 'y',					
					'pic'=>'',
					'roleId'=>'0',
					'firstTime'=>'y',
					'universal_roleId'=>'0'
				);
				$query = $this->db->query("update user set  is_login=1 where id='{$uid}'");
				$this->session->set_userdata($uinfo);
				$this->session->set_userdata('firstTimeRegister','yes');
				$this->session->set_userdata('sturegister','yes');
				redirect(base_url('user/studentPopup')); 
				exit;      		
			else :    
				
				$uinfo = array(
					'username'=>$userdata['username'],
					'welcomeuser'=>$userdata['firstName'] ,
					'email'=>$userdata['email'],
					'uid'=>$userdata['uid'],
					'use'=>$userdata['uid'],
					'user_type' => '',
					'free_session'=> $userdata['free_session'],					
					'pic'=>$userdata['pic'],
					'roleId'=>$userdata['roleId'],
					'firstTime'=>$userdata['firstTime'],
					'universal_roleId'=>$userdata['universal_roleId']
				);    
				$this->session->set_userdata($uinfo);
				redirect(base_url('user/dashboard'));
				exit;
			endif;
        else :
            $data['login_url'] = $this->facebook->getLoginUrl(array('redirect_uri' => base_url('index'), 
			'scope' => array("email")));
        endif;
        redirect(base_url());
        
    }
	
	// Insert Topic from Dashoard to Recent_search Table
	function ajax_insTopic()
	{
		if ($this->input->post("selTopic")) {
			$selTopic = $this->input->post("selTopic");
			$this->user_model->insTopic(array("user_id"=>$this->user['uid'],"topic"=>$selTopic));
			return;
		}
	}
	
	function twiliosms(){
		$this->load->library('twilio');
		$from = '+16193774807';
		$to = '+919998978397';
		$message = 'This is testing';

		$response = $this->twilio->sms($from, $to, $message);
		print_r($response);
		if($response->IsError){
			$error = $response->ErrorMessage;
		}else{
			$error = '';
		}
	}
	/* End */	
}?>	