<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MyTeacher_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function getAll($uid,$page = 1,$perPage = 50) {
		$start = intval($page - 1) * $perPage;
		$nowTime = date('Y-m-d H:i:s');
		//$sql = "SELECT myTeacher.*,profile.firstName,profile.hRate,profile.lastName,profile.pic from myTeacher  left join profile on profile.uid = myTeacher.tid where  `sid` = {$uid} limit {$start},{$perPage}";
		//$sql = "SELECT myTeacher.*,profile.firstName,profile.hRate,profile.lastName,profile.school_id,profile.pic,user.readytotalk from user, myTeacher  left join profile on profile.uid = myTeacher.tid where  `sid` = {$uid} and profile.uid = user.id  limit {$start},{$perPage}";
		/*$sql = "SELECT myTeacher.*,profile.school_id,profile.firstName,profile.hRate,profile.lastName,profile.school_id,profile.uid,profile.pic,user.readytotalk from user, myTeacher  left join profile on profile.uid = myTeacher.tid where myTeacher.`sid` = {$uid} and profile.uid = user.id  limit {$start},{$perPage}";*/
		$sql = "SELECT myTeacher.*,profile.school_id,profile.firstName,profile.hRate,profile.lastName,profile.school_id,profile.uid,profile.pic,user.readytotalk from user, myTeacher  left join profile on profile.uid = myTeacher.tid where myTeacher.`sid` = {$uid} and profile.uid = user.id and `user`.`roleId`>=1 limit {$start},{$perPage}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}

	public function getByTid($tid,$page = 1,$perPage = 10) {
		$start = intval($page - 1) * $perPage;
		$nowTime = date('Y-m-d H:i:s');
		$sql = "SELECT  class.*,profile.firstName,profile.lastName,profile.pic from class left join profile on  class.sid = profile.uid where tid={$tid} and startTime > '{$nowTime}' limit {$start},{$perPage}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}

	public function getBySid($sid,$page = 1,$perPage = 10) {
		$start = intval($page - 1) * $perPage;
		$nowTime = date('Y-m-d H:i:s');
		$sql = "SELECT class.*,profile.firstName,profile.lastName,profile.pic from class left join profile on  class.tid = profile.uid  where sid={$sid} and startTime > '{$nowTime}' limit {$start},{$perPage}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}

	public function update($data){
		unset($profileInfo['submit']);
		return $this->db->query($this->db->update_string('lessons',$data,"uid={$data['uid']}"));
	}

	public function creatMyTeacher($uid,$tid,$type){
		$sqlSearch = "select * from myTeacher where `sid`={$uid} and `tid`={$tid} and type = {$type}";
		$query = $this->db->query($sqlSearch);
		if ($query->num_rows() > 0) {
			$updateAt = date('Y-m-d H:i:s');
			$sql = "update  myTeacher set updateAt='{$updateAt}' where `sid`={$uid} and `tid`={$tid} and type = {$type}";
		}
		else {
			//var_dump($start,$end);
			$createAt = date('Y-m-d H:i:s');
			$sql = "insert into myTeacher (`sid`,`tid`,`type`,`createAt`) values ({$uid},{$tid},'{$type}','{$createAt}')";
		}
		$query = $this->db->query($sql);
		return $query ;
	}
	public function delById($id,$uid){
		$sql = "DELETE FROM myTeacher WHERE sid={$uid} AND id={$id}";
		$query = $this->db->query($sql);
		return $query ;
	}
}
