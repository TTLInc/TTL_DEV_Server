<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Im_model extends TL_Model{
	public function __construct(){	
		parent::__construct();
	}
	public function getAllActive(){
		$sql 	= "SELECT * FROM im_que WHERE status='ACTIVE'  AND ans != '--' ";
		$query 	= $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function getAll(){
		$sql 	= "SELECT * FROM im_que ";
		$query 	= $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	public function get($id){
		$sql = "SELECT * FROM im_que where id={$id}";
			$query = $this->db->query($sql);
			if ( $query->num_rows() > 0) {
				$result = $query->row_array();
			}else{
				$result = array();
			}
			return $result;
	}
	public function im_add($data){
		/*
		if($data['order'] == ""){
			$sql 	= "SELECT `order` FROM faq ORDER BY `order` DESC LIMIT 1";
			$query 	= $this->db->query($sql);
			$result = $query->row_array();
			$data['order']=$result['order'] + 1;
		}
		*/
		return $this->db->query($this->db->insert_string('im_que',$data));
	}
	public function im_add_front($data){
		return $this->db->query($this->db->insert_string('im_que',$data));
	}
	public function im_edit($data,$id){
		return $this->db->query($this->db->update_string('im_que',$data,"id={$id}"));
	}
	public function del($id ){
		foreach($id as $v){
			$sql = "DELETE FROM im_que WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	public function get_unread(){
		$result =  $this->db->query("SELECT count(que)  FROM im_que WHERE ans='--'");
		$total = $result->row_array();
		return $total['count(que)'];
	}
}
/* End of file im_model.php */
/* Location: ./application/model/im_model.php */