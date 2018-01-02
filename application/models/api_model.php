<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api_model extends TL_Model {
	
	//Constructor
    function __construct()
    {
        parent::__construct(); // Call Parent Constructor
    }
	
	// Check User Login Credential
	public function loginByEmail($userinfo) {
		
		$result = array();
		  //$userinfo['password'] = md5($userinfo['password']);
		  $password = md5($userinfo['password']);
		  $email = $userinfo['email'];
		  //$userinfo['email'] = $userinfo['email'];
			
		/*
		$userinfo['password'] = md5('321321');
		$userinfo['email'] = 'v@technoinfonet.com';
		*/
	/* $check = $this->db->query("Select id from user where email = '{$email}' AND password = '{$password}'");
	$results = $check->row_array();
		if($results['id']){
			$checkfirebase = $this->db->query("Select firebase_regId from profile where uid = '{$results["id"]}'");
			$firebase = $checkfirebase->row_array();
			
			if($firebase['firebase_regId'] != ''){
				return $firebase;
			}
		} */
	
		//$sql_log="update user set  is_login=1 , readytotalk =1 where email = '$email' AND password = '$password'";
		$sql_log="update user set  is_login=1 where email = '$email' AND password = '$password'";		
		$this->db->query($sql_log);
		$sql = "select u.* , CONCAT(p.firstName, ' ',p.lastName) as usernm,p.firstName ,p.lastName ,p.money,p.frMoney ,p.gender,p.country,p.province,p.city,p.age,p.nativeLanguage,p.otherLanguage, p.pic ,p.avgRate,p.hRate, p.vedio ,p.cell, p.tutoring_subjects,p.firebase_regId,p.ttl_points,p.coupon_credits from user as u join profile as p on u.id = p.uid where u.email = '$email' AND u.password = '$password'";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			//$result = $query->result_array();
			//$result = $query->row_array();
		
			$result = $query->row_array();
		
		}
		return $result;
				
		//$sql = "select u.* , CONCAT(p.firstName, ' ',p.lastName) as usernm, p.gender,p.country,p.province,p.city,p.age,p.nativeLanguage from user as u, profile as p where u.email = '$email' AND u.password = '$password'";
		//$sql = "select u.*,p.* from user as u , profile as p where u.email = '$email' AND u.password = '$password'";
		//$sql = "select * from user join profile on user.id = profile.uid where user.email = '$email' AND user.password = '$password'";
		
	}
	
	public function checkdevice($device_id){
		$result = array();
		$sql = "select * from profile where device_id=? limit 1";
		$query = $this->db->query($sql,array($device_id));
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function loginByfbid($userinfo) {
		
		$result = array();
		  //$userinfo['password'] = md5($userinfo['password']);
		  $facebook_id = $userinfo['facebook_id'];
		  $email = $userinfo['email'];
		  //$userinfo['email'] = $userinfo['email'];
			
		/*
		$userinfo['password'] = md5('321321');
		$userinfo['email'] = 'v@technoinfonet.com';
		*/
		$sql_log="update user set  is_login=1 where email = '$email' AND facebook_id = '$facebook_id'";			
		$this->db->query($sql_log);
			
		//$sql = "select u.* , CONCAT(p.firstName, ' ',p.lastName) as usernm, p.gender,p.country,p.province,p.city,p.age,p.nativeLanguage from user as u, profile as p where u.email = '$email' AND u.password = '$password'";
		//$sql = "select u.*,p.* from user as u , profile as p where u.email = '$email' AND u.password = '$password'";
		//$sql = "select * from user join profile on user.id = profile.uid where user.email = '$email' AND user.password = '$password'";
		$sql = "select u.* , CONCAT(p.firstName, ' ',p.lastName) as usernm,p.firstName ,p.lastName ,p.money,p.frMoney,p.gender,p.country,p.province,p.city,p.age,p.nativeLanguage,p.otherLanguage , p.pic ,p.avgRate ,p.hRate, p.vedio,p.cell, p.tutoring_subjects,p.ttl_points,p.coupon_credits from user as u join profile as p on u.id = p.uid where u.email = '$email' AND u.facebook_id = '$facebook_id'";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			//$result = $query->result_array();
			//$result = $query->row_array();
		
			$result = $query->row_array();
		
		}
		return $result;
	}
	// GET ROLE ID
	public function getRoleID($uid) {
		$this->db->select('roleId');
		$this->db->from('user');
		$this->db->where('id', $uid);
		$query = $this->db->get();
		//$query = $this->db->get_where('user',array('id'=>$uid));
		if ($query->num_rows() == 1){
			$result = $query->row_array();
		}
		return $result;
	}
	// Check CLASS EXIST OR NOT
	public function checkClassID($id, $uid) {
		$sql = "SELECT id FROM `class` WHERE (sid='$uid' OR tid='$uid') AND id='$id'";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() == 1){
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function updateUserRole($email, $roleId){
		//$sql = "update `user` set `roleId`='".$roleId."' where `email`=".$email;
		if($roleId == '0'){
			$sql = "update `user` set `roleId`= '$roleId' where `email`='$email'";
			$this->db->query($sql);
			$sqls = "update `profile` set `money`= 10 where `email`='$email'";
			$this->db->query($sqls);
			return 'Role has been successfully updated.';
		}else{
			$sql = "update `user` set `roleId`= '$roleId' where `email`='$email'";
			$this->db->query($sql);
			return 'Role has been successfully updated.';
		}
		
	}
	
	public function updateUserProfile($data){
		if($data['cell'] == ''){
			$sql = "update profile set country='".$data['country']."',province='".$data['state']."',city='".$data['city']."',firstName='".$data['firstName']."',lastName='".$data['lastName']."',gender='".$data['gender']."',nativeLanguage='".$data['language1']."',otherLanguage ='".$data['language2']."',age ='".$data['age']."' where uid=".$data['userid'];
		}else{
			$sql = "update profile set country='".$data['country']."',province='".$data['state']."',city='".$data['city']."',firstName='".$data['firstName']."',lastName='".$data['lastName']."',gender='".$data['gender']."',nativeLanguage='".$data['language1']."',otherLanguage ='".$data['language2']."',age ='".$data['age']."',cell ='".$data['cell']."' where uid=".$data['userid'];
		}
		
		
		$this->db->query($sql);	
		return 'Records are updated successfully';
		//,email='".$data['email']."'
	}
	public function get_countries(){
		$this->db->select('*');
		$this->db->from('countries');
		$query = $this->db->get();
		//$result  = $query->row_array();
		$result = $query->result();
		return $result;
	}
	public function get_states(){
		$this->db->select('*');
		$this->db->from('provices');
		$this->db->order_by("provice", "asc");
		$query = $this->db->get();
		//$result  = $query->row_array();
		$result = $query->result();
		return $result;
	}
	/* public function get_tutors(){
		$this->db->select('profile.*,user.*');
		$this->db->from('profile');
		$this->db->join('user',' profile.uid = user.id', 'inner');
		$this->db->where('user.readytotalk',1);
		$this->db->where_in('user.roleId',array('1','2','3'));	
		$query = $this->db->get();
		$result  = $query->row_array();
		//$result = $query->result();
		return $result;
	} */
		public function get_videos(){
		$this->db->select('lessons.id,lessons.uid,lessons.name,lessons.desc,lessons.source,lessons.views,lessons.likes,profile.firstName,profile.lastName');
		$this->db->from('lessons');
		$this->db->where('status',1);
		$this->db->order_by("lessons.id", "desc");
		$this->db->join('profile',' lessons.uid = profile.uid', 'inner');
		//$this->db->limit(5);
		$query = $this->db->get();
		//$result  = $query->row_array();
		$result = $query->result();
		return $result;
	}
	 public function video_like($uid,$vid){
 
		 $data = array(
			'uid'=>$uid,
			'vid'=>$vid
			);

		$insert = $this->db->insert('video_likes',$data);

		if($insert){
			$this->db->set('likes', 'likes+1', FALSE);
			$this->db->where('id',$vid);
			$this->db->update('lessons');
			return true;
		}else{
			return false;
		}
	} 
	
	public function video_views($uid,$vid){
		$this->db->set('views', 'views+1', FALSE);
		$this->db->where('id',$vid);
		$update = $this->db->update('lessons');
		if($update){
			return true;
		}else{
			return false;
		}
	}
	
	public function check_like($uid,$vid){
		$this->db->select('status');
		$this->db->where('uid',$uid);
		$this->db->where('vid',$vid);
		$query = $this->db->get('video_likes');
		$result  = $query->row_array();
		//$result = $query->result();
		return $result;
	}
	public function video_dislike($uid,$vid){
		$this->db->where('uid', $uid);
		$this->db->where('vid', $vid);
		$delete = $this->db->delete('video_likes');
		if($delete){
			$this->db->set('likes', 'likes-1', FALSE);
			$this->db->where('id',$vid);
			$this->db->update('lessons');
			return true;
		}else{
			return false;
		}

	}
	public function get_subject($t_id){
		$this->db->select('uid,personal,professional,academic,tutoring_subjects');
		$this->db->where('uid',$t_id);
		$query = $this->db->get('profile');
		//$result  = $query->row_array();
		$result = $query->result();
		
		return $result;
	}
	public function tutor_video($t_id){
		$this->db->select('uid,vedio');
		$this->db->where('uid',$t_id);
		$query = $this->db->get('profile');
		//$result  = $query->row_array();
		$result = $query->result();
		return $result;
	}
	public function fnInsertTransaction($data=array()){	
		if (!empty($data)) {
			$this->db->insert('transaction', $data); 
			return $this->db->insert_id();
		} else {			
			return false;
		}
	}
	
	public function fnUpdateProfileCashout($amount,$cond = array()){	
		if (!empty($amount) and !empty($cond)) {
			$this->db->set('money', 'money-'.$amount, FALSE);
			$this->db->set('purchased_credits', 'purchased_credits-'.$amount, FALSE);
			$this->db->set('frMoney', 'frMoney+'.$amount, FALSE);
			$this->db->where($cond);
			$this->db->update('profile');
			
			// added after
			$this->db->select('money');
			$this->db->where($cond);
			$queries = $this->db->get('profile');
		//$result  = $query->row_array();
		$result = $queries->row_array();
			
			if($result['money'] < 3){
			$this->db->select('uid');
			$this->db->where($cond);
			$queries = $this->db->get('low_balance_notification');
		//$result  = $query->row_array();
		$results = $queries->row_array();
			if(empty($results)){
			 $data = array(
					'uid'=>$cond['uid'],
					'balance'=>$result['money'],
					'date'=>date('Y-m-d h:i:s')
				);				 
				$this->db->insert('low_balance_notification', $data); 
			}
		}
			return $result;
		} else {			
			return false;
		}
	}
	
	public function getResult($arCnd=array(),$user_id){
		$cnd = "";
		// Check Order By
		$orderBy = "`readytotalk` DESC, `user`.`roleId` DESC, `nativeLanguage` ASC ,`profile`.`avgRate` DESC ,RAND()";
		$order = "";
		
		if (!empty($arCnd)) {
			if (!empty($arCnd['keyword'])) {
				//$keywords = explode(' ',trim($arCnd['keyword']));
				$cnd .= " and ( ";	
					$cnd .= " `profile`.`academic` LIKE '%".$arCnd['keyword']."%' ";
					$cnd .= " OR `profile`.`professional` LIKE '%".$arCnd['keyword']."%' "; 
					$cnd .= " OR `profile`.`personal` LIKE '%".$arCnd['keyword']."%' "; 
					$cnd .= " OR `profile`.`firstName` LIKE '%".$arCnd['keyword']."%' "; 
					$cnd .= " OR `profile`.`lastName` LIKE '%".$arCnd['keyword']."%' ";
					$cnd .= " OR `profile`.`tutoring_subjects` LIKE '%".$arCnd['keyword']."%' ";
					//$cnd .= " OR `user`.`username` LIKE '%".$val."%' ";
					//$cnd .= " OR `user`.`email` LIKE '%".$val."%' ";
					//$cnd .= " OR `profile`.`city` LIKE '%".$val."%' ";	
				
				$cnd .= " ) ";
			}
			if (!empty($arCnd['subject'])) {
				$cnd .= " and (`profile`.`tutoring_subjects` LIKE '%".$arCnd['subject']."%')";
			}
			if (!empty($arCnd['lang1'])) {
				$cnd .= " and (`profile`.`nativeLanguage` = '".$arCnd['lang1']."')";
			}
			if (($arCnd['gender']!="") and ($arCnd['gender']!="all") ) {
				$cnd .= " and (`profile`.`gender` = '".$arCnd['gen']."') ";
			}
			if (!empty($arCnd['country'])) {
				$cnd .= " and (`profile`.`country` = '".$arCnd['con']."') ";
			}
			if (!empty($arCnd['state']) and $arCnd['state'] != 2) {
				$cnd .= " and (`profile`.`province` = '".$arCnd['sta']."') ";
			}
		
		}
		//$cnd .= " and (`profile`.`pic` != '') and (`profile`.`BioGraphy` != '0') and `quarantine` != '1' and `hiddenRole` = '0'";
		//$selectChkFreeSession = "";
		//$setPrfHrate = ", `profile`.`hRate` "; 
		/*$sqlTotal = "SELECT COUNT(`user`.`id`) as `total` from `user` JOIN `profile` ON `user`.`id` = `profile`.`uid` $qryTimeSlot LEFT JOIN `countries` ON `countries`.`id` = `profile`.`country` LEFT JOIN `provices` on `provices`.`id` = `profile`.`province` WHERE `user`.`roleId` IN (1,2,3) $cnd ";		*/
		$sqlTotal = "SELECT COUNT(`user`.`id`) as `total` from `user` INNER JOIN `profile` ON `user`.`id` = `profile`.`uid` WHERE `user`.`roleId` IN (1,2,3) and `profile`.`pic_upload` = 1 and `profile`.`uid` != $user_id and `profile`.`BioGraphy` = 1 and `profile`.`vid_upload` = 1  $cnd ";
		$queryTotal = $this->db->query($sqlTotal);
		$resultTotal = $queryTotal->result_array();
		$result = array();
		$response['totalCount'] = $resultTotal[0]['total'];
		$response['results'] = array();
		if ($response['totalCount'] > 0) { 
		if($arCnd['state'] != 2 && $arCnd['state'] != ''){
			$sql = "SELECT `user`.`id`,  `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`hRate` ,`profile`.`lastName`, `profile`.`pic`,`profile`.`avgRate`, `countries`.`country`, `provices`.`provice` from `user` INNER JOIN `profile` ON  `user`.`id` = `profile`.`uid` INNER JOIN `countries` ON `countries`.`id` = `profile`.`country` INNER JOIN `provices` on `provices`.`id` = `profile`.`province` WHERE `user`.`roleId` IN (1,2,3) and `profile`.`pic_upload` = 1 and `profile`.`uid` != $user_id and `profile`.`BioGraphy` = 1  $cnd order by $orderBy $order ";
			/*$sql = "SELECT `user`.`id`, `user`.`free_session`, `user`.`exp_session`, `user`.`is_eligible`, `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`lastName`, `profile`.`hRate`, `profile`.`pic`, `profile`.`school_id`, `profile`.`avgRate`, `profile`.`city` $selectChkFreeSession from `user` JOIN `profile` ON  `user`.`id` = `profile`.`uid` WHERE `user`.`roleId` IN (1,2,3) $cnd order by $orderBy $order LIMIT $offset, $limit ";*/
		}else{
			$sql = "SELECT `user`.`id`,  `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`hRate` ,`profile`.`lastName`, `profile`.`pic`,`profile`.`avgRate`, `countries`.`country` from `user` INNER JOIN `profile` ON  `user`.`id` = `profile`.`uid` INNER JOIN `countries` ON `countries`.`id` = `profile`.`country` WHERE `user`.`roleId` IN (1,2,3) and `profile`.`pic_upload` = 1 and `profile`.`uid` != $user_id and `profile`.`BioGraphy` = 1  $cnd order by $orderBy $order ";
			
		}
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$response['results'] = $query->result_array();
			}
			
			
		}
		
		return $response;
		
		
	}
	
	public function getResult_advance($arCnd=array(),$user_id){
		
		$cnd = "(`profile`.`firstName` != '')";
		$snd_sub = "";
		// Check Order By
		$orderBy = "`readytotalk` DESC, `user`.`roleId` DESC, `nativeLanguage` ASC,`profile`.`avgRate` DESC ,RAND() ";
		$order = "";			
		if (!empty($arCnd)) {
			if (!empty($arCnd['subject'])) {
				$snd_sub .= " and (`profile`.`tutoring_subjects` LIKE '%".$arCnd['subject']."%')";
			}
			/*if (!empty($arCnd['lang1'])) {
				$cnd .= " or (`profile`.`nativeLanguage` = '".$arCnd['lang1']."')";
			}
			if (($arCnd['gender']!="") and ($arCnd['gender']!="all") ) {
				$cnd .= " or (`profile`.`gender` = '".$arCnd['gen']."') ";
			}
			if (!empty($arCnd['country'])) {
				$cnd .= " or (`profile`.`country` = '".$arCnd['con']."') ";
			}
			if (!empty($arCnd['state']) and $arCnd['state'] != 2) {
				$cnd .= " or (`profile`.`province` = '".$arCnd['sta']."') ";
			}
			if (!empty($arCnd['keyword'])) {
				//$keywords = explode(' ',trim($arCnd['keyword']));
				$cnd .= " or ( ";	
					$cnd .= " `profile`.`academic` LIKE '%".$arCnd['keyword']."%' ";
					$cnd .= " OR `profile`.`professional` LIKE '%".$arCnd['keyword']."%' "; 
					$cnd .= " OR `profile`.`personal` LIKE '%".$arCnd['keyword']."%' "; 
					//$cnd .= " OR `profile`.`firstName` LIKE '%".$val."%' "; 
					//$cnd .= " OR `profile`.`lastName` LIKE '%".$val."%' ";
					//$cnd .= " OR `user`.`username` LIKE '%".$val."%' ";
					//$cnd .= " OR `user`.`email` LIKE '%".$val."%' ";
					//$cnd .= " OR `profile`.`city` LIKE '%".$val."%' ";	
				
				$cnd .= " ) ";
			}  */
		}
		//$cnd .= " and (`profile`.`pic` != '') and (`profile`.`BioGraphy` != '0') and `quarantine` != '1' and `hiddenRole` = '0'";
		//$selectChkFreeSession = "";
		//$setPrfHrate = ", `profile`.`hRate` "; 
		/*$sqlTotal = "SELECT COUNT(`user`.`id`) as `total` from `user` JOIN `profile` ON `user`.`id` = `profile`.`uid` $qryTimeSlot LEFT JOIN `countries` ON `countries`.`id` = `profile`.`country` LEFT JOIN `provices` on `provices`.`id` = `profile`.`province` WHERE `user`.`roleId` IN (1,2,3) $cnd ";		*/
		$sqlTotal = "SELECT COUNT(`user`.`id`) as `total` from `user` INNER JOIN `profile` ON `user`.`id` = `profile`.`uid` WHERE  $cnd and `user`.`roleId` IN (1,2,3) and `user`.`readytotalk` = 1 and `profile`.`pic_upload` = 1 and `profile`.`uid` != $user_id and `profile`.`BioGraphy` = 1 $snd_sub ";
		$queryTotal = $this->db->query($sqlTotal);
		$resultTotal = $queryTotal->result_array();
		$result = array();
		$response['totalCount'] = $resultTotal[0]['total'];
		$response['results'] = array();
		if ($response['totalCount'] > 0) { 
		if($arCnd['state'] != 2 && $arCnd['state'] != ''){
			$sql = "SELECT `user`.`id`,  `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`hRate` ,`profile`.`lastName`, `profile`.`pic`,`profile`.`avgRate`, `countries`.`country`, `provices`.`provice` from `user` INNER JOIN `profile` ON  `user`.`id` = `profile`.`uid` INNER JOIN `countries` ON `countries`.`id` = `profile`.`country` INNER JOIN `provices` on `provices`.`id` = `profile`.`province` WHERE $cnd and `user`.`readytotalk` = 1  and `user`.`roleId` IN (1,2,3) and `profile`.`pic_upload` = 1 and `profile`.`uid` != $user_id and `profile`.`BioGraphy` = 1 $snd_sub order by $orderBy $order ";
			/*$sql = "SELECT `user`.`id`, `user`.`free_session`, `user`.`exp_session`, `user`.`is_eligible`, `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`lastName`, `profile`.`hRate`, `profile`.`pic`, `profile`.`school_id`, `profile`.`avgRate`, `profile`.`city` $selectChkFreeSession from `user` JOIN `profile` ON  `user`.`id` = `profile`.`uid` WHERE `user`.`roleId` IN (1,2,3) $cnd order by $orderBy $order LIMIT $offset, $limit ";*/
		}else{
			$sql = "SELECT `user`.`id`,  `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`hRate` ,`profile`.`lastName`, `profile`.`pic`,`profile`.`avgRate`, `countries`.`country` from `user` INNER JOIN `profile` ON  `user`.`id` = `profile`.`uid` INNER JOIN `countries` ON `countries`.`id` = `profile`.`country` WHERE  $cnd and `user`.`readytotalk` = 1 and   `user`.`roleId` IN (1,2,3) and `profile`.`pic_upload` = 1 and `profile`.`uid` != $user_id and `profile`.`BioGraphy` = 1 $snd_sub order by $orderBy $order ";
			
		}
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$response['results'] = $query->result_array();
			}
			
			
		}
		
		return $response;
		
	}
	
	public function getResult_advance_fast($arCnd=array(),$user_id){
		
		$cnd = "(`profile`.`firstName` != '')";
		$snd_sub = "";
		// Check Order By
		$orderBy = "`readytotalk` DESC, `user`.`roleId` DESC, `nativeLanguage` ASC,`profile`.`avgRate` DESC , RAND()";
		$order = "";			
		if (!empty($arCnd)) {
			if (!empty($arCnd['subject'])) {
				$snd_sub .= " and (`profile`.`tutoring_subjects` LIKE '%".$arCnd['subject']."%')";
			}
			/*if (!empty($arCnd['lang1'])) {
				$cnd .= " or (`profile`.`nativeLanguage` = '".$arCnd['lang1']."')";
			}
			if (($arCnd['gender']!="") and ($arCnd['gender']!="all") ) {
				$cnd .= " or (`profile`.`gender` = '".$arCnd['gen']."') ";
			}
			if (!empty($arCnd['country'])) {
				$cnd .= " or (`profile`.`country` = '".$arCnd['con']."') ";
			}
			if (!empty($arCnd['state']) and $arCnd['state'] != 2) {
				$cnd .= " or (`profile`.`province` = '".$arCnd['sta']."') ";
			}
			if (!empty($arCnd['keyword'])) {
				//$keywords = explode(' ',trim($arCnd['keyword']));
				$cnd .= " or ( ";	
					$cnd .= " `profile`.`academic` LIKE '%".$arCnd['keyword']."%' ";
					$cnd .= " OR `profile`.`professional` LIKE '%".$arCnd['keyword']."%' "; 
					$cnd .= " OR `profile`.`personal` LIKE '%".$arCnd['keyword']."%' "; 
					//$cnd .= " OR `profile`.`firstName` LIKE '%".$val."%' "; 
					//$cnd .= " OR `profile`.`lastName` LIKE '%".$val."%' ";
					//$cnd .= " OR `user`.`username` LIKE '%".$val."%' ";
					//$cnd .= " OR `user`.`email` LIKE '%".$val."%' ";
					//$cnd .= " OR `profile`.`city` LIKE '%".$val."%' ";	
				
				$cnd .= " ) ";
			}  */
		}
		//$cnd .= " and (`profile`.`pic` != '') and (`profile`.`BioGraphy` != '0') and `quarantine` != '1' and `hiddenRole` = '0'";
		//$selectChkFreeSession = "";
		//$setPrfHrate = ", `profile`.`hRate` "; 
		/*$sqlTotal = "SELECT COUNT(`user`.`id`) as `total` from `user` JOIN `profile` ON `user`.`id` = `profile`.`uid` $qryTimeSlot LEFT JOIN `countries` ON `countries`.`id` = `profile`.`country` LEFT JOIN `provices` on `provices`.`id` = `profile`.`province` WHERE `user`.`roleId` IN (1,2,3) $cnd ";		*/
		$sqlTotal = "SELECT COUNT(`user`.`id`) as `total` from `user` INNER JOIN `profile` ON `user`.`id` = `profile`.`uid` WHERE  $cnd and `user`.`roleId` IN (1,2,3) and `profile`.`pic_upload` = 1 and `profile`.`uid` != $user_id and `profile`.`BioGraphy` = 1 $snd_sub ";
		$queryTotal = $this->db->query($sqlTotal);
		$resultTotal = $queryTotal->result_array();
		$result = array();
		$response['totalCount'] = $resultTotal[0]['total'];
		$response['results'] = array();
		if ($response['totalCount'] > 0) { 
		if($arCnd['state'] != 2 && $arCnd['state'] != ''){
			$sql = "SELECT `user`.`id`,  `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`hRate` ,`profile`.`lastName`, `profile`.`pic`,`profile`.`avgRate`, `countries`.`country`, `provices`.`provice` from `user` INNER JOIN `profile` ON  `user`.`id` = `profile`.`uid` INNER JOIN `countries` ON `countries`.`id` = `profile`.`country` INNER JOIN `provices` on `provices`.`id` = `profile`.`province` WHERE $cnd  and `user`.`roleId` IN (1,2,3) and `profile`.`pic_upload` = 1 and `profile`.`uid` != $user_id and `profile`.`BioGraphy` = 1 $snd_sub order by $orderBy $order ";
			/*$sql = "SELECT `user`.`id`, `user`.`free_session`, `user`.`exp_session`, `user`.`is_eligible`, `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`lastName`, `profile`.`hRate`, `profile`.`pic`, `profile`.`school_id`, `profile`.`avgRate`, `profile`.`city` $selectChkFreeSession from `user` JOIN `profile` ON  `user`.`id` = `profile`.`uid` WHERE `user`.`roleId` IN (1,2,3) $cnd order by $orderBy $order LIMIT $offset, $limit ";*/
		}else{
			$sql = "SELECT `user`.`id`,  `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`hRate` ,`profile`.`lastName`, `profile`.`pic`,`profile`.`avgRate`, `countries`.`country` from `user` INNER JOIN `profile` ON  `user`.`id` = `profile`.`uid` INNER JOIN `countries` ON `countries`.`id` = `profile`.`country` WHERE  $cnd and   `user`.`roleId` IN (1,2,3) and `profile`.`pic_upload` = 1 and `profile`.`uid` != $user_id and `profile`.`BioGraphy` = 1 $snd_sub order by $orderBy $order ";
			
		}
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$response['results'] = $query->result_array();
			}
			
			
		}
		
		return $response;
		
	}
	public function get_subjects(){
		//$this->db->select('guide_categories_id,name');
		$this->db->select('id,subject');
		$this->db->order_by('subject','ASC');
		//$query = $this->db->get('guide_categories');
		$query = $this->db->get('tutoring_subject');
		//$result  = $query->row_array();
		$result = $query->result();
		return $result;
	}
	 public function gethistory($uid,$offset){
		/*$this->db->select('roleId');
		$this->db->where('id',$uid);
		$query = $this->db->get('user');
		$result  = $query->row_array();*/
		/*
		if($result['roleId'] == '0'){
			$sql = "SELECT class.fee as fee , class.createAt, tProfile.firstName as tFN,tProfile.lastName as tLN,sProfile.firstName as sFN,sProfile.lastName AS sLN, tProfile.uid as tID,sProfile.uid as sID FROM class INNER JOIN profile AS tProfile ON tProfile.uid = class.tid INNER JOIN profile AS sProfile ON sProfile.uid = class.sid";
			$sql .= " where (tid={$uid} or sid={$uid} or class.school_id={$uid}) and s_attend =1 order by endTime desc LIMIT {$offset}, 20";
		}else{*/
			$sql = "SELECT class.t_hrate as t_hrate ,class.fee as fee , class.createAt, tProfile.firstName as tFN,tProfile.lastName as tLN,sProfile.firstName as sFN,sProfile.lastName AS sLN, tProfile.uid as tID,sProfile.uid as sID FROM class INNER JOIN profile AS tProfile ON tProfile.uid = class.tid INNER JOIN profile AS sProfile ON sProfile.uid = class.sid";
			$sql .= " where (tid={$uid} or sid={$uid}) and s_attend =1 order by endTime desc LIMIT {$offset}, 20";
		//}
		//$sql = "SELECT class.fee , class.createAt, profile.firstName , profile.lastName FROM class INNER JOIN profile ON profile.uid = class.tid";
		//$sql .= " where (tid={$uid} or sid={$uid} or class.school_id={$uid}) and s_attend =1 order by endTime desc LIMIT {$offset}, 10";
		
		$result = array();
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	} 
	public function total_money($cid){
		$this->db->select('profile.*');
		$this->db->from('profile');
		$this->db->join('class','profile.uid = class.sid', 'inner');
		$this->db->where('class.id',$cid);
		$query = $this->db->get();
		$result  = $query->row_array();
		//$result = $query->result();
		return $result;
	}
	
	public function last_session_info($cid){
		$this->db->select('class.*');
		$this->db->from('class');
		$this->db->where('id',$cid);
		$query = $this->db->get();
		$result  = $query->row_array();
		
		if($result){
			$this->db->select('class.*');
			$this->db->from('class');
			$this->db->order_by('id','desc');
			$this->db->where('sid',$result['sid']);
			$this->db->where('id <',$cid);
			$query_data = $this->db->get();
			$result_data  = $query_data->row_array();
			
			return $result_data;
		}else{
			return $result;
		}
		
		
	}
	public function total_money_add($cid){
		$this->db->select('profile.*');
		$this->db->from('profile');
		$this->db->join('class','profile.uid = class.tid', 'inner');
		$this->db->where('class.id',$cid);
		$query = $this->db->get();
		$result  = $query->row_array();
		//$result = $query->result();
		return $result;
	}
	public function deduct_from_account($id,$amount){
		
		$this->db->set('money', 'money-'.$amount, FALSE);
		//$this->db->set('purchased_credits', 'purchased_credits-'.$amount, FALSE);
		$this->db->set('frMoney', 'frMoney+'.$amount, FALSE);
		$this->db->where('uid',$id);
		$this->db->update('profile');
		
		$this->db->select('money');
		$this->db->where('uid',$id);
		$query = $this->db->get('profile');
		//$result  = $query->row_array();
		$result = $query->row_array();
		
		if($result['money'] < 3){
			$this->db->select('uid');
			$this->db->where('uid',$id);
			$queries = $this->db->get('low_balance_notification');
		//$result  = $query->row_array();
		$results = $queries->row_array();

			if(empty($results)){
			 $data = array(
					'uid'=>$id,
					'balance'=>$result['money'],
					'date'=>date('Y-m-d h:i:s')
				);				 
				$this->db->insert('low_balance_notification', $data); 
			}
		}
		
		return $result;
	}
	public function add_in_account($id,$amount){
		
		$this->db->set('money', 'money+'.$amount, FALSE);
		//$this->db->set('purchased_credits', 'purchased_credits-'.$amount, FALSE);
		//$this->db->set('frMoney', 'frMoney+'.$amount, FALSE);
		$this->db->where('uid',$id);
		$this->db->update('profile');
		return true;
	}
	public function low_balance_users(){
		$this->db->select('low_balance_notification.*,profile.firebase_regId');
		$this->db->from('low_balance_notification');
		$this->db->join('profile','low_balance_notification.uid = profile.uid', 'inner');
		//$this->db->where('low_balance_notification.uid',$cid);
		$query = $this->db->get();
		//$result  = $query->row_array();
		$result = $query->result();
		return $result;
	}
	public function feedback_form($feedback_data = array()){
		if (!empty($feedback_data)) {
			$this->db->insert('feedback', $feedback_data); 
			
			$this->db->select('clearReception');
			$this->db->from('feedback');
			$this->db->where('receiverId',$feedback_data['receiverId']);
			$this->db->where('clearReception !=', 0 ,FALSE);
			$query = $this->db->get();
			$result  = $query->result();
			
			$max = 0;
			$n = count($result);
			foreach ($result as $value) {
				$values = $value->clearReception;
				if($values != 0 && $values != ''){
					$max = $max+$value->clearReception;
				}
				
				//$array[] = $value->clearReception;
			}
			$avarage_d_rate =  ($max / $n);
			
			$this->db->set('avgRate', $avarage_d_rate);
			$this->db->where('uid',$feedback_data['receiverId']);
			$this->db->update('profile');
			
			return true;
		} else {			
			return false;
		}
	}
	public function set_rate($price,$id){	
			$sql_log="update profile set  hRate = '$price' where  uid = '$id'";			
			$sql = $this->db->query($sql_log);
			if($sql){
				return true;
			}else{
				return false;
			}
	}
	
	public function subject_list_language(){
		$this->db->select('*');
		$this->db->order_by('subject','ASC');
		$this->db->where('category','language');
		$query = $this->db->get('tutoring_subject');
		//$result  = $query->row_array();
		$result = $query->result();
		return $result;
	}
	public function subject_list_general(){
		$this->db->select('*');
		$this->db->order_by('subject','ASC');
		$this->db->where('category','general');
		$query = $this->db->get('tutoring_subject');
		//$result  = $query->row_array();
		$result = $query->result();
		return $result;
	}
	public function save_subject($id,$subject){
		$this->db->set('tutoring_subjects', $subject);
		$this->db->where('uid',$id);
		$this->db->update('profile');
		return $subject;
		
	}
	public function tutor_availability_check($uid){
		$this->db->select('uid');
		$this->db->from('tutor_availability');
		$this->db->where('uid',$uid);
		$query = $this->db->get();
		$result  = $query->row_array();
		//$result = $query->result();
		return $result;
		
	}
	public function tutor_availability_update($uid,$data){
		$this->db->set('start_time', $data['start_time']);
		$this->db->set('end_time', $data['end_time']);
		$this->db->set('sunday', $data['sunday']);
		$this->db->set('monday', $data['monday']);
		$this->db->set('tuesday', $data['tuesday']);
		$this->db->set('wednesday', $data['wednesday']);
		$this->db->set('thursday', $data['thursday']);
		$this->db->set('friday', $data['friday']);
		$this->db->set('saturday', $data['saturday']);
		$this->db->where('uid',$uid);
		$this->db->update('tutor_availability');
		return true;
	}
	
	public function tutor_availability_info($uid){
		$this->db->select('*');
		$this->db->from('tutor_availability');
		$this->db->where('uid',$uid);
		$query = $this->db->get();
		$result  = $query->row_array();
		return $result;
	}
	
	public function get_reviews($uid){
		
		/* $this->db->select('p.firstName, p.pic,p.uid,feedback.create_at,feedback.clearReception,feedback.msg');
		$this->db->from('feedback');
		$this->db->order_by('feedback.create_at','DESC');
		$this->db->join('profile p','p.uid = feedback.receiverId', 'inner');
		$this->db->join('profile s','s.uid = feedback.callerId', 'inner');
		$this->db->where("(feedback.callerId = $uid or feedback.receiverId = $uid)");
		//$this->db->where('s.uid !=',$uid);
		$this->db->where('feedback.clearReception !=',0,TRUE);
		$query = $this->db->get();
		$result  = $query->result();
		
		print_r($result);
		exit; */ 
	 	 $this->db->select('profile.firstName, profile.pic,feedback.create_at,feedback.clearReception,feedback.msg');
		$this->db->from('feedback');
		$this->db->order_by('feedback.create_at','DESC');
		$this->db->join('profile','profile.uid = feedback.receiverId', 'inner');
		$this->db->where('feedback.callerId',$uid);
		$this->db->where('feedback.clearReception !=',0,TRUE);
		$query = $this->db->get();
		$result  = $query->result();
		
		
		
		$this->db->select('profile.firstName, profile.pic,feedback.create_at,feedback.clearReception,feedback.msg');
		$this->db->from('feedback');
		$this->db->order_by('feedback.create_at','DESC');
		$this->db->join('profile','profile.uid = feedback.callerId', 'inner');
		$this->db->where('feedback.receiverId',$uid);
		$this->db->where('feedback.clearReception !=',0,TRUE);
		$queries = $this->db->get();
		$results  = $queries->result();
		
		//print_r($results);
		//exit; 
		
		//$final_result = array_merge($result,$results);  
		
		
		return $results;
		
	}
	
	public function biography_video($uid){
		$this->db->select('lessons.id,lessons.name,lessons.desc,lessons.source,lessons.views,profile.firstName,profile.lastName');
		$this->db->from('lessons');
		$this->db->order_by("lessons.id", "desc");
		$this->db->join('profile',' lessons.uid = profile.uid', 'inner');
		$this->db->where('lessons.uid',$uid);
		//$this->db->limit(5);
		$query = $this->db->get();
		//$result  = $query->row_array();
		$result = $query->result();
		return $result;
	}
	
	public function ttl_points($cid,$time_sec){
		$time = $time_sec;
		$minute = ($time / 60);
	
		$whole = floor($minute);
		$fraction = $minute - $whole; 
		if($fraction > 0){
			$total_minute = $whole + 1;
		}else{
			$total_minute = $minute;
		}
		$ttl_point = (($total_minute * 10) / 60);
		$points = number_format($ttl_point, 2, '.', '');
		
		$this->db->select('tid,sid');
		$this->db->from('class');
		$this->db->where('id',$cid);
		$query = $this->db->get();
		$result  = $query->row_array();
		if($result){
			$this->db->set('ttl_points', 'ttl_points+'.$points, FALSE);
			$this->db->where('uid',$result['tid']);
			$this->db->update('profile');
			
			$this->db->set('ttl_points', 'ttl_points+'.$points, FALSE);
			$this->db->where('uid',$result['sid']);
			$this->db->update('profile');
			
			return $points;
		}else{
			return false;
		}
	}
	
	public function tutor_info($tutor_id){
		$sql = "SELECT `user`.`id`,  `user`.`readytotalk`, `user`.`roleId`, `profile`.`uid`, `profile`.`firstName`, `profile`.`hRate` ,`profile`.`lastName`, `profile`.`pic`,`profile`.`avgRate`, `countries`.`country` from `user` INNER JOIN `profile` ON  `user`.`id` = `profile`.`uid` INNER JOIN `countries` ON `countries`.`id` = `profile`.`country` WHERE `user`.`roleId` IN (1,2,3) and `profile`.`pic_upload` = 1 and `profile`.`uid` = $tutor_id";

		$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$response['results'] = $query->result_array();
			}
		return $response;
	}
	public function ttl_points_reward_credit($data = array()){
		if (!empty($data)) {
			$this->db->insert('rewards_table', $data); 
			$id =  $this->db->insert_id();
			
		
			if($id){
				$this->db->set('ttl_points', 'ttl_points-200', FALSE);
				$this->db->set('money', 'money+10', FALSE);
				$this->db->set('coupon_credits', 'coupon_credits+10', FALSE);
				$this->db->where('uid',$data['userId']);
				$update	= $this->db->update('profile');
				
				$this->db->where('uid',$data['userId']);
				$delete = $this->db->delete('low_balance_notification');
				
				$this->db->select('ttl_points,money');
				$this->db->from('profile');
				$this->db->where('uid',$data['userId']);
				$query = $this->db->get();
				$result  = $query->row_array();
				return $result;
				
			}
			
		} else {			
			return false;
		}
	}
	
	public function ttl_points_reward_travel($data = array()){
		if (!empty($data)) {
			$this->db->insert('rewards_table', $data); 
			$id =  $this->db->insert_id();
			
			if($id){
				$this->db->set('ttl_points', 'ttl_points-200', FALSE);
				$this->db->where('uid',$data['userId']);
				$update	= $this->db->update('profile');
				
				$this->db->select('ttl_points,email,firstName');
				$this->db->from('profile');
				$this->db->where('uid',$data['userId']);
				$query = $this->db->get();
				$result  = $query->row_array();
				return $result;
				
			}
			
		} else {			
			return false;
		}
	}
	public function delete_bio_video($video_id,$user_id){
		$this->db->where('uid', $user_id);
		$this->db->where('id', $video_id);
		$delete = $this->db->delete('lessons');
		if($delete){
			$this->db->select('lessons.id,lessons.name,lessons.desc,lessons.source,lessons.views,profile.firstName,profile.lastName');
			$this->db->from('lessons');
			$this->db->order_by("lessons.id", "desc");
			$this->db->join('profile',' lessons.uid = profile.uid', 'inner');
			$this->db->where('lessons.uid',$user_id);
			//$this->db->limit(5);
			$query = $this->db->get();
			//$result  = $query->row_array();
			if($query->num_rows() > 0){
				$result = $query->result();
				return $result;
			}else{
				$result = "No Video Found For this User.";
				return $result;
			}
		}else{
			return false;
		}
		
	}
	
	public function profile_check($uid){
		$this->db->select('tutoring_subjects');
		$this->db->from('profile');
		$this->db->where('uid',$uid);
		$queries = $this->db->get();
		$results = $queries->row_array();
		if($results['tutoring_subjects'] == '[]' || $results['tutoring_subjects'] == ''){
			$tutoring_subject['tutoring_subjects'] = "0";
		}else{
			$tutoring_subject['tutoring_subjects'] = "1";
		}
		
		$this->db->select('pic_upload,vid_upload,BioGraphy');
		$this->db->from('profile');
		$this->db->where('uid',$uid);
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $key){
			$condition['pic_upload'] = $key->pic_upload;
			$condition['vid_upload'] = $key->vid_upload;
			$condition['BioGraphy'] = $key->BioGraphy;
			$condition['tutoring_subjects'] = $tutoring_subject['tutoring_subjects'];
		}
		return $condition;	
	}
}
?>