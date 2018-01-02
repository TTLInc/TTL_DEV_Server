<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	
	/**
	*@author TECHNO-MAYA
	*@Purpose : This function is use for Add Settings
	*@date 30 May 2013 
	**/
	public function settings_add($data){
		
		return $this->db->query($this->db->insert_string('settings',$data));
	}
	
	
	/**
	*@author TECHNO-MAYA
	*@Purpose : This function is use for Edit settings
	*@date 30 May 2013 
	**/
	public function settings_edit($data){
		return $this->db->query($this->db->update_string('settings',$data,"id=1"));
	}
	
	/**
	*@author TECHNO-MAYA
	*@Purpose : This function is use for get data id wise from settings table
	*@date 30 May 2013 
	**/
	public function get($id){
		$sql = "SELECT * FROM settings where id=1";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		else{
			$result = array();
		}
		return $result;
	}
	
}
