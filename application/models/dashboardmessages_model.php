<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboardmessages_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	public function get($id){
		$sql = "SELECT * FROM admin_message where id={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		else{
			$result = array();
		}
		return $result;
	}

	public function dashboardmessages_add($data){
		return $this->db->query($this->db->insert_string('admin_message',$data));
	}
	public function dashboardmessages_edit($data,$id){
		return $this->db->query($this->db->update_string('admin_message',$data,"id={$id}"));
	}
	public function del($id ){
		foreach($id as $v){
			$sql = "DELETE FROM admin_message WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	public function getAll(){
		$sql = "SELECT * FROM admin_message";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		else{
			$result = array();
		}
		return $result;
	}
	/**
	*@author TECHNO-SANJAY
	*@contains below function loads all ads by position which is passed on this function
	*@date 07 May 2013 
	**/
	public function getAllMessages($status){
		$sql = "SELECT * FROM admin_message WHERE status='{$status}' ORDER BY id DESC";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		else{
			$result = array();
		}
		return $result;
	}
	
}
