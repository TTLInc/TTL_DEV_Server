<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qoute_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	*@author TECHNO-MAYA
	*@Purpose : This function is use for get data id wise from qoute table
	*@date 16 May 2013 
	**/
	public function get($id){
		$sql = "SELECT * FROM quote where id={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		else{
			$result = array();
		}
		return $result;
	}
	/**
	*@author TECHNO-MAYA
	*@Purpose : This function is use for Add qoute
	*@date 16 May 2013 
	**/
	public function quote_add($data){
		return $this->db->query($this->db->insert_string('quote',$data));
	}
	
	/**
	*@author TECHNO-MAYA
	*@Purpose : This function is use for Edit qoute
	*@date 16 May 2013 
	**/
	public function quote_edit($data,$id){
		return $this->db->query($this->db->update_string('quote',$data,"id={$id}"));
	}
	
	/**
	*@author TECHNO-MAYA
	*@Purpose : This function is use for delete qoute
	*@date 16 May 2013 
	**/
	public function del($id ){
		foreach($id as $v){
			$sql = "DELETE FROM quote WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	
	/**
	*@author TECHNO-MAYA
	*Purpose :get all data from qoute table
	*@date 16 May 2013 
	**/
	public function getAll(){
		$sql = "SELECT * FROM quote ";
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
	*@author TECHNO-MAYA
	*@contains below function loads all ads by position which is passed on this function
	*@date 16 May 2013 
	**/
	public function getAllAds($position){
		$sql = "SELECT * FROM quote WHERE status='{$position}' ORDER BY id DESC";
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
