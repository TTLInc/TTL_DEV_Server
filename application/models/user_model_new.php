<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends TL_Model{

	protected $useCached = true;
	protected $cacheTime = 1800;
	public function __construct() {
	
		parent::__construct();
		$this->load->driver('cache', array('adapter' => 'file', 'backup' => 'file'));
                $this->db->cache_on();
		$multi_lang = 'en';
		if(!isset($_SESSION)) {
			 session_start();
		}
		if(isset($_SESSION['multi_lang'])){
			$multi_lang = $_SESSION['multi_lang'];
		}else{
			$multi_lang = 'en';	
		}
	}
	/**
	 * check the user login or not.
	 */
	public function isLogin() {
	
		if(!$this->session->userdata('username')){
			return false;
		}
		return true;
	}
	function isAdminLogin(){
		if(!$this->session->userdata('adminUsername')){
			return false;
		}
		return true;
	}
	public function del($id){
		foreach($id as $v){
			$sql = "DELETE FROM user WHERE  id={$v}";
			$this->db->query($sql);
			$sql = "DELETE FROM profile WHERE  uid={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	public function changePassword($uid,$newPassword,$needOldPass = false,$oldPassword=''){
		if($needOldPass){
			$sql = "select id from user where id={$uid}";
			$query = $this->db->query($sql);
			if ($query->num_rows() <= 0) {
				return 'Current password is incorrect.';
			}
		}
		$sql = "update user set password='".md5($newPassword)."' where id={$uid}";
		$this->db->query($sql);
		return 'Update success.';
	}

	//--R&D@Dec-05 STARTS
	public function user_addnote($data) {
		$sql 					= "INSERT INTO user_notes set  ";
		$sql					.=" dispute_id=?,user_id=?,note=?,role=?,add_date=?";
		$query 					= $this->db->query($sql,array($data['dispute_id'],$data['user_id'],$data['note'],$data['role'],$data['date']));
		return  $this->db->insert_id();
	}
	public function getAllUserNotes($start,$sort,$sortorder){
		$user = $this->input->_request('id');

		$start = 0;
		$result = array();
		$length = 20;
		$sql = "SELECT * FROM user_notes  WHERE user_id={$user}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		//echo '<pre>';print_r($result);exit;
		return $result;
	}
	public function getUserNote($user_id){
		$result = array();
		$sql = "SELECT * FROM user_notes WHERE user_id={$user_id}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getAllUserNotesBySearch($search = ''){
		$result = array();
		$length = 20;
		$sql   = "SELECT * FROM user_notes WHERE dispute_id like '{$search}' OR note like '{$search}' OR role like '%{$search}%' OR add_date like '%{$search}%'  ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getAdevertise(){
		
		$today = date('Y-m-d');  
         
		$sql   = "SELECT * FROM advertisement WHERE status='Active' and expdate >= '{$today}' and container= '1'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getAdevertise1(){
		
		$today = date('Y-m-d');  

		$sql   = "SELECT * FROM advertisement WHERE status='Active' and expdate >= '{$today}' and container= '2'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getAdevertise2(){
		
		$today = date('Y-m-d');  

		$sql   = "SELECT * FROM advertisement WHERE status='Active' and expdate >= '{$today}' and container= '3'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getNoteCount(){
		$result = array();
		$length = 20;
		$sql = "SELECT * FROM user_notes";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];

	}
	public function getNoteCountBySearch($start = 0,$search = '',$sort,$sortorder,$length = 20){		
		$result = array();
		$length = 20;
		$sql   = "SELECT * FROM user_notes WHERE dispute_id like '{$search}' OR note like '{$search}' OR role like '%{$search}%' OR add_date like '%{$search}%'  order by {$sort} {$sortorder} limit {$start} , {$length}";
		
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	public function getExpDateByUid($id){
		$sql   = "SELECT * FROM pay WHERE uid={$id}  order by id DESC LIMIT 0,1";
		$query = $this->db->query($sql);
		$result = array();
		$result['expDate'] = '';
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function  updateExpDate($date , $id){
		$selectsql = "select id from pay where uid = {$id}";
		$selectquery = $this->db->query($selectsql);
		if ($selectquery->num_rows() > 0) {
			$sql = "UPDATE pay SET expDate = '{$date}' WHERE uid = {$id}";
			$query11 = $this->db->query($sql);
		}else{
			$sql = "insert into pay SET uid = '{$id}', expDate = '{$date}'";
			$query11 = $this->db->query($sql);
		}
	}

	// update click count
	public function Updatecounter($id)
	{
	    $sql   = "SELECT * FROM advertisement WHERE advertisementid='$id'";
		$query = $this->db->query($sql);
	    if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		$adnum=$result[0]['click_number']+1;
		$sql1 = "UPDATE advertisement SET click_number = '{$adnum}' WHERE advertisementid = '{$id}'";
		$query11 = $this->db->query($sql1);
	}
	
	
	//change teacher role
	public function UpdateTeacherRole($id)
	{
	    
		$sql1 = "UPDATE user SET roleId = '2' WHERE id = '{$id}'";
		$query11 = $this->db->query($sql1);
	}
	
	// add tutor to organization haren
	public function AddtoSchool($uid,$sid)
	{
	    $sql = "UPDATE profile SET school_id = '{$sid}' WHERE uid = '{$uid}'";
		$query = $this->db->query($sql);
		
		$sql1 = "insert into tutor_school set user_id={$uid},school_id='{$sid}'";
		$query1 = $this->db->query($sql1);
		if($query && $query1)
		{
		return true;
		}
		else
		{
		return false;
		}
	}
	//--R&D@Dec-05 ENDS
	
	
	
	
	
	
	/**
	 * save user info
	 * @param $userinfo
	 */
	 /*
	Function will occure when user will make a new registration.
	User has to enter details in it.
	*/
	public function register($userinfo) {
	 
		$userinfo['password'] = md5($userinfo['password']);
 
		$startdate = date('Y-m-d');
		$exp_seeion = date( 'Y-m-d ',strtotime($startdate ."+1 week"));
         $refid = $userinfo['refid'];
		$sql = "insert into user set add_time=now(),exp_session='$exp_seeion',refid='$refid', forwardemail='1',";
		$sql.="username=?,email=?,password=?,roleId=?,free_session=?,timezone=?";
		$query = $this->db->query($sql,array($userinfo['email'],$userinfo['email'],$userinfo['password'],$userinfo['roleId'], $userinfo['free_session'],$userinfo['timezone']));
		return $this->db->insert_id();
	}
	/**
	 * @author R&D
	 * weibo secion
	 */
	//----R&D@Oct-18-2013 : Check if Weibo user exists
	public function check_weibo_user($userinfo) {
		$result 				= array();
		$sql 					= "SELECT * FROM user WHERE username=? OR email=? limit 1";
		$query 					= $this->db->query($sql,array($userinfo['username'],$userinfo['emiail']));
		if ($query->num_rows() > 0){
			$result = $query->row_array();
		}
		return $result;
	}
	//----R&D@Oct-18-2013 : Check if Weibo user exists
	//----R&D@Oct-18-2013 : Enter weibo user details
	public function weibo_register($userinfo) {
		$userinfo['password'] 	= md5($userinfo['password']);
		$sql 					= "INSERT INTO user SET add_time=now(),forwardemail='1',";
		$sql					.="username=?,email=?,password=?,roleId=?,free_session=?,timezone=?";
		$query = $this->db->query($sql,array($userinfo['username'],$userinfo['email'],$userinfo['password'],$userinfo['roleId'], $userinfo['free_session'],$userinfo['timezone']));
		return  $this->db->insert_id();
	}
	//----R&D@Oct-18-2013 : Enter weibo user details
	//----R&D@Oct-18-2013 : Login User	
	public function weibo_login($userinfo) {
		$result 				= array();
		$sql 					= "SELECT * FROM user WHERE username=? and email=? limit 1";
		$query = $this->db->query($sql,array($userinfo['username'],$userinfo['email']));
		if ($query->num_rows() > 0){
			$result = $query->row_array();
		}
		return $result;
	}
	//----R&D@Oct-18-2013 : Login User	
	//----R&D@Oct-19-2013 : Check SOcial Promote	
	public function checkSocialPromote($userid){
		$userid = 430;
		$result 					= array();
		$checkSocialPromoteUser	= $this->db->query("SELECT * FROM social_promote WHERE user_id= ".$userid." limit 1");
		if ($checkSocialPromoteUser->num_rows() > 0){
			$result = $checkSocialPromoteUser->row_array();
		}else{
			$checkSocialPromoteClass	= $this->db->query("SELECT * FROM class WHERE sid= ".$userid. "   ORDER BY id DESC");
			if ($checkSocialPromoteClass->num_rows() != 0  && $checkSocialPromoteClass->num_rows() <= 2000){
				$checkSocialPromoteClassData = $checkSocialPromoteClass->row_array();
				$result['sid'] 		= $checkSocialPromoteClassData['sid'];
				$result['tid'] 		= $checkSocialPromoteClassData['tid'];
			}else{
				$result 					= array();
			}
		}
		return $result;
	}
	//----R&D@Oct-19-2013 : Check SOcial Promote
	public function upgrade($id){
		$data['roleId'] = 2;
		return $this->db->query($this->db->update_string('user',$data,"id={$id}"));
	} 
	/**
	 * login
	 * @param  $userinfo
	 */
	public function login($userinfo) {
		$result = array();
		$userinfo['password'] = md5($userinfo['password']);
		$sql = "select * from user where username=? and password=? limit 1";
		$query = $this->db->query($sql,array($userinfo['username'],$userinfo['password']));
		if ($query->num_rows() > 0){
			$result = $query->row_array();
		}
		return $result;
	}
	/**
	 * @author TECHNO-SANJAY
	 * log-in authentication by email
	 * @param $userinfo
	 */
	public function loginByEmail($userinfo) {
		$result = array();
		$userinfo['password'] = md5($userinfo['password']);
		$sql = "select * from user where email=? and password=? limit 1";
		$query = $this->db->query($sql,array($userinfo['email'],$userinfo['password']));
		if ($query->num_rows() > 0){
			$result = $query->row_array();
		}
		return $result;
	}
	/**
	 * get email from db
	 * @param $email
	 */
	function getEmail($email){
		$result = array();
		$sql = "select * from user where email=? limit 1";
		$query = $this->db->query($sql,array($email));
		if ($query->num_rows() > 0){
			$result = $query->row_array();
		}
		 
		return $result;
	}
	
	
	//by haren 
	
	function getpayemail($email){
		$result = array();
		$sql = "select * from profile where payment_account=? limit 1";
		$query = $this->db->query($sql,array($email));
		if ($query->num_rows() > 0){
			$result = $query->row_array();
		}
		 
		return $result;
	}
	/**
	 * get username from db
	 * @param $username
	 */
	function getUsername($username){
		$result = array();
		$sql = "select * from user where username=? limit 1";
		$query = $this->db->query($sql,array($username));
		if ($query->num_rows() > 0){
			$result = $query->row_array();
		}
		return $result;
	}
	
	function getUserEmail($useremail){
		$result = array();
		$sql = "select * from user where id=? limit 1";
		$query = $this->db->query($sql,array($useremail));
		if ($query->num_rows() > 0){
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function checkUserName($val) {
		$errorMsg = array();
		$errorMsg['success'] = false;
		if($val == '') {
			$errorMsg['message'] = 'Username cannot be empty.';
		}else if($this->getUsername($val)){
			$errorMsg['message'] = 'Username already exists.';
			$errorMsg['code'] = '100';
		}else {
			$errorMsg['success'] = true;
		}
		return $errorMsg;
	}
	public function checkPassword($val) {
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
		$errorMsg = array();
		$errorMsg['success'] = false;
		
		$this->load->model(array('lookup_model'));
		$arrVal = $this->lookup_model->getValue('807', $multi_lang);
		$passwordempty = $arrVal[$multi_lang];
		
		if($val == '') {
			$errorMsg['message'] = $passwordempty;
		}else {
			$errorMsg['success'] = true;
		}
		return $errorMsg;
	}
	public function checkEmail($val) {
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

		$errorMsg = array();
		$errorMsg['success'] = false;
		$this->load->model(array('lookup_model'));
		$arrVal = $this->lookup_model->getValue('805', $multi_lang);
		$emailnotempty = $arrVal[$multi_lang];
		$arrVal = $this->lookup_model->getValue('806', $multi_lang);		
		$emailexists = $arrVal[$multi_lang];
		$arrVal = $this->lookup_model->getValue('808', $multi_lang);		
		$validemail = $arrVal[$multi_lang];
	     
		if($val == '') {
			$errorMsg['message'] = $emailnotempty;
		}else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$val)) {
			$errorMsg['message'] = $validemail;
		}else if($this->getEmail($val)) {
			$errorMsg['message'] = $emailexists;
		}else {
			$errorMsg['success'] = true;
		}
		
		return $errorMsg;
	}
	
	//check paypal email  -- haren
		public function chkpayemail($val) {
		
		$errorMsg = array();
		$errorMsg['success'] = false;
		
		$this->load->model(array('lookup_model'));
		$arrVal = $this->lookup_model->getValue('805', $multi_lang);
		$emailnotempty = $arrVal[$multi_lang];
		$arrVal = $this->lookup_model->getValue('806', $multi_lang);
		$emailexists = $arrVal[$multi_lang];

		if($val == '') {
			$errorMsg['message'] = $emailnotempty;
		}else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$val)) {
			$errorMsg['message'] = 'Enter a valid e-mail';
		}else if($this->getpayemail($val)) {
			$errorMsg['message'] = $emailexists;
		}else {
			$errorMsg['success'] = true;
		}
		
		return $errorMsg;
	}
	
	
	
	public  function checkForgetInfo($data) {
		if($data['email']==''){
			return false;
		}
		$sql = "Select * from user where email='{$data['email']}'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			return true;
		}else{
			return false;
		}
	}
	public function changeFPassword($data){
		$sql = "update user set password='".md5($data['password'])."' where email='{$data['email']}'";
		$result = $this->db->query($sql);
		$sql = "DELETE FROM forget WHERE id={$data['fid']}";
		$result = $this->db->query($sql);
		return true;
	}
	public function makeMd5Str($data){
		$time = time();
		$md5Str = $data['username']. '[`]' .$data['email']. '[`]' .$time;
		$md5Str = md5($md5Str);
		$_data = array();
		$_data['str'] = $md5Str;
		$_data['time'] = $time;
		$_data['username'] = $data['username'];
		$_data['email'] = $data['email'];
		$sql = "delete from forget where email='{$data['email']}' and username='{$data['username']}'";
		$result = $this->db->query($sql);
		$sql = "insert into forget (username,email,str,time) values ('{$data['username']}','{$data['email']}','{$_data['str']}',{$time})";
		$result = $this->db->query($sql);
		return $_data;
	}
	public function checkMd5Str($data){
		$md5Str = base64_decode($data['username']). '[`]' .base64_decode($data['email']). '[`]' .$data['time'];
			$md5Str = md5($md5Str);
			if(base64_decode($data['str']) != $md5Str){
			return false;
		}
		$sql = "select * from `forget` where str='{$md5Str}' and time >  ".(time()-3600*24);
		$result = array();
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	/**
	 * get user login info from db
	 * @param $userid
	 */
	public function getByUid($uid){
		$result = array();
		
		if($uid == 2){
			$sql = "select * from user where id=2";
		}else{
			$sql = "Select * from user where id=".$uid;
		}
		// $sql = "select * from user where id={$uid}";
		// $sql = "select * from user where id=".$uid;
		// $sql = "select username,email,type,user_type,roleId,session_id,chat,hiddenRole,readytotalk,quarantine,disputes,forwardemail,user_firsttime,add_time,exp_session,timezone,refid from user where id={$uid} ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			
		}
		return $result;
	}

	public function getnameByUid($uid){
		$result = array();
		$sql = "select firstName,lastName from profile where uid={$uid} limit 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}

	public function getAll($start = 0,$length = 20){
		$result = array();
		$sql = "select * from user limit {$start} , {$length}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getAllAdmin($start = 0,$sort,$sortorder,$length = 20){
		$result = array();
		//$sql = "select u.*, CONCAT(p.firstName, ' ',p.lastName) as usernm , p.lms_complete from user as u,profile as p where u.id = p.uid order by {$sort} {$sortorder} limit {$start} , {$length}";
		$sql = "select u.*, (select expDate from pay c where uid = u.id order by id desc limit 0, 1) as expDate, CONCAT(p.firstName, ' ',p.lastName) as usernm from user as u,profile as p where u.id = p.uid order by {$sort} {$sortorder} limit {$start} , {$length}";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		
		return $result;
	}
	public function getAllAdminBySearch($start = 0,$search = '',$sort,$sortorder,$length = 20){
		$result = array();
		//$sql = "select u.*, CONCAT(p.firstName, ' ',p.lastName) as usernm , p.lms_complete from user as u,profile as p where u.id = p.uid and (u.id like '{$search}' OR u.email like '{$search}' OR p.firstnale like '%{$search}%' OR p.lastName like '%{$search}%' ) order by {$sort} {$sortorder} limit {$start} , {$length}";
		$sql = "select u.*, (select expDate from pay c where uid = u.id order by id desc limit 0, 1) as expDate, CONCAT(p.firstName, ' ',p.lastName) as usernm from user as u,profile as p where u.id = p.uid and (u.id like '{$search}' OR u.email like '{$search}' OR p.firstname like '%{$search}%' OR p.lastName like '%{$search}%' ) order by {$sort} {$sortorder} limit {$start} , {$length}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getCount(){
		$sql = "select count(id) as count from user";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	public function getCountBySearch($search){
		$sql = "select count(u.id) as count from user as u,profile as p where u.id = p.uid and (u.id like '{$search}' OR u.email like '{$search}' OR p.firstname like '%{$search}%' OR p.lastName like '%{$search}%' )";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	public function user_edit($data,$id){
	
		return $this->db->query($this->db->update_string('user',$data,"id={$id}"));
	}
	public function user_add($data){
		$lms_complete = $data['lms_complete'];
		unset($data['lms_complete']);
		$this->db->query($this->db->insert_string('user',$data));
		$uid = $this->db->insert_id();
		$dataProfile['uid'] = $uid ;
		$dataProfile['lms_complete'] = $lms_complete;
		$this->db->query($this->db->insert_string('profile',$dataProfile));
		return true;
	}
	public function getByRoleId($roleId){
		$result = array();
		$sql = "SELECT user.id,user.username FROM user WHERE user.roleId={$roleId} LIMIT 0,100";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	// added function for get tutors BY TECHNO-SANJAY
	public function getTutorsDashnoard(){
		$result = array();
		$sql11 = "SELECT id,username,add_time FROM user WHERE roleId IN (1,2) AND quarantine = '0' AND `add_time` BETWEEN date_sub( CURDATE() , INTERVAL 7 day ) AND (CURDATE()+2)  ORDER BY id DESC";
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			$result11 = $query11->result_array();
		}
		return $result11;
	}
	public function getNumberofstudents(){
		$sql11 = "SELECT id FROM user WHERE roleId= 0";
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			return  $query11->num_rows();
		}
	}
	public function getTop8Country(){
		$sql11 = "SELECT p.country,count(p.country) as numberofcountry FROM profile as p , user as u WHERE u.id = p.uid AND u.roleId = 0 GROUP BY p.country ORDER BY numberofcountry DESC LIMIT 0 , 8";
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			return  $result11 = $query11->result_array();
		}
	}
	public function getCountUsersByCountry($countryId){
		$sql11 = "SELECT COUNT(u.id) as numberofusers FROM profile as p , user as u WHERE u.id = p.uid AND u.roleId = 0 AND p.country = {$countryId}";
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			return  $result11 = $query11->result_array();
		}
	}
	public function getTimeZone($lat,$lng,$uid){
		$localTime = '';
		if($lat == '' && $lng == ''){}
		else{
			$_url = "http://api.geonames.org/timezone?lat=".$lat."&lng=".$lng."&username=techdeveloperuk";
			$_result = false;
			 if($_result = file_get_contents($_url)) {
				if($_result){
					$xml = new SimpleXMLElement($_result);
				}
				$localTime = $xml->timezone->timezoneId;
				$sql = "UPDATE user SET timezone = '{$localTime}' WHERE id = {$uid}";
				$query11 = $this->db->query($sql);
			 }
		}
		return $localTime;
	}
	public function getPayPalAccount($userId){
		$sql 	= "SELECT payment_account FROM profile where uid='{$userId}'";
		$query 	= $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$res = $query->result_array();
			if($res[0]['payment_account'] == ""){
				return FALSE;
			}else{
				return TRUE;
			}
		}else{
			return FALSE;
		}
	}
	//skvirja 1 Nov 2013 - to manage user login history
	public function saveLogin($profile){
		$date = date('Y-m-d H:i:s',time());
		$this->load->library('geolocater');
		if(@$_SERVER['HTTP_HOST'] == 'techno-sanjay' || $_SERVER['HTTP_HOST'] == 'localhost'){
			$ip = '122.170.115.66';
			//$ip = '61.139.48.45';
			//hacks for local check
			if($uid == 850){
				//$ip = '81.147.163.75';
			}
		}else{
			$ip = $this->geolocater->getRealIP();
		}
		$uid = $profile['uid'];
		$cacheKey = 'userlocation_'.$profile['uid'].'_'.str_replace('.','',$ip);
		if (  !$locationDetail = $this->cache->get($cacheKey) ) {
			$locationDetail = $this->geolocater->currentLocation($ip);
			$this->cache->save($cacheKey, $locationDetail, $this->cacheTime);
		}
		$location = mysql_real_escape_string($locationDetail->CityName.','.$locationDetail->RegionName.','.$locationDetail->CountryName);		
		$localTimeZone = $locationDetail->LocalTimeZone;
		$userdata = array();
		$userdata['CountryCode2'] =  $locationDetail->CountryCode2;
		$userdata['CountryCode3'] =  $locationDetail->CountryCode3;
		$userdata['CityLatitude'] =  $locationDetail->CityLatitude;
		$userdata['CityLongitude'] =  $locationDetail->CityLongitude;
		$userdata = serialize($userdata);
		$sql = "INSERT INTO login_history (`uid`,`userdata`,`ip_address`,`date`,`location`,`LocalTimeZone`) VALUES ('{$uid}','{$userdata}','{$ip}','{$date}','{$location}','{$localTimeZone}')";
		$query = $this->db->query($sql);
	}
	public function getLastLocalTimeZone($uid){
		//$sql = "SELECT LocalTimeZone FROM login_history where uid = '{$uid}' order by date desc limit 0,1";
		$sql = "SELECT timezone FROM user where id = '{$uid}'";
		$query = $this->db->query($sql);
		$localTimeZone = '';
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$localTimeZone = $result['timezone'];
		}
		if($localTimeZone == ''){
			$sql = "SELECT u.timezone,p.Lat,p.Lng FROM user as u,profile as p where u.id = p.uid AND u.id = '{$uid}' ";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$result = $query->row_array();
				$localTimeZone = $result['timezone'];
				if($localTimeZone == ''){
					if(@$result['Lat']){
						$Lat = $result['Lat'];
					}else{
						$Lat = '';
					}
					if(@$result['Lng']){
						$Lng = $result['Lng'];
					}else{
						$Lng = '';
					}
					$localTimeZone = $this->getTimeZone($Lat,$Lng,$uid);
					if($localTimeZone == ''){
						$localTimeZone = 'America/Los_Angeles';
					}
				}
			}
		}
		return $localTimeZone;
	}
	
	public function getsendername($uid){
		$result = array();
		$sql = "select * from profile where uid={$uid} limit 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	
	public function getByprofileUid($uid){
		$result = array();
		$sql = "select * from profile where uid={$uid} limit 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function getemailByuserid($uid){
		$result = array();
		$sql = "select email from user where id={$uid} limit 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	//added by haren 
	public function getAllTutors($ptn){
		
    //  $sql11 = "select p.uid,p.firstName,p.email,p.lastName,p.pic,p.school_id,u.roleId from profile as p, user as u where  u.roleId >= 1 AND u.roleId <=3 p.school_id=0  AND ( p.firstName like '%{$ptn}%' or p.email like '%{$ptn}%' ) ORDER BY RAND() DESC  limit 0,20";
		$sql11 = "select DISTINCT p.uid,p.firstName,p.email,p.lastName,p.pic,p.school_id,u.roleId from profile as p, user as u where u.roleId IN (1,2,3) AND p.school_id=0 And p.uid=u.id  AND ( p.firstName like '%{$ptn}%' or p.email like '%{$ptn}%' ) ORDER BY RAND() DESC";	
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			$result= $query11->result_array();
		}
		
		return $result;
	}
	
	// added by haren to list tutor by school
	public function GetSchoolTutor($id,$page,$perpage = 20)
	{
    	$start =($page - 1) * $perpage;
	
	 $this->db->distinct('p.uid');
	 $this->db->select("COUNT(class.id) as total");
	 $this->db->select("sum(class.fee) as totalfee");
	$this->db->select("sum(t_hrate) as tutorEarning");
	$this->db->select("sum(s_markup) as SchoolEarning");
	$this->db->select('p.firstName,p.lastName,p.school_id,p.uid');
	
	$this->db->from('profile p');
	$this->db->join('class', 'class.school_id =p.school_id','left');
	$this->db->where('p.school_id', $id);
	$this->db->where('class.s_attend = 1');
	$this->db->where('class.is_private = 0');
	 $this->db->group_by('p.uid'); 
	$query = $this->db->get();  

		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		//echo $this->db->last_query();
     //echo "<pre>";print_r($result);die();
		return $result;
	}
	
	public function GetSchoolTutorfordashboard($id,$page,$perpage = 20)
	{
    	$start =($page - 1) * $perpage;
	  
	 $this->db->distinct('p.uid');
	 $this->db->select("COUNT(class.id) as total1");
	 $this->db->select("sum(class.fee) as totalfee1");
	
	$this->db->select('p.firstName,p.lastName,p.school_id,p.uid,p.hRate');
	
	$this->db->from('profile p');
	$this->db->join('class', 'class.school_id = p.school_id');
	
	$this->db->where('class.s_attend',1);
	$this->db->where('p.school_id', $id);
	 $this->db->group_by('p.uid'); 
	$query = $this->db->get();  
	
        $result=array();
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		if(count($result)>0)
		{
		//$result[0]['totalfee1']=($result[0]['totalfee1'])/(1+33/100);
		}
	 
		return $result;
	}
	
	
	// added by haren to list student by school
	public function GetSchoolStudent($id,$page,$perpage=20)
	{
   
	$start =($page - 1) * $perpage;
	
    $sql = "SELECT class.*,count(class.school_id) as scnt, tProfile.firstName as tFN,tProfile.lastName as tLN,sProfile.firstName as sFN,sProfile.lastName AS sLN FROM class LEFT JOIN profile AS tProfile ON tProfile.uid = class.tid LEFT JOIN profile AS sProfile ON sProfile.uid = class.sid  where class.school_id={$id} and class.s_attend=1 "; 

	 $query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		
		return $result;
	}
	public function GetSchoolStudentmnth($id,$page,$perpage=20)
	{
   
	$start =($page - 1) * $perpage;
	//month(endTime) = month(curdate())  and year(endTime) = year(curdate())
    $sql = "SELECT class.*,count(class.school_id) as scnt, tProfile.firstName as tFN,tProfile.lastName as tLN,sProfile.firstName as sFN,sProfile.lastName AS sLN FROM class LEFT JOIN profile AS tProfile ON tProfile.uid = class.tid LEFT JOIN profile AS sProfile ON sProfile.uid = class.sid  where class.school_id={$id} and class.s_attend=1 and month(endTime) = month(curdate())  and year(endTime) = year(curdate())"; 

	 $query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		
		return $result;
	}
	
	public function GetSchoolStudentyr($id,$page,$perpage=20)
	{
   
	$start =($page - 1) * $perpage;
	//month(endTime) = month(curdate())  and year(endTime) = year(curdate())
    $sql = "SELECT class.*,count(class.school_id) as scnt, tProfile.firstName as tFN,tProfile.lastName as tLN,sProfile.firstName as sFN,sProfile.lastName AS sLN FROM class LEFT JOIN profile AS tProfile ON tProfile.uid = class.tid LEFT JOIN profile AS sProfile ON sProfile.uid = class.sid  where class.school_id={$id} and class.s_attend=1 and year(endTime) = year(curdate())"; 

	 $query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		
		return $result;
	}
	
	// added by haren to list Affiliate 
	public function GetAffiliateStu($id)
	{
 
/*SELECT *
FROM user u
LEFT JOIN affiliate a ON a.refid = u.refid
left join profile p on p.uid = u.id
WHERE u.refid =1881*/

	
	$this->db->select('u.id,p.firstName,p.lastName,a.purchaseamount,a.amount,a.createAt,a.paid');
	$this->db->from('user u');
	$this->db->join('profile p', 'u.id = p.uid');
	$this->db->join('affiliate a', 'a.sid =u.id');
	$this->db->where('u.refid', $id);
	$this->db->where('u.roleId',0);

	$query = $this->db->get();  
	
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		
		return $result;
	}
	
	
	// count total rows
	public function countTutor($sId){
		$sql = 'SELECT count(uid) AS count FROM profile WHERE `school_id` ='  .$sId;
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result['count'];
	}
	
	//delete tutor from organization
	
	public function deleteFromSchool($uid,$sid)
	{
	$sql="update profile p set p.school_id=0 where p.uid={$uid} and p.school_id={$sid}";
	$this->db->query($sql);
	$sql1="delete from tutor_school where user_id={$uid} and school_id={$sid}";
	$this->db->query($sql1);
	return true;
	}
	public function checkreadytalk($uid)
	{
	//$sid = $this->session->userdata('uid');
	//echo $uid;die();
	$sql = "SELECT readytotalk from user  WHERE  id = {$uid}   "  ;
		$query = $this->db->query($sql);
		
			$result = $query->result_array();
			//print_r($result);die();
			return $result; 
	}
	
	// functiona added by haren to check school code
	public function chkSchoolCode($val) {
		$errorMsg = array();
		$errorMsg['success'] = false;
		if($val == '') {
			$errorMsg['message'] = 'School code cannot be empty.';
		}else if($this->getsCode($val)){
			$errorMsg['message'] = 'School code already taken.';
			$errorMsg['code'] = '100';
			//$errorMsg['success'] = false;
		}else {
			$errorMsg['success'] = true;
		}
	
		return $errorMsg;
	}
	function getsCode($code){
		$result = array();
		$sql = "select * from profile where UniqueId={$code} limit 1";
		$query = $this->db->query($sql,array($UniqueId));
		if ($query->num_rows() > 0){
			$result = $query->row_array();
		}
		return $result;
	}
	
	
	 function encode($string,$key) {
    $key = sha1($key);
    //$strLen = strlen($string);
	    $strLen = 4;
    $keyLen = strlen($key);
    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($string,$i,1));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
    }
	    $user = $this->getByUid($string);
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
		$fn = $this->session->userdata['schoolfn'];
		$link='sc/'.$fn;
		}
		if($user['roleId']==5)
		{
		$link='af';
		}
	     $reflink = base_url().$link.'/'.$hash;
		 $sql="update profile p set p.reflink='$reflink' where p.uid={$string}";
	     $this->db->query($sql);
         return $hash;
}

   function decode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    for ($i = 0; $i < $strLen; $i+=2) {
        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
        if (@$j == $keyLen) { @$j = 0; }
        $ordKey = ord(substr($key,@$j,1));
        @$j++;
        @$hash .= chr($ordStr - $ordKey);
    }
    return $hash;
}
	// function added by haren to get affiliated student

	public function getAffiliateStudent()
	{
			$result = array();
			$sql="select DISTINCT p.uid, p.firstName,p.lastName,u.add_time from user u,profile p where p.uid=u.id and u.roleId=0 order by rand() limit 10";	
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}
			return $result;
	}
   public function school_add($data){
		//$lms_complete = $data['lms_complete'];
		 $fname       = $data['firstName'];
		$uniqueId     = $data['UniqueId'];
		unset($data['lms_complete']);
		unset($data['UniqueId']);
		unset($data['firstName']);
		$this->db->query($this->db->insert_string('user',$data));
		$uid = $this->db->insert_id();
		$dataProfile['uid'] = $uid ;
		//$dataProfile['lms_complete'] = $lms_complete;
		$dataProfile['email']  =$data['email'];
		$dataProfile['firstName']  =$fname;
		$dataProfile['UniqueId'] = $uniqueId ;
		$this->db->query($this->db->insert_string('profile',$dataProfile));
		return true;
	}
	
	public function checkschoolid($val) {
		$errorMsg = array();
		$errorMsg['success'] = false;
		if($val == '') {
			$errorMsg['message'] = 'UniqueId cannot be empty';
		}else if($this->getschoolid($val)) {
			$errorMsg['message'] = 'UniqueId already exists.';
		}else {
			$errorMsg['success'] = true;
		}
		return $errorMsg;
	}
	
	function getschoolid($schid){
		$result = array();
		$sql = "select * from profile where UniqueId=? limit 1";
		$query = $this->db->query($sql,array($schid));
		if ($query->num_rows() > 0){
			$result = $query->row_array();
		}
		 
		return $result;
	}
	
	// added by haren
		public function exitfromschool($uid)
	{
	$sql="update profile p set p.school_id=0 where p.uid={$uid}";
	$this->db->query($sql);
	
	
	return true;
	}
	
	public function Gettmarkup($id)
	{
            //echo $id; 
			$result = array();
			$sql="select tutor_markup from profile where uid={$id}";	
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0)
			{
				$result = $query->row_array();
			}
			return $result;
	}
	
	public function GetAllAdvertise($ptn){
		
    //  $sql11 = "select p.uid,p.firstName,p.email,p.lastName,p.pic,p.school_id,u.roleId from profile as p, user as u where  u.roleId >= 1 AND u.roleId <=3 p.school_id=0  AND ( p.firstName like '%{$ptn}%' or p.email like '%{$ptn}%' ) ORDER BY RAND() DESC  limit 0,20";
		if($ptn =='')
		{
		$sql11 = "select * from school_addvertise  ORDER BY RAND() DESC";	
		}
		else
		{
		$sql11 = "select * from school_addvertise where lang={$ptn} ORDER BY RAND() DESC";	
		}
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			$result= $query11->result_array();
		}
		
		return $result;
	}
	
	public function DownloadAdd($adid)
	{
			$sql11 = "select * from school_addvertise where id={$adid}";	
			$query11 = $this->db->query($sql11);
			if ($query11->num_rows() > 0) {
			$result= $query11->result_array();
			}
		
		return $result;
	}
	public function GetIncompleteProfile()
	{
	  //$sql= "select profile.firstName,profile.email from profile where personal='' || pic='' || vedio=''";
	 $sql="select  p.uid, p.firstName,p.email from user u,profile p where p.uid=u.id and u.roleId > 0  and u.roleId < 4"; 
	  $query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		
		return $result;
	}
	public function GetSchoolAmount($id)
	{
		$sql="select sum(amount)as earning from affiliate where refid={$id}";
		 $query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		
		return $result;
	}
	
	public function getSchoolSummary($sort='',$order='')
	{
	
	if($sort==id)
		{
			$sort="p.uid";
		}
		else if($sort=='name')
		{
			$sort="p.firstName";
		}
		else if($sort=='cname')
		{
			$sort="p.principle_name";
		}
		else if($sort=='email')
		{
			$sort="p.email";
		}
		else if($sort=='date')
		{
			$sort="u.add_time";
		}
		else if($sort=='total')
		{
			$sort="t1";
		}
		else if($sort=='pbal')
		{
			$sort="p.pbalance";
		}
		else
		{
			$sort="p.firstName";
		}
	  $sql="select sum(fee) as t1, count(class.id) as cid,p.pbalance,p.firstName,p.lastName,p.principle_name,p.id,u.add_time, p.uid, p.firstName,p.email from user u 
	  left join profile p on u.id =p.uid    
      
	 left join class on class.School_id = p.uid 	
	  where p.uid=u.id and u.roleId=4 
	  GROUP BY p.uid order by {$sort} {$order}"; 
	  ; 
	  
		 $query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		 
		return $result;
	}
	
	public function affiSummary($search,$sort,$sortorder)
	{
		$result=array();
		if($sort == "id")
		{
			$sort="user.id";
		}
		
		elseif($sort == 'name')
		{
			$sort="profile.firstName";
		}
		elseif($sort == 'cname')
		{
			$sort="profile.principle_name";
		}
		elseif($sort == 'email')
		{
			$sort="user.email";
		}
		elseif($sort == 'date')
		{
			$sort="user.add_time";
		}
		else
		{
			$sort="profile.firstName";
		}
	
		if($search == ''){
			 $sql= "select distinct user.email,user.id, profile.firstName, profile.lastName,profile.principle_name,user.add_time from user, profile where user.id= profile.uid and user.roleId=5 GROUP BY profile.uid order by {$sort} {$sortorder}";
		}else{
		   $sql= "select distinct user.email,user.id, profile.firstName, profile.lastName,profile.principle_name,user.add_time from user, profile where user.id= profile.uid and user.roleId=5 and  (user.id like '{$search}' OR user.email like '{$search}' OR profile.firstName like '{$search}' OR profile.lastName like '{$search}') GROUP BY profile.uid order by {$sort} {$sortorder}"; 
			
		    }
	  
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}

		return $result;
	}
	public function school_addnote($data) {
	
		$sql 					= "INSERT INTO school_note set  ";
		$sql					.="dispute_id=?,school_id=?,note=?,role=?,add_date=?";
		$query 					= $this->db->query($sql,array($data['dispute_id'],$data['school_id'],$data['note'],$data['role'],$data['date']));
		return  $this->db->insert_id();
	}
	
	public function Affi_addnote($data) {
	
		$sql 					= "INSERT INTO affi_note set  ";
		$sql					.="Affi_id=?,note=?,role=?,add_date=?,dispute_id=?";
		$query 					= $this->db->query($sql,array($data['school_id'],$data['note'],$data['role'],$data['date'],$data['dispute_id']));
		return  $this->db->insert_id();
	}
	
	public function getAffiAmount($id)
	{
	  
		$sql="select count(sid) as stid, sum(amount) as total,sum(PaidAmount) as pamount,paid from affiliate where refid={$id}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->row_array();
		}
		 
		 /*print_r($result);
		 die();*/
		return $result;
	}
	
	public function updatefreesession($id)
	{
	$sql="update profile p set p.free_session='n' where p.uid={$id}";
	$this->db->query($sql);
	}
	
	public function GetAllMemberNotes($search = ''){
		$result = array();
		$length = 20;
		$sql   = "SELECT * FROM user_notes WHERE dispute_id like '{$search}' OR note like '{$search}' OR role like '%{$search}%' OR add_date like '%{$search}%'  ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function MembersAddNote($data) {
		$sql 					= "INSERT INTO membernotes set  ";
		$sql					.=" dispute_id=?,user_id=?,note=?,role=?,add_date=?";
		$query 					= $this->db->query($sql,array($data['dispute_id'],$data['user_id'],$data['note'],$data['role'],$data['date']));
		return  $this->db->insert_id();
	}
	public function ListMemberNote($start,$sort,$sortorder){
		$user = $this->input->_request('id');
		$start = 0;
		$result = array();
		$length = 20;
		$sql = "SELECT * FROM membernotes  WHERE user_id={$user} order by {$sort} {$sortorder} limit {$start} , {$length}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		//echo '<pre>';print_r($result);exit;
		return $result;
	}
	
	public function GetAllSchoolNotes($start,$sort,$sortorder){
		$sid = $this->input->_request('id');
		$start = 0;
		$result = array();
		$length = 20;
		$sql = "SELECT * FROM school_note WHERE school_id={$sid} order by {$sort} {$sortorder}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		
		return $result;
	}
	public function GetAffinote($start,$sort,$sortorder){
	
	$Aid = $this->input->_request('id');
		
		$sql = "SELECT * FROM affi_note WHERE  Affi_id={$Aid}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		
		return $result;

	}
	public function GetAllMemeber($start=0,$sort,$sortorder,$length = 20){
		$result = array();
		if($sort=="id")
		{
			$sort="user.id";
		}
		else if($sort=="name")
		{
			$sort="profile.firstName";
		}
		else if($sort=="role")
		{
			$sort="user.roleId";
		}
		else
		{
			$sort="user.id";
		}
		$sql = "select user.*,profile.* from user left join profile on user.id=profile.uid  where user.id > 0 and user.roleId >= 0 and profile.uid > 0 order by {$sort} {$sortorder} limit {$start} , {$length}";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function GetAllMemeberSearch($start ='',$search,$sort,$sortorder){
		$result = array();
		if($sort=="id")
		{
			$sort="user.id";
		}
		if($sort=="name")
		{
			$sort="profile.firstName";
		}
		if($sort=="role")
		{
			$sort="user.roleId";
		}
		$sql = "select * from user left join profile on user.id=profile.uid  where user.id like '{$search}' OR user.email like '{$search}' OR profile.firstname like '%{$search}%' OR profile.lastName like '%{$search}%' order by {$sort} {$sortorder} ";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
	
		return $result;
	}
		public function GetAllMemeberbyDate($start =0,$search,$sort,$sortorder,$length = 20){
		$a=explode("/",$search);
		$day=$a[0];
		$year=$a[1];	
		$result = array();
		if($sort=="id")
		{
			$sort="user.id";
		}
		if($sort=="name")
		{
			$sort="profile.firstName";
		}
		if($sort=="role")
		{
			$sort="user.roleId";
		}
		$sql = "select * from user left join profile on user.id=profile.uid  where MONTH(user.add_time)='{$day}' and YEAR(user.add_time)='{$year}' order by {$sort} {$sortorder} limit {$start} , {$length}";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
//echo $this->db->last_query();
		 
		return $result;
	}
	public function GetMemberCountSearch($search){
		$sql = "select count(u.id) as count from user as u,profile as p where u.id = p.uid and (u.id like '{$search}' OR u.email like '{$search}' OR p.firstname like '%{$search}%' OR p.lastName like '%{$search}%' )";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	public function MemberFCount(){
		$sql = "select count(id) as count from user";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	public function getSessionAttendAmount($uid,$date)
	{	
		$dt=explode('/',$date);
		$mon=$dt[0];
		$yr=$dt[1];
		$this->db->select("sum(fee)AS earning");
		$this->db->from('disputes');
		$this->db->where('MONTH(createAt)=',$mon);
		$this->db->where('YEAR(createAt)=',$yr);
		$this->db->where('tid',$uid);
		$this->db->or_where('School_id',$uid);
		//$this->db->group_by('uid');
		$query = $this->db->get(); 
		$result=array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function getAffiIncome($id,$date)
	{
		$dt=explode('/',$date);
		$mon=$dt[0];
		$yr=$dt[1];
		$this->db->select("sum(amount)AS total");
		$this->db->from('affiliate');
		$this->db->where('MONTH(createAt)=',$mon);
		$this->db->where('YEAR(createAt)=',$yr);
		$this->db->where('refid',$id);
		$this->db->group_by('refid');
		$query = $this->db->get(); 
		$result=array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function getStudentAmount($id)
	{
		$sql="select sum(purchaseamount) as pamount from affiliate where sid={$id}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->row_array();
		}
		return $result;
	}
	
	public function getState($uid){
		$result = array();
		
		$sql = "select id from provices where provice='{$uid}'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		echo $this->db->last_query();
		return $result;
	}
	public function getAllFeedback($ptn){
		
    //  $sql11 = "select p.uid,p.firstName,p.email,p.lastName,p.pic,p.school_id,u.roleId from profile as p, user as u where  u.roleId >= 1 AND u.roleId <=3 p.school_id=0  AND ( p.firstName like '%{$ptn}%' or p.email like '%{$ptn}%' ) ORDER BY RAND() DESC  limit 0,20";
		$sql11 = "Select msg from  feedback where callerId={$ptn}";	
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			$result= $query11->result_array();
		}
		/*echo "<pre>";
		print_r($result);
		die();*/
		return $result;
	}
	
	public function getNewMemberPuerchaseamount($id)
	{
	$result = array();
	$sql="select purchaseamount from affiliate where sid={$id}";
		//echo $sql ;die;
		$query  = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		/*echo "<pre>";
		print_r($result);
		die();*/
		return $result;
	}
	
        public function getSlotData($userid,$fromDate,$toDate,$divid,$divaction,$logintype,$additionalprofileid)
        {
            //echo $userid." : ".$fromDate." : ".$toDate." : ".$divid." : ".$divaction;
            //print_r($divid);
            $querytype = "";
            $tmpstarttime = explode("_",str_replace("div","",$divid));
            //print_r($tmpstarttime);
            $starttime = $tmpstarttime[0]."-".$tmpstarttime[1]."-".$tmpstarttime[2]." ".$tmpstarttime[3].":".$tmpstarttime[4].":00";
            $starttime = strtotime($starttime);
            $endtime = strtotime("+25 minutes",$starttime);
            $starttime = date("Y-m-d H:i:s",$this->inTime(date("Y-m-d H:i:s",$starttime)));
            $endtime = date("Y-m-d H:i:s",$this->inTime(date("Y-m-d H:i:s",$endtime)));
            //echo date("Y-m-d H:i:s",$starttime)." : ".date("Y-m-d H:i:s",$endtime);//.date("Y-m-d H:i:s",strtotime($starttime));
            $localTimeZone = $this->input->_request('localTimeZone');
            //echo $localTimeZone;
            //echo "<br/>".$localTimeZone." : ".($localTimeZone * 60)." : ".($localTimeZone * 3600);
            $addmin = (($localTimeZone * 60) * (-1));
            if ($divaction == "add")
            {
                $querytype = "insert";
                $q = "Insert into timeslot(uid,startTime_tm,endTime_tm,startTime,endTime) values (".($userid).",'".strtotime($starttime)."','".strtotime($endtime)."','".$starttime."','".$endtime."')";
            }
            else
            {
                if ($divaction == "GetAll")
                {
                    if ($logintype == "student")
                    {
                        if ($additionalprofileid > 0)
                        {
                            $querytype = "select";
                            $q = "Select id,uid,stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(startTime),'_',day(startTime),'_',hour(startTime),'_',minute(startTime)) as divid,concat(monthname(startTime),' ',day(startTime),' ',year(startTime),' ',hour(startTime),':',minute(startTime),':00') as startTime from timeslot where date(startTime) >= '".$fromDate."' and date(endTime) <= '".$toDate."' and uid = ".$additionalprofileid." order by hour(startTime),minute(startTime)";
                            $q = "Select id,uid,stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime from timeslot where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(endTime) <= '".$toDate."' and uid = ".$additionalprofileid." order by hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))";
                            $q = "Select id,uid,stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime,'timeslot' as tabletype from timeslot where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(endTime) <= '".$toDate."' and uid = ".$additionalprofileid." union "; 
                            $q = $q."Select id,tid as uid,sid as stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime,'class' as tabletype from class where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(endTime) <= '".$toDate."' and tid = ".$additionalprofileid." ";
                            $q = $q." order by hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),tabletype";
                        }
                        else
                        {
                            $querytype = "select";
                            $q = "Select id,uid,stid,concat(year(startTime),'_',month(startTime),'_',day(startTime),'_',hour(startTime),'_',minute(startTime)) as divid,concat(monthname(startTime),' ',day(startTime),' ',year(startTime),' ',hour(startTime),':',minute(startTime),':00') as startTime from timeslot where date(startTime) >= '".$fromDate."' and date(endTime) <= '".$toDate."' and stid = ".$userid." order by hour(startTime),minute(startTime)";
                            $q = "Select id,uid,stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime from timeslot where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(endTime) <= '".$toDate."' and stid = ".$userid." order by hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))";                        
                            $q = "Select id,uid,stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime,'timeslot' as tabletype from timeslot where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(endTime) <= '".$toDate."' and stid = ".$userid." union "; 
                            $q = $q."Select id,tid as uid,sid as stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime,'class' as tabletype from class where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(endTime) <= '".$toDate."' and sid = ".$userid." ";
                            $q = $q." order by hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),tabletype";
                        }
                    }
                    else
                    {
                        $querytype = "select";
                        $q = "Select id,uid,stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime,'timeslot' as tabletype from timeslot where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(endTime) <= '".$toDate."' and uid = ".$userid." union "; 
                        $q = $q."Select id,tid as uid,sid as stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime,'class' as tabletype from class where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(endTime) <= '".$toDate."' and tid = ".$userid." ";
                        $q = $q." order by hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),tabletype";
                        //echo $q;
                    }
                }
                else
                {
                    if ($divaction == "delete")
                    {
                        $querytype = "delete";
                        $q = "delete from timeslot where uid = ".$userid." and startTime = '".$starttime."'";
                    }
                    else
                    if ($divaction == "confirm")
                    {
                        $querytype = "confirm";
                        $q = "delete from timeslot where uid = ".$userid." and startTime = '".$starttime."'";
                    }
                }    
            }
            //echo $q;
            $query = $this->db->query($q);
            //echo $q." : ".$query->num_rows();
            if ($querytype == "select")
            {
                if ($query->num_rows() > 0) {
                        $result = $query->result_array();
                }
            }
            else
            {
                if ($querytype == "insert")
                {
                    $result = $this->db->insert_id();
                }
                else
                {
                    if ($querytype == "update")
                    {
                        $result = $this->db->affected_rows();
                    }
                    else
                    {
                        if ($querytype == "delete")
                        {
                            $result = "1"; 
                        }
                        else
                        {
                            if ($querytype == "confirm")
                            {
                                $result = "1"; 
                            }
                        }
                    }
                }
            }
            return array("result"=>$result,"querytype"=>$querytype);
        }
        public function getClassData($userid,$divid)
        {
            $tmpstarttime = explode("_",str_replace("div","",$divid));
            //print_r($tmpstarttime);
            $starttime = $tmpstarttime[0]."-".$tmpstarttime[1]."-".$tmpstarttime[2]." ".$tmpstarttime[3].":".$tmpstarttime[4].":00";
            $starttime = strtotime($starttime);
            $starttime = date("Y-m-d H:i:s",$this->inTime(date("Y-m-d H:i:s",$starttime)));
            $q = "Select * from class where tid = ".$userid." and startTime = '".$starttime."'";
            $query = $this->db->query($q);
            if ($query->num_rows() > 0){
                $result = $query->row_array();
            }
            return $result;
        }
        public function getuserData($userid)
        {
            $q = "Select * from user where id = ".$userid;
            $query = $this->db->query($q);
            if ($query->num_rows() > 0){
                $result = $query->row_array();
            }
            return $result;
        }
        function getconversationtopic($userid)
        {
            $q = "Select id,topic_text from conversation_topic where userid in (0,".$userid.")";
            //echo $q;
            $query = $this->db->query($q);
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            $q = "<option value='-1' selected='selected'>Select Conversation Topic</option>";
            foreach($result as $key => $values)
            {
                $q = $q."<option value='".$values["id"]."'>".$values["topic_text"]."</option>";
            }
            $q = $q."<option value='0'>Other</option>";
            return $q;
        }
        function calculatetime($divid)
        {
            
        }
        function addtxtconversationtopic($userid,$conversationtopic,$txtconversationtopic)
        {
            if ($conversationtopic == "Other")
            {
                $conversationtopic = $txtconversationtopic;
            }
            $q = "insert into conversation_topic(userid,topic_text) values (".$userid.",'".$conversationtopic."')";
            //echo $q;
           // $query = $this->db->query($q);
        }
		
	public function GetSchoolUsers($start = 0,$search = '',$sort,$sortorder,$length = 20){
		$result = array();
		//$sql = "select u.*, CONCAT(p.firstName, ' ',p.lastName) as usernm , p.lms_complete from user as u,profile as p where u.id = p.uid and (u.id like '{$search}' OR u.email like '{$search}' OR p.firstnale like '%{$search}%' OR p.lastName like '%{$search}%' ) order by {$sort} {$sortorder} limit {$start} , {$length}";
		$sql = "select u.*, CONCAT(p.firstName, ' ',p.lastName) as usernm from user as u,profile as p where u.id = p.uid and u.roleId=4 and(u.id like '{$search}' OR u.email like '{$search}' OR p.firstname like '%{$search}%' OR p.lastName like '%{$search}%' ) order by {$sort} {$sortorder} limit {$start} , {$length}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
		public function GetAllschoolData($start = 0,$sort,$sortorder,$length = 20){
		$result = array();
		//$sql = "select u.*, CONCAT(p.firstName, ' ',p.lastName) as usernm , p.lms_complete from user as u,profile as p where u.id = p.uid order by {$sort} {$sortorder} limit {$start} , {$length}";
		$sql = "select u.*, (select expDate from pay c where uid = u.id order by id desc limit 0, 1) as expDate, CONCAT(p.firstName, ' ',p.lastName) as usernm from user as u,profile as p where u.id = p.uid and u.roleId=4 order by {$sort} {$sortorder} limit {$start} , {$length}";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		
		return $result;
	}
	public function GetcountSchoolSearch($search){
		$sql = "select count(u.id) as count from user as u,profile as p where u.id = p.uid and u.roleId=4 and (u.id like '{$search}' OR u.email like '{$search}' OR p.firstname like '%{$search}%' OR p.lastName like '%{$search}%' )";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	public function GetCountSchool(){
		$sql = "select count(id) as count from user where user.roleId=4";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	public function getPrivateBalanace($id){
		$sql = "select pbalance from profile where uid={$id}";
		$query = $this->db->query($sql);
		 
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		
		return $result;
	}
	
	public function getPayAmount($id){
		$sql = "select sum(money)as mny   from profile where uid={$id} group by uid";
		$query = $this->db->query($sql);
		 $result=array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		
		
 
		return $result;
	}
	public function GetaddStu($uid,$date)
	{
		$dt=explode('/',$date);
		$mon=$dt[0];
		$yr=$dt[1];
		$this->db->select("sum(money)AS pmoney");
		$this->db->from('pay');
		$this->db->where('MONTH(creatAt)=',$mon);
		$this->db->where('YEAR(creatAt)=',$yr);
		$this->db->where('uid',$uid);
		$this->db->group_by('uid');
		$query = $this->db->get(); 
		$result=array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function GetpreaddStu($uid,$date)
	{
		$dt=explode('/',$date);
		$mon=$dt[0] - 1;
		$yr=$dt[1];
		$this->db->select("sum(money)AS pmoney");
		$this->db->from('pay');
		$this->db->where('MONTH(creatAt)=',$mon);
		$this->db->where('YEAR(creatAt)=',$yr);
		$this->db->where('uid',$uid);
		$this->db->group_by('uid');
		$query = $this->db->get(); 
		$result=array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function GetTutorAdd($uid,$date)
	{
		$dt=explode('/',$date);
		$mon=$dt[0];
		$yr=$dt[1];
		$this->db->select("count(tid)AS tuid");
		$this->db->from('class');
		$this->db->where('MONTH(createAt)=',$mon);
		$this->db->where('YEAR(createAt)=',$yr);
		$this->db->where('tid',$uid);
		$this->db->where('s_attend = 1');
		$query = $this->db->get(); 
		$result=array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function Gethrate($uid)
	{
		$sql = "select hRate  from profile where uid={$uid}";
		$query = $this->db->query($sql);
		 $result=array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		//echo "<pre>"; print_r($result);die();
		return $result;
	}
	
	public function getSubstu($id,$date)
	{
		$dt=explode('/',$date);
		$mon=$dt[0];
		$yr=$dt[1];
		$this->db->select("sum(fee) AS stufee");
		$this->db->from('class');
		$this->db->where('MONTH(createAt)=',$mon);
		$this->db->where('YEAR(createAt)=',$yr);
		$this->db->where('sid',$id);
		$this->db->where('s_attend = 1');
		$this->db->group_by('sid');
		$query = $this->db->get(); 
		 $result=array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function getpreSubstu($id,$date)
	{
		$dt=explode('/',$date);
		$mon=$dt[0] - 01;
		$yr=$dt[1];
		$this->db->select("sum(fee) AS stufee");
		$this->db->from('class');
		$this->db->where('MONTH(createAt)=',$mon);
		$this->db->where('YEAR(createAt)=',$yr);
		$this->db->where('sid',$id);
		$this->db->where('s_attend = 1');
		$this->db->group_by('sid');
		$query = $this->db->get(); 
		 $result=array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function getEndbal($id)
	{
		$sql = "select money from profile where uid={$id}";
		$query = $this->db->query($sql);
		 $result=array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		  
		return $result;
	}
	public function GetaddStuaffi($uid,$date)
	{
		$dt=explode('/',$date);
		$mon=$dt[0];
		$yr=$dt[1];
		$this->db->select("sum(amount) AS amt");
		$this->db->from('affiliate');
		$this->db->where('MONTH(createAt)=',$mon);
		$this->db->where('YEAR(createAt)=',$yr);
		$this->db->where('refid',$uid);
		$query = $this->db->get(); 
		$result=array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function GetpreaddStuaffi($uid,$date)
	{
		$dt=explode('/',$date);
		$mon=$dt[0] - 01;
		$yr=$dt[1];
		$this->db->select("sum(amount) AS amt");
		$this->db->from('affiliate');
		$this->db->where('MONTH(createAt)=',$mon);
		$this->db->where('YEAR(createAt)=',$yr);
		$this->db->where('refid',$uid);
		$query = $this->db->get(); 
		$result=array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function GetSubTutor($id,$date)
	{
		$dt=explode('/',$date);
		$mon=$dt[0];
		$yr=$dt[1];
		$this->db->select("sum(fee) AS paidamt");
		$this->db->from('disputes');
		$this->db->where('MONTH(createAt)=',$mon);
		$this->db->where('YEAR(createAt)=',$yr);
		$this->db->where('tid',$id);
		$this->db->where('paymentstatus','paid');
		$query = $this->db->get(); 
		$result=array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	public function getsesstioncost($schoolid,$userid)
        {
            if ($schoolid == 0)
            {
                $q = "Select hRate from profile where uid = ".$userid;
            }
            else
            {
                $q = "Select hRate from profile where uid = ".$schoolid;
            }
            //echo $q;
            $query = $this->db->query($q);
            //echo $query->num_rows();
            $resultmoney = 0;
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
                foreach($result as $key => $values)
                {
                    //echo "<pre>";
                    //print_r($key);
                    //print_r($values);
                    //echo "</pre>";
                    $resultmoney = $values["hRate"];
                }
            }
            //exit();
            return $resultmoney;
        }
        public function getsesstioncostnew($userid,$configvalues,$tutorid)
        {
			 
            $isnew = 0;
            $q = "Select free_session from profile where uid = ".$userid;
            //echo $q;
            //exit();
            $query = $this->db->query($q);
            $resultmoney = 0;
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
                foreach($result as $key => $values)
                {
                    $isnew = $values["free_session"];
                }
            }
            if ($isnew == "y")
            {
                $tutorcost = 0;
                $schooltutorcost = 0;
            }
            else
            {
				// code added by haren for free session between school student tutor
				
				$stuid=$this->session->userdata['uid'];
				if($stuid !='')
				{
						 
					$sql="select refid from user where id={$stuid}";
					$query = $this->db->query($sql);
					if ($query->num_rows() > 0) 
					{
						$result = $query->row_array();
					}
					$refid=$result['refid'];
					if($refid > 0)
					{
						$sql="select uid,pbalance from profile where uid={$refid} and pbalance > 0";
						$query = $this->db->query($sql);
						if ($query->num_rows() > 0) 
						{
							$result = $query->row_array();
						}
						//echo "<pre>";print_r($result);die();
						$schid=$result['uid'];
						$pbalance=$result['pbalance'];
						$q = "Select school_id from profile where uid = ".$tutorid;	
						$query = $this->db->query($q);
						if ($query->num_rows() > 0) 
						{
							$result = $query->row_array();
						}
						
						$schooId=$result['school_id'];
						if($refid==$schooId)
						{
							$schooltutorcost='0';
						}
								$q = "Select hRate,school_id from profile where uid = ".$tutorid;
								$query = $this->db->query($q);
								$resultmoney = 0;
								if ($query->num_rows() > 0) 
								{
									$result = $query->result_array();
									foreach($result as $key => $values)
									{
										$resultmoney = $values["hRate"];
										$schoolid  = $values["school_id"];
									}
								}
								$tutorcost = round($resultmoney * $configvalues)/100;
								$affiliate=1;
						
					}//haren code ended
					else
					{
					$q = "Select hRate,school_id from profile where uid = ".$tutorid;
					$query = $this->db->query($q);
					$resultmoney = 0;
					if ($query->num_rows() > 0) 
					{
						$result = $query->result_array();
						foreach($result as $key => $values)
						{
							$resultmoney = $values["hRate"];
							$schoolid  = $values["school_id"];
						}
					}
					$tutorcost = round($resultmoney * $configvalues)/100;
					if ($schoolid  == 0)
					{
						$schooltutorcost = -1;
					}
					else
					{
						$q = "select * from profile where uid = (select school_id from profile where uid=".$tutorid.") limit 1";
						$query = $this->db->query($q);
						$resultmoney = 0;
							if ($query->num_rows() > 0) 
							{
								$result = $query->result_array();
								foreach($result as $key => $values)
								{
									$resultmoney = $values["tutor_markup"];
									 
								}
							}
							$sql="select hRate from profile where uid={$tutorid}";
							$query = $this->db->query($sql);
							$result = $query->row_array();
							$hrate= $result['hRate'];
							$schooltutorcost = number_format(($resultmoney+$hrate)+(($resultmoney+$hrate)*0.33),2,'.','');
						 
						//$schooltutorcost = round($resultmoney * $configvalues)/100;
					    $affiliate=0;
						$pbalance=0;
					}
				    }	
				}
			}
            return array("isnew"=>$isnew,"tutorcost"=>$tutorcost,"schooltutorcost"=>$schooltutorcost,"affiliate"=>$affiliate,"pbalance"=>$pbalance);
        }
		
	public function GetBigBal($id,$date)
	{
		$dt=explode('/',$date);
		$mon=$dt[0];
		$yr=$dt[1];
		$month = $mon-1;

		$sql = "select sum(fee) as money from disputes where tid = '$id' OR sid = '$id' AND DATE_FORMAT(createAt, '%Y-%m') = '$yr-0$month'";
		
		$query = $this->db->query($sql);
		$result=array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
}
/* End of file user_model.php */
/* Location: ./application/model/user_model.php */