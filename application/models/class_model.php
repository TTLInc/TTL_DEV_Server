<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Class_model extends TL_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function getAll($page = 1,$perPage = 10) {
		$start = intval($page - 1) * $perPage;
		$nowTime = date('Y-m-d H:i:s');
		$sql = "SELECT * from class  where startTime > '{$nowTime}' AND type = 'general' and confirmby = '1' limit {$start},{$perPage}";
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
	
	public function getHistory($uid,$type){
		$currentmonth = date('Y-m');
		if($uid == ''){
			return array();
		}
		$sql = "SELECT class.*, tProfile.firstName as tFN,tProfile.lastName as tLN,sProfile.firstName as sFN,sProfile.lastName AS sLN FROM class LEFT JOIN profile AS tProfile ON tProfile.uid = class.tid LEFT JOIN profile AS sProfile ON sProfile.uid = class.sid";
		if ($type=="all") {
			$sql .= " where (tid={$uid} or sid={$uid} or class.school_id={$uid}) and s_attend =1 order by endTime desc";
		} else if ($type == 'month'){
			$sql .= "  where (tid={$uid} or sid={$uid} or class.school_id={$uid}) and month(endTime) = month(curdate())  and year(endTime) = year(curdate()) and s_attend =1 order by endTime desc";		
		} else if($type == 'year') {
			$sql .= "  where (tid={$uid} or sid={$uid} or class.school_id={$uid}) and  year(endTime) = year(curdate()) and s_attend =1 order by endTime desc";		
		} else {
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
		$cnd = "( (tid = $tid)";
		if ($this->session->userdata('universal_roleId')==1) {
			$cnd .= " or (sid = $tid and tid = (select `id` from `user` where `roleId` >= 1 and `id`= `tid`)) ";
		}
		$cnd .= ") ";
		$sql = "SELECT  class.*,profile.firstName,profile.lastName,profile.pic from class left join profile on  class.sid = profile.uid where $cnd and `endTime` > '{$nowTime}'  and (type='now' || confirmby=1) and `Intent`!='2' order by startTime asc limit {$start}, {$perPage}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function getByCsessionid($cid){
		$nowTime = date('Y-m-d H:i:s');
		$sql = "SELECT  id,action,startTime from class where id={$cid} and `endTime` > '{$nowTime}' and (type='now' || confirmby=1)";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function getBySid($sid,$page = 1,$perPage = 100)
	{
		$nowTime = date('Y-m-d H:i:s');
		$start = intval($page - 1) * $perPage;
		$sql = "SELECT class.*,profile.firstName,profile.lastName,profile.pic from class left join profile on  class.tid = profile.uid  where sid={$sid} and tid = (select `id` from `user` where `roleId` >= 1 and `id`= `tid`) and `endTime` > '{$nowTime}'  and (type='now' || confirmby=1) and `Intent`!='2' order by startTime asc limit {$start}, {$perPage}";
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
	
	public function getNearClassById($id)
	{
		if(!$id){
			return array();
		}
		$sql = "select class.* ,t.firstName as tf,t.lastName as tl,t.pic as tp,s.firstName as sf,s.lastName as sl,s.pic as sp,s.uid as suid from class left join profile as s on  class.sid = s.uid left join profile as t on  class.tid = t.uid where class.id={$id} order by `startTime` asc limit 0,1";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function upSession($id,$session_id,$tokenS,$tokenT)
	{
		$sql = "update class set session_id='{$session_id}' , tokenT='{$tokenT}' , tokenS='{$tokenS}' where id={$id}";
		return $this->db->query($sql);
	}
	
	public function update($data)
	{
		unset($profileInfo['submit']);
		return $this->db->query($this->db->update_string('lessons',$data,"uid={$data['uid']}"));
	}
	
	public function updateClass($data)
	{
		return $this->db->query($this->db->update_string('class',$data,"id={$data['id']}"));
	}
	
	public function feedback($data)
	{
		if (isset($data['submit'])) {
			unset($data['submit']);
		}		
		if ($this->getFeedbackByCid($data['callId']) == array()) {
			$this->db->query($this->db->insert_string('feedback',$data));
		} else {
			$this->db->query($this->db->update_string('feedback',$data,'callId='.$data['callId']));
		}
		return array('error'=>0);
	}
	
	public function getByCid($id)
	{
		$sql = "SELECT * FROM `class` WHERE id={$id}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function getFeedbackByCid($id)
	{
		$sql = "SELECT * FROM `feedback` WHERE callId={$id} AND status = 1";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function buy_class(){
	
	}
	
	public function delById($id,$uid)
	{
		$sql = "SELECT * FROM `class` WHERE (sid={$uid} OR tid={$uid}) AND id={$id}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			if ($result['sid'] == $uid) {
				$tUid = $result['tid'];
			} else {
				$tUid = $result['sid'];
			}
			$this->sendScuessEmail($uid,$tUid,$result['startTime']);
		} else {
			return;
		}
		$config = $this->getConfig();
		//$result['fee'] = round($result['fee'] * (1+$config['VEE_PRICE_PERCENT']['value']) *100) /100;
		/*$sql = "UPDATE profile set money = money+ ".$result['fee'] ." , frMoney = frMoney - ".$result['fee'] ." WHERE uid={$result['sid']}";
		$query = $this->db->query($sql);*/
		
		// change made by haren
		$sttime=$result['startTime'];
		$endtime=$result['endTime'];
		$tid=$result['tid'];
		$sql = "update `timeSlot` set uid='{$tid}' where startTime='{$sttime}' AND endTime='{$endtime}'";
		$query = $this->db->query($sql);
		
		$sql = "DELETE FROM `class` WHERE (sid={$uid} OR tid={$uid}) AND id={$id}";
		$query = $this->db->query($sql);
		
		$confirmsql = "DELETE FROM `class_confirm` WHERE (sid={$uid} OR tid={$uid}) AND cid={$id}";
		$confirmquery = $this->db->query($confirmsql);
		
		// Update Transaction Entry By Ilyas
		$this->load->model(array('user_model'));
		$result = $this->user_model->fnSelectTransaction("id",array('ref_table'=>'class','ref_id'=>$id));
		foreach ($result as $row)
		{
			$nw = date("Y-m-d H:i:s");
			$this->user_model->fnUpdateTransaction(array("payment_status"=>"Refund","payment_date"=>$nw,"status"=>"Deleted","status_comment"=>"Vee Session Deleted by User($uid)"),array('ref_table'=>'class','ref_id'=>$id));
			$this->user_model->fnUpdateTransaction(array("payment_status"=>"None","payment_date"=>$nw,"status"=>"Deleted","status_comment"=>"Vee Session Deleted by User($uid)"),array('inner_rel_id'=>$row->id));
		}
		return $query;
	}
	
	public function sendScuessEmail($fUid,$tUid,$time)
	{
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
		//$usernameFid = $users[$fUid]['firstName'].' '.$users[$fUid]['lastName'];
		//$usernametUid = $users[$tUid]['firstName'].' '.$users[$tUid]['lastName'];
		$usernameFid = $users[$fUid]['firstName'].''.$users[$fUid]['uid'];
		$usernametUid = $users[$tUid]['firstName'].''.$users[$tUid]['uid'];
		//send email to student
		$this->load->library('email');
		$studentTimezone = $this->user_model->getLastLocalTimeZone($users[$fUid]['uid']);
		$student_session_time = $this->utc_to_local1('g:i A, Y-m-d',$dt,$studentTimezone);
		if ($studentTimezone == 'America/Boise') {
			$oldTime 			= time($student_session_time);
			$timeAfterOneHour 	= $oldTime+60*60*4.6;
			$student_session_time = date("h:i a",$timeAfterOneHour);
		} else {
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
		
		// Send SMS To Student
		if ($users[$fUid]['cell']) {
			$this->load->library('twilio');
			$smsfrom = '+16193774807';
			$smsto = $users[$fUid]['cell']; 
			$smessage = "$usernameFid has cancelled your $student_session_time session on TheTalkList.";
			$response = $this->twilio->sms($smsfrom, $smsto, $smessage);
			if ($response->IsError) {
				$error = $response->ErrorMessage;
			} else {
				$error = '';
			}
		}
		
		//send email to tutor
		$tutorTimezone = $this->user_model->getLastLocalTimeZone($users[$tUid]['uid']);
		$tutor_session_time = $this->utc_to_local1('g:i A, Y-m-d',$dt,$tutorTimezone);
		if ($tutorTimezone == 'America/Boise') {
			$oldTime 			= time($tutor_session_time);
			$timeAfterOneHour 	= $oldTime+60*60*4.6;
			$tutor_session_time = date("h:i a",$timeAfterOneHour);
		} else {
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
		
		// Send SMS To Tutor
		if ($users[$tUid]['cell']) {
			$this->load->library('twilio');
			$smsfrom = '+16193774807';
			$smsto = $users[$tUid]['cell']; 
			$smessage = "$usernameFid has cancelled your $tutor_session_time session on TheTalkList.";
			$response = $this->twilio->sms($smsfrom, $smsto, $smessage);
			if ($response->IsError) {
				$error = $response->ErrorMessage;
			} else {
				$error = '';
			}
		}
	}
	
	public function getNotAlerted(){
		$timeEnd = time() + 3600;
		$sql = "SELECT class.id,class.alerted,class.tid,class.sid,class.startTime,t.alerts AS ta,t.alertType AS tat,t.firstName AS tf,t.lastName AS tl,s.firstName AS sf,s.alerts AS sa,s.alertType AS sat,s.lastName AS sl FROM class LEFT JOIN profile AS s ON  class.sid = s.uid LEFT JOIN profile AS t ON  class.tid = t.uid WHERE  alerted < 3 AND startTime BETWEEN  '" .date('Y-m-d H:i:s') ."' AND '" .date('Y-m-d H:i:s',$timeEnd ) ."' AND class.type = 'general' AND class.confirmby = '1'";
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
		/*$usernameFid = $users[$fUid]['firstName'].' '.$users[$fUid]['lastName'];
		$usernametUid = $users[$tUid]['firstName'].' '.$users[$tUid]['lastName'];*/
		$usernameFid = $users[$fUid]['firstName'].''.$users[$fUid]['uid'];
		$usernametUid = $users[$tUid]['firstName'].''.$users[$tUid]['uid'];
		if (!$toWho) {
			$this->email->to($users[$fUid]['email']);
			$Timezone = $this->user_model->getLastLocalTimeZone($users[$fUid]['uid']);
		} else {
			$this->email->to($users[$tUid]['email']);
			$Timezone = $this->user_model->getLastLocalTimeZone($users[$tUid]['uid']);
		}		
		$dateInLocal = $this->event_model->utc_to_local1('g:i A, Y-m-d',$dt,$Timezone);
		$str = "Your learning Vee-session created by {$usernametUid} with {$usernameFid} ";
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
		if (!$toWho) {
			$uidS = $fUid;
		} else {
			$uidS = $tUid;
		}
		$this->load->model(array('event_model','profile_model','user_model'));
		$profile = $this->profile_model->getProfile($uidS);
		$user = $this->user_model->getByUid($uidS);
		//$localTimeZone = $user['timezone'];
		$localTimeZone = $this->user_model->getLastLocalTimeZone($uidS);
		$dt = date('Y-m-d H:i:s',$time);
		$dateInLocal = $this->utc_to_local1('g:i A, Y-m-d',$dt,$localTimeZone);
		/*$usernameFid = $users[$fUid]['firstName'].' '.$users[$fUid]['lastName'];
		$usernametUid = $users[$tUid]['firstName'].' '.$users[$tUid]['lastName'];*/
		$usernameFid = $users[$fUid]['firstName'].''.$users[$fUid]['uid'];
		$usernametUid = $users[$tUid]['firstName'].''.$users[$tUid]['uid'];
		$str = "Your learning Vee-session created by {$usernametUid} with {$usernameFid} ";
		$str .= " will start at your local time ". $dateInLocal . " \r\n<br/>";
		$str .= "If you have any problems please email the support team at:  support@thetalklist.com\r\n<br/>";
		$str .= "Thank you, <br/>";
		$str .= "TheTalkList Support Team";
		$this->load->library('email');
		$this->email->mailtype = 'html';
		$this->email->from('no-reply@thetalklist.com','TalkMaster BlueBob');
		if (!$toWho) {
			$to = $users[$fUid]['email'];
		} else {
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
		$currentDateTime 	= gmdate('Y-m-d H:i:s',strtotime('- 3 minutes'));
		$sql   = "SELECT * FROM class WHERE Intent!='2' and (`{$type}` = '{$id}' or `sid` = '{$id}')  AND  startTime >= '{$currentDateTime}'   and (type='now' || confirmby=1) ORDER BY UNIX_TIMESTAMP(startTime) ASC LIMIT 0,3";
		/*$sql   = "SELECT * FROM class WHERE   Intent=0 AND  `{$type}` = '{$id}' AND  startTime > '{$currentDateTime}'   and (type='now' || confirmby=1) ORDER BY UNIX_TIMESTAMP(startTime) ASC LIMIT 0,1";*/
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$currentDateTime 	= gmdate('Y-m-d H:i:s',strtotime('- 25 minutes'));
			$sql   = "SELECT * FROM class WHERE `Intent`='1' and `tokenT` != '' and (`{$type}` = '{$id}' or `sid` = '{$id}')  AND  startTime >= '{$currentDateTime}'   and (type='now' || confirmby=1) ORDER BY UNIX_TIMESTAMP(startTime) ASC LIMIT 0,3";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$result = $query->result_array();
			} else {
				$result = 0;
			}
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
		$sql = "SELECT id,startTime from class  where started = 1 AND (tid = {$uid} OR sid = {$uid}) ORDER BY id DESC LIMIT 0,1 ";
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
		$startTime = "2015-03-10 09:00:00";
		$sql = "SELECT * from class where started = 0 and endTime < '{$nowTime}' AND startTime > '{$startTime}'  ORDER by id DESC";
		//$sql = "SELECT * from class where started = 0 and endTime < '{$nowTime}' ORDER by id DESC";
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
		$sql = "SELECT * from class_confirm where updated = 'No' and sid = '$uid' ";
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
		if ($from != '') {
			$data['From'] = $from;
		}
		if ($to != '') {
			$data['To'] = $to;
		}
		if ($dateSent != '') {
			$data['DateSent'] = $dateSent;
		}
		$responseMsg = '';
		$response = $this->twilio->request("/$this->api_version/Accounts/$this->account_sid/Messages", "GET",$data);
		if ($response->HttpStatus == 200) {
			$response = $response->ResponseXml->Messages;
			//$response = $response->Message;
			$messages = array();
			if ($response->Message) {
				foreach($response->Message as $msg)
				{
					$receivedDate = strtotime($msg->DateSent);
					//out time outTime
					$dateSentMsg = strtotime(date('g:i A, Y-m-d',$this->outTime($class['date'])));
					$diffTime = ($receivedDate - $dateSentMsg)/60;
					if ($diffTime > 5) {
						continue;
					} else {
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
	
	public function tutorearlyleave($cid){
		$sql = "update class set s_attend = 0 where id = {$cid}";
		$query = $this->db->query($sql);
	}
	
	public function updateStudentAttendance($cid){
		$sql = "update class set s_attend = 1 where id = {$cid}";
		$query = $this->db->query($sql);
		exit;
	}
	
	public function updateClassAction($data,$classid){
		$updateAction = serialize($data);
		$sql = "update class set action = '{$updateAction}' where id = {$classid}";
		$query = $this->db->query($sql);
	}
	
	public function getClassAction($classid){
		$sql = "select action from class where id = {$classid}";
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
		} else {
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
		} else {
			$result = array();
		}
		return $result;
	}
	
	public function GetComingSession($id,$type) {	
	    $currentDateTime 	= gmdate("Y-m-d H:i:s");
		$sql   = "SELECT * FROM class WHERE  `{$type}` = '{$id}' AND  startTime > '{$currentDateTime}' ORDER BY UNIX_TIMESTAMP(startTime) ASC LIMIT 0,1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		} else {
			$result = array();
		}
		return $result;
	}
	
	public function GetClassDetail($clsId)
	{
		$sql   = "SELECT session_type,sid FROM  class WHERE id='{$clsId}' ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		} else {
			$result = array();
		}
		return $result;	
	}
	
	public function RegenerateCoupon($sid)
	{
		$sql = "update user set is_eligible=1, free_session = 'y' WHERE id={$sid} ";
		$query = $this->db->query($sql);
		$sql1 = "update profile set free_session = 'y' WHERE uid={$sid} ";
		$query = $this->db->query($sql1);
		return;
	}
	
	public function fnRemoveFreeSession($sid)
	{
		$sql = "update user set is_eligible=0, free_session = 'n' WHERE id={$sid} ";
		$query = $this->db->query($sql);
		$sql1 = "update profile set free_session = 'n' WHERE uid={$sid} ";
		$query = $this->db->query($sql1);
		return;
	}
	
	public function GetDiffrance($cid)
	{
		$result = array();
		$sql   = "SELECT NoofParticipant,Time,gropsessionId  FROM  gropsession WHERE gropsessionId='{$cid}' ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}else{
			$result = array();
		}
		return $result;
	}
	
	public function getMemberTransaction($uid, $myval="")
	{
		if($uid == ''){
			return array();
		}
		//$sql = "SELECT `payment_date`,`type`,`amount`,`amount_status`,`payment_status` from `transaction` where `user_id`='$uid' and DATE_FORMAT(`payment_date`,'%m-%Y') = '".$myval."' and `payment_status` IN ('Paid','Refund') order by `payment_date` desc";

		$sql = "SELECT class.*, tProfile.firstName as tFN,tProfile.lastName as tLN,sProfile.firstName as sFN,sProfile.lastName AS sLN FROM class LEFT JOIN profile AS tProfile ON tProfile.uid = class.tid LEFT JOIN profile AS sProfile ON sProfile.uid = class.sid where (tid={$uid} or sid={$uid} or class.school_id={$uid}) and DATE_FORMAT(`endTime`,'%m-%Y') = '".$myval."' and s_attend =1 order by endTime desc";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function getMemberTotalTransaction($uid, $myval="")
	{
		if($uid == ''){
			return array();
		}
		//$sql = "SELECT `payment_date`,`type`,`amount`,`amount_status`,`payment_status` from `transaction` where `user_id`='$uid' and DATE_FORMAT(`payment_date`,'%m-%Y') = '".$myval."' and `payment_status` IN ('Paid','Refund') order by `payment_date` desc";

		$sql = "SELECT sum(class.t_hrate) as totalhrate FROM class where (tid={$uid} or sid={$uid} or class.school_id={$uid}) and DATE_FORMAT(`endTime`,'%m-%Y') = '".$myval."' and s_attend =1 order by endTime desc";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
}
/* End of file class_model.php */
/* Location: ./application/model/class_model.php */	