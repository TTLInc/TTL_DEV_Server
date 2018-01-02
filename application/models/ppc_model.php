<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ppc_model extends TL_Model{

	public function __construct(){
		parent::__construct();
	}
	public function loadQoute(){
		$sql = "SELECT * FROM `quote` where status = 'active'";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function loadVideo($lang){
		$sql = "SELECT * FROM `video` where status = 'active' AND lang = '{$lang}' ORDER BY id DESC LIMIT 0, 1";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	/**
	 * check the user login or not.
	 */
	public function isLogin() {
		if(!$this->session->userdata('email')){
			return false;
		}
		return true;
	}
	/**
	 * login
	 * @param  $userinfo
	 */
	public function login($userinfo) {
		$result = array();
		$sql = "select * from user where email=? and password=? limit 1";
		$query = $this->db->query($sql,array($userinfo['email'],($userinfo['password'])));
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
		$errorMsg = array();
		$errorMsg['success'] = false;
		if($val == '') {
			$errorMsg['message'] = 'password cannot empty';
		}else {
			$errorMsg['success'] = true;
		}
		return $errorMsg;
	}
	public function checkEmail($val) {
		$errorMsg = array();
		$errorMsg['success'] = false;
		if($val == '') {
			$errorMsg['message'] = 'email cannot empty';
		}else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$val)) {
			$errorMsg['message'] = 'Enter a valid e-mail';
		}else if($this->getEmail($val)) {
			$errorMsg['message'] = 'Email already exists.';
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
}
/* End of file ppc_model.php */
/* Location: ./application/model/ppc_model.php */