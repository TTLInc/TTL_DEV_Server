<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	public function get($id){
		$sql = "SELECT * FROM video where id={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		else{
			$result = array();
		}
		return $result;
	}

	public function video_add($data){
		return $this->db->query($this->db->insert_string('video',$data));
	}
	public function video_edit($data,$id){
		return $this->db->query($this->db->update_string('video',$data,"id={$id}"));
	}
	public function del($id ){
		foreach($id as $v){
			$sql = "DELETE FROM video WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	public function getAll(){
		$sql = "SELECT * FROM video";
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
	public function getAllAds($position){
		$sql = "SELECT * FROM video WHERE position='{$position}' ORDER BY id DESC";
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
