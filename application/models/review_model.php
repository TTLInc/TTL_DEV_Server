<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	public function del($id ){
		foreach($id as $v){
			$sql = "DELETE FROM feedback WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	public function statusupdate($id,$hstatus){
		foreach($id as $v){
			$sql = "UPDATE feedback SET status = {$hstatus}  WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	public function getAll($start,$limit){
		$sql = "SELECT * FROM feedback ORDER BY create_at DESC LIMIT {$start}, {$limit}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		else{
			$result = array();
		}
		return $result;
	}
	public function getTotalReview(){
		$sql = "SELECT COUNT(*) as num FROM feedback ";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$result = $result['num'];
		}
		else{
			$result = 0;
		}
		return $result;
	}
	public function getUserProfile($id){
		$sql = "SELECT firstName,lastName FROM profile WHERE uid = {$id}";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$name = @$result['firstName'].' '.@$result['lastName'];
		return $name;
	}
	
}
