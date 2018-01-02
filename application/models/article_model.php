<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_model extends TL_Model{

	public function __construct()
	{
		parent::__construct();
	}
	public function get($id){
		$sql = "SELECT * FROM articles where id={$id}";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
		}
		else{
			$result = array();
		}
		return $result;
	}

	public function article_add($data){
		return $this->db->query($this->db->insert_string('articles',$data));
	}
	public function article_edit($data,$id){
		return $this->db->query($this->db->update_string('articles',$data,"id={$id}"));
	}
	public function del($id,$cid=1){
		foreach($id as $v){
			$sql = "DELETE FROM articles WHERE cat = {$cid} and id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	public function get_cat($cid){
		$sql = "SELECT * FROM articles WHERE cat = {$cid} ORDER BY id ASC";
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
