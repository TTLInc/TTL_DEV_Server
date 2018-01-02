<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimonial_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	
	// Get All Testimonials
	public function getAll($limit=""){
		$lmt = "";
		if($limit>0)
		{
			$lmt = " LIMIT $limit";
		}
		$sql = "SELECT * FROM `testimonials` order by `id` DESC $lmt";
		$qry = $this->db->query($sql);
		$res = array();
		if ( $qry->num_rows() > 0) {
			$res = $qry->result_array();
		}
		return $res;
	}
	
	public function insertTestimonial($data)
	{
		$this->db->insert('testimonials', $data); 
		return true;
	}
	
	public function updateTestimonial($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('testimonials', $data);  
		return true;
	}
	
	public function getTestimonial($id="") 
	{
		$qry = $this->db->get_where('testimonials', array('id' => $id), 1);
		$res = array();
		if ( $qry->num_rows() > 0) {
			$res = $qry->result_array();
		}
		return $res;
	}
	
	public function delTestimonial($id){
		foreach($id as $v){
			$this->db->where('id', $v);
			$this->db->delete('testimonials'); 
		}
		return true;
	}
}