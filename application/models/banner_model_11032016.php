<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	public function loadBanner(){
		$sql = "SELECT banners.*,profile.FirstName,profile.lastName FROM banners LEFT JOIN profile on banners.school_id=profile.uid order by `order` desc";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		else{
			$result = array();
		}
		
		return $result;
	}
	
	public function loadBannerDashBoard($scid){
		$sql = "SELECT * FROM banners where status=1 and school_id={$scid} order by `order` desc";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}
		else{
			$result = array();
		}
		return $result;
	}
	
	public function banner_add($data){
		return $this->db->query($this->db->insert_string('banners',$data));
	}
	public function banner_edit($data,$id){
		return $this->db->query($this->db->update_string('banners',$data,"id={$id}"));
	}
	
	public function get_banner($id){
		$sql = "SELECT banners.*,profile.firstName,profile.lastName FROM banners LEFT JOIN profile on banners.school_id=profile.uid WHERE banners.id = {$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		else{
			$result = array();
		}
		return $result;
	}

	public function del($id){
		foreach($id as $v){
			$sql = "DELETE FROM banners WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
}
