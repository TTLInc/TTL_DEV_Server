<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq_model extends TL_Model{
	public function __construct(){	
		parent::__construct();
	}
	//--R&D@Sept-19-2013 : Get FAQ by ID
	public function get($id){
		$sql = "SELECT * FROM faq where id={$id}";
			$query = $this->db->query($sql);
			if ( $query->num_rows() > 0) {
				$result = $query->row_array();
			}else{
				$result = array();
			}
			return $result;
	}
	//--R&D@Sept-19-2013 : Add FAQ
	public function faq_add($data){
		if($data['order'] == ""){
			$sql 	= "SELECT `order` FROM faq ORDER BY `order` DESC LIMIT 1";
			$query 	= $this->db->query($sql);
			$result = $query->row_array();
			$data['order']=$result['order'] + 1;
		}
		return $this->db->query($this->db->insert_string('faq',$data));
	}
	//--R&D@Sept-19-2013 : Edit FAQ by ID
	public function faq_edit($data,$id){
		return $this->db->query($this->db->update_string('faq',$data,"id={$id}"));
	}
	//--R&D@Sept-19-2013 : Delete FAQ by ID
	public function del($id ){
		foreach($id as $v){
			$sql = "DELETE FROM faq WHERE  id={$v}";
			$this->db->query($sql);
		}
		return $id;
	}
	//--R&D@Sept-19-2013 : GetAll FAQ
	public function getAll(){
		$sql 	= "SELECT * FROM faq ";
		$query 	= $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
	//--R&D@Sept-19-2013 : GetAll Active FAQ
	public function getAllAds($position){
		$sql 	= "SELECT * FROM faq WHERE status='{$position}' ORDER BY id DESC";
		$query 	= $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
		}else{
			$result = array();
		}
		return $result;
	}
}
/* End of file faq_model.php */
/* Location: ./application/model/faq_model.php */