<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messaging_model extends TL_Model{

	public function __construct(){
		parent::__construct();
	}
	
	public function get($id){
		$sql = "SELECT * FROM mass_messages where id={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function insertNewsletter($data){
		return $this->db->query($this->db->insert_string('newsletter',$data));
	}
	public function editNewsletter($data,$id){
		return $this->db->query($this->db->update_string('newsletter',$data,"id={$id}"));
	}
	public function message_add($data){
		return $this->db->query($this->db->insert_string('mass_messages',$data));
	}
	public function message_edit($data,$id){
		return $this->db->query($this->db->update_string('mass_messages',$data,"id={$id}"));
	}
	public function del($id ){
		foreach($id as $v){
			$sql = "DELETE FROM mass_messages WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	public function getAll(){
		$sql = "SELECT * FROM mass_messages";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function getAllAdmin($search = '',$sortorder,$sort,$start,$limit){
		if($search == ''){
			$sql = "SELECT * FROM mass_messages order by mass_messages.{$sort} {$sortorder} LIMIT {$start}, {$limit}";
		}else{
			$sql = "SELECT * FROM mass_messages WHERE subject like '%{$search}%' OR message like '%{$search}%' OR sendto like '%{$search}%' OR mass_messages.group like '{$search}' OR name like '%{$search}%' OR uid like '{$search}' order by mass_messages.{$sort} {$sortorder} LIMIT {$start}, {$limit}";
		}
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function getTotalMessages($search = ''){
		if($search == ''){
			$sql = "SELECT COUNT(*) as num FROM mass_messages ";
		}else{
			$sql = "SELECT COUNT(*) as num FROM mass_messages WHERE subject like '%{$search}%' OR message like '%{$search}%' OR sendto like '%{$search}%' OR mass_messages.group like '{$search}' OR name like '%{$search}%' OR uid like '{$search}' ";
		}
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$result = $result['num'];
		}else{
			$result = 0;
		}
		return $result;
	}
	public function getAllNewsletter(){
		$sql = "SELECT * FROM newsletter";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function getAllMember(){
		$sql = "SELECT id,email FROM user ORDER BY id DESC";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
	}
	public function getAllStudent(){
		$sql = "SELECT id,email FROM user WHERE roleId = 0 ORDER BY id DESC";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
	}
	public function getAllTutor(){
		$sql = "SELECT id,email FROM user WHERE roleId = 1 OR roleId = 2 ORDER BY id DESC";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
	}
	public function getIndividualMember($email){
	    $sql = "SELECT id,email FROM user WHERE email = '{$email}' ORDER BY id DESC";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
	}
	public function getUserName($id){
		$sql = "SELECT firstName,lastName FROM profile WHERE uid = {$id} ORDER BY id DESC";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
			$newrs = $result[0];
			$name = $newrs['firstName'].' '.$newrs['lastName'];
		}else{
			$name = "";
		}
		return $name;
	}
	public function bookSessionCheck($sid){
		$sql = "SELECT COUNT(*) as num FROM class WHERE sid = {$sid} AND `createAt` BETWEEN date_sub( CURDATE() , INTERVAL 14 day ) AND (CURDATE()+2)";
		$query = $this->db->query($sql);
		$ret = 0;
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			if($result['num']>0){
				$ret = 1;
			}
		}
		return $ret;
	}
	public function lastOpenedSession($tid){
		$sql = "SELECT COUNT(*) as num FROM timeSlot WHERE uid = {$tid} AND `creatAt` BETWEEN date_sub( CURDATE() , INTERVAL 14 day ) AND (CURDATE()+2)";
		$query = $this->db->query($sql);
		$ret = 0;
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			if($result['num']>0){
				$ret = 1;
			}
		}
		return $ret;
	}
	public function notPayeeStudents($sid){
		$sql = "SELECT COUNT(*) as num FROM profile WHERE uid = {$sid} AND free_session = 'n' AND money = 0.00";
		$query = $this->db->query($sql);
		$ret = 0;
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			if($result['num']>0){
				$ret = 1;
			}
		}
		return $ret;
	}
	
	////viplove 18-2-14 free_session_expiration_alert start//////
	
	public function free_session_expiration_alert(){
	$sql = "select id,email from user where free_session = 'Y' AND roleId = 0 AND DATE( DATE_ADD(add_time , INTERVAL 5 DAY)) = CURDATE()";
	$query = $this->db->query($sql);
	$result = $query->result_array();
	return $result;
	}
	
	public function free_session_expiration_alert_template(){
	$sql = "select n7 from newsletter where id = 1";
	$query = $this->db->query($sql);
	$result = $query->result_array();
	return $result;	
	}
	////viplove 18-2-14 free_session_expiration_alert end//////
	
	
	public function not_confirm_send_msg(){
		// $to_date = date('Y-m-d H:m:s');
		 //echo  $to_date;
//	$cur_time='2014-03-14 10:25:15';
	//$duration='+12 hours';
//echo date('Y-m-d H:i:s', strtotime($duration, strtotime($cur_time)));
	//DATE_ADD('2100-12-31 08:59:59',
     //  INTERVAL '12' HOUR)
	//select stid , TIMESTAMPADD( HOUR , 12, creatAt ) from timeslot where id = 8403
	  $sql = "select uid,stid,startTime from timeSlot where stid != 0 AND TIMESTAMPADD( MINUTE , 1, creatAt ) < CURDATE()";
	 
	$query = $this->db->query($sql);
	$result = $query->result_array();
	//print_r($result);exit;
	return $result;	
	}
	
	
	
	
}
/* End of file messaging_model.php */
/* Location: ./application/model/messaging_model.php */