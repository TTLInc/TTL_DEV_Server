<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Languageandculture_model extends TL_Model{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	// Get ALL Data
	public function getAllData($select = "*"){
		$this->db->select($select);
		$this->db->from('languageandculture');
		$query = $this->db->get();
		$result = array();
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		return $result;
	}
	
	// Insert into DB
	public function insertData($data){
		return $this->db->query($this->db->insert_string('languageandculture',$data));
	}
	
	// Update DB
	public function updateData($data,$cnd=""){
		return $this->db->query($this->db->update_string('languageandculture',$data,$cnd));
	}
	
	// Select Data
	public function selectData($select="*",$cnd=""){
		$this->db->select($select);
		$this->db->from('languageandculture');
		if ($cnd) {
			$this->db->where($cnd);	
		}
		$this->db->order_by("id","Desc");
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
			$data = $this->selectData("image",array('id' => $v));
			if ($data[0]['image']) {
				unlink(FCPATH.'uploads/languageandculture/'.$data[0]['image']);
			}
			$this->db->delete('languageandculture', array('id' => $v)); 
		}
		return $id;
	}	
}?>