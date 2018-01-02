<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notifications_model extends TL_Model{	
	
	public function __construct()
	{
		parent::__construct();
	}

	// Get ALL Data
	public function getAllData($select = "*"){
		$this->db->select($select);
		$this->db->from('notifications');
		$query = $this->db->get();
		$result = array();
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	// Insert into DB
	public function insertData($data){
		return $this->db->query($this->db->insert_string('notifications',$data));
	}
	
	// Update DB
	public function updateData($data,$cnd=""){
		return $this->db->query($this->db->update_string('notifications',$data,$cnd));
	}
	
	// Select Data
	public function selectData($select="*",$cnd="",$orderby="id", $order="Desc"){
		$this->db->select($select);
		$this->db->from('notifications');
		if ($cnd) {
			$this->db->where($cnd);	
		}
		$this->db->order_by($orderby,$order);
		$query = $this->db->get();
		$result = array();
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	// Del Data
	public function delData($id ){
		foreach($id as $v){
			$this->db->delete('notifications', array('id' => $v)); 
		}
		return $id;
	}
}?>