<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contests_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	public function get($id){
		$sql = "SELECT * FROM contests where id={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		else{
			$result = array();
		}
		return $result;
	}

	public function contests_add($data){
		return $this->db->query($this->db->insert_string('contests',$data));
	}
	public function contests_edit($data,$id){
		return $this->db->query($this->db->update_string('contests',$data,"id={$id}"));
	}
	public function del($id ){
		foreach($id as $v){
			$sql = "DELETE FROM contests WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	public function getAll(){
		$sql = "SELECT * FROM contests";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		else{
			$result = array();
		}
		return $result;
	}
	
	public function getAllContests($status){
		$sql = "SELECT * FROM contests WHERE status='{$status}' ORDER BY id DESC";
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
