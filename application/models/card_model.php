<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Card_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function getAll($uid,$page = 1,$perPage = 10) {
		$start = intval($page - 1) * $perPage;
		$sql = "SELECT cards.*,profile.firstName,profile.lastName,profile.uid FROM cards left join profile on profile.uid = cards.uid where cards.uid={$uid}   limit {$start},{$perPage}";
		$query = $this->db->query($sql);
		$result = array();
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
		}
		return $result;
	}

	public function save($data) {
		if(isset($data['id']) && $data['id'] > 0){
			$this->db->query($this->db->update_string('cards',$data,"id={$data['id']}"));
		}
		else{
			$this->db->query($this->db->insert_string('cards',$data));
		}
		
		$uid = $this->db->insert_id();
	}
	public function getOne($id){
		$sql ="SELECT cards.*  FROM cards   WHERE cards.id = '{$id}'";
		$query = $this->db->query($sql);
		$result = false;
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
		}
		return $result;
	}

	public function delById($id,$uid){
		$sql = "DELETE FROM cards WHERE id={$id} AND uid={$uid}";
		$query = $this->db->query($sql);
	}
	public function update($data){
		//var_dump($this->db->update_string('lessons',$data,"id={$data['id']}&uid={$data['uid']}"));
		//unset($profileInfo['submit']);
		return $this->db->query($this->db->update_string('lessons',$data,"id={$data['id']} and uid={$data['uid']}"));
	}

}
