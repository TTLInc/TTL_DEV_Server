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
	
	// check the user login or not.
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
			$sql1="select roleId from user where id={$v}";
			$query1 = $this->db->query($sql1);
			$result = $query1->row_array();
			if($result['roleId'] == 4)
			{
				$sql1 = "update profile set school_id=0 where uid={$v}";
				$this->db->query($sql1);
				
				$sql1 = "update user set refid=0 where id={$v}";
				$this->db->query($sql1);
			}
			$sql = "DELETE FROM user WHERE  id={$v}";
			$this->db->query($sql);
			$sql = "DELETE FROM profile WHERE  uid={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	
	public function delSchool($id)
	{
		foreach($id as $v){
			$sql = "DELETE FROM user WHERE  id={$v}";
			$this->db->query($sql);
			$sql = "DELETE FROM profile WHERE  uid={$v}";
			$this->db->query($sql);
			$sql1 = "update profile set school_id=0 where school_id={$v}";
			$this->db->query($sql1);
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
		$sql	= "INSERT INTO user_notes set  ";
		$sql	.=" dispute_id=?,user_id=?,note=?,role=?,add_date=?";
		$query	= $this->db->query($sql,array($data['dispute_id'],$data['user_id'],$data['note'],$data['role'],$data['date']));
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
		$user = $this->input->_request('id');
		$result = array();
		$length = 20;
		//$sql   = "SELECT * FROM user_notes WHERE dispute_id like '{$search}' OR note like '{$search}' OR role like '%{$search}%' OR add_date like '%{$search}%'  ";
		$sql = "SELECT * FROM user_notes  WHERE user_id={$user}";
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
		//$profilesql1 = "UPDATE profile SET role_id = '2' WHERE uid = '{$id}'";
		//$profilequery11 = $this->db->query($profilesql1);
	}
	
	// add tutor to organization haren
	public function AddtoSchool($uid,$sid)
	{
	    $sql = "UPDATE profile SET school_id = '{$sid}' WHERE uid = '{$uid}'";
		$query = $this->db->query($sql);
		$sql1 = "insert into tutor_school set user_id={$uid},school_id='{$sid}'";
		$query1 = $this->db->query($sql1);
		if ($query && $query1) {
			return true;
		} else { 
			return false;
		}
	}
	
	/*
	Function will occure when user will make a new registration.
	User has to enter details in it.
	*/
	public function register($userinfo) {
		$userinfo['password'] = md5($userinfo['password']);
		$userinfo['isconfirmedAccount'] = '1';
		$startdate = date('Y-m-d');
		//$exp_seeion = date( 'Y-m-d ',strtotime($startdate ."+1 week"));
		$exp_seeion = '2016-12-31';
        $refid = $userinfo['refid'];
		if (!$userinfo['facebook_id']) {
			$userinfo['facebook_id'] = "";
		}
		/* Update Query By Ilyas */ 
		$sql = "insert into user set add_time=now(),exp_session='$exp_seeion',refid='$refid', forwardemail='1',";
		$sql.="username=?,email=?,password=?,roleId=?,free_session=?,timezone=?,is_eligible=?,testAccount=?,isconfirmedAccount=?,universal_roleId=?,facebook_id=?";
		$query = $this->db->query($sql,array($userinfo['email'],$userinfo['email'],$userinfo['password'],$userinfo['roleId'], $userinfo['free_session'],$userinfo['timezone'],$userinfo['is_eligible'],$userinfo['testAccount'],$userinfo['isconfirmedAccount'],$userinfo['universal_roleId'],$userinfo['facebook_id']));
		/* End */
		return $this->db->insert_id();
	}
	
	/**
	 * @author R&D
	 * weibo secion
	 */
	//----R&D@Oct-18-2013 : Check if Weibo user exists
	public function check_weibo_user($userinfo) {
		$result	= array();
		$sql	= "SELECT * FROM user WHERE username=? OR email=? limit 1";
		$query	= $this->db->query($sql,array($userinfo['username'],$userinfo['emiail']));
		if ($query->num_rows() > 0){
			$result = $query->row_array();
		}
		return $result;
	}
	
	//----R&D@Oct-18-2013 : Enter weibo user details
	public function weibo_register($userinfo) {
		$userinfo['password'] 	= md5($userinfo['password']);
		$sql	= "INSERT INTO user SET add_time=now(),forwardemail='1',";
		$sql	.="username=?,email=?,password=?,roleId=?,free_session=?,timezone=?";
		$query = $this->db->query($sql,array($userinfo['username'],$userinfo['email'],$userinfo['password'],$userinfo['roleId'], $userinfo['free_session'],$userinfo['timezone']));
		return  $this->db->insert_id();
	}
	
	//----R&D@Oct-18-2013 : Login User	
	public function weibo_login($userinfo) {
		$result	= array();
		$sql	= "SELECT * FROM user WHERE username=? and email=? limit 1";
		$query = $this->db->query($sql,array($userinfo['username'],$userinfo['email']));
		if ($query->num_rows() > 0){
			$result = $query->row_array();
		}
		return $result;
	}
	
	//----R&D@Oct-19-2013 : Check SOcial Promote	
	public function checkSocialPromote($userid){
		$userid = 430;
		$result	= array();
		$checkSocialPromoteUser	= $this->db->query("SELECT * FROM social_promote WHERE user_id= ".$userid." limit 1");
		if ($checkSocialPromoteUser->num_rows() > 0){
			$result = $checkSocialPromoteUser->row_array();
		} else {
			$checkSocialPromoteClass	= $this->db->query("SELECT * FROM class WHERE sid= ".$userid. "   ORDER BY id DESC");
			if ($checkSocialPromoteClass->num_rows() != 0  && $checkSocialPromoteClass->num_rows() <= 2000){
				$checkSocialPromoteClassData = $checkSocialPromoteClass->row_array();
				$result['sid'] 		= $checkSocialPromoteClassData['sid'];
				$result['tid'] 		= $checkSocialPromoteClassData['tid'];
			} else {
				$result	= array();
			}
		}
		return $result;
	}
	
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
			// Update Cookie
			$this->fnUpdateVisitorStatus();
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
		$userinfo['email'] =trim($userinfo['email']);		 
		$sql = "select * from user where email=? and password=? limit 1";		
		$query = $this->db->query($sql,array($userinfo['email'],$userinfo['password']));
		if ($query->num_rows() > 0){
			$result = $query->row_array();
			// Update Cookie
			$this->fnUpdateVisitorStatus();
			if ($result['isconfirmedAccount'] == 0) {
				$this->session->set_userdata('RegLink','Please verify your email address.');
				redirect(base_url('user/login'));
			}
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
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	function getpayemail($email){
		$result = array();
		$sql = "select * from profile where payment_account=? limit 1";
		$query = $this->db->query($sql,array($email));
		if ($query->num_rows() > 0) {
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
		if (!isset($_SESSION)) {
			session_start();
		}
		if (isset($_SESSION['multi_lang'])) {
			$multi_lang = $_SESSION['multi_lang'];
		} else {
			$multi_lang = 'en';
		}
		$errorMsg = array();
		$errorMsg['success'] = false;
		$this->load->model(array('lookup_model'));
		$arrVal = $this->lookup_model->getValue('807', $multi_lang);
		$passwordempty = $arrVal[$multi_lang];
		if($val == '') {
			$errorMsg['message'] = $passwordempty;
		} else {
			$errorMsg['success'] = true;
		}
		return $errorMsg;
	}
	
	public function checkEmail($val) {
		$multi_lang = 'en';
		if (!isset($_SESSION)) {
			session_start();
		}
		
		if (isset($_SESSION['multi_lang'])) {
			$multi_lang = $_SESSION['multi_lang'];
		} else {
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
	     
		if ($val == '') {
			$errorMsg['message'] = $emailnotempty;
		} else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$val)) {
			$errorMsg['message'] = $validemail;
		} else if($this->getEmail($val)) {
			$errorMsg['message'] = $emailexists;
		} else {
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
		} else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$val)) {
			$errorMsg['message'] = 'Enter a valid e-mail';
		} else if($this->getpayemail($val)) {
			$errorMsg['message'] = $emailexists;
		} else {
			$errorMsg['success'] = true;
		}
		return $errorMsg;
	}
	
	public  function checkForgetInfo($data) {
		if ($data['email']=='') {
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
		if (base64_decode($data['str']) != $md5Str) {
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
		if ($uid == 2) {
			$sql = "select * from user where id=2";
		} else {
			$sql = "Select * from user where id=".$uid;
		}
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
		$sql = "select u.*, CONCAT(p.firstName, ' ',p.lastName) as usernm, p.lms_complete,p.money from user as u,profile as p where u.id = p.uid order by {$sort} {$sortorder} limit {$start} , {$length}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function getAllAdminBySearch($start = 0,$search = '',$sort,$sortorder,$length = 20){
		$result = array();
		$sql = "select u.*, (select expDate from pay c where uid = u.id order by id desc limit 0, 1) as expDate, CONCAT(p.firstName, ' ',p.lastName) as usernm, p.lms_complete,p.money  from user as u,profile as p where u.id = p.uid and (u.id like '{$search}' OR u.email like '{$search}' OR p.firstname like '%{$search}%' OR p.lastName like '%{$search}%' ) order by {$sort} {$sortorder} limit {$start} , {$length}";
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
		$dataProfile['email']		= $data['email'];
		$dataProfile['uid']			= $uid ;
		$dataProfile['lms_complete']= $lms_complete;
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
		$sql11 = "SELECT id,username,add_time FROM user WHERE roleId IN (1,2) AND quarantine = '0' AND hiddenRole = '0' AND `add_time` BETWEEN date_sub( CURDATE() , INTERVAL 7 day ) AND (CURDATE()+2)  ORDER BY id DESC";
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
		if ($lat == '' && $lng == '') {}
		else {
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
			if ($res[0]['payment_account'] == "") {
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			return FALSE;
		}
	}
	
	//skvirja 1 Nov 2013 - to manage user login history
	public function saveLogin($profile){
		$date = date('Y-m-d H:i:s',time());
		$this->load->library('geolocater');
		if (@$_SERVER['HTTP_HOST'] == 'techno-sanjay' || $_SERVER['HTTP_HOST'] == 'localhost') {
			$ip = '122.170.115.66';
			//$ip = '61.139.48.45';
			//hacks for local check
			if ($uid == 850) {
				//$ip = '81.147.163.75';
			}
		} else {
			$ip = $this->geolocater->getRealIP();
		}
		$uid = $profile['uid'];
		$cacheKey = 'userlocation_'.$profile['uid'].'_'.str_replace('.','',$ip);
		if (  !$locationDetail = $this->cache->get($cacheKey) ) {
			//$locationDetail = $this->geolocater->currentLocation($ip);
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
				if ($localTimeZone == '') {
					if (@$result['Lat']) {
						$Lat = $result['Lat'];
					} else {
						$Lat = '';
					}
					if (@$result['Lng']) {
						$Lng = $result['Lng'];
					} else {
						$Lng = '';
					}
					$localTimeZone = $this->getTimeZone($Lat,$Lng,$uid);
					if ($localTimeZone == '') {
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
		$uid = $this->session->userdata('uid');
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
		$result=array();
		$this->db->select('p.firstName,p.lastName,p.school_id,p.uid');
		$this->db->from('profile p');
		$this->db->where('p.school_id', $id);
		$query = $this->db->get();  
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		return $result;
	}
	
	public function GetSchoolEarning($sid)
	{
		$result=array();
		$this->db->select("COUNT(id) as total");
		$this->db->select("sum(t_hrate) as tutorEarning");
		$this->db->select("sum(s_markup) as SchoolEarning");
		$this->db->from('disputes');
		$this->db->where('is_completed = 1');
		$this->db->where('schoolPaid = 1');
		$this->db->where('School_id',$sid);
		$query = $this->db->get();  
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		return $result;
	}
	
	public function GetStuEarnings($sid)
	{
		$result['spayment']='0';
		$sql = "SELECT sum(purchaseamount) as spayment from  affiliate where refid='{$sid}'  and is_paid=1";
		$query 	= $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$result['spayment']=$result['spayment']*0.05;
		}
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
		if (count($result)>0) {
			//$result[0]['totalfee1']=($result[0]['totalfee1'])/(1+33/100);
		}
		return $result;
	}
	
	// added by haren to list student by school
	public function GetSchoolStudent($id,$page,$perpage=20)
	{ 
		$start =($page - 1) * $perpage;
		$sql = "SELECT disputes.*,tProfile.firstName as tFN,tProfile.lastName as tLN,sProfile.firstName as sFN,sProfile.lastName AS sLN FROM disputes LEFT JOIN profile AS tProfile ON tProfile.uid = disputes.tid LEFT JOIN profile AS sProfile ON sProfile.uid = disputes.sid  where disputes.School_id={$id} and disputes.schoolPaid=1 and  disputes.is_completed=1"; 
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		return $result;
	}
	
	public function GetSchoolStudentmnth($id,$page,$perpage=20)
	{
		$start =($page - 1) * $perpage;
		$sql = "SELECT disputes.*, tProfile.firstName as tFN,tProfile.lastName as tLN,sProfile.firstName as sFN,sProfile.lastName AS sLN FROM disputes LEFT JOIN profile AS tProfile ON tProfile.uid = disputes.tid LEFT JOIN profile AS sProfile ON sProfile.uid = disputes.sid  where disputes.School_id={$id}  and disputes.schoolPaid=1 and  disputes.is_completed=1 and month(createAt) = month(curdate())  and year(createAt) = year(curdate())"; 
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		return $result;
	}
	
	public function GetSchoolStudentyr($id,$page,$perpage=20)
	{
		$start =($page - 1) * $perpage;
		$sql = "SELECT disputes.*, tProfile.firstName as tFN,tProfile.lastName as tLN,sProfile.firstName as sFN,sProfile.lastName AS sLN FROM disputes LEFT JOIN profile AS tProfile ON tProfile.uid = disputes.tid LEFT JOIN profile AS sProfile ON sProfile.uid = disputes.sid  where disputes.School_id={$id}  and disputes.schoolPaid=1 and  disputes.is_completed=1 and year(createAt) = year(curdate())"; 
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		return $result;
	}
	
	// added by haren to list Affiliate 
	public function GetAffiliateStu($id)
	{
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
		$uid = $this->session->userdata('uid');
		$sql = "SELECT readytotalk from user  WHERE  id = {$uid}   "  ;
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result; 
	}
	
	// functiona added by haren to check school code
	public function chkSchoolCode($val) {
		$errorMsg = array();
		$errorMsg['success'] = false;
		if ($val == '') {
			$errorMsg['message'] = 'School code cannot be empty.';
		} else if ($this->getsCode($val)) {
			$errorMsg['message'] = 'School code already taken.';
			$errorMsg['code'] = '100';
			//$errorMsg['success'] = false;
		} else {
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
		$strLen = strlen($string);
		//$strLen = 4;
		$keyLen = strlen($key);
		for ($i = 0; $i < $strLen; $i++) {
			$ordStr = ord(substr($string,$i,1));
			if ($j == $keyLen) { $j = 0; }
			$ordKey = ord(substr($key,$j,1));
			$j++;
			$hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
		}
		$user = $this->getByUid($string);
		if ($user['roleId']==0) {
			$link='st';
		}
		if ($user['roleId']==1 || $user['roleId']==2 || $user['roleId']==3 ) {
			$link='tu';
		}
		if ($user['roleId']==4) {
			$link='sc';
		}
		if ($user['roleId']==5) {
			$link='af';
		}
		
		$fn = $this->session->userdata['welcomeuser'];
		$reflink = base_url().$link."/".$fn.'.'.$hash;
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
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function school_add($data){
		//$lms_complete = $data['lms_complete'];
		$fname		= $data['firstName'];
		$uniqueId	= $data['UniqueId'];
		unset($data['lms_complete']);
		unset($data['UniqueId']);
		unset($data['firstName']);
		$this->db->query($this->db->insert_string('user',$data));
		$uid = $this->db->insert_id();
		$dataProfile['uid'] = $uid ;
		//$dataProfile['lms_complete'] = $lms_complete;
		$dataProfile['email']		= $data['email'];
		$dataProfile['firstName']	= $fname;
		$dataProfile['UniqueId']	= $uniqueId ;
		$this->db->query($this->db->insert_string('profile',$dataProfile));
		return true;
	}
	
	public function checkschoolid($val) {
		$errorMsg = array();
		$errorMsg['success'] = false;
		if ($val == '') {
			$errorMsg['message'] = 'UniqueId cannot be empty';
		} else if ($this->getschoolid($val)) {
			$errorMsg['message'] = 'UniqueId already exists.';
		} else {
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
		$result = array();
		$sql="select tutor_markup,curriculum from profile where uid={$id}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function GetAllAdvertise($ptn){
		if ($ptn =='') {
			$sql11 = "select * from school_addvertise  ORDER BY RAND() DESC";	
		} else {
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
		if ($sort==id) {
			$sort="p.uid";
		} else if($sort=='name') {
			$sort="p.firstName";
		} else if($sort=='cname') {
			$sort="p.principle_name";
		} else if($sort=='email') {
			$sort="p.email";
		} else if($sort=='date') {
			$sort="u.add_time";
		} else if($sort=='total') {
			$sort="t1";
		} else if($sort=='pbal') {
			$sort="p.pbalance";
		} else {
			$sort="p.firstName";
		}
		$sql="select p.pbalance,p.firstName,p.lastName,p.principle_name,p.id,u.add_time, p.uid, p.firstName,p.email from user u left join profile p on u.id =p.uid where p.uid=u.id and u.roleId=4 GROUP BY p.uid order by p.firstName asc";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		return $result;
	}
	
	public function affiSummary($search,$sort,$sortorder)
	{
		$result=array();
		if ($sort == "id") {
			$sort="user.id";
		} elseif ($sort == 'name') {
			$sort="profile.firstName";
		} elseif($sort == 'cname') {
			$sort="profile.principle_name";
		} elseif($sort == 'email') {
			$sort="user.email";
		} elseif($sort == 'date') {
			$sort="user.add_time";
		} else {
			$sort="profile.firstName";
		}
		if ($search == '') {
			 $sql= "select distinct user.email,user.id, profile.firstName, profile.lastName,profile.principle_name,user.add_time from user, profile where user.id= profile.uid and user.roleId=5 GROUP BY profile.uid order by {$sort} {$sortorder}";
		} else {
		   $sql= "select distinct user.email,user.id, profile.firstName, profile.lastName,profile.principle_name,user.add_time from user, profile where user.id= profile.uid and user.roleId=5 and  (user.id like '{$search}' OR user.email like '{$search}' OR profile.firstName like '{$search}' OR profile.lastName like '{$search}') GROUP BY profile.uid order by {$sort} {$sortorder}";
		}
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		return $result;
	}
	
	public function school_addnote($data) {
		$sql	= "INSERT INTO school_note set  ";
		$sql	.= "dispute_id=?,school_id=?,note=?,role=?,add_date=?";
		$query	= $this->db->query($sql,array($data['dispute_id'],$data['school_id'],$data['note'],$data['role'],$data['date']));
		return  $this->db->insert_id();
	}
	
	public function Affi_addnote($data) {
		$sql	= "INSERT INTO affi_note set  ";
		$sql	.="Affi_id=?,note=?,role=?,add_date=?,dispute_id=?";
		$query 	= $this->db->query($sql,array($data['school_id'],$data['note'],$data['role'],$data['date'],$data['dispute_id']));
		return  $this->db->insert_id();
	}
	
	public function getAffiAmount($id) {
		$sql = "select count(sid) as stid, sum(amount) as total,sum(PaidAmount) as pamount,paid from affiliate where refid={$id}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->row_array();
		}
		return $result;
	}
	
	public function updatefreesession($id)
	{
		$sql="update profile p set p.free_session='n' where p.uid={$id}";
		$this->db->query($sql);
	}
	
	public function GetAllMemberNotes($search = '') {
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
		$sql	= "INSERT INTO membernotes set  ";
		$sql	.=" dispute_id=?,user_id=?,note=?,role=?,add_date=?";
		$query	= $this->db->query($sql,array($data['dispute_id'],$data['user_id'],$data['note'],$data['role'],$data['date']));
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
	
	public function GetAllMemeber($start=0,$sort,$sortorder,$length = 20) {
		$result = array();
		if ($sort=="id") {
			$sort="user.id";
		} else if($sort=="name") {
			$sort="profile.firstName";
		} else if($sort=="role") {
			$sort="user.roleId";
		} else {
			$sort="user.id";
		}
		$sql = "select user.id,user.roleId,profile.hRate,profile.uid,profile.firstName,profile.lastName,profile.money from user left join profile on user.id=profile.uid  where user.id > 0 and user.roleId >= 0 and profile.uid > 0 order by {$sort} {$sortorder} limit {$start} , {$length}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function GetAllMemeberSearch($start ='',$search,$sort,$sortorder){
		$result = array();
		if ($sort=="id") {
			$sort="user.id";
		}
		if ($sort=="name") {
			$sort="profile.firstName";
		}
		if ($sort=="role") {
			$sort="user.roleId";
		}
		$sql = "select user.id,user.roleId,profile.money,profile.hRate,profile.uid,profile.firstName,profile.lastName,profile.money from user left join profile on user.id=profile.uid  where profile.firstname like '%{$search}%' OR profile.lastName like '%{$search}%' order by {$sort} {$sortorder} ";
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
		if ($sort=="id") {
			$sort="user.id";
		}
		if ($sort=="name") {
			$sort="profile.firstName";
		}
		if ($sort=="role") {
			$sort="user.roleId";
		}
		$sql = "select * from user left join profile on user.id=profile.uid  where MONTH(user.add_time)='{$day}' and YEAR(user.add_time)='{$year}' order by {$sort} {$sortorder} limit {$start} , {$length}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
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
	
	public function getSessionAttendAmount($uid,$date) {
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
	
	public function getAffiIncome($id,$date) {
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
	
	public function getStudentAmount($id) {
		$sql="select sum(purchaseamount) as pamount from affiliate where sid={$id}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->row_array();
		}
		return $result;
	}
	
	public function getState($uid) {
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
		$sql11 = "Select msg from  feedback where callerId={$ptn}";	
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			$result= $query11->result_array();
		}
		return $result;
	}
	
	public function getNewMemberPuerchaseamount($id) {
		$result = array();
		$sql="select purchaseamount from affiliate where sid={$id}";
		$query  = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		return $result;
	}
	
	public function getSlotData($userid,$fromDate,$toDate,$divid,$divaction,$logintype,$additionalprofileid) {
		$querytype = "";
		$tmpstarttime = explode("_",str_replace("div","",$divid));
		$starttime = $tmpstarttime[0]."-".$tmpstarttime[1]."-".$tmpstarttime[2]." ".$tmpstarttime[3].":".$tmpstarttime[4].":00";
		$starttime = strtotime($starttime);
		$endtime = strtotime("+25 minutes",$starttime);
		$starttime = date("Y-m-d H:i:s",$this->inTime(date("Y-m-d H:i:s",$starttime)));
		$endtime = date("Y-m-d H:i:s",$this->inTime(date("Y-m-d H:i:s",$endtime)));
		$localTimeZone = $this->input->_request('localTimeZone');
		$addmin = (($localTimeZone * 60) * (-1));
		if ($divaction == "add") {
			$querytype = "insert";
			$q = "Insert into timeSlot(uid,startTime_tm,endTime_tm,startTime,endTime) values (".($userid).",'".strtotime($starttime)."','".strtotime($endtime)."','".$starttime."','".$endtime."')";
			$userId=$this->user['uid'];
			$sql="update profile set Cal_open=1 where uid='{$userId}'";
			$this->db->query($sql);
		} else {
			if ($divaction == "GetAll") {
				if ($logintype == "student") {
					if ($additionalprofileid > 0) {
						$querytype = "select";
						$q = "Select id,uid,stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(startTime),'_',day(startTime),'_',hour(startTime),'_',minute(startTime)) as divid,concat(monthname(startTime),' ',day(startTime),' ',year(startTime),' ',hour(startTime),':',minute(startTime),':00') as startTime from timeSlot where date(startTime) >= '".$fromDate."' and date(endTime) <= '".$toDate."' and uid = ".$additionalprofileid." order by hour(startTime),minute(startTime)";
						$q = "Select id,uid,stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime from timeSlot where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(endTime) <= '".$toDate."' and uid = ".$additionalprofileid." order by hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))";
						$q = "Select id,uid,stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime,'timeSlot' as tabletype from timeSlot where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(DATE_ADD(endTime, INTERVAL ".$addmin. " MINUTE)) <= '".$toDate."' and uid = ".$additionalprofileid." union ";
						$q = $q."Select id,tid as uid,sid as stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime,'class' as tabletype from class where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(DATE_ADD(endTime, INTERVAL ".$addmin. " MINUTE)) <= '".$toDate."' and tid = ".$additionalprofileid." ";
						$q = $q." order by hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),tabletype";
					} else {
						$querytype = "select";
						$q = "Select id,uid,stid,concat(year(startTime),'_',month(startTime),'_',day(startTime),'_',hour(startTime),'_',minute(startTime)) as divid,concat(monthname(startTime),' ',day(startTime),' ',year(startTime),' ',hour(startTime),':',minute(startTime),':00') as startTime from timeSlot where date(startTime) >= '".$fromDate."' and date(endTime) <= '".$toDate."' and stid = ".$userid." order by hour(startTime),minute(startTime)";
						$q = "Select id,uid,stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime from timeSlot where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(endTime) <= '".$toDate."' and stid = ".$userid." order by hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))";
						$q = "Select id,uid,stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime,'timeSlot' as tabletype from timeSlot where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(DATE_ADD(endTime, INTERVAL ".$addmin. " MINUTE)) <= '".$toDate."' and stid = ".$userid." union ";
						$q = $q."Select id,tid as uid,sid as stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime,'class' as tabletype from class where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(DATE_ADD(endTime, INTERVAL ".$addmin. " MINUTE)) <= '".$toDate."' and sid = ".$userid." ";
						$q = $q." order by hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),tabletype";
					}
				} else {
					$querytype = "select";
					$q = "Select id,uid,stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime,'timeSlot' as tabletype from timeSlot where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(DATE_ADD(endTime, INTERVAL ".$addmin. " MINUTE)) <= '".$toDate."' and uid = ".$userid." union ";
					$q = $q."Select id,tid as uid,sid as stid,concat(year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',month(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),'_',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE))) as divid,concat(monthname(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',day(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',year(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),' ',hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':',minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),':00') as startTime,'class' as tabletype from class where date(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)) >= '".$fromDate."' and date(DATE_ADD(endTime, INTERVAL ".$addmin. " MINUTE)) <= '".$toDate."' and tid = ".$userid." ";
					$q = $q." order by hour(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),minute(DATE_ADD(startTime, INTERVAL ".$addmin. " MINUTE)),tabletype";
				}
			} else {
				if ($divaction == "delete") {
					$querytype = "delete";
					$q = "delete from timeSlot where uid = ".$userid." and startTime = '".$starttime."'";
				} else if ($divaction == "confirm") {
					$MYQ = "update class set confirmby=1,Booking='Booked' where tid = ".$userid." and startTime = '".$starttime."'";
					$this->db->query($MYQ);
					$querytype = "confirm";
					$q = "delete from timeSlot where uid = ".$userid." and startTime = '".$starttime."'";
				}
			}
		}
		$query = $this->db->query($q);
		if ($querytype == "select") {
			if ($query->num_rows() > 0) {
				$result = $query->result_array();
			} else {
				$result =array();
			}
		} else {
			if ($querytype == "insert") {
				$result = $this->db->insert_id();
			} else {
				if ($querytype == "update") {
					$result = $this->db->affected_rows();
				} else {
					if ($querytype == "delete") {
						$result = "1";
					} else {
						if ($querytype == "confirm") {
							$result = "1";
						}
					}
				}
			}
		}
		return array("result"=>$result,"querytype"=>$querytype,"qy"=>$q);
	}
	
	public function getClassData($userid,$divid)
	{
		$tmpstarttime = explode("_",str_replace("div","",$divid));
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
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	function getconversationtopic($userid) {
		$multi_lang = 'en';
		if (!isset($_SESSION)) {
			session_start();
		}
		if (isset($_SESSION['multi_lang'])) {
			$multi_lang = $_SESSION['multi_lang'];
		} else {
			$multi_lang = 'en';
		}
		$this->load->model(array('lookup_model'));
		$arrVal = $this->lookup_model->getValue('1105', $multi_lang);
		$selecType = $arrVal[$multi_lang];
		$q = "Select id,topic_text from conversation_topic where userid in (0)";
		$query = $this->db->query($q);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		//$q = "<option value='-1' selected='selected'>".$selecType."</option>";
		$q = "<option value='Personal Introduction' selected='selected'>"."Personal Introduction"."</option>";
		foreach ($result as $key => $values) {
			$q = $q."<option value='".$values["id"]."'>".$values["topic_text"]."</option>";
		}
		$q = $q."<option value='0'>Other</option>";
		return $q;
	}
	
	function calculatetime($divid) {
		
	}
	
	function addtxtconversationtopic($userid,$conversationtopic,$txtconversationtopic)
	{
		if ($conversationtopic == "Other") {
			$conversationtopic = $txtconversationtopic;
		}
		$q = "insert into conversation_topic(userid,topic_text) values (".$userid.",'".$conversationtopic."')";
		// $query = $this->db->query($q);
	}
		
	public function GetSchoolUsers($start = 0,$search = '',$sort,$sortorder,$length = 20)
	{
		$result = array();
		$sql = "select u.*, CONCAT(p.firstName, ' ',p.lastName) as usernm from user as u,profile as p where u.id = p.uid and u.roleId=4 and(u.id like '{$search}' OR u.email like '{$search}' OR p.firstname like '%{$search}%' OR p.lastName like '%{$search}%' ) order by {$sort} {$sortorder} limit {$start} , {$length}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function GetAllschoolData($start = 0,$sort,$sortorder,$length = 20){
		$result = array();
		$sql = "select u.*, (select expDate from pay c where uid = u.id order by id desc limit 0, 1) as expDate, CONCAT(p.firstName, ' ',p.lastName) as usernm from user as u,profile as p where u.id = p.uid and u.roleId=4 order by {$sort} {$sortorder}";
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
		$this->db->select("sum(t_hrate)AS tuid");
		$this->db->from('disputes');
		$this->db->where('MONTH(createAt)=',$mon);
		$this->db->where('YEAR(createAt)=',$yr);
		$this->db->where('tid',$uid);
		$this->db->where("p_status = 'paid'");
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
		return $result;
	}
	
	public function getSubstu($id,$date)
	{
		$dt	=explode('/',$date);
		$mon=$dt[0];
		$yr	=$dt[1];
		$this->db->select("sum(fee) AS stufee");
		$this->db->from('class');
		$this->db->where('MONTH(createAt)=',$mon);
		$this->db->where('YEAR(createAt)=',$yr);
		$this->db->where('sid',$id);
		$this->db->where('s_attend = 1');
		$this->db->where('isDenied = 0');
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
		$this->db->where('isDenied = 0');
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
		if ($schoolid == 0) {
			$q = "Select hRate from profile where uid = ".$userid;
		} else {
			$q = "Select hRate from profile where uid = ".$schoolid;
		}
		$query = $this->db->query($q);
		$resultmoney = 0;
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			foreach($result as $key => $values)
			{
				$resultmoney = $values["hRate"];
			}
		}
		return $resultmoney;
	}
	
	public function getsesstioncostnew($userid,$configvalues,$tutorid)
	{
		$isnew = 0;
		$q= "SELECT exp_session,is_eligible from user where  user.id='{$userid}'";
		$classquery = $this->db->query($q);
		$classresult = $classquery->row_array();
		$cdate=date('Y-m-d');
		if ($classresult['exp_session'] > $cdate AND $classresult['is_eligible']==1) {
			$isnew ="y";
		}
		$sql="select free_session from user where id='{$tutorid}'";
		$checkAllow = $this->db->query($sql);
		$res = $checkAllow->row_array();
		if ($isnew != "0" && $res['free_session'] == 'y') {
			$tutorcost = 0;
			$schooltutorcost = 0;
		} else {
			// code added by haren for free session between school student tutor
			$stuid=$this->session->userdata['uid'];
			if ($stuid !='') {
				$sql="select refid from user where id={$stuid}";
				$query = $this->db->query($sql);
				if ($query->num_rows() > 0) {
					$result = $query->row_array();
				}
				$refid=$result['refid'];
				if ($refid > 0) {
					$sql="select uid,pbalance from profile where uid={$refid} and pbalance > 0";
					$query = $this->db->query($sql);
					if ($query->num_rows() > 0) {
						$result = $query->row_array();
					}
					$schid=$result['uid'];
					$pbalance=$result['pbalance'];
					$q = "Select school_id from profile where uid = ".$tutorid;
					$query = $this->db->query($q);
					if ($query->num_rows() > 0) {
						$result = $query->row_array();
					}
					$schooId=$result['school_id'];
					if ($refid==$schooId) {
						$schooltutorcost='0';
					}
					$q = "Select hRate,school_id from profile where uid = ".$tutorid;
					$query = $this->db->query($q);
					$resultmoney = 0;
					if ($query->num_rows() > 0) {
						$result = $query->result_array();
						foreach($result as $key => $values)
						{
							$resultmoney = $values["hRate"];
							$schoolid  = $values["school_id"];
						}
					}
					$tutorcost = round($resultmoney * $configvalues)/100;
					$affiliate=1;
				} else {
					$q = "Select hRate,school_id from profile where uid = ".$tutorid;
					$query = $this->db->query($q);
					$resultmoney = 0;
					if ($query->num_rows() > 0) {
						$result = $query->result_array();
						foreach($result as $key => $values)
						{
							$resultmoney = $values["hRate"];
							$schoolid  = $values["school_id"];
						}
					}
					$tutorcost = round($resultmoney * $configvalues)/100;
					if ($schoolid  == 0) {
						$schooltutorcost = -1;
					} else {
						$q = "select * from profile where uid = (select school_id from profile where uid=".$tutorid.") limit 1";
						$query = $this->db->query($q);
						$resultmoney = 0;
						if ($query->num_rows() > 0) {
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
						if ($hrate <=0) {
							$schooltutorcost = "0";
						}
						//$schooltutorcost = round($resultmoney * $configvalues)/100;
						$affiliate=0;
						$pbalance=0;
					}
				}
			}
		}
		return array("isnew"=>$isnew,"tutorcost"=>$tutorcost,"schooltutorcost"=>$schooltutorcost,"affiliate"=>$affiliate,"pbalance"=>$pbalance);
	}
		
	public function GetBigBal($id,$date,$rid)
	{
		$dt=explode('/',$date);
		$mon=$dt[0];
		$yr=$dt[1];
		$month = sprintf("%02d",$mon-1);
		if ($rid==0) {	
			$sql = "select sum(fee) as money from disputes where   sid = '$id' AND is_completed=1  AND(schoolPaid=1 OR approve=1)  AND DATE_FORMAT(createAt, '%Y-%m') = '$yr-$month'";
		} else {
			$sql = "select sum(t_hrate) as money from disputes where tid = '$id' AND(schoolPaid=1 OR approve=1) AND is_completed=1 AND DATE_FORMAT(createAt, '%Y-%m') = '$yr-$month'";
		}	
		$query = $this->db->query($sql);
		$result=array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function CheckOpenSlot($uid){
		$result = array();
		$sql = "select count(uid) as oslot from timeSlot where uid={$uid}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function GetAllSchoolStu($uid)
	{
		$result = array();
		$sql = "select user.id , profile.firstName, profile.lastName from user left join profile on user.id=profile.uid  where user.refid={$uid} and user.roleid=0 ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	/*public function GetMontlyStatement($date)
	{
		$dt=explode('/',$date);
		$mon=$dt[0];
		$yr=$dt[1];
		$sql = "SELECT class.*,tProfile.firstName as tFN,tProfile.lastName as tLN,sProfile.firstName as sFN,sProfile.lastName AS sLN FROM class LEFT JOIN profile AS tProfile ON tProfile.uid = class.tid LEFT JOIN profile AS sProfile ON sProfile.uid = class.sid  where class.school_id={$id} and class.s_attend=1 and MONTH(endTime) = '{$mon}'  and YEAR(endTime) = '{$yr}'"; 

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		echo $this->db->last_query();
		echo "<pre>"; print_r($result); die();
		return $result;
	}*/
	
	public function getStudentPurchase($id)
	{
		$sql="select  sum(amount) as total from affiliate where sid={$id}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->row_array();
		}
		return $result;
	}
	
	public function GetMemebrDataForCsv($start=0,$sort,$sortorder,$length = 20){
		$result = array();
		if ($sort=="id") {
			$sort="user.id";
		}
		$sql = "select user.*,profile.* from user left join profile on user.id=profile.uid  where user.id > 0 and user.roleId=0 and profile.uid > 0 order by {$sort} {$sortorder}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function GetUnconfirmedClass()
	{
		$result=array();
		$nowdate = date('Y-m-d H:i:s');
		$tomorrow = date('Y-m-d H:i:s',strtotime($nowdate . "+12 hours"));
		$sql="SELECT class.*,profile.email,profile.firstName,profile.lastName  from class left join profile on profile.uid=class.tid  WHERE  confirmby=0 and type='general' and ('{$nowdate}' BETWEEN `startTime` AND `endTime`)  and `startTime` <='{$tomorrow}'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function GetUnconfirmedClassTutor()
	{
		$nowdate = date('Y-m-d H:i:s',time());
		$tomorrow = date('Y-m-d H:i:s',strtotime($nowdate . "+1 days"));
		$sql=" SELECT class.*,profile.email,profile.firstName,profile.lastName  from class left join profile on profile.uid=class.sid  WHERE  confirmby=0 and type='general' and ('{$nowdate}' BETWEEN `startTime` AND `endTime`)  and `startTime` <='{$tomorrow}'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function GetNewTutors($ptn){
		$result=array();
		$sql11 = "select DISTINCT p.uid,p.firstName,p.email,p.lastName,p.pic,u.roleId from profile as p left join  user as u on u.id=p.uid where u.roleId IN (1,2) AND pic_upload=1  AND vid_upload=1 AND BioGraphy=1  AND Cal_open=1    AND ( p.firstName like '%{$ptn}%' or p.email like '%{$ptn}%' ) AND p.isnewtutor=0  and u.quarantine !=1 ORDER BY RAND() DESC";	
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			$result= $query11->result_array();
		}
		return $result;
	}
	
	public function AddTonewUserList($uid)
	{
		$today = date("Y-m-d");
		$temp = strtotime($today);
		$exp = strtotime("+7 day", $temp);
		$exp = date("Y-m-d",$exp)."<br>";
		$sql1 = "insert into newtutors set uid={$uid},expirydate='{$exp}',insertdate='{$today}'";
		$query1 = $this->db->query($sql1);
		if ($query1) {
			$sql="update profile set isnewtutor=1 where uid={$uid}";
			$query1 = $this->db->query($sql);
			return true;
		} else {
			return false;
		}
	}
	
	public function GetAllNewtutor($start,$search,$sort,$sortorder)
	{
		$result=array();
		if ($sort=='id') {
			$sort="newtutors.newtutorid";
		} elseif($sort=="expDate") {
			$sort="newtutors.expirydate";
		} elseif($sort=="firstName") {
			$sort="profile.FirstName";
		}
		if ($search=='') {
			$sql11 = "select newtutors.*,profile.FirstName,profile.lastName from newtutors LEFT JOIN profile on profile.uid=newtutors.uid order by {$sort} {$sortorder}";	
		} else {
			$sql11 = "select newtutors.*,profile.FirstName,profile.lastName from newtutors LEFT JOIN profile on profile.uid=newtutors.uid where (newtutors.newtutorid like '{$search}'  OR profile.firstname like '%{$search}%' OR profile.lastName like '%{$search}%' )";	
		}
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			$result= $query11->result_array();
		}
		return $result;
	}
	
	public function GettotalResult(){
		$sql = "select count(newtutorid) as count from newtutors";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	
	public function GetTutorbyId($uid){
		$result = array();	
		$sql = "Select * from newtutors where newtutorid=".$uid;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function GetDetailData($uid){
		$result = array();
		$sql = "Select FirstName,LastName from profile where uid={$uid}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function EditNewtutor($data)
	{
		$ID=$data['newtutorid'];
		$sql="update newtutors set expirydate='{$data['expirydate']}' where newtutorid={$ID}";
		$query = $this->db->query($sql);
	}
	
	public function deleteNewtutor($id){
		foreach($id as $v)
		{
			$sql = "DELETE FROM newtutors WHERE  uid={$v}";
			$this->db->query($sql);
			$sql1="update profile set isnewtutor=0 where uid={$v}";
			$query1 = $this->db->query($sql1);
		}
		return $id;
	}
	
	public function GetCountForNewTutor($search){
		$sql = "select count(newtutorid) as count from newtutors n,profile as p where n.uid = p.uid and (n.newtutorid like '{$search}'  OR p.firstname like '%{$search}%' OR p.lastName like '%{$search}%' )";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	
	public function getNewtutorcount(){
		$sql = "select count(newtutorid) as count from newtutors";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	
	/*haren- to get suggested tutor */
	public function GetSuggestedTutor(){	
		$result11 = array();
		$date=date('Y-m-d');
		$sql11 = "SELECT uid as id,uid from newtutors join user on `user`.`id` = `newtutors`.`uid` where `newtutors`.`expirydate` > '{$date}' and `user`.`quarantine` != '1' and `user`.`hiddenRole` != '1'";
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			$result11 = $query11->result_array();
		}
		return $result11;
	}
	
	/* by haren to get new tutor */
	public function GetDahboardNewTutor(){	
		$result11 = array();
		$date=date('Y-m-d');
		$sql11 = "SELECT user.exp_session as ecp, user.id,user.username,user.readytotalk,user.add_time,profile.pic,profile.uid,profile.hRate,profile.firstName,profile.lastName FROM user left join profile on user.id= profile.uid  WHERE user.roleId IN (1,2) AND profile.pic_upload=1 AND vid_upload=1 AND BioGraphy=1 AND Cal_open=1 AND user.quarantine = '0' AND user.`add_time` BETWEEN date_sub( CURDATE() , INTERVAL 7 day ) AND (CURDATE()+2)  ORDER BY user.id DESC";
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			$result11 = $query11->result_array();
		}
		return $result11;
	}
	
	/* by haren to get App */
	public function GetAllApps()
	{
		$result = array();
		$sql = "Select * from languageapp where status='Active' ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	/* added by haren to get gold tutor */
	public function GetGoldTutor()
	{
		$result = array();
		$sql = "SELECT user.id,profile.uid,profile.firstName,profile.lastName,profile.hRate,profile.pic,profile.city,countries.country ,provices.provice,user.readytotalk from profile LEFT JOIN user ON  user.id=profile.uid  LEFT JOIN countries ON countries.id = profile.country LEFT JOIN provices on provices.id = profile.province WHERE user.roleId=3";	
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function GetSchoolsSearch($ptn){
		$result=array();
		$sql11 = "select DISTINCT p.uid,p.firstName,p.email,p.lastName,p.pic,u.roleId from profile as p left join  user as u on u.id=p.uid where u.roleId =4 AND ( p.firstName like '%{$ptn}%' or p.email like '%{$ptn}%' ) ORDER BY RAND() DESC";	
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			$result= $query11->result_array();
		}
		return $result;
	}
	
	public function DoAddtoSchool($schoolid,$userid) 
	{
		$sql="update profile set school_id={$schoolid} where uid={$userid}";
		$this->db->query($sql);
		$sql1="update user set refid={$schoolid} where id={$userid}";
		$this->db->query($sql1);
	}
	
	public function DodeleteFromSchool($userId)
	{
		$sql="update profile set school_id=0 where uid={$userId}";
		$this->db->query($sql);
		$sql1="update user set refid=0 where id={$userId}";
		$this->db->query($sql1);
	}
	
	public function GetCountLayout($search){
		$sql = "select p.s_layout,p.firstName,p.lastName,p.id, p.uid from user u 
	  left join profile p on u.id =p.uid  where p.uid=u.id and u.roleId=4  and (p.firstName like '%{$search}%' or p.uid like '%{$search}%')GROUP BY p.uid";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $query->num_rows();
	}
	
	public function GetCountLayoutNosearch()
	{
		$sql="select p.s_layout,p.firstName,p.lastName,p.id, p.uid from user u 
	  left join profile p on u.id =p.uid  where p.uid=u.id and u.roleId=4 GROUP BY p.uid order by   p.uid DESC";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		return $query->num_rows();
	}

	public function GetSchoolLayoutData($start=0,$search='',$sort='',$order='',$length = 15)
	{
		if ($sort==id) {
			$sort="p.uid";
		} else if ($sort=='name') {
			$sort="p.firstName";
		} else {
			$sort="p.firstName";
		}
		if ($search=='') {
			$sql="select p.curriculum, p.s_layout,p.firstName,p.lastName,p.id, p.uid from user u 
			left join profile p on u.id =p.uid  where p.uid=u.id and u.roleId=4 GROUP BY p.uid order by {$sort} {$order} limit {$start} , {$length}"; 
		} else {
			$sql = "select p.curriculum ,p.s_layout,p.firstName,p.lastName,p.id, p.uid from user u 
			left join profile p on u.id =p.uid  where p.uid=u.id and u.roleId=4  and (p.firstName like '%{$search}%' OR p.lastName like '%{$search}%' or p.uid like '%{$search}%' ) GROUP BY p.id ";
		}
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result= $query->result_array();
		}
		return $result;
	}
	
	public function DoupdateStatus($id)
	{
		$sql = "select s_layout from profile where uid='{$id}' limit 1";
		$qry = $this->db->query($sql);
		$result= $qry->row_array();
		if ($result['s_layout']==0) {
			$sql="update profile set s_layout= 1 where uid={$id}";
			$this->db->query($sql);
		} else {
			$sql="update profile set s_layout= 0 where uid={$id}";
			$this->db->query($sql);
		}
	}
	
	public function Getcountgroup()
	{
		$sql = "select count(gropsessionId) as count from gropsession";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	
	public function GetSchoolInfo($schoolId)
	{
		$result=array();
		$sql = "select uid,s_layout,firstName,lastName,pic,s_disc,reflink from profile where uid ='{$schoolId}'  limit 1";	
		$qry = $this->db->query($sql);
		if ($qry->num_rows() > 0) {
			$result= $qry->row_array();
		}	
		return $result;
	}
	
	public function getdetailformail($uid)
	{
		$sql="select cell,firstName,lastName,email from profile where uid={$uid}";
		$query = $this->db->query($sql);
		return $result= $query->row_array();
	}
	
	public function DoUpdateCurriculum($id)
	{
		$sql = "select curriculum from profile where uid='{$id}' limit 1";
		$qry = $this->db->query($sql);
		$result= $qry->row_array();
		if ($result['curriculum']==0) {
			$sql="update profile set curriculum = 1 where uid={$id}";
			$this->db->query($sql);
		} else {
			$sql="update profile set curriculum= 0 where uid={$id}";
			$this->db->query($sql);
		}
	}
	
	public function GetTutorslist($ptn){
		$result=array();
		$sql11 = "select DISTINCT p.uid,p.firstName,p.email,p.lastName,p.pic,u.roleId from profile as p left join user as u on p.uid=u.id where u.roleId IN (1,2,3)  AND ( p.firstName like '{$ptn}%' or p.email like '{$ptn}%' ) group by p.uid limit 0,10 ";	
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			$result= $query11->result_array();
		}
		return $result;
	}
	
	public function InsetSession($data)
	{
		$start=$data['startTime'];
		$end= strtotime($start);
		$end=$end+(60*25);
		$end=date("Y-m-d H:i:s", $end); 
		$tut1=$data['tutor1'];
		$tut2=$data['tutor2'];
		$topic=mysql_real_escape_string($data['topic']);
		$Primary=$data['tutor1'];
		if ($tut2 == '') {
			$sql='insert into gropsession(Time,endTime,Tutor1,Tutor2,isprimary,Topic) values("'.$start.'","'.$end.'","'.$tut1.'",0,"'.$Primary.'","'.$topic.'")';
		} else {
			$sql='insert into gropsession(Time,endTime,Tutor1,Tutor2,isprimary,Topic) values("'.$start.'","'.$end.'","'.$tut1.'","'.$tut2.'","'.$Primary.'","'.$topic.'")';
		}
		$this->sendMailtotutor($data);
		return $this->db->query($sql);
	}
	
	public function sendMailtotutor($data)
	{
		//$time=hiaOutTime($data['startTime']);
		$this->load->library('email');
		$datail=$this->getdetailformail($data['tutor1']);
		$dt = date('H:i:s Y-m-d',strtotime($data['startTime']));
		$tutorTimezone = $this->getLastLocalTimeZone($data['tutor1']);
		$tutor_session_time = $this->utc_to_local('g:i A, Y-m-d',$dt,$tutorTimezone);
		$str='';
		$str .= "You are confirmed as a presenter for a Group Vee-session.  \r\n<br/>";	
		$str .= "The Vee-session start time is at your local time $tutor_session_time  \r\n<br/>";
		$str .= "If you have any problems please email the support team at: support@thetalklist.com \r\n<br/>";
		$str .= "Thank you,           TheTalkList Support Team";
		$toTutor = $datail['email'];
		$this->email->clear();
		$this->email->mailtype = 'html';
		$this->email->from('no-reply@thetalklist.com','TalkMaster BlueBob');
		$this->email->to($toTutor);
		$this->email->subject('TheTalklist Vee-session created.');
		$this->email->message($str);
		$this->email->send();
		$this->load->library('twilio');
		$from	= '+16193774807';
		$to		= $datail['cell'];
		$this->twilio->sms($from, $to, $str);
		if ($data['tutor2'] !='') {
			$datail=$this->getdetailformail($data['tutor2']);
			$dt = date('H:i:s Y-m-d',strtotime($data['startTime']));
			$tutortwoTimezone = $this->getLastLocalTimeZone($data['tutor2']);
			$tutortwo_session_time = $this->utc_to_local('g:i A, Y-m-d',$dt,$tutortwoTimezone);
			$str='';
			$str .= "You are confirmed as a presenter for a Group Vee-session.  \r\n<br/>";	
			$str .= "The Vee-session start time is at your local time $tutortwo_session_time  \r\n<br/>";
			$str .= "If you have any problems please email the support team at: support@thetalklist.com \r\n<br/>";
			$str .= "Thank you,           TheTalkList Support Team";
			$toTutor = $datail['email'];
			$this->email->clear();
			$this->email->mailtype = 'html';
			$this->email->from('no-reply@thetalklist.com','TalkMaster BlueBob');
			$this->email->to($toTutor);
			$this->email->subject('TheTalklist Vee-session created.');
			$this->email->message($str);
			$this->email->send();
			$this->load->library('twilio');
			$from	= '+16193774807';
			$to 	= $datail['cell'];
			$this->twilio->sms($from, $to, $str);
		}
	}
	
	public function GetAllSession($start,$length=10)
	{
		$result=array();
		$sql = "select * from gropsession order by Time DESC limit {$start} , {$length}";	
		$query11 = $this->db->query($sql);
		if ($query11->num_rows() > 0) {
			$result= $query11->result_array();
		}
		return $result;
	}
	
	public function GetSessionbyId($id){
		$sql = "SELECT * FROM gropsession where gropsessionId={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		} else {
			$result = array();
		}
		return $result;
	}
	
	public function UpdateSession($data,$id){
		$start=$data['Time'];
		$end= strtotime($start);
		$end=$end+(60*25);
		$end=date("Y-m-d H:i:s", $end); 
		$tut1=$data['tutor1'];
		$tut2=$data['tutor2'];
		$primary= $data['IspRIMARY'];
		$topic= $data['Topic'];
		$sql = "update gropsession set Time='{$start}',endTime='{$end}',Tutor1='{$tut1}',Tutor2='{$tut2}',isprimary='{$primary}',Topic='{$topic}' where gropsessionId={$id}";
		$query = $this->db->query($sql);
	}
	
	public function GetNextSession()
	{
		$result	= array();
		$dt		= date('Y-m-d H:i:s');
		$end	= strtotime($dt);
		$end	= $end-(60*25);
		$end	= date("Y-m-d H:i:s", $end);
		$sql	= "select * from gropsession where Time >='{$end}' order by Time limit 1";	
		$query11 = $this->db->query($sql);
		if ($query11->num_rows() > 0) {
			$result= $query11->row_array();
		}
		return $result;
	}
	
	/* added by Haren  */
	public function GetAdvanceSession()
	{
		$result	= array();
		$dt		= date('Y-m-d H:i:s');
		$end	= strtotime($dt);
		$end	= $end+(60*30);
		$end	= date("Y-m-d H:i:s", $end);
		$sql 	= "select * from gropsession where endTime >='{$end}' order by Time limit 1";	
		$query11 = $this->db->query($sql);
		if ($query11->num_rows() > 0) {
			$result= $query11->row_array();
		}
		return $result;
	}
	
	public function DeleteSession($id )
	{
		foreach($id as $v)
		{
			$sql = "DELETE FROM gropsession WHERE gropsessionId={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	
	public function CheckAttandance($cid,$uid)
	{
		$dt = date('Y-m-d');
		$sql = "select * from groupattandance where groupSession_id='{$cid}' AND userId='{$uid}'";
		$query11 = $this->db->query($sql);
		if ($query11->num_rows() > 0) {
			
		} else {
			$sql="insert into groupattandance(groupSession_id,userId,date) values('{$cid}','{$uid}','{$dt}')";
			$this->db->query($sql);
		}
	}
	
	public function GetDetail($id)
	{
		$sql = "select isconfirmedAccount from user where id='{$id}' limit 1";
		$qry = $this->db->query($sql);
		$result= $qry->row_array();
		if (@$result['isconfirmedAccount']==1) {
			$this->session->set_userdata('RegLink','Your account is already verified. Please login with your credential.');
			redirect(base_url('user/login'));
		}
		$sql1="update user set isconfirmedAccount= 1 where id={$id}";
		$this->db->query($sql1);
		$sql="select user.*,profile.firstName from user left join profile on user.id=profile.uid where user.id={$id}";
		$query1 = $this->db->query($sql);
		return $result= $query1->row_array();
	}
	
	function gettotalguide($search)
	{
		if ($search == '') {	
			$sql="select count(guide_categories_id) as total from guide_categories";
		} else {
			$sql="select count(guide_categories_id) as total from guide_categories where name like '%{$search}%' or guide_categories_id like '%{$search}%'";
		}
		$qry=$this->db->query($sql);
		$result=$qry->row_array();
		return $result['total'];
	}
	
	function getuserguide($start,$search,$limit,$sortorder,$sort)
	{
		if ($sort=='id') {
			$sort='guide_categories_id';
		}
		$result=array();
		if ($search !='') {
			$sql="select * from guide_categories where name like '%{$search}%'   or guide_categories_id like '%{$search}%'order by {$sort} {$sortorder} limit {$start} , {$limit} ";
		} else {		
			$sql="select * from guide_categories order by {$sort} {$sortorder} limit {$start} , {$limit}";
		}
		$qry=$this->db->query($sql);
		$result=$qry->result_array();
		return $result;
	}
	
	public function Addguide($data)
	{
		$name=$data['name'];
		$sql = "insert into guide_categories(name) value('{$name}')";
		return $query11 = $this->db->query($sql);
	}
	
	public function getGuidebyId($id)
	{
		$result=array();
		$sql="select * from guide_categories where guide_categories_id='{$id}'";
		$qry=$this->db->query($sql);
		$result=$qry->row_array();
		return $result;
	}
	
	public function guide_edit($data,$id)
	{
		$name= $data['name'];
		$sql = "update guide_categories set name='{$name}' where guide_categories_id='{$id}'";
		return $query11 = $this->db->query($sql);
	}
	
	public function deleteguide($id)
	{
		$id=$id[0];
		$sql = "delete from guide_categories where guide_categories_id='{$id}'";
		return $query11 = $this->db->query($sql);
	}
	
	function changestatus($id)
	{
		$sql="select status from guide_categories";
		$qry=$this->db->query($sql);
		$result=$qry->row_array();
		if ($result['status']=='Active') {
			$sql = "update guide_categories set status='InActive' where guide_categories_id='{$id}'";
			return $query11 = $this->db->query($sql);
		}
		if ($result['status']=='InActive') {
			$sql = "update guide_categories set status='Active' where guide_categories_id='{$id}'";
			$query11 = $this->db->query($sql);
			return; 
		}
		 
	}
	
	// By Ilyas
	function fnUpdateUser($data, $cnd = array()) {
		if (sizeof($cnd) > 0) {
			$this->db->where($cnd);
			$this->db->update("user", $data); 
		}
		return;
	}
	
	public function GetAllNewinterviewers($start,$search,$sort,$sortorder)
	{
		$result=array();
		if ($sort=='id') {
			$sort="newinterviewer.newtutorid";
		} elseif ($sort=="expDate") {
			$sort="newinterviewer.expirydate";
		} elseif ($sort=="firstName") {
			$sort="profile.FirstName";
		}
		if ($search=='') {
			$sql11 = "select newinterviewer.*,profile.FirstName,profile.lastName from newinterviewer LEFT JOIN profile on profile.uid=newinterviewer.uid order by {$sort} {$sortorder}";	
		} else {
			$sql11 = "select newinterviewer.*,profile.FirstName,profile.lastName from newinterviewer LEFT JOIN profile on profile.uid=newinterviewer.uid where (newinterviewer.newtutorid like '{$search}'  OR profile.firstname like '%{$search}%' OR profile.lastName like '%{$search}%' )";	
		}
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			$result= $query11->result_array();
		}
		return $result;
	}
	
	public function GetCountForNewinterviewer($search){
		$sql = "select count(newtutorid) as count from newinterviewer n,profile as p where n.uid = p.uid and (n.newtutorid like '{$search}'  OR p.firstname like '%{$search}%' OR p.lastName like '%{$search}%' )";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	
	public function getNewinterviewercount(){
		$sql = "select count(newtutorid) as count from newinterviewer";
		$query = $this->db->query($sql);
		$result['count'] = 0;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return @$result['count'];
	}
	
	public function GetNewInterviewers($ptn){
		$result=array();
		$sql11 = "select DISTINCT p.uid,p.firstName,p.email,p.lastName,p.pic,u.roleId from profile as p left join  user as u on u.id=p.uid where u.roleId IN (1,2,3) AND pic!='' AND vedio!='' AND BioGraphy=1 AND  ( p.firstName like '%{$ptn}%' or p.email like '%{$ptn}%' ) AND p.isrecinterviewer=0  and u.quarantine !='1' ORDER BY RAND() DESC";	
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			$result= $query11->result_array();
		}
		return $result;
	}
	
	public function AddTonewInterviewerList($uid)
	{
		$today	= date("Y-m-d");
		$temp	= strtotime($today);
		$exp	= strtotime("+7 day", $temp);
		$exp	= date("Y-m-d",$exp)."<br>";
		$sql1	= "insert into newinterviewer set uid={$uid},expirydate='{$exp}',insertdate='{$today}'";
		$query1 = $this->db->query($sql1);
		if ($query1) {
			$sql="update profile set isrecinterviewer=1 where uid={$uid}";
			$query1 = $this->db->query($sql);
			return true;
		} else {
			return false;
		}
	}
	
	public function EditNewinterviewer($data){
		$ID=$data['newtutorid'];
		$sql="update newinterviewer set expirydate='{$data['expirydate']}' where newtutorid={$ID}";
		$query = $this->db->query($sql);
	}
	
	public function deleteNewinterviewer($id){
		foreach($id as $v){
			$sql = "DELETE FROM newinterviewer WHERE  uid={$v}";
			$this->db->query($sql);
			$sql1="update profile set isrecinterviewer=0 where uid={$v}";
			$query1 = $this->db->query($sql1);
		}
		return $id;
	}
	
	public function GetInterviewerbyId($uid)
	{
		$result = array();
		$sql = "Select * from newinterviewer where newtutorid=".$uid;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			
		}
		return $result;
	}
	
	public function GetSuggestedInterviewer()
	{	
		$result =	array();		
		$date	=	date('Y-m-d');
		$sql	=	"SELECT uid as id,uid from newinterviewer where expirydate >= '{$date}'";
		$query	= 	$this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
		
	}
	
	public function GetBrDahboardTutor(){	
		$result11 = array();		
		$date = date('Y-m-d');
		$sql11 = "SELECT user.exp_session as ecp, user.id,user.username,user.readytotalk,user.add_time,profile.pic,profile.uid,profile.hRate,profile.firstName,profile.lastName ,profile.city,countries.country ,provices.provice FROM user left join profile on user.id= profile.uid  LEFT JOIN countries ON countries.id = profile.country LEFT JOIN provices on provices.id = profile.province  WHERE user.roleId IN (1,2,3) AND profile.pic_upload=1 AND vid_upload=1 AND BioGraphy=1 AND Cal_open=1 AND user.quarantine = '0' ORDER BY rand() DESC limit 16";
		$query11 = $this->db->query($sql11);
		if ($query11->num_rows() > 0) {
			$result11 = $query11->result_array();
		}
		return $result11;
	}
	
	public function getLanguageIp($country) {
		$country=trim($country);
		$result1 = array();
		$sql="select `id`,`Language` from countries where iso2='{$country}'";
		$query = $this->db->query($sql);			 
		return $result1 = $query->row_array();
	}
	
	// Insert Data in to Transaction Table
	public function fnInsertTransaction($data=array()){	
		if (!empty($data)) {
			$this->db->insert('transaction', $data); 
			return $this->db->insert_id();
		} else {			
			return false;
		}
	}
	
	public function fnUpdateTransaction($data=array(),$cond = array()){	
		if (!empty($data) and !empty($cond)) {
			$this->db->update('transaction', $data, $cond);
			return true;
		} else {			
			return false;
		}
	}
	
	public function fnSelectTransaction($data,$cond = array()){	
		if (!empty($data) and !empty($cond)) {
			$this->db->select($data);
			$query = $this->db->get_where('transaction', $cond);
			return $query->result();
		} else {			
			return false;
		}
	}
	
	public function fnGetTransaction($cond = "", $offset=0, $limit = 20, $sort="id", $sortorder="DESC"){	
		$whr = "";
		if ($cond != "") {
			$whr .= $cond;
		}
		$sql = "select t.*,p.`firstName`, p.`lastName` from `transaction` as t join `profile` as p on `p`.`uid` = `t`.`user_id` where ".$whr." order by `".$sort."`  ".$sortorder." limit ".$offset.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function fnUpdateProfileCashout($amount,$cond = array()){	
		if (!empty($amount) and !empty($cond)) {
			$this->db->set('money', 'money-'.$amount, FALSE);
			$this->db->set('frMoney', 'frMoney+'.$amount, FALSE);
			$this->db->where($cond);
			$this->db->update('profile');
			return true;
		} else {			
			return false;
		}
	}
	
	public function fnGetTotalMemeber($search=""){
		$result = array();		
		$searchparameter = "";
		if ($search) {
			$searchparameter = " and (user.id like '{$search}' OR user.email like '{$search}' OR profile.firstname like '%{$search}%' OR profile.lastName like '%{$search}%' )";
		}
			
		$sql = "select count(user.id) as total from user join profile on user.id=profile.uid  where user.id > 0 and user.roleId >= 0 and user.roleId <=3 and profile.uid > 0 ".$searchparameter;
		
		$totalData = 0;
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$totalData = $result[0]['total'];
		}
		return $totalData;
	}
	
	public function fnGetAllMemeber($start=0,$sort,$sortorder,$length = 20,$search=""){
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
		$searchparameter = "";
		if ($search) {
			$searchparameter = " and (user.id like '{$search}' OR user.email like '{$search}' OR profile.firstname like '%{$search}%' OR profile.lastName like '%{$search}%' )";
		}	
		$sql = "select user.id,user.roleId,profile.hRate,profile.uid,profile.firstName,profile.lastName,profile.money from user join profile on user.id=profile.uid  where user.id > 0 and user.roleId >= 0 and user.roleId <=3 and profile.uid > 0 ".$searchparameter." order by {$sort} {$sortorder} limit {$start} , {$length}";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function fnGetMonthBal($uid, $curMonth,$status="")
	{
		$curMonth = str_replace("/","-",$curMonth);
		$balance = 0;
		$sql = "SELECT SUM(`amount`) as `totalbalance` FROM `transaction` where`user_id` = '".$uid."' and DATE_FORMAT(date,'%m-%Y')='".$curMonth."' and `amount_status` = '".$status."' and `payment_status` IN ('Paid','Refund') ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$balance = $result[0]['totalbalance'];
		}
		if ($status=="credit") {
			$sql = "SELECT SUM(`amount`) as `totalbalance` FROM `transaction` where`user_id` = '".$uid."' and DATE_FORMAT(date,'%m-%Y')='".$curMonth."' and `amount_status` = 'debit' and `payment_status` = 'Refund'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$result = $query->result_array();
				$refbalance = $result[0]['totalbalance'];
				$balance = $balance + $refbalance;
			}	
		}		
		return $balance;
	}
	
	public function fnGetOpBal($uid, $curMonth) 
	{
		$curMonth = str_replace("/","-",$curMonth);
		$sql="SELECT `op_bal` FROM `memberbalance` where`uid`='".$uid."' and DATE_FORMAT(month,'%m-%Y')='".$curMonth."'";
		$query = $this->db->query($sql);
		$opBal = 0;
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$opBal = $result[0]['op_bal'];
		}		
		return $opBal;
	}
	
	public function fnGetAllUser($start=0,$sort,$sortorder="ASC",$search=""){
		$result = array();
		if ($sort=="id") {
			$sort="user.id";
		} else if ($sort=="name") {
			$sort="profile.firstName";
		} else if ($sort=="role") {
			$sort="user.roleId";
		} else {
			$sort="user.id";
		}
		$searchparameter = "";
		if ($search) {
			$searchparameter = " and (user.id like '{$search}' OR user.email like '{$search}' OR profile.firstname like '%{$search}%' OR profile.lastName like '%{$search}%' )";
		}
		$sql = "select user.id,user.roleId,profile.hRate,profile.uid,profile.firstName,profile.lastName,profile.money from user join profile on user.id=profile.uid  where profile.uid > 0 ".$searchparameter." order by {$sort} {$sortorder} ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	public function fnInsOpBal($data) 
	{
		$sql = "select `id` from `memberbalance` where `uid` = '".$data['uid']."' and DATE_FORMAT(month,'%m-%Y')= '".date("m-Y",strtotime($data['month']))."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0) {
			$sql = "insert into `memberbalance`(`uid`,`month`,`op_bal`) VALUES(".$data['uid'].",'".$data['month']."',".$data['op_bal'].")";
			$query = $this->db->query($sql);
		}
		return $this->db->insert_id();
	}
	
	public function fnUpEndBal($data) 
	{
		$sql = "Update `memberbalance` SET `end_bal` = '".$data['end_bal']."' where `uid` = ".$data['uid']." and DATE_FORMAT(month,'%m-%Y')= '".$data['month']."'";
		$query = $this->db->query($sql);
		return;
	}
	
	public function fnCrPurchaseTmDiff($uid) 
	{
		$hr = "";
		$sql = "SELECT HOUR(TIMEDIFF(now(), `payment_date`)) as hour FROM (`transaction`) WHERE `user_id` = '".$uid."' and `type` = 'Credit Purchase' order by `payment_date` DESC limit 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$hr = $result[0]['hour'];
		}
		return $hr;
	}
	
	// Get Pending Cashout Payment 
	public function fnGetPendingCashout() 
	{
		$sql = "SELECT `user_id`,`id`,`amount`, DATEDIFF( now( ), `payment_date` ) AS `datediff` FROM `transaction` WHERE `payment_status`='Paid' and `status`='Pending' and `type`='Cashout' HAVING `datediff` >= 7 order by `payment_date` DESC";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
	}
	
	// Insert/Update Search Record in recent_search Table
	public function fnUpdateSearchData($data) 
	{
		$query = $this->db->get_where('recent_search', array('user_id' => $data['user_id']));
		if ($query->num_rows() > 0) {
			$this->db->where('user_id', $data['user_id']);
			$this->db->update('recent_search', $data); 
		} else {
			$this->db->insert('recent_search', $data); 
		}
		return;
	}
	
	// Get List of Users by Recent Search Condition
	public function fnGetRecentSearch($uid) 
	{
		$query = $this->db->get_where('recent_search', array("user_id"=>$uid));
		$results = array();
		if ($query->num_rows() > 0) {
			$results = $query->result_array();
		}
		return $results;
	}
	 
	// Get List of Users by Search Condition
	public function fnGetUserByRecentSearch($uid)
	{
		$cnd = "";
		$res = $this->fnGetRecentSearch($uid);
		if (!empty($res)) {
			$arCnd = json_decode($res[0]['searchdata'],true);
			if (isset($arCnd['today']) and (!empty($arCnd['today']))) {
				$startdtfrm = $arCnd['today'].' '.$arCnd['fromTime'];
				$enddtfrm	= $arCnd['today'].' '.$arCnd['toTime'];
				$start		= date('Y-m-d H:i:s',strtotime($startdtfrm));
				$end		= date('Y-m-d H:i:s',strtotime($enddtfrm));
				$start		= date('Y-m-d H:i:s',$this->inTime($start));
				$end		= date('Y-m-d H:i:s',$this->inTime($end));				
				$qryTimeSlot = " JOIN `timeSlot` ON  `profile`.`uid` = `timeSlot`.`uid` ";
			}
			if (!empty($arCnd['langInput1'])) {
				$cnd .= " and (`profile`.`nativeLanguage` = '".$arCnd['langInput1']."')";
			}
			if (!empty($arCnd['langInput2'])) {
				$cnd .= " and (`profile`.`otherLanguage` = '".$arCnd['langInput2']."') ";
			}
			if (!empty($arCnd['keyword'])) {
				$keywords = explode(' ',trim($arCnd['keyword']));
				$cnd .= " and ( ";
				$i=1;
				foreach($keywords as $key=>$val){
					if($val==''){
						continue;
					}
					if ($i>1) {
						$cnd .= " OR ";
					}
					$cnd .= " `profile`.`academic` LIKE '%".$val."%' ";
					$cnd .= " OR `profile`.`professional` LIKE '%".$val."%' "; 
					$cnd .= " OR `profile`.`personal` LIKE '%".$val."%' "; 
					$cnd .= " OR `profile`.`firstName` LIKE '%".$val."%' "; 
					$cnd .= " OR `profile`.`lastName` LIKE '%".$val."%' ";
					$cnd .= " OR `user`.`username` LIKE '%".$val."%' ";
					$cnd .= " OR `user`.`email` LIKE '%".$val."%' ";
					$cnd .= " OR `profile`.`city` LIKE '%".$val."%' ";	
					$i++;
				}
				$cnd .= " ) ";
			}
			if (($arCnd['gender']!="") and ($arCnd['gender']!="all") ) {
				$cnd .= " and (`profile`.`gender` = '".$arCnd['gender']."') ";
			}
			if (!empty($arCnd['country'])) {
				$cnd .= " and (`profile`.`country` = '".$arCnd['country']."') ";
			}
			if (!empty($arCnd['province'])) {
				$cnd .= " and (`profile`.`province` = '".$arCnd['province']."') ";
			}
			if (!empty($arCnd['schoolId'])) {
				$cnd .= " and (`profile`.`school_id` = '".$arCnd['schoolId']."') ";
			}
		}
		$cnd .= " and (`profile`.`pic` != '') and `quarantine` = '0' ";
		if (isset($arCnd['today']) and (!empty($arCnd['today']))) {
			$cnd .= " and `timeSlot`.`startTime` >= '2015-12-01 23:00:00' AND `timeSlot`.`endTime` <= '2015-12-02 09:00:00' group by `timeSlot`.`uid`";
		}
		$cnd .= " and (`profile`.`pic` != '') and `quarantine` = '0' and `user`.`id`!='".$uid."'";
		$sql = "SELECT `user`.`id`, `profile`.`uid`, `profile`.`firstName`, `profile`.`lastName`, `profile`.`hRate`, `profile`.`pic`, `profile`.`city`, `countries`.`country`, `provices`.`provice`, `user`.`readytotalk` from `user` JOIN `profile` ON  `user`.`id` = `profile`.`uid` $qryTimeSlot LEFT JOIN `countries` ON `countries`.`id` = `profile`.`country` LEFT JOIN `provices` on `provices`.`id` = `profile`.`province` WHERE `user`.`roleId` IN (1,2,3) $cnd LIMIT 5";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			
		}
		return $result;
	}
	
	// Check User login with facebook is already exist
	public function fnFacebookUser($fb_id=NULL, $fb_email=NULL) {
		$result = array();
		if($fb_id!="" or $fb_email!="") {
			$sql = "SELECT * FROM user JOIN profile ON `user`.`id` = `profile`.`uid` WHERE `user`.`email`='$fb_email' limit 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$result = $query->row_array();
			}
		}
		return $result;
	}
	
	// Insert/Update Topic in Recent_Search Table
	function insTopic($data){
		$this->fnUpdateSearchData($data);
		return;
	}
	
	function fnGetUser($select="*", $cnd=array())
	{
		$this->db->select($select);
		$this->db->from('user');
		if (!empty($cnd)) {
			$this->db->where($cnd); 
		}
		$query = $this->db->get();		
		$result = array();
		if ($query->num_rows() > 0){
			$result = $query->result_array();
		}
        return $result;
	}
	
	// Get List of Ready to Talk Now Users 
	public function fnGetReadyToTalkNowUsers()
	{
		$uid = $this->session->userdata('uid');
		$setPrfHrate = ", `profile`.`hRate` "; 
		if ($this->session->userdata('uid')) {
			$resFree = $this->fnGetUser("is_eligible",array("id"=>$this->session->userdata('uid')));
			if ($resFree[0]['is_eligible']=="1") {
				$setPrfHrate = ", '0.00' as `hRate` ";
			}
		}
		$cnd = " and `user`.`readytotalk` ='1' and (`profile`.`pic` != '') and `quarantine` != '1' and `user`.`id`!='".$uid."' and `user`.`hiddenRole` !='1' ";
		$sql = "SELECT `user`.`id`, `profile`.`uid`, `profile`.`firstName`, `profile`.`lastName`, `profile`.`pic`, `user`.`readytotalk`,`profile`.`school_id` $setPrfHrate  from `user` JOIN `profile` ON  `user`.`id` = `profile`.`uid` WHERE `user`.`roleId` IN (1,2,3) $cnd ";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	function utc_to_local($format_string, $utc_datetime, $time_zone)
	{
		$date = new DateTime($utc_datetime, new DateTimeZone('UTC'));
		$date->setTimeZone(new DateTimeZone($time_zone));
		return $date->format($format_string);
	}
	
	// Check Visitor Status Using Cookie
	function fnGetVisitorStatus() {
		$vStatus = "";
		if ($this->input->cookie('visitor_status',TRUE)) {
			$vStatus = $this->input->cookie('visitor_status',TRUE);
			if ($vStatus == "firsttime") {
				setcookie("visitor_status","unregistered",time()+604800,"/");
			} 				
		} else {
			//setcookie("visitor_status","firsttime",time()+604800,"/");
			setcookie("visitor_status","unregistered",time()+604800,"/");
		}
		return $vStatus;
	}
	
	function fnUpdateVisitorStatus() {
		setcookie("visitor_status","registered",time()+604800,"/");
	}
	
	function getCountryInfoByGeoIp($ip) {
		
		$result = array();
		if ($ip) {
			//$sql = "SELECT `ip_country_code` FROM `geoip` WHERE INET_ATON('".$ip."') BETWEEN begin_ip_num AND end_ip_num LIMIT 1";
			$sql = "SELECT location.country_iso_code as `ip_country_code` FROM blocks, location where blocks.geoname_id = location.geoname_id AND INET_ATON('".$ip."') >= network AND INET_ATON('".$ip."') <= broadcast"; 
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$result = $query->row();
			}	
		}
		return $result;
	}
	/* end */
}
/* End of file user_model.php */
/* Location: ./application/model/user_model.php */