<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multi_model extends TL_Model{

	public function __construct(){
		parent::__construct();
	}
	public function getAll($page = 1,$perPage = 10) {
		$start = intval($page - 1) * $perPage;
		$nowTime = date('Y-m-d H:i:s');
		$sql = "SELECT * from class  where startTime > '{$nowTime}' AND type = 'general' limit {$start},{$perPage}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getAllComming($page = 1,$perPage = 10) {
		$start = intval($page - 1) * $perPage;
		$nowTime = date('Y-m-d H:i:s');
		$sql = "SELECT id,tid,sid from class  where  startTime > '{$nowTime}' AND alerted = 0 AND type = 'general' AND confirmby = '1' limit {$start},{$perPage} ";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getHistory($uid,$type="month"){
	
		if($uid == ''){
			return array();
		}
		$sql = "SELECT class.*, tProfile.firstName as tFN,tProfile.lastName as tLN,sProfile.firstName as sFN,sProfile.lastName AS sLN FROM class LEFT JOIN profile AS tProfile ON tProfile.uid = class.tid LEFT JOIN profile AS sProfile ON sProfile.uid = class.sid";
		if($type=="all"){
			$sql .= " where (tid={$uid} or sid={$uid} or class.school_id={$uid}) and endTime < now() and s_attend =1 order by endTime desc";
		}else if($type == 'month'){
			$sql .= "  where (tid={$uid} or sid={$uid} or class.school_id={$uid}) and month(endTime) = month(curdate())  and year(endTime) = year(curdate()) and s_attend =1 order by endTime desc";		
		}else if($type == 'year'){
			$sql .= "  where (tid={$uid} or sid={$uid} or class.school_id={$uid}) and  year(endTime) = year(curdate()) and s_attend =1 order by endTime desc";		
		}else{
			$sql .= " class where (tid={$uid} or sid={$uid} or class.school_id={$uid}) and endTime between date_sub(now(),interval 1 {$type}) and now() and s_attend =1 order by endTime desc" ;
		}
		$result = array();
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		
		return $result;
	}
	public function getByTid($tid,$page = 1,$perPage = 100) {
		$start = intval($page - 1) * $perPage;
		$nowTime = date('Y-m-d H:i:s');
		$sql = "SELECT  class.*,profile.firstName,profile.lastName,profile.pic from class left join profile on  class.sid = profile.uid where tid={$tid} and `endTime` > '{$nowTime}'  and (type='now' || confirmby=1) order by startTime asc limit {$start}, {$perPage}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getBySid($sid,$page = 1,$perPage = 100) {
	$nowTime = date('Y-m-d H:i:s');
	$start = intval($page - 1) * $perPage;
	$sql = "SELECT class.*,profile.firstName,profile.lastName,profile.pic from class left join profile on  class.tid = profile.uid  where sid={$sid} and `endTime` > '{$nowTime}'  and (type='now' || confirmby=1) order by startTime asc limit {$start}, {$perPage}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getNearClassByUid($uid){
		if(!$uid){
			return array();
		}
		$nowTime = date('Y-m-d H:i:s');
		$sql = "select class.* ,t.firstName as tf,t.lastName as tl,t.pic as tp,s.firstName as sf,s.lastName as sl,s.pic as sp from class left join profile as s on  class.sid = s.uid left join profile as t on  class.tid = t.uid where `endTime`>'{$nowTime}' and (tid={$uid} or sid={$uid}) order by `startTime` asc limit 0,1";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	public function getNearClassById($id){ 
		if(!$id){
			return array();
		}
		$sql = "select * from gropsession where gropsessionId='{$id}' limit 0,1";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function getAllDetail($uid)
	{
		$sql = "select pic,uid,firstName,lastName from profile  where uid='{$uid}' limit 0,1";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
		
	}
	
	public function GetTutorDetail($tutId)
	{
		$sql = "select pic,uid,firstName,lastName from profile  where uid='{$tutId}' limit 0,1";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	public function upSession($class,$session_id='',$token='',$tokent=''){
		 $gsid=$class['gropsessionId'];
		 $start=$class['Time'];
		 $end=$class['endTime'];
		 //print_r($class);die;
		 $selquery="select * from multisession where groupsessionId ={$gsid}";
		 $query = $this->db->query($selquery);
		 if ($query->num_rows() > 0) {
		 $sql = "update multisession set session_id='{$session_id}',startTime='{$start}',endTime='{$end}',tokens='{$token}',tokent='{$tokent}'  where groupsessionId ={$gsid}";
		 return $this->db->query($sql);
		 }
		 else
		 {
			$sql="insert into multisession(groupsessionId,session_id,startTime,endTime,tokens,tokent)  values('{$gsid}','{$session_id}','{$start}','{$end}','{$token}','{$tokent}')";
			return $this->db->query($sql);
		 }
	}
	public function update($data){
		unset($profileInfo['submit']);
		return $this->db->query($this->db->update_string('lessons',$data,"uid={$data['uid']}"));
	}
	public function updateClass($data){ 
		return $this->db->query($this->db->update_string('class',$data,"id={$data['id']}"));
	}
	public function feedback($data){
	 //echo "<pre>"; print_r($data);die;
	 
		if(isset($data['submit'])){
			unset($data['submit']);
		}
	 
			$this->db->query($this->db->insert_string('groupfeedback',$data));
		 
		return array('error'=>0);
	}
	public function getByCid($id){
		$sql = "SELECT * FROM `multisession` WHERE groupsessionId={$id}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	public function getByCid1($id){
		$sql = "SELECT * FROM `gropsession` WHERE gropsessionId={$id}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	public function getFeedbackByCid($id){
		$sql = "SELECT * FROM `groupfeedback` WHERE callId={$id}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	public function buy_class(){
	
	}
	public function delById($id,$uid){
		$sql = "SELECT * FROM `class` WHERE (sid={$uid} OR tid={$uid}) AND id={$id}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			if($result['sid'] == $uid){
				$tUid = $result['tid'];
			}else{
				$tUid = $result['sid'];
			}
			$this->sendScuessEmail($uid,$tUid,$result['startTime']);
		}else {
			return;
		}
		$config = $this->getConfig();
		//$result['fee'] = round($result['fee'] * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
		/*$sql = "UPDATE profile set money = money+ ".$result['fee'] ." , frMoney = frMoney - ".$result['fee'] ." WHERE uid={$result['sid']}";
		$query = $this->db->query($sql);*/
		$sql = "DELETE FROM `class` WHERE (sid={$uid} OR tid={$uid}) AND id={$id}";
		$query = $this->db->query($sql);
		
		$confirmsql = "DELETE FROM `class_confirm` WHERE (sid={$uid} OR tid={$uid}) AND cid={$id}";
		$confirmquery = $this->db->query($confirmsql);
		return $query ;
	}
	public function sendScuessEmail($fUid,$tUid,$time) {
		$sql = "SELECT user.email,user.username,profile.* from profile left join user on user.id = profile.uid WHERE (uid={$fUid} OR uid={$tUid})";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		$users = array();
		$time = strtotime($time);
		foreach ($result as $key => $value) {
			$users[$value['uid']] = $value;
		}
		$dt = date('Y-m-d H:i:s',$time);
		$this->load->model(array('event_model','user_model'));
		$usernameFid = $users[$fUid]['firstName'].' '.$users[$fUid]['lastName'];
		$usernametUid = $users[$tUid]['firstName'].' '.$users[$tUid]['lastName'];
		//send email to student
		$this->load->library('email');
		$studentTimezone = $this->user_model->getLastLocalTimeZone($users[$fUid]['uid']);

		$student_session_time = $this->utc_to_local1('g:i A, Y-m-d',$dt,$studentTimezone);
		if($studentTimezone == 'America/Boise'){
			$oldTime 			= time($student_session_time);
			$timeAfterOneHour 	= $oldTime+60*60*4.6;
			$student_session_time = date("h:i a",$timeAfterOneHour);
		}else{
			$student_session_time = $this->utc_to_local1('g:i A, Y-m-d',$dt,$studentTimezone);
		}

		$str = "Your learning Vee-session was cancelled by {$usernameFid} with  {$usernametUid}";
		$str .= "\r\n<br/>";
		$str .= "The Vee-session start time was at your local time ". $student_session_time . " \r\n<br/>";
		$str .= "If you have any problems please email the support team at:  support@thetalklist.com\r\n<br/>";
		$str .= "Thank you,           TheTalkList Support Team";
		$toStudent = $users[$fUid]['email'];
		$this->email->mailtype = 'html';
		$this->email->from('no-reply@thetalklist.com','TalkMaster BlueBob');
		$this->email->to($toStudent);
		$this->email->subject('TheTalkList Vee-session was cancelled.');
		$this->email->message($str);
		$this->email->send();
		$this->email->clear(TRUE);
		//send email to tutor
		$tutorTimezone = $this->user_model->getLastLocalTimeZone($users[$tUid]['uid']);
		$tutor_session_time = $this->utc_to_local1('g:i A, Y-m-d',$dt,$tutorTimezone);
		if($tutorTimezone == 'America/Boise'){
			$oldTime 			= time($tutor_session_time);
			$timeAfterOneHour 	= $oldTime+60*60*4.6;
			$tutor_session_time = date("h:i a",$timeAfterOneHour);
		}else{
			$tutor_session_time = $this->utc_to_local1('g:i A, Y-m-d',$dt,$tutorTimezone);
		}
		
		$str = "Your learning Vee-session was cancelled by {$usernameFid} with  {$usernametUid}";
		$str .= "\r\n<br/>";
		$str .= "The Vee-session start time was at your local time ". $tutor_session_time . " \r\n<br/>";
		$str .= "If you have any problems please email the support team at:  support@thetalklist.com\r\n<br/>";
		$str .= "Thank you,           TheTalkList Support Team";
		$toTutor = $users[$tUid]['email'];
		$this->email->mailtype = 'html';
		$this->email->from('no-reply@thetalklist.com','TalkMaster BlueBob');
		$this->email->to($toTutor);
		$this->email->subject('TheTalkList Vee-session was cancelled.');
		$this->email->message($str);
		$this->email->send();
		$this->email->clear(TRUE);
	}
	public function getNotAlerted(){
		$timeEnd = time() + 3600;
		$sql = "SELECT class.id,class.alerted,class.tid,class.sid,class.startTime,t.alerts AS ta,t.alertType AS tat,t.firstName AS tf,t.lastName AS tl,s.firstName AS sf,s.alerts AS sa,s.alertType AS sat,s.lastName AS sl FROM class LEFT JOIN profile AS s ON  class.sid = s.uid LEFT JOIN profile AS t ON  class.tid = t.uid WHERE  alerted < 3 AND startTime BETWEEN  '" .date('Y-m-d H:i:s') ."' AND '" .date('Y-m-d H:i:s',$timeEnd ) ."' AND class.type = 'general'";

		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function sendAlertEmail($fUid,$tUid,$time,$toWho = 0) {
		$sql = "SELECT user.email,user.username,profile.* from profile left join user on user.id = profile.uid WHERE (uid={$fUid} OR uid={$tUid})";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		$users = array();
		foreach ($result as $key => $value) {
			$users[$value['uid']] = $value;
		}
		$dt = date(' H:i:s Y-m-d',$time);
		$this->load->model(array('event_model','user_model'));
		$usernameFid = $users[$fUid]['firstName'].' '.$users[$fUid]['lastName'];
		$usernametUid = $users[$tUid]['firstName'].' '.$users[$tUid]['lastName'];
		if(!$toWho){
			$this->email->to($users[$fUid]['email']);
			$Timezone = $this->user_model->getLastLocalTimeZone($users[$fUid]['uid']);
		}else {
			$this->email->to($users[$tUid]['email']);
			$Timezone = $this->user_model->getLastLocalTimeZone($users[$tUid]['uid']);
		}
		$dateInLocal = $this->event_model->utc_to_local1('g:i A, Y-m-d',$dt,$Timezone);
		$str = "Your learning Vee-session created by {$usernameFid} with  {$usernametUid} ";
		$str .= " will start at your local time ". $dateInLocal . " \r\n<br/>";
		$str .= "If you have any problems please email the support team at:  support@thetalklist.com\r\n<br/>";
		$str .= "Thank you, <br/>";
		$str .= "TheTalkList Support Team";
		$this->load->library('email');
		$this->email->mailtype = 'html';
		$this->email->from('no-reply@thetalklist.com','TalkMaster BlueBob');
		$this->email->subject('TheTalkList Vee-session will start.');
		$this->email->message($str);
		$this->email->send();
		$this->email->clear(TRUE);
	}
	public function sendAlertEmailCron($fUid,$tUid,$time,$toWho = 0) {
		$sql = "SELECT user.email,user.username,profile.* from profile left join user on user.id = profile.uid WHERE (uid={$fUid} OR uid={$tUid})";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		$users = array();
		foreach ($result as $key => $value) {
			$users[$value['uid']] = $value;
		}
		if(!$toWho){
			$uidS = $fUid;
		}else{
			$uidS = $tUid;
		}
		$this->load->model(array('event_model','profile_model','user_model'));
		$profile = $this->profile_model->getProfile($uidS);
		$user = $this->user_model->getByUid($uidS);
		//$localTimeZone = $user['timezone'];
		$localTimeZone = $this->user_model->getLastLocalTimeZone($uidS);
		$dt = date('Y-m-d H:i:s',$time);
		$dateInLocal = $this->utc_to_local1('g:i A, Y-m-d',$dt,$localTimeZone);
		$usernameFid = $users[$fUid]['firstName'].' '.$users[$fUid]['lastName'];
		$usernametUid = $users[$tUid]['firstName'].' '.$users[$tUid]['lastName'];
		$str = "Your learning Vee-session created by {$usernameFid} with  {$usernametUid} ";
		$str .= " will start at your local time ". $dateInLocal . " \r\n<br/>";
		$str .= "If you have any problems please email the support team at:  support@thetalklist.com\r\n<br/>";
		$str .= "Thank you, <br/>";
		$str .= "TheTalkList Support Team";
		$this->load->library('email');
		$this->email->mailtype = 'html';
		$this->email->from('no-reply@thetalklist.com','TalkMaster BlueBob');
		if(!$toWho){
			$to = $users[$fUid]['email'];
		}else {
			$to = $users[$tUid]['email'];	
		}
		$this->email->to($to);
		$this->email->subject('TheTalkList Vee-session will start.');
		$this->email->message($str);
		/*if($user['roleId'] != 0){*/
			$this->email->send();
		//}
		//$this->email->clear(TRUE);
	}
	//get next session detail TECHNO-SANJAY 15 May 2013
	public function getNextSession($id,$type) {
	
	 
		//$currentDateTime 	= gmdate("Y-m-d H:i:s");
		$currentDateTime 	= gmdate('Y-m-d H:i:s',strtotime('- 3 minutes'));
		$sql   = "SELECT * FROM class WHERE  `{$type}` = '{$id}' AND  startTime > '{$currentDateTime}'   and (type='now' || confirmby=1) ORDER BY UNIX_TIMESTAMP(startTime) ASC LIMIT 0,1";
		//$sql   = "SELECT * FROM class WHERE  `{$type}` = '{$id}' AND  startTime+3 minute > '{$currentDateTime}'   and (type='now' || confirmby=1) ORDER BY UNIX_TIMESTAMP(startTime) ASC LIMIT 0,1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = 0;
		}
		return $result;
	}
	public function completedSessions($uid) {
	
		//$start = intval($page - 1) * @$perPage;
		$nowTime = date('Y-m-d H:i:s');
		$sql = "SELECT COUNT(*) as cnt from class  where  endTime < '{$nowTime}' AND tid = {$uid} AND s_attend = 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
	
		return $result;
	}
	public function completedSession($uid) {
		//$start = intval($page - 1) * @$perPage;
		$nowTime = date('Y-m-d H:i:s');
		$sql = "SELECT id,startTime from class  where started = 1 AND endTime < '{$nowTime}' AND (tid = {$uid} OR sid = {$uid}) ORDER BY id DESC LIMIT 0,1 ";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	// techno-sanjay 13 aug - update tutor fee function 
	public function update_tutor_fee($tid,$fee) {
		$sql = "UPDATE profile SET money = money + {$fee} WHERE uid = {$tid} ";
		$query = $this->db->query($sql);
	}
	public function updateToSessionStarted($cid) {
		$sql = "UPDATE class SET started = 1 WHERE id = {$cid} ";
		$query = $this->db->query($sql);
	}
	public function getNotStartedSession(){
		$nowTime = date('Y-m-d H:i:s');
		$sql = "SELECT * from class  where started = 0 and endTime < '{$nowTime}' ";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getNotStartedSessionRT(){
		$nowTime = date('Y-m-d H:i:s');
		$sql = "SELECT * from class where started = 0 and endTime < '{$nowTime}' and type = 'now' ORDER by id DESC";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function updateNotStartedSession($id){
		$sql = "UPDATE class SET started = 1 where id = {$id} ";
		$query = $this->db->query($sql);
	}
	function utc_to_local1($format_string, $utc_datetime, $time_zone){
		$date = new DateTime($utc_datetime, new DateTimeZone('UTC'));
		$date->setTimeZone(new DateTimeZone($time_zone));
		return $date->format($format_string);
	}
	public function getBookNowClassByUid($tid){
		$nowTime = date('Y-m-d H:i:s');
		$sql = "SELECT * from class  where started = 0 and type = 'now' and tid = {$tid} and startTime = '0000-00-00 00:00:00' ";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	//update on confirm class with this tutor
	public function updateConfirmClass($cid,$tid,$sid,$date,$to){
		$status = 0;
		$sql = "insert into class_confirm (`cid`,`tid`,`sid`,`date`,`status`,`updated`,`to`) values ({$cid},{$tid},{$sid},'{$date}',{$status},'No',{$to})";
		$query = $this->db->query($sql);
	}
	public function getNotConfirmedClass($uid){
		$nowTime = date('Y-m-d H:i:s');
		//$sql = "SELECT * from class_confirm where updated = 'No' and sid = {$uid}";
		$sql = "SELECT * from class_confirm where updated = 'No' and sid = {$uid}";
		//exit;
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function updateClassSmsResponse($responseMsg,$class){
		$id = $class['id'];
		$sql = "update class_confirm set updated = 'Yes', status = '{$responseMsg}' where id = '{$id}'";
		$query = $this->db->query($sql);
	}
	public function checkForSmsReply($class){
		$this->load->library('twilio');
		$this->load->config('twilio', TRUE);
		$this->mode        = $this->config->item('mode', 'twilio');
		$this->account_sid = $this->config->item('account_sid', 'twilio');
		$this->auth_token  = $this->config->item('auth_token', 'twilio');
		$this->api_version = $this->config->item('api_version', 'twilio');
		$this->number      = $this->config->item('number', 'twilio');
		$data = array();
		$to = '+16193774807';
		$from = '+'.$class['to'];
		$dateSentMsg = strtotime($class['date']);
		$dateSent = ''	;
		if($from != ''){
			$data['From'] = $from;
		}
		if($to != ''){
			$data['To'] = $to;
		}
		if($dateSent != ''){
			$data['DateSent'] = $dateSent;
		}
		$responseMsg = '';
		$response = $this->twilio->request("/$this->api_version/Accounts/$this->account_sid/Messages", "GET",$data);
		if($response->HttpStatus == 200){
			$response = $response->ResponseXml->Messages;
			//$response = $response->Message;
			$messages = array();
			if($response->Message){
				foreach($response->Message as $msg)
				{
					$receivedDate = strtotime($msg->DateSent);
					//out time outTime
					$dateSentMsg = strtotime(date('g:i A, Y-m-d',$this->outTime($class['date'])));
					$diffTime = ($receivedDate - $dateSentMsg)/60;
					if($diffTime > 5){
						continue;
					}else{
						$messages[] = $msg;
					}
				}
				$response = $messages;
				$response = $response[0];
				$responseMsg = trim($response->Body);
			}
		}
		return $responseMsg;
	}
	public function updateAttendance($cid){
		$sql = "update class set s_attend = 1 where id = {$cid}";
		$query = $this->db->query($sql);
	}
	public function updateClassAction($data,$classid){
		$updateAction = serialize($data);
		$sql = "update multisession set action = '{$updateAction}' where groupsessionId = {$classid}";
		$query = $this->db->query($sql);
	}
	public function getClassAction($classid){
		$sql = "select action from multisession  where groupsessionId = {$classid}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$result = unserialize($result['action']);
		}
		return $result;
	}
	
	
	
	public function updateFreeSession($sid){
		$sql = "select sid from class where sid = {$sid}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}
	
	public function getUserSession($sid){
		$sql = "select sid from class where sid = {$sid}";
		$query = $this->db->query($sql);
		$result = array();
		$result = $query->row_array();
		return $result;
	}
	//added by haren to count completed session
	public function SchoolSession($uid) {
	
		//$start = intval($page - 1) * @$perPage;
		$nowTime = date('Y-m-d H:i:s');
		$sql = "SELECT COUNT(*) as cnt from class  where  endTime < '{$nowTime}' AND school_id = {$uid} ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
	   
		return $result;
	}
	
	public function delveeById($id){
		$sql = "DELETE FROM `class` WHERE id={$id}";
		$query = $this->db->query($sql);
		
		$confirmsql = "DELETE FROM `class_confirm` WHERE cid={$id}";
		$confirmquery = $this->db->query($confirmsql);
		return $query;
	
	}
	
	public function deleterefundclass($id){
		$sql = "DELETE FROM `class` WHERE id={$id}";
		$query = $this->db->query($sql);
		
		$confirmsql = "DELETE FROM `class_confirm` WHERE cid={$id}";
		$confirmquery = $this->db->query($confirmsql);
		return $query;
	}
	public function GetTutorNext($id,$type) {
	
	    $currentDateTime 	= gmdate("Y-m-d H:i:s");
		$sql   = "SELECT * FROM class WHERE  `{$type}` = '{$id}' AND  startTime > '{$currentDateTime}'   and (type='now' || confirmby=1) ORDER BY UNIX_TIMESTAMP(startTime) ASC LIMIT 0,1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	
	public function Checkisnew($id)
	{
		$sql   = "SELECT  GroupSession FROM user WHERE   id='{$id}'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function UpdatePaticipant($clsId)
	{
		$feeSql = "update gropsession set NoofParticipant=NoofParticipant+1  where gropsessionId={$clsId}";
		$query = $this->db->query($feeSql);
	}
	
	public function Updatelistofjoiner($clsId)
	{
		 $uid=$this->session->userdata['uid'];
		 $result =array();
		 $feeSql = "SELECT listofjoiner from  gropsession where gropsessionId={$clsId}";
		 $query = $this->db->query($feeSql);
		 $result = $query->row_array();
		 
		 
		 if ($result['listofjoiner'] !='') 
		 {
			$particaipants = explode(',',$result['listofjoiner']);
			if (in_array($uid, $particaipants)) 
			{
				 
			} 
			else 
			{
				 $newId=$result['listofjoiner']=$result['listofjoiner'].",".$uid;
				$feeSql = "update gropsession set listofjoiner = '{$newId}'  where gropsessionId={$clsId}";
				$query = $this->db->query($feeSql); 
			}
		 }
		 else
		 {
			$feeSql = "update gropsession set listofjoiner = {$uid}  where gropsessionId={$clsId}";
			$query = $this->db->query($feeSql);
		 }
		 
	
	}
	public function GetConnectedstu($cid)
	{
		$sql   = "SELECT  listofjoiner FROM gropsession WHERE   gropsessionId='{$cid}'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}else{
			$result = array();
		}
		 
		return $result;
	}
	public function Getnamebyid($uid)
	{
		$sql   = "SELECT  uid,firstName,lastName,pic FROM profile WHERE  uid='{$uid}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		return $result;
	}
	public function checkprimary($cid,$tid)
	{
		$sql   = "SELECT  isprimary FROM gropsession WHERE   gropsessionId='{$cid}'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			if($result['isprimary']==$tid)
			{
				return 'false';
			}
			else
			{
				return 'true';
			}				
		}else{
			return 'false';
		} 
	}
	public function CheckIsnewstudent($uid)
	{
		
		$sql   = "SELECT  is_eligible,exp_session FROM user WHERE id='{$uid}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		return $result;
	}
	public function checkConnected($cid)
	{
		$sql   = "SELECT  tutorPresent FROM gropsession WHERE   gropsessionId='{$cid}'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			if($result['tutorPresent']==1)
			{
				$feeSql = "update gropsession set tutorPresent = 0  where gropsessionId={$cid}";
				$query = $this->db->query($feeSql);
				return 'true';
			}
			else
			{
				return 'false';
			}				
		}else{
			return 'false';
		} 
	}
	
	public function DecreseParticipant($clsId)
	{
		$feeSql = "update gropsession set NoofParticipant=NoofParticipant+1  where gropsessionId={$clsId}";
		$query = $this->db->query($feeSql);
	}
	public function RemoveParitcipant($clsId)
	{
		$uid = $this->session->userdata('uid');
		/*$grpSql = "select `listofjoiner` from `gropsession` where gropsessionId={$clsId}";
		$grpquery = $this->db->query($grpSql);
		$grpres = $query->result_array();
		if ($grpres) {
			$grpres[0]['listofjoiner'];*/
			$feeSql = "update gropsession set NoofParticipant=NoofParticipant-1, `listofjoiner`= replace(`listofjoiner`,'$uid,',''), `listofjoiner`= replace(`listofjoiner`,'$uid','') where gropsessionId={$clsId}";
			$query = $this->db->query($feeSql);
		//}
	}
}
/* End of file class_model.php */
/* Location: ./application/model/class_model.php */	