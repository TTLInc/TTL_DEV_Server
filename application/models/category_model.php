<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category_model extends TL_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function addcategory($data){
		return $this->db->query($this->db->insert_string('categories',$data));
	}
	
	public function GetCategories($start,$limit,$sortorder,$sort){
		
		$sql 	= "select * from `categories` order by {$sort} {$sortorder} limit {$start} ,{$limit}";
		$query 	= $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	
	public function Getcategoryedit($id){
		$sql = "SELECT * FROM `categories` where `id`={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}else{
			$result = array();
		}
		return $result;
	}
	
	public function editcategory($data,$id){
			return $this->db->query($this->db->update_string('categories',$data,"`id`={$id}"));
	}
	
	public function delcategory($id ){
		foreach($id as $v){
			$sql = "DELETE FROM categories WHERE `id`='{$v}'";
			$this->db->query($sql);
		}
		return $id;
	}
	
	public function selCategory($cnd){
		$sql = "SELECT * FROM `categories` where 1 and $cnd ";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}else{
			$result = array();
		}
		return $result;
	}
}